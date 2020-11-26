@guest
    <li class="nav-item">
        <a class="nav-link menuItem" href="{{ route('login') }}">{{ __('auth/login.Login') }}</a>
    </li>
    @if (Route::has('register') && env('SPC_REGISTER') === true)
        <li class="nav-item">
            <a class="nav-link menuItem" href="{{ route('register') }}">{{ __('auth/register.Register') }}</a>
        </li>
    @endif
@else
    <li class="nav-item dropdown">
        <a id="navbarDropdown" class="nav-link dropdown-toggle menuDrop" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            {{ Auth::user()->username }} <span class="caret"></span>
        </a>

        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
            @if (Auth::user()->scope == 'M')
                @if (!Route::current()->getPrefix() == '/master')
                    <a class="dropdown-item menuItem" href="{{ route('master.index') }}" >
                        {{ __('general/accesos_principales.Panel de control') }}
                    </a>
                @endif
                @if (!Route::current()->getPrefix() == '/admin')
                    <a class="dropdown-item menuItem" href="{{ route('admin.index') }}" >
                        {{ __('general/accesos_principales.Panel de gestion') }}
                    </a>
                @endif
            @elseif (Auth::user()->scope == 'A')
                @if (!Route::current()->getPrefix() == '/admin')
                    <a class="dropdown-item menuItem" href="{{ route('admin.index') }}" >
                        {{ __('general/accesos_principales.Panel de gestion') }}
                    </a>
                @endif
                // User
            @else
                @if (!Route::current()->getPrefix() == '/user')
                    <a class="dropdown-item menuItem" href="{{ route('user.index') }}" >
                        {{ __('general/accesos_principales.Panel de usuario') }}
                    </a>
                @endif
            @endif
            @if (Route::current()->getPrefix() == '/master' || Route::current()->getPrefix() == '/admin' || Route::current()->getPrefix() == '/user')
                <a class="dropdown-item menuItem" href="{{ route('index') }}" >
                    {{ __('general/accesos_principales.Página principal') }}
                </a>
            @endif
        </div>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('logout') }}" id="logout_link" title="{{ __('general/login.Logout') }}">
            <i class="fas fa-power-off closeIcon"></i>
        </a>
    </li>
    <li class="nav-item">
        &nbsp;&nbsp;&nbsp;&nbsp;
        @php $avatar = "images/avatars/".Auth::user()->avatar; @endphp
        <img src="{{ asset($avatar) }}"  class="rounded-circle avatar">
    </li>
@endguest
