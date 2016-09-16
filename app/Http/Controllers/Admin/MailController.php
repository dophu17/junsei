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
use Mail;

use App\Http\Models\MailModel;
use App\Http\Models\StudentModel;
use App\Http\Models\MailReceiverModel;

class MailController extends AdminController
{
	public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $clsMail        = new MailModel();
        $data['mails']  = $clsMail->get_all();

    	return view('backend.mail.index', $data);
    }

    public function getRegist()
    {
        // Session::forget('status_seat');
        if(!Session::has('forget'))
        {
            Session::forget('mail_old');
        }
        Session::forget('forget');

    	return view('backend.mail.regist');
    }

    public function postRegist()
    {
        $path       = public_path() .'/uploads/';
        $file_old   = Session::get('mail_old')['mail_attached'];

    	$clsMail 	= new MailModel();
        $clsStudent = new StudentModel();
    	$inputs 	= Input::all();
        $file       = Input::file('mail_attached');

        $tmp = '';
        $tmp = $tmp . ($a = (isset($inputs['class1'])) ? 1 : 0);
        $tmp = $tmp . ($b = (isset($inputs['class2'])) ? 1 : 0);
        $tmp = $tmp . ($c = (isset($inputs['class3'])) ? 1 : 0);
        $tmp = $tmp . ($d = (isset($inputs['class4'])) ? 1 : 0);
        $tmp = $tmp . ($e = (isset($inputs['class5'])) ? 1 : 0);
        $dataInsert = array(
            'mail_sentclass'    => $tmp,
            'mail_to_kind'      => Input::get('mail_to_kind'),
            'mail_from'         => Input::get('mail_from'),
            'mail_from_email'   => Input::get('mail_from_email'),
            'test_mail'         => Input::get('test_mail'),
            'mail_title'        => Input::get('mail_title'),
            'mail_contents'     => Input::get('mail_contents'),
            'mail_attached'     => $file,

            'last_ipadrs'       => $_SERVER['REMOTE_ADDR'],
            'last_user'         => Auth::user()->id,
        );

        if($tmp == '00000')
        {
            $dataInsert['mail_sentclass'] = NULL;
        }

        $validator 	= Validator::make($dataInsert, $clsMail->Rules(), $clsMail->Messages());
        if ($validator->fails()) {
            return redirect('mail-adm/mails/regist')->withErrors($validator)->withInput();
        }

        // insert
        if(Input::hasFile('mail_attached'))
        {
            $name       = $file->getClientOriginalName();
            $extension  = $file->getClientOriginalExtension();
            $file_name  = date("Y_m_d_H_i_s") . '_' . $name;
            // $file_name  = mb_convert_encoding($file_name, "UTF-8", "Shift_JIS"); //Shift_JIS
            // $file_name  = utf8_encode($file_name);
            // $file_name  = html_entity_decode(htmlentities($file_name, ENT_QUOTES, 'UTF-8'));
            // $file_name_upload = iconv("utf-8", "Shift_JIS", $file_name);
            // $file_name_upload = chr(255) . chr(254) . mb_convert_encoding($file_name, 'UTF-16LE', 'UTF-8');
            $file_name_upload = mb_convert_encoding($file_name, 'SJIS', 'auto');
            $file->move($path, $file_name_upload);
            $dataInsert['mail_attached'] = $file_name;
        }

        $file_old = iconv("utf-8", "Shift_JIS", $file_old);
        if(file_exists($path . $file_old))
        {
            File::Delete($path . $file_old);
        }
        Session::forget('mail_old');

        Session::put('mail_old', $dataInsert);

        // send to test mail
        $mail_old           = Session::get('mail_old');
        
        // $mail_old['receiver_name']      = ($mail_old['mail_to_kind'] == 1) ? $student->s_parents : $student->s_name;
        $mail_old['file']               = public_path() .'/uploads/' . iconv("utf-8", "Shift_JIS", $mail_old['mail_attached']);
        $mail_old['file_name']          = $mail_old['mail_attached'];

        // mail to test
        if(isset($mail_old['test_mail']) && !empty($mail_old['test_mail']))
        {
            Mail::send('backend.mail.to_test', array('mail_old' => $mail_old), function($message) use ($mail_old){
                if(!empty($mail_old['mail_attached']))
                {
                    $message->attach($mail_old['file'], array('as' => $mail_old['file_name']));
                }
                $message->from($mail_old['mail_from_email'], $mail_old['mail_from']);
                $message->to($mail_old['test_mail'])->subject($mail_old['mail_title']);
            });
        }

        return redirect()->route('admin.mails.regist.check');
    }

    /**
     * 
     */
    public function regist_check()
    {
        $clsMail        = new MailModel();
        $mail           = Session::get('mail_old');

        $data['mail']   = $mail;
        $data['class1'] = $mail['mail_sentclass'][0];
        $data['class2'] = $mail['mail_sentclass'][1];
        $data['class3'] = $mail['mail_sentclass'][2];
        $data['class4'] = $mail['mail_sentclass'][3];
        $data['class5'] = $mail['mail_sentclass'][4];

        return view('backend.mail.regist_check', $data);
    }

    public function send()
    {
        $clsMail            = new MailModel();
        $clsStudent         = new StudentModel();
        $clsMailReceiver    = new MailReceiverModel();
        $mail_old           = Session::get('mail_old');

        // insert to TABLE MAIL
        $dataInsert = array(
            'mail_sentclass'    => $mail_old['mail_sentclass'],
            'mail_to_kind'      => $mail_old['mail_to_kind'],
            'mail_from'         => $mail_old['mail_from'],
            'mail_from_email'   => $mail_old['mail_from_email'],
            'mail_title'        => $mail_old['mail_title'],
            'mail_contents'     => $mail_old['mail_contents'],
            'mail_attached'     => $mail_old['mail_attached'],

            'last_ipadrs'       => $_SERVER['REMOTE_ADDR'],
            'last_user'         => Auth::user()->id,
        );
        $mail_id = $clsMail->insert_get_id($dataInsert);
        
        // insert to TABLE MAIL RECEIVER
        // $mail = $clsMail->get_by_id($mail_id);
        $mail_sentclass = $mail_old['mail_sentclass'];
        $s_class            = $this->arr_class($mail_sentclass);

        $students = $clsStudent->get_by_class_flg($s_class);
        if(!empty($students) && count($students) > 0)
        {
            foreach($students as $student)
            {
                // insert database to TABLE T_MAIL_RECEIVER
                $dataInsert = array(
                    'mail_id'           => $mail_id,
                    's_id'              => $student->s_id,
                    'receiver_name'     => ($mail_old['mail_to_kind'] == 1) ? $student->s_parents : $student->s_name,
                    'receiver_email'    => $student->s_email,

                    'last_ipadrs'       => $_SERVER['REMOTE_ADDR'],
                    'last_user'         => Auth::user()->id,
                );
                $clsMailReceiver->insert($dataInsert);

                $mail_old['s_email']            = $student->s_email;
                // receiver name
                if($mail_old['mail_to_kind'] == 1)
                {
                    $mail_old['receiver_name'] = $student->s_parents . '保護者あて';
                }
                else
                {
                    if($student->s_sex == 1)
                    {
                        $mail_old['receiver_name'] = $student->s_name . '園児あて' . '(男)';
                    }
                    else
                    {
                        $mail_old['receiver_name'] = $student->s_name . '園児あて' . '(女)';
                    }
                }
                // $mail_old['receiver_name']      = ($mail_old['mail_to_kind'] == 1) ? $student->s_parents : $student->s_name;
                $mail_old['file']               = public_path() .'/uploads/' . iconv("utf-8", "Shift_JIS", $mail_old['mail_attached']);
                $mail_old['file_name']          = $mail_old['mail_attached'];
                // mail to list student
                Mail::send('backend.mail.to_guest', array('mail_old' => $mail_old), function($message) use ($mail_old){
                    if(!empty($mail_old['mail_attached']))
                    {
                        $message->attach($mail_old['file'], array('as' => $mail_old['file_name']));
                    }
                    $message->from($mail_old['mail_from_email'], $mail_old['mail_from']);
                    $message->to($mail_old['s_email'])->subject($mail_old['mail_title']);
                });
            }
        }

        //destroy session
        Session::forget('mail_old');

        return redirect()->route('admin.menus.index');
    }

    public function getView($id)
    {
        $clsMail        = new MailModel();
        $data['mail']   = $clsMail->get_by_id($id);

        return view('backend.mail.view', $data);
    }

    public function sentlist($id)
    {
        $clsMailReceiver    = new MailReceiverModel();
        $clsStudent         = new StudentModel();
        $send_lists         = $clsMailReceiver->get_by_mail($id);
        $data['mail_id']    = $id;
        $data['send_lists'] = $send_lists;     

        return view('backend.mail.sentlist', $data);
    }

    public function forget()
    {
        Session::put('forget', 1);

        return redirect()->route('admin.mails.regist');
    }

    /**
     * return array class
     * ex: 11001 => array(1,2,5)
     */
    public function arr_class($arr = array())
    {
        $s_class = array();
        if($arr[0] == 1)
        {
            $s_class[] = 1;
        }
        if($arr[1] == 1)
        {
            $s_class[] = 2;
        }
        if($arr[2] == 1)
        {
            $s_class[] = 3;
        }
        if($arr[3] == 1)
        {
            $s_class[] = 4;
        }
        if($arr[4] == 1)
        {
            $s_class[] = 5;
        }

        return $s_class;
    }
}