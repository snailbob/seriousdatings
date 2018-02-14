@extends('master')
@section('form_area')

<div ng-controller="areWeNearbyController" ng-cloak>
	<div class="inner-header upcoming-banner">
		<div class="container">
			<h1>Speed Dating</h1>
		</div>
	</div>
	<div class="inner-contendbg">

		@if (Session::has('message'))
		<div class="alert alert-success">{{ Session::get('message') }}</div>
		@endif
		<div class="container">

			<div class="row">
				@include('new_leftsidebar')
				<div class="col-md-6">
				
					<div class="ar_middle-content-section">

						<div class="row">
							<div class="col-md-12">
								<h3 style="color: #FFF; background: #E21D24;font-weight:600;font-size: 22px;width: 100%;padding:7px 10px;margin:0; line-height:28px;">
									Are we nearby ?  <i class="fa fa-map-marker"></i> 
								</h3>
							</div>
							<div class="col-md-12">
								<div class="group_inner_box">
										<div class="upload-profilex text-center" style="margin-top:30px;">
											<h2 class="font-styling"><i class="fa fa-user-circle"></i>I'm {!!$userInfo->lastName !!}, {!!$userInfo->firstName !!} </h2>
											<div class="image-border">
												<img class="img-thumbnail" ng-src="{!! $userInfo->photo !!}">
												<input type="hidden" id="chatterIDcheck" value="{!!$userInfo->id !!}">
											</div>
											<div>
											
												@if($userInfo->is_online)
													<i class="fa fa-circle text-success" aria-hidden="true"></i> Online
												@else
													<i class="fa fa-circle text-muted" aria-hidden="true"></i> Offline
												@endif
											</div>

											<div class="padding">
												<p class="lead">
													<span class="label label-danger">
														<i class="fa fa-map-marker" aria-hidden="true"></i> We are {{ $userInfo->distance }}mi. away
													</span>
												</p>
											</div>
										</div>
									<div class="profile-img-styling" style="float:none;">

										<div class="three-blocks" style="width:100%;float:left; margin-right:0px;">
											<div class="inside-box">
											<form>
												
											<div class="form-group">
											<center>
											<div class="btn-group">
												<button type="button" onclick="actionViVoNearbyPage('{!! $userInfo->id !!}','video')" class="btn btn-danger" uib-tooltip="Video Chat {!!$userInfo->firstName !!}"><i class="fa fa-video-camera"></i></button>

												<button type="button" onclick="actionViVoNearbyPage('{!! $userInfo->id !!}','text')" class="btn btn-danger" uib-tooltip="Chat with {!!$userInfo->firstName !!} "><i class="fa fa-comments"></i></button>


												{{--  <button type="button" onclick="actionViVoNearbyPage('{!! $userInfo->id !!}','voice')" class="btn btn-danger" uib-tooltip="Call {!!$userInfo->firstName !!} "><i class="fa fa-phone"></i></button>  --}}


												<!-- 									
												<button type="button" class="btn btn-danger" uib-tooltip="View  {!!$userInfo->firstName !!} Facebook"><i class="fa fa-facebook-official"></i></button>

												<button type="button" class="btn btn-danger"  uib-tooltip="View  {!!$userInfo->firstName !!} Twitter ">  <i class="fa fa-twitter"></i></button>


												<button type="button" class="btn btn-danger"  uib-tooltip="View  {!!$userInfo->firstName !!} Instagram">  <i class="fa fa-instagram"></i></button> -->

												<button type="button" class="btn btn-danger" ng-click="moreInfoModal()" uib-tooltip="More About  {!!$userInfo->firstName !!} ">  <i class="fa fa-info-circle"></i></button>

												
											</div>
											</center>
											</div>
											</form>
											</div>
										</div>

										<div class="three-blocks">
											<div class="inside-box">
											<label class="font-styling2"><i class="fa fa-map-marker"></i> Location</label><br>
												<center class="frame-map2">
												<iframe class="frame-map" src="{{url()}}/maplocation/{!!$userInfo->id !!}"></iframe>
												</center>
											</div>
										</div>



									</div>


								</div>
							</div>
						</div>


					</div>


				</div>

				<div class="col-md-3">
					@include('right_sidebar')
				</div>

			</div>
		</div>
	</div>
</div>



<script type="text/ng-template" id="moreInfoModal.html">
	<div class="modal-header new-header">
		<button type="button" class="close" ng-click="closeModal()" aria-label="Close"><span class="font-styling" aria-hidden="true">&times;</span></button>

		<h3 class="modal-title font-styling-head" id="modal-title">
			<img ng-src="{!! $userInfo->photo !!}" class="pull-left img-thumbnail img-circle" width="150px" height="150px"> 
			{!!$userInfo->lastName !!}, {!!$userInfo->firstName !!}
			<img src="{{url()}}/public/images/modal/blue-heart.png" height="70" alt="">
		</h3>

	</div>
	<div class="modal-body" id="modal-body">
		<div class="row">
			@include('map.user-info')
			@include('map.user-places')
			@include('map.user-movies')

			<table id="header-fixed"></table>
		</div>
		<p class="lead text-center text-muted padding-top" ng-if="isLoading">
			<i class="fa fa-spinner fa-spin fa-3x" aria-hidden="true"></i>
		</p>
	</div>

</script>


@endsection