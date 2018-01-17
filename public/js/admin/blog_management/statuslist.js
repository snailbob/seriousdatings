$(document).ready(function()
{
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});


	$(document).on('click', '#addBtn', function(e)
	{
		bootbox.confirm({
			message: "<form>\
			Status name:<input type='text' class='form-control' id='status_name' />\
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
						url: base_url + '/addBlogStatus',
						data: { name: $('#status_name').val() },
						cache: false,
						success: function(value)
						{
							toastr.info(value.name + " was successfully created.");
							var row = "<tr>";
							row += "<td class=''>"+ value.name +"</td>";
							row += "<td id='"+ value.id +"'>";
							row += "<div class='btn-group pull-right table-action custom'> <a class='btn btn-danger btn-sm dropdown-toggle' data-toggle='dropdown'> <i class='fa fa-pencil'></i> Action <span class='caret'></span> </a>";
							row += "<ul class='dropdown-menu'>";
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
							$('#status_tbl > tbody:last').append(row); 
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

	$(document).on('click', '.editBtn', function()
	{
		var	data = { 
			id: $(this).closest('tr').children('td:last-child').attr('id'), 
			name: $(this).closest('tr').children('td:first-child').text()
		};
		
		bootbox.confirm({
			title: "Edit status",
			message: "<form>\
			Status name:<input type='text' class='form-control' id='status_name' value='"+ data.name +"' />\
			</form>",
			buttons: {
				confirm: {
					label: 'Save',
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
						url: base_url + '/editBlogStatus',
						data: { name: $('#status_name').val(), id: data.id },
						cache: false,
						success: function(value)
						{
							$('td#'+value.id).prev().text(value.name);							
							toastr.info(value.name + " was successfully updated.");					
							
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


	$(document).on('click', '.deleteBtn', function()
	{
		var data = { 
			id: $(this).closest('tr').children('td:last-child').attr('id'),
			name: $(this).closest('tr').children('td:first').text() 
		};
		
		bootbox.confirm({
			title: "DELETE MESSAGE",
			message: "Are you sure to delete status " + data.name.toUpperCase() + "?",
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
						url: base_url + '/deleteStatus',
						data: data,
						cache: false,
						success: function(value)
						{	
							$('td#' + value.id).parent().remove();
							toastr.info(value.name + " is successfully deleted");
						},
						error: function(data,a,b)
						{
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