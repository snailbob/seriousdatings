(function() {

	$(document).ready(function() {

		// var options = {
		// 	ovalWidth: 200,
		// 	ovalHeight: 50,
		// 	offsetX: 50,
		// 	offsetY: 160,
		// 	angle: 0,
		// 	activeItem: 0,
		// 	duration: 350,
		// 	className: 'item'
		// }

		// var carousel = $('.carousel-profile').CircularCarousel(options);

		// /* Fires when an item is about to start it's activate animation */
		// carousel.on('itemBeforeActive', function(e, item) {
		// 	$(item).css('box-shadow', '0 0 20px blue');
		// });

		// /* Fires after an item finishes it's activate animation */
		// carousel.on('itemActive', function(e, item) {
		// 	$(item).css('box-shadow', '0 0 20px green');
		// });

		// /* Fires when an active item starts it's de-activate animation */
		// carousel.on('itemBeforeDeactivate', function(e, item) {
		// 	$(item).css('box-shadow', '0 0 20px yellow');
		// })

		// /* Fires after an active item has finished it's de-activate animation */
		// carousel.on('itemAfterDeactivate', function(e, item) {
		// 	$(item).css('box-shadow', '');
		// })

		
		// /* Previous button */
		// $('.controls .previous').click(function(e) {
		// 	carousel.cycleActive('previous');
		// 	e.preventDefault();
		// });

		// /* Next button */
		// $('.controls .next').click(function(e) {
		// 	carousel.cycleActive('next');
		// 	e.preventDefault();
		// });
		// /*added by MARK*/
		// var boolCour = true;
		// setInterval(function(){
		// 	if (boolCour) {
		// 		carousel.cycleActive('next');
		// 	}
			
		//  }, 4000);
		// /*fixed in master */
		// $( ".next-carousel" ).mouseover(function() {
		// 	boolCour = false;
		// }).mouseout(function() {
		// 	boolCour = true;
		// });

		/* Manaully click an item anywhere in the carousel */
		// $('.carousel .item').click(function(e) {
		// 	var index = $(this).index('li');
		// 	carousel.cycleActiveTo(index);
		// 	e.preventDefault();
		// });
	
	});

})();