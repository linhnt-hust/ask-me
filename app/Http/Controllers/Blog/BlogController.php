<?php

namespace App\Http\Controllers\Blog;

use App\Models\Blog;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Question;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{
    protected $modelQuestion;
    protected $modelCategory;
    protected $modelComment;
    protected $modelBlog;
    public function __construct(
        Question $question,
        Category $category,
        Comment $comment,
        Blog $blog
    ){
        $this->middleware('auth');
        $this->modelQuestion = $question;
        $this->modelCategory = $category;
        $this->modelComment = $comment;
        $this->modelBlog = $blog;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('blog.index');
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
        return view('blog.create', compact('user', 'categories'));
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
        $success = $this->modelBlog->createBlog($input);
        if ($success) {
            return redirect()->route('user.blog')->with('success','Data create sucessfully.');
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
    public function destroy($id)
    {
        //
    }
}
