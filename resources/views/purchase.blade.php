<!DOCTYPE html>
<html lang="{{$language_code}}">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@lang('purchase.title') | Wamojiya</title>
    <link rel="stylesheet" href="{{ asset('/assets/css/common/tachyons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/css/common/drawer.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/css/common/font.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/css/common/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/assets/css/purchase.css') }}">
    <script src="https://www.paypalobjects.com/api/checkout.js"></script>
    <script>
      var $uri = '{{$uri}}';
    </script>
  </head>
  <body class="drawer drawer--top drawer--navbarTopGutter">
    <div class="container" id="top">
      @include('header')
      <main class="main" role="main">
        <div class="inner">
          <h1 class="tc">@lang('purchase.main_title')</h1>
          <p class="tc-l">@lang('purchase.description')</p>
          <form id="purchase" class="purchase_form" action="." method="POST">
            {{ csrf_field() }}
            <input type="hidden" name="url" value="{{$url}}">
            <input type="hidden" name="uri" = value="{{$uri}}">
            <input type="hidden" name="auth" value="{{$auth}}">
            <input type="hidden" name="inputData" value="{{$inputData}}">
            <input type="hidden" name="convertType" value="{{$convertType}}">
            <input type="hidden" name="symbol_type_cd" value="{{$symbol_type_cd}}">
            <input type="hidden" name="design" value="{{$design}}">
          </form>
          <ul class="list flex-l justify-between-l list-wamoji">
            <li class="hiragana"><span>@lang('purchase.hiragana')</span><img src="data:image/png;base64,{{$image_hiragana}}" alt="{{$hiragana}}"></li>
            <li class="katakana"><span>@lang('purchase.katakana')</span><img src="data:image/png;base64,{{$image_katakana}}" alt="{{$katakana}}"></li>
            <li class="kanji"><span>@lang('purchase.kanji')</span><img src="data:image/png;base64,{{$image_kanji}}" alt="{{$kanji}}"></li>
          </ul>
          <div class="btn-group cf">
            @if($b2c_test)
              <div style="float:right;" id="paypal-button-container"></div>
            @else
              <a class="btn fr-l btn-forward" href="javascript:void(0);">@lang('purchase.button_next')</a>
            @endif
            <a class="btn fl-l btn-back" href="javascript:void(0);">@lang('purchase.button_back')</a>
          </div>
        </div>
      </main>
      @include('footer')
      <div class="loading-overlay" id="js-loadingOverlay">
        <div class="loader"></div>
      </div>
      <script src="//code.jquery.com/jquery-3.3.1.min.js"></script>
      <script src="{{ asset('/assets/js/common/jquery.easing.1.4.1.js') }}"></script>
      <script src="{{ asset('/assets/js/common/iscroll.js') }}"></script>
      <script src="{{ asset('/assets/js/common/drawer.min.js') }}"></script>
      <script src="{{ asset('/assets/js/common/common.js') }}"></script>
      <script src="{{ asset('/assets/js/purchase.js') }}"></script>
      @if($language_code === 'en')<script src="{{ asset('/assets/js/purchasePayEn.js') }}"></script>@else<script src="{{ asset('/assets/js/purchasePayJa.js') }}"></script>@endif
    </div>
  </body>
</html>
