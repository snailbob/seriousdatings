
<script type="text/ng-template" id="flirtEmojiModal.html">
    <div class="modal-header">
        <p>
            <strong>Send Flirt Emoji to @{{user.firstName}}</strong>
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
            <div uib-accordion-group class="panel-default" is-open="true">
                <uib-accordion-heading>
                    <div class="padding">
                        Emoji
                    </div>
                </uib-accordion-heading>

                <div class="row" style="height: 400px; overflow: auto;">
                    <div class="col-xs-6 col-sm-3 text-center" ng-repeat="card in cards" ng-click="selectCard(card)">
                        <div class="form-group">
                            <img ng-src="@{{base_url + '/public/images/emoji/'+ card.file_name}}" title="@{{card.file_name}}" class="img-thumbnail" alt="gift card" style="height: 90px" />
                            <br>
                            <i class="fa fa-fw" ng-class="{'fa-check-circle-o text-success' : card.selected, 'fa-circle-o text-muted' : !card.selected}" aria-hidden="true"></i>
                            Select

                        </div>
                    </div>
                </div>                


            </div>

            
        </uib-accordion>
            

        <div class="form-group text-right padding-top-15">
            <button class="btn btn-danger" ng-disabled="!selectedCount" ng-click="submit()">
                Send to @{{user.firstName}}
            </button>
        </div>

    </div>
</script>

