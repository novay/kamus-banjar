@extends('_tema.admin')
@section('isi')
	{{ Form::open(array('route' => 'post-akun')) }}
		<table>
			<tr>
				<td>{{ Form::label('nama', 'Nama') }}</td>
				<td>{{ Form::text('nama', $temp->nama, array('placeholder' => 'Masukkan Nama', 'style' => 'width:150px')) }}</td>
				<td>@if($errors->has('nama'))<small>{{ $errors->first('nama') }}</small>@endif</td>
			</tr>
			<tr>
				<td>{{ Form::label('username', 'Username') }}</td>
				<td>{{ Form::text('username', $temp->username, array('placeholder' => 'Masukkan Username', 'style' => 'width:150px')) }}</td>
				<td>@if($errors->has('username'))<small>{{ $errors->first('username') }}</small>@endif</td>
			</tr>
			<tr>
				<td>{{ Form::label('password', 'Password') }}</td>
				<td>{{ Form::password('password', array('placeholder' => 'Masukkan Password')) }}</td>
				<td>@if($errors->has('password'))<small>{{ $errors->first('password') }}</small>@endif</td>
			</tr>
			<tr>
				<td>{{ Form::label('konfirmasi', 'Konfirmasi') }}</td>
				<td>{{ Form::password('konfirmasi', array('placeholder' => 'Konfirmasi Password')) }}</td>
				<td>@if($errors->has('konfirmasi'))<small>{{ $errors->first('konfirmasi') }}</small>@endif</td>
			</tr>
		</table>
		<p id="tengah">{{ Form::submit('Ubah Informasi', array('class' => 'tombol')) }} {{ Form::reset('Batal', array('class' => 'tombol')) }}</p>
	{{ Form::close() }}
@stop