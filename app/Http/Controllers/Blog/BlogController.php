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
        $blogs = $this->modelBlog->getAllBlogs();
//        dd($blogs[1]->blogUploaded[0]->filename);
        return view('blog.index', compact('blogs'));
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
        $blogDetail =  $this->modelBlog->getBlogDetail($id);
        return view('blog.show', compact('blogDetail'));
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
        $blog = $this->modelBlog->getBlogDetail($id);
//        dd($blog->blogUploaded);
        $categories = $this->modelCategory->getAllCategories();
        return view('blog.edit', compact('user', 'blog', 'categories'));
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
        $success = $this->modelBlog->updateBlog($id, $input);
        if ($success) {
            return redirect()->route('user.blog')->with('success','Edit Blog sucessfully.');
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
        $blog = Blog::findOrFail($id);
        $blog->delete();

        return response()->json($blog);
    }
}
