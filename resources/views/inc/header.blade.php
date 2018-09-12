@inject('trans', 'App\Model\Service\ITranslationService')

<nav class="navbar navbar-default navbar-static-top">
    <div class="container">
        <div class="navbar-header">

            <!-- Collapsed Hamburger -->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <!-- Branding Image -->
            <a id="_button_home" class="navbar-brand" href="{{ url('/login') }}">
                {{ config('app.name', 'Laravel') }}
            </a>
        </div>

        <div class="collapse navbar-collapse" id="app-navbar-collapse">
            <!-- Left Side Of Navbar -->
            <ul class="nav navbar-nav">
                &nbsp;
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-right">
                <!-- Authentication Links -->
                @if (Auth::guest())
                    <li><a href="{{ route('login') }}">Login</a></li>
                    <li><a href="{{ route('register') }}">Register</a></li>
                @else
                    @yield('menu-items')
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            {{ Auth::user()->getFirstName() }} {{ Auth::user()->getLastName() }} <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                            <li>
                                <a id="_button_settings" href="{{ route('get.member.settings') }}">{{ $trans->get('Menu.Settings', 'Settings') }}</a>
                            </li>
                            <li>
                                <a href="{{ route('get.backup') }}">{{ $trans->get('Menu.DownloadBackUp', 'Download backup') }}</a>
                            </li>
                            <li>
                                <a href="{{ route('get.import') }}">{{ $trans->get('Menu.LoadImport', 'Load data') }}</a>
                            </li>

                            <li>
                                <a href="{{ route('logout') }}" id="_button_logout"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ $trans->get('Menu.Logout', 'Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>
