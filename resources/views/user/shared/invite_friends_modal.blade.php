
<script type="text/ng-template" id="inviteFriendsModal.html">
    <div class="modal-header">
        <button type="button" class="close" ng-click="cancel()" aria-label="Close"><span aria-hidden="true">&times;</span></button>

        <h3 class="modal-title" id="modal-title">
            <i class="fa fa-check-circle-o" aria-hidden="true"></i> Invite your friends to SeriousDatings
        </h3>
        <div class="dark-bar">

            <div class="input-group">


                <span class="input-group-btn">

                    <div class="btn-group" uib-dropdown is-open="status.isopen">
                        <button id="single-button" type="button" class="btn btn-danger btn-block" uib-dropdown-toggle>
                            @{{activeSocial.name}}
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu" uib-dropdown-menu role="menu" aria-labelledby="single-button">
                            <li role="menuitem" ng-repeat="social in socialTypes">
                                <a ng-click="selectSocial($index)">@{{social.name}}</a>
                            </li>

                        </ul>
                    </div>
                </span>
                <input type="text" class="form-control" placeholder="" ng-model="search.lastName" name="search.lastName">


            </div>
        </div>
    </div>
    <div class="modal-body" id="modal-body">
        <div class="search-result">
            {{--  <div class="search-placeholder text-muted text-center" ng-if="!haveSearched && !isLoading">
                <i class="fa fa-users fa-3x" aria-hidden="true"></i> <br>
                Search people by name
            </div>
            <div class="search-placeholder text-muted text-center" ng-if="haveSearched && !isLoading && !foundUsers.length">
                <i class="fa fa-users fa-3x" aria-hidden="true"></i> <br>
                No user found.
            </div>
            <div class="search-placeholder text-muted text-center" ng-if="isLoading">
                <i class="fa fa-spinner fa-spin fa-3x" aria-hidden="true"></i> <br>
                Searching...
            </div>  --}}

            <div class="div-result container-fluid">

                <div class="row" ng-if="activeSocial.name == 'Facebook'">
                    <div class="search-placeholder text-center" ng-if="!fbIsLogged">
                        <i class="fa fa-facebook-square fa-3x text-fb" aria-hidden="true"></i> <br>
                        <button class="btn btn-primary btn-fb" ng-click="connectFacebook()">
                            Connect Facebook
                        </button>
                    </div>
                    
                    <div class="col-sm-12 select-all clearfix" ng-if="fbIsLogged">
                        <button class="btn-default btn" ng-click="selectAll(fbContacts)" ng-if="fbContacts.length">
                            Select All
                        </button>

                        <div class="text-center" ng-if="!fbContacts.length">
                            <p class="lead text-center">
                                You have @{{fbData.friends.summary.total_count}} friends. Invite them by clicking button below.
                            </p>
                            <span data-href="http://www.seriousdatings.com" data-layout="div_count" data-size="small" data-mobile-iframe="true">
                                <a class="btn btn-fb fb-xfbml-parse-ignore" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=http%3A%2F%2Fwww.seriousdatings.com%2F&amp;src=sdkpreparse">Invite friends</a>
                            </span>
                        </div>
                    </div>
                    <div class="col-sm-6 padding-top-15" ng-repeat="user in fbContacts">
                        <a class="btn btn-block btn-wrap" ng-class="{'btn-danger': user.selected, 'btn-default': !user.selected}" ng-click="selectUser(user)">
                            @{{ user.name }} <br>
                            <span class="text-primary">
                                <i>@{{ user.email }}</i>
                            </span>
                        </a>
                    </div>
                </div>
                <div class="row" ng-if="activeSocial.name == 'Google+'">
                    <div class="search-placeholder text-danger text-center" ng-if="!googleIsLogged">
                        <i class="fa fa-google-plus-circle fa-3x" aria-hidden="true"></i> <br>
                        <button class="btn btn-danger" ng-click="connectGoogle()">
                            Connect Google+
                        </button>
                    </div>

                    <div class="col-sm-12 select-all clearfix" ng-if="googleIsLogged && googleContacts.length">
                        <button class="btn-default btn" ng-click="selectAll(googleContacts)">
                            Select All
                        </button>
                    </div>

                    <div class="col-sm-6 padding-top-15" ng-repeat="user in googleContacts">
                        <a class="btn btn-block btn-wrap" ng-class="{'btn-danger': user.selected, 'btn-default': !user.selected}" ng-click="selectUser(user)">
                            @{{ user.name }} <br>
                            <span class="text-primary">
                                <i>@{{ user.email }}</i>
                            </span>
                        </a>
                    </div>
                </div>
            </div>

        </div>

    </div>

    <div class="modal-footer" ng-if="activeSocial.name == 'Google+'">

        <button class="btn btn-danger" ng-click="sendInvite(googleContacts)" ng-disabled="!selectedToInvite">
            Send Invite
        </button>
    </div>

</script>