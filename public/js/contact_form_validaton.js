// Wait for the DOM to be ready
$(function() {
  // Initialize form validation on the registration form.
  // It has the name attribute "registration"
	$("form[name='contactForm']").validate({
    // Specify validation rules
    rules: {
        name: "required",
		email: {
			required: true,
			// Specify that email should be validated
			// by the built-in "email" rule
			email: true
        },
		desc: "required",
		},
    // Specify validation error messages
    messages: {
	},
	// Make sure the form is submitted to the destination defined
    // in the "action" attribute of the form when valid
    submitHandler: function(form) {
	  //$('#step1').hide();
      //$('#step2').show();
	  //return false;
	 form.submit();
    }
  });
});