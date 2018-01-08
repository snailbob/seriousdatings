@extends('master')


@section('form_area')

<style type="text/css">

/*.match_prof_box{
  position:relative;
  float:left;
  width:46%;
  margin:10px;
  }*/
.match_prof_box {
    position: relative;
    float: left;
    width: 29%;
    height: 185px;
    margin: 10px;
    padding: 5px;
  border: 1px solid #ddd;
    border-radius: 4px;
}
.match_prof_box img {
    width: 100%;
    height: 100%;
}
@media (min-width:320px) and (max-width: 680px){
  .match_prof_box {
    position: relative;
    float: left;
    width: 95%;
    margin: 10px;
}
.match_prof_box img {
    width: 95%;
}
  }
</style>

</header>

  <div class="inner-header upcoming-banner">
    <div class="container">
      <h1>
        <i class="calendar-event-icon">
          <img src="{{url()}}/public/images/upcoming-event-icon.png"  alt="">
        </i>
          {{ $data['current_user']->firstName }} {{ $data['current_user']->lastName }}
      </h1>
    </div>
  </div>
  <div class="inner-contendbg" ng-controller="profileCtrl">

    <div class="container" ng-init="username='{{$username}}'">
      <div class="row" ng-init="getMatchData({!! htmlspecialchars(json_encode($data['friends'])) !!})">
        @include('new_leftsidebar')
        <div class="col-md-6" style="text-align: center;">
          <div>
          <div class="wel_user_txt">
            <h3>
              <a style="color:#fff">
                @if($currentUser==0)
                  <div class="pull-right">
                    <button class="btn btn-default btn-sm" onclick="window.history.back()">
                      <i class="fa fa-angle-double-left" aria-hidden="true"></i> Back
                    </button>
                  </div>
                  Welcome to {{ $data['current_user']->firstName }} {{ $data['current_user']->lastName }}
                @else
                  Welcome to your profile
                @endif
              </a>
            </h3>
          </div>
          </div>

          <div ng-class="{ 'hide-me' : userSelected==null || '{!! $currentUser !!}'=='0' }">
          <div class="row next-carousel">
            <ul class="carousel carousel-profile">

              @foreach($data['friends'] as $ind=>$single_user)

                  <li class="item" style="background: url('{{ $single_user->photo }}') no-repeat center"></li>
                
              @endforeach

              <!-- <li class="item" ng-repeat="user in allUsers" style="background: url('@{{ user.photo }}') no-repeat center"></li> -->

            </ul>
          </div>
          <div class="controls">
           <a href="#" class="previous btn btn-danger" ng-click="left()"><span class="fa fa-chevron-left"></span></a>
           <a onclick="window.location.reload(true)" class="btn btn-danger reload"><span class="fa fa-refresh"></span> Refresh</a>
           <!-- <label style="font-size: 28px;" ng-if="userSelected!=nul">@{{ userSelectedPercent }}%</label>  -->
           <a href="#" class="next btn btn-danger" ng-click="right()"><span class="fa fa-chevron-right"></span></a>
          </div>
          </div>
          
          <div ng-class="{ 'hide-me' : userSelected==null || '{!! $currentUser !!}'=='0' }">
            <div class="upcoming-event-people">
              <div class="upcoming-people-row">
                <div class="left-upcoming-user"><a href="{!! url('user/profile') !!}/@{{ userSelected.username }}"><img src="@{{ userSelected.photo }}"  alt=""></a></div>
                <div class="upcoming-user-list">
                  <div class="upcoming-user-icon">
                    <i class="fa fa-user-plus" ng-click="addFriendByUserID(userSelected.id)" uib-tooltip="Add as Friend"></i>  <!-- new  menu add -->
                    <i class="fa fa-gift" uib-tooltip="Send Gift"></i>
                    <i class="fa fa-fast-forward" ng-click="gotoliveChat(userSelected.id)" uib-tooltip="Speed Dating"></i>
                    <i class="fa fa-comments" ng-click=createSMS(userSelected.id,userSelected.firstName) uib-tooltip="Message"></i>
                  </div>
                  <h2><a class="profile-link" href="{!! url('user/profile') !!}/@{{ userSelected.username }}">@{{ userSelected.firstName }} @{{ userSelected.lastName }}</a> <span class="percent">@{{ userSelected.percent }}%</span></h2>
                  <p>@{{ userSelected.location }}</p>
                  <div class="u-favorite movie" ng-repeat="movie in userSelected.favorite.movies">
                    <img src="{{url()}}/public/images/@{{movie.image}}">
                    <p class="u-content">
                      @{{movie.name}}
                    </p>
                  </div>
                  <div class="u-favorite" ng-repeat="place in userSelected.favorite.places">
                    <img src="{{url()}}/public/images/@{{place.image}}">
                    <p class="u-content">
                      @{{place.name}}
                    </p>
                  </div>
                </div>
              </div>
            </div>
          </div>


          <div class="profile-info" ng-class="{ 'hide-me' : '{!! $currentUser !!}'=='1' }">

            @if($data['current_user']->percent)
            <div style="margin-bottom: 10px;">
            <div class="upcoming-event-people" ng-init="userProfile='{!! $data['current_user']->id !!}'">
              <div class="upcoming-people-row">
                <div class="left-upcoming-user"><img src="{{ $data['current_user']->photo }}"  alt=""></div>
                <div class="upcoming-user-list">
                  <h2>{{ $data['current_user']->firstName }} {{ $data['current_user']->lastName }} <span class="percent">{{ $data['current_user']->percent }}%</span></h2>
                  <p>{{ $data['current_user']->location }}</p>

                  @foreach($data_new['movies'] as $movie)
                    <div class="u-favorite movie">
                      <img src="{{url()}}/public/images/{!! $movie['image'] !!}">
                      <p class="u-content">
                        {!! $movie['name'] !!}
                      </p>
                    </div>
                  @endforeach

                  @foreach($data_new['places'] as $place)
                    <div class="u-favorite">
                      <img src="{{url()}}/public/images/{!! $place['image'] !!}">
                      <p class="u-content">
                        {!! $place['name'] !!}
                      </p>
                    </div>
                  @endforeach
                </div>
              </div>
            </div>
            </div>

              <div class="panel panel-danger">
                  <div class="panel-heading">
                      <p class="panel-title lead">
                          BACKGROUND/VALUES
                      </p>
                  </div>
                  <ul class="list-group">
                      <li class="list-group-item">
                          Relationship goal: <span class="text-muted">@{{ userProfileData.relationshipGoal }}</span>
                      </li>
                      <li class="list-group-item">
                          Ethnicity: <span class="text-muted">@{{ userProfileData.ethnicity }}</span>
                      </li>
                      <li class="list-group-item">
                          Faith: <span class="text-muted">@{{ userProfileData.religiousBeliefs }}</span>
                      </li>
                      <li class="list-group-item">
                          Education: <span class="text-muted">@{{ userProfileData.educationLevel }}</span>
                      </li>
                      <li class="list-group-item">
                          Language: <span class="text-muted">@{{ userProfileData.language }}</span>
                      </li>
                  </ul>
              </div>

              <div class="panel panel-danger">
                  <div class="panel-heading">
                      <p class="panel-title lead">
                          LIFESTYLE
                      </p>
                  </div>
                  <ul class="list-group">
                      <li class="list-group-item">
                          Smoke: <span class="text-muted">@{{ userProfileData.smoke }}</span>
                      </li>
                      <li class="list-group-item">
                          Drink: <span class="text-muted">@{{ userProfileData.drink }}</span>
                      </li>
                      <li class="list-group-item">
                          Excercise frequency: <span class="text-muted">@{{ userProfileData.excercise }}</span>
                      </li>
                      <li class="list-group-item">
                          Has kids: <span class="text-muted">@{{ userProfileData.haveChildren }}</span>
                      </li>
                      <li class="list-group-item">
                          Occupation: <span class="text-muted">@{{ userProfileData.occupation }}</span>
                      </li>
                      <li class="list-group-item">
                          Salary range: <span class="text-muted">@{{ userProfileData.income }}</span>
                      </li>
                      <li class="list-group-item">
                          Zodiac Sign: <span class="text-muted">@{{ userProfileData.zodicSign }}</span>
                      </li>
                      <li class="list-group-item">
                          My Movies:
                          <div class="clearfix">
                            <div class="row">
                              <div class="col-sm-4" ng-repeat="movie in userProfileData.my_movies">
                                <img ng-src="@{{movie.image}}" class="img-responsive img-thumbnail" alt=""> <br> <p class="text-center text-danger"><small>@{{ movie.movies}}</small></p>
                              </div>
                            </div>
                          </div>
                      </li>
                      <li class="list-group-item">
                          My Destination:
                          <div class="clearfix">
                            <div class="row">
                              <div class="col-sm-4" ng-repeat="place in userProfileData.my_places">
                                <img ng-src="@{{place.image}}" class="img-responsive img-thumbnail" alt=""> <br> <p class="text-center text-danger"><small>@{{ place.destination }}</small></p>
                              </div>
                            </div>
                          </div>
                      </li>
                  </ul>
              </div>

              <div class="panel panel-danger">
                  <div class="panel-heading">
                      <p class="panel-title lead">
                          APPEARANCE
                      </p>
                  </div>
                  <ul class="list-group">
                      <li class="list-group-item">
                          Height: <span class="text-muted">@{{ userProfileData.height }}</span>
                      </li>
                      <li class="list-group-item">
                          Body type: <span class="text-muted">@{{ userProfileData.bodyType }}</span>
                      </li>
                      <li class="list-group-item">
                          Eye color: <span class="text-muted">@{{ userProfileData.eyeColor }}</span>
                      </li>
                      <li class="list-group-item">
                          Hair color: <span class="text-muted">@{{ userProfileData.hairColor }}</span>
                      </li>
                  </ul>
              </div>

            @endif
          </div>


          <div class="upcoming-match" ng-class="{ 'hide-me' : '{!! $currentUser !!}'=='0' }">
            <p class="match-label">Best Match</p>
            <div class="upcoming-event-people" ng-repeat="match in matchUsers | filter: {page: currentPage}">
              <div class="upcoming-people-row">
                <div class="left-upcoming-user"><a href="{!! url('user/profile') !!}/@{{ match.username }}"><img src="@{{ match.photo }}"  alt=""></a></div>
                <div class="upcoming-user-list">
                  <div class="upcoming-user-icon">
                    <!-- <span class="u-icon"><i class="fa fa-facebook-square"></i></span>
                    <span class="u-icon"><i class="fa fa-facebook-square"></i></span>
                    <span class="u-icon"><i class="fa fa-facebook-square"></i></span> -->
                    <i class="fa fa-user-plus" ng-click="addFriend($index)" uib-tooltip="Add as Friend"></i>
                    <i class="fa fa-gift" uib-tooltip="Send Gift"></i>
                    <i class="fa fa-fast-forward" ng-click="gotoliveChat(match.id)" uib-tooltip="Speed Dating"></i>
                    <i class="fa fa-comments" ng-click="createSMS(match.id,match.firstName)" uib-tooltip="Message"></i>
                  </div>
                  <h2>
                    <i class="fa fa-circle  new-state" aria-hidden="true" id="@{{ match.id }}-stateicon-new"></i>
                    <a class="profile-link" href="{!! url('user/profile') !!}/@{{ match.username }}">

                  @{{ match.firstName }} @{{ match.lastName }}</a> <span>@{{ match.percent + '%' }}</span></h2>
                  <p>@{{ match.location }}</p>
                  <div class="u-favorite movie" ng-repeat="movie in match.favorite.movies">
                    <img src="{{url()}}/public/images/@{{movie.image}}">
                    <p class="u-content">
                      @{{movie.name}}
                    </p>
                  </div>
                  <div class="u-favorite" ng-repeat="place in match.favorite.places">
                    <img src="{{url()}}/public/images/@{{place.image}}">
                    <p class="u-content">
                      @{{place.name}}
                    </p>

                  </div>
                </div>
              </div>
            </div>
          </div>

          <button class="btn btn-danger match" ng-click="next()" ng-hide="nextButton" ng-class="{ 'hide-me' : '{!! $currentUser !!}'=='0' }">Next <span class="fa fa-angle-double-right"></span></button>

        </div>
        <div class="col-md-3" style="z-index: 100;">
          @include('right_sidebar')
        </div>     
      </div>
    </div>
  </div>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script> 
<script src="{{ url() }}/public/css/custom/rotating/js/jquery.circular-carousel.js"></script> 
<script src="{{ url() }}/public/css/custom/rotating/js/script.js"></script>

<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-36251023-1']);
  _gaq.push(['_setDomainName', 'jqueryscript.net']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>

@endsection


