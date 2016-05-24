@extends('frontend.layouts.master')

@section('content')

<div class="container">
	<div class="row list">
		<div class="col-sm-12">
			<div class="box">
				<h1 id="publisher-name">Lista de Dependencias con Contrataciones Abiertas</h1>
				<div class="divider"></div>
			</div>
		</div>
		<div class="col-sm-12">
			<ul class="list">
			@foreach ($buyers as $buyer)
			<li>
				<div class="col-sm-6 col-sm-offset-3">
					<h3><a href="{{ url('dependencia/' . $buyer->id) }}">{{$buyer->name}}</a></h3>
					<p>{{$buyer->address}} </p>
				</div>
				
				<div class="clearfix"></div>
			</li>
			@endforeach
			</ul>
		</div>
		
		
	</div>
</div>
@endsection