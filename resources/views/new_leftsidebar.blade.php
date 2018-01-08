<div class="col-md-3" style="z-index: 100;">
    <div class="left-section">
        <uib-accordion>
            <div uib-accordion-group class="panel-danger">
                <uib-accordion-heading>
                    <i class="fa fa-search" aria-hidden="true"></i>
                    <strong>Search By Name</strong>
                </uib-accordion-heading>

                <div class="quick-search">
                    <div class="advance-search">
                        <div class="quick-search-row">
                            <label>First Name</label>
                            <input type="text" ng-model="searchByName.firstName" class="form-control">
                        </div>
                        <div class="quick-search-row">
                            <label>Last Name</label>
                            <input type="text" ng-model="searchByName.lastName" class="form-control">
                        </div>
                        <div class="quick-search-row padding-top-15">
                            <div class="form-group">
                                <button class="btn btn-danger btn-block" ng-click="searchByNameModal()">
                                    Search
                                </button>
                            </div>

                        </div>
                    </div>
                </div>

            </div>

            <div class="panel panel-danger">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a href="{{ url(). '/search?zip='.Auth::user()->zipcode.'&search_type=advance' }}">
                            <i class="fa fa-search" aria-hidden="true"></i>
                            <strong>Advance Search</strong>
                        </a>
                    </h4>
                </div>
            </div>

            <div uib-accordion-group class="panel-danger" is-open="true">
                <uib-accordion-heading>
                    <i class="fa fa-search" aria-hidden="true"></i>
                    <strong>Quick Search</strong>
                </uib-accordion-heading>


                <div class="quick-search">

                    <div class="quick-search-formx">
                        {!!  Form::open(array('url' => 'search','method' => 'GET', 'name' => 'searchForm', 'novalidate'=>'novalidate')) !!}
                        <div class="quick-search-row">
                            <div class="quick-half-cols">
                                <label>I am :</label>
                                <select name="myGender" id="gender" required class="form-control">
                                    <option value="Male" @if(Auth::user()->gender == 'Male') {{ 'selected' }} @endif>Male</option>
                                    <option value="Female" @if(Auth::user()->gender != 'Male') {{ 'selected' }} @endif>Female</option>
                                </select>
                            </div>
                            <div class="quick-half-cols float-right">
                                <label>Seeking a</label>
                                <select name="gender" id="lookingfor" required class="form-control">
                                    <option value="Male" @if(Auth::user()->gender != 'Male') {{ 'selected' }} @endif>Male</option>
                                    <option value="Female" @if(Auth::user()->gender == 'Male') {{ 'selected' }} @endif>Female</option>
                                </select>
                            </div>
                        </div>
                        <div class="quick-search-row">
                            <label>Between Age:</label>
                            <div class="quick-half-cols">
                                <select name="age_from" required class="form-control">
                                    @for ($i = 21; $i <= 80; $i+=1)
                                        <option value="{{$i}}">{{$i}}</option>
                                    @endfor
                                </select>
                                {{--  <input type="text" name = "age_from" class="textbox1" placeholder="Age From" required />  --}}
                            </div>
                            <div class="quick-half-cols float-right">

                                <select name="age_to" required class="form-control">
                                    @for ($i = 21; $i <= 80; $i+=1)
                                        <option value="{{$i}}">{{$i}}</option>
                                    @endfor
                                </select>
                                {{--  <input type="text" name = "age_to" class="textbox1" placeholder="Age To" required/>  --}}
                            </div>
                        </div>
                        <div class="quick-search-row">
                            <label>Zip Code</label>
                            <input type="text" name = "zip" class="form-control" placeholder="Zip Code" value="{{Auth::user()->zipcode}}" required/>
                        </div>
                        <div class="quick-search-row">
                            <input type="submit" value="Search Now" class="btn btn-danger margin_5"/></a>
                        </div>
                        {!! Form::close() !!}

                    </div>
                </div>
            </div>


        </uib-accordion>

    </div>

    <div class="left-section">

        <div class="serious-method">
            {{--  @if(isset($currentUser))   --}}

                @if(!isset($currentUser) || $currentUser==0)
                <div class="connect-with-left">
                    <a href="#">
                        <div class="serious-icons">
                            {!! HTML::Image("public/images/phone-chat-icon.png" ,"") !!}
                        </div>
                        <h2>Phone Chat</h2>
                    </a> 
                </div>
                <div class="connect-with-left float-right"> 
                    <a href="#">
                        <div class="serious-icons">
                            {!! HTML::Image("public/images/video-chat-icon.png" ,"") !!}
                            </div>
                        <h2>Video Chat</h2>
                    </a> 
                </div>
                <div class="connect-with-left"> 
                    <a href="#">
                        <div class="serious-icons">{!! HTML::Image("public/images/serious-dating-icon.png" ,"") !!}</div>
                        <h2>Serious Dating</h2>
                    </a> 
                </div>
                <div class="connect-with-left float-right"> 
                    <a href="#">
                        <div class="serious-icons">{!! HTML::Image("public/images/vi-iconrtual-gift.png" ,"") !!}</div>
                        <h2>Virtual Gift</h2>
                    </a> 
                </div>
                <div class="connect-with-left"> 
                    <a href="#">
                        <div class="serious-icons">{!! HTML::Image("public/images/serious-vecation-icon.png" ,"") !!}</div>
                        <h2>Serious Vacation</h2>
                    </a> 
                </div>
                <div class="connect-with-left float-right"> 
                    <a href="#">
                        <div class="serious-icons">{!! HTML::Image("public/images/background-check-icon.png" ,"") !!}</div>
                        <h2>background Check</h2>
                    </a> 
                </div>
                @else
                <h2 class="quiz-head">Are You Ready To Date Again?</h2>
                <div class="row" style="margin-bottom: 10px;" ng-if="isReadyToDate.answer == null || isReadyToDate.answer == true">
                    <div class="col-xs-6 text-center">
                        <button class="btn btn-danger" ng-click="areYouReadyToDate(true)">Yes</button>
                    </div>
                    <div class="col-xs-6 text-center">
                        <button class="btn btn-danger" ng-click="areYouReadyToDate(false)">No</button>
                    </div>
                </div>
                <div class="row" ng-if="isReadyToDate.answer == false">
                    <div class="col-sm-12">
                        <p class="text-muted text-center">
                            You are not ready to date. <br><a class="btn btn-link" ng-click="areYouReadyToDate(null)">Update</a>
                        </p>
                    </div>
                </div>


                @endif
            {{--  @endif  --}}
        </div>

        <div class="travel-option profile-managment">
            <h2>Profile management</h2>
            <ul class="package">
                <li> <a href="{!! url() !!}/profile/photo">My Photo</a> </li>
                <li> <a href="{!! url() !!}/profile/music">My Music</a> </li>
                <li> <a href="{!! url() !!}/profile/video">My Video </a> </li>
                <li><a href="{!! url() !!}/profiles/groups/create">Create Groups</a></li>
            </ul>
        </div>

    </div>    
</div>
<!--<script type="text/javascript" src="https://ajax.microsoft.com/ajax/jquery.validate/1.7/jquery.validate.min.js" ></script>-->
<!-- <script src="{!! url() !!}/public/js/searchFormValidation.js"></script>  -->
