$(document).ready(function()
{
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});

	$(document).on('click', '.editBtn', function()
	{
		var	data = { 
			id: $(this).closest('tr').children('td:last-child').attr('id')
		};
		$('#ckeditorModal').modal('show');
		console.log(data);

		$.ajax({
			type: "POST",
			url: base_url + "/getPost",
			data: data,
			cache: false,
			success: function(data)
			{
				console.log(data);
				$.each(data, function( index, value ) {
					$('#' + index).val(value);
				});
				$('#blogType').val(data.blog_type.name);
				$('#blogStatus').val(data.blog_status.name);
				$('#blogCategory').val(data.blog_category.name);
				CKEDITOR.instances['blogContent'].setData(data.blogContent);
			},
			error: function(value)
			{
				console.log(value);
			}
		});

	});


	$(document).on('click', '.deleteBtn', function()
	{
		var data = { 
			id: $(this).closest('tr').children('td:last-child').attr('id'),
			name: $(this).closest('tr').children('td:first').text() 
		};
		console.log(data);

		bootbox.confirm({
			title: "DELETE MESSAGE",
			message: "Are you sure to delete category " + data.name.toUpperCase() + "?",
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
						url: base_url + '/deletePost',
						data: data,
						cache: false,
						success: function(value)
						{	
							console.log(value);
							$('td#' + value.id).parent().remove();
							toastr.info(value.blogTitle + " is successfully deleted");
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