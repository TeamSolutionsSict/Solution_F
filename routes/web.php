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

Route::get('check-vote-post-count/{id}',['as'=>'get.check-vote-post-count','uses'=>'pageController@getCheckVoteCount']);
//coment vote dcm
Route::get('vote-comment/{id}',['as'=>'get.vote-comment','uses'=>'pageController@getVoteComment']);
Route::get('down-vote-comment/{id}',['as'=>'get.down-vote-comment','uses'=>'pageController@getDownVoteComment']);
Route::get('check-vote-comment/{id}',['as'=>'get.check-vote-comment','uses'=>'pageController@getCheckVoteComment']);

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
Route::get('home-more/{mode}/{offset}',['as'=>'get.HomeMore','uses'=>'pageController@getLoadMoreHome']);

Route::group(['prefix' => 'user', 'middleware' => 'userMiddleware'], function() {
	//Profile của người đang đăng nhập
	Route::get('profile/{id}',['as' => 'get.Profile','uses' => 'profileController@getProfile']);
	Route::post('edit-profile/{id}',['as' => 'post.EditProfile','uses' => 'profileController@postEditProfile']);
});
//Login
Route::post('login',['as' => 'post.Login', 'uses' => 'LoginController@postLogin']);
Route::get('logout',['as' => 'get.Logout', 'uses' => 'LoginController@getLogout']);
//search casi nhej 
Route::get('search/{key}', ['as'=>'get.Search', 'uses'=>'pageController@Search']);
