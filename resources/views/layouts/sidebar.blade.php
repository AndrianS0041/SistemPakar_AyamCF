<div class="main-sidebar">
        <aside id="sidebar-wrapper">
          <div class="sidebar-brand">
            <a href="{{ route('db.admin') }}"><img src="{{ url('assets/img/favicon/favicon-32x32.png')}}" alt=""></a>
          </div>
          <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ route('db.admin') }}"><img src="{{ url('assets/img/favicon/favicon-32x32.png')}}" alt=""></a>
          </div>
          <ul class="sidebar-menu">
              <li class="menu-header">Dashboard</li>
              <li class="nav-item active">
                <a href="{{ route('db.admin') }}" class="nav-link"><i class="fas fa-fire"></i><span>Dashboard</span></a>
              </li>
              <li class="menu-header">Main Menu</li>
              <li class="nav-item dropdown">
                <a class="nav-link" href="{{ route('pengetahuan') }}"><i class="fas fa-columns"></i> <span>Basis Pengetahuan</span></a>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link" href="{{ route('diagnosa') }}"><i class="fas fa-comment-medical"></i> <span>Diagnosa</span></a>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link " href="{{ route('gejala') }}"><i class="fas fa-heartbeat"></i> <span>Gejala</span></a>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link " href="{{ route('post') }}"><i class="fas fa-book-medical"></i> <span>Keterangan</span></a>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link" href="{{ route('penyakit') }}"><i class="fas fa-bug"></i> <span>Penyakit</span></a>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link" href="{{ route('pakar') }}"><i class="fas fa-user"></i> <span>Pakar</span></a>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link" href="{{ route('password') }}"><i class="fas fa-unlock-alt"></i> <span>Ubah Pasword</span></a>
              </li>

            <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
              <a href="" class="btn btn-primary btn-lg btn-block btn-icon-split">
                <i class="fas fa-info-circle"></i> Tentang
              </a>
            </div>
        </aside>
      </div>