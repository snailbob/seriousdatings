var loginValidator = function () {
	"use strict";
    // function to initiate Validation Sample 2
    
       var runLoginValidator = function() {
		var form = $('.form-login');
		var errorHandler = $('.errorHandler', form);
		form.validate({
			rules : {
				username : {
					minlength : 2,
					required : true
				},
				password : {
					minlength : 6,
					required : true
				}
			},
			submitHandler : function(form) {
				errorHandler.hide();
				form.submit();
			},
			invalidHandler : function(event, validator) {//display error alert on form submit
				errorHandler.show();
			}
		});
	};
	var runForgotValidator = function() {
		var form2 = $('.form-forgot');
		var errorHandler2 = $('.errorHandler', form2);
		form2.validate({
			rules : {
				password : {
					minlength : 6,
					required : true
				}
			},
			submitHandler : function(form) {
				errorHandler2.hide();
				form2.submit();
			},
			invalidHandler : function(event, validator) {//display error alert on form submit
				errorHandler2.show();
			}
		});
	
        
    };
    return {
        //main function to initiate template pages
        init: function () {
          runLoginValidator();
		  runForgotValidator();
        }
    };
}();