<div id="awards" class="container_info {{$elcontrato->singlecontracts->count() ? 'hide' : ''}}">
<?php $count = 0;?>
	@foreach ($elcontrato->awards as $award)
    <div id="award-{{ $award->id }}" class="sub_container {{$count > 0 ? 'hide' : ''}}">
    	<!--encabezado-->
		<div class="row divider">
			<div class="col-sm-4">
				<p class="title_section">Etapa <span class="i_award"><b></b> Adjudicación</span></p>
			</div>
			<div class="col-sm-4">
        		<p class="title_section center">Identificador de Contratación Abierta</p>
        		<p class="ago center">{{$ocid}}</p>
    		</div>
    		<?php 	$from = new DateTime();
				$from->setTimestamp(strtotime($award->date));
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
					<p class="title_section">Adjudicado</p>
					<p class="ago">{{$val_to}}</p>
				</div>
		</div>
		
        <div class="row divider">
	        <!--título-->
            <div class="col-sm-9">
                <p class="title_section">título</p>
                <h1>{{ $award->title }}</h1>
            </div>
            
            <!--status-->
            <div class="col-sm-3">
	        <?php switch ($award->status){
        	  case "pending":
        	    $a_status = "PENDIENTE";
        	    break;
        	  case "active":
        	    $a_status = "ACTIVO";
        	    break;
        	  case "cancelled":
        	    $a_status = "CANCELADO";
        	    break;
        	  case "unsuccessful":
        	    $a_status = "SIN ÉXITO";
        	    break;
        	}?>
				<p class="title_section">Estatus de la adjudicación</p>
				<p><span class="label {{ $award->status }}">
				{{ $a_status }}</span></p>
    		</div>
        </div>
        
        <div class="row divider">
            <!--description-->
	        <div class="col-sm-6">
                <p class="title_section">Descripción</p>
                <p>{{ $award->description }}</p>
            </div>
            
            <!--ProveedorAdjudicado-->
            <div class="col-sm-6">
	            @if($award->suppliers->count())
                <p class="title_section">Proveedor Adjudicado</p>
                	@foreach($award->suppliers as $supplier)
                	<p><a href="{{ url('proveedor/'.$supplier->rfc) }}">{{$supplier->name}}</a></p>
                	@endforeach
                 @endif 
            </div>
        </div>

        <div class="row divider">
			<!--Monto Planeado-->
            <div class="col-sm-4">
	            @if ($elcontrato->planning->multi_year == 1)
    				<?php $planning_amout = ($elcontrato->planning->amount_year + $elcontrato->planning->amount);?>
				@else
    				<?php $planning_amout = $elcontrato->planning->amount;?>
				@endif
                <p class="title_section">
	    		Monto {{ $elcontrato->planning->multi_year == 1 ? 'Multianual' : ''}} Planeado ({{ $elcontrato->planning->currency }})
	            </p>
                <h2 class="amount"><b class="budget"></b><span>$</span>{{ number_format($planning_amout,2,'.',',') }}</h2>
            </div>
            
			<!--Monto Adjudicado-->
            <div class="col-sm-4">
	            @if ($award->multi_year == 1)
    				<?php $a_amount = ($award->amount_year + $award->value);?>
				@else
    				<?php $a_amount = $award->value;?>
				@endif
                <p class="title_section">
	                Monto {{ $award->multi_year == 1 ? 'Multianual' : ''}} Adjudicado ({{ $award->currency }})
	            </p>
                <h2 class="amount"><b class="spent"></b><span>$</span>{{ number_format($a_amount,2,'.',',') }}</h2>
            </div>
            
             
            <div class="col-sm-4">
              <?php 
                $percent_tender = ($a_amount * 100)/$planning_amout;
                
                if ($percent_tender > 100) {
                  $percent_budget = ($planning_amout * 100)/$a_amount . '%' ;
                  $percent_spent  = '100%';
                }
                else {
                  $percent_budget = '100%';
                  $percent_spent = $percent_tender .'%';
                }
              ?>
              
              <p class="title_section">% PLANEADO / ADJUDICADO</p>
              <div class="percent">
                <div class="budget" style="width: <?php echo $percent_budget;?>"></div>
                <div class="spent"  style="width: <?php echo $percent_spent;?>"></div>
              </div>
              <p class="title_section"><span>0</span> <span class="right"><?php echo $percent_tender > 100 ? number_format($percent_tender) : '100';?>%</span></p>
            </div>
          
			
			    <?php /*
    <div class="row divider">
        <!--monto licitado-->
        <div class="col-sm-4">
              <p class="title_section">MONTO LICITADO ({{$elcontrato->tender->currency}})</p>
              <?php $budget_amount = $elcontrato->tender->amount;?>
              <h2 class="amount"><b class="budget"></b><span>$</span>{{ number_format($budget_amount,2, '.', ',') }}</h2>
            </div>
            <?php  $amount_gastado =  0;?>
              @foreach ($elcontrato->singlecontracts as $s)
              	@if($s->amount)
              		<?php  $amount_gastado 			  =  $amount_gastado + $s->amount;
	              		   $single_contract_currency = $s->currency;?>
              	@endif
              @endforeach
              
            <!--monto contratado-->
            <div class="col-sm-4">
              <p class="title_section">MONTO CONTRATADO ({{ !empty($single_contract_currency) ? $single_contract_currency  : '' }})</p>
              <h2 class="amount"><b class="spent"></b><span>$</span>{{ number_format($amount_gastado,2, '.', ',') }}</h2>
            </div>
            @if (!empty($single_contract_currency))
            @if($single_contract_currency == "MXN")
            <div class="col-sm-4">
              <?php 
                $percent_tender = ($amount_gastado * 100)/$budget_amount;
                
                if ($percent_tender > 100) {
                  $percent_budget = ($budget_amount * 100)/$amount_gastado . '%' ;
                  $percent_spent  = '100%';
                }
                else {
                  $percent_budget = '100%';
                  $percent_spent = $percent_tender .'%';
                }
              ?>
              
              <p class="title_section">% LICITADO / CONTRATADO</p>
              <div class="percent">
                <div class="budget" style="width: <?php echo $percent_budget;?>"></div>
                <div class="spent"  style="width: <?php echo $percent_spent;?>"></div>
              </div>
              <p class="title_section"><span>0</span> <span class="right"><?php echo $percent_tender > 100 ? number_format($percent_tender) : '100';?>%</span></p>
            </div>
            @endif
            @endif
          </div>
          
          */?>
        </div>
                
        <div class="row divider">
	        <!--items-->
        	<div class="col-sm-6">
                <p class="title_section">ARTÍCULOS</p>
                <ul>
                  <?php foreach ($award->items as $item):?>
                  <li class="row">
                    <span class="col-sm-9"><?php echo $item->description;?></span>
                    <span class="col-sm-3"><?php echo $item->quantity;?> <?php echo $item->unit;?></span>
                  </li>
                  <?php endforeach;?>             
                </ul>
            </div>
            
            <!--fecha-->
            <div class="col-sm-3">
              <?php $time_award = strtotime($award->date);?>
                <p class="title_section">Fecha de adjudicación</p>
                <p>{{ date('d/m/Y',$time_award) }}</p>
            </div>
            
	        <!--Multianual-->
            @if ($award->multi_year == 1)
            <div class="col-sm-3">
                <p class="title_section">Tipo de Contrato</p>
                <p>Multianual</p>
            </div>
            @endif
        </div>
        
        <div class="row">
            <div class="col-sm-8">
                <p class="title_section">DOCUMENTOS</p>
                <ol>
				@foreach ($award->documents as $doc)
					<li class="row">
		  				<div class="col-sm-6">
		  					<a href="{{$doc->url}}">{{$doc->title}}</a> 
		  				</div>
		  				<div class="col-sm-3">
		  				{{date('d/m/Y', strtotime($doc->date))}}
		  				</div>
		  				<div class="col-sm-3">
		  				  	{{$doc->format}}
		  				</div>
		  			</li>
				@endforeach
				</ol>
            </div>
        </div>
    </div>
    @endforeach
</div>