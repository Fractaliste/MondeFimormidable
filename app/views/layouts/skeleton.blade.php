<!DOCTYPE html>
<html lang="fr">
    <head>
        @include('layouts.head')
        @yield('head')
    </head>
    <body>
        <div id="canevas">
            <header id="header">
                @include('layouts.header')
            </header>
            <nav id="navigation">
                @yield('nav')
            </nav>
            <div id="page" class="clearfix">
                <nav id="menu" class="fleft">
                    @yield('menu')
                </nav>
                <main id="content" class="fright">
                    @yield('content')
                </main>
            </div>
            <div id="push"></div>
        </div>
        <footer id="footer">
            @include('layouts.footer')
        </footer>
        {{javascript_include_tag()}}
        @yield('footer')
        @include('layouts.piwik')
    </body>
</html>
