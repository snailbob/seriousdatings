<style>
	.advertiser-bar{
		background-color: #fff;
		border: 1px solid lightgrey;
		margin-bottom:10px;
	}
	.inner-contendbg{
		max-width:none;
	}
	.advertiser-social-panel{
		padding-top:7px;
	}
	.advertise-left1{
		padding-top:5px;
	}
</style>
<div class="right-aside" style="cursor: pointer;">
    <div class="advertise-here" ng-if="active_ads.length">
        <h2>Advertise here</h2>
        <div class="container-fluid">
          <div class="row no-gutter">
            <div class="col-xs-6" ng-repeat="ads in active_ads">
              <a href="@{{ads.link}}" target="_blank">
                <div class="advivertise-inner">
                  <div class="advertise-left">
                    <div class="advertise-img"><img ng-src="@{{ads.image}}" alt=""></div>
                    <div class="advertise-user-detail">
                      <h4>@{{(ads.business_name) ? ads.business_name : 'Alia Bhutt'}}</h4>
                      {{--  <span>Age: 21</span>
                      <p>Lorem Lipsum</p>  --}}
                      <ul>
                        <li><a href="@{{ads.fb_link}}" target="_blank"><img src="{!! url() !!}/public/images/facebook-icon.png"  alt=""></a></li>
                        <li><a href="@{{ads.skype_link}}" target="_blank"><img src="{!! url() !!}/public/images/skype-icon.png"  alt=""></a></li>
                        <li><a href="@{{ads.twitter_link}}" target="_blank"><img src="{!! url() !!}/public/images/twitter-icon.png" alt=""></a></li>
                      </ul>
                    </div>
                  </div>
                </div>
              </a>

            </div>

            <div class="col-xs-6" ng-if="active_ads.length % 2">
              <div class="advivertise-inner">
                <div class="advertise-left">
                  <div class="advertise-img"><img src="{!! url() !!}/public/images/browse-profile.png" alt=""></div>
                  <div class="advertise-user-detail">
                    <h4>Alia Bhutt</h4>
                    {{--  <span>Age: 21</span>
                    <p>Lorem Lipsum</p>  --}}
                    <ul>
                      <li><a href="#"><img src="{!! url() !!}/public/images/facebook-icon.png"  alt=""></a></li>
                      <li><a href="#"><img src="{!! url() !!}/public/images/skype-icon.png"  alt=""></a></li>
                      <li><a href="#"><img src="{!! url() !!}/public/images/twitter-icon.png" alt=""></a></li>
                    </ul>
                  </div>
                </div>
              </div>
            </div>

          </div>
        </div>

    </div>

    <div onclick="window.location.href = base_url+'/advertise'">
    
      <div class="advertise-here" ng-repeat="ads in adsPlaceholder">
          <h2>Advertise here</h2>
          <div class="container-fluid">
            <div class="row no-gutter">
              <div class="col-xs-6">
                <div class="advivertise-inner">
                  <div class="advertise-left">
                    <div class="advertise-img"><img src="{!! url() !!}/public/images/browse-profile.png" alt=""></div>
                    <div class="advertise-user-detail">
                      <h4>Alia Bhutt</h4>
                      {{--  <span>Age: 21</span>
                      <p>Lorem Lipsum</p>  --}}
                      <ul>
                        <li><a href="#"><img src="{!! url() !!}/public/images/facebook-icon.png"  alt=""></a></li>
                        <li><a href="#"><img src="{!! url() !!}/public/images/skype-icon.png"  alt=""></a></li>
                        <li><a href="#"><img src="{!! url() !!}/public/images/twitter-icon.png" alt=""></a></li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-xs-6">
                <div class="advivertise-inner">
                  <div class="advertise-left">
                    <div class="advertise-img"><img src="{!! url() !!}/public/images/browse-profile.png" alt=""></div>
                    <div class="advertise-user-detail">
                      <h4>Alia Bhutt</h4>
                      {{--  <span>Age: 21</span>
                      <p>Lorem Lipsum</p>  --}}
                      <ul>
                        <li><a href="#"><img src="{!! url() !!}/public/images/facebook-icon.png"  alt=""></a></li>
                        <li><a href="#"><img src="{!! url() !!}/public/images/skype-icon.png"  alt=""></a></li>
                        <li><a href="#"><img src="{!! url() !!}/public/images/twitter-icon.png" alt=""></a></li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>

            </div>
          </div>
      </div>
    
    </div>

    

    
</div>         

<!-- <div class="advertise-container active_ads">
  <div class="form-group" ng-repeat="ads in active_ads">
    <a href="@{{ads.link}}" target="_blank">
        <img style="width:100%" ng-src="@{{ads.image}}" alt="">
    </a>
  </div>
</div> -->
