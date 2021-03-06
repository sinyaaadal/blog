<nav class="uk-navbar-container">
        <div class="uk-container uk-container-expand" uk-navbar>
            <div class="uk-navbar-left">
                <a href="#" class="uk-navbar-item uk-logo">Blog</a>
            </div>
            <div class="uk-navbar-right">
                @guest
                <div class="uk-navbar-item">
                    <a href="{{ route('login') }}" class="uk-button uk-button-primary">Sign In</a>
                </div>
                @else
                <ul class="uk-navbar-nav">
                    <li>
                        <a href="#" class="uk-icon-link" uk-icon="icon: user"></a>
                        <div class="uk-navbar-dropdown">
                            <ul class="uk-nav uk-navbar-dropdown-nav">
                                <li class="uk-nav-header">Signed in as
                                    <b>{{ Auth::user()->name }}</b>
                                </li>
                                <li class="uk-nav-divider"></li>
                                <li class="{{ (Request::is('admin/home') ? " uk-active " : " ") }}">
                                    <a href="{{ route('home') }}">Dashboard
                                        <span class="uk-float-right" uk-icon="icon: settings"></span>
                                    </a>
                                </li>
                                <li class="{{ (Request::is('admin/profile') ? " uk-active " : " ") }}">
                                    <a href="{{ route('profile') }}">Profile
                                        <span class="uk-float-right" uk-icon="icon: happy"></span>
                                    </a>
                                </li>
                                @if(Auth::user()->admin)
                                <li class="{{ (Request::is('admin/settings') ? " uk-active " : " ") }}">
                                    <a href="{{ route('settings') }}">Settings
                                        <span class="uk-float-right" uk-icon="icon: cog"></span>
                                    </a>
                                </li>
                                @endif
                                <li class="uk-nav-divider"></li>
                                <li>
                                    <a href="#" onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">Sign out
                                        <span class="uk-float-right" uk-icon="icon: sign-out"></span>
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </li>
                </ul>
                @endguest
            </div>
        </div>
    </nav>