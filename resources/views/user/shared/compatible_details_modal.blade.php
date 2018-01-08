
    <script type="text/ng-template" id="compatibleDetailsModal.html">
        <div class="modal-header">
            <button type="button" class="close" ng-click="cancel()" aria-label="Close"><span aria-hidden="true">&times;</span></button>

            <h3 class="modal-title" id="modal-title">
                <i class="fa fa-user" aria-hidden="true"></i> Compatibility Details
            </h3>
            <div class="dark-bar">

                <p> We would like to introduce you to @{{items.user.name}}</p>
            </div>


        </div>
        <div class="modal-body" id="modal-body">
            <div class="row" ng-if="!isLoading">
                <div class="col-sm-3 text-center">
                    <img ng-src="@{{items.user.photo}}" alt="" class="img-thumbnail img-responsive">
                    <div class="padding-top-15">
                        <button class="btn btn-danger btn-block" ng-click="userAction(items.user)">
                            Message Now <i class="fa fa-angle-double-right" aria-hidden="true"></i>
                        </button>
                    </div>
                </div>
                <div class="col-sm-9">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Compatible Factor
                        </div>

                        <div class="container-fluid">
                            <div class="row row-matching-details">
                                <div class="col-sm-6" ng-repeat="details in items.user.matching_details">
                                    <span class="fa-stack fa-lg pull-left">
                                        <i class="fa fa-circle fa-stack-2x text-danger"></i>
                                        <i class="fa fa-check fa-stack-1x fa-inverse"></i>
                                    </span>
                                    <span class="text">
                                        @{{ details.name }} <br>
                                        <small class="text-muted">@{{ details.value }}</small>
                                    </span>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <p class="lead text-center text-muted padding-top" ng-if="isLoading">
                <i class="fa fa-spinner fa-spin fa-3x" aria-hidden="true"></i>
            </p>
        </div>

    </script>
