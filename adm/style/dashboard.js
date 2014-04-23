$(function() {
    $('.inlinebar').sparkline('html', {
        type: 'bar',
        barColor: 'red',
		tooltipFormat: '{{offset:weekdays}} ({{value}})',
		tooltipValueLookups: {
			'weekdays': weekdays
		}
    });

	$('.knob').knob({
		format: function (v) {return v + "%";}
	});

	$(window).load(function(){
		$('.scrollable'').mCustomScrollbar();
	});
});