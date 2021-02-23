<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('meta_title')</title>
    <meta name="description" content="@yield('meta_description')"/>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <!-- Styles -->
    <link href="{{ asset('styles/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @yield('styles')
</head>
<body>
    <div id="application" class="wrapper">

        @include('partials.header')

        <main class="main-content">
            @yield('content')
        </main>
        @include('partials.footer')

    </div>
    <div class="social-box">
        <div class="social-item"><a href="https://www.facebook.com/DimitriKhakhutashvili/?ref=br_tf&epa=SEARCH_BOX" target="_blanck"><img src="{{ asset('icons/fb_icon.png') }}" /></a></div>
        <div class="social-item"><a href="https://www.instagram.com/dimitri.khakhutashvili/" target="_blanck"><img src="{{ asset('icons/ig_icon.png') }}" /></a></div>
        <div class="social-item"><a href="https://www.youtube.com/channel/UC_pP0bC6wi0h4nORe5ZqIxQ?view_as=subscriber" target="_blanck"><img src="{{ asset('icons/yt_icon.png') }}" /></a></div>
    </div>
    <button onclick="topFunction()" id="toTopBtn" class="btnToTop" title="Go to top">&utrif;</button>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" ></script>
    <script>
        jQuery(document).ready(function($) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            window.locale = "{{ app()->getLocale() }}";
        });
        function openSearch() {
            document.getElementById("myOverlay").style.display = "block";
        }

        function closeSearch() {
            document.getElementById("myOverlay").style.display = "none";
        }
        function topFunction() {
            $('html, body').animate({scrollTop: 0},600);
            return false;
            //document.body.scrollTop = 0; // For Safari
            //document.documentElement.scrollTop = 0; // For Chrome, Firefox, IE and Opera
        }
    </script>
    @yield('scripts')
</body>
</html>
