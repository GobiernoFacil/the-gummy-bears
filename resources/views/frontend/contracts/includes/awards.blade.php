<div id="awards" class="container_info {{$elcontrato->singlecontracts->count() ? 'hide' : ''}}">
	<?php $count = 0;?>
	@foreach ($elcontrato->awards as $award)
    <div id="award-<?php echo $award->id;?>" class="sub_container {{$count > 0 ? 'hide' : ''}}">
            <div class="row divider">
              <div class="col-sm-12">
                <p class="title_section">Etapa: Adjudicación</p>
                <h1><?php echo $award->title;?></h1>
               <!-- <h2>ID: <?php echo $award->id;?> <span class="label <?php echo $award->status;?>"><?php echo $award->status == "active" ? "ACTIVO":"";?></span></h2>-->
              </div>
            </div>
            <div class="row divider">
              <div class="col-sm-6">
                <p class="title_section">Descripción</p>
                <p><?php echo $award->description;?></p>
              </div>
              <div class="col-sm-6">
                <p class="title_section">Monto Adjudicado</p>
                <h2 class="amount"><span>$</span> <?php echo number_format($award->value,2,'.',',');?> <span><?php echo $award->currency;?></span></h2>
              </div>
            </div>
            <div class="row divider">
              <div class="col-sm-6">
	            @if($award->suppliers->count())
                <p class="title_section">Proveedor</p>
                	@foreach($award->suppliers as $supplier)
                	<p><a href="{{ url('proveedor/'.$supplier->rfc) }}">{{$supplier->name}}</a></p>
                	@endforeach
                 @endif 
              </div>
              <?php $time_award = strtotime($award->date);?>
              @if ($award->multi_year == 1)
              <div class="col-sm-3">
                <p class="title_section">Fecha</p>
                <p>{{ date('d-m-Y',$time_award) }}</p>
              </div>
               <div class="col-sm-3">
                <p class="title_section">Contrato</p>
                <p>Multianual</p>
              </div>
              @else
              <div class="col-sm-6">
                <p class="title_section">Fecha</p>
                <p>{{ date('d-m-Y',$time_award) }}</p>
              </div>
              @endif
            </div>
            <div class="row">
              <div class="col-sm-8">
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
              
              <div class="col-sm-4">
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