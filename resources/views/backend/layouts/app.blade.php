<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="{{ App::getLocale() }}">

@section('htmlheader')
    @include('backend.layouts.partials.htmlheader')
@show

<?php
    setlocale(LC_ALL, App::getLocale() . '_' . strtoupper(App::getLocale()));
?>

<body>
<div id="wrapper">
    @include('backend.layouts.partials.mainheader')
    <!-- Page Wrapper. Contains page content -->
    <div id="page-wrapper" class="gray-bg dashbard-1">
        @include('backend.layouts.partials.contentheader')
        <div class="row">
            <div class="col-lg-12">
                <div class="wrapper wrapper-content">
                    <!-- Your Page Content Here -->
                    @include('inc.messages')
                    @yield('main-content')
                </div>
            </div>
            @include('backend.layouts.partials.footer')
        </div>
    </div><!-- /.content-wrapper -->
</div><!-- ./wrapper -->

@include('backend.layouts.partials.scripts')

@yield('scripts')

</body>
</html>