<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'User\UserController@userHome')->name('home');

Route::group(['prefix' => '/user'], function (){
    Route::get('/question', 'User\UserController@userQuestion')->name('user.question');
    Route::get('/question/detail/{id}', 'User\UserController@questionDetail')->name('user.question.detail');
    Route::get('/blog', 'User\UserController@userBlog')->name('user.blog');
    Route::get('/blog/detail/{id}', 'User\UserController@blogDetail')->name('user.blog.detail');
    Route::post('/vote', 'Question\QuestionController@voteQuestionPoll')->name('user.poll.vote');
    Route::get('/question/close/{id}', 'User\UserController@closeQuestion')->name('user.question.close');
    Route::get('/question/reopen/{id}', 'User\UserController@reopenQuestion')->name('user.question.reopen');
    Route::post('/search', 'User\UserController@search')->name('user.search');
    Route::get('/contract', 'User\UserController@contract')->name('contract');
    Route::post('/feedback', 'User\UserController@feedback')->name('feedback');
});

Auth::routes();

Route::get('login/{provider}', 'Auth\AuthController@redirectToProvider');
Route::get('{provider}/callback', 'Auth\AuthController@handleProviderCallback');

Route::resource('profile', 'User\ProfileController');

Route::resource('question', 'Question\QuestionController');


Route::post('/tag', 'Question\QuestionController@tagGenerate')->name('tag.generate');
Route::get('/single/question', 'Question\QuestionController@getQuestionSingle')->name('question.single');
Route::get('/poll/question', 'Question\QuestionController@getQuestionPoll')->name('question.poll');
Route::get('/category/question', 'Question\QuestionController@questionCategory')->name('question.category');
Route::post('/report/question', 'Question\QuestionController@reportQuestion')->name('question.report');

Route::get('/category/detail/{id}', 'Question\QuestionController@questionCategoryDetail')->name('question.category.detail');

Route::post('/category/search', 'Question\QuestionController@searchCategory')->name('category.search');

Route::resource('comment', 'Comment\CommentController');
Route::post('comment/storeBlog', 'Comment\CommentController@storeBlog')->name('comment.storeBlog');

Route::post('comment/delete', 'Comment\CommentController@delete')->name('comment.delete');
Route::post('comment/upvote', 'Comment\CommentController@upvote')->name('comment.upvote');
Route::post('comment/downvote', 'Comment\CommentController@downvote')->name('comment.downvote');

Route::post('/follow', 'Question\QuestionController@follow')->name('question.follow');
Route::post('/unfollow', 'Question\QuestionController@unfollow')->name('question.unfollow');

Route::resource('blog','Blog\BlogController');

Route::post('/reply/store', 'Comment\CommentController@replyStore')->name('reply.add');

Route::group(['prefix' => '/admin', 'namespace' => 'Admin'], function (){
    Route::get('/', 'Auth\LoginController@showLoginForm')->name('admin.login');
    Route::get('/index','AdminController@index')->name('admin.index');
    Route::post('/login', 'Auth\LoginController@login');
    Route::post('logout', 'Auth\LoginController@logout')->name('admin.logout');
    Route::get('/profile', 'AdminController@showProfile')->name('admin.profile');
    Route::get('/profile/{id}/edit', 'AdminController@editProfile')->name('admin.profile.edit');
    Route::post('/profile/update', 'AdminController@updateProfile')->name('admin.profile.update');
    Route::get('register', 'Auth\RegisterController@showRegistrationForm');
    Route::post('register', 'Auth\RegisterController@register')->name('admin.register');
    Route::get('/question', 'Admincontroller@getQuestionToApprove')->name('admin.question');
    Route::get('/question/detail/{id}','Admincontroller@detailQuestionApprove')->name('admin.question.detail');
    Route::post('/question/verify', 'AdminController@verifyQuestion')->name('admin.question.verify');
    Route::get('/blog', 'Admincontroller@getBlogToApprove')->name('admin.blog');
    Route::get('/blog/detail/{id}','Admincontroller@detailBlogApprove')->name('admin.blog.detail');
    Route::post('/blog/verify', 'AdminController@verifyBlog')->name('admin.blog.verify');
    Route::post('/delete/question/','AdminController@deleteQuestion' )->name('admin.delete.question');
    Route::post('/blog/question/','AdminController@deleteBlog' )->name('admin.delete.blog');
    Route::post('/delete/user','AdminController@deleteUser' )->name('admin.delete.user');
    Route::post('/search/user','AdminController@searchUser' )->name('user.search');
    Route::post('/sort/user/oldest','AdminController@oldestUser' )->name('sort.user.oldest');
    Route::post('/sort/user/newest','AdminController@newestUser' )->name('sort.user.newest');
    Route::post('/sort/user/mostQuestion','AdminController@mostQuestionUser' )->name('sort.user.mostQuestion');
    Route::post('/sort/user/mostBlog','AdminController@mostBlogUser' )->name('sort.user.mostBlog');
    Route::post('/sort/user/mostComment','AdminController@mostCommentUser' )->name('sort.user.mostComment');
    Route::get('/category', 'Admincontroller@getCategoriesList')->name('admin.category');
    Route::post('/delete/category','AdminController@deleteCategory' )->name('admin.delete.category');
    Route::post('/search/category','AdminController@searchCategory' )->name('admin.category.search');
    Route::post('/add/category','AdminController@addCategory' )->name('admin.add.category');
    Route::post('/update/category','AdminController@updateCategory' )->name('admin.update.category');
    Route::post('/sort/category/newest','AdminController@newestCategory' )->name('sort.category.newest');
    Route::post('/sort/category/oldest','AdminController@oldestCategory' )->name('sort.category.oldest');
    Route::post('/sort/category/mostQuestion','AdminController@mostQuestionCategory' )->name('sort.category.mostQuestion');
    Route::post('/sort/category/mostBlog','AdminController@mostBlogCategory' )->name('sort.category.mostBlog');

    Route::get('/tag', 'Admincontroller@getTagsList')->name('admin.tag');
    Route::post('/delete/tag','AdminController@deleteTag' )->name('admin.delete.tag');
    Route::post('/update/tag','AdminController@updateTag' )->name('admin.update.tag');
    Route::post('/search/tag','AdminController@searchTag' )->name('admin.tag.search');
    Route::post('/add/tag','AdminController@addTag' )->name('admin.add.tag');
    Route::post('/sort/tag/newest','AdminController@newestTag' )->name('sort.tag.newest');
    Route::post('/sort/tag/oldest','AdminController@oldestTag' )->name('sort.tag.oldest');
    Route::post('/sort/tag/mostQuestion','AdminController@mostQuestionTag' )->name('sort.tag.mostQuestion');


});

