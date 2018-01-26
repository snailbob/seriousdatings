@include('admin.inc.header')


<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Date/Time Formatting
            <small>settings</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{url()}}/admin"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Date/Time Formatting</li>
        </ol>
    </section>
<!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-2">Date Format</div>
                            <div class="col-md-8">
                                <form action="">
                                    @foreach($dates as $key => $value)
                                        @if($key == $default[0]->date)
                                            <input type="radio" name="date" value="{{$key}}" checked> {!! $value !!}<br>
                                        @else
                                            <input type="radio" name="date" value="{{$key}}"> {!! $value !!}<br>
                                        @endif
                                    @endforeach
                                </form>
                            </div>
                        </div>
                        <hr>
                        <div c  lass="row">
                            <div class="col-md-2">Time Format</div>
                            <div class="col-md-8">
                                <form action="">
                                    @foreach($times as $key => $value)
                                        @if($key == $default[0]->time)
                                            <input type="radio" name="time" value="{{$key}}" checked> {!! $value !!}<br>
                                        @else
                                            <input type="radio" name="time" value="{{$key}}"> {!! $value !!}<br>
                                        @endif
                                    @endforeach
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12">
                <button id="saveBtn"  class="btn btn-primary">Save</button>
            </div>
        </div>
    </section>
</div>
@include('admin.inc.footer')

<meta name="csrf-token" content="{{ csrf_token() }}">
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
{!! HTML::script('public/js/admin/date_time_format/formatting.js') !!}
</body>
</html>
