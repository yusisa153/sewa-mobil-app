<div class="sidebar">
    <!-- Sidebar user (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
            <img src="{{asset("/template/dist/img/user2-160x160.jpg")}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
            <a href="#" class="d-block">Alexander Pierce</a>
        </div>
    </div>

    <!-- SidebarSearch Form -->
    <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
            <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                aria-label="Search">
            <div class="input-group-append">
                <button class="btn btn-sidebar">
                    <i class="fas fa-search fa-fw"></i>
                </button>
            </div>
        </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
            data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
   with font-awesome or any other icon font library -->
            <li class="nav-item">
                <a href="{{url("/")}}" class="nav-link">
                    <i class="nav-icon fas fa-solid fa-car-side"></i>
                    <p>
                        List Mobil
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{url('/peminjaman')}}" class="nav-link">
                    <i class="nav-icon fas fa-caret-square-right"></i>
                    <p>
                        Peminjaman
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{url('/pengembalian')}}" class="nav-link">
                    <i class="nav-icon fas fa-caret-square-left"></i>
                    <p>
                        Pengembalian
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-list-ul"></i>
                    <p>
                        History
                    </p>
                </a>
            </li>
        </ul>
    </nav>
    <!-- /.sidebar-menu -->
</div>