var FormValidator = function () {
	"use strict";
    // function to initiate Validation Sample 2
    var runValidator2 = function () {
        var form2 = $('#form2');
        var errorHandler2 = $('.errorHandler', form2);
        var successHandler2 = $('.successHandler', form2);
        form2.validate({
            errorElement: "span", // contain the error msg in a small tag
            errorClass: 'help-block',
            errorPlacement: function (error, element) { // render error placement for each input type
                if (element.attr("type") == "radio" || element.attr("type") == "checkbox") { // for chosen elements, need to insert the error after the chosen container
                    error.insertAfter($(element).closest('.form-group').children('div').children().last());
                } else if (element.hasClass("ckeditor")) {
                    error.appendTo($(element).closest('.form-group'));
                } else {
                    error.insertAfter(element);
                    // for other inputs, just perform default behavior
                }
            },
			ignore: "",
            rules: {
                titlename: {
                    minlength: 4,
                    required: true
                },
				fullname: {
                    minlength: 4,
                    required: true
                },
				eventlocation: {
                    minlength: 4,
                    required: true
                },
                email2: {
                    required: true,
                    email: true
                },
				password: {
                    minlength: 6,
                    required: true,
                },
                newPassword: {
                    required: true,
                    minlength: 6,
                },
				reNewPassword: {
                    required: true,
                    minlength: 6,
                    equalTo: "#newPassword"
                },
				userPicture: {
                    required: true,
                },
                uploadpicture: {
                    required: true,
                },
				genderradio: {
                    required: true,
                },
				statusradio: {
					required: true,
				},
				verifiedradio: {
					required: true,
				},
                fromage: {
                    required: true,
					number: true,
                },
				toage: {
                    required: true,
					number: true,
                },
				 dob: {
                    required: true,
					 date: true,
                },
                services: {
                    required: true,
                    minlength: 2
                },
                creditcard: {
                    required: true,
                    creditcard: true
                },
                slidelink: {
                    required: true,
                    url: true
                },
                zipcode2: {
                    required: true,
                    number: true,
                    minlength: 5
                },
				planprice:{
					required:true,
					number:true,
					
					},
                city2: {
                    required: true
                },
				fromdate: {
                    required: true,
					 date: true,
                },
				enddate: {
                    required: true,
					 date: true,
                },
				uploadvideo: {
					required: true,
					},
				planname: {
					required: true,
					},	
               GiftPrice: {
					money: true,
				}
            },
            messages: {
                firstname: "Please specify your first name",
				titlename: "Enter minimum 4 characters of your title.",
                lastname: "Please specify your last name",
				eventlocation:"Enter event location",
				slidelink:"Enter a valid URL of your image",
				fromdate:"Enter event start date",
				enddate:"Enter event end date",
				fromage:"Enter Age ",
				toage:"Enter Age",
				password:"Enter your password",				
				newPassword:"Enter your new password",
				reNewPassword:"Re-enter your new password",
				dob:"Enter your Date of Birth",
				genderradio:"Select your Gender",
				statusradio:"Select your Status",
				verifiedradio:"Select your Verification",
				fullname:"Enter your full Name",
				userPicture:"Upload image size should be [320 x 320]",
				uploadpicture:"Upload image size should be [686 x 547]",
				GiftPrice:"Enter your gift price",
				uploadvideo:"Please upload video",
				planname:"Enter Plan Name",
				planprice:"Enter Plan Price",
				
				
				email2: {
                    required: "We need your email address to contact you",
                    email: "Your email address must be in the format of name@domain.com"
                },
                email: {
                    required: "We need your email address to contact you",
                    email: "Your email address must be in the format of name@domain.com"
                },
                services: {
                    minlength: jQuery.format("Please select  at least {0} types of Service")
                }
            },
            invalidHandler: function (event, validator) { //display error alert on form submit
                successHandler2.hide();
                errorHandler2.show();
            },
            highlight: function (element) {
                $(element).closest('.help-block').removeClass('valid');
                // display OK icon
                $(element).closest('.form-group').removeClass('has-success').addClass('has-error').find('.symbol').removeClass('ok').addClass('required');
                // add the Bootstrap error class to the control group
            },
            unhighlight: function (element) { // revert the change done by hightlight
                $(element).closest('.form-group').removeClass('has-error');
                // set error class to the control group
            },
            success: function (label, element) {
                label.addClass('help-block valid');
                // mark the current input as valid and display OK icon
                $(element).closest('.form-group').removeClass('has-error').addClass('has-success').find('.symbol').removeClass('required').addClass('ok');
            },
            submitHandler: function (form) {
                successHandler2.show();
                errorHandler2.hide();
                
                $('#form2').submit();
            }
        });
		
       
        
    };
    return {
        //main function to initiate template pages
        init: function () {
            runValidator2();
        }
    };
}();