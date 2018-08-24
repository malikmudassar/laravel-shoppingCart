<!-- Header Navbar -->
<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element">
                    <span>
                        <img alt="image" class="img-circle" src="
                            @if (isset(Auth::user()->picture) && (Auth::user()->picture != ''))
                                {{ Auth::user()->picture }}
                            @else
                                https://api.adorable.io/avatars/240/{{Auth::user()->email}}.png
                            @endif
                        " style="max-width: 70px;" />
                    </span>
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <span class="clear">
                            <span class="block m-t-xs">
                                <strong class="font-bold">
                                    @if (isset(Auth::user()->name))
                                        {{ Auth::user()->full }}
                                    @else
                                        David Williams
                                    @endif
                                </strong>
                            </span>
                        </span>
                    </a>
                    <ul class="dropdown-menu animated fadeInRight m-t-xs">
                        <li><a href="profile.html">Profile</a></li>
                        <li><a href="contacts.html">Contacts</a></li>
                        <li><a href="mailbox.html">Activities</a></li>
                    </ul>
                </div>
                <div class="logo-element">
                    IN+
                </div>
            </li>
            <li class="{{ (Request::is('/')) ? 'active' : '' }}">
                <a href="{{ route('admin::dashboard') }}">
                    <i class="fal fa-home"></i>
                    <span class="nav-label">&nbsp;
                        {{ title_case(__('side-menu.dashboard')) }}
                    </span>
                </a>
            </li>
            <li class="{{ (Request::is('users') || Request::is('users/*')) ? 'active' : '' }}">
                <a href="">
                    <i class="fal fa-user-circle"></i>
                    <span class="nav-label">&nbsp;
                        {{ title_case(__('side-menu.users')) }}
                    </span>
                </a>
                <ul class="nav nav-second-level collapse">
                    <li class="{{ (Request::is('users')) ? 'active' : '' }}">
                        <a href="{{ route('admin::users::index') }}">
                            <span class="nav-label">
                                {{ title_case(__('side-menu.users')) }}
                            </span>
                        </a>
                    </li>
                    
                </ul>
            </li>
            <li class="{{ (Request::is('categories') || Request::is('categories/*')) ? 'active' : '' }}">
                <a href="">
                    <i class="fal fa-briefcase"></i>
                    <span class="nav-label">
                        &nbsp;{{ title_case(__('Categories')) }}
                    </span>
                </a>
                <ul class="nav nav-second-level collapse">
                    <li class="{{ (Request::is('categories')) ? 'active' : '' }}">
                        <a href="{{ route('admin::categories.index') }}">
                            <span class="nav-label">
                                {{ title_case(__('List')) }}
                            </span>
                        </a>
                    </li>
                    
                </ul>
                <ul class="nav nav-second-level collapse">
                    <li class="{{ (Request::is('categories')) ? 'active' : '' }}">
                        <a href="{{ route('admin::categories.create') }}">
                            <span class="nav-label">
                                {{ title_case(__('Add')) }}
                            </span>
                        </a>
                    </li>
                    
                </ul>
            </li>
            <li class="{{ (Request::is('coupon') || Request::is('coupon/*')) ? 'active' : '' }}">
                <a href="">
                    <i class="fal fa-usd-square"></i>
                    <span class="nav-label">
                        &nbsp;{{ title_case(__('Coupon')) }}
                    </span>
                </a>
                <ul class="nav nav-second-level collapse">
                    <li class="{{ (Request::is('coupon')) ? 'active' : '' }}">
                        <a href="{{ route('admin::coupon.create') }}">
                            <span class="nav-label">
                                {{ title_case(__('Add')) }}
                            </span>
                        </a>
                    </li>
                    
                </ul>
                <ul class="nav nav-second-level collapse">
                    <li class="{{ (Request::is('categories')) ? 'active' : '' }}">
                        <a href="{{ route('admin::coupon.index') }}">
                            <span class="nav-label">
                                {{ title_case(__('Manage')) }}
                            </span>
                        </a>
                    </li>
                    
                </ul>
            </li>
            <li class="{{ (Request::is('media') || Request::is('media/*')) ? 'active' : '' }}">
                <a href="">
                    <i class="fal fa-briefcase"></i>
                    <span class="nav-label">
                        &nbsp;{{ title_case(__('Media')) }}
                    </span>
                </a>
                <ul class="nav nav-second-level collapse">
                    <li class="{{ (Request::is('media')) ? 'active' : '' }}">
                        <a href="{{ route('admin::media.create') }}">
                            <span class="nav-label">
                                {{ title_case(__('Home Page')) }}
                            </span>
                        </a>
                    </li>
                    
                </ul>
            </li>
            <li class="{{ (Request::is('order') || Request::is('order/*')) ? 'active' : '' }}">
                <a href="">
                    <i class="fal fa-briefcase"></i>
                    <span class="nav-label">
                        &nbsp;{{ title_case(__('Orders')) }}
                    </span>
                </a>
                <ul class="nav nav-second-level collapse">
                    <li class="{{ (Request::is('order')) ? 'active' : '' }}">
                        <a href="{{route('admin::orders.all')}}">
                            <span class="nav-label">
                                {{ title_case(__('List')) }}
                            </span>
                        </a>
                    </li>
                    
                </ul>
            </li>
            <!-- Shipping -->
            <li class="{{ (Request::is('shipping') || Request::is('shipping/*')) ? 'active' : '' }}">
                <a href="">
                    <i class="fal fa-ship"></i>
                    <span class="nav-label">
                        &nbsp;{{ title_case(__('Shipping')) }}
                    </span>
                </a>
                <ul class="nav nav-second-level collapse">
                    <li class="{{ (Request::is('order')) ? 'active' : '' }}">
                        <a href="{{route('admin::shipping-rules.index')}}">
                            <span class="nav-label">
                                {{ title_case(__('Rules')) }}
                            </span>
                        </a>
                    </li>
                    <li class="{{ (Request::is('order')) ? 'active' : '' }}">
                        <a href="{{route('admin::shipping-defaults.index')}}">
                            <span class="nav-label">
                                {{ title_case(__('Defaults')) }}
                            </span>
                        </a>
                    </li>
                    
                    
                </ul>
            </li>

            <li class="{{ (Request::is('pages') || Request::is('pages/*')) ? 'active' : '' }}">
                <a href="">
                    <i class="fal fa-briefcase"></i>
                    <span class="nav-label">
                        &nbsp;{{ title_case(__('Pages')) }}
                    </span>
                </a>
                <ul class="nav nav-second-level collapse">
                    <li class="{{ (Request::is('pages')) ? 'active' : '' }}">
                        <a href="{{ route('admin::pages.create') }}">
                            <span class="nav-label">
                                {{ title_case(__('Add')) }}
                            </span>
                        </a>
                    </li>
                    <li class="{{ (Request::is('pages/list')) ? 'active' : '' }}">
                         <a href="{{ route('admin::pages.index') }}">
                            <span class="nav-label">
                                {{ title_case(__('Manage')) }}
                            </span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="{{ (Request::is('payment') || Request::is('payment/*')) ? 'active' : '' }}">
                <a href="">
                    <i class="fal fa-briefcase"></i>
                    <span class="nav-label">
                        &nbsp;{{ title_case(__('Payment')) }}
                    </span>
                </a>
                <ul class="nav nav-second-level collapse">                   
                    <li class="{{ (Request::is('payment/list')) ? 'active' : '' }}">
                         <a href="{{ route('admin::payment.index') }}">
                            <span class="nav-label">
                                {{ title_case(__('Manage')) }}
                            </span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="{{ (Request::is('products') || Request::is('products/*')) ? 'active' : '' }}">
                <a href="">
                    <i class="fal fa-briefcase"></i>
                    <span class="nav-label">
                        &nbsp;{{ title_case(__('Products')) }}
                    </span>
                </a>
                <ul class="nav nav-second-level collapse">
                    <li class="{{ (Request::is('products')) ? 'active' : '' }}">
                        <a href="{{ route('admin::products.create') }}">
                            <span class="nav-label">
                                {{ title_case(__('Add')) }}
                            </span>
                        </a>
                    </li>
                    <li class="{{ (Request::is('pages/settings')) ? 'active' : '' }}">
                        <a href="{{ route('admin::products.index') }}">
                            <span class="nav-label">
                                {{ title_case(__('Manage')) }}
                            </span>
                        </a>
                    </li>
                    <li class="{{ (Request::is('pages/settings')) ? 'active' : '' }}">
                        <a href="{{ route('admin::offers.index') }}">
                            <span class="nav-label">
                                {{ title_case(__('Offers')) }}
                            </span>
                        </a>
                    </li>
                    <li class="{{ (Request::is('pages/settings')) ? 'active' : '' }}">
                        <a href="{{ route('admin::classic.index') }}">
                            <span class="nav-label">
                                {{ title_case(__('Classic')) }}
                            </span>
                        </a>
                    </li>
                    <li class="{{ (Request::is('pages/settings')) ? 'active' : '' }}">
                        <a href="{{ route('admin::pom.index') }}">
                            <span class="nav-label">
                                {{ title_case(__('Product of Month')) }}
                            </span>
                        </a>
                    </li>
                    <li class="{{ (Request::is('pages/settings')) ? 'active' : '' }}">
                        <a href="{{ route('admin::box.index') }}">
                            <span class="nav-label">
                                {{ title_case(__('Boxes')) }}
                            </span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="{{ (Request::is('blog') || Request::is('blog/*')) ? 'active' : '' }}">

                <a href="">
                    <i class="far fa-rss"></i>
                    <span class="nav-label">&nbsp;
                        {{ title_case(__('side-menu.blog')) }}
                    </span>
                </a>

                <ul class="nav nav-second-level collapse">
                    <li class="{{ (Request::is('blog')) ? 'active' : '' }}">
                        <a href="{{ route('admin::blog::blog') }}">
                            <span class="nav-label">
                                Posts
                            </span>
                        </a>
                    </li>
                    {{-- <li class="{{ (Request::is('blog/post')) ? 'active' : '' }}">
                        <a href="{{ route('admin::blog::posts') }}">
                            <span class="nav-label">
                                {{ title_case(__('side-menu.posts')) }}
                            </span>
                        </a>
                    </li> --}}
                    <li class="{{ (Request::is('blog/categories')) ? 'active' : '' }}">
                        <a href="{{ route('admin::blog::categories') }}">
                            <span class="nav-label">
                                {{ title_case(__('side-menu.categories')) }}
                            </span>
                        </a>
                    </li>
                    <li class="{{ (Request::is('blog/settings')) ? 'active' : '' }}">
                        <a href="{{ route('admin::blog::settings') }}">
                            <span class="nav-label">
                                {{ title_case(__('side-menu.settings')) }}
                            </span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="{{ (Request::is('cyrano') || Request::is('cyrano/*')) ? 'active' : '' }}">
                <a href="">
                    <i class="fal fa-users"></i>
                    <span class="nav-label">Cyrano</span>
                </a>
                <ul class="nav nav-second-level collapse">
                    <li class="{{ (Request::is('cyrano')) ? 'active' : '' }}">
                        <a href="{{ route('admin::cyrano::cyrano') }}">
                            <span class="nav-label">Cyrano</span>
                        </a>
                    </li>
                </ul>
                <ul class="nav nav-second-level collapse">
                    <li class="{{ (Request::is('cyrano/settings')) ? 'active' : '' }}">
                        <a href="{{ route('admin::cyrano::settings') }}">
                            <span class="nav-label">
                                {{ title_case(__('side-menu.settings')) }}
                            </span>
                        </a>
                    </li>
                </ul>
            </li>

            

        </ul>
    </div>
</nav>