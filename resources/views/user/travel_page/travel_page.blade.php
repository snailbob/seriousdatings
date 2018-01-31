@extends('master')

@section('css-scripts')
    {{--{!! HTML::style('public/css/blog_page/blog_page_style.css') !!}--}}
@endsection

@section('javascript')
    {{--{!! HTML::script('public/js/blog_page/subscribe.js') !!}--}}
    {{--{!! HTML::script('public/js/blog_page/blog_page.js') !!}--}}
@endsection

@section('form_area')
    {{--{{dd($blog)}}--}}
    <div class="middle inner-middle">
        <div class="inner-header travel-banner">
            <div class="container">
                <h1><i class="calendar-event-icon"><img src="{{url()}}/public/images/travel-icon.png" alt=""></i>Serious
                    Dating Travel</h1>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <aside class="col-md-3 blog-aside">
                    <div class="travel-option">
                        <ul>
                            <li>
                                <label class="hotel-icon">Hotel</label>
                                <input type="radio">
                            </li>
                            <li>
                                <label class="flight-icon">Flights</label>
                                <input type="radio">
                            </li>
                            <li>
                                <label class="ship-icon">Cruises</label>
                                <input type="radio">
                            </li>
                            <li>
                                <label class="car-icon">Cars</label>
                                <input type="radio">
                            </li>
                            <li>
                                <label class="acti-icon">Activities</label>
                                <input type="radio">
                            </li>
                        </ul>
                    </div>
                    <div class="travel-option">
                        <h2>Package</h2>
                        <ul class="package">
                            <li>
                                <label>Flight<span>+</span>Hotel<span>+</span>Car</label>
                                <input type="radio">
                            </li>
                            <li>
                                <label>Flight<span>+</span>Hotel</label>
                                <input type="radio">
                            </li>
                            <li>
                                <label>Flight<span>+</span>Car</label>
                                <input type="radio">
                            </li>
                            <li>
                                <label>Flight<span>+</span>Car</label>
                                <input type="radio">
                            </li>
                        </ul>
                    </div>
                    <div class="destination-outer">
                        <h2 class="destination">Destination</h2>
                        <div class="detination-form">
                            <div class="detination-form-row">
                                <input type="text" value="Destination" class="textbox1">
                            </div>
                            <div class="detination-form-row">
                                <div class="half-row">
                                    <label>Check In:</label>
                                    <input type="text" value="06-27-2015" class="textbox1 calender">
                                </div>
                                <div class="half-row right">
                                    <label>Check Out:</label>
                                    <input type="text" value="06-27-2015" class="textbox1 calender">
                                </div>
                            </div>
                            <div class="detination-form-row">
                                <div class="half-cols">
                                    <label>Rooms:</label>
                                    <select name="" id="ageto">
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="2">3</option>
                                        <option value="2">4</option>
                                        <option value="2">5</option>
                                    </select>
                                </div>
                                <div class="half-cols auto-margin">
                                    <label>Adults:</label>
                                    <select name="" id="ageto">
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="2">3</option>
                                        <option value="2">4</option>
                                        <option value="2">5</option>
                                    </select>
                                </div>
                                <div class="half-cols">
                                    <label>Children:</label>
                                    <select name="" id="ageto">
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="2">3</option>
                                        <option value="2">4</option>
                                        <option value="2">5</option>
                                    </select>
                                </div>
                            </div>
                            <div class="detination-form-row search-by">
                                <label>Search By:</label>
                                <input type="radio">
                                <label>Price</label>
                                <input type="radio">
                                <label>TripleDip Points</label>
                            </div>
                            <div class="detination-form-row detination-form-row2"> <a href="#">Advance Options</a>
                                <input type="button" value="Search Now" class="comman-btn"/>
                            </div>
                        </div>
                    </div>
                    <div class="ad-div"><a href="#"><img src="{{url()}}/public/images/expert-ad.png"  alt=""></a></div>
                    <div class="ad-div2"><a href="#"><img src="{{url()}}/public/images/why-bokk.png"  alt=""></a></div>
                </aside>
                <div class="col-md-9 blog-main">
                    <article class="blog-post">
                        <div class="serious-banner"><a href="#"><img src="{{url()}}/public/images/banner-img1.jpg" alt=""></a></div>
                        <div class="cracking-offer"><a href="#"><img src="{{url()}}/public/images/ad-banner.png"  alt=""></a></div>
                        <div class="dis-dating-outer">
                            <div class="last-min-save">
                                <h2>Last Minute Saving</h2>
                                <p>Morbi vel tortor ipsum, at suscipit sem. Donec nec metus in magna sollicitudin venenatis ut nec neque. Sed </p>
                                <a href="#"><img src="{{url()}}/public/images/watch-icon.png"  alt=""></a>
                            </div>
                            <div class="discount-right">
                                <h2>Bia Discount With Our Brand New Coupons</h2>
                                <img src="{{url()}}/public/images/coupan-img.jpg"  alt=""></div>
                        </div>
                        <div class="feature-destination">
                            <h2>Feature Destination</h2>
                            <div class="destination-cols"><a href="#"><img src="{{url()}}/public/images/new-york.jpg" alt=""><span>New York</span></a></div>
                            <div class="destination-cols"><a href="#"><img src="{{url()}}/public/images/miami.jpg" alt=""><span>Miami</span></a></div>
                            <div class="destination-cols"><a href="#"><img src="{{url()}}/public/images/orland.jpg" alt=""><span>Orland</span></a></div>
                            <div class="destination-cols"><a href="#"><img src="{{url()}}/public/images/las-vegas.jpg" alt=""><span>Las Vegas</span></a></div>
                        </div>
                    </article>
                </div>

            </div>
        </div>
@endsection

