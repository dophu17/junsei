<?php namespace App\Http\Controllers;

use Auth;

class AdminController extends Controller
{
	public function __construct()
    {
    	parent::__construct();
        $this->middleware('auth');
    }
}