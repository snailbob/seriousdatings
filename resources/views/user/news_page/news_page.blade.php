@extends('master')

@section('css-scripts')
    {!! HTML::style('public/css/blog_page/blog_page_style.css') !!}
@endsection

@section('javascript')
    {!! HTML::script('public/js/blog_page/news_page.js') !!}
    {!! HTML::script('public/js/blog_page/subscribe.js') !!}
@endsection

@section('form_area')
    {{--{{dd($news)}}--}}
    <div class="container">
        <div class="row">
            <div class="col-md-8 blog-main">
                <article class="blog-post">
                    <header>
                        <h1>{{$news['blogTitle']}}</h1>
                        <div class="lead-image">
                            <img src="{{ URL::to('/public/assets/' . $news['blogImage']) }}" alt="Hands"
                                 class="img-responsive">
                            <div class="meta clearfix">

                                <div class="author">
                                    <i class="fa fa-user"></i>
                                    <span class="data">{{$news['blogby']}}</span>
                                </div>
                                <div class="date">
                                    <i class="fa fa-calendar"></i>
                                    <span class="data">{{$news['created_at']}}</span>
                                </div>
                                <div class="comments">
                                    <i class="fa fa-comments"></i>
                                    <span class="data"><a href="#comments"> <span class="comment_number">{{count($comments)}}</span> Comment/s</a></span>
                                </div>
                            </div>
                        </div>
                    </header>
                    <div class="body">
                        {!! $news['blogContent'] !!}
                    </div>
                </article>

                <aside class="comments" id="comments">
                    <hr>

                    <h2><i class="fa fa-comments"></i> <span class="comment_number">{{count($comments)}}</span> Comment/s</h2>
                    @foreach($comments as $comment)
                        <article id="{{$comment['id']}}" class="comment">
                            <header class="clearfix">
                                <img src="{{$comment['user']['photo']}}" class="img-circle " width="45" alt=""
                                     class="avatar">
                                <div class="meta">
                                    <h3>
                                        <div class="row">
                                            <div class="col-md-8">
                                                <a href="#">{{$comment['user']['firstName']}} {{$comment['user']['lastName']}}</a>
                                            </div>
                                            @if( Auth::user()->role == "admin" )
                                                <div class="col-md-2">
                                                    <button  type="button"
                                                             class="btn btn-default btn-xs deleteCommentBtn">&times;
                                                    </button>
                                                </div>
                                            @endif
                                        </div>
                                    </h3>
                                    <span class="date">
                                        {{$comment['created_at']}}
                                    </span>
                                    <span class="separator">
                                        -
                                    </span>
                                </div>
                            </header>
                            <div class="body">
                                {{$comment['comment']}}
                            </div>
                        </article>
                    @endforeach
                </aside>
                @if(Auth::check())
                    <aside class="create-comment" id="create-comment">
                        <hr>

                        <h2><i class="fa fa-heart"></i> Add Comment</h2>

                        <form accept-charset="utf-8">
                            <div class="row">
                                               <textarea rows="10" name="message" id="comment-body"
                                                         placeholder="Your thoughts..."
                                                         class="form-control input-lg"></textarea>

                                <div id="{{$news['id']}}" class="buttons clearfix">
                                    <button id="clearBtn" type="button" class="btn btn-secondary">Cancel</button>
                                    <button id="submitBtn" type="button" class="btn btn-danger">Submit</button>
                                </div>
                            </div>
                        </form>
                    </aside>
                @endif
            </div>
            <aside class="col-md-4 blog-aside">
                <div class="form-group">
                    <div class="input-group">
                        <input id="subscribeEmail" type="email" class="form-control" placeholder="Email">
                        <span class="input-group-btn">
                                <button id="subscribeBtn" class="btn btn-warning">
                                   Subscribe
                                </button>
                            </span>
                    </div>
                </div>
                @include('right_sidebar')
            </aside>
        </div>
    </div>
@endsection

