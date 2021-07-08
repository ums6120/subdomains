<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <div class="sb-sidenav-menu-heading">Core</div>
                <a class="nav-link" href="{{ route('superadmin.dashboard') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Dashboard
                </a>
                <a class="nav-link" href="{{ route('superadmin.domains') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-globe"></i></div>
                    Domains
                </a>
                <a class="nav-link" href="{{ route('superadmin.users.admins') }}">
                    <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                    Admins
                </a>
            </div>
        </div>
        <div class="sb-sidenav-footer">
            <div class="small">Logged in as: SuperAdmin</div>
            Start Bootstrap
        </div>
    </nav>
</div>