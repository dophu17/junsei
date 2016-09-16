<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>メール通知システム | 順正保育園</title>
<link href="{{ asset('') }}/public/backend/common/css/style.css" rel="stylesheet" type="text/css" />
</head>

<body>

{!! Form::open(array('route' => 'admin.login', 'method' => 'post')) !!}
<table width="920" border="0" align="center" cellpadding="5" cellspacing="0">
  <tr>
    <td class="col1">■メール通知システム　＞　ログイン</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="center"><table width="60%" border="1" cellspacing="0" cellpadding="5">
      <tr>
        <td width="35%" class="col3">ログインID</td>
        <td><input type="text" name="username" id="username" value="{{ old('username') }}" /><span class="error-input"> @if ($errors->first('username')) {!! $errors->first('username') !!} @endif </span></td>
      </tr>
      <tr>
        <td width="35%" class="col3">パスワード</td>
        <td><input type="password" name="password" id="password" /><span class="error-input"> @if ($errors->first('password')) {!! $errors->first('password') !!} @endif </span></td>
      </tr>
      @if (Session::has('error'))
      <tr>
        <td colspan="2" align="center"><span class="error-input">{{ Session::get('error') }}</span></td>
      </tr>
      @endif
    </table></td>
  </tr>
  <tr>
    <td align="center"><input type="submit" value="ログイン" /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>
{!! Form::close() !!}

</body>
</html>
