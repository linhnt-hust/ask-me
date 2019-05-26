<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogUploaded;
use App\Models\Category;
use App\Models\Comment;
use Auth;
use App\Models\Question;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    protected $modelQuestion;
    protected $modelUser;
    protected $modelBlog;
    protected $modelComment;
    protected $modelCategory;
    protected $modelBlogUploaded;
    public function __construct(
        Question $question,
        User $user,
        Blog $blog,
        Comment $comment,
        Category $category,
        BlogUploaded $blogUploaded
    ){
        $this->middleware('admin.auth');
        $this->modelQuestion = $question;
        $this->modelUser  = $user;
        $this->modelBlog = $blog;
        $this->modelComment = $comment;
        $this->modelCategory = $category;
        $this->modelBlogUploaded = $blogUploaded;
    }

    public function index()
    {
        $newUsers = $this->modelUser->getNewUser();
        return view('admin.index', compact('newUsers'));
    }

    public function getQuestionToApprove()
    {
        $questions = $this->modelQuestion->getQuestionToApprove();
        $totalComments = $this->modelComment->getTotalComment();
        $totalCategories =  $this->modelCategory->getAllCategories();
        $verified = $this->modelQuestion->getRecentQuestions();
        $topCategory = $this->modelQuestion->getTopCategoryQuestion();
        $mostReport = $this->modelQuestion->getMostReportQuestion();
        return view('admin.question_dashboard', compact('questions', 'totalComments', 'totalCategories', 'verified', 'topCategory', 'mostReport'));
    }

    public function detailQuestionApprove($id)
    {
        $question = $this->modelQuestion->getQuestionDetail($id);
        $categories = $this->modelCategory->getAllCategoriesQuestion();
        return view('admin.question_detail', compact('question', 'categories'));
    }

    public function verifyQuestion(Request $request)
    {
        $input = $request->all();
        $result = $this->modelQuestion->verifyQuestion($input);
        if ($result) {
            return redirect()->route('admin.question')->with('success', 'Successful save status.');
        } else {
            return redirect()->back()->with('error', 'Whoops!! Something is wrong.');
        }
    }

    public function getBlogToApprove()
    {
        $blogs = $this->modelBlog->getBlogToApprove();
        $totalComments = $this->modelComment->getTotalComment();
        $totalCategories =  $this->modelCategory->getAllCategories();
        $verified = $this->modelBlog->getVerifiedBlog();
        return view('admin.blog_dashboard', compact('blogs', 'totalComments', 'totalCategories', 'verified'));
    }

    public function detailBlogApprove($id)
    {
        $blog = $this->modelBlog->getBlogDetail($id);
        return view('admin.blog_detail', compact('blog'));
    }

    public function verifyBlog(Request $request)
    {
        $input = $request->all();
        $result = $this->modelBlog->verifyBlog($input);
        if ($result) {
            return redirect()->route('admin.blog')->with('success', 'Successful save status.');
        } else {
            return redirect()->back()->with('error', 'Whoops!! Something is wrong.');
        }
    }

    public function deleteQuestion(Request $request)
    {
        $question = Question::findOrFail($request['question_id']);
        $question->delete_reason = $request['reason'];
        $question->save();
        $question->delete();

        if (isset($question->user->email)
            && filter_var($question->user->email, FILTER_VALIDATE_EMAIL)) {
            event(new \App\Events\SendMailDeleteQuestion($question));
        }

        return response()->json($question);

    }

    public function deleteBlog(Request $request)
    {
        $blog = Blog::findOrFail($request['blog_id']);
        $blog->delete_reason = $request['reason'];
        $blog->save();
        $blog->delete();

        if (isset($blog->user->email)
            && filter_var($blog->user->email, FILTER_VALIDATE_EMAIL)) {
            event(new \App\Events\SendMailDeleteBlog($blog));
        }

        return response()->json($blog);

    }
}
