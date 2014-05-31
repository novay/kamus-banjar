@extends('_tema.utama')
@section('isi')
<h3>Arti Kata "{{ $kata }}"</h3>
<div class="konten">
	@if(count($arti))
		<h2 class="judul">
			#{{ $arti->banjar }}
		</h2>
		<p class="arti">
			artinya <Strong>"{{ $arti->indo }}"</Strong>
		</p>
		<p class="kunjungan">
			Dikunjungi : {{ $arti->kunjungan }} Kali 
		</p>
		<p class="tanggal">
			Dibuat : {{ date('d M Y', strtotime($arti->created_at)) }}
		</p>
		<br/><br/>
	@else
		<h2 class="judul">
			Maaf, "{{ $kata }}" belum ada dalam database.
		</h2>
	@endif
</div>
@stop