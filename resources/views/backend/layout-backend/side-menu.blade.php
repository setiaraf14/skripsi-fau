<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="{{ asset('admin/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset('admin/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ Auth::user()->name }}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item has-treeview menu-open">
            <a href="{{ url('/backend') }}" class="nav-link @yield('dashboard') ">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview menu-open">
            <a href="{{ url('/backend/permohonan-ktp') }}" class="nav-link @yield('permohonan-ktp') ">
              <i class="nav-icon fas fa-id-card"></i>
              <p>
                Permohonan KTP
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview menu-open">
            <a href="{{ url('/backend/permohonan-kk') }}" class="nav-link @yield('permohonan-kk') ">
              <i class="nav-icon fas fa-file-alt"></i>
              <p>
                Permohonan KK
              </p>
            </a>
          </li>
          @if ( Auth::user()->role_user == 'Staff-Kelurahan')
            <li class="nav-item has-treeview menu-open">
              <a href="{{ url('/backend/berita') }}" class="nav-link @yield('berita') ">
                <i class="fas fa-newspaper"></i>
                <p>
                  Berita Kecamatan
                </p>
              </a>
            </li>
          @endif
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link"  @yield('user-role')>
              <i class="nav-icon fas fa-chart-pie"></i>
              <p>
                User & Role
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ url('backend/user-rt') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>RT</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ url('backend/user-rw') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>RW</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ url('backend/user') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>User</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview menu-open">
            <a href="{{ url('/backend/rating') }}" class="nav-link @yield('rating') ">
              <i class="nav-icon fas fa-star-half-alt"></i>
              <p>
                Rating
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>