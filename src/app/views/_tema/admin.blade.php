<!DOCTYPE html>
<html>
<head>
	<meta name="keywords" content="Kamus, Banjar, Indonesia, Samarinda">
	<meta name="description" content="Aplikasi Website Kamus Bahasa Indonesia - Banjar">
	<meta name="author" content="{{ Aplikasi::find(1)->pemilik }}">
	<title>{{ Aplikasi::find(1)->nama }}</title>
	{{-- Koleksi CSS --}}
	{{ HTML::style('assets/css/kamus.css') }}
</head>
<body>
	<header>{{ $judul }}</header>
	<div id="bungkus">
		@if(Auth::check())
		<div id="kiri">
			<a href="{{ route('beranda') }}">Beranda</a> | 
			<a href="{{ route('akun') }}">Akun</a> | 
			<a href="{{ route('app') }}">Aplikasi</a>
		</div>
		<div id="kanan">
			<a>Anda memiliki total <strong>{{ count(Kamus::all()) }} kata</strong></a> | 
			<a href="{{ route('keluar') }}">Keluar</a>
		</div>
		<br/><hr/>
		@endif
		@if(Session::has('pesan'))
		<div class="alert alert-block">
			<h2 class="alert-heading">{{ Session::get('judul') }}</h2>
			<p>{{ Session::get('pesan') }}</p>
		</div>
		@endif
		<br/>
		@yield('isi')
	</div>
</body>
</html>