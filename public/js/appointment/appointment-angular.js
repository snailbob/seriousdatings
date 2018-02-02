var ngApp = angular.module('mapDatings', ['ui.bootstrap', 'cp.ngConfirm', 'ui.calendar']).constant('CSRF_TOKEN', '{{ csrf_token() }}');




Object.toparams = function ObjecttoParams(obj) {
    var p = [];
    for (var key in obj) {
        p.push(key + '=' + encodeURIComponent(obj[key]));
    }
    return p.join('&');
};


ngApp.service('httServices', ['$http', 'CSRF_TOKEN', function ($http, CSRF_TOKEN) {

	    this.url = window.base_url;

	    this.get = function (link) {
	        return $http.get(this.url + '/api/' + link);
		}
		
		this.getWithParams = function (link, data = {}) {
			// console.log(this.url);
			return $http.get(this.url + '/api/' + link, {
				params: data
			});
		}
	

	    this.post = function (link, data) {
        $http.defaults.headers.post["Content-Type"] = "application/x-www-form-urlencoded";
        // $http.defaults.headers.post["X-CSRF-TOKEN"] = CSRF_TOKEN;

        var d = Object.toparams(data);
        console.log(this.url + '/api/' + link);
        return $http.post(this.url + '/api/' + link, d); //Object.toparams(data));
	}
	
		this.newPost = function(link,data){
			var d = Object.toparams(data);
			return $http({
				method: 'POST',
				url: this.url + '/api/' + link,
				data:d,
				headers: {
					'Content-Type': 'application/x-www-form-urlencoded'
				  }
			  });

		}
		this.pathURL = this.url + '/api/';

   
}]);

ngApp.controller('mapCtrl', function($scope,$ngConfirm,httServices,$httpParamSerializerJQLike){

	$scope.availableTime = [];

	$scope.addAppointMentNew = function(userInfos) {
				// console.log(userInfos);
				httServices.getWithParams('getTimeAvailability',{'ids':userInfos.id}).then(function (res) {
				
						$scope.viewLayoutAppoinment(res.data,userInfos);	
				});
	};


	$scope.viewLayoutAppoinment = function (dataAvialable,userData) {

			$ngConfirm({
				title:'',
				contentUrl:base_url+'/public/js/appointment/appointment-layout.html',
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
                 	var counter = 0;
                 	   $scoped.incrementingData =counter;
                       $scoped.allAvailTimelength = dataAvialable.avail.length;
                       $scoped.allAvailTime = dataAvialable;
                       $scoped.userInfo = userData;
                       $scoped.previous = function () {
                       		counter--;
                       			if (counter < 0) {
                       					counter = 0;
                       				return false;
                       			}
                       			console.log(counter);
                       		 $scoped.incrementingData = counter;
                       	
                       };
                       $scoped.next = function () {
                       		counter++;
                       		if (counter >= dataAvialable.avail.length) {
                       			counter = dataAvialable.avail.length;
                       			return false;
                       		}
                       		console.log(counter);
                       		 $scoped.incrementingData = counter;
                       };
                       $scoped.getTimes = function(times,index){
								
								$(".list-times").css("background-color","#c6c6c6");
								$(".act-"+index).css("background-color","red");
							
								$scoped.fetchTime =  times.Usertime;
							   
                       }
                       $scoped.saveData = function(){
						var formDatas = $("#appointment-form").serialize();
						console.log(formDatas);

								$.ajax({
									url: httServices.pathURL+'saveAppointmentNew',
									dataType: 'json',
									data:formDatas,
									method: 'POST',
							
								}).done(function (response) {
								
									$ngConfirm({
                                                title: 'Hi',
                                                icon: 'fa fa-smile-o',
                                                theme: 'modern',
                                                type: 'blue',
                                                content: 'Appointment successfully send to.'+userData.firstName,
                                                animation: 'scale',
                                                closeAnimation: 'scale',
                                                buttons: {
                                                   
                                                    close: function () {
                                                        self.close();
                                                    }
                                                },
                                            })

								}).fail(function () {
									alert('Something went wrong.');
								});
							
					   }

				// http://localhost/seriousdatings/online_chat?user_id=163&action_type=voice

						$scoped.callMeNow = function(user_id,action_type){
									var UrLs = '/online_chat'
										UrLs +='?user_id='+user_id;
										UrLs +='&action_type='+action_type
									var win = window.open(httServices.url+UrLs, '_blank');
									win.focus();
						}
						$scoped.blockUser = function(u){
							console.log(u);
							var fullName = u.firstName+' '+u.lastName;
					        httServices.post('speedBlock', u).then(function(res){
					            console.log(res);
					            if(res.data.trans){

					            	$ngConfirm({
                                                title: fullName,
                                                icon: 'fa fa-check-circle',
                                                theme: 'modern',
                                                type: 'red',
                                                content: res.data.message,
                                                animation: 'scale',
                                                closeAnimation: 'scale',
                                                buttons: {
                                                   
                                                    close: function () {
                                                        self.close();
                                                         $(".removable-"+u.id).slideUp(3000);
                                                         $(".markerID-"+u.id).css("display","none");
                                                          parentCOnfirm.close();
                                                    }
                                                },
                                     	   });

					              
					            }
					        });
					    }



                 }
			});

	};
	
})
$(document).ready(function () {
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': window.parent.$('meta[name="csrf-token"]').attr('content')
		}
	});

		console.log(window.parent.$('meta[name="csrf-token"]').attr('content'));
});