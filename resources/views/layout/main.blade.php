<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<!-- VENDOR CSS -->
	<link rel="stylesheet" href="{{asset('tampilan/assets/vendor/bootstrap/css/bootstrap.min.css')}}">
	<link rel="stylesheet" href="{{asset('tampilan/assets/vendor/font-awesome/css/font-awesome.min.css')}}">
	<link rel="stylesheet" href="{{asset('tampilan/assets/vendor/linearicons/style.css')}}">
	<link rel="stylesheet" href="{{asset('tampilan/assets/vendor/bootstrap/css/imageslider.css')}}">
	<!-- MAIN CSS -->
	<link rel="stylesheet" href="{{asset('tampilan/assets/css/main.css')}}">
	<!-- FOR DEMO PURPOSES ONLY. You should remove this in your project -->
	<link rel="stylesheet" href="{{asset('tampilan/assets/css/demo.css')}}">
	<!-- GOOGLE FONTS -->
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">
	<!-- ICONS -->
	<link rel="apple-touch-icon" sizes="76x76" href="{{asset('tampilan/assets/img/apple-icon.png')}}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{asset('tampilan/assets/img/logomenu.png')}}">
	<!-- JQUERY -->
	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">
    <title>@yield('title')</title>
</head>

<body>
	<!-- WRAPPER -->
	<div id="wrapper">
		<!-- NAVBAR -->
		<nav class="navbar navbar-default navbar-fixed-top">
			<div class="brand">
				<a href="/"><img src="{{asset('tampilan/assets/img/logo1.png')}}"width="181" height="26"></a>
			</div>
			<div class="container-fluid">
				@if(Session::get('login'))
				<div class="navbar-btn">
					<button type="button" class="btn-toggle-fullwidth"><i class="lnr lnr-arrow-left-circle"></i></button>
				</div>
				@endif
				<div id="navbar-menu">
                    <ul class="nav navbar-nav navbar-left">
                        <li class="nav-item">
                            <a class="nav-link" href="/"><p class="warna_font">Home</p></a>
						</li>
                        <li class="nav-item">
                            <a class="nav-link" href="/produk_kami"><p class="warna_font">Produk</p></a>
						</li>
                        <li class="nav-item">
                            <a class="nav-link" href="/layanan_kami"><p class="warna_font">Layanan</p></a>
						</li>
                    </ul>
					<ul class="nav navbar-nav navbar-right">
						<!--<li class="dropdown">
							<a href="#" class="dropdown-toggle icon-menu" data-toggle="dropdown">
								<i class="lnr lnr-alarm"></i>
								<span class="badge bg-danger">5</span>
                            </a>
                            

							 <ul class="dropdown-menu notifications"> 
								<li><a href="#" class="notification-item"><span class="dot bg-warning"></span>System space is almost full</a></li>
								<li><a href="#" class="notification-item"><span class="dot bg-danger"></span>You have 9 unfinished tasks</a></li>
								<li><a href="#" class="more">See all notifications</a></li>
							</ul>
							
						</li>
						-->
						@if(Session::get('login'))
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="warna_font">{{Session::get('nama_pegawai')}}</span> <i class="icon-submenu lnr lnr-chevron-down warna_font"></i></a>
								<ul class="dropdown-menu">
									<!-- <li><a href="#"><i class="lnr lnr-user"></i> <span>My Profile</span></a></li> 
									 <li><a href="#"><i class="lnr lnr-envelope"></i> <span>Message</span></a></li> 
									<li><a href="#"><i class="lnr lnr-cog"></i> <span>Settings</span></a></li> -->
									<li><a href="/logout"><i class="lnr lnr-exit"></i> <span>Logout</span></a></li>
								</ul>
							</li>
						@else
						<div class="navbar-btn">
							<a type="button" href="/login" class="btn btn-warning btn-sm">LOGIN</a>
						</div>
						@endif
					</ul>
				</div>
			</div>
		</nav>
		<!-- END NAVBAR -->
		@if(Session::get('login'))
		<!-- LEFT SIDEBAR -->
		<div id="sidebar-nav" class="sidebar">
			<div class="sidebar-scroll">
				<nav>
					<ul class="nav">
						<li><a href="/dashboard" class="{{Request::is('/dashboard')?'active':''}}"><span>Dashboard</span></a></li>
						@if(Session::get('id_role') == 1)
							<li><a href="/produk" class="{{Request::is('produk')?'active':''}}"><span>Manajemen Produk</span></a></li>
							<li><a href="/layanan" class="{{Request::is('layanan')?'active':''}}"><span>Manajemen Layanan</span></a></li>
							<li><a href="/supplier" class="{{Request::is('supplier')?'active':''}}"><span>Manajemen Supplier</span></a></li>
							<li><a href="/pengadaan" class="{{Request::is('pengadaan')?'active':''}}"><span>Manajemen Pengadaan</span></a></li>
							<li>
								<a href="#subPages" data-toggle="collapse" class="collapsed"><span>Laporan</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
								<div id="subPages" class="collapse ">
									<ul class="nav">
										<li><a href="produkTerlaris" class="{{Request::is('laporan_produk_terlaris')?'active':''}}">Produk Terlaris</a></li>
										<li><a href="layananTerlaris" class="{{Request::is('laporan_layanan_terlaris')?'active':''}}">Layanan Terlaris</a></li>
										<li><a href="pendapatanBulanan" class="{{Request::is('laporan_pendapatan_bulan')?'active':''}}">Pendapatan Bulanan</a></li>
										<li><a href="pendapatanBulanan" class="{{Request::is('laporan_pendapatan_bulan')?'active':''}}">Pendapatan Tahunan</a></li>
										<li><a href="laporan_pengadaan_tahunan" class="{{Request::is('laporan_pengadaan_tahunan')?'active':''}}">Pengadaan Tahunan</a></li>
										<li><a href="pengadaanBulanan" class="{{Request::is('laporan_pengadaan_tahunan')?'active':''}}">Pengadaan Bulanan</a></li>
									</ul>
								</div>
							</li>
							<li><a href="/hewan" class="{{Request::is('hewan')?'active':''}}"><span>Manajemen Hewan</span></a></li>
							<li><a href="/customer" class="{{Request::is('customer')?'active':''}}"><span>Manajemen Customer</span></a></li>
							<li><a href="/jenis" class="{{Request::is('jenis')?'active':''}}"><span>Manajemen Jenis</span></a></li>
							<li><a href="/ukuran" class="{{Request::is('ukuran')?'active':''}}"><span>Manajemen Ukuran</span></a></li>
							<li><a href="/pegawai" class="{{Request::is('pegawai')?'active':''}}"><span>Manajemen Pegawai</span></a></li>
						@elseif(Session::get('id_role') == 2)
							<li><a href="/hewan" class="{{Request::is('hewan')?'active':''}}"><span>Manajemen Hewan</span></a></li>
							<li><a href="/customer" class="{{Request::is('customer')?'active':''}}"><span>Manajemen Customer</span></a></li>
							<li>
								<a href="#subPages" data-toggle="collapse" class="collapsed"> <span>Transaksi</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
								<div id="subPages" class="collapse ">
									<ul class="nav">
										<li><a href="/transaksi_produk" class="">Produk</a></li>
										<li><a href="/transaksi_layanan" class="">Layanan</a></li>
									</ul>
								</div>
							</li>
						@else
							<li>
								<a href="#subPages" data-toggle="collapse" class="collapsed"> <span>Transaksi</span> <i class="icon-submenu lnr lnr-chevron-left"></i></a>
								<div id="subPages" class="collapse ">
									<ul class="nav">
										<li><a href="/transaksi_produk" class="">Produk</a></li>
										<li><a href="/transaksi_layanan" class="">Layanan</a></li>
									</ul>
								</div>
							</li>
						@endif
					</ul>
				</nav>
			</div>
		</div>
		<!-- END LEFT SIDEBAR -->
		@endif
		<!-- MAIN -->
		@yield('container')
		<!-- END MAIN -->
		<div class="clearfix"></div>
	</div>
	<!-- END WRAPPER -->
	<!-- Javascript -->
	<script src="{{asset('tampilan/assets/vendor/jquery/jquery.min.js')}}"></script>
	<script src="{{asset('tampilan/assets/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
	<script src="{{asset('tampilan/assets/vendor/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
	<script src="{{asset('tampilan/assets/scripts/klorofil-common.js')}}"></script>
	<script type="text/javascript" src="{{URL('js/app.js')}}"></script>

	<!-- Jquery script -->
	<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
	<script type="text/javascript">
        $(document).ready(function() {
            $('#table-datatables').DataTable();
        });
    </script>
</body>

</html>
<style>
	.navbar-inverse{
	background-color:  #FF8C00;
	}
	.warna_font{
	color: #FFFFFF;
	font-size: 13pt;
	}
</style>