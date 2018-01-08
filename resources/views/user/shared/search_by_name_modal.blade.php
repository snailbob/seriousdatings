
<script type="text/ng-template" id="searchByNameModal.html">
    <div class="modal-header">
        <button type="button" class="close" ng-click="cancel()" aria-label="Close"><span aria-hidden="true">&times;</span></button>

        <h3 class="modal-title" id="modal-title">
            <i class="fa fa-users" aria-hidden="true"></i> People
        </h3>
        <div class="dark-bar">

            <div class="input-group">

                <ul class="list-unstyled list-inline nav-justified">
                    <li>
                        <input type="text" class="form-control" placeholder="First Name" ng-model="search.firstName" name="search.firstName">

                    </li>
                    <li>
                        <input type="text" class="form-control" placeholder="Last Name" ng-model="search.lastName" name="search.lastName">

                    </li>
                </ul>
                <span class="input-group-btn">

                    <button class="btn btn-default" type="button" ng-click="findUser()">
                        <i class="fa fa-search text-danger" aria-hidden="true"></i>
                    </button>
                </span>
            </div>
        </div>
    </div>
    <div class="modal-body" id="modal-body">
        <div class="search-result">
            <div class="search-placeholder text-muted text-center" ng-if="!haveSearched && !isLoading">
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
            </div>

            <div class="div-result" ng-if="haveSearched && foundUsers.length && !isLoading">
                <div class="list-group">


                    <a ng-href="@{{ viewProfile(user) }}" target="_blank" class="list-group-item" ng-repeat="user in foundUsers">
                        <div class="media">
                            <div class="media-left">
                                <div>
                                    <img class="media-object img-thumbnail img-circle" ng-src="@{{user.photo}}" width="60px" alt="...">
                                </div>
                            </div>
                            <div class="media-body">
                                <h4 class="media-heading">
                                    <strong>@{{user.name}}</strong>
                                </h4>

                                <p>
                                    @{{user.location}}
                                </p>
                            </div>
                        </div>
                    </a>
                </div>


            </div>

        </div>
    </div>
</script>

