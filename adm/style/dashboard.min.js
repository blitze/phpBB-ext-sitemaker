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
		format: function(v) {
			return v + '%';
		}
	});
	$('.feed').each(function() {
		var options = $(this).data();
		options.entryTemplate = '<li><a target="_blank" href="{url}"><strong>{title}</strong></a><br/>{date}<hr /></li>';
		$(this).rss(options.feed, options);
	});
	$(window).load(function() {
		$('.scrollable').mCustomScrollbar();
	});
});