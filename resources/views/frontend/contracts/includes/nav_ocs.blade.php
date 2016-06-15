<nav>
	<ul class="timeline">
		
		@if($elcontrato->singlecontracts->count())
		 	@foreach($elcontrato->singlecontracts as $c)
				@if($c->implementation->transactions->count())
				<?php $implementation = 1;?>
					<li><a href="#" id="btn-implementation-nav" class="nav_stage current" data-id="implementation" data-title="Implementación">
					<?php echo file_get_contents("img/nav_implementacion.svg"); ?></a>
					</li>
				@endif 
			@endforeach
		<li><a href="#"  id="btn-contract-nav" class="nav_stage {{ !empty($implementation) ?  '' : 'current'}}" data-id="contracts" data-title="Contratación">
			<?php echo file_get_contents("img/nav_contratacion.svg"); ?></a>
			<?php /**
			<ul id="nav_contract">
			  @foreach($elcontrato->singlecontracts as $contract)
			  <?php $date_signed = strtotime($contract->date_signed);
				  	$date_signed = date('d/m/Y',$date_signed);?>
				<li class="active">
					<a  href="#" data-id="contract-{{$contract->id}}" data-title="{{ $contract->date_signed ? $date_signed : ''}}" class="t_right"></a>
				</li>
			  @endforeach
			</ul>***/?>
		</li>
	  	@endif

		@if($elcontrato->awards->count())
	  	<li><a href="#" id="btn-award-nav" class="nav_stage {{ !$elcontrato->singlecontracts ? 'current' : '' }}" data-id="awards" data-title="Adjudicación">
	  		<?php echo file_get_contents("img/nav_adjudicacion.svg"); ?></a> 
	  		<?php /**
	  		<ul id="nav_award" {!! $elcontrato->singlecontracts->count() ? "class='hide'" : '' !!}>
	  		  @foreach($elcontrato->awards as $award)
	  		  <?php 
	  		      $time_award = strtotime($award->date);
	  		      $time_award = date('d/m/Y',$time_award);?>
	  		  <li><a data-id="award-{{$award->id}}" href="#" data-title="{{ $award->date ? $time_award : ''}}" class="t_right"></a></li>
	  		  @endforeach
	  		</ul>***/?>
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