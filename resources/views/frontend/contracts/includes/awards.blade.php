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
               <!-- <h2>ID: <?php echo $award->id;?> <span class="label <?php echo $award->status;?>"><?php echo $award->status == "active" ? "ACTIVO":"";?></span></h2>-->
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
			<!--Monto Adjudicado-->
            <div class="col-sm-6">
	            @if ($award->multi_year == 1)
    				<?php $a_amout = ($award->amount_year + $award->value);?>
				@else
    				<?php $a_amout = $award->value;?>
				@endif
                <p class="title_section">Monto {{ $award->multi_year == 1 ? 'Multianual' : ''}} Adjudicado</p>
                <h2 class="amount"><span>$</span> {{ number_format($a_amout,2,'.',',') }} 
	                <span>{{ $award->currency }}</span></h2>
            </div>
			
			
        </div>
        
        
        
        <div class="row divider">
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
            
            @if ($award->multi_year == 1)
            <div class="col-sm-3">
                <p class="title_section">Tipo de Contrato</p>
                <p>Multianual</p>
            </div>
            @endif
        </div>
        
        <div class="row">
              <div class="col-sm-6">
                <p class="title_section">DOCUMENTOS</p>
                <ol>
				@foreach ($award->documents as $doc)
					<li><a href="{{$doc->url}}">{{$doc->title}}</a> {{$doc->date}}</li>
				@endforeach
				</ol>
              </div>
            </div>
          </div>
    @endforeach
</div>