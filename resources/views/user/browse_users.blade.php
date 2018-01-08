@extends('master')


@section('form_area')
<div ng-controller="browseMemberController" ng-cloak>
    <div class="inner-header aboutyour-header">
        <div class="container">
            <h1>
                <i class="fa fa-address-book" aria-hidden="true"></i> Browse Members 
                {{--  <a href="{{url()}}/search" class="btn btn-danger btn-lg btn-outline">
                    <i class="fa fa-search fa-fw" aria-hidden="true"></i> Filter Users
                </a>  --}}
            </h1>
        </div> 
    </div>
    <div>
        <div>

            <div class="container">
                <div class="row padding-top">
                    <div class="col-sm-3">
                        <uib-accordion close-others="true">
                            <div uib-accordion-group class="panel-danger" is-open="true">
                                <uib-accordion-heading>
                                    <i class="fa fa-search" aria-   hidden="true"></i>
                                    <strong>Quick Search</strong>
                                </uib-accordion-heading>


                                <div class="quick-search">

                                    <form class="quick-search-row" id="search_form2" name="search_form2" ng-submit="submitForm(search_form2)" ng-validate="validationOptions" novalidate>

                                        <div class="rowx">
                                            <div ng-class="{'col-sm-12' : !search.advance, 'col-sm-12' : search.advance}">
                                                <div ng-class="{'panelx panel-defaultx panel-search-quick' : search.advance}">
                                                    <div ng-class="{'panel-bodyx' : search.advance}">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label>I am :</label>
                                                                    <select class="form-control" name="myGender" ng-model="formData.myGender" required>
                                                                        <option value="">--Select--</option>
                                                                        <option value="Male">Male</option>
                                                                        <option value="Female">Female</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label>Looking For :</label>
                                                                    <select class="form-control" name="gender" ng-model="formData.gender" required>
                                                                        <option value="">--Select--</option>
                                                                        <option value="Male">Male</option>
                                                                        <option value="Female">Female</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label>Age :</label>
                                                                    <select class="form-control" name="age_from" ng-model="formData.age_from" required>
                                                                        <option value="">--Select--</option>
                                                                        @for ($i = 21; $i <= 80; $i+=1)
                                                                            <option value="{{$i}}">{{$i}}</option>
                                                                        @endfor
                                                                    </select>    
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label>To :</label>
                                                                    <select class="form-control" name="age_to" ng-model="formData.age_to" required>
                                                                        <option value="">--Select--</option>
                                                                        @for ($i = 21; $i <= 80; $i+=1)
                                                                            <option value="{{$i}}">{{$i}}</option>
                                                                        @endfor
                                                                    </select>    
                                                                </div>
                                                            </div>

                                                            <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label>Zipcode :</label>
                                                                    <input class="form-control form-control-number" type="text" name="zip" ng-model="formData.zip" placeholder="Zip Code" required>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="row">

                                                            {{--  <div class="col-md-12">
                                                                <div class="form-group">
                                                                    <label>Miles :</label>
                                                                    <input class="form-control form-control-number" type="text" name="range" ng-model="formData.range" placeholder="Range Of Miles" />
                                                                </div>
                                                            </div>  --}}

                                                            <div class="col-md-12" ng-hide="search.advance">
                                                                <div class="form-group">
                                                                    <label for="">&nbsp;</label>
                                                                    <input type="submit" value="Search Now" class="btn btn-danger btn-block btn-submit-search" />
                                                                </div>

                                                            </div>
                                                        </div>


                                                    </div>



                                                </div>

                                            </div>

                                        </div>
                                    </form>

                                </div>
                            </div>
                        </uib-accordion>

                    </div>

                    <div class="col-sm-9">
                        <p class="padding-top lead text-center text-muted loading-browse" ng-if="isLoading">
                            <i class="fa fa-spinner fa-spin fa-2x" aria-hidden="true"></i> <br> Loading...
                        </p>

                        <div class="row">
                            <div class="col-sm-4 browse-profile-bg" ng-repeat="user in data.users" ng-if="!isLoading">
                                <div class="profile-images-bg">
                                    <a ng-href="@{{ base_url + '/search/profile/' + user.id}}" target="_blank">
                                        <img ng-src="@{{ user.photo }}" class="img-thumbnail" alt="">
                                        <div class="age-box">age: @{{ user.myage }}</div>
                                    </a>
                                </div>

                                <div class="browse-profile-details">
                                    <p>
                                        Name: <span class="text-muted">@{{ user.firstName }} @{{ user.lastName }}</span>
                                    </p>
                                    <p>
                                        Location: <span class="text-muted">@{{ user.location }}</span>
                                    </p>
                                    <p>
                                        <span class="text-warning small"><i class="fa fa-map-marker" aria-hidden="true"></i> You are @{{ user.distance }}km away</span>
                                    </p>

                                    <p class="padding-top-15">
                                        <span class="label label-danger">@{{ user.percent }}% Compatible</span>
                                    </p>

                                    <div class="padding-top-15">
                                        {{--  <a class="btn btn-default btn-block" ng-if="!user.is_friend" ng-click="addUser(user)">
                                            <i class="fa fa-user fa-fw"></i> Add Friend
                                        </a>

                                        <a class="btn btn-success btn-block" ng-if="user.is_friend" ng-click="addUser(user)">
                                            <i class="fa fa-user fa-fw"></i> Friends
                                        </a>  --}}

                                        <a class="btn btn-default btn-block" ng-href="@{{ base_url + '/search/profile/' + user.id}}" target="_blank">
                                            <span class="fa fa-link fa-fw" aria-hidden="true"></span> Profile
                                        </a>

                                        <a class="btn btn-danger btn-block" ng-click="blockUser($index, user)">
                                            <span class="fa fa-ban fa-fw" aria-hidden="true"></span> Block
                                        </a>

                                    </div>
                                </div>
                            </div>


                            <div class="clearfix col-sm-12">
                                <p class="pull-right">
                                    <div class="btn-group pull-right" role="group" aria-label="...">
                                        <button type="button" class="btn btn-danger" ng-click="previous()" ng-disabled="!offset">
                                            <i class="fa fa-angle-double-left" aria-hidden="true"></i> Previous
                                        </button>
                                        <button type="button" class="btn btn-danger" ng-disabled="isEnd" ng-click="next()">
                                            Next <i class="fa fa-angle-double-right" aria-hidden="true"></i>
                                        </button>
                                    </div>
                                </p>
                            </div>
                        
                        </div>



                    </div>
                    
                </div>
            </div>


        </div>
    </div>

</div>

@endsection
