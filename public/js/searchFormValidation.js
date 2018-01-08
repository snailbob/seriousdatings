// Wait for the DOM to be ready
$(function() {
  // Initialize form validation on the registration form.
  // It has the name attribute "registration"
	$("form[name='searchForm']").validate({
    // Specify validation rules
    rules: {
        myGender: "required",
		gender: "required",
		age_from: "required",
		age_to: "required",
		zipcode: "required",
		range: "required",
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