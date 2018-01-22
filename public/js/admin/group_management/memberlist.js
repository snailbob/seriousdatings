$(document).ready(function()
{

	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});

	$(document).on('click', '.unBlockBtn', function()
	{	
		var data = { 
			userId: $(this).closest('tr').children('td:last-child').attr('id'), 
			groupName: $('.groupName').text(), 
			action: 0
		};
		var name = $(this).closest('tr').find('.realName').text();
		var action = $.trim($(this).text().toLowerCase());
		console.log(data, name, action);
		confirmationModal(action, name, data, '/blockMemberInGroup');
	});

	$(document).on('click', '.blockBtn', function()
	{	
		var data = { 
			userId: $(this).closest('tr').children('td:last-child').attr('id'), 
			groupName: $('.groupName').text(), 
			action: 1
		};
		var name = $(this).closest('tr').find('.realName').text();
		var action = $.trim($(this).text().toLowerCase());
		console.log(data, name, action);
		confirmationModal(action, name, data, '/blockMemberInGroup');
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
							console.log(value);
							$('td#' + value.users.id).parent().remove();
							addRow(value);
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
	}
	
	function addRow(value)
	{
		if(value.attr.notif){
			toastr.info(value.users.username + " was " + value.attr.notif);
		}
		var row = "<tr>";
		row += "<td>";
		row += "<img src='"+ value.users.photo +"' class='img-circle' width='45' alt=''>";
		row += "  " + value.users.username;
		row += "</td>"
		row += "<td class='realName'>" + value.users.firstName + " " + value.users.lastName + "</td>";
		row += "<td class='user_email_cell'>" + value.users.email + "</td>";
		if(value.users.verified == 1){
			row += "<td><label class='label label-success'>Yes</label></td>";
		}else{
			row += "<td><label class='label label-danger'>No</label></td>";
		}
		row += "<td id='"+ value.users.id +"'>";
		row += "<div class='btn-group pull-right table-action custom'> <a class='btn btn-danger btn-sm dropdown-toggle' data-toggle='dropdown'> <i class='fa fa-pencil'></i> Action <span class='caret'></span> </a>";
		row += "<ul class='dropdown-menu'>";
		row += "<li class='viewBtn'>";
		row += "<a href='"+ base_url + "/admin/users/" + value.users.id + "'><i class='fa fa-eye'></i> View</a>";
		row += "</li>";
		row += "<li class='"+ value.attr.classname +"'>";
		row += "<a href='#'> <i class='fa fa-user-times'></i> "+ value.attr.text +"</a>";
		row += "</li>";
		row += "</ul>";
		row += "</div>";
		row += "</td>";
		row += "</tr>";							
		$('#'+ value.attr.table +' > tbody:last').append(row); 
	}

	toastr.options = 
	{
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