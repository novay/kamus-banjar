@extends('_tema.admin')
@section('isi')
	@if($kamus)
		<br/>
		{{ Form::open(array('route' => array('post-ubah', $kamus->id))) }}
			<table>
				<tr>
					<td>{{ Form::label('banjar', 'Banjar') }}</td>
					<td>{{ Form::text('banjar', $kamus->banjar, array('placeholder' => 'Istilah Banjar')) }}</td>
					<td>@if($errors->has('banjar'))<small>{{ $errors->first('banjar') }}</small>@endif</td>
				</tr>
				<tr>	
					<td>{{ Form::label('indo', 'Indonesia') }}</td>
					<td>{{ Form::text('indo', $kamus->indo, array('placeholder' => 'Arti dalam Indonesia')) }}</td>
					<td>@if($errors->has('indo'))<small>{{ $errors->first('indo') }}</small>@endif</td>
				</tr>
			</table>
			<p id="tengah">{{ Form::submit('Ubah Kata', array('class' => 'tombol')) }} <a href="{{ route('beranda') }}" class="tombol">Kembali</a></p>
		{{ Form::close() }}
	@else
		<p id="tengah">ID kamus tidak ditemukan.</p>
	@endif
@stop