<!DOCTYPE html>
<html lang="{{$language_code}}">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@lang('complete.title') | Wamojiya</title>
    <link rel="stylesheet" href="{{ asset('/assets/css/common/tachyons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/css/common/drawer.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/css/common/font.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/css/common/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/assets/css/complete.css') }}">
    @include('redirect')
    <script>
      var $uri = '{{$uri}}';
    </script>
  </head>
  <body class="drawer drawer--top drawer--navbarTopGutter">
    <div class="container" id="top">
      @include('header')
      <main class="main" role="main">
        <div class="inner">
          <h1 class="tc receipt-number"><span>@lang('complete.main_title')</span>{{$uetsukeNo}}</h1>
          <p>@lang('complete.description')</p>
          <p class="tc"><a class="btn btn-forward" href="{{$url}}">@lang('complete.button_top')</a></p>
        </div>
      </main>
      @include('footer')
      <script src="//code.jquery.com/jquery-3.3.1.min.js"></script>
      <script src="{{ asset('/assets/js/common/jquery.easing.1.4.1.js') }}"></script>
      <script src="{{ asset('/assets/js/common/iscroll.js') }}"></script>
      <script src="{{ asset('/assets/js/common/drawer.min.js') }}"></script>
      <script src="{{ asset('/assets/js/common/common.js') }}"></script>
      <script src="{{ asset('/assets/js/complete.js') }}"></script>
    </div>
  </body>
</html>