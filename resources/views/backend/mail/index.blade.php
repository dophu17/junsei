@extends('backend.admin')

@section('content')
<table width="920" border="0" align="center" cellpadding="5" cellspacing="0">
  <tr>
    <td class="col1">■メール通知システム　＞　送信済みメールの一覧</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><table width="100%" border="1" cellspacing="0" cellpadding="5">
      <tr class="col3">
        <td width="18%" align="center">送信日時</td>
        <td width="15%" align="center">送信先クラス</td>
        <td width="12%" align="center">宛名</td>
        <td align="center">タイトル</td>
        <td width="1%" align="center">参照</td>
      </tr>

      @if(empty($mails) || count($mails) == 0)
      <tr><td colspan="5"><h3 align="center">Mails empty...</h3></td></tr>
      @else
        @foreach($mails as $mail)
        <tr>
          <td><?php echo date('Y/m/d H:i:s', strtotime($mail->mail_sent_date)); ?></td>
          <td>
            @if($mail->mail_sentclass[4] == 1)
              ゆり組<br />
            @endif
            @if($mail->mail_sentclass[3] == 1)
              ひまわり組<br />
            @endif
            @if($mail->mail_sentclass[2] == 1)
              すみれ組<br />
            @endif
            @if($mail->mail_sentclass[1] == 1)
              ひなぎく組<br />
            @endif
            @if($mail->mail_sentclass[0] == 1)
              ちゅーりっぷ組
            @endif
          </td>
          <td><?php echo ($mail->mail_to_kind == 1) ? '保護者あて' : '園児あて'; ?></td>
          <td>{{ $mail->mail_title }}</td>
          <td><input type="button" onClick="location.href='{{ route('admin.mails.view', $mail->mail_id) }}'" value="参照" /></td>
        </tr>
        @endforeach
      @endif
      
    </table></td>
  </tr>
  <tr>
    <td align="center">
      @include('backend.pagination.custom', ['paginator' => $mails])
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>
@endsection