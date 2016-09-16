@extends('backend.admin')

@section('content')
<table width="920" border="0" align="center" cellpadding="5" cellspacing="0">
  <tr>
    <td class="col1">■メール通知システム　＞　管理者メニュー</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td class="col3">▼メール作成・送信・履歴</td>
  </tr>
  <tr>
    <td>　●<a href="{{ asset('mail-adm/mails/regist') }}">メール作成・送信</a></td>
  </tr>
  <tr>
    <td>　●<a href="{{ route('admin.mails.index') }}">メール送信履歴の表示</a></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td class="col3">▼名簿管理</td>
  </tr>
  <tr>
    <td>　●<a href="{{ route('admin.student.index') }}">メールアドレス・名前の管理</a></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>
@endsection
