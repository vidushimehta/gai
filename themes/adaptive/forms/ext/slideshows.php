<?php

use Drupal\Component\Utility\Xss;
use Drupal\Component\Utility\Html;

/**
 * @file
 * Generate settings for the Slideshows form.
 * Uses the fantastic slider from http://bxslider.com.
 */

$form['slideshows'] = array(
  '#type' => 'details',
  '#title' => t('Slideshows'),
  '#group' => 'extension_settings',
);

$form['slideshows']['help'] = array(
  '#type' => 'container',
  '#markup' => t('Choose how many slideshow blocks you want to configure, then set options for each slideshow.'),
);

$form['slideshows']['settings_slideshow_count'] = array(
  '#type' => 'number',
  '#title' => t('Number of slideshows'),
  '#attributes' => array(
    'min' => 1,
    'max' => 10,
    'step' => 1,
  ),
  '#default_value' => theme_get_setting('settings.slideshow_count'),
  '#description' => t('Set the number of slideshows you want to configure then save the Extension Settings to generate options and markup code for each slideshow. A "slideshow" is a re-usable collection of settings that you can apply using the generated markup.'),
);

$slideshow_count = theme_get_setting('settings.slideshow_count');

if (isset($slideshow_count) && $slideshow_count >= 1) {
  for ($i = 0; $i < $slideshow_count; $i++) {

    $slideshow_class = Html::getClass($theme . '-slideshow-' . $i);

    $form['slideshows']['slideshow_' . $i]['slideshow_options'] = array(
      '#type' => 'details',
      '#title' => t('Options: !slidername', array('!slidername' => $slideshow_class)),
    );

    // Enable/disable toggle.
    $form['slideshows']['slideshow_' . $i]['slideshow_options']['settings_slideshow_' . $i . '_enable'] = array(
      '#type' => 'checkbox',
      '#title' => t('Use custom settings for this slideshow'),
      '#default_value' => theme_get_setting('settings.slideshow_' . $i . '_enable'),
      //'#description' => t('Check this option to customize settings for this slideshow.'),
    );

    // Fieldset to globally disabled or enable form elements
    $form['slideshows']['slideshow_' . $i]['slideshow_options']['wrapper'] = array(
      '#type' => 'fieldset',
      '#title' => t('Settings for !slidername', array('!slidername' => $slideshow_class)),
      '#states' => array(
        'visible' => array('input[name="settings_slideshow_' . $i . '_enable"]' => array('checked' => TRUE)),
      ),
    );

    /* BASIC */
    // animation : String Controls the animation type, "fade" or "slide".
    $form['slideshows']['slideshow_' . $i]['slideshow_options']['wrapper']['settings_slideshow_' . $i . '_animation'] = array(
      '#type' => 'select',
      '#title' => t('Animation'),
      '#options' => array(
        'slide' => t('Slide'),
        'fade'  => t('Fade'),
      ),
      '#default_value' => theme_get_setting('settings.slideshow_' . $i . '_animation'),
    );

    // direction : String Controls the animation direction, "horizontal" or "vertical"
    $form['slideshows']['slideshow_' . $i]['slideshow_options']['wrapper']['settings_slideshow_' . $i . '_direction'] = array(
      '#type' => 'select',
      '#title' => t('Direction'),
      '#options' => array(
        'horizontal' => t('horizontal'),
        'vertical'   => t('vertical'),
      ),
      '#default_value' => theme_get_setting('settings.slideshow_' . $i . '_direction'),
      '#states' => array(
        'visible' => array('select[name="settings_slideshow_' . $i . '_animation"]' => array('value' => 'slide')),
      ),
    );

    // smoothHeight     : false,          // Boolean Animate the height of the slider smoothly for slides of varying height.
    $form['slideshows']['slideshow_' . $i]['slideshow_options']['wrapper']['settings_slideshow_' . $i . '_smoothheight'] = array(
      '#type' => 'checkbox',
      '#title' => t('Smooth height'),
      '#default_value' => theme_get_setting('settings.slideshow_' . $i . '_smoothheight'),
      '#description' => t('Animate the height of the slider for slides of varying height. NOTE: this can delay slideshow rendering.'),
      '#states' => array(
        'visible' => array(
          'select[name="settings_slideshow_' . $i . '_animation"]' => array('value' => 'slide'),
          'select[name="settings_slideshow_' . $i . '_direction"]' => array('value' => 'horizontal'),
        ),
      ),
    );

    // slideshowSpeed : Number Set the speed of the slideshow cycling, in milliseconds
    $form['slideshows']['slideshow_' . $i]['slideshow_options']['wrapper']['settings_slideshow_' . $i . '_slideshowspeed'] = array(
      '#type' => 'number',
      '#title' => t('Slideshow speed'),
      '#attributes' => array(
        'min' => 100,
        'max' => 10000,
        'step' => 100,
      ),
      '#default_value' => theme_get_setting('settings.slideshow_' . $i . '_slideshowspeed') ?: 4000,
      '#description' => t('Set the speed of the slideshow cycling, in milliseconds.'),
    );

    // animationSpeed : Number Set the speed of animations, in milliseconds
    $form['slideshows']['slideshow_' . $i]['slideshow_options']['wrapper']['settings_slideshow_' . $i . '_animationspeed'] = array(
      '#type' => 'number',
      '#title' => t('Animation speed'),
      '#attributes' => array(
        'min' => 0,
        'max' => 5000,
        'step' => 50,
      ),
      '#default_value' => theme_get_setting('settings.slideshow_' . $i . '_animationspeed') ?: 600,
      '#description' => t('Set the speed of animations, in milliseconds.'),
    );


    // controlNav : Boolean Create navigation for paging control of each slide.
    $form['slideshows']['slideshow_' . $i]['slideshow_options']['wrapper']['settings_slideshow_' . $i . '_controlnav'] = array(
      '#type' => 'checkbox',
      '#title' => t('Pager <small>(Show the pager)</small>'),
      '#default_value' => theme_get_setting('settings.slideshow_' . $i . '_controlnav'),
    );

    // Thumbnail controlNav toggle.
    // TODO - probably remove this, setting the data-thumb attribute is probably too hard for most users to do manually in markup.
    /*
    $form['slideshows']['slideshow_' . $i]['slideshow_options']['wrapper']['settings_slideshow_' . $i . '_controlnav_thumbs'] = array(
      '#type' => 'checkbox',
      '#title' => t('Use thumbnail pager'),
      '#default_value' => theme_get_setting('settings.slideshow_' . $i . '_controlnav_thumbs'),
      '#states' => array(
        'invisible' => array('input[name="settings_slideshow_' . $i . '_controlnav"]' => array('checked' => FALSE)),
      ),
    );
    */

    // directionNav : Boolean Create previous/next arrow navigation.
    $form['slideshows']['slideshow_' . $i]['slideshow_options']['wrapper']['settings_slideshow_' . $i . '_directionnav'] = array(
      '#type' => 'checkbox',
      '#title' => t('Controls <small>(Show previous/next links)</small>'),
      '#default_value' => theme_get_setting('settings.slideshow_' . $i . '_directionnav'),
    );

    /* Carousels */
    $form['slideshows']['slideshow_' . $i]['slideshow_options']['wrapper']['settings_slideshow_' . $i . '_as_carousel'] = array(
      '#type' => 'checkbox',
      '#title' => t('Carousel <small>(Requires Animation: slide, Direction: horizontal)</small>'),
      '#default_value' => theme_get_setting('settings.slideshow_' . $i . '_as_carousel'),
      '#states' => array(
        'enabled' => array(
          'select[name="settings_slideshow_' . $i . '_animation"]' => array('value' => 'slide'),
          'select[name="settings_slideshow_' . $i . '_direction"]' => array('value' => 'horizontal'),
        ),
      ),
    );

    $form['slideshows']['slideshow_' . $i]['slideshow_options']['wrapper']['carousels'] = array(
      '#type' => 'fieldset',
      '#title' => t('Options for carousels'),
      '#states' => array(
        'visible' => array(
          'input[name="settings_slideshow_' . $i . '_as_carousel"]' => array('checked' => TRUE),
          'select[name="settings_slideshow_' . $i . '_animation"]' => array('value' => 'slide'),
          'select[name="settings_slideshow_' . $i . '_direction"]' => array('value' => 'horizontal'),
        ),
      ),
    );

    // itemWidth : Number Box-model width of individual carousel items, including horizontal borders and padding.
    $form['slideshows']['slideshow_' . $i]['slideshow_options']['wrapper']['carousels']['settings_slideshow_' . $i . '_itemwidth'] = array(
      '#type' => 'number',
      '#title' => t('Item width (px)'),
      '#attributes' => array(
        'min' => 40,
        'max' => 1000,
        'step' => 1,
      ),
      '#default_value' => theme_get_setting('settings.slideshow_' . $i . '_itemwidth') ?: 300,
      '#description' => t('Set the width of individual carousel items.'),
    );


    // itemMargin : Number Margin between carousel items.
    $form['slideshows']['slideshow_' . $i]['slideshow_options']['wrapper']['carousels']['settings_slideshow_' . $i . '_itemmargin'] = array(
      '#type' => 'number',
      '#title' => t('Item margin (px)'),
      '#attributes' => array(
        'min' => 0,
        'max' => 100,
        'step' => 1,
      ),
      '#default_value' => theme_get_setting('settings.slideshow_' . $i . '_itemmargin') ?: 0,
      '#description' => t('Set the margin between carousel items.'),
    );

    // minItems : Number Minimum number of carousel items that should be visible.
    $form['slideshows']['slideshow_' . $i]['slideshow_options']['wrapper']['carousels']['settings_slideshow_' . $i . '_minitems'] = array(
      '#type' => 'number',
      '#title' => t('Min items'),
      '#attributes' => array(
        'min' => 1,
        'max' => 12,
        'step' => 1,
      ),
      '#default_value' => theme_get_setting('settings.slideshow_' . $i . '_minitems') ?: 2,
      '#description' => t('Set the minimum number of carousel items that should be visible.'),
    );

    // maxItems : Number Maximum number of carousel items that should be visible.
    $form['slideshows']['slideshow_' . $i]['slideshow_options']['wrapper']['carousels']['settings_slideshow_' . $i . '_maxitems'] = array(
      '#type' => 'number',
      '#title' => t('Max items'),
      '#attributes' => array(
        'min' => 1,
        'max' => 24,
        'step' => 1,
      ),
      '#default_value' => theme_get_setting('settings.slideshow_' . $i . '_maxitems') ?: 4,
      '#description' => t('Set the maximum number of carousel items that should be visible.'),
    );

    // move : 0 Number Number of carousel items that should move on animation.
    $form['slideshows']['slideshow_' . $i]['slideshow_options']['wrapper']['carousels']['settings_slideshow_' . $i . '_move'] = array(
      '#type' => 'number',
      '#title' => t('Move'),
      '#attributes' => array(
        'min' => 1,
        'max' => 12,
        'step' => 1,
      ),
      '#default_value' => theme_get_setting('settings.slideshow_' . $i . '_move') ?: 1,
      '#description' => t('Set the number of carousel items that should move on animation.'),
    );


    /* ADVANCED */
    $form['slideshows']['slideshow_' . $i]['slideshow_options']['wrapper']['settings_slideshow_' . $i . '_advanced_options'] = array(
      '#type' => 'checkbox',
      '#title' => t('Advanced options <small>(show and configure advanced options)</small>'),
      '#default_value' => theme_get_setting('settings.slideshow_' . $i . '_advanced_options'),
    );

    $form['slideshows']['slideshow_' . $i]['slideshow_options']['wrapper']['advanced_options'] = array(
      '#type' => 'details',
      '#title' => t('Advanced Options'),
      '#open'=> TRUE,
      '#states' => array(
        'visible' => array('input[name="settings_slideshow_' . $i . '_advanced_options"]' => array('checked' => TRUE)),
      ),
    );

    // pauseOnAction : Boolean Pause the slideshow when interacting with control elements.
    $form['slideshows']['slideshow_' . $i]['slideshow_options']['wrapper']['advanced_options']['settings_slideshow_' . $i . '_pauseonaction'] = array(
      '#type' => 'checkbox',
      '#title' => t('Pause on action'),
      '#default_value' => theme_get_setting('settings.slideshow_' . $i . '_pauseonaction') ?: 1,
      '#description' => t('Pause the slideshow when interacting with control elements.'),
    );

    // pauseOnHover : Boolean Pause the slideshow when hovering over slider, then resume when no longer hovering.
    $form['slideshows']['slideshow_' . $i]['slideshow_options']['wrapper']['advanced_options']['settings_slideshow_' . $i . '_pauseonhover'] = array(
      '#type' => 'checkbox',
      '#title' => t('Pause on hover'),
      '#default_value' => theme_get_setting('settings.slideshow_' . $i . '_pauseonhover'),
      '#description' => t('Pause the slideshow when hovering over slider, then resume when no longer hovering.'),
    );

    // animationLoop: true,  Boolean Gives the slider a seamless infinite loop.
    $form['slideshows']['slideshow_' . $i]['slideshow_options']['wrapper']['advanced_options']['settings_slideshow_' . $i . '_animationloop'] = array(
      '#type' => 'checkbox',
      '#title' => t('Animation loop'),
      '#default_value' => theme_get_setting('settings.slideshow_' . $i . '_animationloop') ?: 1,
      '#description' => t('Gives the slider a seamless infinite loop.'),
    );

    // reverse          : false,	         // Boolean Reverse the animation direction.
    $form['slideshows']['slideshow_' . $i]['slideshow_options']['wrapper']['advanced_options']['settings_slideshow_' . $i . '_reverse'] = array(
      '#type' => 'checkbox',
      '#title' => t('Reverse'),
      '#default_value' => theme_get_setting('settings.slideshow_' . $i . '_reverse'),
      '#description' => t('Reverse the animation direction.'),
    );

    // randomize        : false,          // Boolean Randomize slide order, on load
    $form['slideshows']['slideshow_' . $i]['slideshow_options']['wrapper']['advanced_options']['settings_slideshow_' . $i . '_randomize'] = array(
      '#type' => 'checkbox',
      '#title' => t('Randomize'),
      '#default_value' => theme_get_setting('settings.slideshow_' . $i . '_randomize'),
      '#description' => t('Randomize slide order, on load.'),
    );

    // This one is really bad variable name, we customize it here rather than use the default Flexslider variable.
    // slideshow: true,  Boolean Setup a slideshow for the slider to animate automatically.
    $form['slideshows']['slideshow_' . $i]['slideshow_options']['wrapper']['advanced_options']['settings_slideshow_' . $i . '_autostart'] = array(
      '#type' => 'checkbox',
      '#title' => t('Auto start'),
      '#default_value' => theme_get_setting('settings.slideshow_' . $i . '_autostart') ?: 1,
      '#description' => t('Start the slideshow automatically.'),
    );

    // initDelay        : 0,              // Number Set an initialization delay, in milliseconds
    $form['slideshows']['slideshow_' . $i]['slideshow_options']['wrapper']['advanced_options']['settings_slideshow_' . $i . '_initdelay'] = array(
      '#type' => 'number',
      '#title' => t('Initialization delay'),
      '#attributes' => array(
        'min' => 0,
        'max' => 10000,
        'step' => 50,
      ),
      '#default_value' => theme_get_setting('settings.slideshow_' . $i . '_initdelay'),
      '#description' => t('Set an initialization delay, in milliseconds.'),
    );

    // easing           : "swing",        // String Determines the easing method used in jQuery transitions.
    $form['slideshows']['slideshow_' . $i]['slideshow_options']['wrapper']['advanced_options']['settings_slideshow_' . $i . '_easing'] = array(
      '#type' => 'select',
      '#title' => t('Easing'),
      '#options' => array(
        'swing' => t('swing'),
      ),
      '#default_value' => theme_get_setting('settings.slideshow_' . $i . '_easing'),
      '#description' => t('Determines the easing method used in jQuery transitions.'),
    );

    // useCSS           : true,           // Boolean Slider will use CSS3 transitions, if available
    $form['slideshows']['slideshow_' . $i]['slideshow_options']['wrapper']['advanced_options']['settings_slideshow_' . $i . '_usecss'] = array(
      '#type' => 'checkbox',
      '#title' => t('Use CSS'),
      '#default_value' => theme_get_setting('settings.slideshow_' . $i . '_usecss') ?: 1,
      '#description' => t('Slider will use CSS3 transitions, if available.'),
    );

    // touch            : true,           // Boolean Allow touch swipe navigation of the slider on enabled devices
    $form['slideshows']['slideshow_' . $i]['slideshow_options']['wrapper']['advanced_options']['settings_slideshow_' . $i . '_touch'] = array(
      '#type' => 'checkbox',
      '#title' => t('Touch swipe navigation'),
      '#default_value' => theme_get_setting('settings.slideshow_' . $i . '_touch') ?: 1,
      '#description' => t('Allow touch swipe navigation of the slider on enabled devices.'),
    );

    // video            : false,          // Boolean Will prevent use of CSS3 3D Transforms, avoiding graphical glitches
    $form['slideshows']['slideshow_' . $i]['slideshow_options']['wrapper']['advanced_options']['settings_slideshow_' . $i . '_video'] = array(
      '#type' => 'checkbox',
      '#title' => t('Video'),
      '#default_value' => theme_get_setting('settings.slideshow_' . $i . '_video'),
      '#description' => t('Checking this setting will prevent use of CSS3 3D Transforms, avoiding graphical glitches when embedding video.'),
    );

    // prevText : String Set the text for the "previous" directionNav item
    $form['slideshows']['slideshow_' . $i]['slideshow_options']['wrapper']['advanced_options']['settings_slideshow_' . $i . '_prevtext'] = array(
      '#type' => 'textfield',
      '#title' => t('Previous text'),
      '#default_value' => theme_get_setting('settings.slideshow_' . $i . '_prevtext')?: t('Previous'),
      '#description' => t('Text for the "previous" direction nav item.'),
    );

    //nextText : String Set the text for the "next" directionNav item
    $form['slideshows']['slideshow_' . $i]['slideshow_options']['wrapper']['advanced_options']['settings_slideshow_' . $i . '_nexttext'] = array(
      '#type' => 'textfield',
      '#title' => t('Next text'),
      '#default_value' => theme_get_setting('settings.slideshow_' . $i . '_nexttext') ?: t('Next'),
      '#description' => t('Text for the "next" direction nav item.'),
    );

    // selector         : ".slides > li", // Selector Must match a simple pattern. '{container} > {slide}'.
    $form['slideshows']['slideshow_' . $i]['slideshow_options']['wrapper']['advanced_options']['settings_slideshow_' . $i . '_selector'] = array(
      '#type' => 'textfield',
      '#title' => t('Slide selector'),
      '#default_value' => theme_get_setting('settings.slideshow_' . $i . '_selector')?: '.slides > li',
      '#description' => t('Selector must match the pattern <code>{container} &#62; {slide}</code>. Modify with caution. The generated markup snippet will not reflect changes here, and you will need to account for changes both in markup and CSS. Changing this without editing the markup in your slideshow or CSS will break the slideshow.'),
    );

    // Class and markup generator TODO: markup generator
    $form['slideshows']['slideshow_' . $i]['slideshow_options']['slideshow_markup'] = array(
      '#type' => 'textarea',
      '#title' => t('Generated markup for this slideshow'),
      '#default_value' =>
'<div class="flexslider ' . $slideshow_class . '">
  <ul class="slides">
    <li></li>
    <li></li>
    <li></li>
  </ul>
</div>',
      '#disabled' => TRUE,
      '#cols' => 30,
      '#rows' => 7,
      '#description' => t('Markup for this slideshow with initilialization class <code>!initilialization_class</code>. Use this in blocks, nodes, templates etc (anywhere in the output between the <code>&#60;body&#62;</code> elements). Each image or content must be in an <code>@licode</code>, add or remove as required. Note: this code and initialization class are re-usable, for example you want a slideshow for each section of your site and want to use the same settings - just re-use this snippet for each slideshow.', array('@licode' => '<li></li>', '!initilialization_class' => $slideshow_class)),
    );
  }
}


