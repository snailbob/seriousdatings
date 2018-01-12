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
			subject : $(this).closest('tr').children('td:eq(1)').text(),
			content : $(this).closest('tr').children('td.hidden').text()
		};

		bootbox.dialog({
			message: data.content,
			title: data.subject,
			size: 'large'
		});
	});
	/* END VIEW ACTION */ 

	/* EDIT ACTION */ 
	$(document).on('click', '.editBtn', function()
	{
		$('#ckeditorModal').modal('show');
		var	data = { id: $(this).closest('tr').children('td:last-child').attr('id') };

		$.ajax({
			type: "POST",
			url: base_url + "/getTemplateById",
			data: data,
			cache: false,
			success: function(value)
			{
				console.log(value);
				$('#id').val(value.id);
				$('#Name').val(value.template_name);
				$('#Subject').val(value.template_subject);
				CKEDITOR.instances['Content'].setData(value.template_content);
			},
			error: function(data,a,b)
			{
				console.log(data,a,b);
			}
		});
	});

	$(document).on('click', '#saveBtn', function()
	{
		var template = {};
		$('form#edit_email :input').each(function()
		{
			template[$(this).attr('id')] = $(this).val();
		});
		template['Content'] = CKEDITOR.instances['Content'].getData();

		$.ajax({
			type: "POST",
			url: base_url + '/updateTemplate',
			data: template,
			cache: false,
			success: function(value)
			{	
				$( 'td#' + value.id ).siblings('td:eq(0)').text(value.template_name);
				$( 'td#' + value.id ).siblings('td:eq(1)').text(value.template_subject);
				$( 'td#' + value.id ).siblings('td:eq(2)').html(value.ellipse);
				toastr.info(value.template_name + " was successfully updated!");
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
			title: "DELETE TEMPLATE",
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
						url: base_url + '/deleteTemplate',
						data: data,
						cache: false,
						success: function(value)
						{	
							console.log(value);
							$('td#' + value.id).parent().remove();
							// $('ul#' + value.id + ' a.' + value.anchorClass).remove();
							// $('ul#' + value.id + ' li.' + value.listClass).append('<a href=\'#\' class="'+ value.anchorClass +'"><i class="fa '+ value.icon +'"></i> ' + value.text + '</a>');
							// toastr.info(value.message);
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

