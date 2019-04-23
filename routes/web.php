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
});

Auth::routes();

Route::resource('profile', 'User\ProfileController');

Route::resource('question', 'Question\QuestionController');

Route::resource('comment', 'Comment\CommentController');

Route::post('/reply/store', 'Comment\CommentController@replyStore')->name('reply.add');

Route::group(['prefix' => '/admin'], function (){
   Route::get('/','Admin\AdminController@index')->name('admin.index');
   Route::get('/question', 'Admin\Admincontroller@getQuestionToApprove')->name('admin.question');
   Route::get('/question/detail/{id}','Admin\Admincontroller@detailQuestionApprove')->name('admin.question.detail');
   Route::post('/question/verify', 'Admin\AdminController@verifyQuestion')->name('admin.question.verify');
});

