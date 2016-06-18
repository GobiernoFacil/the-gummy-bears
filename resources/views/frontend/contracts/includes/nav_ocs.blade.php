<nav>
	<ul class="timeline">
		@if($elcontrato->singlecontracts->count())
		 	@foreach($elcontrato->singlecontracts as $c)
				@if($c->implementation->transactions->count())
				<?php $implementation = 1;?>
					<li class="active"><a href="#" id="btn-implementation-nav" class="nav_stage current" data-id="implementation" data-title="Implementación">
					<?php echo file_get_contents("img/nav_implementacion.svg"); ?></a>
					</li>
				@endif 
			@endforeach
			<li {!! !empty($implementation) ? '' : 'class="active"'  !!}><a href="#"  id="btn-contract-nav" class="nav_stage {{ !empty($implementation) ?  '' : 'current'}}" data-id="contracts" data-title="Contratación">
			<?php echo file_get_contents("img/nav_contratacion.svg"); ?></a>
			</li>
	  	@endif

		@if($elcontrato->awards->count())
	  	<li><a href="#" id="btn-award-nav" class="nav_stage {{ !$elcontrato->singlecontracts ? 'current' : '' }}" data-id="awards" data-title="Adjudicación">
	  		<?php echo file_get_contents("img/nav_adjudicacion.svg"); ?></a> 
	  	</li>
	  	@endif
	  	
	  	@if($elcontrato->tender)
	  	<li {!! ($elcontrato->singlecontracts->count() || $elcontrato->awards->count()) ? '' : "class='active'"!!}><a href="#" id="btn-tender-nav" data-id="tender" class="nav_stage {{ ($elcontrato->singlecontracts->count() || $elcontrato->awards->count()) ? '' : 'current'}}" data-title="Licitación"><?php echo file_get_contents("img/nav_licitacion.svg"); ?></a></li>
	  	@endif
	  	@if($elcontrato->planning)
	  	<li><a href="#" id="btn-planning-nav" data-id="planning"class="nav_stage" data-title="Planeación"><?php echo file_get_contents("img/nav_planeacion.svg"); ?></a></li>
	  	@endif
	</ul>
</nav>