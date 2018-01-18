
<script type="text/ng-template" id="inviteToChatModal.html">
    <div class="modal-header">
        <p> <strong>Invite to Chat</strong></p>

        <button type="button" class="close" ng-click="cancel()" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    </div>
    <div class="modal-body group-chat-contacts" id="modal-body">
        <div class="list-group">
            <a class="list-group-item" ng-class="{'active': user.selected}" ng-repeat="user in users" ng-click="selectUser(user, $index)" ng-if="items.activeIndex != $index">

                <div class="media">
                    <div class="media-left">
                        <img class="media-object img-circle img-thumbnail" ng-src="@{{user.photo}}" width="45" alt="image">
                    </div>
                    <div class="media-body">   

                        <h4 class="media-heading">

                            <i class="fa fa-circle fa-fw" ng-class="{'text-muted' : !user.is_online, 'text-success' : user.is_online}" aria-hidden="true"></i> @{{user.firstName}}
                        </h4>

                    </div>
                </div>

            </a>
        </div>

        <div class="form-group text-right">
            <button class="btn btn-danger" ng-click="submit()">
                Submit
            </button>
        </div>

    </div>
</script>

