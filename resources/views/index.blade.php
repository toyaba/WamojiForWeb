<!doctype html>
<html lang="{{$language_code}}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <title>@if($auth) @lang('wamojiya.login_title')@else @lang('wamojiya.none_login_title')@endif | Wamojiya</title>
        <link rel="stylesheet" href="{{ asset('/assets/css/common/tachyons.min.css') }}">
        <link rel="stylesheet" href="{{ asset('/assets/css/common/drawer.min.css') }}">
        <link rel="stylesheet" href="{{ asset('/assets/css/common/font.css') }}">
        <link rel="stylesheet" href="{{ asset('/assets/css/common/style.css') }}">
        @if($auth)
        <link rel="stylesheet" type="text/css" href="{{ asset('/assets/css/start.css') }}">
        @else
        <link rel="stylesheet" type="text/css" href="{{ asset('/assets/css/index.css') }}">
        @endif
        <script>
            var $uri = '{{$uri}}';
            var $browser_error = '@lang('wamojiya.browser_error')';
        </script>
    </head>
    <body>
        <div class="container">
            <main class="main" role="main">
                <div class="inner">
                    <h1 class="tc"><img src="/images/common/logo-wamojiya_main.png" alt="WAMOJIYA"></h1>
                    @if($auth)
                    <p>@lang('wamojiya.start_description1')<br>@lang('wamojiya.start_description2')</p>
                    <form action="convert" method="post">
                        {{ csrf_field() }}
                        @if($languageList)
                        <input class="uri" type="hidden" name="uri" = value="{{$uri}}">
                        <input type="hidden" name="uri" = value="{{$uri}}">
                        <p class="tc">
                            @lang('wamojiya.select_language')<select class="select select-language" name="language_code">
                            @foreach ($languageList as $selectData)
                                <option value="{{$selectData['language_code']}}" @if($language_code == $selectData['language_code']) selected @endif>{{$selectData['language_name']}}</option>
                            @endforeach
                            </select>
                        </p>
                        @endif
                    </form>
                    <form action="convert" method="post" @if($b2c) id="wamoji_start" @endif>
                        {{ csrf_field() }}
                        <p class="tc">
                            <input class="btn btn-forward" type="submit" value="@lang('wamojiya.button_start')">
                        </p>
                        <input type="hidden" name="url" = value="{{$url}}">
                        <input type="hidden" name="uri" = value="{{$uri}}">
                        <input type="hidden" name="auth" = value="{{$auth}}">
                    </form>
                    <ul class="list list-howtouse">
                        <li><a href="/sample/" target="_blank">@lang('wamojiya.show_sample')</a></li>
                        <li><a href="/howto/" target="_blank">@lang('wamojiya.show_usage')</a></li>
                    </ul>
                    @else
                    <form action="{{ $url }}" method="post">
                        {{ csrf_field() }}
                        <div class="login-form">
                            <div class="form-parts">
                                <input type="text" name="login_facility_id" placeholder="@lang('wamojiya.login_facility_id')" value="{{old('login_facility_id')}}">
                            </div>
                            <div class="form-parts">
                                <input type="password" name="login_password" placeholder="@lang('wamojiya.login_password')">
                            </div>
                            <div class="form-parts">
                                <label for="remember_me" onclick="">
                                    <input id="remember_me" type="checkbox" name="remember_me" value="1" @if(old('remember_me') == 1)checked="checked"@endif>@lang('wamojiya.remember_me')
                                </label>
                            </div>
                            <div class="tc">
                                <input class="button-reset btn btn-forward" type="submit" value="@lang('wamojiya.button_login')">
                            </div>
                        </div>
                    </form>
                    @endif
                </div>
            </main>
            @include('footer')
            <script src="//code.jquery.com/jquery-3.3.1.min.js"></script>
            <script src="{{ asset('/assets/js/common/jquery.easing.1.4.1.js') }}"></script>
            <script src="{{ asset('/assets/js/selectLanguage.js') }}"></script>
            @if($b2c)
            <script src="{{ asset('/assets/js/checkBrowser.js') }}"></script>
            @endif
        </div>
    </body>
</html>
