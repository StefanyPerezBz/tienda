<nav class="navbar navbar-expand-lg main-navbar">
    <form class="form-inline mr-auto">
        <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
            <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i
                        class="fas fa-search"></i></a></li>
        </ul>

    </form>
    <ul class="navbar-nav navbar-right">

        <li class="dropdown">
            <a data-toggle="dropdown"
                class="nav-link dropdown-toggle nav-link-lg nav-link-user" style="cursor: pointer">
                @isset(Auth::user()->image)
                    <img alt="image" style="width: 40px;height: 40px;
        object-fit: cover;"
                        src="{{ Storage::url(Auth::user()->image) }}" class="rounded-circle mr-1 object-cover aspect-video">
                @else
                    <img alt="image" style="width: 40px;height: 40px;
                object-fit: cover;"
                        src="{{ asset('backend/assets/img/avatar/avatar-1.png') }}"
                        class="rounded-circle mr-1 object-cover aspect-video">
                @endisset

                <div class="d-sm-none d-lg-inline-block">{{ Auth::user()->name }}</div>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <a href="{{ route('admin.profile') }}" class="dropdown-item has-icon">
                    <i class="far fa-user"></i> Perfil
                </a>
                <a href="features-activities.html" class="dropdown-item has-icon">
                    <i class="fas fa-bolt"></i> Activities
                </a>
                <a href="features-settings.html" class="dropdown-item has-icon">
                    <i class="fas fa-cog"></i> Settings
                </a>
                <div class="dropdown-divider"></div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                        this.closest('form').submit();"
                        class="dropdown-item has-icon text-danger">
                        <i class="fas fa-sign-out-alt"></i> Cerrar sesión
                    </a>
                </form>

            </div>
        </li>
    </ul>
</nav>
