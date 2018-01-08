@extends('master')

@section('form_area')

<div>
    <div ng-controller="searchController" ng-cloak>
        <toast></toast>


        <div class="inner-header aboutyour-header">

            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h1>
                            <i class="fa fa-users" aria-hidden="true"></i> Search Users
                        </h1>

                    </div>

                </div>
            </div>
        </div>

        <div class="inner-contendbgx">

            <div class="container padding-top">
                <div class="row">

                    <div class="col-md-3">
                        <div class="left-section">
                            <uib-accordion close-others="true">
                                <div uib-accordion-group class="panel-danger" is-open="searchSettings.byName">
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

                                <div uib-accordion-group class="panel-danger" is-open="search.advance">
                                    <uib-accordion-heading>
                                        <i class="fa fa-search" aria-hidden="true"></i>
                                        <strong>Advance Search</strong>
                                    </uib-accordion-heading>

                                    <form class="quick-search-row" id="search_form" name="search_form" ng-submit="submitForm(search_form)" ng-validate="validationOptions" novalidate>

                                        <div class="row row-advance-search">
                                            <div class="col-sm-12">
                                                <h2 ng-show="search.advance">Basics</h2>
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

                                                    </div>



                                                </div>

                                                <div class="advance-col" ng-show="search.advance">
                                                    <h2>Appearance</h2>
                                                    <uib-accordion close-others="oneAtATime">
                                                        
                                                        <div uib-accordion-group class="panel-default">
                                                            <uib-accordion-heading>
                                                                <i class="fa fa-caret-right pull-right" aria-hidden="true"></i>
                                                                Height
                                                            </uib-accordion-heading>
                                                            <div class="form-group">
                                                                <select class="form-control" name="height" ng-model="formData.height" >
                                                                    <option value="">--Select--</option>
                                                                    <option ng-repeat="h in heightOptions()" value="@{{h}}">
                                                                        @{{h}}
                                                                    </option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        
                                                        <div uib-accordion-group class="panel-default">
                                                            <uib-accordion-heading>
                                                                <i class="fa fa-caret-right pull-right" aria-hidden="true"></i>
                                                                Body type
                                                            </uib-accordion-heading>
                                                            <div class="form-group">
                                                                <select class="form-control" name="bodyType" ng-model="formData.bodyType" >
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

                                                        <div uib-accordion-group class="panel-default">
                                                            <uib-accordion-heading>
                                                                <i class="fa fa-caret-right pull-right" aria-hidden="true"></i>
                                                                Eye color
                                                            </uib-accordion-heading>
                                                            <div class="form-group">
                                                                <select class="form-control" name="eyeColor" ng-model="formData.eyeColor" >
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
                                                        
                                                        <div uib-accordion-group class="panel-default">
                                                            <uib-accordion-heading>
                                                                <i class="fa fa-caret-right pull-right" aria-hidden="true"></i>
                                                                Hair color
                                                            </uib-accordion-heading>

                                                            <div class="form-group">
                                                                <select class="form-control" name="hairColor" ng-model="formData.hairColor" >
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
                                                    </uib-accordion>

                                                </div>

                                            
                                            </div>

                                            <div class="col-sm-12 padding-top-15">
                                                <h2>Background</h2>
                                                <uib-accordion close-others="oneAtATime">
                                                    <div uib-accordion-group class="panel-default">
                                                        <uib-accordion-heading>
                                                            <i class="fa fa-caret-right pull-right" aria-hidden="true"></i>
                                                            Relatioship goal
                                                        </uib-accordion-heading>
                                                        <div class="form-group">
                                                            <select class="form-control" name="relationshipGoal" ng-model="formData.relationshipGoal">
                                                                <option value="">--Select--</option>
                                                                <option value="long term relationship">Long Term Relationship</option>
                                                                <option value="short term relationship">Short Term Relationship</option>
                                                                <option value="to get married">To Get Married</option>
                                                                <option value="casual dating">Casual Dating</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div uib-accordion-group class="panel-default">
                                                        <uib-accordion-heading>
                                                            <i class="fa fa-caret-right pull-right" aria-hidden="true"></i>
                                                            Ethnicity
                                                        </uib-accordion-heading>

                                                        <div class="form-group">
                                                            <select class="form-control" name="ethnicity" ng-model="formData.ethnicity">
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
                                                    <div uib-accordion-group class="panel-default">
                                                        <uib-accordion-heading>
                                                            <i class="fa fa-caret-right pull-right" aria-hidden="true"></i>
                                                            Faith
                                                        </uib-accordion-heading>
                                                        <div class="form-group">
                                                            <select class="form-control" name="religiousBeliefs" ng-model="formData.religiousBeliefs">
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
                                                    <div uib-accordion-group class="panel-default">
                                                        <uib-accordion-heading>
                                                            <i class="fa fa-caret-right pull-right" aria-hidden="true"></i>
                                                            Education
                                                        </uib-accordion-heading>
                                                        <div class="form-group">
                                                            <select class="form-control" name="educationLevel" ng-model="formData.educationLevel">
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
                                                    <div uib-accordion-group class="panel-default">
                                                        <uib-accordion-heading>
                                                            <i class="fa fa-caret-right pull-right" aria-hidden="true"></i>
                                                            Language
                                                        </uib-accordion-heading>
                                                        <div class="form-group">
                                                            <select class="form-control" name="language" ng-model="formData.language">
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

                                                </uib-accordion>

                                                <div class="padding-top-15">
                                                    
                                                    <h2>Lifestyle</h2>
                                                    <uib-accordion closeothers="oneAtATime">
                                                        <div uib-accordion-group class="panel-default">
                                                            <uib-accordion-heading>
                                                                <i class="fa fa-caret-right pull-right" aria-hidden="true"></i>
                                                                Smoke
                                                            </uib-accordion-heading>

                                                            <div class="form-group">
                                                                <select class="form-control" name="smoke" ng-model="formData.smoke">
                                                                    <option value="">--Select--</option>
                                                                    <option value="Yes">Yes</option>
                                                                    <option value="No">No</option>
                                                                    <option value="Stopping">Stopping</option>
                                                                    <option value="Sometime">Sometime</option>
                                                                </select>
                                                            </div>

                                                        </div>
                                                        <div uib-accordion-group class="panel-default">
                                                            <uib-accordion-heading>
                                                                <i class="fa fa-caret-right pull-right" aria-hidden="true"></i>
                                                                Drink
                                                            </uib-accordion-heading>

                                                            <div class="form-group">
                                                                <select class="form-control" name="drink" ng-model="formData.drink">
                                                                    <option value="">--Select--</option>
                                                                    <option value="Yes">Yes</option>
                                                                    <option value="No">No</option>
                                                                    <option value="Somtime">Sometime</option>
                                                                    <option value="casual">Casual</option>
                                                                    <option value="with friends">With Friends</option>
                                                                </select>
                                                            </div>

                                                        </div>
                                                        <div uib-accordion-group class="panel-default">
                                                            <uib-accordion-heading>
                                                                <i class="fa fa-caret-right pull-right" aria-hidden="true"></i>
                                                                Excercise frequency
                                                            </uib-accordion-heading>

                                                            <div class="form-group">
                                                                <select class="form-control" name="excercise" ng-model="formData.excercise">
                                                                    <option value="">--Select--</option>
                                                                    <option value="regularly">Regularly</option>
                                                                    <option value="once a week">Once a week</option>
                                                                    <option value="five, three, two time a week">five, three, two time a week</option>
                                                                    <option value="What that">What that</option>
                                                                </select>
                                                            </div>

                                                        </div>
                                                        <div uib-accordion-group class="panel-default">
                                                            <uib-accordion-heading>
                                                                <i class="fa fa-caret-right pull-right" aria-hidden="true"></i>
                                                                Has kids
                                                            </uib-accordion-heading>

                                                            <div class="form-group">
                                                                <select class="form-control" name="haveChildren" ng-model="formData.haveChildren">
                                                                    <option value="">--Select--</option>
                                                                    <option value="Yes">Yes</option>
                                                                    <option value="No">No</option>
                                                                </select>
                                                            </div>

                                                        </div>
                                                        <div uib-accordion-group class="panel-default">
                                                            <uib-accordion-heading>
                                                                <i class="fa fa-caret-right pull-right" aria-hidden="true"></i>
                                                                Occupation
                                                            </uib-accordion-heading>
                                                            <div class="form-group">
                                                                <select class="form-control" name="occupation" ng-model="formData.occupation">
                                                                    <option value="">--Select--</option>
                                                                    <option value="IT">IT</option>
                                                                    <option value="Business">Business</option>
                                                                    <option value="Self-employed">Self-employed</option>
                                                                    <option value="Constraction">Constraction</option>
                                                                </select>
                                                            </div>
                                                            
                                                            

                                                        </div>
                                                        <div uib-accordion-group class="panel-default">
                                                            <uib-accordion-heading>
                                                                <i class="fa fa-caret-right pull-right" aria-hidden="true"></i>
                                                                Salary range
                                                            </uib-accordion-heading>

                                                            <div class="form-group">
                                                                <select class="form-control" name="income" ng-model="formData.income">
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
                                                        <div uib-accordion-group class="panel-default">
                                                            <uib-accordion-heading>
                                                                <i class="fa fa-caret-right pull-right" aria-hidden="true"></i>
                                                                Zodiac Sign
                                                            </uib-accordion-heading>
                                                            <div class="form-group">
                                                                <select class="form-control" name="zodicSign" ng-model="formData.zodicSign">
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
                                                                </select>
                                                            </div>

                                                        </div>

                                                    </uib-accordion>
                                                
                                                </div>

                                            </div>
                                        </div>
                                        

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="">&nbsp;</label>
                                                    <input type="submit" value="Search Now" class="btn btn-danger btn-block btn-submit-search" />
                                                </div>
                                            </div>
                                        </div>

                                    </form>

                                </div>
                                
                                <div uib-accordion-group class="panel-danger" is-open="search.isQuick">
                                    <uib-accordion-heading>
                                        <i class="fa fa-search" aria-hidden="true"></i>
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



                    </div>

                    <div class="col-md-9">

                        <div class="row" id="search_result_list">
                            <div class="col-md-4 browse-profile-bg" ng-repeat="user in data.users" ng-if="!isLoading">
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
                                        <a class="btn btn-default btn-block" ng-if="!user.is_friend" ng-click="addUser(user)">
                                            <i class="fa fa-user fa-fw"></i> Add Friend
                                        </a>

                                        <a class="btn btn-success btn-block" ng-if="user.is_friend" ng-click="addUser(user)">
                                            <i class="fa fa-user fa-fw"></i> Friends
                                        </a>

                                        <a class="btn btn-link btn-block" ng-href="@{{ base_url + '/search/profile/' + user.id}}" target="_blank">
                                            <span class="fa fa-link fa-fw" aria-hidden="true"></span> Profile
                                        </a>

                                    </div>
                                </div>
                            </div>


                            <div class="col-sm-12">
                                <p class="padding-top text-center" ng-click="promptToLogin()" ng-if="!data.user_id && data.users.length > 2 && !isLoading">
                                    <a class="btn btn-default">
                                        Load more matching users..
                                    </a>
                                </p>


                                <div class="alert alert-danger" ng-if="!data.users.length && !isLoading">
                                    No Match Found for current search. Please try again by widening the search criteria.
                                </div>


                                <p class="lead text-center text-muted search-loading" ng-if="isLoading">
                                    <i class="fa fa-spinner fa-spin fa-2x" aria-hidden="true"></i>
                                </p>
                            </div>



                            <div class="clearfix col-sm-12" ng-if="data.users.length">
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