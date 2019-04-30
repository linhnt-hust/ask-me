<?php

namespace App\Http\Controllers\Question;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Models\Question;
use Illuminate\Support\Facades\Auth;

class QuestionController extends Controller
{
    protected $modelQuestion;
    protected $modelCategory;
    protected $modelComment;
    public function __construct(
        Question $question,
        Category $category,
        Comment $comment
    ){
        $this->middleware('auth');
        $this->modelQuestion = $question;
        $this->modelCategory = $category;
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
        $user = Auth::user();
        $categories = $this->modelCategory->getAllCategories();
        return view('question.create', compact('user', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $success = $this->modelQuestion->createQuestion($input);
        if ($success) {
            return redirect()->route('user.question')->with('success','Create Question sucessfully.');
        } else {
            return redirect()->back()->with('error','Whoops! Some error may happened. Please check again!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $questionDetail = $this->modelQuestion->getQuestionDetail($id);
        return view('question.show', compact('questionDetail'));
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
    public function destroy($id)
    {
        //
    }
}
