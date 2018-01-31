@extends('master')


@section('form_area')

<div ng-controller="advertiseController" ng-cloak>

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
                                                <div class="col-xs-4">
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
                                                <div class="col-xs-4">
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
                            <h3 class="panel-h">Cheque Details</h3>
                        </div>
                        <div class="panel-body">
                            <div class="form-group">
                                <textarea name="cheque_details" class="form-control" id="" rows="10" placeholder="cheque detail for manual payment process"></textarea>
                            </div>
                            <div class="form-group text-right">
                                <button class="btn btn-danger">
                                    Submit to Admin
                                </button>
                            </div>
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
