@extends('master')

@section('css-scripts')
    {!! HTML::style('public/css/blog_page/blog_page_style.css') !!}
@endsection

@section('form_area')
{{--    {{dd($news)}}--}}
    <div class="inner-header upcoming-banner">
        <div class="container">
            <h1>
                <i class="calendar-event-icon">
                    <img src="{{url()}}/public/images/upcoming-event-icon.png" alt="">
                </i>
                News
            </h1>
        </div>
    </div>
    <div class="container-services">
        <div class="container">
            <div class="page-header" id="services">
                <h1 class="text-secondary text-center">Articles</h1>
            </div>

            <div class="row">
                <div class="col-md-12 blog-main">
                    <div class="row">
                        @foreach($news as $value)
                            @if($value['blog_status']['name'] == "Published")
                                <div class="col-md-6 col-sm-6 list">
                                    <article class=" blog-teaser">
                                        <header>
                                            <img src="{{ URL::asset('public/assets/' . $value['blogImage']) }}"
                                                 alt="no picture">
                                            <h3><a href="#">{{ $value['blogTitle'] }}</a></h3>
                                            <span class="meta">{{ $value['created_at'] }}, {{ $value['blogby'] }}</span>
                                            <hr>
                                        </header>
                                        <div class="body">
                                            {!! $value['intro'] !!}
                                        </div>
                                        <div class="clearfix">
                                            <a href="{{url()}}/user/news_page/{{$value['id']}}"
                                               class="btn btn-danger btn-sm pull-right">Read more</a>
                                        </div>
                                    </article>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

@endsection