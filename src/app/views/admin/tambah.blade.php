@extends('_tema.admin')
@section('isi')
	<br/>
	{{ Form::open(array('route' => 'post-buat')) }}
		<table>
			<tr>
				<td>{{ Form::label('banjar', 'Banjar') }}</td>
				<td>{{ Form::text('banjar', null, array('placeholder' => 'Istilah Banjar')) }}</td>
				<td>
					@if($errors->has('banjar'))
						<small>{{ $errors->first('banjar') }}</small>
					@endif
				</td>
			</tr>
			<tr>	
				<td>{{ Form::label('indo', 'Indonesia') }}</td>
				<td>{{ Form::text('indo', null, array('placeholder' => 'Arti dalam Indonesia')) }}</td>
				<td>
					@if($errors->has('indo'))
						<small>{{ $errors->first('indo') }}</small>
					@endif
				</td>
			</tr>
		</table>
		<p id="tengah">{{ Form::submit('Tambah', array('class' => 'tombol')) }}</p>
	{{ Form::close() }}
@stop