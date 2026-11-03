<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark d-flex justify-content-between">
    <!-- Navbar Brand-->
    <a class="navbar-brand ps-3" href="{{ route('home') }}">{{ config('app.name') }}</a>
 
    <!-- Navbar-->
    <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                <form action="{{ route('logout') }}" method="post">
                    @csrf
                    <button type="submit" class="dropdown-item">
                        <i class="fa-solid fa-right-from-bracket"></i>
                        تسجيل الخروج
                    </button>
                </form>
            </ul>
        </li>
    </ul>
</nav>