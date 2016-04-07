@extends('frontend.layouts.master')

@section('content')

<div class="breadcrumb">
  <div class="container">
    <a href="/v2"><strong>&lt;</strong> Lista de Licitaciones</a>
  </div>
</div>
<article>
  <div class="col-sm-3 sidebar">
    <div class="header">
      <?php if ($elcontrato->tender):?>
      <h3>LICITACIÓN</h3>
      <h2><?php echo $elcontrato->tender->title;?></h2>
      <?php else:?>
      <h3>PLANEACIÓN</h3>
      <h2><?php echo $elcontrato->planning->budget->project;?></h2>
      <?php endif;?>
    </div>
    <!-- nav-->
    @include('frontend.contracts.includes.nav_ocs') 
  </div>  

  <div class="col-sm-9 info">     
        <!-- tender-->
		@include('frontend.contracts.includes.tender')        
		
		@if($elcontrato->awards)
        <!--awards-->
		@include('frontend.contracts.includes.awards')        
	    @endif
        
        @if($elcontrato->singlecontracts)
        <!-- contratos-->
		@include('frontend.contracts.includes.contracts')        
        @endif
        <!-- planning-->
		@include('frontend.contracts.includes.planning')        
      </div>
      <div class="clearfix"></div>
</article>

@endsection