<!DOCTYPE html>
<html lang="{{$language_code}}">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@lang('selectDesign.title') | Wamojiya</title>
    <link rel="stylesheet" href="{{ asset('/assets/css/common/tachyons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/css/common/drawer.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/css/common/font.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/css/common/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/assets/css/selectDesign.css') }}">
    <script>
      var $uri = '{{$uri}}';
    </script>
  </head>
  <body class="drawer drawer--top drawer--navbarTopGutter">
    <div class="container" id="top">
      @include('header')
      <main class="main" role="main">
        <div class="inner">
          <h1 class="tc">@lang('selectDesign.main_title')</h1>
          <p class="tc-l">@lang('selectDesign.description')</p>
          <form id="design" class="design_select_form" action="." method="POST">
            {{ csrf_field() }}
            <input type="hidden" name="url" = value="{{$url}}">
            <input type="hidden" name="uri" = value="{{$uri}}">
            <input type="hidden" name="auth" = value="{{$auth}}">
            <input type="hidden" name="inputData" = value="{{$inputData}}">
            <input type="hidden" id="convertType" name="convertType" value="{{$convertType}}">
            @if ($designList)
            <ul class="list flex-l flex-wrap-l justify-between-l list-design">
            @foreach ($designList as $design)
              <li>
                <label for="{{$design['picture_type_name']}}">
                  <input id="{{$design['picture_type_name']}}" type="radio" name="design" value="{{$design['symbol_type_cd']}}"><img src="data:image/png;base64,{{$design['image']}}" alt="{{$design['picture_type_name']}}">
                </label>
              </li>
            @endforeach
            </ul>
            <div class="dn" id="symbol_type_cd">
              @foreach ($designList as $design)
              <input id="{{$design['picture_type_name']}}" type="radio" name="symbol_type_cd" value="{{$design['symbol_type_cd']}}">
              @endforeach
              </ul>
            </div>
            <div class="dn alert alert-danger error-message" id="js-showError">
              <ul class="list-error">
                <li><span class="alert-message">@lang('selectDesign.alert')</span></li>
              </ul>
            </div>
            @endif
          </form>
          <p>
          <div class="btn-group cf"><a class="btn fr-l btn-forward" href="javascript:void(0);">@lang('selectDesign.button_next')</a><a class="btn fl-l btn-back" href="javascript:void(0);">@lang('selectDesign.button_back')</a></div>
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
      <script src="{{ asset('/assets/js/selectDesign.js') }}"></script>
    </div>
  </body>
</html>
