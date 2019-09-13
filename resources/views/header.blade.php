      <header class="drawer-navbar drawer-navbar--fixed" role="banner">
        <div class="drawer-container">
          <div class="drawer-navbar-header">
            <a class="drawer-brand" href="{{$uri}}">Wamojiya</a>
            <button class="drawer-toggle drawer-hamburger" type="button"><span class="sr-only">toggle navigation</span><span class="drawer-hamburger-icon"></span></button>
          </div>
          <nav class="drawer-nav" role="navigation">
            <ul class="drawer-menu">
                <li><a class="drawer-menu-item" href="@lang('header.url_operation')" target="_blank">@lang('header.show_operation')</a></li>
                <li><a class="drawer-menu-item" href="/sample/" target="_blank">@lang('header.show_sample')</a></li>
                <li><a class="drawer-menu-item" href="/howto/" target="_blank">@lang('header.show_usage')</a></li>
                <li><a class="drawer-menu-item" href="@lang('header.url_faq')" target="_blank">@lang('header.show_faq')</a></li>
                <li><a class="drawer-menu-item" href="@lang('header.url_information')" target="_blank">@lang('header.show_information')</a></li>
            </ul>
          </nav>
        </div>
      </header>
