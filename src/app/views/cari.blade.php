@extends('_tema.utama')

@section('isi')
<h3>Hasil dari "{{ $keyword }}"</h3>
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
	@elseif(count($indo))
		<h2 class="judul">
			#{{ $keyword }}
		</h2>
		<p class="arti">
			dalam bahasa banjar adalah 
			@foreach($indo as $temp)
			<strong>"{{ $temp->banjar }}", </strong>
			@endforeach
		</p>
		<br/><br/>
	@else
		<h2 class="judul">
			Maaf, "{{ $keyword }}" belum ada dalam database.
		</h2>
		@if(count($daftar))
		<p class="arti">Mungkin yang Anda maksud :</p>
		<ul>
			@foreach($daftar as $temp)
			<li><a href="{{ route('arti', $temp->banjar) }}">{{ $temp->banjar }}</a></li>
			@endforeach
		</ul>
		@endif
	@endif
</div>
@stop