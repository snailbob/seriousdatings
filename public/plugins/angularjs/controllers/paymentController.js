ngApp.controller('paymentController', ['$scope', '$filter', 'myHttpService', '$timeout', '$ngConfirm', '$httpParamSerializer', function ($scope, $filter, myHttpService, $timeout, $ngConfirm, $httpParamSerializer) {
    $scope.echeckData = {};

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

    $scope.submitForm = function (registerform) {

        if (registerform.validate()) {
            $scope.echeckData.image = $scope.myCroppedImage;
            console.log($scope.echeckData, 'sdfsdfdsf');
            if ($scope.imgEdit) {
                $scope.showToast('Please upload an image banner.', 'danger');
                return false;
            }

            $scope.echeckData.submitting = true;


            myHttpService.post('save_advertisement', $scope.echeckData)
                .then(function (res) {
                    console.log(res);
                    $scope.echeckData.submitting = false;
                    $scope.showToast('Your advertisement successfully submitted.');
                    $timeout(function () {
                        window.location.href = base_url + '/profile';
                    }, 1500);
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


}]);
