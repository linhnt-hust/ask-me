<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;
use Cohensive\Embed\Facades\Embed;

class Blog extends Model
{
    use SoftDeletes;

    protected $table = 'blogs';

    protected $fillable = [
        'title',
        'user_id',
        'type',
        'approve_status',
        'verify_author',
        'note',
        'verified_at',
        'description',
        'url'
    ];

    protected $date = [
        'deleted_at',
        'created_at',
        'updated_at'
    ];

    const PENDING = 0;
    const APPROVED = 1;
    const DENIED = 2;

    public static $approveStatus = [
        self::PENDING => 'PENDING',
        self::APPROVED => 'APPROVED',
        self::DENIED => 'DENIED',
    ];

    const TEXT = 1;
    const IMAGE = 2;
    const VIDEO = 3;

    public static $type = [
        self::TEXT => 'Text',
        self::IMAGE => 'SlideShow',
        self::VIDEO => 'Video',
    ];

    const FOLDER_UPLOAD = 'blogs';

    public function category()
    {
        return $this->belongsToMany('App\Models\Category');
    }

    public function blogUploaded()
    {
        return $this->hasMany('App\Models\BlogUploaded');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function verifyAuthor()
    {
        return $this->belongsTo('App\Models\Admin', 'verify_author', 'id');
    }

    public function comments()
    {
        return $this->morphMany('App\Models\Comment', 'commentable')->whereNull('parent_id');
    }

    public function uploadFile($file, $dir)
    {
        $time = Carbon::now();
        $dataFile = $file;
        $nameFile = $time->timestamp . $dataFile->getClientOriginalName();
        $destinationPath = base_path() . '/public/upload/' . $dir;
        $file->move($destinationPath, $nameFile);
        return $nameFile;
    }

    public function getVideoHtmlAttribute($url, $width, $height)
    {
        $embed = Embed::make($url)->parseUrl();

        if (!$embed)
            return '';

        $embed->setAttribute(['width' => $width, 'height' => $height]);
        return $embed->getHtml();
    }

    public function getUserBlog($userId)
    {
        $query = Blog::where('user_id', $userId)->orderBy('created_at', 'DESC')->paginate(5);
        return $query;
    }

    public function getBlogToApprove()
    {
        $query = Blog::orderBy('created_at', 'DESC')->get();
        return $query;
    }

    public function getVerifiedBlog()
    {
        return Blog::where('approve_status', '=', 1 )->orderBy('updated_at', 'DESC')->get();
    }

    public function getBlogDetail($id)
    {
        return Blog::findOrFail($id);
    }

    public function createBlog(array $data)
    {
        $detail = $data['summetnoteInput'];
        $dom = new \domdocument();
        $dom->loadHtml($detail, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        $images = $dom->getelementsbytagname('img');

        foreach($images as $k => $img){
            $data = $img->getattribute('src');

            list($type, $data) = explode(';', $data);
            list(, $data)      = explode(',', $data);

            $data = base64_decode($data);
            $image_name= time().$k.'.png';
            $path = public_path() .'/upload/summernote/'. $image_name;

            file_put_contents($path, $data);

            $img->removeattribute('src');
            $img->setattribute('src', $image_name);
        }

        $data['description'] = $dom->savehtml();
        $builder = Blog::create($data);
        if(isset($data['files']))
        {
            foreach($data['files'] as $file)
            {
                $name = $this->uploadFile($file, Blog::FOLDER_UPLOAD);
                BlogUploaded::create([
                    'blog_id' => $builder->id,
                    'filename' => $name,
                ]);
            }
        }

        foreach ($data['categories'] as $category)
        {
            BlogCategory::create([
               'blog_id' => $builder->id,
               'category_id' => $category,
            ]);
        }

        return $builder;
    }

    public function updateBlog($id, $data = array())
    {
        $blog = Blog::find($id);

        $detail = $data['summetnoteInput'];
        $dom = new \domdocument();
        $dom->loadHtml($detail, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        $images = $dom->getelementsbytagname('img');

        foreach($images as $k => $img){
            $data = $img->getattribute('src');

            list($type, $data) = explode(';', $data);
            list(, $data)      = explode(',', $data);

            $data = base64_decode($data);
            $image_name= time().$k.'.png';
            $path = public_path() .'/upload/summernote/'. $image_name;

            file_put_contents($path, $data);

            $img->removeattribute('src');
            $img->setattribute('src', $image_name);
        }

        $data['description'] = $dom->savehtml();

        // cateogry
        foreach ($data['categories'] as $category)
        {
            if(!in_array($category, $blog->category->pluck('id')->toArray())){
                BlogCategory::create([
                    'blog_id' => $blog->id,
                    'category_id' => $category,
                ]);
            }
        }
        foreach ($blog->category->pluck('id')->toArray() as $cate)
        {
            if (!in_array($cate, $data['categories'])){
                BlogCategory::where('category_id', $cate)->where('blog_id', $blog->id)->first()->delete();
            }
        }

        // file
        if(isset($data['files'])){
            foreach ($data['files'] as $file)
            {
                if(!in_array($file, $blog->blogUploaded->pluck('filename')->toArray())){
                    $name = $this->uploadFile($file, Blog::FOLDER_UPLOAD);
                    BlogUploaded::create([
                        'blog_id' => $blog->id,
                        'filename' => $name,
                    ]);
                }
            }

            foreach ($blog->blogUploaded->pluck('filename')->toArray() as $delFile)
            {
                if(!in_array($delFile, $data['files'])){
                    $image_path = "/upload/blogs/".$delFile;
                    \File::delete($image_path);
                    BlogUploaded::where('filename', $delFile)->where('blog_id', $blog->id)->first()->delete();
                }
            }
        }

        return $blog->update($data);
    }

    public function verifyBlog($request)
    {
        $verifiedAt = Carbon::now();
        if ($request['submitButton'] == 'approve') {
            $approvedActual = 1;
        } else if ( $request['submitButton'] == 'deny') {
            $approvedActual = 2;
        }

        $blogId = $request['blog_id'];
        $verifiedAuthor = $request['verify_author'];
        $note = $request['note'] ?? null;

        $builder = Blog::where('id', $blogId)
            ->update([
                'verified_at' => $verifiedAt,
                'approve_status' => $approvedActual,
                'verify_author' => $verifiedAuthor,
                'note' => $note,
            ]);
        $this->sendMailApproveBlog($request);
        return $builder;
    }

    public function sendMailApproveBlog($request)
    {
        $blog = Blog::find($request['blog_id']);
        if (isset($blog->user->email)
            && filter_var($blog->user->email, FILTER_VALIDATE_EMAIL)) {
            event(new \App\Events\SendMailApproveBlog($blog));
        }
    }

    public function getAllBlogs()
    {
        return Blog::where('approve_status', '=', 1 )->orderBy('updated_at', 'DESC')->paginate(5);
    }

    public function searchBlog($input)
    {
        return Blog::where('title', 'LIKE', '%' . $input['search_text'] . '%')->paginate(6);
    }
}
