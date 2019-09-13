<!DOCTYPE html>
<html lang="{{$language_code}}">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@lang('download.title') | Wamojiya</title>
    <link rel="stylesheet" href="{{ asset('/assets/css/common/tachyons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/css/common/drawer.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/css/common/font.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/css/common/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/assets/css/download.css') }}">
    @include('redirect')
    <script>
      var $uri = '{{$uri}}';
      var $uetsukeNo = '{{$uetsukeNo}}';
      var $orderNumber = '{{$orderNumber}}';
      var $zipfilename = 'WamojiyaImages.zip';
    </script>
  </head>
  <body class="drawer drawer--top drawer--navbarTopGutter">
    <div class="container" id="top">
      @include('header')
      <main class="main" role="main">
        <div class="inner">
            <p><center>@lang('download.message')</center></p>
            <p><center>@lang('download.wait_message')</center></p>
            <p><center>@lang('download.details_message')</center></p>
          <p class="tc"><a class="btn btn-forward" href="{{$url}}">@lang('download.button_top')</a></p>
        </div>
      </main>
      @include('footer')
      <script src="//code.jquery.com/jquery-3.3.1.min.js"></script>
      <script src="{{ asset('/assets/js/common/jquery.easing.1.4.1.js') }}"></script>
      <script src="{{ asset('/assets/js/common/iscroll.js') }}"></script>
      <script src="{{ asset('/assets/js/common/drawer.min.js') }}"></script>
      <script src="{{ asset('/assets/js/common/common.js') }}"></script>
      <script src="{{ asset('/assets/js/download.js') }}"></script>
    </div>
  </body>
</html>
