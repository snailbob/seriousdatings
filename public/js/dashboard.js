
var dashBoardChart = function () {

var runEasypieChart = function() {
	$(function() {
		$('.easypiechart').easyPieChart({
			easing: 'easeOutBounce',
			onStep: function(from, to, percent) {
				$(this.el).find('.percent').text(Math.round(percent));
			}
		});
		var chart = window.chart = $('.chart').data('easyPieChart');
		$('.js_update').on('click', function() {
			chart.update(Math.random()*200-100);
		});
	});
};
return {
        init: function () {
			runEasypieChart();
        }
    };
}();
