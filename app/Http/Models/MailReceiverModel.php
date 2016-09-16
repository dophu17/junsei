<?php namespace App\Http\Models;

use DB;

class MailReceiverModel
{

    protected $table = 't_mail_receiver';

    public function Rules()
    {
    	return array(
    		
		);
    }

    public function Messages()
    {
    	return array(
            
		);
    }

    public function get_all()
    {
        $results = DB::table($this->table)->orderBy('receiver_id', 'desc')->get();
        return $results;
    }

    public function get_by_id($id)
    {
        $results = DB::table($this->table)->where('receiver_id', $id)->first();
        return $results;
    }

    public function get_by_mail($mail_id)
    {
        $results = DB::table($this->table)
                        ->join('t_mail', 't_mail_receiver.mail_id', '=', 't_mail.mail_id')
                        ->join('t_student', 't_mail_receiver.s_id', '=', 't_student.s_id')
                        ->select('t_mail_receiver.*', 't_student.s_class', 't_mail.mail_to_kind', 't_student.s_sex')
                        ->where('t_mail_receiver.mail_id', $mail_id)
                        ->get();
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
    	$results = DB::table($this->table)->where('receiver_id', $id)->update($data);
        return $results;
    }
}