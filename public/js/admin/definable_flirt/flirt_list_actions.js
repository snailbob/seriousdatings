$(document).ready(function()
{
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});

	/* VIEW ACTION */ 
	$(document).on('click', '.viewBtn', function()
	{	
		var data = {
			name : $(this).closest('tr').children('td:eq(0)').text(),
			content : $(this).closest('tr').children('td.hidden').text()
		};

		bootbox.dialog({
			message: data.content,
			title: data.name,
			size: 'large'
		});
	});
	/* END VIEW ACTION */ 

	/* EDIT ACTION */ 
	$(document).on('click', '.editBtn', function()
	{
		$('#ckeditorModal').modal('show');
		var	data = { id: $(this).closest('tr').children('td:last-child').attr('id') };
		console.log(data);
		$.ajax({
			type: "POST",
			url: base_url + "/flirtMessage",
			data: data,
			cache: false,
			success: function(value)
			{
				console.log(value);
				$('#id').val(value.id);
				$('#Name').val(value.name);
				CKEDITOR.instances['Content'].setData(value.content);
			},
			error: function(data,a,b)
			{
				console.log(data,a,b);
			}
		});
	});

	$(document).on('click', '#saveBtn', function()
	{
		var message = {};
		$('form#flirt_message :input').each(function()
		{
			message[$(this).attr('id')] = $(this).val();
		});
		message['Content'] = CKEDITOR.instances['Content'].getData();
		console.log(message);
		$.ajax({
			type: "POST",
			url: base_url + '/updateFlirtMessage',
			data: message,
			cache: false,
			success: function(value)
			{	
				console.log(value);
				$( 'td#' + value.id ).siblings('td:eq(0)').text(value.name);
				$( 'td#' + value.id ).siblings('td:eq(2)').text(value.content);
				$( 'td#' + value.id ).siblings('td:eq(1)').html(value.ellipse);
				toastr.info(value.name + " was successfully updated!");
				$('#ckeditorModal').modal('hide');
			},
			error: function(value)
			{
				$.each( value.responseJSON, function( key, value ) {
					toastr.error(value);
				});
			}
		});
	});

	/* END EDIT ACTION */

	/* DELETE ACTION */
	$(document).on('click', '.deleteBtn', function()
	{
		var	data = { 
			id: $(this).closest('tr').children('td:last-child').attr('id'),
			name: $(this).closest('tr').children('td:first').text()
		};

		bootbox.confirm({
			title: "DELETE MESSAGE",
			message: "Are you sure to delete template " + data.name.toUpperCase() + "?",
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
						url: base_url + '/deleteFlirtMessage',
						data: data,
						cache: false,
						success: function(value)
						{	
							console.log(value);
							$('td#' + value.id).parent().remove();
							// $('ul#' + value.id + ' a.' + value.anchorClass).remove();
							// $('ul#' + value.id + ' li.' + value.listClass).append('<a href=\'#\' class="'+ value.anchorClass +'"><i class="fa '+ value.icon +'"></i> ' + value.text + '</a>');
							toastr.info(value.name + " is successfully deleted");
						},
						error: function(data,a,b)
						{
							console.log(data,a,b);
						}
					});
				}
			}
		});	
	});
	/* END DELETE ACTION */ 

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

