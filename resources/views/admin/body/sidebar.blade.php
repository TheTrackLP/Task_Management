<style>
.nav-link:hover {
    background-color: white;
    color: black !important;
    border-radius: 50px !important
}

.icon-field {
    padding-right: 7px;
}

.sb-sidenav-collapse-arrow {
    color: white !important;
}

.bg-color {
    background: linear-gradient(90deg, rgba(33, 33, 48, 1) 0%, rgba(57, 48, 74, 1) 35%);
}
</style>
<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion bg-color" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <hr>
                <a class="nav-link pb-3 pt-3 text-white" href="#">
                    <div class="icon-field"><i class="fas fa-tachometer-alt"></i>
                    </div>
                    Dashboard
                </a>
                <hr>
                <a class="nav-link pb-3 pt-3 text-white" href="{{ route('all.employees') }}">
                    <div class="icon-field"><i class="fas fa-users"></i></div>
                    Employee List
                </a>
                <hr>
                <a class="nav-link pb-3 pt-3 text-white" href="{{ route('all.projects') }}">
                    <div class="icon-field"><i class="fas fa-list-ul"></i></div>
                    Projects
                </a>
                <hr>
                <a class="nav-link pb-3 pt-3 text-white" href="{{ route('all.tasks') }}">
                    <div class="icon-field"><i class="fas fa-tasks"></i></div>
                    Tasks
                </a>
                <hr>
                <a class="nav-link pb-3 pt-3 text-white" href="{{ route('all.leaves') }}">
                    <div class="icon-field"><i class="fas fa-list-alt"></i></div>
                    Leave Management
                </a>
                <hr>
                <a class="nav-link text-white collapsed" href="#" data-bs-toggle="collapse"
                    data-bs-target="#rolesCollapse" aria-expanded="false">
                    <div class="icon-field"><i class="fas fa-columns"></i></div>
                    Roles
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="rolesCollapse">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link text-white" href="layout-static.html">All Permissions</a>
                        <a class="nav-link text-white" href="layout-sidenav-light.html">All Roles</a>
                        <a class="nav-link text-white" href="layout-sidenav-light.html">Role in Permission</a>
                        <a class="nav-link text-white" href="layout-sidenav-light.html">All Roles and Permission</a>
                    </nav>
                </div>
                <hr>
                <a class="nav-link text-white collapsed" href="#" data-bs-toggle="collapse"
                    data-bs-target="#adminUserCollapse" aria-expanded="false">
                    <div class="icon-field"><i class="fas fa-columns"></i></div>
                    Admin / Users
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="adminUserCollapse">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link text-white" href="{{ route('all.admins') }}">Admin</a>
                        <a class="nav-link text-white" href="{{ route('all.users') }}">Users</a>
                    </nav>
                </div>
                <hr>
                <a class="nav-link pb-3 pt-3 text-white" href="{{ route('settings') }}">
                    <div class="icon-field"><i class="fas fa-cog"></i></div>
                    Settings
                </a>
                <hr>
            </div>
        </div>
        <div class="sb-sidenav-footer text-white">
            <div class="">Logged in as:</div>
            {{$profileData->username}}
        </div>
    </nav>
</div>