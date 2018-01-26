@include('admin.inc.header')

<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Create Email Template
      <small>administration</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{url()}}/admin"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="{{url()}}/admin/definable_flirt_list"><i></i> Definable Flirt Message</a></li>
      <li class="active">Create Email Template</li>
    </ol>
  </section>
  <section class="content">
    <div class="row">
      <div class="col-md-12">

        <h2></h2>
      </div>
      <div class="box-body">
        <form id="flirt_message">
          <div class="form-group">
            <input type="text" class="hidden" id="id">
          </div>
          <div class="form-group">
            <label for="flirtName">Flirt Name</label>
            <input type="text" class="form-control" id="flirtName" aria-describedby="emailHelp" placeholder="Enter template name">
          </div>
          <label for="Content">Content</label>
          <textarea id="Content" name="editor1" rows="10" cols="80" value="">
          </textarea>
        </form>
        <div class="box-footer">
          <button id="saveBtn" class="btn btn-primary pull-right">Save</button>
        </div>
      </div>
    </div>
  </div>
</section>
</div>
</div>

@include('admin.inc.footer')
<meta name="csrf-token" content="{{ csrf_token() }}">
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script type="text/javascript">
  $(function () {
    CKEDITOR.replace( 'editor1', {
      // Define the toolbar groups as it is a more accessible solution.
      toolbarGroups: [
      {"name":"basicstyles","groups":["basicstyles"]},
      {"name":"paragraph","groups":["list","blocks"]},
      {"name":"document","groups":["mode"]},
      {"name":"insert","groups":["insert"]},
      {"name":"styles","groups":["styles"]},
      {"name":"about","groups":["about"]}
      ],
      // Remove the redundant buttons from toolbar groups defined above.
      removeButtons: 'Underline,Strike,Subscript,Superscript,Anchor,Styles,Specialchar,Image,Table,Source,Blockquote'
    } );
  })
</script>
{!! HTML::script('public/js/admin/definable_flirt/add_flirt.js') !!}
</body>
</html>
