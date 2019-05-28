<?php

namespace App\Http\Controllers\Question;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Comment;
use App\Models\FollowHistory;
use App\Models\Poll;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Question;
use Illuminate\Support\Facades\Auth;
use App\Models\PollVoteHistory;

class QuestionController extends Controller
{
    protected $modelQuestion;
    protected $modelCategory;
    protected $modelComment;
    protected $modelTag;
    protected $modelPoll;
    public function __construct(
        Question $question,
        Category $category,
        Comment $comment,
        Tag $tag,
        Poll $poll
    ){
        $this->middleware('auth');
        $this->modelQuestion = $question;
        $this->modelCategory = $category;
        $this->modelComment = $comment;
        $this->modelTag = $tag;
        $this->modelPoll = $poll;
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
        $user = Auth::user();
        $questionDetail = $this->modelQuestion->getQuestionDetail($id);
        visits($questionDetail)->increment();
        $relatedQuestions = $this->modelQuestion->getRelatedQuestion($id);
        if ($questionDetail->question_poll == 0) {
            return view('question.show', compact('questionDetail', 'user', 'relatedQuestions'));
        } else{
            $userVote = PollVoteHistory::where('user_id', $user->id)->Where('question_id', $questionDetail->id)->first();
            if ($userVote != null){
                $voted = 1;
                return view('question.show_poll', compact('questionDetail', 'user', 'voted','relatedQuestions'));
            } else {
                $voted = 0;
                return view('question.show_poll', compact('questionDetail', 'user', 'voted','relatedQuestions'));
            }
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = Auth::user();
        $question = $this->modelQuestion->getQuestionDetail($id);
        $categories = $this->modelCategory->getAllCategories();
        $tag = $question->tag->pluck('name_tag')->toArray();
        $nameTag = implode(",", $tag);
        return view('question.edit', compact('question', 'user', 'categories', 'nameTag'));
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
        $input = $request->all();
        $success = $this->modelQuestion->updateQuestion($id, $input);
        if ($success) {
            return redirect()->route('user.question')->with('success','Edit Question sucessfully.');
        } else {
            return redirect()->back()->with('error','Whoops! Some error may happened. Please check again!');
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
        $question = Question::findOrFail($id);
        $question->delete();

        return response()->json($question);
    }

    public function voteQuestionPoll(Request $request)
    {
        $input = $request->all();
        $vote = $this->modelPoll->voteQuestionPoll($input);
        if ($vote) {
            return redirect()->back()->with('success', 'Your vote has been recorded');
        } else {
            return redirect()->back()->with('error','Whoops! Some error may happened. Please check again!');
        }
    }

    public function questionCategory()
    {
        $categories = $this->modelCategory->getAllCategoriesQuestion();
        return view('question.category', compact('categories'));
    }

    public function questionCategoryDetail($id)
    {
        $questions = $this->modelQuestion->getAllQuestionbyCategory($id);
        $nameCategory = Category::where('id', $id)->value('name_category');
        return view('question.category_detail', compact('questions', 'nameCategory'));
    }

    public function searchCategory(Request $request)
    {
        $input = $request->all();
        $categories = $this->modelCategory->searchCategory($input);
        $output = "";
        if ($categories)
            foreach ($categories as $category)
            {
                $output .= '<h4 class="accordion-title" ><a href="/category/detail/'. $category->id .'" style="background-color: #5cd08d">'. $category->name_category .'</a></h4><br>';
            }
        return Response($output);
    }

    public function getQuestionSingle()
    {
        $questions = $this->modelQuestion->getQuestionSingle();
        return view('question.single', compact('questions'));
    }

    public function getQuestionPoll()
    {
        $questions = $this->modelQuestion->getQuestionPoll();
        return view('question.poll', compact('questions'));
    }

    public function reportQuestion(Request $request)
    {
        $input = $request->all();
        $success = $this->modelQuestion->reportQuestion($input);
        if ($success)
        {
            return response()->json(['success'=>'success']);
        }
    }

    public function follow(Request $request)
    {
        $input = $request->all();
        FollowHistory::create($input);
        $output = "";
        $output .='<a class="unfollow-button" onclick="unfollow_question('. $input['question_id'].', '. $input['user_id'].')" style="float: right; border: 2px solid dodgerblue ;border-radius: 5px;
                              background-color: white;
                              color: black;
                              padding: 5px 15px;
                              font-size: 11px;
                              color: dodgerblue;
                              cursor: pointer;">Unfollow</a>
                            <div class="clearfix"></div>';

        return response()->json($output);
    }

    public function unfollow(Request $request)
    {
        $input = $request->all();
        FollowHistory::where('user_id', $input['user_id'])->where('question_id', $input['question_id'])->delete();
        $userEmail = User::where('id', $input['user_id'])->pluck('email')->first();
        $output = "";
        $output .='<a class="follow-button" data-toggle="modal" data-target=".bs-example-modal-lg" data-email=" '. $userEmail .' " style="float: right; border: 2px solid dodgerblue ;border-radius: 5px;
                              background-color: white;
                              color: black;
                              padding: 5px 15px;
                              font-size: 11px;
                              color: dodgerblue;
                              cursor: pointer;"><i class="icon-ok"></i> Follow</a>
                            <div class="clearfix"></div>';

        return response()->json($output);
    }
}
