$(document).ready(function() {
	
	// blocks appearing
	$topLeft = $('#top-left');
	$topRight = $('#top-right');
	$bottomLeft = $('#bottom-left');
	$bottomRight = $('#bottom-right');
	$topLeft.add($bottomLeft).css({'transform': 'translate(-120%,0)', 'transition': 'all 0.3s'});
	$topRight.add($bottomRight).css({'transform': 'translate(120%,0)', 'transition': 'all 0.3s'});

	var blocksTopAppearOffset = $topLeft.offset().top + $topLeft.height() + parseInt($topLeft.css('padding-top'));
	var blocksBottomAppearOffset = $bottomLeft.offset().top + $bottomLeft.height() + parseInt($bottomLeft.css('padding-top'));

	var blocksTopShown = false;
	var blocksBottomShown = false;

	$(window).scroll(function() {
		console.log('COUNTING SCROLL!!!!!!!!');
		var offset = $(this).scrollTop();

		if (!blocksTopShown) {
			if (offset + $(window).height() >= blocksTopAppearOffset) {
				$topLeft.add($topRight).css({'transform':'translate(0,0)'}, 300);
				blocksTopShown = true;
			}
		};

		if (!blocksBottomShown) {
			if (offset + $(window).height() >= blocksBottomAppearOffset) {
				$bottomLeft.add($bottomRight).css({'transform':'translate(0,0)'}, 300);
				blocksBottomShown = true;
				if (blocksTopShown) {
					$(window).unbind('scroll');
				}
			}
		};
	});

});