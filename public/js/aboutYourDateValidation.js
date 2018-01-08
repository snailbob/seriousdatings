// Wait for the DOM to be ready
$(function() {
  // Initialize form validation on the registration form.
  // It has the name attribute "registration"
	$("form[name='aboutYourDate']").validate({
    // Specify validation rules
    rules: {
        relationshipGoal: "required",
		haveChildren: "required",
		whatIsTheLongestRelationshipYouHaveBeenIn: "required",
		partnerDependability: "required",
		sexualCompatibility: "required",
		friendshipBetweenPartners: "required",
		drugs: "required",
		hairColor: "required",
		hairStyle: "required",
		eyeColor: "required",
		  height: {
              required:true,
                      number: true,
      },
		bodyType: "required",
		zodicSign: "required",
		smoke: "required",
		drink: "required",
		excercise: "required",
		excerciseSchedule: "required",
		educationLevel: "required",
		language: "required",
		ethnicity: "required",
		religiousBeliefs: "required",
		income: "required",
		gender: "required",
		tatoos: "required",
		relationshipStatus: "required",
		wantKids: "required",
		rangeOfMiles: "required",
		age_from: "required",
		age_to: "required",
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