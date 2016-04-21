<div id="contracts" class="container_info">
	<?php $count = 0;?>
	@foreach($elcontrato->singlecontracts as $contract)
	<div id="contract-{{ $contract->id }}" class="sub_container {{$count > 0 ? 'hide' : ''}}">
          <div class="row divider">
            <div class="col-sm-12">
              <p class="title_section">Etapa: Contratación</p>
              <h1><?php echo $contract->description;?></h1>
              <h2><?php echo $contract->title;?> <span class="label <?php echo $contract->status;?>">
              <?php echo $contract->status == "active" ? "ACTIVO" : "";?></span></h2>
            </div>
          </div>
          <div class="row divider">
            <div class="col-sm-6">
              <p class="title_section">MONTO</p>
              <h2 class="amount"><span>$</span><?php echo number_format($contract->amount,2,'.',',');?><span><?php echo $contract->currency;?></span></h2>
            </div>
            <div class="col-sm-6">
              <p class="title_section">PROVEEDOR</p>
              <?php foreach($elcontrato->awards as $award):?>
                <?php if ($contract->award_id == $award->local_id):?>
                  <p><a href="{{ url('proveedor/' . $award->suppliers[0]->rfc) }}"><?php echo $award->suppliers[0]->name;?></a></p>
                <?php endif;?>
              <?php endforeach;?>
            </div> 
          </div>
          <div class="row divider">
            <div class="col-sm-5">
              <p class="title_section">COMPRADOR</p>
              <p><a href="{{ url('dependencias') }}"><?php echo $elcontrato->buyer->name;?></a></p>
            </div>
            <div class="col-sm-3">
              <p class="title_section">FECHA DE FIRMA</p>
              <p>
              @if ($contract->date_signed)
              <?php $time_contract = strtotime($contract->date_signed);?>
              <?php echo date('d/m/Y',$time_contract);?>
              @else
              Sin Fecha de Firma
              @endif
              </p>
            </div>
            <div class="col-sm-4">
              <p class="title_section">PERÍODO</p>
              <?php 
                $period_startDate = strtotime($contract->contract_start);
                $period_endDate = strtotime($contract->contract_end);
              ?>
              <p><strong><?php echo date('d/m/Y',$period_startDate);?></strong> a <strong><?php echo date('d/m/Y',$period_endDate);?></strong></p>
              
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
              </div> 
            </div>
    </div>
    <?php $count = $count++;?>
    @endforeach
</div>