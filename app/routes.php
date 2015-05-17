<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/login','UserController@getLogin');
Route::post('/login','UserController@postLogin');
Route::get('/register','UserController@getRegister');
Route::post('/register','UserController@postRegister');
Route::get('/logout','UserController@getLogout');
Route::post('check-username','UserController@check_username');
Route::post('check-email','UserController@check_email');
Route::get('/',function ()
{
    return Redirect::to('/login');
});
Route::post('post/create','PostController@store');
Route::get('post/index','PostController@index');
//API for post Controller
Route::resource('post','PostController');
//API for User Controller
Route::controller('user','UserController');
Route::resource('user','UserController');
Route::get('user','UserController@index');
Route::group(array('prefix'=>'{username}'),function()
{
    Route::get("/","PostController@getIndex");
    Route::get("/post/index","PostController@getIndex");
    Route::controller('backend', 'AdminController');
    Route::resource('post','PostController');
});
Route::group(array('prefix'=>'api'),function(){
    Route::resource('comments','CommentController');
});
// Route::filter('check-user',function(){
// 	if(Session::has('user')){
// 		$username = Session::get('username');
// 		if(Session[])
// 		return Redirect::to('')
// 	}
// });
// Route::group(['prefix' => $us'admin', 'before' => 'auth'], function () {
Route::get('{username}/admin', array('before' => 'check_admin', 'as' => 'user.admin', 'uses' => 'HomeController@useradmin' ))->where(array( 'username' => '[a-zA-Z0-9-_]+'));
Route::filter('check_admin', function() {
	$username = Request::segment(1); // Lay thong tin user tren Param
	if( !User::check_logged($username) ) {
		return Redirect::route('user.page', array('username' => $username));
		//die('Nothing to do');
	}
});
Route::get('/backend','AdminController@getDashBoard');
Route::controller('/backend', 'AdminController');
Route::resource("post.comments",'PostCommentController');
Route::controller('/post','PostController');
//App::missing(function($exception) {
//    return View::make('index');
//});
Route::get('login/fb','LoginFacebookController@login');
Route::get('login/fb/appId','LoginFacebookController@callback');