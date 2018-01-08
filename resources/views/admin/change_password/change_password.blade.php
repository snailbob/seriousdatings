@include('admin.inc.header')

  <div class="content-wrapper">
    <section class="content-header">
      <h1>
        Administrator
        <small>Change Password</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Change Password</li>
      </ol>
    </section>
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="box box-primary">
            <div class="box-header with-border">
              @if($status=='Password changed successfully')
                <div class="alert alert-success alert-dismissible">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <h4><i class="icon fa fa-check"></i> {!! $status !!}</h4>
                </div>
              @else
                @if($status)
                  <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4><i class="icon fa fa-ban"></i> {!! $status !!}</h4>
                  </div>
                @elseif($errors->any())
                  <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h4><i class="icon fa fa-ban"></i> {{ implode('', $errors->all(':message')) }}</h4>
                  </div>
                @endif
              @endif
            </div>
        	  {!! Form::open
        			(
        				array(
        				'url' 		=> 'admin/change_password',
        				'method' 	=> 'post',
        				'files' 	=> true,
        				'role' 		=> 'form',
        				'id' 		=> 'form2'
        				)
        			)
        	  !!}
                  <div class="box-body">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Old Password</label>
                      <input type="password" class="form-control" id="password" name="oldPassword" placeholder="Enter Old Password" required>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">New Password</label>
                      <input type="password" class="form-control" id="newPassword" name="newPassword" placeholder="Enter New Password" required>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Confirm Password</label>
                      <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" placeholder="Confirm New Password" required>
                    </div>
                  </div>

              <div class="box-footer">
                <button type="submit" class="btn btn-success">Change Password</button>
              </div>
            {!! Form::close() !!}
          </div>
        </div>
      </div>
    </section>
  </div>

@include('admin.inc.footer')

</body>
</html>
   
