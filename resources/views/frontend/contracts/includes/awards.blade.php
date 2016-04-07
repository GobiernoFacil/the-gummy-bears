<div id="awards" class="container_info {{$elcontrato->singlecontracts->count() ? 'hide' : ''}}">
	<?php $count = 0;?>
<?php foreach($elcontrato->awards as $award):?>
          <div id="award-<?php echo $award->id;?>" class="sub_container {{$count > 0 ? 'hide' : ''}}">
            <div class="row divider">
              <div class="col-sm-12">
                <p class="title_section">Adjudicación</p>
                <h1><?php echo $award->title;?></h1>
                <h2>ID: <?php echo $award->id;?> <span class="label <?php echo $award->status;?>"><?php echo $award->status == "active" ? "ACTIVO":"";?></span></h2>
              </div>
            </div>
            <div class="row divider">
              <div class="col-sm-6">
                <p class="title_section">Descripción</p>
                <p><?php echo $award->description;?></p>
              </div>
              <div class="col-sm-6">
                <h2 class="amount"><span>$</span> <?php echo number_format($award->value,2,'.',',');?> <span><?php echo $award->currency;?></span></h2>
              </div>
            </div>
            <div class="row divider">
              <div class="col-sm-6">
	            @if($award->suppliers->count())
                <p class="title_section">Proveedor</p>
                	@foreach($award->suppliers as $supplier)
                	<p><a href="#">{{$supplier->name}}</a></p>
                	@endforeach
                 @endif 
              </div>
              <div class="col-sm-6">
                <p class="title_section">Fecha</p>
                <?php $time_award = strtotime($award->date);?>
                <p><?php echo date('d-m-Y',$time_award);?></p>
              </div>
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
              </div>
            </div>
          </div>
          <?php endforeach;?>
</div>