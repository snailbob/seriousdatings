@include('admin.inc.header')

<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Administrator
      <small>Add Email Template</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="{{url()}}/admin"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href=""></a>Email Template Lists</li>
      <li class="active">Add Email Template</li>
    </ol>
  </section>
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box box-primary">
          <div class="box-header with-border">
            <h2></h2>
          </div>
          <div class="box-body">
            <form id="edit_email">
              <div class="form-group">
                <label for="Name">Template Name</label>
                <input type="text" class="form-control" id="Name" aria-describedby="emailHelp" placeholder="Enter template name">
              </div>
              <div class="form-group">
                <label for="Subject">Template Subject</label>
                <input type="text" class="form-control" id="Subject" placeholder="Enter template subject">
              </div>
                <label for="Content">Template Content</label>
                <textarea id="Content" name="editor1" rows="10" cols="80" value="">
                </textarea>
              </form>
            </div>
          </div>
          <div class="box-footer">
            <button id="saveBtn" class="btn btn-primary pull-right">Save</button>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

@include('admin.inc.footer')
<meta name="csrf-token" content="{{ csrf_token() }}">
<script type="text/javascript">
  $(function () {
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    CKEDITOR.replace('editor1')
  })
</script>   
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

{!! HTML::script('public/js/admin/editable_email/editable_email.js') !!}
</body>
</html>
