<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="it">

    @section('htmlheader')
        @include('frontend.layouts.partials.htmlheader')
    @show

    <body>
        <!-- Header -->
        @include('frontend.layouts.partials.header')


        <!-- Content -->
        @yield('main-content')

        <!-- Footer -->
        @include('frontend.layouts.partials.footer')

        @include('frontend.layouts.partials.scripts')

        @yield('scripts')
    </body>

</html>