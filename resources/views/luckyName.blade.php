<!DOCTYPE html>
<html lang="{{$language_code}}">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@lang('luckyName.title') | Wamojiya</title>
    <link rel="stylesheet" href="{{ asset('/assets/css/common/tachyons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/css/common/drawer.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/css/common/font.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/css/common/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/assets/css/luckyName.css') }}">
    <script>
      var errorMessageName = '{{$errorMessageName}}';
      var errorMessageKana = '{{$errorMessageKana}}';
      var $uri = '{{$uri}}';
    </script>
  </head>
  <body class="drawer drawer--top drawer--navbarTopGutter">
    <div class="container" id="top">
      @include('header')
      <main class="main" role="main">
        <div class="inner">
          <h1 class="tc">@lang('luckyName.main_title')</h1>
          <p class="tc-l">@lang('luckyName.description')</p>
          <form id="convert" class="convert_form" action="." method="POST">
            {{ csrf_field() }}
            <input type="hidden" name="url" = value="{{$url}}">
            <input type="hidden" name="uri" = value="{{$uri}}">
            <input type="hidden" name="auth" = value="{{$auth}}">
            <ul class="list list-gender">
              <li>
                <label for="gender-m" onclick="">
                  <input id="gender-m" type="radio" name="gender" value="m">@lang('luckyName.gender_male')
                </label>
              </li>
              <li>
                <label for="gender-f" onclick="">
                  <input id="gender-f" type="radio" name="gender" value="f">@lang('luckyName.gender_female')
                </label>
              </li>
              <li>
                <label for="gender-n" onclick="">
                  <input id="gender-n" type="radio" name="gender" value="">@lang('luckyName.gender_unanswered')
                </label>
              </li>
            </ul>
            <ul class="list flex justify-center list-switch__type" id="js-switchType">
              <li><a class="current" id="select_type_name" href="#type-name">@lang('luckyName.type_name')</a></li>
              <li><a id="select_type_kana" href="#type-kana">@lang('luckyName.type_kana')</a></li>
            </ul>
            <div class="form-group__convert" id="type-convert">
              <div class="db" id="type-name">
                <div class="flex justify-center">
                  <input class="input-convert__text" type="text" name="c_name" placeholder="@lang('luckyName.placeholder_name')" maxlength="20" inputmode="latin">
                  <div class="dn" id="mic-name">
                    <img class="db input-convert__mic_off" src="{{ asset('/assets/images/micOff.png') }}" id='micIconOff'>
                    <img class="dn input-convert__mic_on" src="{{ asset('/assets/images/micOn.png') }}" id='micIconOn'>
                  </div>
                  <input class="input-convert__type" type="hidden" name="input_type" value="en">
                  <input class="btn-convert" type="submit" value="@lang('luckyName.button_convert')">
                </div>
                <div class="flex justify-center">
                  <p class="dn" id="select-name">
                  <select size='3' id='select-name-candidate'>
                    <option id='select-name-candidate1'></option>
                    <option id='select-name-candidate2'></option>
                    <option id='select-name-candidate3'></option>
                  </select>
                  </p>
                </div>
              </div>
              <div class="dn" id="type-kana">
                <div class="flex justify-center">
                  <input class="input-convert__text" type="text" name="c_name" placeholder="@lang('luckyName.placeholder_kana')" maxlength="20" inputmode="katakana">
                  <div class="dn" id="mic-kana">
                    <img class="db input-convert__mic_off" src="{{ asset('/assets/images/micOff.png') }}" id='micIconOff'>
                    <img class="dn input-convert__mic_on" src="{{ asset('/assets/images/micOn.png') }}" id='micIconOn'>
                  </div>
                  <input class="input-convert__type" type="hidden" name="input_type" value="ja">
                  <input class="btn-convert" type="submit" value="@lang('luckyName.button_convert')">
               </div>
               <div class="flex justify-center">
                  <p class="dn" id="select-kana">
                    <select size='3' id='select-kana-candidate'>
                      <option id='select-kana-candidate1'></option>
                      <option id='select-kana-candidate2'></option>
                      <option id='select-kana-candidate3'></option>
                    </select>
                  </p>
                </div>
              </div>
            </div>
            <input type="hidden" id="inputName" name="inputName" value="">
            <input type="hidden" id="inputType" name="inputType" value="en">
            <input type="hidden" id="convertResult" name="convertResult" value="">
            <input type="hidden" id="convertType" name="convertType" value="">
            <input type="hidden" id="language" name="language" value="en">
            <input type="hidden" id="max_length" name="max_length" value="{{$max_length}}">
            <input type="hidden" id="start_time" name="start_time" value="{{$start_time}}">
          </form>
          <p class="tc"><small class="gray">@lang('luckyName.convert_comment', ['length' => $max_length])</small></p>
          <div class="dn alert alert-danger error-message" id="js-showError">
            <ul class="list-error">
              <li><span class="alert-message"></span></li>
            </ul>
          </div>
          <div class="dn alertarea alert-danger error-message" id="js-showError">
            <ul class="list-error">
              <li><span class="alert-message"></span></li>
            </ul>
          </div>
          <div class="dn" id="js-result">
            <h1 class="tc">@lang('luckyName.convert_result')</h1>
            <p class="tc">@lang('luckyName.wamoji_result')</p>
            <ul class="list flex-l justify-between-l list-wamoji">
              <li class="result-hiragana__value"><span>@lang('luckyName.hiragana')</span><strong class="wf-ipaexmincho"></strong></li>
              <li class="result-katakana__value"><span>@lang('luckyName.katakana')</span><strong class="wf-ipaexmincho"></strong></li>
              <li class="result-kanji__value"><span>@lang('luckyName.kanji')</span><strong class="wf-ipaexmincho"></strong></li>
            </ul>
            <p class="tc"><a class="btn btn-forward" href="javascript:void(0);">@lang('luckyName.button_next')</a></p>
          </div>
          <div class="tc"><a class="btn btn-back" href="javascript:void(0);">@lang('luckyName.button_back')</a></div>
        </div>
      </main>
      @include('footer')
      <div class="loading-overlay" id="js-loadingOverlay">
        <div class="loader"></div>
      </div>
      <script src="//code.jquery.com/jquery-3.3.1.min.js"></script>
      <script src="{{ asset('/assets/js/common/jquery.easing.1.4.1.js') }}"></script>
      <script src="{{ asset('/assets/js/common/jquery.textchange.js') }}"></script>
      <script src="{{ asset('/assets/js/common/iscroll.js') }}"></script>
      <script src="{{ asset('/assets/js/common/drawer.min.js') }}"></script>
      <script src="{{ asset('/assets/js/common/common.js') }}"></script>
      <script src="{{ asset('/assets/js/luckyName.js') }}"></script>
      <script src="{{ asset('/assets/js/check.js') }}"></script>
      <script src="{{ asset('/assets/js/voice/speechRecognition.js') }}"></script>
    </div>
  </body>
</html>
