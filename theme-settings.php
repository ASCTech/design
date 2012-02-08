<?php

/**
* Implementation of THEMEHOOK_settings() function.
*
* @param $saved_settings
*   array An array of saved settings for this theme.
* @return
*   array A form array.
*/

function quickSites_settings($saved_settings){
  // Include the script for preview switching (and image preloading)
  drupal_add_js(drupal_get_path('theme', 'quickSites').'/theme-settings.js', 'quickSites');
  // Include the scripts for the color picker
  drupal_add_css(drupal_get_path('theme', 'quickSites').'/farbtastic/farbtastic.css', 'quickSites');
  drupal_add_js(drupal_get_path('theme', 'quickSites').'/farbtastic/farbtastic.js', 'quickSites');

  /*
   * The default values for the theme variables. Make sure $defaults exactly
   * matches the $defaults in the template.php file.
   */
  $defaults = array(
    'quickSites_theme' => 0,
    'quickSites_layout' => 'a',
    'quickSites_theme_header' => '',
    'quickSites_theme_footer' => '',
    'quickSites_header_left_color' => '#ffffff',
    'quickSites_header_right_color' => '#ffffff',
    'quickSites_front_header_left_color' => '#ffffff',
    'quickSites_front_header_right_color' => '#ffffff',
    'quickSites_features_color' => '#ffffff',
    'quickSites_footer_center_color' => '#ffffff',
    'quickSites_footer_outside_color' => '#ffffff',
  );

  // Options
  $layoutOptions = array('a'=>'A', 'b'=>'B', 'c'=>'C');
  $themeOptions = array("Custom");
  $headerOptions = array(''=>"Theme Default");
  $footerOptions = array(''=>"Theme Default");

    // Get list of themes from theme directory
    $themeDir = drupal_get_path('theme', 'quickSites').'/variations';
    $themeDirs = scandir($themeDir);
    $imagePreloadList = array();
    foreach($themeDirs as $dir){
      $num = array();
      if( preg_match('/^theme-(\d+)$/', $dir, $num)){
        $num = intval($num[1]);
        if(file_exists($themeDir.'/'.$dir.'/theme.css')){
          if($num) $themeOptions[$num] = $num;
          foreach($layoutOptions as $layoutOption=>$layoutName){
            $imagePreloadList[] = '/'.$themeDir.'/theme-0/preview-'.$layoutOption.'.png';
          }
        }
        if($num > 0 && file_exists($themeDir.'/theme-0/header.css')){
          $headerOptions[$num] = $num;
        }
        if($num > 0 && file_exists($themeDir.'/theme-0/footer.css')){
          $footerOptions[$num] = $num;
        }
      }
    }
    // Redifine basepath
    $themeDir = base_path() . drupal_get_path('theme', 'quickSites').'/variations';
    // String to pass as argument for jQuery image preloading
    $imagePreloadList = '"'.implode('","', $imagePreloadList).'"';
    // Image preview dimensions
    $previewWidth = 400;
    $previewHeight = 440;
    $previewHeaderHeight = 70;
    $previewFrontHeaderHeight = 103;
    $previewFooterHeight = 46;
    $previewFooterBottom = 1;

  // Merge the saved variables and their default values
  $settings = array_merge($defaults, $saved_settings);

  $form['quickSites_previewdisplay'] = array(
    '#value' => '<div style="height:'.$previewHeight.'px; width:'.$previewWidth.'px; float:left; margin:10px; ">' .
        '<div style=" position: relative;">' .
        '<div id="theme_preview_features_color" style="position: absolute; top: '.($previewHeaderHeight + $previewFrontHeaderHeight).'px; left: 1px;' .
        ' width: '.$previewWidth.'px; height: '.($previewHeight - $previewHeaderHeight - $previewFrontHeaderHeight - $previewFooterHeight).'px;"></div>' .
        '<div id="theme_preview_front_header_color" style="position: absolute; top: '.$previewHeaderHeight.'px; left: 1px;' .
        ' width: '.$previewWidth.'px; height: '.$previewFrontHeaderHeight.'px;"></div>' .
        '<div id="theme_preview_footer_color" style="position: absolute; bottom: 1px; left: 1px;' .
        ' width: '.$previewWidth.'px; height: '.$previewFooterHeight.'px;"></div>' .
        '<img id="theme_preview" style="border:1px solid #CCC; position: absolute;" src="' .
        $themeDir.'/theme-'.$settings['quickSites_theme'] .
        '/preview-'.$settings['quickSites_layout'].'.png" alt="Theme preview" />' .
        '<div id="theme_preview_header" style="position: absolute; top: 1px; left: 1px;' .
        ' width: '.$previewWidth.'px; height: '.$previewHeaderHeight.'px; background: url(' .
        $themeDir.'/theme-'.$settings['quickSites_theme_header'] .
        '/preview-header.png) no-repeat left top;"></div>' .
        '<div id="theme_preview_footer" style="position: absolute; bottom: '.$previewFooterBottom.'px; left: 1px;' .
        ' width: '.$previewWidth.'px; height: '.$previewFooterHeight.'px; background: url(' .
        $themeDir.'/theme-'.$settings['quickSites_theme_footer'] .
        '/preview-footer.png) no-repeat left bottom;"></div>' .
        '</div></div><div style="float: left;">' .
        '<script type="text/javascript">' .
        'jQuery.preLoadImages('.$imagePreloadList.');' .
        '</script></div>',
  );

  // Create the form widgets using Form API
  $form['quickSites_theme'] = array(
    '#type' => 'radios',
    '#title' => t('Theme'),
  '#options' => array("Custom"),
    '#default_value' => $settings['quickSites_theme'],
    '#prefix' => '<div style="float: left; margin-left: 50px; display: none;">',
    '#suffix' => '</div>',
  );
  $form['quickSites_theme_header'] = array(
    '#type' => 'radios',
    '#title' => t('Header'),
    '#options' => array(''=>"Theme Default"),
    '#default_value' => $settings['quickSites_theme_header'],
    '#prefix' => '<div class="quickSites-hidden" style="float: left; margin-left: 50px; display: none;">',
    '#suffix' => '</div>',
  );
  $form['quickSites_theme_footer'] = array(
    '#type' => 'radios',
    '#title' => t('Footer'),
    '#options' => array(''=>"Theme Default"),
    '#default_value' => $settings['quickSites_theme_footer'],
    '#prefix' => '<div class="quickSites-hidden" style="float: left; margin-left: 50px; display: none;">',
    '#suffix' => '</div>',
  );

  $form['quickSites_header_left_color'] = array(
    '#type' => 'textfield',
  '#size' => 7,
  '#maxlength' => 7,
    '#title' => t('Header Left Color'),
    '#default_value' => $settings['quickSites_header_left_color'],
  '#prefix' => '<div style="float: left; width: 500px; margin-top: 10px;" id="color_settings"><fieldset><legend></label><select id="color_preset"><option value=-1>Custom</option></select></legend><div class="form-item" style="float: left;"><label id="colorPickerLabel">&nbsp;</label><div id="colorPicker"></div></div><div style="float: left; width: 140px;">',
  '#suffix' => '</div>',
  );
  $form['quickSites_header_right_color'] = array(
    '#type' => 'textfield',
  '#size' => 7,
  '#maxlength' => 7,
    '#title' => t('Header Right Color'),
    '#default_value' => $settings['quickSites_header_right_color'],
  '#prefix' => '<div style="float: left; width: 140px;">',
  '#suffix' => '</div>',
  );
  $form['quickSites_front_header_left_color'] = array(
    '#type' => 'textfield',
  '#size' => 7,
  '#maxlength' => 7,
    '#title' => t('Front Header Left Color'),
    '#default_value' => $settings['quickSites_front_header_left_color'],
  '#prefix' => '<div style="float: left; width: 140px;">',
  '#suffix' => '</div>',
  );
  $form['quickSites_front_header_right_color'] = array(
    '#type' => 'textfield',
  '#size' => 7,
  '#maxlength' => 7,
    '#title' => t('Front Header Right Color'),
    '#default_value' => $settings['quickSites_front_header_right_color'],
  '#prefix' => '<div style="float: left; width: 140px;">',
  '#suffix' => '</div>',
  );
  $form['quickSites_footer_center_color'] = array(
    '#type' => 'textfield',
  '#size' => 7,
  '#maxlength' => 7,
    '#title' => t('Footer Center Color'),
    '#default_value' => $settings['quickSites_footer_center_color'],
  '#prefix' => '<div style="float: left; width: 140px;">',
  '#suffix' => '</div>',
  );
  $form['quickSites_footer_outside_color'] = array(
    '#type' => 'textfield',
  '#size' => 7,
  '#maxlength' => 7,
    '#title' => t('Footer Outside Color'),
    '#default_value' => $settings['quickSites_footer_outside_color'],
  '#prefix' => '<div style="float: left; width: 140px;">',
  '#suffix' => '</div>',
  );
  $form['quickSites_features_color'] = array(
    '#type' => 'textfield',
  '#size' => 7,
  '#maxlength' => 7,
    '#title' => t('Features Header Color'),
    '#default_value' => $settings['quickSites_features_color'],
  '#prefix' => '<div style="float: left; width: 140px;">',
  '#suffix' => '</div></fieldset></div>',
  );

  $form['quickSites_layout'] = array(
    '#type' => 'radios',
    '#title' => t('Layout'),
  '#options' => $layoutOptions,
    '#default_value' => $settings['quickSites_layout'],
  '#prefix' => '<div style="float: left; margin-left: 5px; margin-top: -20px;">',
  '#suffix' => '</div>',
  );

  // Return the additional form widgets
  return $form;
}

?>