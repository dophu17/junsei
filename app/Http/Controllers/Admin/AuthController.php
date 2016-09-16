<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;

use App\Http\Requests;
use Illuminate\Http\Request;
use Auth;
use Hash;
use Session;
use Form;
use Html;
use Input;
use Validator;
use URL;

class AuthController extends AdminController
{
	public function __construct()
    {

    }

    public function getLogin()
    {
    	return view('backend.auth.login');
    }

    public function postLogin()
    {
    	$inputs = Input::all();
        $rules = array(
            'username'   	=> 'required',
            'password'  	=> 'required|min:6',
        );
        $messages = array(
            'username.required'   	=> '※ログインIDを入力してください。',
            'password.required'  	=> '※パスワードを入力してください。',
        );
        $validator = Validator::make($inputs, $rules, $messages);

        if ($validator->fails()) {
            return redirect()->route('admin.login')->withErrors($validator)->withInput();
        }

        $login = array(
            'username'        => Input::get('username'),
            'password'        => Input::get('password')
        );
        if(Auth::attempt($login, false))
        {
            return redirect('mail-adm/menus');
        }
        else
        {
            Session::flash('error', 'ログインIDまたはパスワードが間違ってます。');
            return redirect()->route('admin.login')->withErrors($validator)->withInput();
        }
    }

    public function getLogout()
    {
    	Auth::logout();
        return redirect()->route('admin.login');
    }
}