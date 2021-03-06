@include('admin.inc.header')

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Manage Gift Cards
        <small>edit gift card</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Gift Cards</a></li>
        <li class="active">Edit</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          
          <div class="box">
            <div class="box-body">

              {!! Form::open
                (
                  array(
                  'url'     => 'admin/gift_cards/'.$card->id,
                  'method'  => 'put',
                  'files'   => true,
                  'role'    => 'form',
                  'id'    => 'form2'
                  )
                )
              !!}
                <div class="form-horizontal">
                  <div class="form-group">
                    <label class="col-sm-2 control-label">Gift Name<span class="symbol required"></span></label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control"  placeholder="Enter your Gift Name"  name= "name"  value = "{!! $card->name!!}" required>
                    </div>
                  </div>
                  
                  
                  <div class="form-group">
                    <label class="col-sm-2 control-label">Gift Picture <span class="symbol required"></span></label>
                    <div class="col-sm-3">
                    <div class="file-upload">
                      <input type="file" class="file-input ImgeInput" name="uploadpicture"/>
                
                      {!! HTML::image('public/images/gift_cards/'.$card->image, 'alt', array( 'class' => 'targetImage')) !!}
                      <div class="img">File size should be 686 x 547</div>
                     </div>
                    
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-sm-2 control-label">Gift Price<span class="symbol required"></span></label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control"  placeholder="Enter your gift price" name="price" value = "{!! $card->price !!}" required >
                    </div>
                  </div>
                  
                  
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <input type="submit" value="Save" class="btn btn-success">
                      <input type="button" value="Cancel" class="btn btn-danger">
                    </div>
                  </div>
                </div>
              {!! Form::close() !!}

            </div>
          </div>

        </div>
      </div>
    </section>

  </div>


@include('admin.inc.footer')

<script>
  $(function () {
    $('#example1').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })
</script>

</body>
</html>