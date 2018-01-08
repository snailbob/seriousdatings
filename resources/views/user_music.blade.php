@extends('master')

@section('form_area')


<!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7"
      crossorigin="anonymous"/>-->


{!! HTML::style('css/jBox.css') !!}

<style type="text/css">

    .pic_gallery
    {margin: 0px !important;padding: 10px !important;}

    .pic_gallery audio{
        width:100%;
        margin:10px 0px;
        padding:0;
        float:left;
        border: 2px solid #EFEFEF;

    }
	 .pic_gallery img{
        width:100%;
        height:100%;
        margin:10px 0px;
        padding:0;
        float:left;
        border: 2px solid #EFEFEF;

    }

</style>


<!-- /header -->

<div class="middle inner-middle">
    <div class="inner-header upcoming-banner">
        <div class="container">
            <h1><!--<i class="calendar-event-icon"><img src="{!! url() !!}/images/upcoming-event-icon.png"  alt=""></i>-->My Music</h1>
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
									<h3  style="color: #FFF; background: #E21D24; line-height: 30px; font-weight: normal;font-size: 20px;width: 100%;padding:10px 10px;margin:0">
										<!--<i class="calendar-event-icon"><img src="{!! url() !!}/images/upcoming-event-icon.png"  alt=""></i>-->My Music
									 <a href="{!! url() !!}/profile/music/create" class="pull-right btn btn-danger btn-facebook btn-sm" type="button" style="border-bottom: 1px solid #820005; font-weight:600;"><i class="fa fa-plus-square"></i>&nbsp; Add Music</a></h3>
                                    </h3>
								</div>
                            
                                <div>

								<div class=" pic_gallery">
                                    <div class="row">
                                        @foreach($data['music'] as $music)
                                            <div class="col-md-12"><h3>{!! $music->title !!}</h3></div><div class="clear"></div>

                                            <div class="col-md-3">
                                            <audio controls>
                                                <source src="{!! url() !!}/public/images/users/{!! $data['current_user']->username !!}/music/{!! $music->music !!}" type="audio/mpeg">
                                                Your browser does not support the audio element.
                                            </audio>
                                        </div>
                                            <div class="clear"></div>
                                        @endforeach

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

</div>
</div>

<!-- /middle -->

{!! HTML::script('js/jquery.min.js') !!}
{!! HTML::script('js/jBox-min.js') !!}

<script>
    var gallery = new jBox();
</script>

@endsection