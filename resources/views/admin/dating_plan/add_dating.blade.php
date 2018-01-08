@include('admin.inc.header')

  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        Manage Dating Plans
        <small>add new plan</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Dating Plans</a></li>
        <li class="active">Add New</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">

          <div class="box">
            <div class="box-body">

              {!! Form::open
                (
                  array(
                  'url'     => 'admin/dating_plans',
                  'method'  => 'post',
                  'files'   => true,
                  'role'    => 'form',
                  'id'    => 'form2'
                  )
                )
              !!}
                <div class="form-horizontal">
                  <div class="form-group">
                    <label class="col-sm-2 control-label">Plan Type <span class="symbol required"></span></label>
                    <div class="col-sm-9">
                      <select name="planType" class="form-control">
                        <option value="0"> Select Event Category</option>
                        <option value="Daily"> Daily</option>
                        <option value="Monthly"> Monthly</option>
                        <option value="Yearly"> Yearly</option>
                      </select>  
                    </div>
                    </div>

                    <div class="form-group">
                    <label class="col-sm-2 control-label">No Of Days / Months / Years <span class="symbol required"></span></label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="" placeholder=" No Of Days / Months / Years" name="noOfDay" required>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-sm-2 control-label">Plan Name <span class="symbol required"></span></label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control"   placeholder="Enter your plan name" name="planName" required >
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-sm-2 control-label">Plan Price <span class="symbol required"></span></label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="" placeholder="Enter plan Price" name="price" required>
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-sm-2 control-label"> Discount ( % ) <span class="symbol required"></span></label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="" placeholder="Enter percentage" name="discountPercentage" required>
                    </div>
                  </div>


                  <div class="form-group">
                    <label class="col-sm-2 control-label">Description</label>
                    <div class="col-sm-9">
                      <textarea class="textarea" name="description" style="width: 100%; height: 125px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">
                      </textarea>
                      <!-- <textarea  class="form-control summernote" name="description"></textarea> -->
                    </div>
                  </div>


                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <input type="submit" value="Submit" class="btn btn-success">
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
