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
							$('ul#' + value.id + ' a.' + value.anchorClass).remove();
							$('ul#' + value.id + ' li.' + value.listClass).append('<a href=\'#\' class="'+ value.anchorClass +'"><i class="fa '+ value.icon +'"></i> ' + value.text + '</a>');
							
							toastr.info(value.message);
							if(value.deleted_at != null){
								$('ul#' + value.id).parent().parent().parent().remove();
							}
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

	$(document).on('click', '.non_memberBtn', function()
	{
		var data = {
			email: $(this).closest('tr').find('.user_email_cell').text()
		}

		console.log(data);
		$.ajax({
			type: "POST",
			url: base_url + "/setToNonUser",
			data: data,
			cache: false,
			success: function(value)
			{
				toastr.info('You\'ve just set one member to non-user.' );
				setTimeout(
					function() 
					{
						window.location.replace(base_url+"/admin/users/non_users");
					}, 2000);
			},
			error: function(value)
			{
				console.log(value);
			}
		})
	});

	$(document).on('click', '.user_memberBtn', function()
	{
		var data = {
			email: $(this).closest('tr').find('.user_email_cell').text()
		}

		console.log(data);
		$.ajax({
			type: "POST",
			url: base_url + "/setToUser",
			data: data,
			cache: false,
			success: function(value)
			{
				toastr.info('You\'ve just set one member to user.' );
				setTimeout(
					function() 
					{
						window.location.replace(base_url+"/admin/users");
					}, 2000);
			},
			error: function(value)
			{
				console.log(value);
			}
		})
	});

	$(document).on('click', '.approveBtn', function()
	{
		var data = {
			email: $(this).closest('tr').find('.user_email_cell').text(),
			name: $(this).closest('tr').find('.realName').text()
		};	

		console.log(data);
		$.ajax({
			type: "POST",
			url: base_url + "/approveUser",
			data: data,
			cache: false,
			success: function(value)
			{
				toastr.info( data.name + ' was approved.' );
				setTimeout(
					function() 
					{
						location.reload();
					}, 2000);
			},
			error: function(value)
			{
				console.log(value);
			}
		});
	});

	$(document).on('click', '.disapproveBtn', function()
	{
		var data = {
			email: $(this).closest('tr').find('.user_email_cell').text(),
			name: $(this).closest('tr').find('.realName').text()
		};

		bootbox.confirm({
			message: 
			"<div class='form-group'>\
			<label for='comment'>Reason for disapprove user:</label>\
			<textarea class='form-control' rows='5' id='comment'></textarea>\
			</div>",
			buttons: {
				confirm: {
					label: 'Send',
					className: 'btn-primary'
				},
				cancel: {
					label: 'Cancel',
					className: 'btn-secondary'
				}
			},
			callback: function (result) {
				if (result) 
				{
					data['contents'] = $('#comment').val();
					console.log(data);
					$.ajax({
						type: "POST",
						url: base_url + "/disapproveUser",
						data: data,
						cache: false,
						success: function(value)
						{
							console.log(value)
							toastr.info( data.name + ' was disapproved.' );
							setTimeout(
								function() 
								{
									location.reload();
								}, 2000);
						},
						error: function(value)
						{
							console.log(value);
						}
					});
				}
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
		"timeOut": "5000",
		"extendedTimeOut": "1000",
		"showEasing": "swing",
		"hideEasing": "linear",
		"showMethod": "fadeIn",
		"hideMethod": "fadeOut"
	}
});