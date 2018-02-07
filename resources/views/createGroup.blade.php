@extends('master')

@section('css-scripts')
@endsection

@section('javascript')
    {!! HTML::script('public/js/groups/user_create_group.js') !!}
@endsection

@section('form_area')
    <div class="inner-header upcoming-banner">
        <div class="container">
            <h1>
            <h1>
            <!--<i class="calendar-event-icon"><img src="{!! url() !!}/images/upcoming-event-icon.png"  alt=""></i>-->
                Create Group</h1>
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
{{--                    {!! Form::open( array( 'url' => 'groups', 'novalidate' => 'novalidate', 'id' => 'groupCreate', 'files' => true)) !!}--}}
                    <form id="create_post" role="form" action="{{URL::to('/createGroup')}}"
                          method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                    <div class="ar_middle-content-section">

                        <div class="row">
                            <div class="col-md-12">
                                <h3 style="color: #FFF; background: #E21D24;font-weight:600;font-size: 22px;width: 100%;padding:7px 10px;margin:0; line-height:28px;">
                                <!--<i class="calendar-event-icon"><img src="{!! url() !!}/images/upcoming-event-icon.png"  alt=""></i>-->
                                    Create Group
                                </h3>
                            </div>
                            <div class="col-md-12">
                                <div class="group_inner_box">

                                    <div class="upload-profile" style="margin-top:30px; margin-left:0px;">
                                        <div class="image-border">
                                            <img src="" id="profile-img-tag"/>
                                        </div>
                                        <div class="fileUpload uplod_button">
                                            <span>Upload</span>
                                            <input id="uploadBtn" type="file" class="upload imgInp" name="photo"
                                                   accept="image/*"
                                                   required/>
                                        </div>
                                    </div>
                                    <div class="profile-img-styling" style="float:none;">
                                        <div class="three-blocks" style="width:100%;float:left; margin-right:0px;">
                                            <label>Group Type*</label>
                                            <select name="groupType" class="form-control" required>
                                                <option value="" selected disabled>Select Group Type</option>
                                                <option value="0">Public Group</option>
                                                <option value="1">Private Group</option>
                                            </select>
                                            <br/>
                                            <label>Group Name*</label>
                                            <input type="text" class="form-control" name="groupName" id="groupName"
                                                   placeholder="Group Name" required/>
                                            <br/>
                                            <textarea name="description" id="description" class="form-control"
                                                      placeholder="Description"></textarea>
                                            <input type="hidden" name="userId" id="userId" value="{!! $data !!}"
                                                   required/>
                                            <label for="corner">
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                    <input type="submit" value="Create Group" class="comman-btn margin_5"/>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{--{!! Form::close() !!}--}}
                    </form>
                </div>


                <div class="col-md-3">
                    @include('right_sidebar')
                </div>

            </div>
        </div>
    </div>
@endsection