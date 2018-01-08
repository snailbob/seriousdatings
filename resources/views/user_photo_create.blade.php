@extends('master')

@section('form_area')
<div class="inner-header upcoming-banner">
    <div class="container">
        <h1>
            Add Pictures
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
                                <h2 style="color: #FFF; background: #E21D24; font-weight:600; line-height: 28px; font-size: 22px;width: 100%;padding:7px 10px;margin:0">ADD PICTURES</h2>
                            </div>
                            <div>

                                <div class="create_grup">
                                    <div class="main_frm">

                                        {!! Form::open ( array( 'url' => 'profile/photo', 'method' => 'post', 'files' => true, 'role' => 'form', 'id' => 'form2'
                                        ) ) !!}
                                        <div class="form-group frmdiv">
                                            <label for="exampleInputName2">Select Picture(s)</label>
                                            <br /> {!! Form::file('images[]', array('multiple'=>true, 'class' => 'file-input ImgeInput
                                            ad_photo_input','id'=>'multi_image')) !!}
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


