<!DOCTYPE html>
<html lang="{{$language_code}}">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@lang('howto.title') | Wamojiya</title>
    <link rel="stylesheet" href="{{ asset('/assets/css/common/tachyons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/css/common/drawer.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/css/common/font.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/css/common/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/assets/css/howto.css') }}">
  </head>
  <body>
    <div class="container" id="top">
      <main class="main" role="main">
        <div class="inner">
          <h1 class="tc">@lang('howto.main_title')</h1>
          <p>@lang('howto.description')</p>
          <ul class="list flex-l flex-wrap-l justify-between-l list-howto">
            <li>@lang('howto.sample1')<img src="{{ asset('/assets/images/howto/Tattoo sticker.PNG') }}" alt=""></li>
            <li>@lang('howto.sample2')<img src="{{ asset('/assets/images/howto/T-shirt.PNG') }}" alt=""></li>
            <li>@lang('howto.sample3')<img src="{{ asset('/assets/images/howto/Printing on a bag of chopsticks.PNG') }}" alt=""></li>
          </ul>
          <p>@lang('howto.description1')<br>@lang('howto.infomation')
            <a href="@lang('howto.url')" target="_blank">@lang('howto.contactus')</a>
          </p>
          <p>@lang('howto.wamoji_sample')</p>
          <p class="tc"><a class="btn btn-forward" href="/sample/">@lang('howto.button_sample')</a></p>
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