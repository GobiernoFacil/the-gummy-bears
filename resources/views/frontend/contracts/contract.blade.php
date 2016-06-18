@extends('frontend.layouts.master')

@section('content')

<div class="breadcrumb">
	<div class="col-sm-12">
    <a href="{{ url('contratos')}}" class="back"><strong>&lt;</strong> Lista de Contratos</a>
	</div>
</div>
<article>
  <div class="col-sm-3 sidebar">
    <div class="header">
      @if ($elcontrato->tender)
      <h3>PROCESO DE CONTRATACIÓN</h3>
      <h2>{{ $elcontrato->tender->title }}</h2>
      @else
      <h3>PLANEACIÓN DE CONTRATACIÓN</h3>
      <h2>{{ $elcontrato->planning->budget->project }}</h2>
      @endif
      <h4>Etapas</h4>
    </div>
    <!-- nav-->
    @include('frontend.contracts.includes.nav_ocs') 
  </div>  

  <div class="col-sm-9 info">     
	  	@if($elcontrato->singlecontracts)
	  		@foreach($elcontrato->singlecontracts as $c)
				@if($c->implementation->transactions->count())
				<?php $implementation = 1;?>
				@include('frontend.contracts.includes.implementation')        
	  			@endif
	  		@endforeach
        <!-- contratos-->
		@include('frontend.contracts.includes.contracts')        
        @endif
		@if($elcontrato->awards)
        <!--awards-->
		@include('frontend.contracts.includes.awards')        
	    @endif
        <!-- tender-->
		@include('frontend.contracts.includes.tender') 
        <!-- planning-->
		@include('frontend.contracts.includes.planning')        
      </div>
      <div class="clearfix"></div>
</article>

@endsection