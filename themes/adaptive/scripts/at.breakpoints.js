(function ($) {

  "use strict";

  Drupal.behaviors.atbP = {
    attach: function (context, settings) {

      // Verify that the user agent understands media queries.
      if (!window.matchMedia('only screen').matches) {
        return;
      }

      // Get breakpoints from drupalSettings, these are added during preprocess
      // and write the breakpoints used in layout settings, which are themselves
      // set in breakpoints module config, i.e. themeName.breakpoints.yml and are
      // the group selected to be used by the themes layout.
      var bp = settings['at_bp'];

      function registerEnquire(breakpoint_label, breakpoint_query) {
        enquire.register(breakpoint_query, {
          match: function() {
            $(document.body).addClass('bp-' + breakpoint_label);
          },
          unmatch: function() {
            $(document.body).removeClass('bp-' + breakpoint_label);
          }
        });
      }

      for (var item in bp) {
        if (bp.hasOwnProperty(item)) {
          var breakpoint_label = item,
              breakpoint_query = bp[item];
          registerEnquire(breakpoint_label, breakpoint_query);
        }
      }
    }
  };
}(jQuery));
