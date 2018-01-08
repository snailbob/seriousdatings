var runDashCalendar = function () {
	
	var runFullCalendar = function () {
		
		$('#calendar').fullCalendar({
			header: {
				left: 'prev, today',
				center: 'title ',
				right: 'next'
			},
			eventRender: function(event, element) {
			if(event.icon){          
			element.find(".fc-title").prepend("<i class='fa fa-"+event.icon+"'></i>");
		 }
		},
			editable: false,
			eventLimit: true, // allow "more" link when too many events
			events: [
				{
					icon : "fa fa-star",
					title: 'Lorem Ipsum is simply dummy',
					url: 'view-event.php',
					start: '2015-11-01'
				},
				{
					icon : "fa fa-star",
					title: 'Lorem Ipsum is simply dummy',
					start: '2015-11-07',
					url: 'view-event.php',
					end: '2015-11-10'
				},
				{
					icon : "fa fa-star",
					
					title: 'Lorem Ipsum is simply dummy',
					url: 'view-event.php',
					start: '2015-11-09'
				},
				{
					icon : "fa fa-star",
					
					title: 'Lorem Ipsum is simply dummy',
					url: 'view-event.php',
					start: '2015-11-16'
				},
				{
					icon : "fa fa-star",
					title: 'Lorem Ipsum is simply dummy',
					start: '2015-11-11',
					url: 'view-event.php',
					end: '2015-10-13'
				},
				{
					icon : "fa fa-star",
					title: 'Lorem Ipsum is simply dummy',
					start: '2015-11-12T10:30:00',
					url: 'view-event.php',
					end: '2015-11-12'
				},
				{
					icon : "fa fa-star",
					title: 'Lorem Ipsum is simply dummy',
					url: 'view-event.php',
					start: '2015-11-12'
				},
				{
					icon : "fa fa-star",
					title: 'Lorem Ipsum is simply dummy',
					url: 'view-event.php',
					start: '2015-11-12'
				},
				{
					icon : "fa fa-star",
					title: 'Lorem Ipsum is simply dummy',
					url: 'view-event.php',
					start: '2015-11-12'
				},
				{
					icon : "fa fa-star",
					title: 'Lorem Ipsum is simply dummy',
					url: 'view-event.php',
					start: '2015-10-12'
				},
				{
					icon : "fa fa-star",
					title: 'Lorem Ipsum is simply dummy',
					url: 'view-event.php',
					start: '2015-10-13'
				},
				{
					icon : "fa fa-star",
					title: 'Click for Google',
					url: 'view-event.php',
					start: '2015-10-28'
				}
			]
		});
	};
	return {
        init: function () {
			runFullCalendar();
        }
    };
}();