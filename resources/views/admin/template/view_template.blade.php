@extends('admin.includes.dashboard')
	@section('content')
  <style>
    button {
        color:none;
        background:none;
        border: none;
        outline:none;
        padding: 0px;
        cursor: pointer;
        height: 0px;
    }
  </style>
    <div class="main-content"> 
      <!-- end: SPANEL CONFIGURATION MODAL FORM -->
      <div class="page-header">
        <h3>Manage Templates  <a href="{!! url() !!}/admin/templates" class="pull-right btn btn-facebook btn-sm" type="button"><i class="fa fa-plus-square"></i>&nbsp; Manage Template</a></h3>
      </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="panel panel-white">
            <div class="panel-body">
             
              <h3>Template Name:  <u>{!! $template->template_name !!}</u></h3>
              <p> {!! $template->template_content !!} </p>
			  </div>
          </div>
        </div>
	</div>
@stop


   
