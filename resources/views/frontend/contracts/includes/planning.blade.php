<div id="planning" class="container_info hide">
	<!--header-->
	<div class="row divider">
    	<div class="col-sm-12">
			<p class="title_section">Etapa: Planeación</p>
			<h1>{{ $elcontrato->planning->project }}</h1>
			<h2>{{ $ocid }}</h2>
    	</div>
  	</div>
  	<div class="row divider">
	    <div class="col-sm-6">
    		<p class="title_section">PRESUPUESTO ({{ $elcontrato->planning->currency }})</p>
			<h2 class="amount"><span>$</span>{{ number_format($elcontrato->planning->amount,2,'.',',')}}</h2>
    	</div>
		<?php $time_planning = strtotime($elcontrato->date);?>
    	@if ($elcontrato->planning->multi_year == 1)
		<div class="col-sm-3">
			<p class="title_section">Fecha</p>
		  	<p>{{ date('d/m/Y',$time_planning)}} </p>
		</div>
		<div class="col-sm-3">
			<p class="title_section">Contrato</p>
		  	<p>Multianual</p>
		</div>	
    	@else
		<div class="col-sm-6">
			<p class="title_section">Fecha</p>
		  	<p>{{ date('d/m/Y',$time_planning)}} </p>
		</div>	
		@endif
  	</div>
  	@if($elcontrato->planning->description) 
  	<!--description-->      
  	<div class="row divider">
		<div class="col-sm-12">
			<p class="title_section">Notas</p>
			<p>{{ $elcontrato->planning->description }}</p>
		</div>
  	</div>
	@endif
	
	<div class="row">
    	<div class="col-sm-6">
			<p class="title_section">COMPRADOR</p>
			<p><a href="{{ url('dependencia/'. $elcontrato->buyer->id ) }}">{{ !empty($elcontrato->buyer->name) ? $elcontrato->buyer->name : ''}}</a></p>
    	</div>
		<div class="col-sm-6">
			<p class="title_section">DOCUMENTOS</p>
			@if ($elcontrato->planning->documents)
			<ol>
          	@foreach($elcontrato->planning->documents as $doc)
		  		<li><a href="{{$doc->url}}">{{$doc->title}}</a> {{$doc->date}}</li>
          	@endforeach
      		</ol>
	  		@endif
    	</div>
  	</div>
</div>
