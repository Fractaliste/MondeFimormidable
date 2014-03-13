<!DOCTYPE html>
<html lang="fr">
    <head>
        @include('layouts.head')
        @yield('head')
    </head>
    <body>
        <section id="canevas">
            <header id="header">
                @include('layouts.header')
            </header>
            <nav id="navigation">
                @yield('nav')
            </nav>
            <section id="page" class="ui grid">
                <nav id="menu" class="three wide column">
                    @yield('menu')
                </nav>
                <main id="content" class="thirteen wide column">
                    @yield('content')
                </main>
            </section>
            <div id="push"></div>
        </section>
        <footer id="footer" class="ui grid">
            @include('layouts.footer')
        </footer>
        {{javascript_include_tag()}}
        @yield('footer')
        @include('layouts.piwik')
    </body>
</html>
