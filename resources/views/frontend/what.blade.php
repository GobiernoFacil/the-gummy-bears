@extends('frontend.layouts.master')

@section('content')
<!--
<ul id="menu_scroll">
	<li><a id="goto-step1" href="#" class="current"></a>
	<li><a id="goto-step2" href="#"></a>
	<li><a id="goto-step3" href="#"></a>
</ul>-->
<!--participación-->
<section class="participacion">
	<div class="container">
		<div class="row">
			<div class="col-sm-12 col-xs-10 col-sm-offset-0 col-xs-offset-1">
				<h1><span>En el gobierno</span> de la CD<span class="mx">MX</span> 
					<span>estamos comprometidos</span> con la <span>transparencia y queremos que conozcas</span>
					<strong>cómo gastamos tu dinero.</strong>
				</h1>
				<!--<a href="#" class="btn cta">¿Cómo participar?</a>-->
			</div>
		</div>
	</div>
</section>
<!--win-->
<section class="win">
	<div class="container">
		<div class="row">
			@include ("frontend.what_includes.win")
		</div>
	</div>
</section>

<!--tools-->
<section class="tools">
	<div class="container">
		<div class="row">
			@include ("frontend.what_includes.tools")
		</div>
	</div>
</section>
@endsection