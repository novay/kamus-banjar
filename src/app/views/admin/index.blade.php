@extends('_tema.admin')
@section('isi')
	{{-- Bila kamus terdaftar --}}
	@if(count($daftar))
		<a href="{{ route('buat') }}" id="baru" class="tombol">Tambah Kata</a>
		{{ Form::open(array('route' => 'cari-kamus', 'style' => 'padding-left:40px;padding-bottom:10px')) }}
			{{ Form::label('cari', 'Cari') }}
			{{ Form::text('cari', null, array('placeholder' => 'Cari disini...', 'style' => 'width:200px')) }}
			<small><i>*Tekan Enter</i></small>
		{{ Form::close() }}	
		{{ Form::open(array('route' => 'hapus-list')) }}
		<table id="data">
			<th></th>
			<th style="width:200px"><a href="{{ route('urut-kamus', 'banjar') }}">Banjar</a></th>
			<th style="width:350px"><a href="{{ route('urut-kamus', 'indo') }}">Indonesia</a></th>
			<th>Visit</th>
			<th>Aksi</th>
			@foreach($daftar as $temp)
				<tr>
					<td>{{ Form::checkbox('id[]', $temp->id) }}</td>
					<td>{{ $temp->banjar }}</td>
					<td>{{ $temp->indo }}</td>
					<td>{{ $temp->kunjungan }} Kali</td>
					<td><small>{{ link_to_route('ubah', 'Ubah', $temp->id) }} | {{ link_to_route('hapus', 'Hapus', $temp->id) }}</small></td>
				</tr>
			@endforeach
		</table>
		{{ $daftar->links() }}
		<p style="padding-left:30px">
			{{ Form::submit('Hapus Ceklis', array('class' => 'tombol')) }} 
			<small>*Ceklis data terlebih dahulu.</small>
		</p>
		{{ Form::close() }}
	{{-- Bila kamus tidak ada --}}
	@else
		<p id="tengah">Maaf, Anda belum memiliki data kamus. </p>
		<p id="tengah">{{ link_to_route('buat', 'Buat Baru') }}</p>
	@endif
@stop