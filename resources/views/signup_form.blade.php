@extends('master')

@section('form_area')

<div ng-controller="signupController" ng-cloak>

    <toast></toast>

    <div class="inner-header aboutyour-header">
        <div class="container">
            <h1>
                <i class="icon-sprite signup-icon"></i>Sign up</h1>
            <p>Create an account and get ready to have a serious date</p>

        </div>
    </div>


    <div class="container">
        <div class="row">
            <div class="col-sm-3 crop-col" ng-show="!imgDone.done">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="cropArea">
                            <img-crop image="myImage" result-image="myCroppedImage" on-load-done="imgEdit = false" result-image-quality="0.5" area-type="square"></img-crop>
                        </div>
                        <div>
                            <div class="hidden">
                                <input type="file" id="fileInput" />
                            </div>
                            <button class="btn btn-primary btn-block" onclick="$('#fileInput').click()">
                                Upload Picture
                            </button>
                            <button class="btn btn-success btn-block" ng-if="!imgEdit" ng-click="imgDone.done = !imgDone.done">
                                Done
                            </button>

                        </div>

                    </div>
                </div>
            </div>

            <div class="col-sm-3 text-center crop-col" ng-if="imgDone.done">
                <div>
                    <img class="img-thumbnail img-responsive" ng-src="@{{myCroppedImage}}" />
                </div>
                <div class="padding-top">
                    <button class="btn btn-default" ng-if="!imgEdit" ng-click="imgDone.done = !imgDone.done; imgEdit = !imgEdit">
                        Update
                    </button>
                </div>
            </div>

            <div class="col-sm-9">
                <div class="row profile-img-styling">
                    <div class="select-type">Select Type:</div>
                    <div class="col-xs-4 img-blocks">
                        <div class="checkbox-bg">
                            <input type="radio" id="radius-full" name="profileType" value="1" ng-model="profileType">
                            <label for="radius-full">
                                <span></span>
                            </label>
                        </div>
                        <div class="images-style-bg full-radius">
                            {{--
                            <img alt="your image" src="{{ url() }}/public/images/profile-img.jpg" id="blah"> --}}
                            <img alt="your image" ng-src="@{{myCroppedImage}}" id="my picture">
                            <div class="profile-btm-shedow"></div>
                        </div>
                    </div>

                    <div class="col-xs-4 img-blocks">

                        <div class="checkbox-bg">
                            <input type="radio" id="radius-six" name="profileType" value="2" ng-model="profileType">
                            <label for="radius-six">
                                <span></span>
                            </label>
                        </div>
                        <div class="hexa">
                            <div class="hex1">
                                <div class="hex2">
                                    <img alt="your image" ng-src="@{{myCroppedImage}}" id="my picture"> {{--
                                    <img src="{{ url() }}/public/images/profile-img.jpg" alt="" /> --}}
                                </div>
                            </div>
                        </div>
                        <div class="profile-btm-shedow" style="width: auto;"></div>
                        <!-- <div class="images-style-bg radius-six">
                                            <img alt="your image" src="{{ url() }}/public/images/profile-img.jpg" id="blah">
                                            <div class="profile-btm-shedow"></div>
                                        </div> -->
                    </div>

                    <div class="col-xs-4 img-blocks">
                        <div class="checkbox-bg">
                            <input type="radio" id="corner" name="profileType" value="3" ng-model="profileType">
                            <label for="corner">
                                <span></span>
                            </label>
                        </div>
                        <div class="images-style-bg">
                            <img alt="your image" ng-src="@{{myCroppedImage}}" id="my picture"> {{--
                            <img alt="your image" src="{{ url() }}/public/images/profile-img.jpg" id="blah"> --}}
                            <div class="profile-btm-shedow"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- <div class="row">

            <div class="col-sm-4 col-sm-offset-4 text-center crop-col" ng-if="imgDone.done">
                <div><img class="img-thumbnail img-responsive" ng-src="@{{myCroppedImage}}" /></div>
                <div class="padding-top">
                    <button class="btn btn-default" ng-if="!imgEdit" ng-click="imgDone.done = !imgDone.done; imgEdit = !imgEdit">
                        Update
                    </button>
                </div>
            </div>


        </div> -->
    </div>


    <form name="registerform" ng-submit="submitForm(registerform)" ng-validate="validationOptions" class="signup_form" novalidate>

        <div class="container">
            <div class="">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="">First Name</label>
                            <input type="text" class="form-control" name="firstName" ng-model="user.firstName" placeholder="First Name" required/>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="">Last Name</label>
                            <input type="text" class="form-control" name="lastName" ng-model="user.lastName" placeholder="Last Name" required />
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="">Username</label>
                            <input type="text" class="form-control" name="username" ng-model="user.username" ng-change="usernameChange(user.username)" placeholder="Username" required />
                            <span class="text-danger" ng-if="usernameInUse">Username already taken.</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="">

                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="">Birthdate</label>
                            <input class="form-control" type="date" name="birthdate" ng-model="user.birthdateObj" ng-attr-max="@{{calendarMaxDate()}}" placeholder="Birthdate" required/>
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="">Email</label>
                            <input class="form-control" type="email" name="email" ng-model="user.email" ng-change="emailChange(user.email)" placeholder="Email" required/>
                            <span class="text-danger" ng-if="emailInUse">Email already taken.</span>

                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="">ZipCode</label>
                            <input class="form-control form-control-number" type="tel" name="zipcode" ng-model="user.zipcode" placeholder="ZipCode" required/>
                        </div>
                    </div>

                    {{--  <div class="col-sm-2">
                        <div class="form-group">
                            <label for="">Within (Miles)</label>
                            <select class="form-control" required name="date_rangeOfMiles" ng-model="user.date_rangeOfMiles" id="date_rangeOfMiles">
                                <option value="">--Select--</option>
                                <option value="5">5</option>
                                <option value="10">10</option>
                                <option value="15">15</option>
                                <option value="20">20</option>
                                <option value="25">25</option>
                                <option value="30">30</option>
                                <option value="35">35</option>
                                <option value="40">40</option>
                                <option value="45">45</option>
                                <option value="50">50</option>
                                <option value="55">55</option>
                                <option value="60">60</option>
                                <option value="65">65</option>
                                <option value="70">70</option>
                                <option value="75">75</option>
                                <option value="80">80</option>
                                <option value="85">85</option>
                                <option value="90">90</option>
                                <option value="95">95</option>
                                <option value="100">100</option>
                            </select>

                        </div>
                    </div>  --}}

                </div>

                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="">Gender</label>
                            <select class="form-control" required name="gender" ng-model="user.gender" id="gender">
                                <option value="">--Select--</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>

                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="">Password</label>
                            <input class="form-control" type="password" name="password" ng-model="user.password" id="password_orig" placeholder="Password" required />
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="form-group">
                            <label for="">Confirm Password</label>
                            <input class="form-control" type="password" name="password2" ng-model="user.password2" placeholder="Confirm Password" required />
                        </div>
                    </div>
                </div>
            </div>
            <div class="row single-line-label">


                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Your Relationship goal:</label>
                        <select class="form-control" required name="relationshipGoal" ng-model="user.relationshipGoal">
                            <option value="">--Select--</option>
                            <option value="long term relationship">Long Term Relationship</option>
                            <option value="short term relationship">Short Term Relationship</option>
                            <option value="to get married">To Get Married</option>
                            <option value="casual dating">Casual Dating</option>
                        </select>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Your Occupation:</label>
                            <select class="form-control" required name="occupation" ng-model="user.occupation">
                                <option value="" selected="selected" disabled="disabled">--Select--</option>
                                <optgroup label="Healthcare Practitioners and Technical Occupations:">
                                <option value="Chiropractor">-  Chiropractor</option>
                                <option value="Dentist">-  Dentist</option>
                                <option value="Dietitian or Nutritionist">-  Dietitian or Nutritionist</option>
                                <option value="Optometrist">-  Optometrist</option>
                                <option value="Pharmacist">-  Pharmacist</option>
                                <option value="Physician">-  Physician</option>
                                <option value="Physician Assistant">-  Physician Assistant</option>
                                <option value="Podiatrist">-  Podiatrist</option>
                                <option value="Registered Nurse">-  Registered Nurse</option>
                                <option value="Therapist">-  Therapist</option>
                                <option value="Veterinarian">-  Veterinarian</option>
                                <option value="Health Technologist or Technician">-  Health Technologist or Technician</option>
                                <option value="Other Healthcare Practitioners and Technical Occupation">-  Other Healthcare Practitioners and Technical Occupation</option>
                                </optgroup>
                                <optgroup label="Healthcare Support Occupations:">
                                <option value="Nursing, Psychiatric, or Home Health Aide">-  Nursing, Psychiatric, or Home Health Aide</option>
                                <option value="Occupational and Physical Therapist Assistant or Aide">-  Occupational and Physical Therapist Assistant or Aide</option>
                                <option value="Other Healthcare Support Occupation">-  Other Healthcare Support Occupation</option>
                                </optgroup>
                                <optgroup label="Business, Executive, Management, and Financial Occupations:">
                                <option value="Chief Executive">-  Chief Executive</option>
                                <option value="General and Operations Manager">-  General and Operations Manager</option>
                                <option value="Advertising, Marketing, Promotions, Public Relations, and Sales Manager">-  Advertising, Marketing, Promotions, Public Relations, and Sales Manager</option>
                                <option value="Operations Specialties Manager (e.g., IT or HR Manager)">-  Operations Specialties Manager (e.g., IT or HR Manager)</option>
                                <option value="Construction Manager">-  Construction Manager</option>
                                <option value="Engineering Manage">-  Engineering Manager</option>
                                <option value="Accountant, Auditor">-  Accountant, Auditor</option>
                                <option value="Business Operations or Financial Specialis">-  Business Operations or Financial Specialist</option>
                                <option value="Business Owner">-  Business Owner</option>
                                <option value="Other Business, Executive, Management, Financial Occupation">-  Other Business, Executive, Management, Financial Occupation</option>
                                </optgroup>
                                <optgroup label="Architecture and Engineering Occupations:">
                                <option value="Architect, Surveyor, or Cartographer">-  Architect, Surveyor, or Cartographer</option>
                                <option value="Enginee">-  Engineer</option>
                                <option value="Other Architecture and Engineering Occupation">-  Other Architecture and Engineering Occupation</option>
                                </optgroup>
                                <optgroup label="Education, Training, and Library Occupations:">
                                <option value="Postsecondary Teacher (e.g., College Professor)">-  Postsecondary Teacher (e.g., College Professor)</option>
                                <option value="Primary, Secondary, or Special Education School Teacher">-  Primary, Secondary, or Special Education School Teacher</option>
                                <option value="Other Teacher or Instructor">-  Other Teacher or Instructor</option>
                                <option value="Other Education, Training, and Library Occupation">-  Other Education, Training, and Library Occupation</option>
                                </optgroup>
                                <optgroup label="Other Professional Occupations:">
                                <option value="Arts, Design, Entertainment, Sports, and Media Occupations">-  Arts, Design, Entertainment, Sports, and Media Occupations</option>
                                <option value="Computer Specialist, Mathematical Science">-  Computer Specialist, Mathematical Science</option>
                                <option value="Counselor, Social Worker, or Other Community and Social Service Specialist">-  Counselor, Social Worker, or Other Community and Social Service Specialist</option>
                                <option value="Lawyer, Judge">-  Lawyer, Judge</option>
                                <option value="Life Scientist (e.g., Animal, Food, Soil, or Biological Scientist, Zoologist)">-  Life Scientist (e.g., Animal, Food, Soil, or Biological Scientist, Zoologist)</option>
                                <option value="Physical Scientist (e.g., Astronomer, Physicist, Chemist, Hydrologist)">-  Physical Scientist (e.g., Astronomer, Physicist, Chemist, Hydrologist)</option>
                                <option value="Religious Worker (e.g., Clergy, Director of Religious Activities or Education)">-  Religious Worker (e.g., Clergy, Director of Religious Activities or Education)</option>
                                <option value="Social Scientist and Related Worker">-  Social Scientist and Related Worker</option>
                                <option value="Other Professional Occupation">-  Other Professional Occupation</option>
                                </optgroup>
                                <optgroup label="Office and Administrative Support Occupations:">
                                <option value="Supervisor of Administrative Support Workers">-  Supervisor of Administrative Support Workers</option>
                                <option value="Financial Clerk">-  Financial Clerk</option>
                                <option value="Secretary or Administrative Assistant">-  Secretary or Administrative Assistant</option>
                                <option value="Material Recording, Scheduling, and Dispatching Worker">-  Material Recording, Scheduling, and Dispatching Worker</option>
                                <option value="Other Office and Administrative Support Occupation">-  Other Office and Administrative Support Occupation</option>
                                </optgroup>
                                <optgroup label="Services Occupations:">
                                <option value="Protective Service (e.g., Fire Fighting, Police Officer, Correctional Officer)">-  Protective Service (e.g., Fire Fighting, Police Officer, Correctional Officer)</option>
                                <option value="Chef or Head Cook">-  Chef or Head Cook</option>
                                <option value="Cook or Food Preparation Worker">-  Cook or Food Preparation Worker</option>
                                <option value="Food and Beverage Serving Worker (e.g., Bartender, Waiter, Waitress)">-  Food and Beverage Serving Worker (e.g., Bartender, Waiter, Waitress)</option>
                                <option value="Building and Grounds Cleaning and Maintenance">-  Building and Grounds Cleaning and Maintenance</option>
                                <option value="Personal Care and Service (e.g., Hairdresser, Flight Attendant, Concierge)">-  Personal Care and Service (e.g., Hairdresser, Flight Attendant, Concierge)</option>
                                <option value="Sales Supervisor, Retail Sales">-  Sales Supervisor, Retail Sales</option>
                                <option value="Retail Sales Worker">-  Retail Sales Worker</option>
                                <option value="Insurance Sales Agent">-  Insurance Sales Agent</option>
                                <option value="Sales Representative">-  Sales Representative</option>
                                <option value="Real Estate Sales Agent">-  Real Estate Sales Agent</option>
                                <option value="Other Services Occupation">-  Other Services Occupation</option>
                                </optgroup>
                                <optgroup label="Agriculture, Maintenance, Repair, and Skilled Crafts Occupations:">
                                <option value="Construction and Extraction (e.g., Construction Laborer, Electrician)">-  Construction and Extraction (e.g., Construction Laborer, Electrician)</option>
                                <option value="Farming, Fishing, and Forestry">-  Farming, Fishing, and Forestry</option>
                                <option value="Installation, Maintenance, and Repair">-  Installation, Maintenance, and Repair</option>
                                <option value="Production Occupations">-  Production Occupations</option>
                                <option value="Other Agriculture, Maintenance, Repair, and Skilled Crafts Occupation">-  Other Agriculture, Maintenance, Repair, and Skilled Crafts Occupation</option>
                                </optgroup>
                                <optgroup label="Transportation Occupations:">
                                <option value="Aircraft Pilot or Flight Engineer">-  Aircraft Pilot or Flight Engineer</option>
                                <option value="Motor Vehicle Operator (e.g., Ambulance, Bus, Taxi, or Truck Driver)">-  Motor Vehicle Operator (e.g., Ambulance, Bus, Taxi, or Truck Driver)</option>
                                <option value="Other Transportation Occupation">-  Other Transportation Occupation</option>
                                </optgroup>
                                <optgroup label="Other Occupations:">
                                <option value="Military">-  Military</option>
                                <option value="Homemaker">-  Homemaker</option>
                                <option value="Other Occupation">-  Other Occupation</option>
                                <option value="Don't Know">-  Don't Know</option>
                                <option value="Not Applicable">-  Not Applicable</option>
                                </optgroup>
                            </select>


                        {{--  <select class="form-control" required name="occupation" ng-model="user.occupation">
                            <option value="">--Select--</option>
                            <option value="IT">IT</option>
                            <option value="Business">Business</option>
                            <option value="Self-employed">Self-employed</option>
                            <option value="Constraction">Constraction</option>
                        </select>  --}}
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Your Income:</label>
                        <select class="form-control" required name="income" ng-model="user.income">
                            <option value="">--Select--</option>
                            <option value="Less than $5000">Less than $5000</option>
                            <option value="1-5000">$1-$5000</option>
                            <option value="5000-10000">$5000-$10,000</option>
                            <option value="10000-30000">$10,000-$30,000</option>
                            <option value="30000-50000">$30,000-$50,000</option>
                            <option value="50000-100000">$50,000-$100,000</option>
                            <option value="100000-300000">$100,000-$300,000</option>
                            <option value="300000-1000000">$300,000-$1,000,000</option>
                            <option value="N/A">N/A</option>
                        </select>
                    </div>
                </div>

            </div>

            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Tell us more about your job and your job schedule:</label>
                        <textarea class="form-control" required rows="8"maxlength="300" name="jobAndJobSchedule" ng-model="user.jobAndJobSchedule"></textarea>
                        <div class="textarea-detail">
                            <div class="max-cahracter">@{{300 - user.jobAndJobSchedule.length}} Characters left.
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-8">
                    <div class="form-group">
                        <label>Your social situation:</label>


                        @{{checklistss.length}}
                        <div class="checkbox-container">
                            <div class="cell" ng-repeat="chlist in checklist">
                                <input type="checkbox" ng-attr-id="check-@{{$index}}" name="yourSocialSituation[]" checklist-value="$index" checklist-model="user.yourSocialSituation" required>
                                <label ng-attr-for="check-@{{$index}}">
                                    <span></span> @{{chlist}}</label>
                            </div>

                        </div>
                    </div>

                </div>
            </div>


            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Do you have children?</label>
                        <select class="form-control" required name="haveChildren" ng-model="user.haveChildren">
                            <option value="">--Select--</option>
                            <option value="Yes">Yes</option>
                            <option value="No">No</option>
                        </select>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>If You have many?</label>
                        <input class="form-control form-control-number" type="tel" name="howMany" ng-model="user.howMany" required>
                        <!-- <select class="form-control" required name="howMany" ng-model="user.howMany">
                            <option value="">--Select--</option>
                            <option value="N/A">N/A</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                        </select> -->
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Do you own a car?</label>
                        <select class="form-control" required name="doYouOwnACar" ng-model="user.doYouOwnACar">
                            <option value="">--Select--</option>
                            <option value="Yes">Yes</option>
                            <option value="No">No</option>
                        </select>
                    </div>
                </div>

            </div>

            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Are you on any medication?</label>
                        <select class="form-control" required name="areYouOnAnyMedication" ng-model="user.areYouOnAnyMedication">
                            <option value="">--Select--</option>
                            <option value="Yes">Yes</option>
                            <option value="No">No</option>
                        </select>
                    </div>

                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Where your father and mother born?</label>
                        <!-- <select class="form-control" required name="wouldBirthFatherAndMotherAre" ng-model="user.wouldBirthFatherAndMotherAre">
                            <option value="">--Select--</option>
                            <option value="21">21</option>
                            <option value="22">22</option>
                            <option value="23">23</option>
                            <option value="24">24</option>
                        </select> -->
                        <select class="form-control" required name="wouldBirthFatherAndMotherAre" ng-model="user.wouldBirthFatherAndMotherAre">
                            <option value="">--Select--</option>
                            @foreach ($countries as $country)
                            <option value="{{$country->short_name}}">{{$country->short_name}}</option>
                            @endforeach
                            <option value="Not Applicable">Not Applicable</option>

                        </select>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>How ambitious are you?</label>
                        <select class="form-control" required name="howAmbitiousAreYou" ng-model="user.howAmbitiousAreYou">
                            <option value="">--Select--</option>
                            <option value="Very Important">Very Important</option>
                            <option value="Important">Important</option>
                            <option value="Somewhat Important">Somewhat Important</option>
                        </select>
                    </div>
                </div>

            </div>

            <div class="row">
                <div class="col-sm-4">
                    <div class="form-group">
                        <label>What is the longest relationship you have been in?</label>
                        <select class="form-control" required name="whatIsTheLongestRelationshipYouHaveBeenIn" ng-model="user.whatIsTheLongestRelationshipYouHaveBeenIn">
                            <option value="">--Select--</option>
                            <option value="1 year">1 Year</option>
                            <option value="2 years">2 Years</option>
                            <option value="3-6 years">3-6 Years</option>
                            <option value="longer">Longer</option>
                        </select>
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="form-group">
                        <label>What are your religiouse you do beliefs? </label>
                        <select class="form-control" required name="religiousBeliefs" ng-model="user.religiousBeliefs">
                            <option value="">--Select--</option>
                            <option value="Christians">Christians</option>
                            <option value="Muslims">Muslims</option>
                            <option value="Hindus">Hindus</option>
                            <option value="Judaism">Judaism</option>
                            <option value="Buddhists">Buddhists</option>
                            <option value="Jews">Jews</option>
                        </select>
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="form-group">
                        <label>How important in a relationship is my partner's dependability?</label>
                        <select class="form-control" required name="partnerDependability" ng-model="user.partnerDependability">
                            <option value="">--Select--</option>
                            <option value="Very Important">Very Important</option>
                            <option value="Somewhat Important">Somewhat Important</option>
                            <option value="What every happen">What every happen</option>
                            <option value="Unsure">Unsure</option>
                        </select>
                    </div>
                </div>

            </div>
            <div class="row">

                <div class="col-sm-4">
                    <div class="form-group">
                        <label>How important in a relationship is sexual compatibility</label>
                        <select class="form-control" required name="sexualCompatibility" ng-model="user.sexualCompatibility">
                            <option value="">--Select--</option>
                            <option value="Sometime">Sometime</option>
                            <option value="What is that">What is that</option>
                            <option value="Very Important">Very Important</option>
                            <option value="Important">Important</option>
                        </select>
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="form-group">
                        <label>How important in a relationship is the friendship between partners?</label>
                        <select class="form-control" required name="friendshipBetweenPartners" ng-model="user.friendshipBetweenPartners">
                            <option value="">--Select--</option>
                            <option value="Very Important">Very Important</option>
                            <option value="Important">Important</option>
                            <option value="Somewhat Important">Somewhat Important</option>
                        </select>
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Do you do drugs?</label>
                        <select class="form-control" required name="drugs" ng-model="user.drugs">
                            <option value="">--Select--</option>
                            <option value="Yes">Yes</option>
                            <option value="No">No</option>
                            <option value="Sometime">Sometime</option>
                        </select>
                    </div>
                </div>

            </div>
            <div class="row">

                <div class="col-sm-4">
                    <div class="form-group">
                        <label>What's your hair color?</label>
                        <select class="form-control" required name="hairColor" ng-model="user.hairColor">
                            <option value="">--Select--</option>
                            <option value="Light Ash Blonde">Light Ash Blonde</option>
                            <option value="Light Blonde">Light Blonde</option>
                            <option value="Light Golden Blonde">Light Golden Blonde</option>
                            <option value="Beeline Honey">Beeline Honey</option>
                            <option value="Medium Champagne">Medium Champagne</option>
                            <option value="Butterscotch">Butterscotch</option>
                            <option value="Light Cool Brown">Light Cool Brown</option>
                            <option value="Light Brown">Light Brown</option>
                            <option value="Light Golden Brown">Light Golden Brown</option>
                            <option value="Chocolate Brown">Chocolate Brown</option>
                            <option value="Dark Golden Brown">Dark Golden Brown</option>
                            <option value="Medium Ash Brown">Medium Ash Brown</option>
                            <option value="Reddish Blonde">Reddish Blonde</option>
                            <option value="Light Auburn">Light Auburn</option>
                            <option value="Medium Auburn">Medium Auburn</option>
                            <option value="Red Hot Cinnamon">Red Hot Cinnamon</option>
                            <option value="Expresso">Expresso</option>
                            <option value="Jet Black">Jet Black</option>
                        </select>
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="form-group">
                        <label>What's your hair style</label>
                        <select class="form-control" required name="hairStyle" ng-model="user.hairStyle">
                            <option value="">--Select--</option>
                            <option value="Long">Long</option>
                            <option value="Short">Short</option>
                            <option value="Medium">Medium</option>
                            <option value="Bob">Bob</option>
                            <option value="Shag">Shag</option>
                            <option value="Pixie">Pixie</option>
                            <option value="Updos">Updos</option>
                            <option value="Messy">Messy</option>
                            <option value="Layered">Layered</option>
                            <option value="Braided">Braided</option>
                            <option value="Vintage">Vintage</option>
                            <option value="Mohawk">Mohawk</option>
                            <option value="Celebrity">Celebrity</option>
                            <option value="Ponytails">Ponytails</option>
                            <option value="With Bangs">With Bangs</option>
                            <option value="Thick">Thick</option>
                            <option value="Thin">Thin</option>
                            <option value="Natural">Natural</option>
                            <option value="Straight">Straight</option>
                            <option value="Curly and Wavy">Curly and Wavy</option>
                        </select>
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="form-group">
                        <label>What's your eye color?</label>
                        <select class="form-control" required name="eyeColor" ng-model="user.eyeColor">
                            <option value="">--Select--</option>
                            <option value="Hazel Eye ">Hazel Eye </option>
                            <option value="Green Eye">Green Eye</option>
                            <option value="Gray">Gray</option>
                            <option value="Black">Black</option>
                            <option value="Brown">Brown</option>
                            <option value="Blue">Blue</option>
                            <option value="Amber">Amber</option>
                            <option value="Chestnut brown">Chestnut brown</option>
                        </select>
                    </div>
                </div>

            </div>
            <div class="row">

                <div class="col-sm-4">
                    <div class="form-group">
                        <label>How tall are you?</label>
                        <select class="form-control" required name="height" ng-model="user.height">
                            <option value="">--Select--</option>
                            <option ng-repeat="h in heightOptions()" value="@{{h}}">
                                @{{h}}
                            </option>
                        </select>
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="form-group">
                        <label>What's your body type?</label>
                        <select class="form-control" required name="bodyType" ng-model="user.bodyType">
                            <option value="">--Select--</option>
                            <option value="Definitive 'Hard Gainer'">Definitive "Hard Gainer"</option>
                            <option value="Delicate Built Body">Delicate Built Body </option>
                            <option value="Flat Chest">Flat Chest</option>
                            <option value="Fragile">Fragile</option>
                            <option value="Lean ">Lean </option>
                            <option value="Thin">Thin</option>
                            <option value="Athletic">Athletic</option>
                            <option value="Hard Body">Hard Body</option>
                            <option value="Hourglass Shaped">Hourglass Shaped</option>
                            <option value="Rectangular Shaped">Rectangular Shaped</option>
                            <option value="Mature Muscle">Mature Muscle</option>
                            <option value="Muscular Body">Muscular Body</option>
                            <option value="Excellent Posture">Excellent Posture</option>
                            <option value="Gains Muscle Easily">Gains Muscle Easily</option>
                            <option value="Fat">Fat</option>
                        </select>
                    </div>
                </div>


                <div class="col-sm-4">
                    <div class="form-group">
                        <label>What's your zodiac sign?</label>
                        <select class="form-control" required name="zodicSign" ng-model="user.zodicSign">
                            <option value="">--Select--</option>
                            <option value="Aries">
                                Aries - The Ram March 21 - April 19 Aries people are creative, adaptive, and insightful. "Hard Gainer"
                            </option>
                            <option value="Taurus">
                                Taurus - The Bull April 20 - May 20 Taurus zodiac signs and meanings, like the animal that represents them, is all about
                                strength, stamina and will.
                            </option>
                            <option value="Gemini">
                                Gemini - The Twins May 21 - June 20 Flexibility, balance and adaptability are the keywords for the Gemini.

                            </option>

                            <option value="Cancer">
                                Cancer - The Crab June 21 - July 22 Cancerians love home-life, family and domestic settings. They are traditionalists, and
                                enjoy operating on a fundamental level.

                            </option>
                            <option value="Leo">
                                Leo - The Lion July 23 - August 22 The zodiac signs and meanings of Leo is about expanse, power and exuberance.

                            </option>
                            <option value="Virgo">
                                Virgo - The Virgin August 23 - September22 Virgo's have keen minds, and are delightful to chat with, often convincing others
                                of outlandish tales with ease and charm.

                            </option>
                            <option value="Libra">
                                Libra - The Scales September 23 - October 22 As their zodiac signs and meanings would indicate, Libra's are all about balance,
                                justice, equanimity and stability.

                            </option>
                            <option value="Scorpio">
                                Scorpio - The Scorpion October 23 - November 21 The Scorpio is often misunderstood.

                            </option>
                            <option value="Sagittarius">
                                Sagittarius - The Centaur November 22 - December 21 Here we have the philosopher among the zodiac signs and meanings. Like
                                the Scorpio, they have great ability for focus, and can be very intense.

                            </option>
                            <option value="Capricorn">
                                Capricorn - The Goat December 22 - January 19 Capricorn's are also philosophical signs and are highly intelligent too.

                            </option>
                            <option value="Aquarius">
                                Aquarius - The Water Bearer January 20 - February 18 Often simple and unassuming, the Aquarian goes about accomplishing goals
                                in a quiet, often unorthodox ways

                            </option>

                            <option value="Pisces">
                                Pisces - The Fish February 19 - March 20 Also unassuming, the Pisces zodiac signs and meanings deal with acquiring vast amounts
                                of knowledge,

                            </option>
                            <option value="Not Applicable">Not Applicable</option>


                        </select>
                    </div>
                </div>

            </div>
            <div class="row">

                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Do you smoke?</label>
                        <select class="form-control" required name="smoke" ng-model="user.smoke">
                            <option value="">--Select--</option>
                            <option value="Yes">Yes</option>
                            <option value="No">No</option>
                            <option value="Stopping">Stopping</option>
                            <option value="Sometime">Sometime</option>
                        </select>
                    </div>
                </div>


                <div class="col-sm-4">
                    <div class="form-group">
                        <label>Do you drink?</label>
                        <select class="form-control" required name="drink" ng-model="user.drink">
                            <option value="">--Select--</option>
                            <option value="Yes">Yes</option>
                            <option value="No">No</option>
                            <option value="Somtime">Sometime</option>
                            <option value="casual">Casual</option>
                            <option value="with friends">With Friends</option>
                        </select>
                    </div>
                </div>


                <div class="col-sm-4">
                    <div class="form-group">
                        <label>How often do you excercise?</label>
                        <select class="form-control" required name="excercise" ng-model="user.excercise">
                            <option value="">--Select--</option>
                            <option value="regularly">Regularly</option>
                            <option value="once a week">Once a week</option>
                            <option value="five, three, two time a week">five, three, two time a week</option>
                            <option value="What that">What that</option>
                        </select>
                    </div>
                </div>

            </div>
            <div class="row">

                <div class="col-sm-4">
                    <div class="form-group">
                        <label>What excercise you do regularly</label>
                        <select class="form-control" required name="excerciseSchedule" ng-model="user.excerciseSchedule">
                            <option value="">--Select--</option>
                            <option value="chest">chest</option>
                            <option value="shoulders">shoulders</option>
                            <option value="triceps">triceps</option>
                            <option value="hamstrings">hamstrings</option>
                            <option value="back">back</option>
                            <option value="walking">walking</option>
                            <option value="running">running</option>
                            <option value="jogging">jogging</option>
                            <option value="gym">gym</option>
                            <option value="swimming">swimming</option>
                        </select>
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="form-group">
                        <label>What's your education level?</label>
                        <select class="form-control" required name="educationLevel" ng-model="user.educationLevel">
                            <option value="">--Select--</option>
                            <option value="Level 4- GED Certificate ">Level 4- GED Certificate </option>
                            <option value="Level 5- High School Diploma ">Level 5- High School Diploma </option>
                            <option value="Level 6- Bachelor's ">Level 6- Bachelor's </option>
                            <option value="Level 7- Masters ">Level 7- Masters </option>
                            <option value="Level 7- Masters ">Level 7- Masters </option>
                            <option value="Level 8- Doctorate  ">Level 8- Doctorate </option>
                            <option value="Level AA">Level AA</option>
                        </select>
                    </div>
                </div>


                <div class="col-sm-4">
                    <div class="form-group">
                        <label>What language do you speak?</label>
                        <select class="form-control" required name="language" ng-model="user.language">
                            <option value="">--Select--</option>
                            <option value="Spanish">Spanish</option>
                            <option value="English">English</option>
                            <option value="Hindi">Hindi</option>
                            <option value="Arabic">Arabic</option>
                            <option value="Russian">Russian</option>
                            <option value="Portuguese">Portuguese</option>
                            <option value="Japanese">Japanese</option>
                            <option value="German">German</option>
                            <option value="French">French</option>

                        </select>
                    </div>
                </div>

            </div>
            <div class="row">

                <div class="col-sm-4">
                    <div class="form-group">
                        <label>What is your ethnicity? </label>
                        <select class="form-control" required name="ethnicity" ng-model="user.ethnicity">
                            <option value="">--Select--</option>
                            <option value="Hispanic or Latino ">Hispanic or Latino </option>
                            <option value="Not Hispanic ">Not Hispanic </option>
                            <option value="American Indian ">American Indian </option>
                            <option value="Alaska Native">Alaska Native</option>
                            <option value="Asian">Asian</option>
                            <option value="Black">Black </option>
                            <option value="African American">African American</option>
                            <option value="Native Hawaiian or Other Pacific Islander">Native Hawaiian or Other Pacific Islander</option>
                            <option value="White">White</option>
                        </select>
                    </div>
                </div>

            </div>

            <div class="form-group padding-top text-right">
                <button class="common-red-btn button" type="submit">Next</button>
            </div>
        </div>
    </form>

    <script type="text/ng-template" id="loading-modal.html">
        <div>
            <p class="lead text-center">
                <i class="fa fa-spinner fa-spin fa-3x" aria-hidden="true"></i>
            </p>
        </div>

    </script>

</div>

@endsection