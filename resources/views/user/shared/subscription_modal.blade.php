
<script type="text/ng-template" id="SubscriptionDetails.html">
    <div class="modal-header">
        <button type="button" class="close" ng-click="cancel()" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    </div>
    <div class="modal-body" id="modal-body">
        <div class="SubscriptionDetails-datas">

            <div class="membership-banner">
                <img src="{!! url() !!}/public/images/membership-banner.png" alt="">
                <div class="bottom-position">
                <button class="btn btn-danger btn-block" id="startOVER-btn" ng-click="redirectToPlan()">
                </button>
                </div>
            </div>

            <div class="membership-content">
                <div class="membership-offer">
                    <h2>Save Over <span>65%</span> on 3 Month Only <span>$59.95!</span></h2>
                    <p>Sart Communicating with your perfect matches today. Find the right person for you</p>
                </div>
                <div class="try-it">
                        <h2>Try It Today!</h2>
                        <p>Take advantage of this special offer and enjoy all of the benefits of serious dating</p>
                    <h4><span>New!</span> Video Profile, and Who's Bookmarked you Features</h4>
                </div>       
        </div>
            <!-- 
            <h1>@{{ nameFirst }}</ -->

        </div>
    </div>
</script>

