<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

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
    const AUDIO = 4;

    public static $type = [
        self::TEXT => 'Text',
        self::IMAGE => 'Image',
        self::VIDEO => 'Video',
        self::AUDIO => 'Audio',
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

    public function uploadFile($file, $dir)
    {
        $time = Carbon::now();
        $dataFile = $file;
        $nameFile = $time->timestamp . $dataFile->getClientOriginalName();
        $destinationPath = base_path() . '/public/upload/' . $dir;
        $file->move($destinationPath, $nameFile);
        return $nameFile;
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
        $builder = Blog::create($data);
        if($data['files'] !== null)
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

    public function verifyBlog($request)
    {
        $verifiedAt = Carbon::now();
        if ($request['submitButton'] == 'approve') {
            $approvedActual = 1;
        } else if ( $request['submitButton'] == 'deny') {
            $approvedActual = 2;
        }

        $questionId = $request['question_id'];
        $verifiedAuthor = $request['verify_author'];
        $note = $request['note'] ?? null;

        $builder = Blog::where('id', $questionId)
            ->update([
                'verified_at' => $verifiedAt,
                'approve_status' => $approvedActual,
                'verify_author' => $verifiedAuthor,
                'note' => $note,
            ]);
        return $builder;
    }
}
