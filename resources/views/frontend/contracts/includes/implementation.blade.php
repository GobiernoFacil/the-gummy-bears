<div id="implementation" class="container_info">
    <!--encabezado-->
    <div class="row divider">
    	<div class="col-sm-12">
        	<p class="title_section">Etapa <span class="i_implementation"><b></b> Implementación</span></p>
    	</div>
    </div>
    <!--contrato-->
    <div class="row divider">
    	<div class="col-sm-9">
        	<p class="title_section">Descripción</p>
        	<h1>{{ $c->description }}</h1>
    	</div>
    	<div class="col-sm-3">
        	<p class="title_section">Contrato</p>
			<h2>{{ $c->title }}<span class="label {{ $c->status }}">
			{{ $c->status == "active" ? "ACTIVO" : "" }}</span></h2>
      	</div>
    </div>
    <!--montos-->
    <div class="row divider">
	    <!-- $ contratado-->
        <div class="col-sm-4">
            <p class="title_section">MONTO TOTAL CONTRATADO ({{ $c->currency }})</p>
            <h2 class="amount"><b class="budget"></b><span>$</span>{{ number_format($c->amount,2,'.',',')}}</h2>
        </div>
	    <!-- $ pagado-->
        <div class="col-sm-4">
	         <?php  $amount_pagado =  0;?>
              @foreach ($c->implementation->transactions as $s)
              	@if($s->amount)
              		<?php  $amount_pagado =  $amount_pagado + $s->amount;?>
              	@endif
              @endforeach
        	<p class="title_section">MONTO TOTAL PAGADO ({{ $c->currency }})</p>
			<h2 class="amount"><b class="spent"></b><span>$</span>{{ number_format($amount_pagado,2,'.',',')}}</h2>
        </div>
	    <!-- $ porcentaje-->
        <div class="col-sm-4">
        <?php 
            $percent_tender = ($amount_pagado * 100)/$c->amount;       
            if ($percent_tender > 100) {
              $percent_budget = ($budget_amount * 100)/$c->amount . '%' ;
              $percent_spent  = '100%';
            }
            else {
              $percent_budget = '100%';
              $percent_spent = $percent_tender .'%';
            }                
        ?>
        	<p class="title_section">% CONTRATADO / PAGADO</p>
        	<div class="percent">
        		<div class="budget" style="width:{{ $percent_budget }}"></div>
				<div class="spent"  style="width: {{ $percent_spent }}"></div>
        	</div>
            <p class="title_section">
	            <span>0</span> 
	            <span class="right">{{ $percent_tender > 100 ? number_format($percent_tender) : '100' }}%</span>
	        </p>
        </div>
    </div>
    
    <!--transacciones-->
    <div class="row divider">
	    <div class="col-sm-12">
		    <h3>Transacciones ({{$c->implementation->transactions->count()}})</h3>
			<ol>    
			@foreach($c->implementation->transactions as $t)
				<li class="row" data-id="{{$t->local_id}}">
					<span class="col-sm-2">	    	
						<span class="title_section">FECHA</span><br>
						<span>{{$t->date}}</span><br>
						
					</span>
					<span class="col-sm-4">	    	
						<span class="title_section">RECIBE PAGO</span><br>
						<span><a href="{{ url('proveedor/'. $t->receiver_id) }}">{{$t->receiver_name}}</a></span>
					</span>
					
					<span class="col-sm-3">	    	
						<span class="title_section">MONTO ({{$t->currency}})</span><br>
						<span>$<strong>{{ number_format($t->amount,2,'.',',') }}</strong> </span>
					</span>
					<span class="col-sm-3">	    	
						<span class="title_section">EMITE PAGO</span><br>
						<span>{{$t->provider_name}}</span>
					</span>
				</li>
			@endforeach 
			</ol>
	    </div>
    </div>

    @if($c->implementation->milestones->count())
    <!--milestone-->
    <div class="row divider">
	    <div class="col-sm-12">
		    <h3>Entregas ({{ $c->implementation->milestones->count() }})</h3>
		    <ol>
			@foreach($c->implementation->milestones as $m)
				<li class="row" data-id="{{$m->local_id}}">
					<span class="col-sm-2">	    	
						<span class="title_section">FECHA</span><br>
						<span>{{$m->date}}</span><br>
						
					</span>
					<span class="col-sm-3">	    	
						<span class="title_section">TÍTULO</span><br>
						<strong>{{$m->title}}</strong>
					</span>
					
					<span class="col-sm-5">	    	
						<span class="title_section">DESCRIPCIÓN</span><br>
						{{$m->description}}
					</span>
					<span class="col-sm-2">	    	
						<span class="title_section">ESTATUS</span><br>
						<?php switch($m->status) {
							case 'met':
								$status = "Satisfecho";
								break;
							case 'notMet':
								$status = "No se cumplió";
								break;
							case 'partiallyMet':
								$status = "Se cumplió parcialmente";
								break;	
						};?>
						<span>{{$status}}</span>
					</span>
				</li>
			@endforeach     
		    </ol>
	    </div>
    </div>
   	@endif

    @if($c->implementation->documents->count())
    <!--DOCUMENTOS-->
    <div class="row">
        <div class="col-sm-4">
   			<p class="title_section">DOCUMENTOS</p>
   			<ol>
   			@foreach ($c->implementation->documents as $doc)
   			  <li><a href="{{$doc->url}}">{{$doc->title}}</a> {{$doc->date}}</li>
   			@endforeach
   			</ol>
   		</div> 
   	</div>
   	@endif
</div>