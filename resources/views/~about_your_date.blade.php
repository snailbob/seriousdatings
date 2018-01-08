@extends('master')


@section('form_area')
<div ng-app="seriousDatingApp">
    <div ng-controller="aboutDateController" ng-cloak>
        <toast></toast>
        <form id="aboutYourDate" name="aboutYourDate" ng-submit="submitForm(aboutYourDate)" ng-validate="validationOptions" class="signup_form" novalidate>
            <div class="container">

                <div class="row">
                    <div class="col-md-12" style="padding:0px">

                        <div class="about-date-top-form">
                            <div class="row">
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label>Looking For:</label>
                                        <select class="form-control" name="gender" ng-model="formData.gender" required>
                                            <option value="">--Select--</option>
                                            <option value="male">Male</option>
                                            <option value="Female">Female</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label>Between Age</label>
                                        <select class="form-control" name="age_from" ng-model="formData.age_from" id="date_age" required>
                                            <option value="">--Select--</option>
                                            @for ($i = 18; $i <= 80; $i+=1)
                                                <option value="{{$i}}">{{$i}}</option>
                                            @endfor
                                        </select>    
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label>To</label>
                                        <select class="form-control" name="age_to" ng-model="formData.age_to" id="date_age_to" required>
                                            <option value="">--Select--</option>
                                            @for ($i = 18; $i <= 80; $i+=1)
                                                <option value="{{$i}}">{{$i}}</option>
                                            @endfor
                                        </select>   
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label> From zipcode:</label>
                                        <input type="tel" class="form-control" name="zipcode" ng-model="formData.zipcode" placeholder="" id="zipCode" required />
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                            <label>Within (Miles)</label>
                                            <select class="form-control" name="rangeOfMiles" ng-model="formData.rangeOfMiles" id="date_rangeOfMiles" required>
                                                <option value="">Select</option>
                                                @for ($i = 5; $i <= 100; $i+=5)
                                                    <option value="{{$i}}">{{$i}}</option>
                                                @endfor
                                            </select>

                                    </div>
                                </div>
                            </div>


                        </div>

                    </div>
                </div>


                <div class="row">
                    <!--<form name="about- ng-model="formData.about"date-form" class="about-date-form">-->
                        <div class="form-row single-line-label">
                            <div class="four-cols form-group">
                                <label>Your Relatioship goal:</label>
                                <select class="form-control" name="relationshipGoal" ng-model="formData.relationshipGoal" required>
                                    <option value="">--Select--</option>
                                    <option value="long term relationship">Long Term Relationship</option>
                                    <option value="short term relationship">Short Term Relationship</option>
                                    <option value="to get married">To Get Married</option>
                                    <option value="casual dating">Casual Dating</option>
                                    <option value="na">N/A</option>

                                </select>
                            </div>
                            <div class="four-cols form-group">
                                <label>What is his/her salary range?</label>
                                <select class="form-control" name="income" ng-model="formData.income" required>
                                    <option value="">--Select--</option>
                                    <option value="Less than $5000">Less than $5000</option>
                                    <option value="1-5000">$1-$5000</option>
                                    <option value="5000-10000">$5000-$10,000</option>
                                    <option value="10000-30000">$10,000-$30,000</option>
                                    <option value="30000-50000">$30,000-$50,000</option>
                                    <option value="50000-100000">$50,000-$100,000</option>
                                    <option value="100000-300000">$100,000-$300,000</option>
                                    <option value="300000-1000000">$300,000-$1,000,000</option>
                                    <option value="na">N/A</option>
                                </select>
                            </div>
                            <div class="four-cols form-group">
                                <label>Does he/she have kids?</label>
                                <select class="form-control" name="haveChildren" ng-model="formData.haveChildren" required>
                                    <option value="">--Select--</option>
                                    <option value="Yes">Yes</option>
                                    <option value="No">No</option>
                                    <option value="na">N/A</option>
                                </select>
                            </div>
                            <div class="four-cols form-group">
                                <label>What's his/her relationship status? </label>
                                <select class="form-control" name="relationshipStatus" ng-model="formData.relationshipStatus" required>
                                    <option value="">--Select--</option>
                                    <option value="In a relationship, but not working">In a relationship, but not working</option>
                                    <option value="Not sure">Not sure</option>
                                    <option value="Single">Single</option>
                                    <option value="We are friends">We are friends</option>
                                    <option value="I'm in a serious relationship">I'm in a serious relationship</option>
                                    <option value="Sex Only">Sex Only</option>
                                    <option value="Engaged">Engaged</option>
                                    <option value="Married">Married</option>
                                    <option value="Is is complicated">It is complicated</option>
                                    <option value="Widowed">Widowed</option>
                                    <option value="Separated">Separated</option>
                                    <option value="Divorced">Divorced</option>
                                    <option value="In a domestic partnership">In a domestic partnership</option>
                                    <option value="In an open relationship">In an open relationship</option>
                                    <option value="na">N/A</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-row single-line-label">
                            <div class="four-cols form-group">
                                <label>Where were his/her Mother born?</label>
                                <select name="motherBorn" ng-model="formData.motherBorn" id="" class="form-control" required>
                                    <option value="">--Select--</option>
                                    @foreach ($countries as $country)
                                    <option value="{{$country->short_name}}">{{$country->short_name}}</option>
                                    @endforeach
                                </select>

                            </div>
                            <div class="four-cols form-group">
                                <label>Where were his/her Father born?</label>
                                <select name="fatherBorn" ng-model="formData.fatherBorn" id="" class="form-control" required>
                                    <option value="">--Select--</option>
                                    @foreach ($countries as $country)
                                    <option value="{{$country->short_name}}">{{$country->short_name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="four-cols form-group">
                                <label>How important in a relationship is sexual compatibility</label>
                                <select class="form-control" name="sexualCompatibility" ng-model="formData.sexualCompatibility" required>
                                    <option value="">--Select--</option>
                                    <option value="Sometime">Sometime</option>
                                    <option value="What is that">What is that</option>
                                    <option value="Very Important">Very Important</option>
                                    <option value="Important">Important</option>
                                    <option value="na">N/A</option>
                                </select>
                            </div>
                            <div class="four-cols form-group">
                                <label>How important in a relationship is the friendship between partners?</label>
                                <select class="form-control" name="friendshipBetweenPartners" ng-model="formData.friendshipBetweenPartners" required>
                                    <option value="">--Select--</option>
                                    <option value="Very Important">Very Important</option>
                                    <option value="Important">Important</option>
                                    <option value="Somewhat Important">Somewhat Important</option>
                                    <option value="na">N/A</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-row single-line-label">
                            <div class="four-cols form-group">
                                <label>Does he/she do drug?</label>
                                <select class="form-control" name="drugs" ng-model="formData.drugs" required>
                                    <option value="">--Select--</option>
                                    <option value="Yes">Yes</option>
                                    <option value="No">No</option>
                                    <option value="Sometime">Sometime</option>
                                    <option value="na">N/A</option>
                                </select>
                            </div>
                            <div class="four-cols form-group">
                                <label>What's his/her hair color?</label>
                                <select class="form-control" name="hairColor" ng-model="formData.hairColor" required>
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
                                    <option value="na">N/A</option>
                                </select>
                            </div>
                            <div class="four-cols form-group">
                                <label>What's your hair style</label>
                                <select class="form-control" name="hairStyle" ng-model="formData.hairStyle" required>
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
                                    <option value="na">N/A</option>
                                </select>

                            </div>
                            <div class="four-cols form-group">
                                <label>What's his/her eye color?</label>
                                <select class="form-control" name="eyeColor" ng-model="formData.eyeColor" required>
                                    <option value="">--Select--</option>
                                    <option value="Hazel Eye ">Hazel Eye </option>
                                    <option value="Green Eye">Green Eye</option>
                                    <option value="Gray">Gray</option>
                                    <option value="Black">Black</option>
                                    <option value="Brown">Brown</option>
                                    <option value="Blue">Blue</option>
                                    <option value="Amber">Amber</option>
                                    <option value="Chestnut brown">Chestnut brown</option>
                                    <option value="na">N/A</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-row single-line-label">
                            <div class="four-cols form-group">
                                <label>How tall is he/her?</label>
                                <select class="form-control" required name="height" ng-model="formData.height">
                                    <option value="">--Select--</option>
                                    <option value="4ft">4ft</option>
                                    <option value="5ft">5ft</option>
                                    <option value="6ft">6ft</option>
                                    <option value="7ft">7ft</option>
                                </select>

                            </div>
                            <div class="four-cols form-group">
                                <label>What's your body type?</label>
                                <select class="form-control" name="bodyType" ng-model="formData.bodyType" required>
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
                                    <option value="na">N/A</option>
                                </select>
                            </div>
                            <div class="four-cols form-group">
                                <label>What's your zodic sign?</label>
                                <select class="form-control" name="zodicSign" ng-model="formData.zodicSign" required>
                                    <option value="">--Select--</option>
                                    <option value="1">
                                        Aries - The Ram March 21 - April 19 Aries people are creative, adaptive, and insightful. "Hard Gainer"
                                    </option>
                                    <option value="2">
                                        Taurus - The Bull April 20 - May 20 Taurus zodiac signs and meanings, like the animal that represents them, is all about
                                        strength, stamina and will.
                                    </option>
                                    <option value="3">
                                        Gemini - The Twins May 21 - June 20 Flexibility, balance and adaptability are the keywords for the Gemini.

                                    </option>

                                    <option value="4">
                                        Cancer - The Crab June 21 - July 22 Cancerians love home-life, family and domestic settings. They are traditionalists, and
                                        enjoy operating on a fundamental level.

                                    </option>
                                    <option value="5">
                                        Leo - The Lion July 23 - August 22 The zodiac signs and meanings of Leo is about expanse, power and exuberance.

                                    </option>
                                    <option value="6">
                                        Virgo - The Virgin August 23 - September22 Virgo's have keen minds, and are delightful to chat with, often convincing others
                                        of outlandish tales with ease and charm.

                                    </option>
                                    <option value="7">
                                        Libra - The Scales September 23 - October 22 As their zodiac signs and meanings would indicate, Libra's are all about balance,
                                        justice, equanimity and stability.

                                    </option>
                                    <option value="8">
                                        Scorpio - The Scorpion October 23 - November 21 The Scorpio is often misunderstood.

                                    </option>
                                    <option value="9">
                                        Sagittarius - The Centaur November 22 - December 21 Here we have the philosopher among the zodiac signs and meanings. Like
                                        the Scorpio, they have great ability for focus, and can be very intense.

                                    </option>
                                    <option value="10">
                                        Capricorn - The Goat December 22 - January 19 Capricorn's are also philosophical signs and are highly intelligent too.

                                    </option>
                                    <option value="11">
                                        Aquarius - The Water Bearer January 20 - February 18 Often simple and unassuming, the Aquarian goes about accomplishing goals
                                        in a quiet, often unorthodox ways

                                    </option>

                                    <option value="12">
                                        Pisces - The Fish February 19 - March 20 Also unassuming, the Pisces zodiac signs and meanings deal with acquiring vast amounts
                                        of knowledge,

                                    </option>
                                    <option value="na">N/A</option>
                                </select>
                            </div>
                            <div class="four-cols form-group">
                                <label>Does he/she smoke? </label>
                                <select class="form-control" name="smoke" ng-model="formData.smoke" required>
                                    <option value="">--Select--</option>
                                    <option value="Yes">Yes</option>
                                    <option value="No">No</option>
                                    <option value="Stopping">Stopping</option>
                                    <option value="Sometime">Sometime</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-row single-line-label">
                            <div class="four-cols form-group">
                                <label>Does he/she drink?</label>
                                <select class="form-control" name="drink" ng-model="formData.drink" required>
                                    <option value="">--Select--</option>
                                    <option value="Yes">Yes</option>
                                    <option value="No">No</option>
                                    <option value="Somtime">Sometime</option>
                                    <option value="casual">Casual</option>
                                    <option value="with friends">With Friends</option>
                                    <option value="na">N/A</option>
                                </select>
                            </div>
                            <div class="four-cols form-group">
                                <label>How often do you excercise?</label>
                                <select class="form-control" name="excercise" ng-model="formData.excercise" required>
                                    <option value="">--Select--</option>
                                    <option value="regularly">Regularly</option>
                                    <option value="once a week">Once a week</option>
                                    <option value="five, three, two time a week">five, three, two time a week</option>
                                    <option value="What that">What that</option>
                                    <option value="na">N/A</option>
                                </select>
                            </div>
                            <div class="four-cols form-group">
                                <label>What excercise you do regularly</label>
                                <select class="form-control" name="excerciseSchedule" ng-model="formData.excerciseSchedule" required>
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
                                    <option value="na">N/A</option>
                                </select>
                            </div>
                            <div class="four-cols form-group">
                                <label>What's his/her education?</label>
                                <select class="form-control" name="educationLevel" ng-model="formData.educationLevel" required>
                                    <option value="">--Select--</option>
                                    <option value="Level 4- GED Certificate ">Level 4- GED Certificate </option>
                                    <option value="Level 5- High School Diploma ">Level 5- High School Diploma </option>
                                    <option value="Level 6- Bachelor's ">Level 6- Bachelor's </option>
                                    <option value="Level 7- Masters ">Level 7- Masters </option>
                                    <option value="Level 7- Masters ">Level 7- Masters </option>
                                    <option value="Level 8- Doctorate  ">Level 8- Doctorate </option>
                                    <option value="Level AA">Level AA</option>
                                    <option value="na">N/A</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-row single-line-label">
                            <div class="four-cols form-group">
                                <label>What languages does he/she speak?</label>
                                <select class="form-control" name="language" ng-model="formData.language" required>
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
                                    <option value="na">N/A</option>
                                </select>
                            </div>
                            <div class="four-cols form-group">
                                <label>What's his/her ethnicity?</label>
                                <select class="form-control" name="ethnicity" ng-model="formData.ethnicity" required>
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
                                    <option value="na">N/A</option>
                                </select>
                            </div>
                            <div class="four-cols form-group">
                                <label>What are his/her religious beliefs?</label>
                                <select class="form-control" name="religiousBeliefs" ng-model="formData.religiousBeliefs" required>
                                    <option value="">--Select--</option>
                                    <option value="Christians">Christians</option>
                                    <option value="Muslims">Muslims</option>
                                    <option value="Hindus">Hindus</option>
                                    <option value="Judaism">Judaism</option>
                                    <option value="Buddhists">Buddhists</option>
                                    <option value="Jews">Jews</option>
                                    <option value="na">N/A</option>
                                </select>
                            </div>
                            <div class="four-cols form-group">
                                <label>What is the longest relationship he/she must have been in?</label>
                                <select class="form-control" name="whatIsTheLongestRelationshipYouHaveBeenIn" ng-model="formData.whatIsTheLongestRelationshipYouHaveBeenIn" required>
                                    <option value="">--Select--</option>
                                    <option value="1 year">1 Year</option>
                                    <option value="2 years">2 Years</option>
                                    <option value="3-6 years">3-6 Years</option>
                                    <option value="longer">Longer</option>
                                    <option value="na">N/A</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-row single-line-label">
                            <div class="four-cols form-group">
                                <label>Does he/she want kids? </label>
                                <select class="form-control" name="wantKids" ng-model="formData.wantKids" required>
                                    <option value="">--Select--</option>
                                    <option value="Yes">Yes</option>
                                    <option value="No">No</option>
                                    <option value="Maybe">Maybe</option>
                                    <option value="Don't Know">Don't Know</option>
                                    <option value="na">N/A</option>

                                </select>
                            </div>
                            <div class="four-cols form-group">
                                <label>Do you have Tattoos?</label>
                                <select class="form-control" name="tatoos" ng-model="formData.tatoos" required>
                                    <option value="">--Select--</option>
                                    <option value="Yes">Yes</option>
                                    <option value="No">No</option>
                                    <option value="Some">Some</option>
                                    <option value="na">N/A</option>

                                </select>
                            </div>

                            <div class="four-cols form-group">
                                <label>How important in a relationship is partner's dependability?</label>
                                <select class="form-control" name="partnerDependability" ng-model="formData.partnerDependability" required>
                                    <option value="">--Select--</option>
                                    <option value="Very Important">Very Important</option>
                                    <option value="Somewhat Important">Somewhat Important</option>
                                    <option value="What every happen">What every happen</option>
                                    <option value="Unsure">Unsure</option>
                                    <option value="na">N/A</option>
                                </select>
                            </div>
                        </div>

                </div>
                <div class="row">
                    <div class="form-row single-line-label text-right">
                        <input type="hidden" value="{{$user->username}}" name="user_id" ng-model="formData.user_id" id="user_id" />
                        <input type="hidden" value="" name="lati" ng-model="formData.lati" id="lati" />
                        <input type="hidden" value="" name="longi" ng-model="formData.longi" id="longi" />

                        <input type="submit" class="common-red-btn button" id="" value="Submit">
                    </div>
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
</div>

@endsection
