@include('admin.inc.header')

{{--{{dd($echecks)}}--}}
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            E-Checks
            <small>lists of E-Checks</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{url()}}/admin"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">E-Checks Payment List</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-body">
                        <table id="ads_pricing_tbl" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>Username</th>
                                <th>Amount</th>
                                <th>Account number</th>
                                <th>Routing number</th>
                                <th>Dating Plan</th>
                                <th>Status</th>
                                <th>Image</th>
                                <th width="80px" class="text-center">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($echecks as $echeck)
                                <tr>
                                    <td>
                                        <img src="{{$echeck['user']['photo']}}" class="img-circle " width="45" alt="">
                                        {{ ' '. $echeck['user']['username'] }}
                                    </td>
                                    <td class="">{{ $echeck['details']['price'] }}</td>
                                    <td class="">{{ $echeck['details']['account_no'] }}</td>
                                    <td class="">{{ $echeck['details']['routing_number'] }}</td>
                                    <td class="">{{ $echeck['dating_plan']['name'] }}</td>
                                    <td class="">
                                        @if(is_numeric($echeck['status']))
                                            @if($echeck['status'])
                                                Accepted
                                            @else
                                                Rejected
                                            @endif
                                        @else
                                            Pending
                                        @endif
                                    </td>
                                    <td class=""><img src="{{ $echeck['details']['image'] }}" alt="echeck photo">
                                    </td>
                                    <td id="{{ $echeck['id'] }}">
                                        <div class="btn-group pull-right table-action custom"><a
                                                    class="btn btn-danger btn-sm dropdown-toggle"
                                                    data-toggle="dropdown"> <i class="fa fa-pencil"></i> Action
                                                <span
                                                        class="caret"></span> </a>
                                            <ul class="dropdown-menu">
                                                @if(is_numeric($echeck['status']))
                                                    @if($echeck['status'])
                                                        <li class="rejectBtn">
                                                            <a href='#'><i class="fa fa-trash-o"></i> Reject</a>
                                                        </li>
                                                    @else
                                                        <li class="acceptBtn">
                                                            <a href='#'> <i class="fa fa-check"></i> Accept</a>
                                                        </li>
                                                    @endif
                                                @else
                                                    <li class="acceptBtn">
                                                        <a href='#'> <i class="fa fa-check"></i> Accept</a>
                                                    </li>
                                                    <li class="rejectBtn">
                                                        <a href='#'><i class="fa fa-trash-o"></i> Reject</a>
                                                    </li>
                                                @endif
                                            </ul>
                                        </div>
                                    </td>
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
{!! HTML::script('public/js/admin/payment_methods/echeck_actions.js') !!}
</body>
</html>
