<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;
use phpDocumentor\Reflection\DocBlock\Tags\Reference\Url;

class Question extends Model
{
    use SoftDeletes;

    protected $table = 'questions';

    protected $fillable = [
        'title',
        'question_poll',
        'details',
        'user_id',
        'category_id',
        'status',
        'filename',
        'is_solved',
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

    const FOLDER_UPLOAD = 'questions';

    public function category()
    {
        return $this->hasOne('App\Models\Category', 'id', 'category_id');
    }

    public function tag()
    {
        return $this->belongsToMany('App\Models\Tag');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function comments()
    {
        return $this->morphMany('App\Models\Comment', 'commentable')->whereNull('parent_id');
    }

    public function poll()
    {
        return $this->hasMany('App\Models\Poll');
    }

    public function report()
    {
        return $this->hasMany('App\Models\Report');
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

    public function getUserQuestion($userId)
    {
        $query = Question::where('user_id', $userId)->orderBy('created_at', 'DESC')->paginate(5);
        return $query;
    }

    public function getQuestionToApprove()
    {
        $query = Question::orderBy('created_at', 'DESC')->get();
        return $query;
    }

    public function getQuestionDetail($id)
    {
        $query = Question::findOrFail($id);
        return $query;
    }

    public function createQuestion($params)
    {
        $input['question_poll'] = $params['question_poll'] ?? 0;
        $input['category_id'] = $params['category'];
        $input['title'] = $params['title'];
        $input['user_id'] = $params['user_id'];
        $input['details'] = $params['details'];

        if (isset($params['filename']))
        {
            $input['filename'] = $this->uploadFile($params['filename'], Question::FOLDER_UPLOAD);

        }
        $data = Question::create($input);

        if ($params['tags'])
        {
            $tags = explode("," , $params['tags']);
            foreach ($tags as $tag)
            {
                $createTag = Tag::create(['name_tag' => $tag] );
                QuestionTag::create([
                    'question_id' => $data->id,
                    'tag_id' => $createTag->id
                ]);
            }
        }

        if ($data['question_poll'] == 1)
        {
            foreach ($params['ask'] as $pollField)
            {
                Poll::create([
                   'title' => $pollField['title'],
                   'question_id' => $data->id,
                ]);
            }
        }
        return $data;
    }

    public function updateQuestion($id, $data = array())
    {
        $question = Question::find($id);

        //Update tags question
        $tags = explode("," , $data['tags']);
        $tagQuery = $question->tag->pluck('name_tag')->toArray();
        foreach ($tags as $tag)
        {
            if (!in_array($tag, $tagQuery)){
                $newTag = Tag::create(['name_tag' => $tag]);
                QuestionTag::create([
                    'question_id' => $question->id,
                    'tag_id' => $newTag->id
                ]);
            }
        }
        foreach ($tagQuery as $tag1)
        {
            if(!in_array($tag1, $tags)){
                $deleteTag = Tag::where('name_tag', $tag1)->first();
                QuestionTag::where('tag_id', $deleteTag['id'])->delete();
                $deleteTag->delete();
            }
        }

        //update file
        if (!isset($data['filename'])) {
            $data['filename'] = $question->filename;
        } else {
            $data['filename'] = $this->uploadFile($data['filename'], Question::FOLDER_UPLOAD);
        }

        //update poll question
        if (!isset($data['question_poll']) && !isset($data['ask'])){
            Poll::where('question_id', $question->id)->delete();
        }

        if (isset($data['question_poll']) && $data['question_poll'] == 1)
        {
            $pollQuery = $question->poll->pluck('title')->toArray();
            foreach ($data['ask'] as $pollCheck)
            {
                $pollInput[] = $pollCheck['title'];
                if (!in_array($pollCheck['title'], $pollQuery)){
                    Poll::create([
                        'title' => $pollCheck['title'],
                        'question_id' => $question->id
                    ]);
                }
            }
            foreach ($pollQuery as $poll1)
            {
                if(!in_array($poll1, $pollInput))
                {
                    Poll::where('title', $poll1)->first()->delete();
                }
            }
        } else {
            $data['question_poll'] = 0;
        }


        return $question->update($data);

    }

    public function verifyQuestion($request)
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

        $builder = Question::where('id', $questionId)
                        ->update([
                            'verified_at' => $verifiedAt,
                            'approve_status' => $approvedActual,
                            'verify_author' => $verifiedAuthor,
                            'note' => $note,
                        ]);
        return $builder;
    }

    public function closeQuestion($id)
    {
        $question = Question::find($id);
        $data['is_solved'] = 1 ;
        return $question->update($data);
    }

    public function reopenQuestion($id)
    {
        $question = Question::find($id);
        $data['is_solved'] = 0 ;
        return $question->update($data);
    }

    public function getRecentQuestions()
    {
        return Question::where('approve_status', '=', 1 )->orderBy('updated_at', 'DESC')->get();
    }

    public function getNoAnswerQuestion()
    {
        $questionId = Question::pluck('id')->toArray();
        $commentQuestion = Comment::where('commentable_type', '=', 'App\Models\Question')->pluck('commentable_id')->toArray();
        dd($commentQuestion);
    }

    public function getAllQuestionbyCategory($categoryId)
    {
        return Question::where('category_id', $categoryId)->paginate(10);
    }

    public function getQuestionSingle()
    {
        return Question::where('question_poll', '=', 0)->where('approve_status', '=', 1)->paginate(5);
    }

    public function getQuestionPoll()
    {
        return Question::where('question_poll', '=', 1)->where('approve_status', '=', 1)->paginate(5);
    }

    public function reportQuestion($data = array())
    {
        $question = Question::find($data['question_id'])->increment('reports');
        foreach($data['report'] as $report)
        {
            Report::create([
                'question_id' => $data['question_id'],
                'user_id' => $data['user_id'],
                'type' => $report,
            ]);
        }
        if (isset($data['message'])){
            Report::where('question_id', $data['question_id'])->where('user_id', $data['user_id'])->first()->update(['message' => $data['message']] );
        }
        return $question;
    }

    public function getTopCategoryQuestion()
    {
        $result = Question::selectRaw("category_id,count(id) as questionAmount")
            ->groupBy('category_id')
            ->orderBy('questionAmount','DESC')
            ->limit('6')
            ->get();
        foreach ($result as $query)
        {
            $name = Category::where('id', $query->category_id)->pluck('name_category')->first();
            $query['name_category'] = $name;
        }
        return $result;
    }

    public function getMostReportQuestion()
    {
        return Question::orderBy('reports', 'DESC')->limit(6)->get();
    }

}
