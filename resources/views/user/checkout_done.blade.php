@extends('master')


@section('form_area')

<div ng-controller="eventDetailsController" ng-cloak>

    <div class="inner-header calendar-event-banner">
        <div class="container">

            <div class="row">
                <div class="col-md-12">
                    <h1>
                        <i class="fa fa-check-circle" aria-hidden="true"></i> Payment Successful    
                    </h1>
                </div>
            </div>
        </div>
    </div>

    <div class="inner-contendbg">

        <div class="container">

            <div class="row">

                <div class="col-md-6 col-md-offset-3">
                    <div class="alert alert-success">
                        <i class="fa fa-check-circle" aria-hidden="true"></i> You have succesfully paid the plan. You can now enjoy SeriousDatings services.
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>


@endsection
