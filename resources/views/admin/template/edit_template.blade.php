@extends('admin.includes.dashboard')
	@section('content')
        <div class="main-content"> 
      <!-- end: SPANEL CONFIGURATION MODAL FORM -->
      
          <div class="page-header">
            <h3>Add Template  <a href="{!! url() !!}/admin/templates" class="pull-right btn btn-facebook btn-sm" type="button"><i class="fa fa-plus-square"></i>&nbsp; Manage template</a></h3>
          </div>
        
      </div>
	  {!! Form::open
			(
				array(
				'url' 		=> 'admin/templates/'.$template->id,
				'method' 	=> 'put',
				'files' 	=> true,
				'role' 		=> 'form',
				'id' 		=> 'form2'
				)
			)
	  !!}
       <div class="form-horizontal">
        <div class="">
          <div class="successHandler alert alert-success no-display alert-dismissible fade in">
            <button aria-label="Close" data-dismiss="alert" class="close" type="button"><span aria-hidden="true">×</span></button>
            <strong>You have some form errors!</strong> Please check below. </div>
          <div class="errorHandler alert alert-danger no-display alert-dismissible fade in">
            <button aria-label="Close" data-dismiss="alert" class="close" type="button"><span aria-hidden="true">×</span></button>
            <strong>You have some form errors!</strong> Please check below. </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label">Template Name <span class="symbol required"></span></label>
          <div class="col-sm-9">
            <input type="text" class="form-control"  placeholder="Template Name" name="template_name" value = {!! $template->template_name !!} required>
          </div>
        </div>
        <div class="form-group">
          <label class="col-sm-2 control-label">Subject <span class="symbol required"></span></label>
          <div class="col-sm-9">
            <input type="text" class="form-control"  placeholder="Enter Subject" name="template_subject" value = {!! $template->template_subject !!}required>
          </div>
        </div>
        
        
        <div class="form-group">
          <label class="col-sm-2 control-label">Content<span class="symbol required"></span></label>
          <div class="col-sm-9">
            <textarea  class="form-control summernote" id="description" name="template_content" >
			@if ($template->template_content === null)
				@include('admin.includes.sample_template')
			@else
				{!! $template->template_content !!}
			@endif
			
            </textarea>
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-offset-2 col-sm-10">
            <input type="submit" value="Save" id="Submit" class="btn btn-success">
            <input type="button" value="Cancel" id="Cancel" class="btn btn-danger">
          </div>
        </div>
      </div>
	{!! Form::close() !!}
@stop

   
