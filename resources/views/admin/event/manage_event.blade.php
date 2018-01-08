@include('admin.inc.header')

  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Manage Event
        <small>list of events</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Tables</a></li>
        <li class="active">Events</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">

          <div class="alert alert-info">
            <p class="lead">
              <i class="fa fa-info-circle" aria-hidden="true"></i> You earned a total ${{$earning_details['total_earnings']}} from {{$earning_details['total_members']}} members who joined in your {{count($events)}} events.
            </p>
          </div>

          <div class="box">
            <div class="box-body">
              @if(sizeof($events) < 1)
              <h3> No Events Exists!</h3>
              @else

              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th width="10%">Image</th>
                  <th width="15%">Title</th>
                  <th width="20%">Description</th>
                  <th width="10%">Location</th>
                  <th width="20%">Event Date</th>
                  <th width="15%">Event Category</th>
                  <th width="10%">Price</th>
                  <th width="10%">Status</th>
                  <th width="80px" class="text-center">Action</th>
                </tr>
                </thead>
                <tbody>

                  @foreach($events as $event)
                  <tr>
                    <td>
                        <div class="table-img">{!! HTML::image('public/images/events/'.$event->image, 'Event Image', array( 'class' => 'img-thumbnail img-responsive')) !!}</div>
                    </td>
                    <td>{!! $event -> title !!} </td>
                    <td>{!! substr(strip_tags($event -> description),0, 75) !!}</td>
                    <td><div class="table-description"><p>{!! $event -> eventLocation !!}</p></div></td>
                    <td><div class="table-description"><p>{!! date('d F, Y', strtotime($event->start)) !!} <br/> To <br/> {!! date('d F, Y', strtotime($event->endDate)) !!}</p></div></td>
                    <td><div class="table-description"><p>{!! $event -> name !!} </p></div></td>
                    <td><div class="table-description"><p>$ {!! $event -> eventPrice !!}</p></div></td>
                    <td><div class="table-description"><p class="text-success">{{$event -> status_text}}</p></div></td>
          
                    <td>
                        <div class="btn-group pull-right table-action custom">
                          <a class="btn btn-danger btn-sm dropdown-toggle" data-toggle="dropdown">
                            <i class="glyphicon glyphicon-pencil"></i> Action
                            <span class="caret"></span>
                          </a>
                          <ul role="menu" class="dropdown-menu">

                            <li>
                              <a href='events/{!! $event->eventID !!}/edit'>
                                <i class="fa fa-eye"></i> Details</a>
                            </li>
                            
                            <li>
                              <a class="send_event_invite" data-type="paid" data-info="{{ json_encode($event) }}">
                                <i class="fa fa-share"></i> Invite Paid Users</a>
                            </li>
                            <li>
                              <a class="send_event_invite" data-type="nonpaid" data-info="{{ json_encode($event) }}">
                                <i class="fa fa-share"></i> Invite Non-Paid Users</a>
                            </li>
                            <li>

                              {!! Form::open(array('url' => 'admin/events/' . $event->eventID, 'class' => '')) !!} {!! Form::hidden('_method', 'DELETE')
                              !!} {!! Form::button('
                              <i class="fa fa-trash-o"></i> Delete', array('type' => 'submit', 'class'=>'btn-block text-left')) !!} {!! Form::close() !!}
                            </li>

                          </ul>
                        </div>
                      </td>
                  </tr>
                  @endforeach

                </tbody>
              </table>

              @endif
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

@include('admin.inc.footer')

</body>
</html>
