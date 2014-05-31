@extends('_tema.admin')
@section('isi')
	{{ Form::open(array('route' => 'post-app')) }}
		<table>
			<tr>
				<td>{{ Form::label('nama', 'Nama Aplikasi') }}</td>
				<td>{{ Form::text('nama', $temp->nama, array('placeholder' => 'Masukkan Nama')) }}</td>
				<td>@if($errors->has('nama'))<small>{{ $errors->first('nama') }}</small>@endif</td>
			</tr>
			<tr>
				<td>{{ Form::label('slogan', 'Slogan') }}</td>
				<td>{{ Form::textarea('slogan', $temp->slogan, array('placeholder' => 'Masukkan Slogan', 'rows' => 3)) }}</td>
				<td>@if($errors->has('slogan'))<small>{{ $errors->first('slogan') }}</small>@endif</td>
			</tr>
			<tr>
				<td>{{ Form::label('pemilik', 'Pemilik') }}</td>
				<td>{{ Form::text('pemilik', $temp->pemilik, array('placeholder' => 'Nama Pemilik')) }}</td>
				<td>@if($errors->has('pemilik'))<small>{{ $errors->first('pemilik') }}</small>@endif</td>
			</tr>
		</table>
		<p id="tengah">{{ Form::submit('Ubah Informasi', array('class' => 'tombol')) }} {{ Form::reset('Batal', array('class' => 'tombol')) }}</p>
	{{ Form::close() }}
@stop