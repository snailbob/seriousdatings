@extends('master')


@section('form_area')

<div ng-controller="eventDetailsController" ng-cloak>

    <div class="inner-header calendar-event-banner">
        <div class="container">

            <div class="row">
                <div class="col-md-12">
                    <h1>
                        Cancel Plan Payment    
                    </h1>
                </div>
            </div>
        </div>
    </div>

    <div class="inner-contendbg">

        <div class="container">

            <div class="row">

                <div class="col-md-6 col-md-offset-3">
                    <div class="alert alert-warning">
                        <i class="fa fa-info-circle" aria-hidden="true"></i> You have cancelled your payment. Nothing was billed from your account.
                    </div>


                </div>
            </div>

        </div>
    </div>
</div>


@endsection
