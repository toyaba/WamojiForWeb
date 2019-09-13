<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@lang('sample.title') | Wamojiya</title>
    <link rel="stylesheet" href="{{ asset('/assets/css/common/tachyons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/css/common/drawer.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/css/common/font.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/css/common/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/assets/css/sample.css') }}">
  </head>
  <body>
    <div class="container" id="top">
      <main class="main" role="main">
        <div class="inner">
          <h1 class="tc">@lang('sample.main_title')</h1>
          <p>@lang('sample.description')</p>
          <ul class="list flex-l flex-wrap-l justify-between-l list-sample">
            <li><img src="{{ asset('/assets/images/sample/Sample1.PNG') }}" alt=""></li>
            <li><img src="{{ asset('/assets/images/sample/Sample2.PNG') }}" alt=""></li>
            <li><img src="{{ asset('/assets/images/sample/Sample3.PNG') }}" alt=""></li>
          </ul>
          <p>@lang('sample.caution')</p>
          <p>@lang('sample.for_howto')</p>
          <p class="tc"><a class="btn btn-forward" href="/howto/">@lang('sample.button_howto')</a></p>
        </div>
      </main>
      @include('footer')
      <script src="//code.jquery.com/jquery-3.3.1.min.js"></script>
      <script src="{{ asset('/assets/js/common/jquery.easing.1.4.1.js') }}"></script>
      <script src="{{ asset('/assets/js/common/iscroll.js') }}"></script>
      <script src="{{ asset('/assets/js/common/drawer.min.js') }}"></script>
      <script src="{{ asset('/assets/js/common/common.js') }}"></script>
    </div>
  </body>
</html>