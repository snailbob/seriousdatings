@extends('master')

@section('form_area')


<div class="inner-header upcoming-banner">
    <div class="container">
        <h1>
            Add Videos
        </h1>
    </div>
</div>
<div class="inner-contendbg">

    <div class="container">

        <div class="row">

            @include('new_leftsidebar')


            <div class="col-md-6">

                <div class="ar_middle-content-section">

                    <div class="row">

                        <div class="col-md-12">
                            <div>
                                <h2 style="color: #FFF; background: #E21D24; line-height: 28px; font-weight:600;font-size: 22px;width: 100%;padding:7px 10px;margin:0">ADD VIDEOS</h2>
                            </div>
                            <div>

                                <div class="create_grup">
                                    <div class="main_frm">

                                        {!! Form::open ( array( 'url' => 'profile/video', 'method' => 'post', 'files' => true, 'role' => 'form', 'id' => 'register-form',
                                        'novaidate' => 'novalidate' ) ) !!}
                                        <div class="form-group frmdiv">
                                            <label for="exampleInputName2">Select Type</label>
                                            <br />
                                            <select name="video_type" id="video_type" style="border: 1px solid #ccc; padding: 5px 5px; margin: 5px 0px; width:100%;"
                                                required>
                                                <option value="default">Select Type</option>
                                                <option value="1">Youtube</option>
                                                <option value="0">From Computer</option>
                                            </select>
                                        </div>
                                        <div class="form-group frmdiv" id="offline">

                                            <label for="exampleInputName2">Select Video(s)</label>
                                            <br /> {!! Form::file('images[]', array('multiple'=>true, 'class' => 'file-input ImgeInput
                                            ad_photo_input', 'id'=>'multi_video')) !!}
                                        </div>
                                        <br />
                                        <div class="form-group frmdiv" id="online">
                                            <label for="exampleInputName2">Youtube Video Link</label>
                                            <br />
                                            <input type="text" name="link" placeholder="Youtube Link" class="ad_vd_input" id="youTubeUrl" onkeyup="validateYouTubeUrl()">
                                        </div>
                                        <br />
                                        <div>
                                            <input class="btn btn-default" type="reset" value="Cancel" style="background: #e21d24; color: #FFF;">
                                            <input class="btn btn-default" type="submit" value="Submit" style="background: #56E034; color: #FFF;">
                                        </div>

                                        {!! Form::close() !!}
                                    </div>

                                </div>
                            </div>

                        </div>

                    </div>

                </div>

            </div>

            <div class="col-md-3">
                @include('right_sidebar')
            </div>

        </div>

    </div>

</div>


@stop
