@extends('master')
@section('form_area')

<div class="inner-header upcoming-banner">
	<div class="container">
		<h1>
			<!--<i class="calendar-event-icon"><img src="{!! url() !!}/images/upcoming-event-icon.png"  alt=""></i>-->Create Group</h1>
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
				{!! Form::open( array( 'url' => 'groups', 'novalidate' => 'novalidate', 'id' => 'groupCreate', 'files' => true)) !!}

				<div class="ar_middle-content-section">

					<div class="row">
						<div class="col-md-12">
							<h3 style="color: #FFF; background: #E21D24;font-weight:600;font-size: 22px;width: 100%;padding:7px 10px;margin:0; line-height:28px;">
								<!--<i class="calendar-event-icon"><img src="{!! url() !!}/images/upcoming-event-icon.png"  alt=""></i>-->Create Group
							</h3>
						</div>

						<div class="col-md-12">
							<div class="group_inner_box">

								<div class="upload-profile" style="margin-top:30px; margin-left:0px;">
									<div class="image-border">
										{!! HTML::image('images/profile-img.jpg', 'Profile Picture', array('id' => 'blah')) !!}
									</div>
									<div class="fileUpload uplod_button">
										<span>Upload</span>
										<input id="uploadBtn" type="file" class="upload imgInp" name="photo" required/>
									</div>
								</div>

								<div class="profile-img-styling" style="float:none;">

									<div class="three-blocks" style="width:100%;float:left; margin-right:0px;">
										<label>Group Type*</label>
										<select name="groupType" required class="form-control">
											<option value="">Select Group Type</option>
											<option value="Public">Public Group </option>
											<option value="Private">Private Group </option>
										</select>

										<br />
										<!--<div class="select-type"><small></small></div>-->
										<label>Group Name*</label>
										<input type="text" class="form-control" name="groupName" id="groupName" placeholder="Group Name" required />
										<br />
										<textarea name="description" id="description" class="form-control" placeholder="Description"></textarea>
										<input type="hidden" name="userId" id="userId" value="{!! $data !!}" required/>
										<label for="corner">
											<span></span>
										</label>
									</div>



								</div>

								<input type="submit" value="Create Group" class="comman-btn margin_5" /> {!! Form::close() !!}

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



@endsection