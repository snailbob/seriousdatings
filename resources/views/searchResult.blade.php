@include('header')
<div class="middle inner-middle">

    <div class="inner-header aboutyour-header">

    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-12 header_btmimgtxt">
                <h1><i class="icon-sprite aboutdate-icon"></i>About your date</h1>
                <p style="margin-left:25%">Lorem ipsum dolor sit amet, consectetur adipiscing elit</p>

            </div>

        </div>
    </div>


    <div class="inner-contendbg">

        <div class="container">

            <div class="row">
                <div class="col-md-12">
                    <ul class="nav nav-tabs nav-justified" style="background:#C1C2C3">
                        <li role="presentation" class="active"><a href="search.php" class="menutxt">
                                <span class="glyphicon glyphicon-search" aria-hidden="true"></span>&nbsp Search</a></li>
                        <li role="presentation"><a href="yourmatch.php" class="menutxt" >
                                <span class="glyphicon glyphicon-resize-small" aria-hidden="true"></span>&nbsp Mutual Match</a></li>
                        <li role="presentation"><a href="#" class="menutxt">
                                <span class="glyphicon glyphicon-log-out" aria-hidden="true"></span>&nbsp Reverse Match</a></li>
                        <li role="presentation"><a href="yourmatch.php" class="menutxt" >
                                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>&nbsp Communities</a></li>
                    </ul>
                </div>
            </div>



            <div class="row" style="background:#FFF;padding-top:12px;padding-bottom:5px">
                <div class="col-md-6" style="padding-left:0px">
                    <div class="placeholder_txt" ><input type="text" name="srch" placeholder="username search"/>

                        <a class="btn btn-default btn-sm" href="#" role="button" style="background:#e21d24;color:#FFF;height:30px">
                            <span class="glyphicon glyphicon-search" aria-hidden="true"></span>&nbsp SEARCH </a>
                    </div>
                </div>


                <div class="col-md-4 pull-right" style="padding-left:0px">
                    Sort By:
      <span class="dropdown">
  <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
      Match picks
      <span class="caret"></span>
  </button>
       <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
           <li><a href="#">Match picks</a></li>
           <li><a href="#">Activity Date</a></li>
           <li><a href="#">Newest First</a></li>
           <li><a href="#">Age</a></li>
           <li><a href="#">Photo Counts</a></li>
           <li><a href="#">Username</a></li>
           <li><a href="#">Distance</a></li>
           <li><a href="#">Mutual Match</a></li>
           <li><a href="#">Reverse Match</a></li>
       </ul>
   </span>
                </div>

            </div>



            <div class="row">




                @include('left_sidebar')


                <div class="col-md-8" style="padding-top:10px;">

                    <div class="row right_head" style="margin-left:0px !important">
                        <div class="col-md-12">
                            <div style="float:left;line-height:40px">293 Matches Found</div>
                            <div>
         <span class="checkbox">
             <label>
                 <input type="checkbox"> Available for Chat
             </label>

             <label>
                 <input type="checkbox">Online now
             </label>

             <label>
                 <input type="checkbox" checked="checked"> With Photo
             </label>
         </span>

                            </div>

                        </div></div>


                    <div class="row custom1" style="padding-left:5px">

                        <div class="col-md-4 card">

                            <div class="card_up">
                                <div class="up_left">
                                    <a href="#">
                                        <img src="images/3010.jpg" class="img-responsive" height="100%" width="100%"/></a>
                                </div>
                                <div class="up_right">
                                    <div><a href="">AnaB07</a></div>
                                    <p>26, Chittoor<br />
                                        Within 3 days</p>
                                </div>
                            </div>
                            <div class="card_down">
                                <a href="#">
                                    <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>    Quick View
                                </a>
                            </div>
                        </div>

                        <div class="col-md-4 card">

                            <div class="card_up">
                                <div class="up_left">
                                    <a href="#"><img src="images/3079.jpg" class="img-responsive" height="100%" width="100%"/></a>
                                </div>
                                <div class="up_right">
                                    <div><a href="">Angel</a></div>
                                    <p>32, Chittoor<br />
                                        Within 5 days</p>
                                </div>
                            </div>
                            <div class="card_down">
                                <a href="#">
                                    <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>    Quick View
                                </a>
                            </div>
                        </div>

                        <div class="col-md-4 card">

                            <div class="card_up">
                                <div class="up_left">
                                    <a href="#"><img src="images/3083.jpg" class="img-responsive" height="100%" width="100%"/></a>
                                </div>
                                <div class="up_right">
                                    <div><a href="">Swati</a></div>
                                    <p>32, New Delhi<br />
                                        Within 1 week</p>
                                </div>
                            </div>
                            <div class="card_down">
                                <a href="#">
                                    <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>    Quick View
                                </a>
                            </div>
                        </div>

                    </div>

                    <div class="row" style="padding-left:10px">

                        <div class="col-md-4 card">

                            <div class="card_up">
                                <div class="up_left">
                                    <a href="#"><img src="images/3137.jpg" class="img-responsive" height="100%" width="100%"/></a>
                                </div>
                                <div class="up_right">
                                    <div><a href="">Ritzy</a></div>
                                    <p>28, Chittoor<br />
                                        Within 1 week</p>
                                </div>
                            </div>
                            <div class="card_down">
                                <a href="#">
                                    <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>    Quick View
                                </a>
                            </div>
                        </div>

                        <div class="col-md-4 card">

                            <div class="card_up">
                                <div class="up_left">
                                    <a href="#"><img src="images/3167.jpg" class="img-responsive" height="100%" width="100%"/></a>
                                </div>
                                <div class="up_right">
                                    <div><a href="">kiara</a></div>
                                    <p>25, Chittoor<br />
                                        Within  2 weeks</p>
                                </div>
                            </div>
                            <div class="card_down">
                                <a href="#">
                                    <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>    Quick View
                                </a>
                            </div>
                        </div>

                        <div class="col-md-4 card">

                            <div class="card_up">
                                <div class="up_left">
                                    <a href="#"><img src="images/3168.jpg" class="img-responsive" height="100%" width="100%"/></a>
                                </div>
                                <div class="up_right">
                                    <div><a href="">Sudhaneedlov</a></div>
                                    <p>25, New Delhi<br />
                                        Within 2 weeks</p>
                                </div>
                            </div>
                            <div class="card_down">
                                <a href="#">
                                    <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>    Quick View
                                </a>
                            </div>
                        </div>

                    </div>



                    <div class="row" style="padding-left:10px">

                        <div class="col-md-4 card">

                            <div class="card_up">
                                <div class="up_left">
                                    <a href="#"><img src="images/3173.jpg" class="img-responsive" height="100%" width="100%"/></a>
                                </div>
                                <div class="up_right">
                                    <div><a href="">shrutikashyap</a></div>
                                    <p>26, New Delhi<br />
                                        Within 3 weeks</p>
                                </div>
                            </div>
                            <div class="card_down">
                                <a href="#">
                                    <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>    Quick View
                                </a>
                            </div>
                        </div>

                        <div class="col-md-4 card">

                            <div class="card_up">
                                <div class="up_left">
                                    <a href="#"><img src="images/3757.jpg" class="img-responsive" height="100%" width="100%"/></a>
                                </div>
                                <div class="up_right">
                                    <div><a href="">ocscm197</a></div>
                                    <p>34, Mumbai<br />
                                        Within  2 weeks</p>
                                </div>
                            </div>
                            <div class="card_down">
                                <a href="#">
                                    <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>    Quick View
                                </a>
                            </div>
                        </div>

                        <div class="col-md-4 card">

                            <div class="card_up">
                                <div class="up_left">
                                    <a href="#"><img src="images/3826.jpg" class="img-responsive" height="100%" width="100%"/></a>
                                </div>
                                <div class="up_right">
                                    <div><a href="">ThePacifier</a></div>
                                    <p>30, New Delhi<br />
                                        Within 2 weeks</p>
                                </div>
                            </div>
                            <div class="card_down">
                                <a href="#">
                                    <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>    Quick View
                                </a>
                            </div>
                        </div>

                    </div>


                    <div class="row" style="padding-left:10px">

                        <div class="col-md-4 card">

                            <div class="card_up">
                                <div class="up_left">
                                    <a href="#"><img src="images/4001.jpg" class="img-responsive" height="100%" width="100%"/></a>
                                </div>
                                <div class="up_right">
                                    <div><a href="">janu</a></div>
                                    <p>28, Chittoor<br />
                                        Within 3 days</p>
                                </div>
                            </div>
                            <div class="card_down">
                                <a href="#">
                                    <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>    Quick View
                                </a>
                            </div>
                        </div>

                        <div class="col-md-4 card">

                            <div class="card_up">
                                <div class="up_left">
                                    <a href="#"><img src="images/4108.jpg" class="img-responsive" height="100%" width="100%"/></a>
                                </div>
                                <div class="up_right">
                                    <div><a href="">Pooja</a></div>
                                    <p>27, Hyderabad<br />
                                        Within 3 weeks</p>
                                </div>
                            </div>
                            <div class="card_down">
                                <a href="#">
                                    <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>    Quick View
                                </a>
                            </div>
                        </div>

                        <div class="col-md-4 card">

                            <div class="card_up">
                                <div class="up_left">
                                    <a href="#"><img src="images/4560.jpg" class="img-responsive" height="100%" width="100%"/></a>
                                </div>
                                <div class="up_right">
                                    <div><a href="">spunkygirl</a></div>
                                    <p>35, Kolkata<br />
                                        Within 5 days</p>
                                </div>
                            </div>
                            <div class="card_down">
                                <a href="#">
                                    <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>    Quick View
                                </a>
                            </div>
                        </div>

                    </div>



                    <div class="row" style="padding-left:10px">

                        <div class="col-md-4 card">

                            <div class="card_up">
                                <div class="up_left">
                                    <a href="#"><img src="images/4567.jpg" class="img-responsive" height="100%" width="100%"/></a>
                                </div>
                                <div class="up_right">
                                    <div><a href="">Santoshri</a></div>
                                    <p>29, Mumbai<br />
                                        Within 2 weeks</p>
                                </div>
                            </div>
                            <div class="card_down">
                                <a href="#">
                                    <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>    Quick View
                                </a>
                            </div>
                        </div>

                        <div class="col-md-4 card">

                            <div class="card_up">
                                <div class="up_left">
                                    <a href="#"><img src="images/251520983Z.jpeg" class="img-responsive" height="100%" width="100%"/></a>
                                </div>
                                <div class="up_right">
                                    <div><a href="">SaifaS</a></div>
                                    <p>30, Mumbai<br />
                                        Within 3 days</p>
                                </div>
                            </div>
                            <div class="card_down">
                                <a href="#">
                                    <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>    Quick View
                                </a>
                            </div>
                        </div>

                        <div class="col-md-4 card">

                            <div class="card_up">
                                <div class="up_left">
                                    <a href="#"><img src="images/251529580Z.jpeg" class="img-responsive" height="100%" width="100%"/></a>
                                </div>
                                <div class="up_right">
                                    <div><a href="">Hopecassidy</a></div>
                                    <p>33, Chittoor<br />
                                        Within 3 days</p>
                                </div>
                            </div>
                            <div class="card_down">
                                <a href="#">
                                    <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>    Quick View
                                </a>
                            </div>
                        </div>

                    </div>




                    <div class="row" style="padding-left:10px">

                        <div class="col-md-4 card">

                            <div class="card_up">
                                <div class="up_left">
                                    <a href="#"><img src="images/251888889Z.jpeg" class="img-responsive" height="100%" width="100%"/></a>
                                </div>
                                <div class="up_right">
                                    <div><a href="">Richa</a></div>
                                    <p>30, New Delhi<br />
                                        Within 2 weeks</p>
                                </div>
                            </div>
                            <div class="card_down">
                                <a href="#">
                                    <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>    Quick View
                                </a>
                            </div>
                        </div>

                        <div class="col-md-4 card">

                            <div class="card_up">
                                <div class="up_left">
                                    <a href="#"><img src="images/252007001Y.jpeg" class="img-responsive" height="100%" width="100%"/></a>
                                </div>
                                <div class="up_right">
                                    <div><a href="">Shambhavi</a></div>
                                    <p>29, Mumbai<br />
                                        Over 3 weeks ago</p>
                                </div>
                            </div>
                            <div class="card_down">
                                <a href="#">
                                    <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>    Quick View
                                </a>
                            </div>
                        </div>

                        <div class="col-md-4 card">

                            <div class="card_up">
                                <div class="up_left">
                                    <a href="#"><img src="images/252336269Z.jpeg" class="img-responsive" height="100%" width="100%"/></a>
                                </div>
                                <div class="up_right">
                                    <div><a href="">mizmie</a></div>
                                    <p>30, Chittoor<br />
                                        Within 5 days</p>
                                </div>
                            </div>
                            <div class="card_down">
                                <a href="#">
                                    <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>    Quick View
                                </a>
                            </div>
                        </div>

                    </div>

                </div>





                <div class="col-md-2 right_sbar" style="background:#DDD !important;padding-top:10px;margin-top:10px">
                    @include('right_sidebar')
                </div>
            </div>





        </div>





    </div>






</div>



<!-- /middle -->

@include('footer_new')