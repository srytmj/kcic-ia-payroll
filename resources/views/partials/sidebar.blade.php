    <!-- [ navigation menu ] start -->
    <nav class="pcoded-navbar menu-light ">
        <div class="navbar-wrapper  ">
            <div class="navbar-content scroll-div ">

                <div class="">
                    <div class="main-menu-header">
                        <img class="img-radius" src="{{asset("assets/images/user/avatar-2.jpg")}}" alt="User-Profile-Image">
                        <div class="user-details">
                            <div id="more-details">Internal Audit</div>
                        </div>
                    </div>
                </div>

                <ul class="nav pcoded-inner-navbar ">

                    <li class="nav-item">
                        <a href="{{ route('dashboard') }}" class="nav-link ">
                            <span class="pcoded-micon">
                                <i class="feather icon-home"></i>
                            </span>
                            <span class="pcoded-mtext">
                                Dashboard
                            </span>
                        </a>
                    </li>

                    {{-- <li class="nav-item pcoded-hasmenu">
						<a href="#!" class="nav-link "><span class="pcoded-micon"><i class="feather icon-layers"></i></span><span class="pcoded-mtext">Data</span></a>
						<ul class="pcoded-submenu">
							<li class="pcoded-hasmenu"><a>Master</a>
								<ul class="pcoded-submenu">
									<li><a href="{{ route('ticketsales.index') }}">Ticket Sales</a></li>
									<li><a href="layout-fixed.html">Refund</a></li>
								</ul>
							</li>
                            <li class="pcoded-hasmenu"><a>Document</a>
								<ul class="pcoded-submenu">
									<li><a href="{{ route('bak.index') }}">Bak</a></li>
                                    <li><a href="{{ route('rekeningkoran.index') }}">Rekening Koran</a></li>
									<li><a href="{{ route('formrefund.index') }}">Form Refund</a></li>
								</ul>
							</li>
						</ul>
					</li> --}}

                    <li class="nav-item pcoded-hasmenu">
						<a href="#!" class="nav-link "><span class="pcoded-micon"><i class="feather icon-layers"></i></span><span class="pcoded-mtext">Master Data</span></a>
						<ul class="pcoded-submenu">
                            <li><a href="{{ route('ticketsales.index') }}">Ticket Sales</a></li>
                            <li><a href="{{ route('bak.index') }}">Bak</a></li>
						</ul>
					</li>

                    <li class="nav-item pcoded-hasmenu">
                        <a href="#!" class="nav-link "><span class="pcoded-micon"><i class="feather icon-layers"></i></span><span class="pcoded-mtext">Aksi</span></a>
						<ul class="pcoded-submenu">
							<li>
                                <a href="{{ route('classification.index') }}">Klasifikasi Data</a>
							</li>
                            <li class="pcoded-hasmenu"><a>Rekapitulasi</a>
								<ul class="pcoded-submenu">
									<li><a href="{{ route('rekapitulasi.bak') }}">Bak</a></li>
                                    <li><a href="{{ route('rekapitulasi.ticketsales') }}">Ticket Sales</a></li>
								</ul>
							</li>
						</ul>
                    </li>
                </ul>
                
            </div>
        </div>
    </nav>
    <!-- [ navigation menu ] end -->