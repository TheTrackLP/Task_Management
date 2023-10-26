<style>
.nav-item {
    margin: 12px 12px;
    font-weight: bold;
}
</style>
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('admin.dashboard') }}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">SB Admin <sup>2</sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <li class="nav-item">
        <a class="nav-link" href="{{ route('all.employee') }}">
            <i class="fas fa-list"></i>
            <span>Employee List</span></a>
    </li>

    <hr class="sidebar-divider my-0">

    <li class="nav-item">
        <a class="nav-link" href="{{ route('all.attendance') }}">
            <i class="fas fa-user-check"></i>
            <span>Attendace</span></a>
    </li>

    <hr class="sidebar-divider my-0">

    <li class="nav-item">
        <a class="nav-link" href="{{ route('all.projects') }}">
            <i class="fas fa-list"></i>
            <span class="text-">Projects</span></a>
    </li>

    <hr class="sidebar-divider my-0">

    <li class="nav-item">
        <a class="nav-link" href="{{ route('all.tasks') }}">
            <i class="fas fa-list"></i>
            <span class="text-">Tasks</span></a>
    </li>

    <hr class="sidebar-divider my-0">

    <li class="nav-item">
        <a class="nav-link" href="tables.html">
            <i class="fas fa-users"></i>
            <span class="text-">Users</span></a>
    </li>

    <hr class="sidebar-divider my-0">


</ul>