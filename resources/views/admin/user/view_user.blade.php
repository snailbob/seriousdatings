@include('admin.inc.header')

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Manage User
        <small>User info</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">User Management</a></li>
        <li class="active">User Info</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">

          <div class="box">
            <div class="box-body">

              <div class="col-xs-6 col-md-2">
              
                <a class="thumbnail">
                  <img src="{{ ($user->photo != 'placeholder.png') ? $user->photo : url().'/public/images/new_logo.png' }}" alt="">
                  {{--  {!! HTML::image('images/users/'.$user->username.'/'.$user->photo, 'alt', array( 'class' => '')) !!}  --}}
                </a> 
                @if($user -> photo != "placeholder.png")
                {{--  <img src="{{$user->photo}}" alt="">  --}}

                <a class="btn btn-danger btn-block" href="{!! url() !!}/admin/users/{!! $user -> id !!}/removePicture">
                  <i class="fa fa-trash-o" aria-hidden="true"></i> Remove Image
                </a> 
                <a class="btn btn-default btn-block" onclick="window.history.back()">
                  <i class="fa fa-angle-double-left" aria-hidden="true"></i> Back
                </a> 
                
                @endif
                
              </div>
              <div class="col-md-10">
                {{--  <table class="table table-bordered table-hover admin-table">
                  <tbody>
                    <tr>
                      <td class="text-bold" colspan="2">User Information :</td>
                    </tr>
                    <tr>
                      <td>Full Name</td>
                      <td>{!! $user->firstName !!} {!! $user->lastName !!} </td>
                    </tr>
                    <tr>
                      <td>Age </td>
                      <td>{!! $user->age !!}</td>
                    </tr>
                    <tr>
                      <td>Gender</td>
                      <td>{!! $user->gender !!}</td>
                    </tr>
                    <tr>
                      <td class="text-bold" colspan="2">Login Information :</td>
                    </tr>
                    <tr>
                      <td>email Address</td>
                      <td>{!! $user->email !!}</td>
                    </tr>
                    <tr>
                      <td>User Name </td>
                      <td>{!! $user->username !!}</td>
                    </tr>
                    
                    
                    <tr>
                      <td class="text-bold" colspan="2">Membership Information </td>
                    </tr>
                    <tr>
                        
                        @if($user->role == 1)
                        <td>Verified User</td>
                      @elseif($user->role == 2)
                        <td>Admin</td>
                      @elseif($user->role == 3)
                        <td>Non Verified User</td>
                      @elseif($user->role == 4)
                        <td>Subscribed To Dating Plan</td>
                      @else
                        <td></td>
                      @endif          
          
                    </tr>
                  </tbody>
                </table>  --}}


                <div class="panel panel-danger">
                    <div class="panel-heading">
                        <p class="panel-title lead text-uppercase">
                            {{ $user->firstName }} Info
                        </p>
                    </div>
                    <div class="panel-body">
                        <div class="row">

                            <div class="col-sm-12">
                                <p class="lead">
                                    {{ $user->name }}
                                <p>
                                <p>
                                    <cite ng-title="{{ $user->location }}">{{ $user->location }} <i class="fa fa-map-marker"></i></cite>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="panel panel-danger">
                    <div class="panel-heading">
                        <p class="panel-title lead text-uppercase">
                            Subscription Details
                        </p>
                    </div>

                    @if(isset($user->subscription_validity['payment_details']))


                      <ul class="list-group">
                        <li class="list-group-item">
                          Subscription Mode: <span class="text-muted">{{ $user->subscription_validity['mode'] }}</span>
                        </li>
                        <li class="list-group-item">
                          Gateway: <span class="text-muted">{{ $user->subscription_validity['gateway'] }}</span>
                        </li>
                        <li class="list-group-item">
                          Payment Plan: <span class="text-muted">{{ $user->subscription_validity->plan_details->name }}</span>
                        </li>
                        <li class="list-group-item">
                          Purchase Date: <span class="text-muted">{{ $user->subscription_validity['subscription_date'] }}</span>
                        </li>
                        <li class="list-group-item">
                          Passed Days: <span class="text-muted">{{ $user->subscription_validity['passed_days'] }}</span>
                        </li>
                        <li class="list-group-item">
                          Remaining Days: <span class="text-muted">{{ $user->subscription_validity['remaining_days'] }}</span>
                        </li>
                        <li class="list-group-item">
                          Subscription Status: 
                          
                          @if($user->subscription_validity['status_text'] == 'Active')
                          <span class="label label-success">{{ $user->subscription_validity['status_text'] }}</span>
                          @else
                            <span class="label label-danger">{{ $user->subscription_validity['status_text'] }}</span>
                          @endif
                        </li>
                      </ul>

                    @else
                    
                      <ul class="list-group">
                        <li class="list-group-item">
                          Subscription Mode: <span class="text-muted">{{ $user->subscription_validity['mode'] }}</span>
                        </li>
                        <li class="list-group-item">
                          Date Trial Started: <span class="text-muted">{{ $user->subscription_validity['subscription_date'] }}</span>
                        </li>
                        <li class="list-group-item">
                          Passed Days: <span class="text-muted">{{ $user->subscription_validity['passed_days'] }}</span>
                        </li>
                        <li class="list-group-item">
                          Trial Status: 
                          
                          @if($user->subscription_validity['status_text'] == 'Active')
                          <span class="label label-success">{{ $user->subscription_validity['status_text'] }}</span>
                          @else
                            <span class="label label-danger">{{ $user->subscription_validity['status_text'] }}</span>
                          @endif
                        </li>
                      </ul>

                    @endif
                    

                </div>

            
                <div class="panel panel-danger">
                    <div class="panel-heading">
                        <p class="panel-title lead">
                            BACKGROUND/VALUES
                        </p>
                    </div>
                    <ul class="list-group">
                        <li class="list-group-item">
                            Relationship goal: <span class="text-muted">{{ $user->relationshipGoal }}</span>
                        </li>
                        <li class="list-group-item">
                            Ethnicity: <span class="text-muted">{{ $user->ethnicity }}</span>
                        </li>
                        <li class="list-group-item">
                            Faith: <span class="text-muted">{{ $user->religiousBeliefs }}</span>
                        </li>
                        <li class="list-group-item">
                            Education: <span class="text-muted">{{ $user->educationLevel }}</span>
                        </li>
                        <li class="list-group-item">
                            Language: <span class="text-muted">{{ $user->language }}</span>
                        </li>
                    </ul>
                </div>

                <div class="panel panel-danger">
                    <div class="panel-heading">
                        <p class="panel-title lead">
                            LIFESTYLE
                        </p>
                    </div>
                    <ul class="list-group">
                        <li class="list-group-item">
                            Smoke: <span class="text-muted">{{ $user->smoke }}</span>
                        </li>
                        <li class="list-group-item">
                            Drink: <span class="text-muted">{{ $user->drink }}</span>
                        </li>
                        <li class="list-group-item">
                            Excercise frequency: <span class="text-muted">{{ $user->excercise }}</span>
                        </li>
                        <li class="list-group-item">
                            Has kids: <span class="text-muted">{{ $user->haveChildren }}</span>
                        </li>
                        <li class="list-group-item">
                            Occupation: <span class="text-muted">{{ $user->occupation }}</span>
                        </li>
                        <li class="list-group-item">
                            Salary range: <span class="text-muted">{{ $user->income }}</span>
                        </li>
                        <li class="list-group-item">
                            Zodiac Sign: <span class="text-muted">{{ $user->zodicSign }}</span>
                        </li>
                    </ul>
                </div>

                <div class="panel panel-danger">
                    <div class="panel-heading">
                        <p class="panel-title lead">
                            APPEARANCE
                        </p>
                    </div>
                    <ul class="list-group">
                        <li class="list-group-item">
                            Height: <span class="text-muted">{{ $user->height }}</span>
                        </li>
                        <li class="list-group-item">
                            Body type: <span class="text-muted">{{ $user->bodyType }}</span>
                        </li>
                        <li class="list-group-item">
                            Eye color: <span class="text-muted">{{ $user->eyeColor }}</span>
                        </li>
                        <li class="list-group-item">
                            Hair color: <span class="text-muted">{{ $user->hairColor }}</span>
                        </li>
                    </ul>
                </div>




              </div>

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
