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
            <a href="{{ route('message') }}" class="nav-link">
                <i class="nav-icon fa fa-user-circle"></i>
                <p>
                Daftar Pesan Masuk
                </p>
            </a>
        </li>
        <li class="nav-item has-treeview menu-open">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-table"></i>
              <p>
                Laporan
                <i class="right fa fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview" style="display: block;">
              <li class="nav-item">
                <a href="{{ route('report.daily') }}" class="nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Harian</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('report.monthly') }}" class="nav-link">
                  <i class="fa fa-circle-o nav-icon"></i>
                  <p>Bulanan</p>
                </a>
              </li>
            </ul>
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