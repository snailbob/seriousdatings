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
        <h3>Manage Templates  <a href="{!! url() !!}/admin/templates/create" class="pull-right btn btn-facebook btn-sm" type="button"><i class="fa fa-plus-square"></i>&nbsp; Add Template</a></h3>
      </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="panel panel-white">
            <div class="panel-body">
              @if(sizeof($templates) < 1)
              <h3> No Templates Exists!</h3>
              @else
              <table class="table table-bordered table-hover admin-table">
                <thead>
                  <tr>
                    <th width="5%" class="center"> <div class="table-checkbox">
                        <label>
                          <input id="selectAll" type="checkbox">
                        </label>
                      </div></th>
                    <th width="15%" >Id</th>
                    <th width="5%">Template Name</th>
					<th width="5%">Template Subject</th>
					
                    <th width="20%">Date</th>
                    <th width="5%" class"text-center">Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($templates as $template)
                  <tr>
                    <td class="center hidden-xs"><div class="table-checkbox">
                        <label>
                          <input type="checkbox">
                        </label>
                      </div></td>

                    <td>{!! $template->id !!} </td>
					<td>{!! $template->template_name !!} </td>
					<td>{!! $template->template_subject !!} </td>
					<td>{!! date('d F, Y', strtotime($template->created_at)) !!} </td>
					<td><div class="btn-group table-action"> <a class="btn btn-flickr btn-sm dropdown-toggle" data-toggle="dropdown"> <i class="glyphicon glyphicon-pencil"></i> Action <span class="caret"></span> </a>
                        <ul role="menu" class="dropdown-menu">
                          <li><a href='templates/{!! $template->id !!}/edit'> <i class="fa fa-pencil"></i> Edit</a></li>
						  <li><a href="templates/{!! $template->id !!}"> <i class="fa fa-eye"></i> View</a></li>
                          <li>
                              {!! Form::open(array('url' => 'admin/templates/' . $template->id, 'class' => '')) !!}
                                {!! Form::hidden('_method', 'DELETE') !!}
                                {!! Form::button('<i class="fa fa-trash-o"></i> Delete', array('type' => 'submit')) !!}
                             {!! Form::close() !!}
                          </li>
                        </ul>
                      </div></td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
              @endif
            </div>
          </div>
        </div>
	</div>
	
	<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
     <div class="modal-header">
        <button aria-label="Close" data-dismiss="modal" class="close" type="button"><span aria-hidden="true">×</span></button>
        <h4 id="myModalLabel" class="modal-title">{!! $template->template_name !!} Preview</h4>
      </div>
      <div class="modal-body">
        <div class="embed-responsive embed-responsive-16by9">
			<iframe src="templates/{!! $template->id !!}/content" class="embed-responsive-item" id ="iframe_modal"></iframe>
			 
          
        </div>
      </div>
    </div>
  </div>
  </div>
@stop


   
