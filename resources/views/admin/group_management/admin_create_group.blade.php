@include('admin.inc.header')
{{--{{dd($test)}}--}}
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Group Management
            <small>create group</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{url()}}/admin"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active"><a href="#">Group Management</a></li>
            <li class="active">Create Group</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <form id="create_post" role="form" action="{{URL::to('/addGroupNames')}}"
              method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            <div class="ar_middle-content-section">

                <div class="row">
                    <div class="col-md-12">
                        <div class="group_inner_box">

                            <div class="upload-profile" style="margin-top:30px; margin-left:0px;">
                                <div class="image-border">
                                    <img src="" id="profile-img-tag"/>
                                </div>
                                <div class="fileUpload uplod_button">
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
    </section>
</div>
@include('admin.inc.footer')

<meta name="csrf-token" content="{{ csrf_token() }}">
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
{!! HTML::script('public/js/admin/group_management/grouplist.js') !!}

</body>
</html>
