<?php namespace App\Http\Models;

use DB;

class MailModel
{

    protected $table = 't_mail';

    public function Rules()
    {
    	return array(
    		'mail_sentclass'    => 'required',
            'mail_to_kind'      => 'required',
            'mail_from'         => 'required',
            'mail_from_email'   => 'required|email',
            'mail_title'        => 'required',
            'mail_contents'     => 'required',
            'mail_attached'     => 'mimes:csv,txt,pdf,jpeg,png,jpg,gif,bmp',
		);
    }

    public function Messages()
    {
    	return array(
            'mail_sentclass.required'   => '※必須',
            'mail_to_kind.required'     => '※必須',
            'mail_from.required'        => '※必須',
            'mail_from_email.required'  => '※必須',
            'mail_from_email.email'     => '※Not format email',
            'mail_title.required'       => '※必須',
            'mail_contents.required'    => '※必須',
            'mail_attached.mimes'       => '※Not format upload file csv,txt,pdf,jpeg,png,jpg,gif,bmp',
		);
    }

    public function get_all()
    {
        $results = DB::table($this->table)->orderBy('mail_sent_date', 'desc')->paginate(PAGINATION);
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

    public function get_by_id($id)
    {
        $results = DB::table($this->table)->where('mail_id', $id)->first();
        return $results;
    }

    public function update($id, $data)
    {
    	$results = DB::table($this->table)->where('mail_id', $id)->update($data);
        return $results;
    }
}