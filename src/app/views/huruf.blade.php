@extends('_tema.utama')
@section('isi')
<h3>Kata dari huruf "{{ $inisial }}"</h3>
<div class="konten">
	@if(count($banjar))
	<ul style="font-size:font-size: 17px;">
		@foreach($banjar as $temp)
		<li><a href="{{ route('arti', $temp->banjar) }}">{{ $temp->banjar }}</a></li>
		@endforeach
	</ul>
	@else
	<center><h2>Maaf, inisial "{{$inisial}}" belum ada dalam database kami.</h2></center>
	@endif
</div>
@stop