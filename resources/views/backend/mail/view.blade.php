@extends('backend.admin')

@section('content')
<table width="920" border="0" align="center" cellpadding="5" cellspacing="0">
  <tr>
    <td class="col1">■メール通知システム　＞　送信済みメールの詳細</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><table width="100%" border="1" cellspacing="0" cellpadding="5">
      <tr>
        <td class="col3">送信日時</td>
        <td>{{ $mail->mail_sent_date }}</td>
      </tr>
      <tr>
        <td width="25%" class="col3">送信先クラス名</td>
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
      </tr>
      <tr>
        <td width="25%" class="col3">宛名</td>
        <td><?php echo ($mail->mail_to_kind == 1) ? '保護者名あて' : '園児名あて'; ?>　　　
          <input type="button" onClick="location.href='{{ route('admin.mails.sentlist', $mail->mail_id) }}'" value="送信済みメールアドレス一覧を表示" /></td>
      </tr>
      <tr>
        <td width="25%" class="col3">差出人名</td>
        <td>{{ $mail->mail_from }}</td>
      </tr>
      <tr>
        <td width="25%" class="col3">差出人メールアドレス</td>
        <td>{{ $mail->mail_from_email }}</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td><table width="100%" border="1" cellspacing="0" cellpadding="5">
      <tr>
        <td width="25%" class="col3">タイトル</td>
        <td>{{ $mail->mail_title }}</td>
      </tr>
      <tr>
        <td width="25%" class="col3">本文</td>
        <td>＊＊＊＊様（＊＊＊＊くん／ちゃん）　←1行目には上記で指定した宛名が自動で入ります<br />
          <br />
          {!! $mail->mail_title !!}
        </td>
      </tr>
      <tr>
        <td width="25%" class="col3">添付ファイル</td>
        <td>
          @if(empty($mail->mail_attached))
          なし
          @else
          （<a href="<?php echo asset('uploads/' . $mail->mail_attached); ?>" target="_blank">表示</a>）
          @endif
        </td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td align="center"><input type="button" onClick="location.href='{{ route('admin.mails.index') }}'" value="送信済みメール一覧に戻る" /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>
@endsection