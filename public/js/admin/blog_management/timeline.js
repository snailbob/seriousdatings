$(document).ready(function()
{
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});


	/* testing static collapse content */ 
	var content = $('.timeline-body #demo').text();
	var limit = 300;
	if(content.length > limit)
	{
		if(content.charAt(limit) != " ")
		{
			var split = content.indexOf(" ", limit);
			var intro = content.substring(0, split) + "...";
			$('#intro').text(intro);
			var end = content.slice(split);
		}
	}else{
		$('.timeline-footer').remove();
		$('#intro').text(content);
	}

	$('.collapse').on('shown.bs.collapse', function (e) {
		$('#intro').text("");
	});

	$('.collapse').on('hidden.bs.collapse', function (e) {
		$('#intro').text(intro);
	});

	/* End testing static collapse content */

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