
<script type="text/ng-template" id="randomCompatibleModal.html">
    <div class="modal-header">
        <button type="button" class="close" ng-click="cancel()" aria-label="Close"><span aria-hidden="true">&times;</span></button>

        <h3 class="modal-title" id="modal-title">
            <span class="pull-right text-right">
                <button class="btn btn-default btn-sm" ng-click="getData()">
                    Next <i class="fa fa-angle-double-right" aria-hidden="true"></i>
                </button>
            </span>
            <i class="fa fa-check-circle-o" aria-hidden="true"></i> Are we compatible?
        </h3>
    </div>
    <div class="modal-body" id="modal-body">
        <div class="row" ng-if="!isLoading">
            <div class="col-sm-7">
                <div class="row">
                    <div class="col-sm-5 text-center">
                        <img ng-src="@{{items.logged_user.photo}}" alt="" class="img-thumbnail img-responsive">
                    </div>
                    <div class="col-sm-2 text-center padding-top-plus">
                        <span class="fa-stack fa-2x">
                            <i class="fa fa-circle fa-stack-2x text-danger"></i>
                            <i class="fa fa-plus fa-stack-1x fa-inverse"></i>
                        </span>
                    </div>
                    <div class="col-sm-5 text-center">
                        <img ng-src="@{{items.user.photo}}" alt="" class="img-thumbnail img-responsive">
                    </div>
                </div>
                <div class="padding-top-15">
                    <button class="btn btn-danger btn-block" ng-click="compatibleDetailsModal(items)">
                        View Compatibility Details <i class="fa fa-angle-double-right" aria-hidden="true"></i>
                    </button>
                </div>

            </div>
            <div class="col-sm-5">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <span class="label label-danger label-percent pull-right" tooltip-placement="'right'" uib-tooltip-html="'You are @{{items.user.percent}}% compatible'">
                            <i class="fa fa-heart" aria-hidden="true"></i> @{{items.user.percent}}%
                        </span>
                        @{{items.user.name}}
                    </div>
                    <div class="list-group">

                        <a ng-click="userAction()" class="list-group-item">
                            <i class="fa fa-angle-double-right pull-right" aria-hidden="true"></i>
                            View Profile
                        </a>
                        <a ng-click="userAction('flirt')" class="list-group-item">
                            <i class="fa fa-angle-double-right pull-right" aria-hidden="true"></i>
                            Flirt FREE
                        </a>
                        <a ng-click="userAction('message')" class="list-group-item">
                            <i class="fa fa-angle-double-right pull-right" aria-hidden="true"></i>
                            Send Message
                        </a>
                        <a ng-click="userAction('add')" class="list-group-item">
                            <i class="fa fa-angle-double-right pull-right" aria-hidden="true"></i>
                            <span ng-if="!items.user.is_friend">Add Friend</span>
                            <span ng-if="items.user.is_friend">Remove Friend</span>
                        </a>
                    </div>

                </div>
            </div>
        </div>
        <p class="lead text-center text-muted padding-top" ng-if="isLoading">
            <i class="fa fa-spinner fa-spin fa-3x" aria-hidden="true"></i>
        </p>
    </div>

</script>