        <div id="tender" class="container_info {{$elcontrato->awards->count() ? 'hide' : ''}}">
          <div class="row divider">
            <div class="col-sm-12">
              <p class="title_section">Licitación</p>
              <h1><?php echo $elcontrato->tender->title;?></h1>
              <h2>{{$ocid}} 
              <span class="label <?php echo $elcontrato->tender->status;?>">
              <?php echo $elcontrato->tender->status == "complete" ? 'COMPLETO' : '';?></span>
              </h2>
              <p class="lead"><?php echo $elcontrato->tender->description;?></p>
            </div>
          </div>
          <div class="row divider">
            <div class="col-sm-4">
              <p class="title_section">PRESUPUESTO (MXN)</p>
              <?php $budget_amount = $elcontrato->tender->amount;?>
              <h2 class="amount"><b class="budget"></b><span>$</span><?php echo number_format($budget_amount,2, '.', ',');?></h2>
            </div>
            <div class="col-sm-4">
              <p class="title_section">Gastado (MXN)</p>
              <?php  $amount_gastado =  0;?>
              @foreach ($elcontrato->singlecontracts as $s)
              	@if($s->amount)
              		<?php  $amount_gastado =  $amount_gastado + $s->amount;?>
              	@endif
              @endforeach
              <h2 class="amount"><b class="spent"></b><span>$</span><?php echo number_format($amount_gastado,2, '.', ',');?></h2>
            </div>
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
              
              <p class="title_section">% PRESUPUESTO / GASTADO</p>
              <div class="percent">
                <div class="budget" style="width: <?php echo $percent_budget;?>"></div>
                <div class="spent"  style="width: <?php echo $percent_spent;?>"></div>
              </div>
              <p class="title_section"><span>0</span> <span class="right"><?php echo $percent_tender > 100 ? number_format($percent_tender) : '100';?>%</span></p>
            </div>
          </div>
          <div class="row divider">
            <div class="col-sm-12">
              <p class="title_section">Línea de tiempo</p>
            </div>
          </div>
          <div class="row divider">
            <div class="col-sm-4">
              <p class="title_section">COMPRADOR</p>
              <p><a href="/dependencia.php"><?php // echo $elcontrato->buyer->name;?></a></p>
            </div>
                                  

            <div class="col-sm-4">
              <p class="title_section">MÉTODO DE ADQUISICIONES</p>
              <?php switch ($elcontrato->tender->procurement_method){
                case "selective":
                  $procurementMethod = "Selectiva";
                  break;
                case "open":
                  $procurementMethod = "Abierta";
                  break;
                case "limited":
                  $procurementMethod = "Limitada";
                  break;
              }?>
              <p><?php echo $procurementMethod;?> </p>
            </div>
            <div class="col-sm-4">
              <?php switch ($elcontrato->tender->award_criteria){
                case "lowestCost":
                  $awardCriteria = "Costo más bajo";
                  break;
                case "bestProposal":
                  $awardCriteria = "Mejor Propuesta";
                  break;
                case "bestValueToGovernment":
                  $awardCriteria = "Mejor oferta al Gobierno";
                  break;
                case "bestValueToGovernment":
                  $singleBidOnly = "Oferta";
                  break;
              }?>
              <p class="title_section">CRITERIOS DE ADJUDICACIÓN</p>
              <p><?php echo $awardCriteria;?></p>
            </div>
          </div>
          
          <div class="row divider">
            <div class="col-sm-8">
              <p class="title_section">ARTÍCULOS</p>
              <ul>
                <?php foreach ($elcontrato->tender->items as $item):?>
                <li class="row">
                  <span class="col-sm-9"><?php echo $item->description;?> </span>
                  <span class="col-sm-3"><?php echo $item->quantity;?> <?php echo $item->unit;?> </span>
                </li>
                <?php endforeach;?>   
              </ul>
            </div>
            
            <div class="col-sm-4">
              <p class="title_section">DOCUMENTOS</p>
            </div> 
          </div>
          
          <div class="row">
            <div class="col-sm-4">
              <p class="title_section">LICITADORES que aplicaron</p>
              <h2 class="amount"><?php echo $elcontrato->tender->number_of_tenderers;?></h2>
              @if ($elcontrato->tender->tenderers->count())
              <ol>
                <?php foreach ($elcontrato->tender->tenderers as $tendererers):?>
                <li><a href="#"><?php echo $tendererers->name;?></a> - <?php echo $tendererers->region;?></li>
                <?php endforeach;?> 
              </ol>
              @endif
            </div>
            <div class="col-sm-4">
              <p class="title_section">Adjudicaciones</p>
              <h2 class="amount"><?php echo count($elcontrato->awards);?></h2>
              @if (!empty($elcontrato->awards))
              <ol>
                <?php foreach ($elcontrato->awards as $award):?>
                <?php foreach ($award->suppliers as $supplier):?>
                <li><a href="#"><?php echo $supplier->name;?></a></li>
                <?php endforeach;?> 
                <?php endforeach;?> 
              </ol>
              @endif
            </div>
            <div class="col-sm-4">
              <p class="title_section">Contratos</p>
              <h2 class="amount"><?php echo count($elcontrato->singlecontracts);?></h2>
              <ol>
                <?php foreach ($elcontrato->singlecontracts as $contract):?>
                <li><a href="#"><?php echo $contract->title;?></a></li>
                <?php endforeach;?> 
              </ol>
            </div> 
          </div>
        </div>