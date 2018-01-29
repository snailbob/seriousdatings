
<script type="text/ng-template" id="virtualGiftModal.html">
    <div class="modal-header">
        <p>
            <strong>Send Virtual Gift to @{{user.firstName}}</strong>
        </p>

        <button type="button" class="close" ng-click="cancel()" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    </div>
    <div class="modal-body" id="modal-body">

        <div class="padding" ng-if="isLoading">
            <p class="lead text-center text-muted">
                <i class="fa fa-spinner fa-spin" aria-hidden="true"></i>
            </p>
        </div>
        
        <div class="panel panel-default" ng-repeat="cat in giftCat" ng-if="cat.cards.length">
            <div class="panel-heading">
                <h4>@{{cat.name}}</h4>
            </div>
            <div class="panel-body">
                <div class="row">

                    <div class="col-xs-6 col-sm-3 text-center" ng-repeat="card in cat.cards" ng-click="selectCard()">
                        <a>
                            <img ng-src="@{{base_url + '/public/images/gift_cards/' + card.image}}" class="img-thumbnail" alt="gift card" style="height: 80px" />
                        </a>
                        @{{card.price | currency}}
                    </div>
                </div>                

            </div>
        </div>

        <div class="form-group text-right padding-top-15">
            <button class="btn btn-danger" ng-click="submit()">
                Submit
            </button>
        </div>

    </div>
</script>

