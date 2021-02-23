<div id="header-home">
    <header class="top-header">
        <div class="system-container">
            <div class="main-nav-block">
                <ul class="logo-wrapper">
                    <li class="site-logo">
                        <a href="/">
                            <img src="{{ asset('images/DK_Logo.png') }}" alt="site logo" />
                        </a>
                    </li>
                </ul>
                @include('partials._nav')
                <ul class="main-menu-top">
                    <li>
                        @foreach(config('app.locales') as $locale)
                            @if(app()->getLocale() != $locale)
                            <a href="{{ route('setLocaleFront', ['lang' => $locale]) }}">
                                <!--<img width="27" src="{{ asset('img/' . $locale . '.png') }}">-->
                            @if($locale === 'ge') GE @else EN @endif
                            </a>
                            @endif
                        @endforeach
                    </li>
                <li onclick="openSearch()"><img src="{{ asset('img/search-icon-normal.png') }}"></li>
                </ul>
            </div>
        </div>
    </header>
    @yield('slider')
</div>

