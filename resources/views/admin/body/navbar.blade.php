<style>
.bg-color {
    background: linear-gradient(90deg, rgba(33, 33, 48, 1) 0%, rgba(57, 48, 74, 1) 35%);
}
</style>
<nav class="sb-topnav navbar navbar-expand bg-color">
    <!-- Navbar Brand-->
    <a class="navbar-brand ps-3 text-white " href="{{ route('admin.dashboard') }}">LaraTask</a>
    <!-- Sidebar Toggle-->
    <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0 text-white" id="sidebarToggle" href="#!"><i
            class="fas fa-bars"></i></button>

    <!-- Navbar-->
    <ul class="navbar-nav d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
        <li class="nav-item dropdown">
            <a class="dropdown-toggle text-white" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown"
                aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="{{ route('admin.logout') }}">Logout <i
                            class="fas fa-power-off"></i></a></li>
            </ul>
        </li>
    </ul>
</nav>