<div class="row border-bottom">
    <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
            <form role="search" method="GET" class="navbar-form-custom" action="">
                <div class="form-group">
                    <input type="text" placeholder="Search for someone..." class="form-control" name="top-search" id="top-search">
                </div>
            </form>
        </div>

        <ul class="nav navbar-top-links navbar-right">
            <li class="dropdown">
                <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                    <i class="fa fa-bell"></i>
                </a>
                <ul class="dropdown-menu dropdown-alerts">
                </ul>
            </li>
            <li>
                <a href="{{ route('admin.logout') }}">
                    <i class="fa fa-sign-out"></i> Log out
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
            </li>
        </ul>
    </nav>
</div>
<div class="row wrapper border-bottom white-bg page-heading" style="line-height: 30px; padding-bottom: 0px;">
    <div class="col-lg-12">
        <!--
        <h2>@yield('contentheader_title', 'Page Header here')</h2>
        <small>@yield('contentheader_description')</small>
        -->
        @yield('breadcrumb', '<ol class="breadcrumb"><li><a href="/">Home</a></li></ol>')
    </div>
</div>