
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
        
        <uib-accordion close-others="true">
            <div uib-accordion-group class="panel-default" ng-repeat="cat in giftCat" ng-if="cat.cards.length" is-open="cat.isCustomHeaderOpen">
                <uib-accordion-heading>
                    <div class="padding">
                        <i class="pull-right glyphicon" ng-class="{'glyphicon-chevron-down': cat.isCustomHeaderOpen, 'glyphicon-chevron-right': !cat.isCustomHeaderOpen}"></i>
                        @{{cat.name}}
                    </div>
                </uib-accordion-heading>

                <div class="row">
                    <div class="col-xs-6 col-sm-3 text-center" ng-repeat="card in cat.cards" ng-click="selectCard(card)">
                        <div class="form-group">
                            <img ng-src="@{{base_url + '/public/images/gift_cards/' + card.image}}" title="@{{card.name}}" class="img-thumbnail" alt="gift card" style="height: 90px" />
                            <br>
                            <i class="fa fa-fw" ng-class="{'fa-check-circle-o text-success' : card.selected, 'fa-circle-o text-muted' : !card.selected}" aria-hidden="true"></i>
                            @{{card.price | currency}}

                        </div>
                    </div>
                </div>                


            </div>

            
        </uib-accordion>
            

        <div class="form-group text-right padding-top-15">
            <p class="pull-left text-muted" ng-if="totalPrice">
                A total of @{{ totalPrice | currency }} to pay.
            </p>
            <button class="btn btn-danger" ng-disabled="!totalPrice" ng-click="submit()">
                Send to @{{user.firstName}}
            </button>
        </div>

    </div>
</script>

