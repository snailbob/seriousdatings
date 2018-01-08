@include('admin.inc.header')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Manage Event Types
            <small>list of event types</small>
        </h1>
        <ol class="breadcrumb">
            <li>
                <a href="#">
                    <i class="fa fa-dashboard"></i> Home</a>
            </li>
            <li>
                <a href="#">Events Management</a>
            </li>
            <li class="active">Event Types</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                @if(Session::has('success'))
                <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>

                    {{Session::get('success')}}
                </div>
                @endif

                <div class="box">
                    <div class="box-body">
                        @if(empty($event_types))
                        <h3 class="text-muted text-center"> Nothing to show you.</h3>
                        @else

                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th width="30%">Name</th>
                                    <th width="30%">Male Age Range</th>
                                    <th width="30%">Female Age Range</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach($event_types as $event)
                                <tr>

                                    <td>{{ $event->name }} </td>
                                    <td>{{ $event->ageFromMale }} - {{ $event->ageToMale }}</td>
                                    <td>{{ $event->ageFromFemale }} - {{ $event->ageToFemale }}</td>

                                    <td>
                                        <div class="btn-group pull-right table-action custom">
                                            <a class="btn btn-danger btn-sm dropdown-toggle" data-toggle="dropdown">
                                                <i class="glyphicon glyphicon-pencil"></i> Action
                                                <span class="caret"></span>
                                            </a>
                                            <ul role="menu" class="dropdown-menu">

                                                <li>
                                                    <a href='eventtype/{!! $event->id !!}/edit'>
                                                        <i class="fa fa-pencil"></i> Edit</a>
                                                </li>
                                                <li>
                                                    {!! Form::open(array('url' => 'admin/events/delete_eventtypes/' . $event->id, 'class' => '')) !!} {!! Form::hidden('_method',
                                                    'DELETE') !!} {!! Form::button('
                                                    <i class="fa fa-trash-o"></i> Delete', array('type' => 'submit')) !!} {!! Form::close() !!}
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
