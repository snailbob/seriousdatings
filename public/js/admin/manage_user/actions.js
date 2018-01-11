$(document).ready(function()
{

	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});

	$(document).on('click', '.blockBtn', function()
	{	
		var data = { email: $(this).closest('tr').find('.user_email_cell').text() };
		var name = $(this).closest('tr').find('.realName').text();
		var action = $.trim($(this).text().toLowerCase());
		console.log(data, name, action);
		confirmationModal(action, name, data, '/blockUser');
	});

	$(document).on('click', '.pauseBtn', function()
	{	
		var data = { email: $(this).closest('tr').find('.user_email_cell').text() };
		var name = $(this).closest('tr').find('.realName').text();
		var action = $.trim($(this).text().toLowerCase());
		console.log(data, name, action);
		confirmationModal(action, name, data, '/pauseUser' );
	});

	$(document).on('click', '.deleteBtn', function()
	{
		var data = { email: $(this).closest('tr').find('.user_email_cell').text() };
		var action = $.trim($(this).text().toLowerCase());
		console.log(data, name, action);
		confirmationModal(action, name, data, '/deleteUser' );
	});


	function confirmationModal(action, name, data, route)
	{
		bootbox.confirm({
			title: action.toUpperCase() + " USER",
			message: "Are you sure to " + action + " " + name + "?",
			buttons: {
				confirm: {
					label: 'Yes',
					className: 'btn-primary'
				},
				cancel: {
					label: 'No',
					className: 'btn-danger'
				}
			},
			callback: function (result) {
				if (result) {
					$.ajax({
						type: "POST",
						url: base_url + route,
						data: data,
						cache: false,
						success: function(value)
						{	
							console.log(value.text, value.message);
							$('ul#' + value.id + ' a.' + value.anchorClass).remove();
							$('ul#' + value.id + ' li.' + value.listClass).append('<a href=\'#\' class="'+ value.anchorClass +'"><i class="fa '+ value.icon +'"></i> ' + value.text + '</a>');
							toastr.info(value.message);
						},
						error: function(data,a,b)
						{
							console.log(data,a,b);
						}

					});
				}
			}
		});	
	}


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
		"timeOut": "5000",
		"extendedTimeOut": "1000",
		"showEasing": "swing",
		"hideEasing": "linear",
		"showMethod": "fadeIn",
		"hideMethod": "fadeOut"
	}
});