
ngApp.controller('signupController', ['$scope', '$filter', 'myHttpService', '$timeout', '$ngBootbox', function ($scope, $filter, myHttpService, $timeout, $ngBootbox) {
    $scope.emailInUse = 0;
    $scope.usernameInUse = 0;
    $scope.profileType = null;
    $scope.base_url = window.base_url;

    $scope.myImage = '';
    $scope.myCroppedImage = '';
    $scope.imgEdit = true;
    $scope.imgDone = {
        done: false
    };



    var handleFileSelect = function (evt) {
        var file = evt.currentTarget.files[0];
        var reader = new FileReader();
        reader.onload = function (evt) {
            $scope.$apply(function ($scope) {
                $scope.myImage = evt.target.result;
            });
        };
        reader.readAsDataURL(file);
    };
    angular.element(document.querySelector('#fileInput')).on('change', handleFileSelect);


    var loadingModalOpt = {
        templateUrl: 'loading-modal.html',
        className: 'loading-modal',
        buttons: {}
    };


    $scope.user = {};

    $scope.getLocationByIp = function () {

        window.navigator.geolocation.getCurrentPosition(function (pos) {
            console.log(pos);

            var coords = pos.coords;
            var lat = coords.latitude;
            var lng = coords.longitude;

            myHttpService.getCustom('https://nominatim.openstreetmap.org/reverse?format=json&lat=' + lat + '&lon=' + lng + '&addressdetails=1').then(function (res) {
                // _havePostCode(res);

                var city = (typeof (res.data.address.city) !== 'undefined') ? res.data.address.city : res.data.address.suburb;

                if(typeof(city) === 'undefined'){
                    city = (typeof (res.data.address.county) !== 'undefined') ? res.data.address.county : res.data.address.state;
                }

                $scope.user.location = res.data.display_name;
                $scope.user.latitude = res.data.lat;
                $scope.user.longitude = res.data.lon;
                $scope.user.zipcode = res.data.address.postcode;
                $scope.user.city = city;
                $scope.user.country = res.data.address.country;
                $scope.user.country_shortname = res.data.address.country_code.toUpperCase();

            });

        });

        // myHttpService.get('get_signup_location').then(function (res) {
        //     $scope.user.location = res.data.location;
        //     $scope.user.latitude = res.data.latitude;
        //     $scope.user.longitude = res.data.longitude;
        //     $scope.user.zipcode = res.data.zipcode;
        //     $scope.user.city = res.data.city;
        //     $scope.user.country = res.data.country;
        //     console.log($scope.user);
        // });
    }

    $scope.getInitImage = function () {
        myHttpService.getCustom(base_url + '/public/plugins/angularjs/data/signup_img.json').then(function (res) {
            console.log(res.data, 'ress image');
            $scope.myCroppedImage = res.data.image;

        });
    }

    var init = function () {
        $scope.getLocationByIp();
        $scope.getInitImage();
    }
    init();

    $scope.checklist = [
        'I\'m new to the area',
        'I don\'t feel comfortable asking peopleout',
        'I\'m really busy with work',
        'I meet a lot of people, just not the right type',
        'I don\'t like the bar',
        'I don\'t want to settle for second best',
        'Safety concerns me',
        'I\'m tired of people playing games',
        'I\'m a single parent',
        'I\'m very selective of whom I\'ll date',
    ];
    $scope.validationOptions = {
        ignore: [],
        rules: {
            username: {
                minlength: 4
            },
            password: {
                minlength: 6
            },
            password2: {
                equalTo: "#password_orig"
            }
        },
        messages: {
            username: {
                required: "Please enter a username",
                minlength: "Your username must consist at least 4 characters"
            },
            password: {
                required: "Please provide a password",
                minlength: "Your password must be at least 6 characters long"
            },
            password_repeat: {
                required: "Please provide a password",
                equalTo: "Please enter the same password"
            },
        },
        highlight: function (element) {
            $(element).closest('.form-group').addClass('has-error');
        },
        unhighlight: function (element) {
            $(element).closest('.form-group').removeClass('has-error');
        },
        errorElement: 'span',
        errorClass: 'help-block',
        errorPlacement: function (error, element) {
            $(element).closest('.form-group').append(error);
        }
    };

    $scope.submitForm = function (registerform) {
        console.log($scope.user, '$scope.imgEdit');

        $scope.user.birthdate = $filter('date')($scope.user.birthdateObj, "yyyy-MM-dd");
        if ($scope.profileType)
            $scope.user.photoType = $scope.profileType;
        else
            $scope.user.photoType = 3;

        // console.log(registerform, $scope.user);
        if (registerform.validate() && !$scope.emailInUse && !$scope.usernameInUse) {
            $scope.user.photo = $scope.myCroppedImage;
            if ($scope.imgEdit) {
                $scope.showToast('Please upload an image.', 'danger');
                return false;
            }
            $ngBootbox.customDialog(loadingModalOpt);

            myHttpService.post('signup', $scope.user)
                .then(function (res) {
                    console.log(res);
                    $ngBootbox.hideAll();
                    if (res.data.result == 'ok') {
                        $ngBootbox.hideAll();
                        $timeout(function () {
                            $scope.showToast(res.data.message);
                        }, 300);
                        $timeout(function () {
                            window.location.href = window.base_url + '/users/' + res.data.username + '/about_your_date';
                        }, 2500);

                    }
                    else {
                        $ngBootbox.alert(res.data.message);
                    }
                }, function (err) {
                    console.log(err);
                    var box = $ngBootbox.alert('Something went wrong.');
                    $ngBootbox.hideAll();
                });
        }
        else {
            $scope.showToast('Opps! Please check your input.', 'danger');
        }
    }

    $scope.calendarMaxDate = function (max = 21) {
        var nowInMS = new Date().getTime(),
            yearInMS = 1000 * 60 * 60 * 24 * 365 * max,
            yearsBeforeNow = new Date(nowInMS - yearInMS);

        yearsBeforeNow = $filter('date')(yearsBeforeNow, "yyyy-MM-dd");
        // console.log(yearsBeforeNow, 'yearsBeforeNow');
        return yearsBeforeNow;
    }

    $scope.usernameChange = function (n) {
        console.log(n);
        $scope.usernameInUse = 0;

        if (n) {
            myHttpService.post('validate_username', {
                    username: n
                })
                .then(function (res) {
                    console.log(res);
                    $scope.usernameInUse = res.data.count;
                }, function (err) {
                    console.log(err);
                });
        }

    }

    $scope.emailChange = function (n) {
        console.log(n);
        $scope.emailInUse = 0;

        if (n) {
            myHttpService.post('validate_email', {
                    email: n
                })
                .then(function (res) {
                    console.log(res);
                    $scope.emailInUse = res.data.count;
                }, function (err) {
                    console.log(err);
                });
        }
    }

}]);
