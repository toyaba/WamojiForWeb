<!doctype html>
<html lang="{{$language_code}}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <title>@lang('convert.title') | Wamojiya</title>
    <link rel="stylesheet" href="{{ asset('/assets/css/common/tachyons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/css/common/drawer.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/css/common/font.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/css/common/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/assets/css/convert_type.css') }}">
    <script>
      var $uri = '{{$uri}}';
    </script>
  </head>
  <body class="drawer drawer--top drawer--navbarTopGutter">
    <div class="container" id="top">
      @include('header')
      <main class="main" role="main">
        <div class="inner">
          <h1 class="tc">@lang('convert.main_title')</h1>
          <p>@lang('convert.description')</p>
        </div>
        <div class="bg-near-white">
          <div class="inner">
            <ul class="list list-type__select flex-l justify-center-l">
              <li><a class="btn_lucky_name" href="javascript:void(0);"><strong>@lang('convert.button_luckey_neme')</strong>@lang('convert.luckey_neme_description')</a></li>
              <li><a class="btn_select_kanji" href="javascript:void(0);"><strong>@lang('convert.button_kanji_select')</strong>@lang('convert.kanji_select_description')</a></li>
            </ul>
            <form class="frm_convert">
                {{ csrf_field() }}
                <input type="hidden" name="url" = value="{{$url}}">
                <input type="hidden" name="uri" = value="{{$uri}}">
                <input type="hidden" name="auth" = value="{{$auth}}">
            </form>
          </div>
        </div>
      </main>
      @include('footer')
      <script src="//code.jquery.com/jquery-3.3.1.min.js"></script>
      <script src="{{ asset('/assets/js/common/jquery.easing.1.4.1.js') }}"></script>
      <script src="{{ asset('/assets/js/common/iscroll.js') }}"></script>
      <script src="{{ asset('/assets/js/common/drawer.min.js') }}"></script>
      <script src="{{ asset('/assets/js/common/common.js') }}"></script>
      <script src="{{ asset('/assets/js/convert.js') }}"></script>
    </div>
  </body>
</html>
