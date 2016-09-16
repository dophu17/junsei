@extends('backend.admin')

@section('content')
<?php $sentclass = Session::get('sentclass'); ?>
<table width="920" border="0" align="center" cellpadding="5" cellspacing="0">
  <tr>
    <td class="col1">■メール通知システム　＞　登録済み名簿の一覧</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><table width="100%" border="1" cellspacing="0" cellpadding="5">
      <tr>
        <td width="25%" class="col3">クラス名</td>
        <td>
          {!! Form::open(array('url' => 'mail-adm/students', 'method' => 'get')) !!}
          <select name="sentclass" id="sentclass">
            <option value="5" @if($sentclass == 5) {{'selected'}} @endif >ゆり組</option>
            <option value="4" @if($sentclass == 4) {{'selected'}} @endif >ひまわり組</option>
            <option value="3" @if($sentclass == 3) {{'selected'}} @endif >すみれ組</option>
            <option value="2" @if($sentclass == 2) {{'selected'}} @endif >ひなぎく組</option>
            <option value="1" @if($sentclass == 1) {{'selected'}} @endif >ちゅーりっぷ組</option>
          </select>
          <input type="submit" name="" id="search" value="表示" />
          {!! Form::close() !!}
        </td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="right"><input type="button" onClick="location.href='{{ route('admin.student.regist') }}'" value="新規登録" /></td>
  </tr>
  <tr>
    <td><table width="100%" border="1" cellspacing="0" cellpadding="5">
      <tr class="col3">
        <td width="1%" align="center">削除</td>
        <td width="10%" align="center" nowrap="nowrap">有効／無効</td>
        <td align="center">園児名</td>
        <td align="center">保護者名</td>
        <td align="center">メールアドレス</td>
        <td width="1%" align="center">編集</td>
      </tr>

      @if(empty($students) && count($students) == 0)
      <tr><td colspan="6"><h3 align="center">Student empty...</h3></td></tr>
      @else
        @foreach($students as $student)
        <tr>
          <td>
            <input type="button" name="delete" id="delete" value="削除" data-modal-id="popup{{ $student->s_id }}" />
            <!-- popup -->
            <div id="popup{{ $student->s_id }}" class="modal-box">
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
          <td align="center">
            @if($student->s_tmp_flg == 1)
            <span class="f_blue">×</span>
            @else
            <span class="f_red">○</span>
            @endif
          </td>
          <td>{{ $student->s_name }}</td>
          <td>{{ $student->s_parents }}</td>
          <td class="eng">{{ $student->s_email }}</td>
          <td><input type="button" onClick="location.href='{{ route('admin.student.edit', array($student->s_id)) }}'" value="編集" /></td>
        </tr>
        @endforeach
      @endif
      
    </table></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>

@endsection