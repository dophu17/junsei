<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    // return view('welcome');
    return redirect()->route('admin.menus.index');
});


/**
 * mail-adm
 */
Route::group(['prefix' => 'mail-adm', 'namespace' => 'Admin'], function () 
{
	Route::get('/', function () {
        return redirect()->route('admin.menus.index');
    });

	// menu
	Route::get('menus', ['as' => 'admin.menus.index', 'uses' => 'MenuController@index']);

	// user. Using onl add new account admin
	Route::get('users', ['as' => 'admin.users.index', 'uses' => 'UserController@index']);

	// mail
	Route::get('mails', ['as' => 'admin.mails.index', 'uses' => 'MailController@index']);
	Route::get('mails/regist', ['as' => 'admin.mails.regist', 'uses' => 'MailController@getRegist']);
	Route::post('mails/regist', ['as' => 'admin.mails.regist', 'uses' => 'MailController@postRegist']);
	Route::get('mails/regist-check', ['as' => 'admin.mails.regist.check', 'uses' => 'MailController@regist_check']);
	Route::get('mails/send', ['as' => 'admin.mails.send', 'uses' => 'MailController@send']);
	Route::get('mails/view/{id}', ['as' => 'admin.mails.view', 'uses' => 'MailController@getView']);
	Route::get('mails/sentlist/{id}', ['as' => 'admin.mails.sentlist', 'uses' => 'MailController@sentlist']);
	Route::get('mails/forget', ['as' => 'admin.mails.forget', 'uses' => 'MailController@forget']);

	// student
	Route::get('students', ['as' => 'admin.student.index', 'uses' => 'StudentController@index']);
	Route::get('students/regist', ['as' => 'admin.student.regist', 'uses' => 'StudentController@getRegist']);
	Route::post('students/regist', ['as' => 'admin.student.regist', 'uses' => 'StudentController@postRegist']);
	Route::get('students/edit/{id}', ['as' => 'admin.student.edit', 'uses' => 'StudentController@getEdit']);
	Route::post('students/edit/{id}', ['as' => 'admin.student.edit', 'uses' => 'StudentController@postEdit']);
	Route::get('students/delete/{id}', ['as' => 'admin.student.delete', 'uses' => 'StudentController@delete']);


	/**
	 * auth
	 */
	Route::get('login', ['as' => 'admin.login', 'uses' => 'AuthController@getLogin']);
	Route::post('login', ['as' => 'admin.login', 'uses' => 'AuthController@postLogin']);
	Route::get('logout', ['as' => 'admin.logout', 'uses' => 'AuthController@getLogout']);
});
