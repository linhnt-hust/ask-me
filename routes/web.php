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
    Route::post('/vote', 'Question\QuestionController@voteQuestionPoll')->name('user.poll.vote');
    Route::get('/question/close/{id}', 'User\UserController@closeQuestion')->name('user.question.close');
    Route::get('/question/reopen/{id}', 'User\UserController@reopenQuestion')->name('user.question.reopen');
});

Auth::routes();

Route::get('login/{provider}', 'Auth\AuthController@redirectToProvider');
Route::get('{provider}/callback', 'Auth\AuthController@handleProviderCallback');

Route::resource('profile', 'User\ProfileController');

Route::resource('question', 'Question\QuestionController');

Route::resource('comment', 'Comment\CommentController');

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
});

