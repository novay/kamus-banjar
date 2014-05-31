@extends('_tema.admin')
@section('isi')
	{{-- Bila kamus terdaftar --}}
	@if(count($cari))
		{{ Form::open(array('route' => 'cari-kamus', 'style' => 'padding-left:40px;padding-bottom:10px')) }}
			{{ Form::label('cari', 'Cari') }}
			{{ Form::text('cari', null, array('placeholder' => 'Cari yang lain...', 'style' => 'width:200px')) }}
			<small><i>*Tekan Enter</i></small>
		{{ Form::close() }}	
		{{ Form::open(array('route' => 'hapus-list')) }}
		<table id="data">
			<th></th>
			<th style="width:200px">Banjar</th>
			<th style="width:350px">Indonesia</th>
			<th>Visit</th>
			<th>Aksi</th>
			@foreach($cari as $temp)
				<tr>
					<td>{{ Form::checkbox('id[]', $temp->id) }}</td>
					<td>{{ $temp->banjar }}</td>
					<td>{{ $temp->indo }}</td>
					<td>{{ $temp->kunjungan }} Kali</td>
					<td><small>{{ link_to_route('ubah', 'Ubah', $temp->id) }} | {{ link_to_route('hapus', 'Hapus', $temp->id) }}</small></td>
				</tr>
			@endforeach
		</table>
		<p style="padding-left:30px">
			{{ Form::submit('Hapus Ceklis', array('class' => 'tombol')) }} 
			<small>*Ceklis data terlebih dahulu.</small>
		</p>
		{{ Form::close() }}
	{{-- Bila kamus tidak ada --}}
	@else
		<h3 id="tengah">
			Maaf, kata yang Anda maksud tidak ditemukan. <br/><br/>
			<a href="{{ route('beranda') }}" class="tombol">Kembali</a>
		</h3>
		<br/>
		@if(count($daftar))
		<p id="tengah">Atau mungkin yang Anda maksud adalah ini :</p>
		<table id="data">
			<th style="width:200px">Banjar</th>
			<th style="width:350px">Indonesia</th>
			@foreach($daftar as $temp)
				<tr>
					<td>{{ $temp->banjar }}</td>
					<td>{{ $temp->indo }}</td>
				</tr>
			@endforeach
		</table>
		@endif
	@endif
@stop