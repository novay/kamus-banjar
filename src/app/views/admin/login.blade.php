@extends('_tema.admin')
@section('isi')
	{{ Form::open(array('route' => 'post-masuk')) }}
		<table>
			<tr>
				<td>{{ Form::label('username', 'Username') }}</td>
				<td>{{ Form::text('username', null, array('placeholder' => 'Nama Pengguna', 'style' => 'width: 151px;')) }}</td>
				<td>@if($errors->has('username'))<small>{{ $errors->first('username') }}</small>@endif</td>
			</tr>
			<tr>
				<td>{{ Form::label('password', 'Password') }}</td>
				<td>{{ Form::password('password', array('placeholder' => 'Kata Sandi')) }}</td>
				<td>@if($errors->has('password'))<small>{{ $errors->first('password') }}</small>@endif</td>
			</tr>
		</table>	
		<p id="tengah">{{ Form::submit('Masuk', array('class' => 'tombol')) }}</p>
	{{ Form::close() }}
@stop