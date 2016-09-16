@extends('backend.admin')

@section('content')
<table width="920" border="0" align="center" cellpadding="5" cellspacing="0">
  <tr>
    <td class="col1">■メール通知システム　＞　メールの作成（確認）</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>今し方、テストメールを <span class="eng">hoge@hoge.com</span> 宛に送信しました。受信して内容を確認してください。</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><table width="100%" border="1" cellspacing="0" cellpadding="5">
      <tr>
        <td width="25%" class="col3">送信先クラス名&nbsp;<span class="f_caution">[*]</span></td>
        <td>
          <!-- class 5 -->
          @if($class5 == 1)
          ゆり組<br />
          @endif
          <!-- class 4 -->
          @if($class4 == 1)
          ひまわり組<br />
          @endif
          <!-- class 3 -->
          @if($class3 == 1)
          すみれ組<br />
          @endif
          <!-- class 2 -->
          @if($class2 == 1)
          ひなぎく組<br />
          @endif
          <!-- class 1 -->
          @if($class1 == 1)
          ちゅーりっぷ組</td>
          @endif
      </tr>
      <tr>
        <td width="25%" class="col3">宛名<span class="f_caution">&nbsp;[*]</span></td>
        <td>
          @if($mail['mail_to_kind'] == 1)
          保護者名あて
          @else
          園児名 あて
          @endif
        </td>
      </tr>
      <tr>
        <td width="25%" class="col3">差出人名&nbsp;<span class="f_caution">[*]</span></td>
        <td>{{ $mail['mail_from'] }}</td>
      </tr>
      <tr>
        <td width="25%" class="col3">差出人メールアドレス&nbsp;<span class="f_caution">[*]</span></td>
        <td>{{ $mail['mail_from_email'] }}</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td><table width="100%" border="1" cellspacing="0" cellpadding="5">
      <tr>
        <td width="25%" class="col3">タイトル&nbsp;<span class="f_caution">[*]</span></td>
        <td>{{ $mail['mail_title'] }}</td>
      </tr>
      <tr>
        <td width="25%" class="col3">本文<span class="f_caution">&nbsp;[*]</span></td>
        <td>＊＊＊＊様　<em>←1行目には上記で指定した宛名が自動で入ります</em><br />
          <br />
          {{ $mail['mail_contents'] }}
          </td>
      </tr>
      <tr>
        <td width="25%" class="col3">添付ファイル</td>
        <td>
          @if(empty($mail['mail_attached']))
          なし
          @else
          （<a href="<?php echo asset('public/uploads/' . $mail['mail_attached']); ?>" target="_blank">表示</a>）
          @endif
        </td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td align="center">
      <input type="button" onClick="location.href='{{ route('admin.mails.send') }}'" value="この内容で送信する（確認済）" />
      <input type="button" onClick="location.href='{{ route('admin.mails.forget') }}'" value="戻って修正する" />
    </td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>
@endsection