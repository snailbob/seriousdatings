(function($,W,D)
{
    var JQUERY4U = {};

    JQUERY4U.UTIL =
    {
        setupFormValidation: function()
        {
			 $.validator.addMethod("valueNotEquals", function(value, element, arg){
				return arg != value;
				}, "Value must not equal arg.");

 
            //form validation rules
            $("#register-form").validate({
                rules: {
                     SelectName: { 
						valueNotEquals: "default" 
					 }
                },
                messages: {
					SelectName: { valueNotEquals: "Please Select Video Type!" }
                },
                submitHandler: function(form) {
                    form.submit();
                }
            });
        }
    }

    //when the dom has loaded setup form validation rules
    $(D).ready(function($) {
        JQUERY4U.UTIL.setupFormValidation();
    });

})(jQuery, window, document);