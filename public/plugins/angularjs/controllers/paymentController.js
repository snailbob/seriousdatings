ngApp.controller('paymentController', ['$scope', '$filter', 'myHttpService', '$timeout', '$ngConfirm', '$httpParamSerializer', function ($scope, $filter, myHttpService, $timeout, $ngConfirm, $httpParamSerializer) {

    $scope.myImage = '';
    $scope.myCroppedImage = '';
    $scope.imgEdit = true;
    $scope.imgDone = {
        done: false
    };

    $scope.echeckData = {
        ip: window.for_zip,
        price: window.uri_get_params.price,
        description: window.uri_get_params.type,
        date: $filter('date')(new Date(), "dd/MM/yyyy")
    };

    $scope.params = window.uri_get_params;
    $scope.base_url = window.base_url;

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


    $scope.validationOptions = {
        ignore: [],
        rules: {},
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

    $scope.submitForm = function (formData) {
        console.log($scope.echeckData, 'echeckData');

        if (formData.validate()) {
            $scope.echeckData.image = $scope.myCroppedImage;
            console.log($scope.echeckData, 'sdfsdfdsf');
            if ($scope.imgEdit) {
                $scope.showToast('Please upload your e-check image.', 'danger');
                return false;
            }

            $scope.echeckData.submitting = true;
            $scope.echeckData.id = $scope.params.id;
            $scope.echeckData.price = $scope.params.price;
            $scope.echeckData.type = $scope.params.type;


            myHttpService.post('save_echeck', $scope.echeckData)
                .then(function (res) {
                    console.log(res);
                    $scope.echeckData.submitting = false;
                    $scope.showToast('Your e-check successfully submitted.');
                    // $timeout(function () {
                    //     window.location.href = base_url + '/profile';
                    // }, 1500);
                }, function (err) {
                    console.log(err);
                    $scope.showToast('Something went wrong. Please try again.', 'danger');
                    $scope.echeckData.submitting = false;
                });
        }
        else {
            $scope.showToast('Opps! Please check your input.', 'danger');
        }
    }

    $scope.processPaypal = function(){
        if($scope.params.type == 'plan'){
            window.location.href = $scope.base_url+'/payment_checkout/'+$scope.params.id;
        }
        if($scope.params.type == 'ads'){
            window.location.href = $scope.base_url+'/payment_checkout/?'+$para.id;
        }
    }
    
}]);
