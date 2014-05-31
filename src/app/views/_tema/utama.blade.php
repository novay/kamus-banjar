<!DOCTYPE html>
<html>
<head>
	<title>{{ Aplikasi::find(1)->nama }}</title>
	<meta name="description" content="">
	<meta name="keywords" content="">
	<link rel="shortcut icon" href="img/favicon.ico">
	{{ HTML::style('assets/css/kamus-depan.css') }}
	<script type="text/javascript">
		var tombol = "";
		var huruf = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
		var hurufArray = huruf.split("");
		for(var i=0; i<26; i++) {
			var satu = hurufArray.shift();
			tombol += '<a title="Daftar kata huruf '+satu+'" href="{{ url("huruf") }}/'+satu+'">'+satu+'</a>'
		}
	</script>
</head>
<body>
	<header>
		<div class="bungkus">
			<div id="logo">
				<a href="{{ route('index') }}" title="Kamus Banjar Indonesia">
					{{ HTML::image('assets/img/logo.png') }}
				</a>
			</div>
			<h1>{{ Aplikasi::find(1)->nama }}</h1>
			<h2>{{ Aplikasi::find(1)->slogan }}</h2>
			<p>Total Koleksi <strong>{{ count(Kamus::all()) }} Kata</strong>. <a href="{{ route('beranda') }}">Masuk sebagai Admin</a></p>
			<div class="cari">	
				<div id="form">
					{{ Form::open(array('route' => 'cari', 'method' => 'GET')) }}
						{{ Form::text('kata', Input::old('kata')) }}
					{{ Form::close() }}
				</div>
				<div id="abjat">
					<script> document.write(tombol); </script>
				</div>
			</div>
		</div>	
	</header>
	<div id="isi">
        <div class="bungkus-isi">
        	<div class="bungkus-kiri">
        		@yield('isi')
        	</div>
        	<div class="bungkus-kanan">
				<div id="kata-baru">
					<h3>Lima Kata Terbaru</h3>
					<div class="daftar">
						<ul>
							@foreach(Kamus::orderBy('created_at', 'DESC')->paginate(5) as $temp)
							<li>
								<a title="Arti dari {{ $temp->banjar }}" href="{{ route('arti', $temp->banjar) }}">
									{{ $temp->banjar }}
								</a>
							</li>
							@endforeach
						</ul>
					</div>
				</div>
			</div>
        </div>
    </div>
	<footer>
		<div id="hak-cipta">&copy; 2014 Kamus Banjar Indonesia. Hak Cipta Dilindungi Undang-undang.</div>	
	</footer>
</body>
</html>