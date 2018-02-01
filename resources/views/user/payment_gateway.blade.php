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
                        <a href="https://paypal.com" target="_blank" class="thumbnail no-decoration">
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


                            <form class="form-horizontal" role="form">
                                <fieldset>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label" for="card-holder-name">Name on Card</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="card-holder-name" id="card-holder-name" placeholder="Card Holder's Name">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label" for="card-number">Card Number</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="card-number" id="card-number" placeholder="Card Number">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label" for="expiry-month">Expiration Date</label>
                                        <div class="col-sm-9">
                                            <div class="row">
                                                <div class="col-xs-6 col-sm-4">
                                                    <select class="form-control col-sm-2" name="expiry-month" id="expiry-month">
                                                        <option>Month</option>
                                                        <option value="01">Jan (01)</option>
                                                        <option value="02">Feb (02)</option>
                                                        <option value="03">Mar (03)</option>
                                                        <option value="04">Apr (04)</option>
                                                        <option value="05">May (05)</option>
                                                        <option value="06">June (06)</option>
                                                        <option value="07">July (07)</option>
                                                        <option value="08">Aug (08)</option>
                                                        <option value="09">Sep (09)</option>
                                                        <option value="10">Oct (10)</option>
                                                        <option value="11">Nov (11)</option>
                                                        <option value="12">Dec (12)</option>
                                                    </select>
                                                </div>
                                                <div class="col-xs-6 col-sm-4">
                                                    <select class="form-control" name="expiry-year">
                                                        <option value="18">2018</option>
                                                        <option value="19">2019</option>
                                                        <option value="20">2020</option>
                                                        <option value="21">2021</option>
                                                        <option value="22">2022</option>
                                                        <option value="23">2023</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-3 control-label" for="cvv">Card CVV</label>
                                        <div class="col-sm-3">
                                            <input type="text" class="form-control" name="cvv" id="cvv" placeholder="Security Code">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-offset-3 col-sm-3">
                                            <button type="button" class="btn btn-block btn-success">Add</button>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-sm-offset-3 col-sm-9">
                                            <p class="text-muted"><img src="{{ url() }}/public/images/icon/lock-icon.png" alt="" class="pull-left" style="margin-right: 5px"/>For your security, SeriousDatings does not store your banking details. Square is our secure payment provider. <a href="https://square.com/" target="_blank">Find out more</a></p>
                                        </div>
                                    </div>



                                </fieldset>
                            </form>



                        </div>
                    </div>            
                    <!-- CREDIT CARD FORM ENDS HERE -->
                    
                    
                    <hr>
                        <div class="text-center">or</div>
                    <hr>

                    <div class="panel panel-default">
                        <div class="panel-heading" >
                            <h3 class="panel-h">E-Check Details</h3>
                        </div>
                        <div class="panel-body">
                            <form name="echeck_form" ng-submit="submitForm(echeck_form)" ng-validate="validationOptions" class="echeck_form" novalidate>

                                <div class="row">
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="">Amount</label>
                                            <input required type="text" name="amount" ng-model="echeckData.amount" id="" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="">Account Type</label>
                                            <select required name="account_type" ng-model="echeckData.account_type" id="" class="form-control">
                                                <option value="">--Select--</option>
                                                <option value="Checking">Checking</option>
                                                <option value="Savings">Savings</option>
                                            </select>
                                            {{--  <input required type="text" name="amount" ng-model="echeckData.amount" id="" class="form-control">  --}}
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="">Routing No.</label>
                                            <input required type="text" name="routing" ng-model="echeckData.routing" id="" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="">Bank</label>
                                            <input required type="text" name="bank" ng-model="echeckData.bank" id="" class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="">Account No.</label>
                                            <input required type="text" name="account_no" ng-model="echeckData.account_no" id="" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="">Confirm Account No.</label>
                                            <input required type="text" name="confirm_ccount" ng-model="echeckData.confirm_ccount" id="" class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="">First Name</label>
                                            <input required type="text" name="first_name" ng-model="echeckData.first_name" id="" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="">Last Name</label>
                                            <input required type="text" name="last_name" ng-model="echeckData.last_name" id="" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="">Phone</label>
                                            <input required type="number" name="phone" ng-model="echeckData.phone" id="" class="form-control">

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

                    <hr>
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
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>


@endsection
