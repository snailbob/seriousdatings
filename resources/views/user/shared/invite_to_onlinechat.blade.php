
<script type="text/ng-template" id="inviteToChatModal.html">
    <div class="modal-header">
        <p>
            <strong>Invite to Chat</strong>

        </p>
        

        <button type="button" class="close" ng-click="cancel()" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    </div>
    <div class="modal-body" id="modal-body">
        <div class="alert alert-info">
            <i class="fa fa-info-circle" aria-hidden="true"></i> You can add upto 3 more online people to chat.
        </div>
        <div class="group-chat-contacts gclist-modal">
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

        </div>

        <div class="form-group text-right padding-top-15">
            <button class="btn btn-danger" ng-click="submit()">
                Submit
            </button>
        </div>

    </div>
</script>

