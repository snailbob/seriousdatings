$(document).ready(function()
{
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});


	$(document).on('click', '#addBtn', function(e)
	{

		console.log('adawd');
		// bootbox.confirm("<form>\
		// 	Category name:<input type='text' class='form-control' name='category_name' />\
		// 	</form>", function(result) {
		// 		if(result)
		// 			$('#infos').submit();
		// 	});
		bootbox.confirm({
			message: "<form>\
			Category name:<input type='text' class='form-control' id='category_name' />\
			</form>",
			buttons: {
				confirm: {
					label: 'Add',
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
					$.ajax({
						type: 'POST',
						url: base_url + '/addBlogCategory',
						data: { name: $('#category_name').val() },
						cache: false,
						success: function(value)
						{
							console.log(value);
							toastr.info(value.name + "was successfully created.");
							var row = "<tr>";
							row += "<td class=''>"+ value.name +"</td>";
							row += "<td id='"+ value.id +"'>";
							row += "<div class='btn-group pull-right table-action custom'> <a class='btn btn-danger btn-sm dropdown-toggle' data-toggle='dropdown'> <i class='fa fa-pencil'></i> Action <span class='caret'></span> </a>";
							row += "<ul class='dropdown-menu'>";
							row += "<li class='viewBtn'>";
							row += "<a href='#'> <i class='fa fa-eye'></i> View</a>";
							row += "</li>";
							row += "<li class='editBtn'>";
							row += "<a href='#'> <i class='fa fa-edit'></i> Edit</a>";
							row += "</li>";
							row += "<li class='deleteBtn'>";
							row += "<a href='#'><i class='fa fa-trash-o'></i> Delete</a>";
							row += "</li>";
							row += "</ul>";
							row += "</div>";
							row += "</td>";
							row += "</tr>"							;
							$('#category_tbl > tbody:last').append(row); 
						},
						error: function(value)
						{
							$.each( value.responseJSON, function( key, value ) {
								toastr.error(value);
							});
						}
					});
				}
			}
		});
	});


	// $(document).on('click', '#saveBtn', function()
	// {
	// 	var message = {	};

	// 	$('form#flirt_message :input').each(function()
	// 	{
	// 		message[$(this).attr('id')] = $(this).val();
	// 	});
	// 	message['Content'] = CKEDITOR.instances['Content'].getData()
	// 	console.log(message);

	// 	$.ajax({
	// 		type: "POST",
	// 		url: base_url + '/saveFlirtMessage',
	// 		data: message,
	// 		cache: false,
	// 		success: function(value)
	// 		{	
	// 			toastr.info(value.name + " was successfully updated!");
	// 		},
	// 		error: function(value)
	// 		{
	// 			$.each( value.responseJSON, function( key, value ) {
	// 				toastr.error(value);
	// 			});
	// 		}
	// 	});
	// });

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