@extends('_tema.admin')

@section('isi')
	<div id="tengah">
		<h1>404 Tidak Ditemukan</h1>
		<p>Maaf, Halaman yang Anda maksud tidak dapat kami temukan.</p>
		@if(Auth::check())
			<a href="{{ route('beranda') }}">Kembali ke Beranda</a>
		@else
			<a href="{{ route('index') }}">Kembali ke Index</a>
		@endif
	</div>
	<br/>
@stop