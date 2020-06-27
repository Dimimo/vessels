<nav class="navbar navbar-expand-md navbar-light navbar-laravel sticky-top bg-light border-bottom border-dark">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            {{ config('app.name', 'Laravel') }}
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">
                @can('admin')
                    <li class="nav-item dropdown">
                        <a id="adminDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                           aria-expanded="false" v-pre>Admin <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-left" aria-labelledby="adminDropdown">
                            <a class="dropdown-item" href="{{ route('admin.index') }}">Index</a>
                            <a class="dropdown-item" href="{{ route('admin.permissions.list') }}">User Permissions</a>
                            <a class="dropdown-item" href="{{ route('admin.updates') }}">Updates and tasks</a>
                        </div>
                    </li>
                @endcan
                <li class="nav-item dropdown">
                    <a id="portDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                       aria-expanded="false" v-pre>Ports <span class="caret"></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-left" aria-labelledby="portDropdown">
                        <a class="dropdown-item" href="{{ route('port.index') }}">Index</a>
                        <a class="dropdown-item" href="{{ route('port.create') }}">Create a new Port</a>
                        <a class="dropdown-item" href="{{ route('port.users') }}">Access administration</a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a id="operatorDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                       aria-expanded="false" v-pre>Operators <span class="caret"></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-left" aria-labelledby="operatorDropdown">
                        <a class="dropdown-item" href="{{ route('operator.index') }}">Index</a>
                        <a class="dropdown-item" href="{{ route('operator.create') }}">Create a new Operator</a>
                        <a class="dropdown-item" href="{{ route('operator.users') }}">Operator administration</a>
                    </div>
                </li>
                <li class="nav-item dropdown active">
                    <a id="vesselDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                       aria-expanded="false" v-pre>Vessels <span class="caret"></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-left" aria-labelledby="vesselDropdown">
                        <a class="dropdown-item" href="{{ route('vessel.index') }}">Index</a>
                        <a class="dropdown-item" href="{{ route('vessel.create') }}">Create a new Vessel</a>
                        <a class="dropdown-item" href="{{ route('vessel.users') }}">Vessel administration</a>
                    </div>
                </li>
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                           aria-expanded="false" v-pre>
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
