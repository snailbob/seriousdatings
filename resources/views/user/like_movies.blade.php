@extends('master')

@section('form_area')
<div>
    <div ng-controller="likeMoviesController" ng-cloak>
    

        <div class="inner-header like-movie-banner">
            <div class="container">
                <h1>
                    <i class="calendar-event-icon">
                        <img src="{{url()}}/public/images/like-movies-icon.png" alt="">
                    </i>Like Movies</h1>
            </div>
        </div>
        <div class="inner-contendbg">

            <div class="choose-like">
                <h2>
                    <span>Choose the kind of movies you like</span>
                </h2>
            </div>
            <div class="container scroll-movies">
                <div class="row">
                    <div class="col-sm-4 col-md-3 col-lg-2" ng-repeat="movie in movies">
                        <div class="thumbnail">
                            <img class="img-responsive" src="{{url()}}/public/images/@{{ movie.image }}" alt="...">
                            <div class="caption">
                                <h5 class="movie-name">@{{movie.name}}</h5>
                                <div class="clearfix">
                                    <button class="btn btn-default btn-sm btn-block" ng-if="!movie.selected" ng-click="likeMovies(movie)" role="button">Select</button>
                                    <button class="btn btn-success btn-sm btn-block" ng-if="movie.selected" ng-click="likeMovies(movie)" role="button">
                                        <i class="fa fa-check-circle-o" aria-hidden="true"></i> Selected
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="choose-like">
                <h2>
                    <span>Where would you go if yoU HAD 2 WEEKS OFF?</span>
                </h2>

                <div class="container scroll-movies country">
                    <!-- <div class="row">
                        <div class="form-group col-md-6">
                            <input type="text" class="form-control" id="search" name="search" ng-model="search" placeholder="Search Country">
                        </div>
                    </div> -->
                    <div class="row">
                        <!-- <div class="col-sm-4 col-md-3 col-lg-2" ng-repeat="country in data.countries | filter: (!search ? {short_name: 'xxxxx'} : {short_name: search}) ">
                            <div class="thumbnail">
                                <img class="img-responsive" src="{{url()}}/public/images/destination-img1.png" alt="...">
                                <div class="caption">
                                    <h5>@{{country.short_name}}</h5>
                                    <div class="clearfix">
                                        <button class="btn btn-default btn-sm btn-block" ng-if="!country.selected" ng-click="country.selected = !country.selected" role="button">Select</button>
                                        <button class="btn btn-success btn-sm btn-block" ng-if="country.selected" ng-click="country.selected = !country.selected" role="button">
                                            <i class="fa fa-check-circle-o" aria-hidden="true"></i> Selected
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div> -->
                        <div class="col-sm-4 col-md-3 col-lg-2" ng-repeat="place in places">
                            <div class="thumbnail">
                                <img class="img-responsive" src="{{url()}}/public/images/@{{ place.image }}" alt="...">
                                <div class="caption">
                                    <h5 class="movie-name">@{{place.name}}</h5>
                                    <div class="clearfix">
                                        <button class="btn btn-default btn-sm btn-block" ng-if="!place.selected" ng-click="wantPlace(place)" role="button">Select</button>
                                        <button class="btn btn-success btn-sm btn-block" ng-if="place.selected" ng-click="wantPlace(place)" role="button">
                                            <i class="fa fa-check-circle-o" aria-hidden="true"></i> Selected
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="text-right" style="margin-top: 30px;">
                    <button class="common-red-btn button" ng-click="goNext()">Submit</button>
                </div>

            </div>


        </div>


        <script type="text/ng-template" id="loading-modal.html">
            <div>
                <p class="lead text-center">
                    <i class="fa fa-spinner fa-spin fa-3x" aria-hidden="true"></i>
                </p>
            </div>
        </script>

    </div>
</div>

@endsection