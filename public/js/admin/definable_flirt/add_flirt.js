$(document).ready(function()
{
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});

	$(document).on('click', '#saveBtn', function()
	{
		var message = {	};

		$('form#flirt_message :input').each(function()
		{
			message[$(this).attr('id')] = $(this).val();
		});
		message['Content'] = CKEDITOR.instances['Content'].getData()
		console.log(message);

		$.ajax({
			type: "POST",
			url: base_url + '/saveFlirtMessage',
			data: message,
			cache: false,
			success: function(value)
			{	
				toastr.info(value.name + " was successfully updated!");
			},
			error: function(value)
			{
				$.each( value.responseJSON, function( key, value ) {
					toastr.error(value);
				});
			}
		});
	});

	toastr.options = {
		"closeButton": false,
		"debug": false,
		"newestOnTop": false,
		"progressBar": false,
		"positionClass": "toast-top-center",
		"preventDuplicates": false,
		"onclick": null,
		"showDuration": "300",
		"hideDuration": "1000",
		"timeOut": "10000",
		"extendedTimeOut": "1000",
		"showEasing": "swing",
		"hideEasing": "linear",
		"showMethod": "fadeIn",
		"hideMethod": "fadeOut"
	}
});