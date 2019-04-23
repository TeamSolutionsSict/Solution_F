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


Route::get('home',['as'=>'get.Home','uses'=>'pageController@getHome']);

Route::get('terms',['as'=>'get.Terms','uses'=>'PostController@getTerms']);

Route::get('add-question',['as'=>'get.AddQuestion','uses'=>'PostController@getAddQuestion']);
Route::post('add-question',['as'=>'post.AddQuestion','uses'=>'PostController@postAddQuestion']);
Route::get('question-details/{id}',['as'=>'get.QuestionDetails','uses'=>'PostController@getQuestionDetails']);
Route::get('vote-post/{id}',['as'=>'get.vote-post','uses'=>'PostController@getVotePost']);
Route::get('down-vote-post/{id}',['as'=>'get.down-vote-post','uses'=>'PostController@getDownVotePost']);
Route::get('check-vote-post/{id}',['as'=>'get.check-vote-post','uses'=>'PostController@getCheckVotePost']);

//xem profile user khác
Route::get('user-detail/{id}',['as'=>'get.UserDetail','uses'=>'pageController@getUser']);
//Danh sách user
Route::get('user-list',['as'=>'get.UserList','uses'=>'userController@getListUser']);
Route::get('user-list/search',['as'=>'get.SearchUser','uses'=>'userController@getSearchUser']);

//Tags
Route::get('tag-list', ['as'=>'get.TagList', 'uses'=>'tagController@getTagList']);
Route::get('tag-list/search', ['as'=>'get.SearchTag', 'uses'=>'tagController@getSearchTag']);

//Contact
Route::get('contact',['as'=>'get.Contact','uses'=>'feedbackController@getContact']);
Route::post('contact',['as'=>'post.Contact','uses'=>'feedbackController@postContact']);
//Đăng ký (register)
Route::post('register',['as'=>'post.Register','uses'=>'pageController@postRegister']);
// Thử kiểm tra đăng ký có đúng hay không
Route::post('test',['as'=>'post.test','uses'=>'pageController@posttest']);
// CommentPost - Đức
Route::post('addComment/{id}',['as'=>'post.addComment','uses'=>'pageController@addComment']);

Route::group(['prefix' => 'user', 'middleware' => 'userMiddleware'], function() {
	//Profile của người đang đăng nhập
	Route::get('profile/{id}',['as' => 'get.Profile','uses' => 'pageController@getProfile']);
	Route::post('edit-profile/{id}',['as' => 'post.EditProfile','uses' => 'pageController@postEditProfile']);
});
//Login
Route::post('login',['as' => 'post.Login', 'uses' => 'LoginController@postLogin']);
Route::get('logout',['as' => 'get.Logout', 'uses' => 'LoginController@getLogout']);
//Reset Password
Route::post('email-reset-password',['as' => 'post.EmailResetPass', 'uses' => 'PasswordController@postEmailResetPass']);
Route::get('get-resest-password/{token}',['as' => 'get.ResetPassword', 'uses' => 'PasswordController@getResetPassword']);
Route::post('resest-password',['as' => 'post.ResetPassword', 'uses' => 'PasswordController@postResetPassword']);
