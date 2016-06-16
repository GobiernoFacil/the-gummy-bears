<div id="contracts" class="container_info {{ !empty($implementation) ? 'hide' : ''}}">
	<?php $count = 0;?>
	@foreach($elcontrato->singlecontracts as $contract)
	<div id="contract-{{ $contract->id }}" class="sub_container {{$count > 0 ? 'hide' : ''}}">
    	<!--encabezado-->
		<div class="row divider">
			<div class="col-sm-12">
		    	<p class="title_section">Etapa <span class="i_contrato"><b></b> Contratación</span></p>
			</div>
		</div>
    	<div class="row divider">
	    	 <div class="col-sm-3">
              <p class="title_section">CONTRATO</p>
              <h2>{{ $contract->title }} <span class="label <?php echo $contract->status;?>">
              <?php echo $contract->status == "active" ? "ACTIVO" : "";?></span></h2>
            </div>
            <div class="col-sm-9">
              <p class="title_section">Descripción</p>
              <h1><?php echo $contract->description;?></h1>
            </div>
           
          </div>
          <div class="row divider">
            <div class="col-sm-6">
              <p class="title_section">MONTO CONTRATADO</p>
              <h2 class="amount"><span>$</span><?php echo number_format($contract->amount,2,'.',',');?><span><?php echo $contract->currency;?></span></h2>
            </div>
            <div class="col-sm-3">
              <p class="title_section">FECHA DE FIRMA</p>
              <p><strong>
              @if ($contract->date_signed)
              <?php $time_contract = strtotime($contract->date_signed);?>
              {{ date('d/m/Y',$time_contract)}}
              @else
              Sin Fecha de Firma
              @endif</strong>
              </p>
            </div>
            @if($contract->multi_year == 1 )
            <div class="col-sm-3">
            	<p class="title_section">Tipo de Contrato</p>
            	<p>Multianual</p>
            </div>
            @endif
          </div>
          <div class="row divider">
            <div class="col-sm-4">
              <p class="title_section">COMPRADOR</p>
              <p><a href="{{ url('dependencia/'. $elcontrato->buyer->id) }}"><?php echo $elcontrato->buyer->name;?></a></p>
            </div>
            <div class="col-sm-5">
              <p class="title_section">PROVEEDOR</p>
              @foreach($elcontrato->awards as $award)
                @if ($contract->award_id == $award->local_id)
                  <p><a href="{{ url('proveedor/' . $award->suppliers[0]->rfc) }}"><?php echo $award->suppliers[0]->name;?></a></p>
                @endif
              @endforeach
            </div> 
            
            <div class="col-sm-3">
              <p class="title_section">PERÍODO</p>
              <?php 
                $period_startDate = strtotime($contract->contract_start);
                $period_endDate = strtotime($contract->contract_end);
              ?>
              <p><?php echo date('d/m/Y',$period_startDate);?> a <?php echo date('d/m/Y',$period_endDate);?></p>
             
            </div> 
          </div>

            <div class="row">
              <div class="col-sm-8">
                <p class="title_section">ARTÍCULOS</p>
                <ul>
                  <?php foreach($contract->items as $item):?>
                  <li class="row">
                    <span class="col-sm-9"><?php echo $item->description;?></span>
                    <span class="col-sm-3 right"><?php echo number_format($item->quantity);?> <?php echo $item->unit;?></span>
                  </li>
                  <?php endforeach;?>                 
                </ul>
              </div>
              
              <div class="col-sm-4">
                <p class="title_section">DOCUMENTOS</p>
                <ol>
				@foreach ($contract->documents as $doc)
					<li><a href="{{$doc->url}}">{{$doc->title}}</a> {{$doc->date}}</li>
				@endforeach
				</ol>
              </div> 
            </div>
    </div>
    <?php $count = $count++;?>
    @endforeach
</div>