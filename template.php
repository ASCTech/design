<?php

// Create inline CSS for gradients
// type 0 = linear (horizontal), type 1 = radial
// offset = background-left offset
function qs_gradient($color1, $color2, $type = 0, $offset = "0%", $radius = "100%"){
  switch($type){
    // Radial (except for IE)
    case 1:
      return (
        'background-color: '.$color2.';'.
        'background-image: -webkit-gradient(radial,'.$offset.' center,0,center center,'.$radius.',from('.$color1.'),to('.$color2.'));'.
        'background-image: -moz-radial-gradient('.$offset.' center, circle farthest-corner,'.$color1.','.$color2.');'.
        '-ms-filter: progid:DXImageTransform.Microsoft.gradient(gradientType=0,startColorStr='.$color1.',endColorStr='.$color2.');'.
        'filter: progid:DXImageTransform.Microsoft.gradient(gradientType=0,startColorStr='.$color1.',endColorStr='.$color2.');'
      );
    break;
    // Linear
    case 0:
    default:
      return (
        'background-color: '.$color2.';'.
        'background-image: -webkit-gradient(linear,'.$offset.' center,right center,from('.$color1.'),to('.$color2.'));'.
        'background-image: -moz-linear-gradient(left,'.$color1.' '.$offset.','.$color2.' 100%);'.
        '-ms-filter: progid:DXImageTransform.Microsoft.gradient(gradientType=1,startColorStr='.$color1.',endColorStr='.$color2.');'.
        'filter: progid:DXImageTransform.Microsoft.gradient(gradientType=1,startColorStr='.$color1.',endColorStr='.$color2.');'
      );
  }
}

/*
* Initialize theme settings
*/
if (is_null(theme_get_setting('quickSites_layout'))) {
  global $theme_key;

  /*
   * The default values for the theme variables. Make sure $defaults exactly
   * matches the $defaults in the theme-settings.php file.
   */
  $defaults = array(
    'quickSites_theme' => 1,
    'quickSites_layout' => 'a',
    'quickSites_theme_header' => '',
    'quickSites_theme_footer' => '',
    'quickSites_header_color_left' => 'ffffff',
    'quickSites_header_color_right' => 'ffffff',
    'quickSites_front_header_color_left' => 'ffffff',
    'quickSites_front_header_color_right' => 'ffffff',
    'quickSites_features_color' => 'ffffff',
    'quickSites_footer_color_left' => 'ffffff',
    'quickSites_footer_color_right' => 'ffffff',
  );

  // Get default theme settings.
  $settings = theme_get_settings($theme_key);
  // Don't save the toggle_node_info_ variables.
  if (module_exists('node')) {
    foreach (node_get_types() as $type => $name) {
      unset($settings['toggle_node_info_' . $type]);
    }
  }
  // Save default theme settings.
  variable_set(
    str_replace('/', '_', 'theme_'. $theme_key .'_settings'),
    array_merge($defaults, $settings)
  );
  // Force refresh of Drupal internals.
  theme_get_setting('', TRUE);
}

function phptemplate_breadcrumb($breadcrumb) {
  if (!empty($breadcrumb)) {
    return implode(' &gt; ', $breadcrumb);
  }
}

?>