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
use Config;
use File;

use App\Http\Models\StudentModel;

class StudentController extends AdminController
{
	public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $clsStudent         = new StudentModel();
        $sentclass          = Input::get('sentclass', 5);
        Session::put('sentclass', $sentclass);
        $data['students']   = $clsStudent->get_all($sentclass);

        return view('backend.student.index', $data);
    }

    public function getRegist()
    {
        return view('backend.student.regist');
    }

    public function postRegist()
    {
        $clsStudent             = new StudentModel();
        $dataInsert             = array(
            's_class'           => Input::get('s_class'),
            's_name'            => Input::get('s_name'),
            's_sex'             => Input::get('s_sex'),
            's_name_kana'       => Input::get('s_name_kana'),
            's_parents'         => Input::get('s_parents'),
            's_email'           => Input::get('s_email'),
            's_tmp_flg'         => Input::get('s_tmp_flg'),

            'last_kind'         => INSERT,
            'last_ipadrs'       => $_SERVER['REMOTE_ADDR'],
            'last_user'         => Auth::user()->id,
        );

        $validator  = Validator::make($dataInsert, $clsStudent->Rules(), $clsStudent->Messages());
        if ($validator->fails()) {
            return redirect()->route('admin.student.regist')->withErrors($validator)->withInput();
        }

        $clsStudent->insert($dataInsert);

        return redirect()->route('admin.student.index', array('sentclass' => Session::get('sentclass')));
    }

    public function getEdit($id)
    {
        $clsStudent         = new StudentModel();
        $data['student']    = $clsStudent->get_by_id($id);

        return view('backend.student.edit', $data);
    }

    public function postEdit($id)
    {
        $clsStudent             = new StudentModel();
        $dataInsert             = array(
            's_class'           => Input::get('s_class'),
            's_name'            => Input::get('s_name'),
            's_sex'             => Input::get('s_sex'),
            's_name_kana'       => Input::get('s_name_kana'),
            's_parents'         => Input::get('s_parents'),
            's_email'           => Input::get('s_email'),
            's_tmp_flg'         => Input::get('s_tmp_flg'),

            'last_kind'         => INSERT,
            'last_ipadrs'       => $_SERVER['REMOTE_ADDR'],
            'last_user'         => Auth::user()->id,
        );

        $validator  = Validator::make($dataInsert, $clsStudent->Rules(), $clsStudent->Messages());
        if ($validator->fails()) {
            return redirect()->route('admin.student.edit', $id)->withErrors($validator)->withInput();
        }

        $clsStudent->update($id, $dataInsert);

        return redirect()->route('admin.student.index', array('sentclass' => Session::get('sentclass')));
    }

    public function delete($id)
    {
        $clsStudent = new StudentModel();
        $dataUpdate = array(
            'last_kind'         => DELETE,
            'last_ipadrs'       => $_SERVER['REMOTE_ADDR'],
            'last_user'         => Auth::user()->id,
        );
        $clsStudent->update($id, $dataUpdate);

        return redirect()->route('admin.student.index', array('sentclass' => Session::get('sentclass')));
    }
}