/*
$form['slideshows']['settings_slideshows'] = array(
  '#type' => 'textarea',
  '#title' => t('Slideshow settings'),
  '#rows' => 20,
  '#default_value' => theme_get_setting('settings.slideshows') ? Xss::filterAdmin(theme_get_setting('settings.slideshows')) : '',
  '#description' => t("<p>Settings will save to the file: <code>!slideshowsettingspath</code></p>", array('!slideshowsettingspath' => $subtheme_path . '/scripts/slideshow-settings.js')),
);
*/
/*
$form['slideshows']['slideshows_help'] = array(
  '#type' => 'container',
  '#markup' => t('
  <h3>How to create a new Slideshow</h3>
  <ol>
  <li>Create a new <a href="!customblockpath" target="_blank">custom block</a>.</li>
  <li>Add images using the WYSIWYG editor or manually if you are loading images via FTP.</li>
  <li>Format images into a UL list, it must have the class name on the UL wrapper the same as specified in the above settings, e.g. <code>class="at-slider-0"</code>. Title attributes on image elements are converted into captions. You can wrap images in a link.</li>
  </ol>

  <p>For more extensive help (details on the various options and how to do videos, a carosel etc) and a video presentation please see the extended help page: TODO.</p>
  ', array('!customblockpath' => '/admin/structure/block')),
);
*/
