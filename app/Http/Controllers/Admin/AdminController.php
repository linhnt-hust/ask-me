<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Blog;
use App\Models\BlogUploaded;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Tag;
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
    protected $modelTag;
    public function __construct(
        Question $question,
        User $user,
        Blog $blog,
        Comment $comment,
        Category $category,
        BlogUploaded $blogUploaded,
        Tag $tag
    ){
        $this->middleware('admin.auth');
        $this->modelQuestion = $question;
        $this->modelUser  = $user;
        $this->modelBlog = $blog;
        $this->modelComment = $comment;
        $this->modelCategory = $category;
        $this->modelBlogUploaded = $blogUploaded;
        $this->modelTag = $tag;
    }

    public function index()
    {
        $newUsers = $this->modelUser->getNewUser();
        return view('admin.index', compact('newUsers'));
    }

    public function showProfile()
    {
        $admin = Auth::guard('admin')->user();
        return view('admin.profile.show', compact('admin'));
    }

    public function updateProfile(Request $request)
    {
        $input = $request->all();
        $profile = Admin::find($input['id']);
        $profile->update([
            'name' => $input['name'],
            'email'=>$input['email'],
            'address' => $input['address'],
            'description' => $input['description'],
        ]);
        return response()->json($profile);
    }

    public function getQuestionToApprove()
    {
        $questions = $this->modelQuestion->getQuestionToApprove();
        $totalComments = $this->modelComment->getTotalComment();
        $totalCategories =  $this->modelCategory->getAllCategories();
        $verified = $this->modelQuestion->getRecentQuestions();
        $topCategory = $this->modelCategory->getMostQuestionCategory();
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

    public function deleteUser(Request $request)
    {
        $user = User::find($request['user_id']);
        $user->delete();
        return response()->json($user);
    }

    public function searchUser(Request $request)
    {
        $input = $request->all();
        $users = $this->modelUser->searchUser($input);
        $output = "";
        if ($users)
            foreach ($users as $user)
            {
                $output .= '<tr id="deleteItem_'.$user->id.'">
                            <td>
                                <img src="/avatar/users/'.$user->avatar.'" alt="contact-img" title="contact-img" class="img-circle thumb-sm" />
                            </td>

                            <td>
                                '.$user->name.'
                            </td>

                            <td>
                                <a href="#">'.$user->email.'</a>
                            </td>

                            <td>
                                '. $user->userQuestions->count() .'
                            </td>
                            <td>
                                '. $user->userBlogs->count() .'
                            </td>
                            <td>
                                '. $user->userComments->count() .'
                            </td>
                            <td>
                                '. $user->created_at .'
                            </td>
                            <td>
                                <a href="#" class="table-action-btn h3"><i class="mdi mdi-pencil-box-outline text-success"></i></a>
                                <a href="#" class="table-action-btn h3 delete-modal" data-toggle="modal" data-target=".bs-example-modal-lg" data-id = " '. $user->id .'"><i class="mdi mdi-close-box-outline text-danger"></i></a>
                            </td>
                        </tr>';
            }
        return Response($output);
    }

    public function oldestUser(Request $request)
    {
        $oldUsers = $this->modelUser->getOldUser();
        $output = "";
        if ($oldUsers)
            foreach ($oldUsers as $user)
            {
                $output .= '<tr id="deleteItem_'.$user->id.'">
                            <td>
                                <img src="/avatar/users/'.$user->avatar.'" alt="contact-img" title="contact-img" class="img-circle thumb-sm" />
                            </td>

                            <td>
                                '.$user->name.'
                            </td>

                            <td>
                                <a href="#">'.$user->email.'</a>
                            </td>

                            <td>
                                '. $user->userQuestions->count() .'
                            </td>
                            <td>
                                '. $user->userBlogs->count() .'
                            </td>
                            <td>
                                '. $user->userComments->count() .'
                            </td>
                            <td>
                                '. $user->created_at .'
                            </td>
                            <td>
                                <a href="#" class="table-action-btn h3"><i class="mdi mdi-pencil-box-outline text-success"></i></a>
                                <a href="#" class="table-action-btn h3 delete-modal" data-toggle="modal" data-target=".bs-example-modal-lg" data-id = " '. $user->id .'"><i class="mdi mdi-close-box-outline text-danger"></i></a>
                            </td>
                        </tr>';
            }
        return Response($output);
    }

    public function newestUser(Request $request)
    {
        $oldUsers = $this->modelUser->getNewUser();
        $output = "";
        if ($oldUsers)
            foreach ($oldUsers as $user)
            {
                $output .= '<tr id="deleteItem_'.$user->id.'">
                            <td>
                                <img src="/avatar/users/'.$user->avatar.'" alt="contact-img" title="contact-img" class="img-circle thumb-sm" />
                            </td>

                            <td>
                                '.$user->name.'
                            </td>

                            <td>
                                <a href="#">'.$user->email.'</a>
                            </td>

                            <td>
                                '. $user->userQuestions->count() .'
                            </td>
                            <td>
                                '. $user->userBlogs->count() .'
                            </td>
                            <td>
                                '. $user->userComments->count() .'
                            </td>
                            <td>
                                '. $user->created_at .'
                            </td>
                            <td>
                                <a href="#" class="table-action-btn h3"><i class="mdi mdi-pencil-box-outline text-success"></i></a>
                                <a href="#" class="table-action-btn h3 delete-modal" data-toggle="modal" data-target=".bs-example-modal-lg" data-id = " '. $user->id .'"><i class="mdi mdi-close-box-outline text-danger"></i></a>
                            </td>
                        </tr>';
            }
        return Response($output);
    }

    public function mostQuestionUser(Request $request)
    {
        $oldUsers = $this->modelUser->getMostQuestionsUser();
        $output = "";
        if ($oldUsers)
            foreach ($oldUsers as $user)
            {
                $output .= '<tr id="deleteItem_'.$user->id.'">
                            <td>
                                <img src="/avatar/users/'.$user->avatar.'" alt="contact-img" title="contact-img" class="img-circle thumb-sm" />
                            </td>

                            <td>
                                '.$user->name.'
                            </td>

                            <td>
                                <a href="#">'.$user->email.'</a>
                            </td>

                            <td>
                                '. $user->userQuestions->count() .'
                            </td>
                            <td>
                                '. $user->userBlogs->count() .'
                            </td>
                            <td>
                                '. $user->userComments->count() .'
                            </td>
                            <td>
                                '. $user->created_at .'
                            </td>
                            <td>
                                <a href="#" class="table-action-btn h3"><i class="mdi mdi-pencil-box-outline text-success"></i></a>
                                <a href="#" class="table-action-btn h3 delete-modal" data-toggle="modal" data-target=".bs-example-modal-lg" data-id = " '. $user->id .'"><i class="mdi mdi-close-box-outline text-danger"></i></a>
                            </td>
                        </tr>';
            }
        return Response($output);
    }

    public function mostBlogUser(Request $request)
    {
        $oldUsers = $this->modelUser->getMostBlogsUser();
        $output = "";
        if ($oldUsers)
            foreach ($oldUsers as $user)
            {
                $output .= '<tr id="deleteItem_'.$user->id.'">
                            <td>
                                <img src="/avatar/users/'.$user->avatar.'" alt="contact-img" title="contact-img" class="img-circle thumb-sm" />
                            </td>

                            <td>
                                '.$user->name.'
                            </td>

                            <td>
                                <a href="#">'.$user->email.'</a>
                            </td>

                            <td>
                                '. $user->userQuestions->count() .'
                            </td>
                            <td>
                                '. $user->userBlogs->count() .'
                            </td>
                            <td>
                                '. $user->userComments->count() .'
                            </td>
                            <td>
                                '. $user->created_at .'
                            </td>
                            <td>
                                <a href="#" class="table-action-btn h3"><i class="mdi mdi-pencil-box-outline text-success"></i></a>
                                <a href="#" class="table-action-btn h3 delete-modal" data-toggle="modal" data-target=".bs-example-modal-lg" data-id = " '. $user->id .'"><i class="mdi mdi-close-box-outline text-danger"></i></a>
                            </td>
                        </tr>';
            }
        return Response($output);
    }

    public function mostCommentUser(Request $request)
    {
        $oldUsers = $this->modelUser->getMostCommentsUser();
        $output = "";
        if ($oldUsers)
            foreach ($oldUsers as $user)
            {
                $output .= '<tr id="deleteItem_'.$user->id.'">
                            <td>
                                <img src="/avatar/users/'.$user->avatar.'" alt="contact-img" title="contact-img" class="img-circle thumb-sm" />
                            </td>

                            <td>
                                '.$user->name.'
                            </td>

                            <td>
                                <a href="#">'.$user->email.'</a>
                            </td>

                            <td>
                                '. $user->userQuestions->count() .'
                            </td>
                            <td>
                                '. $user->userBlogs->count() .'
                            </td>
                            <td>
                                '. $user->userComments->count() .'
                            </td>
                            <td>
                                '. $user->created_at .'
                            </td>
                            <td>
                                <a href="#" class="table-action-btn h3"><i class="mdi mdi-pencil-box-outline text-success"></i></a>
                                <a href="#" class="table-action-btn h3 delete-modal" data-toggle="modal" data-target=".bs-example-modal-lg" data-id = " '. $user->id .'"><i class="mdi mdi-close-box-outline text-danger"></i></a>
                            </td>
                        </tr>';
            }
        return Response($output);
    }

    public function getCategoriesList()
    {
        $categories = $this->modelCategory->getRecentCategories();
        return view('admin.category.index', compact('categories'));
    }

    public function deleteCategory(Request $request)
    {
        $category = Category::find($request['category_id']);
        $category->delete();
        return response()->json($category);
    }

    public function searchCategory(Request $request)
    {
        $input = $request->all();
        $categories = $this->modelCategory->searchCategory($input);
        $output = "";
        if ($categories)
            foreach ($categories as $key => $category)
            {
                $output .= '<tr id="deleteItem_'.$category->id.'">
                            <td>
                                '.$category->id.'
                            </td>

                            <td>
                                '.$category->name_category.'
                            </td>

                            <td>
                                '. $category->countQuestionByCategory($category->id).'
                            </td>
                            <td>
                                '. $category->blog->count() .'
                            </td>
                            <td>
                                '. $category->created_at .'
                            </td>
                            <td>
                                <a href="#" class="table-action-btn h3 edit-modal" data-toggle="modal" data-target="#con-close-modal-edit" data-id = "'.$category->id.'" data-name="'.$category->name_category.'"><i class="mdi mdi-pencil-box-outline text-success"></i></a>
                                <a href="#" class="table-action-btn h3 delete-modal" data-toggle="modal" data-target=".bs-example-modal-lg" data-id = " '. $category->id .'"><i class="mdi mdi-close-box-outline text-danger"></i></a>
                            </td>
                        </tr>';
            }
        return Response($output);
    }

    public function addCategory(Request $request)
    {
        $input = $request->all();
        $category = Category::create($input);
        $output = "";
        $output .= '<tr id="deleteItem_'.$category->id.'">
                            <td>
                                '.$category->id.'
                            </td>

                            <td>
                                '.$category->name_category.'
                            </td>

                            <td>
                                '. $category->countQuestionByCategory($category->id).'
                            </td>
                            <td>
                                '. $category->blog->count() .'
                            </td>
                            <td>
                                '. $category->created_at.'
                            </td>
                            <td>
                                <a href="#" class="table-action-btn h3 edit-modal" data-toggle="modal" data-target="#con-close-modal-edit" data-id = "'.$category->id.'" data-name="'.$category->name_category.'"><i class="mdi mdi-pencil-box-outline text-success"></i></a>
                                <a href="#" class="table-action-btn h3 delete-modal" data-toggle="modal" data-target=".bs-example-modal-lg" data-id = " '. $category->id .'"><i class="mdi mdi-close-box-outline text-danger"></i></a>
                            </td>
                        </tr>';
        return response()->json($output);
    }

    public function updateCategory(Request $request)
    {
        $input = $request->all();
        $category = Category::find($input['id']);
        $category->update(['name_category' => $input['name_category']]);
        $output = "";
        $output .= '<tr id="deleteItem_'.$category->id.'">
                            <td>
                                '.$category->id.'
                            </td>

                            <td>
                                '.$category->name_category.'
                            </td>

                            <td>
                                '. $category->countQuestionByCategory($category->id).'
                            </td>
                            <td>
                                '. $category->blog->count() .'
                            </td>
                            <td>
                                '. $category->created_at.'
                            </td>
                            <td>
                                <a href="#" class="table-action-btn h3 edit-modal" data-toggle="modal" data-target="#con-close-modal-edit" data-id = "'.$category->id.'" data-name="'.$category->name_category.'"><i class="mdi mdi-pencil-box-outline text-success"></i></a>
                                <a href="#" class="table-action-btn h3 delete-modal" data-toggle="modal" data-target=".bs-example-modal-lg" data-id = " '. $category->id .'"><i class="mdi mdi-close-box-outline text-danger"></i></a>
                            </td>
                        </tr>';
        return response()->json(['id' => $category->id, 'output'=>$output]);
    }

    public function newestCategory(Request $request)
    {
        $newCategories= $this->modelCategory->getNewCategory();
        $output = "";
        if ($newCategories)
            foreach ($newCategories as $category)
            {
                $output .= '<tr id="deleteItem_'.$category->id.'">
                            <td>
                                '.$category->id.'
                            </td>

                            <td>
                                '.$category->name_category.'
                            </td>

                            <td>
                                '. $category->countQuestionByCategory($category->id).'
                            </td>
                            <td>
                                '. $category->blog->count() .'
                            </td>
                            <td>
                                '. $category->created_at .'
                            </td>
                            <td>
                                <a href="#" class="table-action-btn h3 edit-modal" data-toggle="modal" data-target="#con-close-modal-edit" data-id = "'.$category->id.'" data-name="'.$category->name_category.'"><i class="mdi mdi-pencil-box-outline text-success"></i></a>
                                <a href="#" class="table-action-btn h3 delete-modal" data-toggle="modal" data-target=".bs-example-modal-lg" data-id = " '. $category->id .'"><i class="mdi mdi-close-box-outline text-danger"></i></a>
                            </td>
                        </tr>';
            }
        return response()->json($output);
    }

    public function oldestCategory(Request $request)
    {
        $oldCategories= $this->modelCategory->getOldCategory();
        $output = "";
        if ($oldCategories)
            foreach ($oldCategories as $category)
            {
                $output .= '<tr id="deleteItem_'.$category->id.'">
                            <td>
                                '.$category->id.'
                            </td>

                            <td>
                                '.$category->name_category.'
                            </td>

                            <td>
                                '. $category->countQuestionByCategory($category->id).'
                            </td>
                            <td>
                                '. $category->blog->count() .'
                            </td>
                            <td>
                                '. $category->created_at .'
                            </td>
                            <td>
                                <a href="#" class="table-action-btn h3 edit-modal" data-toggle="modal" data-target="#con-close-modal-edit" data-id = "'.$category->id.'" data-name="'.$category->name_category.'"><i class="mdi mdi-pencil-box-outline text-success"></i></a>
                                <a href="#" class="table-action-btn h3 delete-modal" data-toggle="modal" data-target=".bs-example-modal-lg" data-id = " '. $category->id .'"><i class="mdi mdi-close-box-outline text-danger"></i></a>
                            </td>
                        </tr>';
            }
        return Response()->json($output);
    }

    public function mostQuestionCategory(Request $request)
    {
        $mostQuestions= $this->modelCategory->getMostQuestionCategory();
        $output = "";
        if ($mostQuestions)
            foreach ($mostQuestions as $category)
            {
                $output .= '<tr id="deleteItem_'.$category->id.'">
                            <td>
                                '.$category->id.'
                            </td>

                            <td>
                                '.$category->name_category.'
                            </td>

                            <td>
                                '. $category->countQuestionByCategory($category->id).'
                            </td>
                            <td>
                                '. $category->blog->count() .'
                            </td>
                            <td>
                                '. $category->created_at .'
                            </td>
                            <td>
                                <a href="#" class="table-action-btn h3 edit-modal" data-toggle="modal" data-target="#con-close-modal-edit" data-id = "'.$category->id.'" data-name="'.$category->name_category.'"><i class="mdi mdi-pencil-box-outline text-success"></i></a>
                                <a href="#" class="table-action-btn h3 delete-modal" data-toggle="modal" data-target=".bs-example-modal-lg" data-id = " '. $category->id .'"><i class="mdi mdi-close-box-outline text-danger"></i></a>
                            </td>
                        </tr>';
            }
        return response()->json($output);
    }

    public function mostBlogCategory(Request $request)
    {
        $mostBlogs= $this->modelCategory->getMostBlogCategory();
        $output = "";
        if ($mostBlogs)
            foreach ($mostBlogs as $category)
            {
                $output .= '<tr id="deleteItem_'.$category->id.'">
                            <td>
                                '.$category->id.'
                            </td>

                            <td>
                                '.$category->name_category.'
                            </td>

                            <td>
                                '. $category->countQuestionByCategory($category->id).'
                            </td>
                            <td>
                                '. $category->blog->count() .'
                            </td>
                            <td>
                                '. $category->created_at .'
                            </td>
                            <td>
                                <a href="#" class="table-action-btn h3 edit-modal" data-toggle="modal" data-target="#con-close-modal-edit" data-id = "'.$category->id.'" data-name="'.$category->name_category.'"><i class="mdi mdi-pencil-box-outline text-success"></i></a>
                                <a href="#" class="table-action-btn h3 delete-modal" data-toggle="modal" data-target=".bs-example-modal-lg" data-id = " '. $category->id .'"><i class="mdi mdi-close-box-outline text-danger"></i></a>
                            </td>
                        </tr>';
            }
        return response()->json($output);
    }

    public function getTagsList()
    {
        $tags = $this->modelTag->getTagList();
        return view('admin.tag.index', compact('tags'));
    }

    public function deleteTag(Request $request)
    {
        $tag = Tag::find($request['tag_id']);
        $tag->delete();
        return response()->json($tag);
    }

    public function updateTag(Request $request)
    {
        $input = $request->all();
        $tag = Tag::find($input['id']);
        $tag->update(['name_tag' => $input['name_tag']]);
        $output = "";
        $output .= '<tr id="deleteItem_'.$tag->id.'">
                            <td>
                                '.$tag->id.'
                            </td>

                            <td>
                                '.$tag->name_tag.'
                            </td>

                            <td>
                                '. $tag->question->count().'
                            </td>
                            <td>
                                '. $tag->created_at.'
                            </td>
                            <td>
                                <a href="#" class="table-action-btn h3 edit-modal" data-toggle="modal" data-target="#con-close-modal-edit-tag" data-id = "'.$tag->id.'" data-name="'.$tag->name_tag.'"><i class="mdi mdi-pencil-box-outline text-success"></i></a>
                                <a href="#" class="table-action-btn h3 delete-modal" data-toggle="modal" data-target=".bs-example-modal-lg" data-id = " '. $tag->id .'"><i class="mdi mdi-close-box-outline text-danger"></i></a>
                            </td>
                        </tr>';
        return response()->json(['id' => $tag->id, 'output'=>$output]);
    }

    public function searchTag(Request $request)
    {
        $input = $request->all();
        $tags = $this->modelTag->searchTag($input);
        $output = "";
        if ($tags)
            foreach ($tags as $key => $tag)
            {
                $output .= '<tr id="deleteItem_'.$tag->id.'">
                            <td>
                                '.$tag->id.'
                            </td>

                            <td>
                                '.$tag->name_tag.'
                            </td>

                            <td>
                                '. $tag->question->count().'
                            </td>
                            <td>
                                '. $tag->created_at .'
                            </td>
                            <td>
                                <a href="#" class="table-action-btn h3 edit-modal" data-toggle="modal" data-target="#con-close-modal-edit-tag" data-id = "'.$tag->id.'" data-name="'.$tag->name_tag.'"><i class="mdi mdi-pencil-box-outline text-success"></i></a>
                                <a href="#" class="table-action-btn h3 delete-modal" data-toggle="modal" data-target=".bs-example-modal-lg" data-id = " '. $tag->id .'"><i class="mdi mdi-close-box-outline text-danger"></i></a>
                            </td>
                        </tr>';
            }
        return Response($output);
    }

    public function addTag(Request $request)
    {
        $input = $request->all();
        $tag = Tag::create($input);
        $output = "";
        $output .= '<tr id="deleteItem_'.$tag->id.'">
                            <td>
                                '.$tag->id.'
                            </td>

                            <td>
                                '.$tag->name_tag.'
                            </td>

                            <td>
                                '. $tag->question->count().'
                            </td>
                            <td>
                                '. $tag->created_at.'
                            </td>
                            <td>
                                <a href="#" class="table-action-btn h3 edit-modal" data-toggle="modal" data-target="#con-close-modal-edit-tag" data-id = "'.$tag->id.'" data-name="'.$tag->name_tag.'"><i class="mdi mdi-pencil-box-outline text-success"></i></a>
                                <a href="#" class="table-action-btn h3 delete-modal" data-toggle="modal" data-target=".bs-example-modal-lg" data-id = " '. $tag->id .'"><i class="mdi mdi-close-box-outline text-danger"></i></a>
                            </td>
                        </tr>';
        return response()->json($output);
    }

    public function newestTag(Request $request)
    {
        $newTags = $this->modelTag->getNewTag();
        $output = "";
        if ($newTags)
            foreach ($newTags as $tag)
            {
                $output .= '<tr id="deleteItem_'.$tag->id.'">
                            <td>
                                '.$tag->id.'
                            </td>

                            <td>
                                '.$tag->name_tag.'
                            </td>

                            <td>
                                '. $tag->question->count().'
                            </td>
                            <td>
                                '. $tag->created_at .'
                            </td>
                            <td>
                                <a href="#" class="table-action-btn h3 edit-modal" data-toggle="modal" data-target="#con-close-modal-edit-tag" data-id = "'.$tag->id.'" data-name="'.$tag->name_tag.'"><i class="mdi mdi-pencil-box-outline text-success"></i></a>
                                <a href="#" class="table-action-btn h3 delete-modal" data-toggle="modal" data-target=".bs-example-modal-lg" data-id = " '. $tag->id .'"><i class="mdi mdi-close-box-outline text-danger"></i></a>
                            </td>
                        </tr>';
            }
        return Response($output);
    }

    public function oldestTag(Request $request)
    {
        $oldTags = $this->modelTag->getOldestTag();
        $output = "";
        if ($oldTags)
            foreach ($oldTags as $tag)
            {
                $output .= '<tr id="deleteItem_'.$tag->id.'">
                            <td>
                                '.$tag->id.'
                            </td>

                            <td>
                                '.$tag->name_tag.'
                            </td>

                            <td>
                                '. $tag->question->count().'
                            </td>
                            <td>
                                '. $tag->created_at .'
                            </td>
                            <td>
                                <a href="#" class="table-action-btn h3 edit-modal" data-toggle="modal" data-target="#con-close-modal-edit-tag" data-id = "'.$tag->id.'" data-name="'.$tag->name_tag.'"><i class="mdi mdi-pencil-box-outline text-success"></i></a>
                                <a href="#" class="table-action-btn h3 delete-modal" data-toggle="modal" data-target=".bs-example-modal-lg" data-id = " '. $tag->id .'"><i class="mdi mdi-close-box-outline text-danger"></i></a>
                            </td>
                        </tr>';
            }
        return Response($output);
    }

    public function mostQuestionTag(Request $request)
    {
        $tags = $this->modelTag->getMostQuestionsTag();
        $output = "";
        if ($tags)
            foreach ($tags as $tag)
            {
                $output .= '<tr id="deleteItem_'.$tag->id.'">
                            <td>
                                '.$tag->id.'
                            </td>

                            <td>
                                '.$tag->name_tag.'
                            </td>

                            <td>
                                '. $tag->question->count().'
                            </td>
                            <td>
                                '. $tag->created_at .'
                            </td>
                            <td>
                                <a href="#" class="table-action-btn h3 edit-modal" data-toggle="modal" data-target="#con-close-modal-edit-tag" data-id = "'.$tag->id.'" data-name="'.$tag->name_tag.'"><i class="mdi mdi-pencil-box-outline text-success"></i></a>
                                <a href="#" class="table-action-btn h3 delete-modal" data-toggle="modal" data-target=".bs-example-modal-lg" data-id = " '. $tag->id .'"><i class="mdi mdi-close-box-outline text-danger"></i></a>
                            </td>
                        </tr>';
            }
        return Response($output);
    }
}
