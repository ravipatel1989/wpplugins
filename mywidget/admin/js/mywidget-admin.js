jQuery(document).ready(function($){
	'use strict';

	$( "#datepicker" ).datepicker();
	$('#wpcolorpicker').minicolors({

		// animation speed
		animationSpeed: 50,
	  
		// easing function
		animationEasing: 'swing',
	  
		// defers the change event from firing while the user makes a selection
		changeDelay: 0,
	  
		// hue, brightness, saturation, or wheel
		control: 'hue',
	  
		// default color
		defaultValue: '',
	  
		// hex or rgb
		format: 'hex',
	  
		// show/hide speed
		showSpeed: 100,
		hideSpeed: 100,
	  
		// is inline mode?
		inline: false,
	  
		// a comma-separated list of keywords that the control should accept (e.g. inherit, transparent, initial). 
		keywords: '',
	  
		// uppercase or lowercase
		letterCase: 'lowercase',
	  
		// enables opacity slider
		opacity: false,
	  
		// custom position
		position: 'bottom left',
		
		// additional theme class
		theme: 'default',
	  
		// an array of colors that will show up under the main color <a href="https://www.jqueryscript.net/tags.php?/grid/">grid</a>
		swatches: []
		
	  });

})
	
