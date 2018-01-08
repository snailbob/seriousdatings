@extends('master')


@section('form_area')
  
<div class="inner-header dating-plan">
  <div class="container">
    <h1>
      <i class="fa fa-calendar" aria-hidden="true"></i> Dating Payment Plan
    </h1>
  </div>
</div>
<div class="inner-contendbg">

  <div class="container">

    <div class="row">

      <!--Main content-->

      {{-- @include('new_leftsidebar') --}}
      <div class="col-sm-12" ng-if="subscription_validity.mode == 'subscribed'">
        <div class="alert alert-success" ng-if="!subscription_validity.is_exired">
          You are subscribed to @{{subscription_validity.plan_details.name}}. You have @{{subscription_validity.remaining_days}} remaining days.
        </div>

        <div class="alert alert-danger" ng-if="subscription_validity.is_exired">
          Your subscription has expired. Select your plan below to continue enjoy our service.
        </div>  
      </div>  

      <div class="col-sm-12" ng-if="subscription_validity.mode == 'trial'">

        <div class="alert alert-success" ng-if="!subscription_validity.is_exired">
          You are enjoying 1 day SeriousDatings trial. Select your plan below to continue enjoy our service.
        </div> 

        <div class="alert alert-danger" ng-if="subscription_validity.is_exired">
          Your trial has expired. Select your plan below to continue enjoy our service.
        </div>  
      </div>


      <div class="col-md-12">
        <div class="padding-top-15 padding-bottom plan-banner">
          <div class="text-banner">
            <h1>WANT FULL ACCESS TO SERIOUSDATINGS?</h1>
            <p class="lead">Upgrade now and lock in your rate</p>

          </div>
          <img src="{{url()}}/public/images/dating-plan-ad-img.png" alt="" class="img-responsive">
        </div>

        <div class="middle inner-middle">


          <div class="ar_middle-content-section">


            <div>

              <div class="row">


                <div class="col-md-12">

                  <h1 style="color: #FFF; background: #E21D24; line-height: 28px; font-weight:600;font-size: 22px;width: 100%;padding:7px 10px;margin:0">Dating Payment Plan</h1>
                </div>

              </div>


              <div class="row">

                <div class="dating-plan-outer">
                  {{-- print_r($data, true) --}} @if(($data['subscribed'] == 0) || ($data['subscribe_details']->subs_end_date > $data['today_date']
                  ) ) @if($data['plans'] != null) @foreach($data['plans'] as $plan)
                  <div class="col-md-4 col-sm-6">
                    <div class="dating-plan-comman {{($plan->name == '6 Months') ? 'sixty-percent-off' : ''}}"  style="min-height: 435px;">
                      <div class="month-plan">
                        @if($plan -> type == 'Monthly')
                        <h1>{!! $plan -> noOfDay!!}</h1>
                        <h2>{!! $plan -> name!!} PLAN </h2>
                        @else
                        <h1>{!! $plan -> noOfDay!!}</h1>
                        <h2>{!! $plan -> type!!} Trial</h2>
                        @endif
                      </div>
                      <div class="dating-plan-offer-outer">
                        <div class="dating-plan-offer">
                          @if($plan -> discountPercentage == 0)
                          <h4>No comment required</h4>
                          <h1>
                            <span>${!! round($plan -> price / $plan -> noOfDay,2) !!}</span>
                            <small> / {!! $plan -> type !!}</small>
                          </h1>
                          <p>Today's charge:${!! round($plan -> price / $plan -> noOfDay,2) !!} / {!! $plan -> type !!} *</p>
                          @else
                          <h4>Save {!! $plan -> discountPercentage !!}%</h4>
                          <h1>
                            <span>${!! round($plan -> price / $plan -> noOfDay,2) !!}</span>
                            <small> / {!! $plan -> type !!}</small>
                          </h1>
                          <p>Today's charge:${!! $plan -> discountPrice !!} / {!! $plan -> type !!} *
                          </p>
                          @endif
                        </div>
                        <div class="countinue-btn-outer">
                          <a href="{!! url() !!}/payment_checkout/{!! $plan -> id !!}">Continue Plan</a>
                        </div>
                      </div>
                    </div>
                  </div>
                  @endforeach
                  <div>
                    <div class="benifit-of-member">
                      <h2>Enjoy the benefits of membership:</h2>

                      <div class="col-md-4">
                        <ul class="benefits-membership1">
                          <li>Send and receive email</li>
                          <li>See who's viewed your profile</li>
                          <li>Access to Mate 1 mobile and iPhone app</li>
                        </ul>
                      </div>

                      <div class="col-md-4">
                        <ul class="benefits-membership2">
                          <li>Enjoy live online chat </li>
                          <li>View ALL photo GAlleries </li>
                          <li>Appear higher in Search results</li>
                        </ul>
                      </div>

                      <div class="col-md-4">
                        <ul class="benefits-membership2">
                          <li>Enjoy live online chat </li>
                          <li>View ALL photo GAlleries </li>
                          <li>Appear higher in Search results</li>
                        </ul>
                      </div>

                    </div>
                  </div>
                  @else
                  <div class="col-md-12">
                    <h2> No Plan Exists </h2>
                  </div>
                  @endif @else
                  <div class="col-md-12">
                    <h2>You are already subscribed</h2>
                  </div>
                  @endif
                </div>

              </div>



            </div>

          </div>
        </div>
        <!-- /middle -->

      </div>

      <!--Main content end-->



    </div>

  </div>

</div>




@endsection
