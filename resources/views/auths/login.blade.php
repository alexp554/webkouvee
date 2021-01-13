<!doctype html>
<html lang="en" class="fullscreen-bg">

<head>
	<title>Login Pegawai Kouvee</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<!-- VENDOR CSS -->
	<link rel="stylesheet" href="{{asset('tampilan/assets/css/bootstrap.min.css')}}">
	<link rel="stylesheet" href="{{asset('tampilan/assets/vendor/font-awesome/css/font-awesome.min.css')}}">
	<link rel="stylesheet" href="{{asset('tampilan/assets/vendor/linearicons/style.css')}}">
	<!-- MAIN CSS -->
	<link rel="stylesheet" href="{{asset('tampilan/assets/css/main.css')}}">
	<!-- FOR DEMO PURPOSES ONLY. You should remove this in your project -->
	<link rel="stylesheet" href="{{asset('tampilan/assets/css/demo.css')}}">
	<!-- GOOGLE FONTS -->
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">
	<!-- ICONS -->
	<link rel="apple-touch-icon" sizes="76x76" href="{{asset('tampilan/assets/img/logomenu.png')}}">
	<link rel="icon" type="image/png" sizes="96x96" href="{{asset('tampilan/assets/img/logomenu.png')}}">
</head>

<body>
	<!-- WRAPPER -->
	<div id="wrapper">
		<div class="vertical-align-wrap">
			<div class="vertical-align-middle">
				<div class="auth-box ">
					<div class="left">
						<div class="content">
							<div class="header">
								<div class="logo text-center"><img src="{{asset('tampilan/assets/img/logo1.png')}}" alt="Kouvee Logo" width="200" height="40"></div>
								<p class="lead">Login Pegawai</p>
							</div>
							<form class="form-auth-small" action="/postlogin" method="post">
							{{csrf_field()}}
								<div class="form-group">
									<label for="signin-username" class="control-label sr-only">Username</label>
									<input name="nama_pegawai" type="text" class="form-control" id="signin-username" placeholder="Nama Pegawai" value="{{ old('nama_pegawai') }}">
									@if($message = Session::get('false-nama_pegawai'))
										<div class="invalid-feedback text-danger">Nama Pegawai tidak terdaftar</div>
									@endif
								</div>
								<div class="form-group">
									<label for="signin-password" class="control-label sr-only">Password</label>
									<input name="password" type="password" class="form-control" id="signin-password"placeholder="Password">
									@if($message = Session::get('false-password'))
										<div class="invalid-feedback text-danger">Password salah</div>
									@endif
								</div>
								<!-- <div class="form-group clearfix"> 
									<label class="fancy-checkbox element-left">
										<input type="checkbox">
										<span>Remember me</span>
									</label>
								</div>
								-->
								<button type="submit" class="btn btn-warning btn-lg btn-block">LOGIN</button>
							</form>
						</div>
					</div>
					<div class="right">
						<div class="overlay"></div>
						<div class="content text">
							<h1 class="heading">Login Akun Pegawai</h1>
							<p>Kouvee Pet Shop</p>
						</div>
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
		</div>
	</div>
	<!-- END WRAPPER -->
</body>

</html>
