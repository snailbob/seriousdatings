
ngApp.controller('homePageController', ['$scope', '$filter', 'myHttpService', '$timeout', '$ngBootbox', '$httpParamSerializer', function ($scope, $filter, myHttpService, $timeout, $ngBootbox, $httpParamSerializer) {
    $scope.data = {};
    $scope.theCity = '';
    $scope.isLoading = true;
    $scope.formData = {
        age_from: '21',
        age_to: '30'
    };
    $scope.base_url = base_url;
    $scope.justReg = {
        start: 0,
        end: 10
    };


    $scope.htmlToPlaintext = function (text) {
        return text ? String(text).replace(/<[^>]+>/gm, '') : '';
    }

    $scope.justRegScroll = function () {

        if (!$scope.justReg.start) {
            $scope.justReg.start = 10;
            $scope.justReg.end = 20;
        }
        else {
            $scope.justReg.start = 0;
            $scope.justReg.end = 10;
        }
    }

    $scope.getData = function () {
        console.log('search yeah');

        var _getHomepage = function (d) {
            myHttpService.post('homepage', d).then(function (res) {
                $scope.data = res.data;
                $scope.isLoading = false;
                console.log(res.data, d, 'res.data homepage');
            });
        }

        var _havePostCode = function (res) {
            $scope.formData.zip = res.data.address.postcode;
            var city = (typeof (res.data.address.city) !== 'undefined') ? res.data.address.city : res.data.address.suburb;

            if(typeof(city) === 'undefined'){
                city = (typeof (res.data.address.county) !== 'undefined') ? res.data.address.county : res.data.address.state;
            }

            $scope.theCity = city;

            var data = {
                lat: res.data.lat,
                lon: res.data.lon,
                zip: res.data.address.postcode,
                country: res.data.address.country,
                city: city
            };

            console.log(res, res.data.address, res.data.address.city, data, '_havePostCode');

            _getHomepage(data);
        }

        _getHomepage({});

        
        window.navigator.geolocation.getCurrentPosition(function (pos) {
            console.log(pos);

            var coords = pos.coords;
            var lat = coords.latitude;
            var lng = coords.longitude;

            myHttpService.getCustom('https://nominatim.openstreetmap.org/reverse?format=json&lat=' + lat + '&lon=' + lng + '&addressdetails=1').then(function (res) {
                _havePostCode(res);
            });

        });

    }
    var init = function () {
        $scope.getData();
    }
    init();

    $scope.validationOptions = {
        ignore: [],
        rules: {},
        messages: {},
        rules: {
        },
        messages: {
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


    $scope.submitForm = function (form) {
        console.log(form.validate(), $scope.formData);
        if (form.validate()) {
            if ($scope.formData.age_from > $scope.formData.age_to) {
                $scope.showToast('Age from should be lesser tha age to field.', 'danger');
            }
            else {
                var qs = $httpParamSerializer($scope.formData);
                console.log(qs);
                window.location.href = base_url + '/search?' + qs;
                // myHttpService.post('homepage_search_people', $scope.formData).then(function(res){
                //     console.log(res,'homepage_search_people');
                // });
            }
        }
        else {
            // $scope.showToast('Please fill all the fields.', 'danger');
        }
    }


}]);