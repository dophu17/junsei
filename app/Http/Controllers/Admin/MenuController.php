<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;
use Auth;

class MenuController extends AdminController
{
	public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
    	return view('backend.menu.index');
    }
}