      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.dashboard')}}">
              <i class="icon-grid menu-icon"></i>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
              <i class="icon-layout menu-icon"></i>
              <span class="menu-title">Table</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-basic">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="{{ route('admin.status_keluarga.index')}}">Status Keluarga</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{ route('admin.warga.index')}}">Warga</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{ route('admin.user.index')}}">Role User</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{ route('admin.iuran.index')}}">Iuran</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{ route('admin.transaksi_iuran.index')}}">Transaksi Iuran</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{ route('admin.surat.index')}}">Surat</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{ route('admin.tracking_surat.index')}}">Tracking Surat</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{ route('admin.survey_status.index')}}">Survey Status</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{ route('admin.bansos.index')}}">Bansos</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{ route('admin.penerima_bansos.index')}}">Penerima Bansos</a></li>
              </ul>
            </div>
          </li>
        </ul>
      </nav>