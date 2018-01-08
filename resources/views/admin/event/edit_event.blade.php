@include('admin.inc.header')

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Manage Event
      <small>details events</small>
    </h1>
    <ol class="breadcrumb">
      <li>
        <a href="#">
          <i class="fa fa-dashboard"></i> Home</a>
      </li>
      <li>
        <a href="#">Events</a>
      </li>
      <li class="active">Details</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">

        <div class="box">
          <div class="box-body box-details">

            <div class="right-content-section">
              <div class="calendar-event-inner">
                <div class="calendar-event-title">
                  <div class="pull-right text-right">
                    <button class="btn btn-default" onclick="window.history.back()">
                      <i class="fa fa-angle-double-left" aria-hidden="true"></i> Back
                    </button>
                    <button class="btn btn-danger toggle-hide" data-tohide="box-details" data-toshow="box-form">
                      <i class="fa fa-pencil" aria-hidden="true"></i> Edit
                    </button>
                  </div>
                  <h2>
                    {{$event->title}} <span class="label label-success" data-toggle="tooltip" title="Total Earnings">${{$event->eventPrice * count($event->members)}}</span>
                  </h2>
                </div>

                <div class="row">
                  <div class="col-md-12">
                    <div class="padding">
                      
                      <div class="padding-top-15">
                        <img src="{{$event->image}}" alt="" class="img-responsive img-thumbnail">
                      </div>


                      <div class="padding-top">
                        <p>
                          <strong class="text-danger">Event Name</strong> <br>
                          <span class="text-muted">{{ $event->title}}</span>
                        </p>
                        <p class="padding-top-15">
                          <strong class="text-danger">Event Date</strong> <br>
                          Time Start: <span class="text-muted">{{ date_format(date_create($event->start), 'h:i a') }} {{ date_format(date_create($event->start), 'M d, Y') }}</span> <br>
                          Time End: <span class="text-muted">{{ date_format(date_create($event->endDate), 'h:i a') }} {{ date_format(date_create($event->endDate), 'M d, Y') }}</span>
                        </p>

                        <p class="padding-top-15">
                          <strong class="text-danger">Event Price</strong> <br>
                          <span class="label label-success">${{ $event->eventPrice}}</span> <br>
                        </p>


                        <p class="padding-top-15">
                          <strong class="text-danger">Event Size</strong> <br>
                          <span class="text-muted">{{ $event->min_members}} - {{ $event->max_members}} only</span> <br>
                        </p>

                        <p class="padding-top-15">
                          <strong class="text-danger">Event Location</strong> <br>
                          <span class="text-muted">{{ $event->eventLocation}}</span> <br>
                        </p>
                      </div>

                      <div class="padding-top-15">
                        <div id="map"></div>
                      </div>

                      <div class="padding-top-15">
                        <p>
                          <strong class="text-danger">Description</strong>
                        </p>
                        {!! $event->description !!}
                      </div>

                      <!-- 16:9 aspect ratio -->
                      @if($event->youtube_video)
                      <div class="padding">
                        <div class="embed-responsive embed-responsive-16by9">
                            <iframe class="embed-responsive-item" src="{{$event->youtube_video}}" frameborder="0" gesture="media" allow="encrypted-media" allowfullscreen></iframe>
                        </div>
                      </div>
                      @endif

                      <div class="padding-top-15">
                        <p>
                          <strong class="text-danger">
                            Event Members 
                          </strong>
                        </p>
                        
                        <div class="row">
                          @if(empty($event->members))
                          <div class="col-sm-12">
                            <div class="padding">
                              <p class="text-muted text-center">
                                No members yet.
                              </p>
                            </div>
                          </div>
                          @endif

                          @foreach($event->members as $member)
                          <div class="col-xs-4 col-sm-3 col-md-2 text-center text-muted padding-top-15">
                            <img src="{{$member->photo}}" alt="" class="img-responsive img-thumbnail">
                            <br> <span class="small">{{$member->firstName}} {{$member->lastName}}</span>
                          </div>
                          @endforeach
                        </div>
                      </div>

                    </div>

                  </div>
                </div>

              </div>
            </div>

          </div>


          <div class="box-body box-form hidden">

            {!! Form::open ( array( 'url' => 'admin/events/'.$event->id, 'method' => 'put', 'files' => true, 'role' => 'form', 'id' =>
            'event_form', 'novalidate'=>'novalidate' ) ) !!}
            <div class="form-horizontal">
              <div class="form-group">
                <label class="col-sm-2 control-label">Event Category
                  <span class="symbol required"></span>
                </label>
                <div class="col-sm-9">
                  <select name="eventCategory" class="form-control">
                    <option value="0"> Select Event Category</option>
                    @foreach($event -> eventCategory as $e)
                    <option <?=( $e->id==$event->eventType?'selected':'') ?> value="{!! $e -> id !!}">{!! $e -> name !!}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">Title
                  <span class="symbol required"></span>
                </label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" name="title" placeholder="Enter your title" value="{!! $event -> title !!}" required>
                  <!-- <input type="text" class="form-control" name="title" placeholder="Enter your title" required> -->
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">Location
                  <span class="symbol required"></span>
                </label>
                <div class="col-sm-9">
                  <input type="text" class="form-control input-geolocation" id="eventlocation" name="location" placeholder="Enter Event Location"
                    value="{!! $event -> eventLocation !!}" required>
                  <input type="hidden" name="lat" value="{!! $event -> lat !!}">
                  <input type="hidden" name="lng" value="{!! $event -> lng !!}">

                  <!-- <input type="text" class="form-control" id="eventlocation" name="location" placeholder="Enter Event Location" required> -->
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-2 control-label">Event Size
                  <span class="symbol required"></span>
                </label>
                <div class="col-sm-9">
                  <div class="row">
                    <div class="col-sm-6">
                      <label>Min.</label>
                      <input type="tel" name="min_members" required class="form-control form-control-number" value="{{ $event->min_members }}">

                    </div>
                    <div class="col-sm-6">
                      <label>Max.</label>

                      <input type="tel" name="max_members" required class="form-control form-control-number" value="{{ $event->max_members }}">

                    </div>

                  </div>
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-2 control-label">Date
                  <span class="symbol required"></span>
                </label>
                <div class="col-sm-9">
                  <div class="row">
                    <div class="col-sm-6">
                      <label>From:</label>

                      <div class="input-group date">
                        <div class="input-group-addon">
                          <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" name="fromDate" required class="form-control pull-right start-datepicker" value="{!! $event -> start !!}" name="fromDate">
                      </div>
                      <div class="bootstrap-timepicker">
                        <div class="padding-top-15">
                          <div class="input-group">

                            <div class="input-group-addon">
                              <i class="fa fa-clock-o"></i>
                            </div>
                            <input type="text" name="fromTime" required class="form-control timepicker" value="{!! $event -> start !!}">

                          </div>
                          <!-- /.input group -->
                        </div>
                        <!-- /.form group -->
                      </div>

                      {{--  <label>From:</label>
                      <div class="input-group">
                        <div class="input-group-addon">
                          <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" class="form-control" data-inputmask="'alias': 'yyyy-mm-dd'" value="{!! $event -> start !!}" name="fromDate"
                          data-mask required>
                      </div>  --}}

                    </div>
                    <div class="col-sm-6">
                      <label>To:</label>

                      <div class="input-group date">
                        <div class="input-group-addon">
                          <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" name="toDate" required class="form-control pull-right end-datepicker" value="{!! $event -> endDate !!}" name="toDate">
                      </div>


                      <div class="bootstrap-timepicker">
                        <div class="padding-top-15">
                          <div class="input-group">

                            <div class="input-group-addon">
                              <i class="fa fa-clock-o"></i>
                            </div>
                            <input type="text" name="toTime" required class="form-control timepicker" value="{!! $event -> endDate !!}">

                          </div>
                          <!-- /.input group -->
                        </div>
                        <!-- /.form group -->
                      </div>
                      {{--  <label>To:</label>
                      <div class="input-group">
                        <div class="input-group-addon">
                          <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" class="form-control" data-inputmask="'alias': 'yyyy-mm-dd'" value="{!! $event -> endDate !!}" name="toDate"
                          data-mask required>
                      </div>  --}}

                    </div>
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">Upload Picture
                  <span class="symbol required"></span>
                </label>
                <div class="col-sm-9">
                  <div class="file-upload">
                    <input type="file" class="file-input ImgeInput" name="uploadpicture" id="uploadpicture" accept="image/*" />
                    <!--<img class="targetImage" src="public/images/targetImage.png" alt="" />-->
                    {!! HTML::image($event->image, 'alt', array( 'class' => 'targetImage')) !!}
                    <div class="img">File size should be 686 x 547</div>
                  </div>

                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-2 control-label">Youtube Video
                  <span class="symbol required"></span>
                </label>
                <div class="col-sm-9">
                  <input type="url" class="form-control" name="youtube_video" placeholder="eg. https://www.youtube.com/embed/CkC7K_4xlik" value="{{ $event -> youtube_video }}">
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-2 control-label">Description</label>
                <div class="col-sm-9">
                  <textarea class="textarea" name="description" style="width: 100%; height: 125px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">
                    {!! $event -> description !!}
                  </textarea>
                  <!-- <textarea  class="form-control summernote" name="description"></textarea> -->
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">Price
                  <span class="symbol required"></span>
                </label>
                <div class="col-sm-9">
                  <input type="number" class="form-control" id="price" name="price" placeholder="Enter Event Charges" value="{!! $event -> eventPrice !!}"
                    required>
                  <!-- <input type="number" class="form-control" id="price" name="price" placeholder="Enter Event Charges" required> -->
                </div>
              </div>
              <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                  <input type="submit" value="Submit" class="btn btn-success">
                  <input type="button" value="Cancel" class="btn btn-danger toggle-hide" data-tohide="box-form" data-toshow="box-details">
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
<script src="{{ url() }}/public/dist/js/pages/advance-form.js"></script>



</body>
</html>
