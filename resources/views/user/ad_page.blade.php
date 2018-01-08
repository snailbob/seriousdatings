@extends('master')


@section('form_area')

<div ng-controller="advertiseController" ng-cloak>

    <div class="inner-header calendar-event-banner">
        <div class="container">

            <div class="row">
                <div class="col-md-12">
                    <h1>
                        Advertise    
                    </h1>
                </div>
            </div>
        </div>
    </div>

    <div class="inner-contendbg">

        <div class="container">

            <div class="row">

                <div class="col-md-8 col-md-offset-2">

                    <div class="row">
                        <div class="col-sm-6 col-sm-offset-3 crop-col" ng-show="!imgDone.done">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="cropArea">
                                        <img-crop image="myImage" result-image="myCroppedImage" on-load-done="imgEdit = false" result-image-quality="0.8" area-type="square"></img-crop>
                                    </div>
                                    <div>
                                        <div class="hidden">
                                            <input type="file" id="fileInput" />
                                        </div>
                                        <button class="btn btn-primary btn-block" onclick="$('#fileInput').click()">
                                            Upload Banner
                                        </button>
                                        <button class="btn btn-success btn-block" ng-if="!imgEdit" ng-click="imgDone.done = !imgDone.done">
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

                    <form name="advertiseform" ng-submit="submitForm(advertiseform)" ng-validate="validationOptions" class="advertiseform" novalidate>
                        <div class="form-group">
                            <label for="">Banner Link</label>
                            <input type="url" class="form-control" name="link" ng-model="user.link" required/>
                        </div>
                        <div class="form-group">
                            <label for="">Select Days</label>
                            <select name="days" id="" class="form-control" ng-model="user.days" required>
                                <option value="">--Select--</option>
                                @foreach($pricing as $price)
                                    <option value="{{$price->id}}">{{$price->days}} days for ${{$price->price}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group text-right">
                            <button type="button" class="btn btn-default" onclick="window.history.back()">
                                Cancel
                            </button>
                            <button type="submit" class="btn btn-danger" ng-disabled="submitting">
                                Submit
                            </button>
                        </div>
                    </form>

                </div>
            </div>

        </div>
    </div>
</div>


@endsection
