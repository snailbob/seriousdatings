@extends('master')
@section('form_area')
<!-- for merge master -->
<!-- <div class="inner-header upcoming-banner">
	<div class="container">
		<h1><i class="fa fa-map-marker"></i> Speed Dating </h1>
	</div>
</div> -->
<div class="inner-contendbg-new">

	<center >
		
	<iframe class="frame-map-new" src="{{url()}}/maplocationSppeed/{!!$userInfo->id !!}"></iframe>
	</center>				
</div>


@endsection