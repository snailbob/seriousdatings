@extends('master')

@section('css-scripts')
    {!! HTML::style('public/css/blog_page/blog_page_style.css') !!}
@endsection

@section('javascript')
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    {!! HTML::script('public/js/blog_page/blog_page.js') !!}
@endsection

@section('form_area')
    {{--{{dd($comments)}}--}}
    <div class="container">
        <div class="row">
            <div class="col-md-8 blog-main">
                <article class="blog-post">
                    <header>
                        <h1>{{$blog['blogTitle']}}</h1>
                        <div class="lead-image">
                            <img src="{{ URL::to('/public/assets/' . $blog['blogImage']) }}" alt="Hands"
                                 class="img-responsive">
                            <div class="meta clearfix">

                                <div class="author">
                                    <i class="fa fa-user"></i>
                                    <span class="data">{{$blog['blogby']}}</span>
                                </div>
                                <div class="date">
                                    <i class="fa fa-calendar"></i>
                                    <span class="data">{{$blog['created_at']}}</span>
                                </div>
                                <div class="comments">
                                    <i class="fa fa-comments"></i>
                                    <span class="data"><a href="#comments">26 Comments</a></span>
                                </div>
                            </div>
                        </div>
                    </header>
                    <div class="body">

                        {!! $blog['blogContent'] !!}

                    </div>
                </article>

                <aside class="social-icons clearfix">
                    <a href="#" class="social-icon color-one">
                        <div class="inner-circle"></div>
                        <i class="fa fa-twitter"></i>
                    </a>

                    <a href="#" class="social-icon color-two">
                        <div class="inner-circle"></div>
                        <i class="fa fa-google-plus"></i>
                    </a>

                    <a href="#" class="social-icon color-three">
                        <div class="inner-circle"></div>
                        <i class="fa fa-facebook"></i>
                    </a>
                </aside>

                <aside class="comments" id="comments">
                    <hr>

                    <h2><i class="fa fa-comments"></i> {{count($comments)}} Comment/s</h2>
                    @foreach($comments as $comment)
                        <article class="comment">
                            <header class="clearfix">
                                <img src="{{$comment['user']['photo']}}" class="img-circle " width="45" alt=""
                                     class="avatar">
                                <div class="meta">
                                    <h3>
                                        <a href="#">{{$comment['user']['firstName']}} {{$comment['user']['lastName']}}</a>
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

                                <div id="{{$blog['id']}}" class="buttons clearfix">
                                    <button class="btn btn-xlarge btn-tales-two">Cancel</button>
                                    <button id="submitBtn" class="btn btn-xlarge btn-tales-one">Submit</button>
                                </div>
                            </div>
                        </form>
                    </aside>
                @endif
            </div>
            <aside class="col-md-4 blog-aside">

                <div class="aside-widget">
                    <header>
                        <h3>Read next...</h3>
                    </header>
                    <div class="body">
                        <ul class="tales-list">
                            <li><a href="index.html">Email Encryption Explained</a></li>
                            <li><a href="#">Selling is a Function of Design.</a></li>
                            <li><a href="#">It’s Hard To Come Up With Dummy Titles</a></li>
                            <li><a href="#">Why the Internet is Full of Cats</a></li>
                            <li><a href="#">Last Made-Up Headline, I Swear!</a></li>
                        </ul>
                    </div>
                </div>

                <div class="aside-widget">
                    <header>
                        <h3>Authors Favorites</h3>
                    </header>
                    <div class="body">
                        <ul class="tales-list">
                            <li><a href="index.html">Email Encryption Explained</a></li>
                            <li><a href="#">Selling is a Function of Design.</a></li>
                            <li><a href="#">It’s Hard To Come Up With Dummy Titles</a></li>
                            <li><a href="#">Why the Internet is Full of Cats</a></li>
                            <li><a href="#">Last Made-Up Headline, I Swear!</a></li>
                        </ul>
                    </div>
                </div>

                <div class="aside-widget">
                    <header>
                        <h3>Tags</h3>
                    </header>
                    <div class="body clearfix">
                        <ul class="tags">
                            <li><a href="#">OpenPGP</a></li>
                            <li><a href="#">Django</a></li>
                            <li><a href="#">Bitcoin</a></li>
                            <li><a href="#">Security</a></li>
                            <li><a href="#">GNU/Linux</a></li>
                            <li><a href="#">Git</a></li>
                            <li><a href="#">Homebrew</a></li>
                            <li><a href="#">Debian</a></li>
                        </ul>
                    </div>
                </div>
            </aside>
        </div>
    </div>
@endsection

