@extends('backend.admin')

@section('content')
{!! Form::open(array('url' => 'mail-adm/students/regist', 'method' => 'post')) !!}
<?php $sentclass = Session::get('sentclass'); ?>
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
          @if($sentclass == 5)
          <option value="5" selected >ゆり組</option>
          @elseif(old('s_class') == 5)
          <option value="5" selected >ゆり組</option>
          @else
          <option value="5" >ゆり組</option>
          @endif
          
          @if($sentclass == 4)
          <option value="4" selected>ひまわり組</option>
          @elseif(old('s_class') == 4)
          <option value="4" selected>ひまわり組</option>
          @else
          <option value="4">ひまわり組</option>
          @endif

          @if($sentclass == 3)
          <option value="3" selected>すみれ組</option>
          @elseif(old('s_class') == 3)
          <option value="3" selected>すみれ組</option>
          @else
          <option value="3">すみれ組</option>
          @endif
          
          @if($sentclass == 2)
          <option value="2" selected>ひなぎく組</option>
          @elseif(old('s_class') == 2))
          <option value="2" selected>ひなぎく組</option>
          @else
          <option value="2">ひなぎく組</option>
          @endif
          
          @if($sentclass == 1)
          <option value="1" selected>ちゅーりっぷ組</option>
          @elseif(old('s_class') == 1))
          <option value="1" selected>ちゅーりっぷ組</option>
          @else
          <option value="1">ちゅーりっぷ組</option>
          @endif
          
        </select>
        @if ($errors->first('s_class'))<span class="error-input">{!! $errors->first('s_class') !!}</span>@endif
        </td>
      </tr>
      <tr>
        <td width="25%" class="col3">園児名&nbsp;<span class="f_caution">[*]</span></td>
        <td><input type="text" name="s_name" id="s_name" value="{{ old('s_name') }}" />
          <input type="radio" name="s_sex" value="1" @if(old('s_sex') == 1) {{'checked'}} @endif />
          男　　　
          <input type="radio" name="s_sex" value="2" @if(old('s_sex') == 2) {{'checked'}} @endif />
          女
          @if ($errors->first('s_name'))<span class="error-input">{!! $errors->first('s_name') !!}</span>@endif
          @if ($errors->first('s_sex'))<span class="error-input">{!! $errors->first('s_sex') !!}</span>@endif
        </td>
      </tr>
      <tr>
        <td class="col3">園児名よみ&nbsp;<span class="f_caution">[*]</span></td>
        <td>
          <input type="text" name="s_name_kana" id="s_name_kana" value="{{ old('s_name_kana') }}" />
          @if ($errors->first('s_name_kana'))<span class="error-input">{!! $errors->first('s_name_kana') !!}</span>@endif
        </td>
      </tr>
      <tr>
        <td width="25%" class="col3">保護者名&nbsp;<span class="f_caution">[*]</span></td>
        <td>
          <input type="text" name="s_parents" id="s_parents" value="{{ old('s_parents') }}" />
          @if ($errors->first('s_parents'))<span class="error-input">{!! $errors->first('s_parents') !!}</span>@endif
        </td>
      </tr>
      <tr>
        <td width="25%" class="col3">メールアドレス&nbsp;<span class="f_caution">[*]</span></td>
        <td>
          <input name="s_email" type="text" id="s_email" size="50" value="{{ old('s_email') }}" />
          @if ($errors->first('s_email'))<span class="error-input">{!! $errors->first('s_email') !!}</span>@endif
        </td>
      </tr>
      <tr>
        <td width="25%" class="col3">有効／無効</td>
        <td>
          <input type="checkbox" name="s_tmp_flg" id="s_tmp_flg" value="1" @if(old('s_tmp_flg') == 1) {{'checked'}} @endif />
          一時的にメールを送信しない
        </td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td align="center"><input type="submit" name="save" value="登録する" /></td>
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