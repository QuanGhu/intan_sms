<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item">
            <a href="{{ route('dashboard') }}" class="nav-link">
                <i class="nav-icon fa fa-dashboard"></i>
                <p>
                Dashboard
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('poli') }}" class="nav-link">
                <i class="nav-icon fa fa-home"></i>
                <p>
                Daftar Poli
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('patient') }}" class="nav-link">
                <i class="nav-icon fa fa-user"></i>
                <p>
                Daftar Pasien
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('admin') }}" class="nav-link">
                <i class="nav-icon fa fa-user-circle"></i>
                <p>
                Daftar Admin
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('logout') }}" class="nav-link">
                <i class="nav-icon fa fa-sign-out"></i>
                <p>
                Keluar
                </p>
            </a>
        </li>
    </ul>
</nav>