<?php

use Drupal\Component\Utility\String;
use Drupal\Component\Utility\Xss;

/**
 * @file
 * Generate form elments for the Modify Output settings.
 */
$form['markup_overrides'] = array(
  '#type' => 'details',
  '#title' => t('Markup Overrides'),
  '#group' => 'extension_settings',
);

$form['markup_overrides']['markup_overrides_settings'] = array(
  '#type' => 'fieldset',
  '#title' => t('Markup Overrides'),
  '#weight' => 40,
);

// PNG logo
$form['markup_overrides']['markup_overrides_settings']['png_logo'] = array(
  '#type' => 'details',
  '#title' => t('png Logo default'),
);
$form['markup_overrides']['markup_overrides_settings']['png_logo']['settings_png_logo'] = array(
  '#type' => 'checkbox',
  '#title' => t('Use .png for the default logo'),
  '#description' => t('Force the branding block to use <code>logo.png</code> file instead of <code>logo.svg</code> for the default site logo. Place a logo.png file in your themes root directory, e.g. <code>!themelogopath</code>', array('!themelogopath' => $subtheme_path . '/logo.png')),
  '#default_value' => theme_get_setting('settings.png_logo'),
);

// Breadcrumbs
$form['markup_overrides']['markup_overrides_settings']['breadcrumb'] = array(
  '#type' => 'details',
  '#title' => t('Breadcrumbs'),
);
$form['markup_overrides']['markup_overrides_settings']['breadcrumb']['description'] = array(
  '#type' => 'container',
  '#markup' => t('Settings for the breadcrumb block. First enable the breadcrumb block from the <a href="!blockconfig" target="_blank">block configuration page</a>.', array('!blockconfig' => base_path() . 'admin/structure/block')),
);
// Breadcrumbs Label?
$form['markup_overrides']['markup_overrides_settings']['breadcrumb']['settings_breadcrumb_label'] = array(
  '#type' => 'checkbox',
  '#title' => t('Show the "You are here" label'),
  '#default_value' => theme_get_setting('settings.breadcrumb_label'),
);
// Breadcrumbs Home link?
$form['markup_overrides']['markup_overrides_settings']['breadcrumb']['settings_breadcrumb_home'] = array(
  '#type' => 'checkbox',
  '#title' => t('Show the homepage link'),
  '#default_value' => theme_get_setting('settings.breadcrumb_home'),
);
// Breadcrumbs Page title?
$form['markup_overrides']['markup_overrides_settings']['breadcrumb']['settings_breadcrumb_title'] = array(
  '#type' => 'checkbox',
  '#title' => t('Append the page title to the breadcrumb trail'),
  '#default_value' => theme_get_setting('settings.breadcrumb_title'),
);
// Breadcrumbs Seperator
$form['markup_overrides']['markup_overrides_settings']['breadcrumb']['settings_breadcrumb_separator'] = array(
  '#type'  => 'textfield',
  '#title' => t('Separator'),
  '#description' => t('Use UTF8 chars or escaped unicode, e.g. <code> \00BB </code> (chevron &#187;). You can add spaces also. <a href="!unicodetable" target="_blank">Unicode-table.com</a> is a good place to find codes.', array('!unicodetable' => 'http://unicode-table.com/')),
  '#default_value' => String::checkPlain(theme_get_setting('settings.breadcrumb_separator')),
  '#size' => 25,
  '#maxlength' => 60,
);

// Login block.
$form['markup_overrides']['markup_overrides_settings']['login-block'] = array(
  '#type' => 'details',
  '#title' => t('Login Block'),
);
// Login block placeholder labels.
$form['markup_overrides']['markup_overrides_settings']['login-block']['settings_login_block_placeholder_labels'] = array(
  '#type' => 'checkbox',
  '#title' => t('Placeholder labels'),
  '#default_value' => theme_get_setting('settings.login_block_placeholder_labels'),
  '#description' => t('Use html5 placeholder labels instead of real labels.'),
);
// Horizontal login block
$form['markup_overrides']['markup_overrides_settings']['login-block']['settings_horizontal_login_block'] = array(
  '#type' => 'checkbox',
  '#title' => t('Horizontal login block'),
  '#default_value' => theme_get_setting('settings.horizontal_login_block'),
  '#description' => t('Enable a horizontal style login block (all elements on one line). This setting automatically removes links.'),
);
// Login block links
$form['markup_overrides']['markup_overrides_settings']['login-block']['settings_login_block_remove_links'] = array(
  '#type' => 'checkbox',
  '#title' => t('Remove links'),
  '#default_value' => theme_get_setting('settings.login_block_remove_links'),
  '#description' => t('Remove the <em>Create new account</em> and <em>Request new password</em> links from the login block.'),
  '#states' => array(
    'checked' => array('input[name="settings_horizontal_login_block"]' => array('checked' => TRUE)),
    'disabled' => array('input[name="settings_horizontal_login_block"]' => array('checked' => TRUE)),
  ),
);

// Hide or Remove
$form['markup_overrides']['markup_overrides_settings']['hide-remove'] = array(
  '#type' => 'details',
  '#title' => t('Hide or Remove'),
);
$form['markup_overrides']['markup_overrides_settings']['hide-remove']['settings_comments_hide_title'] = array(
  '#type' => 'checkbox',
  '#title' => t('Hide comment titles'),
  '#default_value' => theme_get_setting('settings.comments_hide_title'),
  '#description' => t('Checking this setting will hide comment titles using element-invisible. Hiding rather than removing titles maintains accessibility and semantic structure while not showing titles to sighted users.'),
);
$form['markup_overrides']['markup_overrides_settings']['hide-remove']['settings_views_hide_feedicon'] = array(
  '#type' => 'checkbox',
  '#title' => t('Hide Feed icon in views pages'),
  '#default_value' => theme_get_setting('settings.views_hide_feedicon'),
  '#description' => t('Page views such as the Frontpage show an RSS feed icon by default, use this setting to remove all page view feedicons.'),
);


// Accessibility
$form['markup_overrides']['markup_overrides_settings']['a11y'] = array(
  '#type' => 'details',
  '#title' => t('Accessibility'),
);

// Skip link target
if (!empty(theme_get_setting('settings.skip_link_target'))) {
  $skip_link_setting = String::checkPlain(theme_get_setting('settings.skip_link_target'));
}
else {
  $skip_link_setting = 'block-' . $theme . '-content'; // try to provide the most likely match.
}
$form['markup_overrides']['markup_overrides_settings']['a11y']['settings_skip_link_target'] = array(
  '#type' => 'textfield',
  '#title' => t('Skip to navigation target ID'),
  '#description' => t('By default the skip link target is <code>!skiplink</code>. If you need to change this do not include the pound symbol.', array('!skiplink' =>$skip_link_setting)),
  '#size' => 60,
  '#maxlength' => 255,
  '#field_prefix' => '#',
  '#default_value' => String::checkPlain(theme_get_setting('settings.skip_link_target')),
);

// Attribution
$form['markup_overrides']['markup_overrides_settings']['attribution'] = array(
  '#type' => 'details',
  '#title' => t('Attribution'),
);
$form['markup_overrides']['markup_overrides_settings']['attribution']['settings_attribution_toggle'] = array(
  '#type' => 'checkbox',
  '#title' => t('Show attribution message'),
  '#description' => t('Displays a message and link for Adaptivethemes.com'),
  '#default_value' => theme_get_setting('settings.attribution_toggle'),
);
