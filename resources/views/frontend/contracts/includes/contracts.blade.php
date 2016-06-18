<div id="contracts" class="container_info {{ !empty($implementation) ? 'hide' : ''}}">
	<?php $count = 0;?>
	@foreach($elcontrato->singlecontracts as $contract)
	<div id="contract-{{ $contract->id }}" class="sub_container {{$count > 0 ? 'hide' : ''}}">
    	<!--encabezado-->
		<div class="row divider">
			<div class="col-sm-4">
		    	<p class="title_section">Etapa <span class="i_contrato"><b></b> Contratación</span></p>
			</div>
			<div class="col-sm-4">
        		<p class="title_section center">Identificador de Contratación Abierta</p>
        		<p class="ago center">{{$ocid}}</p>
    		</div>
    		<?php 	$from = new DateTime();
				$from->setTimestamp(strtotime($contract->date_signed));
				$to = new DateTime();
				$to->setTimestamp(time());
				$diff=date_diff($from,$to);
				$diff->format('%R');
				switch ($diff->days) {
					case 0:	
						$val_to = "Hoy";
						break;
					case ($diff->days > 0 && $diff->days < 32):	
						$val_to = 'Hace ' . $diff->days . " días";
						break;
					case($diff->days > 32 && $diff->days < 365):	
						$val_to = 'Hace ' . $diff->m . " meses";
						break;
					case($diff->days > 365):	
						$val_to =  "Hace +1 año";
						break;
					default: 
						$val_to = "";
						break;
				}?>
				<div class="col-sm-4 right">
					<p class="title_section">Firma de Contrato</p>
					<p class="ago">{{$val_to}}</p>
				</div>
		</div>
		
    	<div class="row divider">
            <!--title-->
            <div class="col-sm-9">
              <p class="title_section">CONTRATO</p>
              <h1>{{ $contract->title }}</h1>
            </div>
			
            <!--status-->
            <div class="col-sm-3">
	        <?php switch ($contract->status){
        	  case "pending":
        	    $c_status = "PENDIENTE";
        	    break;
        	  case "active":
        	    $c_status = "ACTIVO";
        	    break;
        	  case "cancelled":
        	    $c_status = "CANCELADO";
        	    break;
        	  case "terminated":
        	    $c_status = "TERMINADO";
        	    break;
        	}?>
				<p class="title_section">Estatus del contrato</p>
				<p><span class="label {{ $contract->status }}">
				{{ $c_status }}</span></p>
    		</div>
           
        </div>
        
        <div class="row divider">
	        <!-- description-->
            <div class="col-sm-6">
        		<p class="title_section">Descripción</p>
            	<p>{{ $contract->description}}</p>
            </div>	        
            
            @if($contract->multi_year == 1 )
            <!-- Tipo de Contrato-->
            <div class="col-sm-3">
            	<p class="title_section">Tipo de Contrato</p>
            	<p>Multianual</p>
            </div>
            @endif
            
            <!-- fecha de firma-->
            <div class="col-sm-3">
            	<p class="title_section">FECHA DE FIRMA</p>
            	<p>
            	@if ($contract->date_signed)
            		<?php $time_contract = strtotime($contract->date_signed);?>
					{{ date('d/m/Y',$time_contract)}}
            	@else
            		Sin Fecha de Firma
            	@endif
            	</p>
            </div>
        </div> 
	        
        <div class="row divider">
	        <!-- monto contratado-->
            <div class="col-sm-6">
	            @if ($contract->multi_year == 1)
    				<?php $sc_amount = ($contract->amount_year + $contract->amount);?>
				@else
    				<?php $sc_amount = $contract->amount;?>
				@endif
	        	<p class="title_section">Monto {{ $contract->multi_year == 1 ? 'Multianual' : ''}} Contratado</p>
              <h2 class="amount">
	              <span>$</span>{{ number_format($sc_amount,2,'.',',') }}
	              <span>{{ $contract->currency_year ?  $contract->currency_year : $contract->currency }}</span></h2>
            </div>
	        <!--$period_startDate-->
			<div class="col-sm-6">
              <p class="title_section">fechas de inicio y fin del contrato</p>
              <?php 
                $period_startDate = strtotime($contract->contract_start);
                $period_endDate = strtotime($contract->contract_end);
              ?>
              <p>{{ date('d/m/Y',$period_startDate) }} a {{ date('d/m/Y',$period_endDate) }}</p>
             
            </div> 
           
        </div>
          
        <div class="row divider">
	        <!--items-->
        	<div class="col-sm-6">
        	  <p class="title_section">ARTÍCULOS</p>
        	  <ol>
        	    @foreach($contract->items as $item)
        	    <li>
        	      <span class="col-sm-9">{{ $item->description }}</span>
        	      <span class="col-sm-3 right">{{ number_format($item->quantity)}} {{ $item->unit }}</span>
        	    </li>
        	    @endforeach              
        	  </ol>
        	</div>
	        <!--PROVEEDOR-->
        	<div class="col-sm-6">
              <p class="title_section">PROVEEDOR</p>
              @foreach($elcontrato->awards as $award)
                @if ($contract->award_id == $award->local_id)
                  <p><a href="{{ url('proveedor/' . $award->suppliers[0]->rfc) }}"><?php echo $award->suppliers[0]->name;?></a></p>
                @endif
              @endforeach
            </div> 
        </div>
        
        <div class="row">
	        <!--DOCUMENTOS-->
	        <div class="col-sm-6">
                <p class="title_section">DOCUMENTOS</p>
                <ol>
				@foreach ($contract->documents as $doc)
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
            </div> 
	        <!--COMPRADOR-->
            <div class="col-sm-6">
              <p class="title_section">COMPRADOR</p>
              <p><a href="{{ url('dependencia/'. $elcontrato->buyer->id) }}"><?php echo $elcontrato->buyer->name;?></a></p>
            </div>
        </div>
        
        
    </div>
    <?php $count = $count++;?>
    @endforeach
</div>