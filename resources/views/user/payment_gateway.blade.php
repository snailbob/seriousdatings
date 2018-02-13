@extends('master')


@section('form_area')

<div ng-controller="paymentController" ng-cloak>

    <div class="inner-header calendar-event-banner">
        <div class="container">

            <div class="row">
                <div class="col-md-12">
                    <h1>
                        Payment Gateway    
                    </h1>
                </div>
            </div>
        </div>
    </div>

    <div class="inner-contendbg">

        <div class="container">

            <div class="row">

                <div class="col-md-8 col-md-offset-2">

                    <p class="lead text-center">
                        <a ng-click="processPaypal()" class="thumbnail no-decoration">
                            <span class="fa-stack fa-lg">
                                <i class="fa fa-square-o fa-stack-2x"></i>
                                <i class="fa fa-paypal fa-stack-1x" aria-hidden="true"></i>
                            </span>
                            Pay via PayPal
                        </a>
                    </p>

                    <hr>
                        <div class="text-center">or</div>
                    <hr>

                    


                    <!-- CREDIT CARD FORM STARTS HERE -->
                    <div class="panel panel-default credit-card-box">
                        <div class="panel-heading" >
                            <div class="pull-right" >                            
                                <img class="img-responsive" src="{{ url() }}/public/images/icon/accepted_c22e0.png">
                            </div>
                            <h3 class="panel-h">Card Payment</h3>
              
                        </div>
                        <div class="panel-body">

                            <div id="sq-ccbox">

                                <form class="form-horizontal" id="nonce-form" role="form">
                                    <table class="table table-borderless">
                                        <thead>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td width="25%">Card Number:</td>
                                                <td width="75%">
                                                    <div id="sq-card-number"></div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>CVV:</td>
                                                <td>
                                                    <div id="sq-cvv"></div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Expiration Date: </td>
                                                <td>
                                                    <div id="sq-expiration-date"></div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Postal Code:</td>
                                                <td>
                                                    <div id="sq-postal-code"></div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="2">

                                                    <div class="row">
                                                        <div class="col-sm-9 padding-top-15">
                                                            <p class="text-muted"><img src="{{ url() }}/public/images/icon/lock-icon.png" alt="" class="pull-left" style="margin-right: 5px"/>For your security, SeriousDatings does not store your banking details. Square is our secure payment provider. <a href="https://square.com/" target="_blank">Find out more</a></p>
                                                        </div>
                                                        <div class="col-sm-3 padding-top-15">
                                                            <button type="submit" id="sq-creditcard" class="btn btn-danger btn-block button-credit-card" onclick="requestCardNonce(event)">
                                                                Pay with card
                                                            </button>
                                                        </div>
                                                    </div>

                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>

                                    <input type="hidden" id="card-nonce" name="nonce">

                                </form>

                            </div>  



                        </div>
                    </div>            
                    <!-- CREDIT CARD FORM ENDS HERE -->
                    
                    @if(isset($_GET['type']) && $_GET['type'] == 'plan')
                    <hr>
                        <div class="text-center">or</div>
                    <hr>

                    <div class="panel panel-default">
                        <div class="panel-heading" >
                            <h3 class="panel-h">E-Check Details</h3>
                        </div>
                        <div class="panel-body">
                            <form name="echeck_form" ng-submit="submitForm(echeck_form)" ng-validate="validationOptions" class="echeck_form" novalidate>
                                
                                <div class="summary">
                                    <div class="row">
                                        <div class="col-sm-12">

                                            <div class="row">
                                                <div class="col-sm-6 col-sm-offset-3 crop-col" ng-show="!imgDone.done">
                                                    <div class="row">
                                                        <div class="col-sm-12">
                                                            <div class="cropArea">
                                                                <ui-cropper image="myImage" result-image="myCroppedImage" on-load-done="imgEdit = false" result-image-quality="0.8" area-type="rectangle"></ui-cropper>
                                                            </div>
                                                            <div>
                                                                <div class="hidden">
                                                                    <input type="file" id="fileInput" accept="image/*" />
                                                                </div>
                                                                <button type="button" class="btn btn-primary btn-block" onclick="$('#fileInput').click()">
                                                                    Upload E-Check
                                                                </button>
                                                                <button type="button" class="btn btn-success btn-block" ng-if="!imgEdit" ng-click="imgDone.done = !imgDone.done">
                                                                    Done
                                                                </button>

                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-sm-6 col-sm-offset-3 text-center crop-col" ng-if="imgDone.done">
                                                    <div><img class="img-thumbnail img-responsive" ng-src="@{{myCroppedImage}}" /></div>
                                                    <div class="padding-top">
                                                        <button class="btn btn-default" ng-if="!imgEdit" ng-click="imgDone.done = !imgDone.done; imgEdit = !imgEdit">
                                                            Update
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>

                                            

                                        </div>
                                        <div class="padding">
                                            <h3>Order Summary</h3>

                                        </div>
                                    </div>


                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="">Order Date</label>
                                                <input disabled type="text" name="amount" ng-model="echeckData.date" id="" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="">Customer IP</label>
                                                <input disabled type="text" name="amount" ng-model="echeckData.ip" id="" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="">Description</label>
                                                <input disabled type="text" name="amount" ng-model="echeckData.description" id="" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="">Order Amount</label>
                                                <input disabled type="text" name="amount" ng-model="echeckData.price" id="" class="form-control">
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <img src="{{url().'/public/images/mail/check-img.png'}}" class="img-full" alt="">


                                <div class="row">
                                    <div class="padding">
                                        <h3>Checking Account Information</h3>
                                    </div>
                                </div>

                                <div class="row">

                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="">Account Holder Name</label>
                                            <input required type="text" name="name" ng-model="echeckData.name" id="" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="">Account Type</label>
                                            <select required name="account_type" ng-model="echeckData.account_type" id="" class="form-control">
                                                <option value="">--Select--</option>
                                                <option value="Checking">Checking</option>
                                                <option value="Savings">Savings</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="">Routing No.</label>
                                            <input required type="tel" name="routing_number" ng-model="echeckData.routing_number" id="" class="form-control form-control-number">
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="">Check No.</label>
                                            <input required type="tel" name="check_number" ng-model="echeckData.check_number" id="" class="form-control  form-control-number">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="">Account No.</label>
                                            <input required type="tel" name="account_no" ng-model="echeckData.account_no" id="" class="form-control form-control-number">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="">Phone No.</label>
                                            <input required type="tel" name="phone" ng-model="echeckData.phone" id="" class="form-control form-control-number">
                                        </div>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label for="">Do you have signed authorization?</label>
                                    <div class="checkbox">
                                        <label>
                                        <input type="checkbox" name="signed" ng-model="echeckData.signed" required> I have signed authorization
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="well well-sm"><strong class="text-danger">IMPORTANT: </strong> To process this transaction, you must have <strong>already received signed authorization</strong></div>
                                </div>


                                <div class="form-group text-right">
                                    <button type="submit" class="btn btn-danger" ng-disabled="submitting">
                                        Submit to Admin
                                    </button>
                                </div>
                            </form>


                        </div>
                    </div>
                    @endif

                    {{--  <hr>
                        <div class="text-center">or</div>
                    <hr>

                    <div class="panel panel-default">
                        <div class="panel-heading" >
                            <h3 class="panel-h">Bank Draft</h3>
                        </div>
                        <div class="panel-body">
                            <div class="form-group">
                                <textarea name="cheque_details" class="form-control" id="" rows="10" placeholder="Draft detail - admin will process and confirm later for membership"></textarea>
                            </div>
                            <div class="form-group text-right">
                                <button class="btn btn-danger">
                                    Submit to Admin
                                </button>
                            </div>
                        </div>
                    </div>  --}}

                </div>
            </div>

        </div>
    </div>
</div>


@endsection
