@include('admin.inc.header')

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Manage Event
      <small>add new events</small>
    </h1>
    <ol class="breadcrumb">
      <li>
        <a href="#">
          <i class="fa fa-dashboard"></i> Home</a>
      </li>
      <li>
        <a href="#">Events</a>
      </li>
      <li class="active">Add New</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-xs-12">

        <div class="box">
          <div class="box-body">

            {!! Form::open ( array( 'url' => 'admin/events', 'method' => 'post', 'files' => true, 'role' => 'form', 'id' => 'event_form', 'novalidate'=>'novalidate' )
            ) !!}
            <div class="form-horizontal">
              <div class="form-group">
                <label class="col-sm-2 control-label">Event Category
                  <span class="symbol required"></span>
                </label>
                <div class="col-sm-9">
                  <select name="eventCategory" class="form-control" required>
                    <option value=""> Select Event Category</option>
                    @foreach($event as $e)
                    <option value="{!! $e -> id !!}">{!! $e -> name !!}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">Title
                  <span class="symbol required"></span>
                </label>
                <div class="col-sm-9">
                  <input type="text" class="form-control" name="title" placeholder="Enter your title" required>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">Location
                  <span class="symbol required"></span>
                </label>
                <div class="col-sm-9">
                  <input type="text" class="form-control input-geolocation" id="eventlocation" name="location" placeholder="Enter Event Location"
                    required>
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
                      <input type="tel" name="min_members" required class="form-control form-control-number" value="">

                    </div>
                    <div class="col-sm-6">
                      <label>Max.</label>

                      <input type="tel" name="max_members" required class="form-control form-control-number">

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
                        <input type="text" name="fromDate" required class="form-control pull-right start-datepicker" value="">
                      </div>

                      {{--
                      <label>From:</label>
                      <div class="input-group">
                        <div class="input-group-addon">
                          <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" class="form-control" data-inputmask="'alias': 'yyyy-mm-dd'" name="fromDate" data-mask required>
                      </div> --}}


                      <div class="bootstrap-timepicker">
                        <div class="padding-top-15">
                          <div class="input-group">

                            <div class="input-group-addon">
                              <i class="fa fa-clock-o"></i>
                            </div>
                            <input type="text" name="fromTime" required class="form-control timepicker">

                          </div>
                          <!-- /.input group -->
                        </div>
                        <!-- /.form group -->
                      </div>

                      <!-- <input type="text" class="form-control frm_datepicker" placeholder="From" id="fromDate" name="fromDate" required> -->
                    </div>
                    <div class="col-sm-6">
                      <label>To:</label>

                      <div class="input-group date">
                        <div class="input-group-addon">
                          <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" name="toDate" required class="form-control pull-right end-datepicker">
                      </div>


                      {{--
                      <label>To:</label>
                      <div class="input-group">
                        <div class="input-group-addon">
                          <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" class="form-control" data-inputmask="'alias': 'yyyy-mm-dd'" name="toDate" data-mask required>
                      </div> --}}

                      <div class="bootstrap-timepicker">
                        <div class="padding-top-15">
                          <div class="input-group">

                            <div class="input-group-addon">
                              <i class="fa fa-clock-o"></i>
                            </div>
                            <input type="text" name="toTime" required class="form-control timepicker">

                          </div>
                          <!-- /.input group -->
                        </div>
                        <!-- /.form group -->
                      </div>

                    </div>

                    <!-- <input type="text" class="form-control frm_datepicker" placeholder="To" id="toDate" name="toDate" required> -->
                  </div>
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-2 control-label">Upload Picture
                  <span class="symbol required"></span>
                </label>
                <div class="col-sm-9">
                  <label class="file-upload" for="uploadpicture">
                    <input type="file" class="file-input ImgeInput" name="uploadpicture" id="uploadpicture" accept="image/*" required/>
                    <!--<img class="targetImage" src="images/targetImage.png" alt="" />-->
                    {!! HTML::image('public/images/targetImage.png', 'alt', array( 'class' => 'targetImage')) !!}
                    <div class="img">File size should be 686 x 547</div>
                  </label>

                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-2 control-label">Youtube Video
                  <span class="symbol required"></span>
                </label>
                <div class="col-sm-9">
                  <input type="url" class="form-control" name="youtube_video" placeholder="eg. https://www.youtube.com/embed/CkC7K_4xlik">
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
                <label class="col-sm-2 control-label">Price
                  <span class="symbol required"></span>
                </label>
                <div class="col-sm-9">
                  <input type="tel" class="form-control form-control-number" id="price" name="price" placeholder="Enter Event Charges" required>
                </div>
              </div>
              <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                  <input type="submit" value="Submit" class="btn btn-success">
                  <input type="button" value="Cancel" class="btn btn-danger" onclick="window.history.back()">
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
