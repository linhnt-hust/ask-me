<?php

namespace App\Http\Controllers\User;

use App\Models\Comment;
use App\Models\Question;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Models\User;
use App\Http\Requests\UpdateUserRequest;

class ProfileController extends Controller
{   
    protected $modelUser;
    protected $modelQuestion;
    protected $modelComment;
    public function __construct(
        User $user,
        Question $question,
        Comment $comment
    ){
        $this->modelUser = $user;
        $this->modelQuestion = $question;
        $this->modelComment = $comment;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $userQuestion = $this->modelQuestion->getUserQuestion($user->id);
        $userComment =  $this->modelComment->getUserComment($user->id);
        return view('user.profile.index', compact('user', 'userQuestion', 'userComment'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        $user = User::findOrFail($id);
        return view('user.profile.edit', compact('user'));
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
        $data = $request->all();
        $result = $this->modelUser->updateUser($data, $id);
        if ($result) {
            return redirect()->back()->with('success', 'Update user profile successfully.');
        } else {
            return redirect()->back()->with('error', 'Whoops!! Something is wrong.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
