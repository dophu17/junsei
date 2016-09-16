<?php namespace App\Http\Models;

use DB;

class StudentModel
{

    protected $table = 't_student';

    public function Rules()
    {
    	return array(
    		's_class'       => 'required',
            's_name'        => 'required',
            's_sex'         => 'required',
            's_name_kana'   => 'required|regex:/^[\x{3041}-\x{3096}]+$/u',
            's_parents'     => 'required',
            's_email'       => 'required|email',
		);
    }

    public function Messages()
    {
    	return array(
            's_class.required'      => '※必須',
            's_name.required'       => '※必須',
            's_sex.required'        => '※必須',
            's_name_kana.required'  => '※必須',
            's_name_kana.regex'     => '※Not format kana',
            's_parents.required'    => '※必須',
            's_email.required'      => '※必須',
            's_email.email'         => '※Not format email',
		);
    }

    public function get_all($sentclass)
    {
        $db = DB::table($this->table)->where('last_kind', '<>', DELETE);

        if(!empty($sentclass))
        {
            $db = $db->where('s_class', $sentclass);
        }

        $db = $db->orderBy('s_id', 'asc');
        $results = $db->get();
        return $results;
    }

    public function get_by_id($id)
    {
        $results = DB::table($this->table)->where('s_id', $id)->where('last_kind', '<>', DELETE)->first();
        return $results;
    }

    public function get_by_class_flg($s_class = array())
    {
        $results = DB::table($this->table)->whereIn('s_class', $s_class)->where('s_tmp_flg', null)->where('last_kind', '<>', DELETE)->get();
        return $results;
    }

    public function insert($data)
    {
        $results = DB::table($this->table)->insert($data);
        return $results;
    }

    public function insert_get_id($data)
    {
        $results = DB::table($this->table)->insertGetId($data);
        return $results;
    }

    public function update($id, $data)
    {
    	$results = DB::table($this->table)->where('s_id', $id)->where('last_kind', '<>', DELETE)->update($data);
        return $results;
    }
}