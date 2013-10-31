jQuery(window).on("load", function() {
	"use strict";

});

jQuery(document).ready(function($) {
	"use strict";

	/* -----------------------------------------
	 Main Navigation Init
	 ----------------------------------------- */
	$('ul#navigation').superfish({
		delay:       300,
		animation:   { opacity:'show', height:'show' },
		speed:       'fast',
		dropShadows: false
	});

	/* -----------------------------------------
	 Responsive Menus Init with mmenu
	 ----------------------------------------- */
	$("#mobilemenu").mmenu();

	/* -----------------------------------------
	 FitVids Init
	 ----------------------------------------- */
	$('.entry-video').fitVids();
});

var inlinePlayer = null;

soundManager.setup({
	debugMode: false,
	preferFlash: false,
	useFlashBlock: true,
	url: ThemeOption.swfPath,
	flashVersion: 9
});

soundManager.onready(function() {
	inlinePlayer = new InlinePlayer();
});