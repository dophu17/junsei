<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;
use Auth;
use Input;
use Hash;
use DB;
use Config;

class UserController extends AdminController
{
	public function __construct()
    {
        // parent::__construct();
    }

    public function index()
    {
    	$account = Config::get('constants.ACCOUNT_ADMIN');
    	$dataInsert = array(
    		'username' => $account['USERNAME'],
    		'password' => Hash::make($account['PASSWORD']),
		);

        $user = DB::table('m_user')->where('username', $account['USERNAME'])->first();
        if(empty($user))
        {
            $db = DB::table('m_user')->insert($dataInsert);
        }
        else
        {
            $db = DB::table('m_user')->where('id', $user->id)->update($dataInsert);
        }

        if($db)
        {
            return redirect()->route('admin.login');
        }
        else
        {
            echo 'Create new account fail!';
        }
    }
}