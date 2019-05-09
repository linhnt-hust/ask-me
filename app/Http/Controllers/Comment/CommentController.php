<?php

namespace App\Http\Controllers\Comment;

use App\Models\Comment;
use App\Models\User;
use App\Models\VoteCommentHistory;
use Illuminate\Http\Request;
use App\Models\Question;
use App\Http\Controllers\Controller;

class CommentController extends Controller
{
    protected $modelComment;
    protected $modelQuestion;
    protected $modelUser;
    public function __construct(
        Question $question,
        User $user,
        Comment $comment
    ){
        $this->middleware('auth');
        $this->modelQuestion = $question;
        $this->modelUser = $user;
        $this->modelComment = $comment;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $comment = new Comment;
        $comment->body = $request->get('comment_body');
        $comment->user()->associate($request->user());
        $question = Question::find($request->get('question_id'));
        $question->comments()->save($comment);

        $view1 = \View::make('partials.comment_replies')->with(['question_id'=>$question->id])->with(compact('comment'))->with(['isSolved'=>$question->is_solved]);
         $contents = (string) $view1;
         return response()->json(['success'=>$contents, 'comments' =>count($question->comments)]);
    }

    public function replyStore(Request $request)
    {
        $reply = new Comment();
        $reply->body = $request->get('comment_body');
        $reply->user()->associate($request->user());
        $reply->parent_id = $request->get('comment_id');
        $question = Question::find($request->get('question_id'));
        $question->comments()->save($reply);

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        $id = $request->get('id');
        $comment = Comment::find($id);
        $comment->delete();
        $question = Question::find($request->get('question_id'));

        return response()->json(['success'=>'success', 'comments' => count($question->comments)]);
    }

    public function upvote(Request $request)
    {
        $comment = Comment::find($request->get('comment_id'));
        $comment->increment('votes');
        $history = VoteCommentHistory::where('comment_id', $request->get('comment_id'))->where('user_id', $request->get('voted_user'));
        if ($history->first() != null)
        {
            $data['up'] = 1 ;
            $history->update($data);
        } else {
            VoteCommentHistory::create([
                'comment_id' => $request->get('comment_id'),
                'user_id' => $request->get('voted_user'),
                'up' => 1,
            ]);
        }

        return response()->json(['success'=>$comment->votes]);
    }

    public function downvote(Request $request)
    {
        $comment = Comment::find($request->get('comment_id'));
        $comment->decrement('votes');
        $history = VoteCommentHistory::where('comment_id', $request->get('comment_id'))->where('user_id', $request->get('voted_user'));
        if ($history->first() == null)
        {
            VoteCommentHistory::create([
                'comment_id' => $request->get('comment_id'),
                'user_id' => $request->get('voted_user'),
                'down' => 1,
            ]);
        } else {
            $data['down'] = 1;
            $history->update($data);
        }

        return response()->json(['success'=>$comment->votes]);
    }
}
