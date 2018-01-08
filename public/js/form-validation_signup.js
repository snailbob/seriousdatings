  $.validator.addMethod('onecheck', function(value, ele) {
            return $("input:checked").length >= 1;
    }, 'Please Select Option');

// Wait for the DOM to be ready
$(function() {
  // Initialize form validation on the registration form.
  // It has the name attribute "registration"
	$("form[name='signupForm']").validate({
    // Specify validation rules
    rules: {
      // The key name on the left side is the name attribute
      // of an input field. Validation rules are defined
      // on the right side
	  jobAndJobSchedule: "required",
	  fatherBorn: "required",
	  motherBorn: "required",
	  username: "required",
      password_repeat: "required",
      firstName: "required",
      lastName: "required",
      phone: "required",
      email: {
        required: true,
        // Specify that email should be validated
        // by the built-in "email" rule
        email: true
      },
      password: {
        required: true,
      },
	  'yourSocialSituation[]': {
         onecheck: true
	  },
	 'photoType': {
		onecheck: true
	},
	
			relationshipGoal: "required",
			haveChildren: "required",
			doYouOwnACar: "required",
			areYouOnAnyMedication: "required",
			howAmbitiousAreYou: "required",
			whatIsTheLongestRelationshipYouHaveBeenIn: "required",
			yourBirthFatherAndMotherAre: "required",
			partnerDependability: "required",
			sexualCompatibility: "required",
			friendshipBetweenPartners: "required",
			drugs: "required",
			hairColor: "required",
			hairStyle: "required",
			eyeColor: "required",
			height: "required",
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
			occupation: "required",
			income: "required",
			gender: "required",
			tatoos: "required",
			wantKids: "required",
			relationshipStatus: "required",
			birthDay: "required",
			birthMonth: "required",
			birthYear: "required",
			userProfilePicture: {
			  required: true
			},
			
	},
    // Specify validation error messages
    messages: {
	  userProfilePicture: "Please Upload A File",
	  firstName: "Please enter your firstname",
      lastName: "Please enter your lastname",
      password: {
        required: "Please provide a password",
        minlength: "Your password must be at least 5 characters long"
      },
      email: "Please enter a valid email address"
    },
	errorPlacement: function(error, element) {
	if (element.attr("name") == "yourSocialSituation[]")
	{
		error.appendTo('#err');
	}
	else if (element.attr("name") == "photoType")
	{
		error.appendTo('#errr');
	}
	else if (element.attr("name") == "userProfilePicture")
	{
		error.appendTo('#errrr');
	}
	
	else
	{ 
		error.insertAfter(element);
	}
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