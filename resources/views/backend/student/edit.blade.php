@extends('backend.admin')

@section('content')
{!! Form::open(array('url' => 'mail-adm/students/edit/' . $student->s_id, 'method' => 'post')) !!}
<table width="920" border="0" align="center" cellpadding="5" cellspacing="0">
  <tr>
    <td class="col1">■メール通知システム　＞　メールアドレス・名前の新規登録</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><table width="100%" border="1" cellspacing="0" cellpadding="5">
      <tr>
        <td width="25%" class="col3">クラス名&nbsp;<span class="f_caution">[*]</span></td>
        <td><select name="s_class" id="s_class">
          <option value="5" @if($student->s_class == 5) {{'selected'}} @endif >ゆり組</option>
          <option value="4" @if($student->s_class == 4) {{'selected'}} @endif>ひまわり組</option>
          <option value="3" @if($student->s_class == 3) {{'selected'}} @endif>すみれ組</option>
          <option value="2" @if($student->s_class == 2) {{'selected'}} @endif>ひなぎく組</option>
          <option value="1" @if($student->s_class == 1) {{'selected'}} @endif>ちゅーりっぷ組</option>
        </select>
        @if ($errors->first('s_class'))<span class="error-input">{!! $errors->first('s_class') !!}</span>@endif
        </td>
      </tr>
      <tr>
        <td width="25%" class="col3">園児名&nbsp;<span class="f_caution">[*]</span></td>
        <td><input type="text" name="s_name" id="s_name" value="{{ $student->s_name }}" />
          <input type="radio" name="s_sex" value="1" @if($student->s_sex == 1) {{'checked'}} @endif />
          男　　　
          <input type="radio" name="s_sex" value="2" @if($student->s_sex == 2) {{'checked'}} @endif />
          女
          @if ($errors->first('s_name'))<span class="error-input">{!! $errors->first('s_name') !!}</span>@endif
          @if ($errors->first('s_sex'))<span class="error-input">{!! $errors->first('s_sex') !!}</span>@endif
        </td>
      </tr>
      <tr>
        <td class="col3">園児名よみ&nbsp;<span class="f_caution">[*]</span></td>
        <td>
          <input type="text" name="s_name_kana" id="s_name_kana" value="{{ $student->s_name_kana }}" />
          @if ($errors->first('s_name_kana'))<span class="error-input">{!! $errors->first('s_name_kana') !!}</span>@endif
        </td>
      </tr>
      <tr>
        <td width="25%" class="col3">保護者名&nbsp;<span class="f_caution">[*]</span></td>
        <td>
          <input type="text" name="s_parents" id="s_parents" value="{{ $student->s_parents }}" />
          @if ($errors->first('s_parents'))<span class="error-input">{!! $errors->first('s_parents') !!}</span>@endif
        </td>
      </tr>
      <tr>
        <td width="25%" class="col3">メールアドレス&nbsp;<span class="f_caution">[*]</span></td>
        <td>
          <input name="s_email" type="text" id="s_email" size="50" value="{{ $student->s_email }}" />
          @if ($errors->first('s_email'))<span class="error-input">{!! $errors->first('s_email') !!}</span>@endif
        </td>
      </tr>
      <tr>
        <td width="25%" class="col3">有効／無効</td>
        <td>
          <input type="checkbox" name="s_tmp_flg" id="s_tmp_flg" value="1" @if($student->s_tmp_flg == 1) {{'checked'}} @endif />
          一時的にメールを送信しない
        </td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td align="center">
      <input type="submit" name="save" value="登録する" />
      <input type="button" name="delete" id="delete" value="削除" data-modal-id="popup1" />
      <!-- popup -->
      <div id="popup1" class="modal-box">
        <div class="header"><a href="#" class="js-modal-close close">×</a>
          <h3>Delete</h3>
        </div>
        <div class="modal-body">
          <p align="center">Are you sure to delete?</p>
        </div>
        <div class="footer"> <a href="{{ route('admin.student.delete', $student->s_id) }}" class="btn btn-small">Delete</a> <a href="#" class="btn btn-small js-modal-close">Close</a> </div>
      </div>
      <!-- end popup -->
    </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="center"><input type="button" onClick="location.href='{{ route('admin.student.index') }}'" value="登録済みメールアドレス一覧へ" /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>
{!! Form::close() !!}
@endsection