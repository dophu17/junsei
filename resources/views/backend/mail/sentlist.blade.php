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
      <tr class="col3">
        <td align="center">送信先クラス名</td>
        <td align="center">受取人名</td>
        <td align="center">メールアドレス</td>
      </tr>

      @if(empty($send_lists) && count($send_lists) ==0)
      <tr><td colspan="3"><h3 align="center">Sent list empty...</h3></td></tr>
      @else
        @foreach($send_lists as $send_list)
        <tr>
          <td>
            @if($send_list->s_class == 5)
              ゆり組
            @endif
            @if($send_list->s_class == 4)
              ひまわり組
            @endif
            @if($send_list->s_class == 3)
              すみれ組
            @endif
            @if($send_list->s_class == 2)
              ひなぎく組
            @endif
            @if($send_list->s_class == 1)
              ちゅーりっぷ組
            @endif
          </td>
          <td>
            {{ $send_list->receiver_name }}
            <?php 
            if($send_list->mail_to_kind == 1)
            {
              echo '保護者あて';
            }
            else
            {
              echo '園児あて';
              if($send_list->s_sex == 1)
              {
                echo ' (男)';
              }
              else
              {
                echo ' (女)';
              }
            }
            ?>
          </td>
          <td class="eng">{{ $send_list->receiver_email }}</td>
        </tr>
        @endforeach
      @endif
      
    </table></td>
  </tr>
  <tr>
    <td align="center"><input type="button" onClick="location.href='{{ route('admin.mails.view', $mail_id) }}'" value="送信済みメール詳細に戻る" /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>
@endsection