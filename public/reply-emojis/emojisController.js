

ngApp.controller('emojisReply', function($scope,$ngConfirm){


	$scope.replyEmojis = function () {

			$ngConfirm({
				title:'',
				contentUrl:base_url+'/public/reply-emojis/list-emojis.html',
                boxWidth: '450px',
    			useBootstrap: false,
                animation: 'zoom',
                backgroundDismiss: true,
                backgroundDismissAnimation: 'glow',
                theme: 'material',
                type:'purple',
                lazyOpen: true,
                 onScopeReady: function ($scoped) {
                 	var self = this;
                 
                 }
			});

	};
	
});

