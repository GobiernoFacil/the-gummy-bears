<div id="planning" class="container_info hide">
	<!--encabezado-->
    <div class="row divider">
    	<div class="col-sm-4">
        	<p class="title_section">Etapa <span class="i_planning"><b></b> Planeación</span></p>
    	</div>
    	<div class="col-sm-4">
        	<p class="title_section center">Identificador de Contratación Abierta</p>
        	<p class="ago center">{{$ocid}}</p>
    	</div>
    	@if ($elcontrato->planning->documents->count())
          	@foreach($elcontrato->planning->documents as $doc)
		  		<?php $document_date =  date('d/m/Y', strtotime($doc->date));?>
          	@endforeach
    	<div class="col-sm-4 right">
	    	@if (!empty($document_date))
        	<p class="title_section">Fecha</p>
        	<p class="ago">{{$document_date}}</p>
        	@endif
    	</div>
	  	@endif
    </div>

	<div class="row divider">
		<!--proyecto-->
    	<div class="col-sm-12">
	    	<p class="title_section">Proyecto </p>
			<h1>{{ $elcontrato->planning->project }}</h1>
    	</div>
  	</div>
	
  	<div class="row divider">
	  	<!--Presupuesto-->
	    <div class="col-sm-6">
    		<p class="title_section">
	    		Presupuesto {{ $elcontrato->planning->multi_year == 1 ? 'Multianual' : ''}} ({{ $elcontrato->planning->currency }})
	    	</p>
    		@if ($elcontrato->planning->multi_year == 1)
    			<?php $planning_amout = ($elcontrato->planning->amount_year + $elcontrato->planning->amount);?>
	    	@else
    			<?php $planning_amout = $elcontrato->planning->amount;?>
	    	@endif
    		
			<h2 class="amount">
				<span>$</span>{{ number_format($planning_amout,2,'.',',')}}
			</h2>
    	</div>
    	<!--COMPRADOR-->
    	<div class="col-sm-6">
			<p class="title_section">COMPRADOR</p>
			<p><a href="{{ url('dependencia/'. $elcontrato->buyer->id ) }}">{{ !empty($elcontrato->buyer->name) ? $elcontrato->buyer->name : ''}}</a></p>
    	</div>
  	</div>
	
	<div class="row divider">
		<!-- documentos-->
		<div class="col-sm-6">
			<p class="title_section">DOCUMENTOS</p>
			@if ($elcontrato->planning->documents)
			<ol>
          	@foreach($elcontrato->planning->documents as $doc)
		  		<li class="row">
		  				<span class="col-sm-6">
		  					<a href="{{$doc->url}}">{{$doc->title}}</a> 
		  				</span>
		  				<span class="col-sm-3">
		  				{{date('d/m/Y', strtotime($doc->date))}}
		  				</span>
		  				<span class="col-sm-3">
		  				  	{{$doc->format}}
		  				</span>
		  			</li>
          	@endforeach
      		</ol>
	  		@endif
    	</div>
    	@if($elcontrato->planning->description) 
		<!--description--> 
    	<div class="col-sm-6">
			<p class="title_section">Notas</p>
			<p>{{ $elcontrato->planning->description }}</p>
		</div>
		@endif
  	</div>
</div>