(function ($) {

  "use strict";

  Drupal.behaviors.atsS = {
    attach: function (context, settings) {
      var slideshowSettings = settings['at_ss'];

      for (var item in settings['at_ss']) {
        if (settings['at_ss'].hasOwnProperty(item)) {

          // This items settings object.
          var ss = settings['at_ss'][item];

          //console.log(ss);

          // Add a class if the pager is active.
          if (ss.controlnav) {
            $('.' + ss.classname).addClass('has-pager');
          }

          // Add a class if this is a carousel
          if (ss.as_carousel) {
            $('.' + ss.classname).addClass('is-carousel');
          }

          // Initialize and set options.
          $('.' + ss.classname).flexslider({

            start: function(slider){$('.flexslider').resize()},

            // Basic settings
            animation      : ss.animation ? ss.animation : 'slide',                    // String Controls the animation type, "fade" or "slide".
            direction      : ss.direction ? ss.direction : 'horizontal',               // String Controls the animation direction, "horizontal" or "vertical"
            smoothHeight   : ss.smoothheight ? ss.smoothheight : false,                // Boolean Animate the height of the slider smoothly for slides of varying height.
            slideshowSpeed : ss.slideshowspeed ? parseFloat(ss.slideshowspeed) : 4000, // Number Set the speed of the slideshow cycling, in milliseconds
            animationSpeed : ss.animationspeed ? parseFloat(ss.animationspeed) : 600,  // Number Set the speed of animations, in milliseconds
            controlNav     : ss.controlnav ? ss.controlnav : true,                     // Boolean Create navigation for paging control of each slide.
            directionNav   : ss.directionnav ? ss.directionnav : true,                 // Boolean Create previous/next arrow navigation.

            // Carousel
            itemWidth  : ss.itemwidth ? parseFloat(ss.itemwidth) : 0,      // Number Box-model width of individual carousel items, including horizontal borders and padding.
            itemMargin : ss.itemmargin ? parseFloat(ss.itemmargin) : 0,    // Number Margin between carousel items.
            minItems   : ss.minitems ? parseFloat(ss.minitems) : 0,        // Number Minimum number of carousel items that should be visible.
            maxItems   : ss.maxitems ? parseFloat(ss.maxitems) : 0,        // Number Maximum number of carousel items that should be visible.
            move       : ss.move ? parseFloat(ss.move) : 0,                // Number Number of carousel items that should move on animation.

            // Advanced options
            pauseOnAction : ss.pauseonaction ? ss.pauseonaction : true,    // Boolean Pause the slideshow when interacting with control elements.
            pauseOnHover  : ss.pauseonhover ? ss.pauseonhover : false,     // Boolean Pause the slideshow when hovering over slider, then resume when no longer hovering.
            animationLoop : ss.animationloop ? ss.animationloop : true,    // Boolean Gives the slider a seamless infinite loop.
            reverse       : ss.reverse ? String(ss.reverse) : false,       // Boolean Reverse the animation direction.
            randomize     : ss.randomize ? ss.randomize : false,           // Boolean Randomize slide order, on load
            slideshow     : ss.autostart ? ss.autostart : true,            // Boolean Setup a slideshow for the slider to animate automatically.
            initDelay     : ss.initdelay ? parseFloat(ss.initdelay) : 0,   // Number Set an initialization delay, in milliseconds
            easing        : ss.easing ? ss.easing : 'swing',               // String Determines the easing method used in jQuery transitions.
            useCSS        : ss.usecss ? ss.usecss : true,                  // Boolean Slider will use CSS3 transitions, if available
            touch         : ss.touch ? ss.touch : true,                    // Boolean Allow touch swipe navigation of the slider on enabled devices
            video         : ss.video ? ss.video : false,                   // Boolean Will prevent use of CSS3 3D Transforms, avoiding graphical glitches
            prevText      : ss.prevtext ? ss.prevtext : 'Previous',        // String Set the text for the "previous" directionNav item
            nextText      : ss.nexttext ? ss.nexttext : 'Next',            // String Set the text for the "next" directionNav item
            selector      : ss.selector ? ss.selector : '.slides > li',    // Selector Must match a simple pattern. '{container} > {slide}'.

          });
        }
      }
    }
  };
}(jQuery));
