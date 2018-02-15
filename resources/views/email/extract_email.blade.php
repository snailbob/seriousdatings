@include('admin.inc.header')



<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Users
      <small>list of users' email</small>
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li><a href="#">Tables</a></li>
      <li class="active">Users' email</li>
    </ol>
  </section>
  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="box">
          <div class="box box-header">
            <a href="#" id="export" class="btn btn-success pull-left"><i class="fa fa-sign-out"></i> Export to CSV
            </a>
          </div>
          <div class="box-body">
            <table id="user_list_tbl" class="table table-bordered table-striped">
              <thead>
                <tr>
                  <th>Username</th>
                  <th>Email</th>
                  <th>Verified</th>
                </tr>
              </thead>
              <tbody>
                @foreach($users as $user)
                <tr>
                  <td>
                    <img src="{{$user->photo}}" class="img-circle " width="45" alt="">
                    {{ ' '.$user->username }}
                  </td>
                  <td class="user_email_cell">{{$user->email}} </td>

                  @if($user->verified == 1)
                  <td><label class=" label label-success">Yes</label></td>
                  @else
                  <td><label class=" label label-danger">No</label></td>
                  @endif
                </tr>

                @endforeach

              </tbody>
            </table>

          </div>
        </div>
      </div>
    </div>
  </section>
</div>

@include('admin.inc.footer')

<meta name="csrf-token" content="{{ csrf_token() }}">
{!! HTML::script('public/js/toastr/toastr.min.js') !!}
{!! HTML::script('public/js/admin/editable_email/extract_email.js') !!}
</body>
</html>
