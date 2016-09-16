@extends('backend.admin')

@section('content')
{!! Form::open(array('url' => 'mail-adm/mails/regist', 'method' => 'post', 'files'=>true, 'accept-charset'=>'UTF-8')) !!}
<?php $confirm = Session::get('mail_old'); ?>
<table width="920" border="0" align="center" cellpadding="5" cellspacing="0">
  <tr>
    <td class="col1">■メール通知システム　＞　メールの作成</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><table width="100%" border="1" cellspacing="0" cellpadding="5">
      <tr>
        <td width="25%" class="col3">送信先クラス名&nbsp;<span class="f_caution">[*]</span></td>
        <td>
          @if(old('class5') == 5)
          <input type="checkbox" name="class5" id="class5" value="5" checked />ゆり組<br />
          @elseif($confirm['mail_sentclass'][4] == 1)
          <input type="checkbox" name="class5" id="class5" value="5" checked />ゆり組<br />
          @else
          <input type="checkbox" name="class5" id="class5" value="5" />ゆり組<br />
          @endif

          @if(old('class4') == 4)
          <input type="checkbox" name="class4" id="class4" value="4" checked />ひまわり組<br />
          @elseif($confirm['mail_sentclass'][3] == 1)
          <input type="checkbox" name="class4" id="class4" value="4" checked />ひまわり組<br />
          @else
          <input type="checkbox" name="class4" id="class4" value="4" />ひまわり組<br />
          @endif
          
          @if(old('class3') == 3)
          <input type="checkbox" name="class3" id="class3" value="3" checked />すみれ組<br />
          @elseif($confirm['mail_sentclass'][2] == 1)
          <input type="checkbox" name="class3" id="class3" value="3" checked />すみれ組<br />
          @else
          <input type="checkbox" name="class3" id="class3" value="3" />すみれ組<br />
          @endif
          
          @if(old('class2') == 2)
          <input type="checkbox" name="class2" id="class2" value="2" checked />ひなぎく組<br />
          @elseif($confirm['mail_sentclass'][1] == 1)
          <input type="checkbox" name="class2" id="class2" value="2" checked />ひなぎく組<br />
          @else
          <input type="checkbox" name="class2" id="class2" value="2" />ひなぎく組<br />
          @endif
          
          @if(old('class1') == 1)
          <input type="checkbox" name="class1" id="class1" value="1" checked />ちゅーりっぷ組<br>
          @elseif($confirm['mail_sentclass'][0] == 1)
          <input type="checkbox" name="class1" id="class1" value="1" checked />ちゅーりっぷ組<br>
          @else
          <input type="checkbox" name="class1" id="class1" value="1" />ちゅーりっぷ組<br>
          @endif
          
          <span class="error-input"> @if ($errors->first('mail_sentclass')) {!! $errors->first('mail_sentclass') !!} @endif </span>
        </td>
      </tr>
      <tr>
        <td width="25%" class="col3">宛名<span class="f_caution">&nbsp;[*]</span></td>
        <td>
          @if(old('mail_to_kind') == 1)
          <input type="radio" name="mail_to_kind" id="radio" value="1" checked />保護者名あて
          @elseif($confirm['mail_to_kind'] == 1)
          <input type="radio" name="mail_to_kind" id="radio" value="1" checked />保護者名あて
          @else
          <input type="radio" name="mail_to_kind" id="radio" value="1" />保護者名あて
          @endif

          @if(old('mail_to_kind') == 2)
          <input type="radio" name="mail_to_kind" id="radio" value="2" checked />園児名あて
          @elseif($confirm['mail_to_kind'] == 2)
          <input type="radio" name="mail_to_kind" id="radio" value="2" checked />園児名あて
          @else
          <input type="radio" name="mail_to_kind" id="radio" value="2" />園児名あて
          @endif
          <span class="error-input"> @if ($errors->first('mail_to_kind')) {!! $errors->first('mail_to_kind') !!} @endif </span>
        </td>
      </tr>
      <tr>
        <td width="25%" class="col3">差出人名&nbsp;<span class="f_caution">[*]</span></td>
        <td><input name="mail_from" type="text" id="mail_from" value="<?php echo isset($confirm['mail_from']) ? $confirm['mail_from'] : old('mail_from'); ?>" placeholder="順正保育園" /><span class="error-input"> @if ($errors->first('mail_from')) {!! $errors->first('mail_from') !!} @endif </span></td>
      </tr>
      <tr>
        <td width="25%" class="col3">差出人メールアドレス&nbsp;<span class="f_caution">[*]</span></td>
        <td><input name="mail_from_email" type="text" id="mail_from_email" size="50" value="<?php echo isset($confirm['mail_from_email']) ? $confirm['mail_from_email'] : old('mail_from_email'); ?>" /><span class="error-input"> @if ($errors->first('mail_from_email')) {!! $errors->first('mail_from_email') !!} @endif </span></td>
      </tr>
      <tr>
        <td width="25%" class="col3">テストメール送信先</td>
        <td><input name="test_mail" type="text" id="test_mail" size="50" value="<?php echo isset($confirm['test_mail']) ? $confirm['test_mail'] : old('test_mail'); ?>" /><span class="error-input"> @if ($errors->first('test_mail')) {!! $errors->first('test_mail') !!} @endif </span></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td><table width="100%" border="1" cellspacing="0" cellpadding="5">
      <tr>
        <td width="25%" class="col3">タイトル&nbsp;<span class="f_caution">[*]</span></td>
        <td><input name="mail_title" value="<?php echo isset($confirm['mail_title']) ? $confirm['mail_title'] : old('mail_title'); ?>" type="text" id="mail_title" size="50" /><span class="error-input"> @if ($errors->first('mail_title')) {!! $errors->first('mail_title') !!} @endif </span></td>
      </tr>
      <tr>
        <td width="25%" class="col3">本文<span class="f_caution">&nbsp;[*]</span></td>
        <td>＊＊＊＊様（＊＊＊＊くん／ちゃん）　←1行目には上記で指定した宛名が自動で入ります<br />
          <br />          
          <textarea name="mail_contents" cols="70" rows="10" id="mail_contents"><?php echo isset($confirm['mail_contents']) ? $confirm['mail_contents'] : old('mail_contents'); ?></textarea><span class="error-input"> @if ($errors->first('mail_contents')) {!! $errors->first('mail_contents') !!} @endif </span></td>
      </tr>
      <tr>
        <td width="25%" class="col3">添付ファイル</td>
        <td><input type="file" name="mail_attached" id="mail_attached" value="" /><span class="error-input"> @if ($errors->first('mail_attached')) {!! $errors->first('mail_attached') !!} @endif </span></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td align="center"><input type="submit" value="次へ" /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>
{!! Form::close() !!}
@endsection