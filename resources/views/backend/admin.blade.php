<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>メール通知システム | 順正保育園</title>
<link href="{{ asset('') }}/public/backend/common/css/style.css" rel="stylesheet" type="text/css" />
</head>

<body>
<table width="100%" border="0" cellspacing="0" cellpadding="5">
  <tr>
    <td width="50%"><input type="button" onClick="location.href='{{ route('admin.menus.index') }}'" value="管理者メニューへ" /></td>
    <td width="50%" align="right"><input type="button" onClick="location.href='{{ route('admin.logout') }}'" value="ログアウト" /></td>
  </tr>
</table>
<hr noshade="noshade" />
<!-- content -->
@yield('content')
<!-- end content -->

<script src="{{ asset('') }}/public/backend/common/js/jquery.min.js"></script>
<script src="{{ asset('') }}/public/backend/common/js/dhtp-popup.jquery.js"></script>
</body>
</html>
