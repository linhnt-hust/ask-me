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
    Route::get('register', 'Auth\RegisterController@showRegistrationForm');
    Route::post('register', 'Auth\RegisterController@register')->name('admin.register');
    Route::get('/question', 'Admincontroller@getQuestionToApprove')->name('admin.question');
    Route::get('/question/detail/{id}','Admincontroller@detailQuestionApprove')->name('admin.question.detail');
    Route::post('/question/verify', 'AdminController@verifyQuestion')->name('admin.question.verify');
    Route::get('/blog', 'Admincontroller@getBlogToApprove')->name('admin.blog');
    Route::get('/blog/detail/{id}','Admincontroller@detailBlogApprove')->name('admin.blog.detail');
    Route::post('/blog/verify', 'AdminController@verifyBlog')->name('admin.blog.verify');
    Route::get('/delete/question/{id}','AdminController@deleteQuestion' )->name('admin.delete.question');
});

