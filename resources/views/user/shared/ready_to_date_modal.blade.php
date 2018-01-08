

<script type="text/ng-template" id="readyToDateModal.html">
    <div class="modal-header">
        <button type="button" class="close" ng-click="cancel()" aria-label="Close"><span aria-hidden="true">&times;</span></button>

        <h3 class="modal-title" id="modal-title">
            <i class="fa fa-user" aria-hidden="true"></i> Are you ready to date?
        </h3>

    </div>
    <div class="modal-body" id="modal-body">
        <div class="row" ng-if="!isLoading">

            <div class="col-sm-12 padding-bottom">

                <p class="text-center">
                    <img src="{{url()}}/public/images/modal/blue-heart.png" height="70" alt="">
                </p>

                <div class="question text-center" ng-if="!showAnswer">
                    <h2 class="text-primary">
                        @{{ currentQuestion.question }}
                    </h2>
                    <hr class="width-40">
                    <h3 class="text-danger">
                        @{{ currentQuestion.continuetext }}
                    </h3>

                    <div class="padding-top">
                        <ul class="list-inline nav-justified" ng-if="currentQuestion.type == 'level'">
                            <li class="text-center" ng-repeat="i in getNumber(choiceLength) track by $index">
                                <p class="lead">
                                    <span class="fa-stack fa-lg text-shade-@{{$index + 1}}" ng-class="{'shade-selected' : currentQuestion.answer == $index }" ng-click="selectAsnwer($index)">
                                        <i class="fa fa-circle fa-stack-2x"></i>
                                        <i ng-if="currentQuestion.answer == $index" class="fa fa-check fa-stack-1x fa-inverse"></i>
                                    </span>
                                </p>
                                <span ng-if="$index == 0">@{{ currentQuestion.lowest_text }}</span>
                                <span ng-if="$index == 3">@{{ currentQuestion.middle_text }}</span>
                                <span ng-if="$index == 6">@{{ currentQuestion.highest_text }}</span>
                            </li>
                        </ul>

                        <div class="row">
                            <div class="col-md-8 col-md-offset-2">
                                <div class="list-group" ng-if="currentQuestion.type == 'radio'">
                                    <a class="list-group-item text-left" ng-class="{'active' : currentQuestion.answer == $index }" ng-click="selectAsnwer($index)" ng-repeat="i in currentQuestion.choices track by $index" >
                                        <span class="fa-stack fa-sm">
                                            <i class="fa fa-circle-thin fa-stack-2x"></i>
                                            <i ng-if="currentQuestion.answer == $index" class="fa fa-check fa-stack-1x fa-inverse"></i>
                                        </span>
                                        @{{i}}
                                    </a>
                                </div>
                            
                            </div>
                        </div>


                    </div>
                </div>

                <div class="question text-center" ng-if="showAnswer">
                    <h2>
                        <strong>You are <span class="text-primary">@{{myScore()}}%</span> ready to date.</strong>
                    </h2>
                </div>

            </div>
        </div>
        <p class="lead text-center text-muted padding-top" ng-if="isLoading">
            <i class="fa fa-spinner fa-spin fa-3x" aria-hidden="true"></i>
        </p>
    </div>

    <div class="modal-footer" ng-if="!isLoading">
        <p class="pull-left">
            <span class="text-muted">
                <i class="fa fa-info-circle text-primary" tooltip-append-to-body="true" aria-hidden="true" uib-tooltip="This quiz is for informational purposes and not meant to function as a diagnostic tool."></i> 
                @{{currentIndex + 1}} / @{{questions.length}}
            </span>
        </p>

        <div ng-if="!showAnswer">
            <button class="btn btn-danger" ng-click="prevQuestion()" ng-disabled="!currentIndex">
                <i class="fa fa-angle-double-left" aria-hidden="true"></i> Previous
            </button>
            <button class="btn btn-danger" ng-click="nextQuestion()">  
                Next <i class="fa fa-angle-double-right" aria-hidden="true"></i>
            </button>

        </div>

        <button class="btn btn-danger" ng-if="showAnswer" ng-click="cancel()">  
            Done
        </button>

    </div>

</script>