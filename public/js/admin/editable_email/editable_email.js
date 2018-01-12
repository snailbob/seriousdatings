$(document).ready(function()
{
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});

	$(document).on('click', '#saveBtn', function()
	{
		var template = {};
		$('form#edit_email :input').each(function()
		{
			template[$(this).attr('id')] = $(this).val();
		});
		template['Content'] = CKEDITOR.instances['Content'].getData();
		console.log(template);

		$.ajax({
			type: "POST",
			url: base_url + '/saveTemplate',
			data: template,
			cache: false,
			success: function(value)
			{	
				toastr.info(value.template_name + " was successfully updated!");
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