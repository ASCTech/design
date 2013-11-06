<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="<?php print $language->language ?>" xml:lang="<?php print $language->language ?>" xmlns="http://www.w3.org/1999/xhtml">

<head profile="http://gmpg.org/xfn/11">

<meta name="description" content="<?php print $site_name; ?>"/>
<meta name="author" content="Arts and Sciences Technology Services Web and Data Solutions"/>
<meta name="keywords" content="<?php print strtr($site_name, array(" " => ", ")); ?>, Arts and Sciences, OSU, Ohio State"/>

<?php

global $base_path;
global $theme_path;

$body_classes .= ' theme-0';
$body_classes .= ' layout-a';

// These content types will not display a title in inner.tpl.php
$no_title_node_types = array("qs_events", "qs_people");

?>

<title><?php print $head_title ?></title>
<?php print $head ?>
<?php print $styles ?>
<link type="text/css" rel="stylesheet" media="screen" href="<?php print $base_path.$theme_path."/variations/theme-0/footer.css"; ?>" />
<link type="text/css" rel="stylesheet" media="screen" href="<?php print $base_path.$theme_path."/variations/theme-0/header.css"; ?>" />
<link type="text/css" rel="stylesheet" media="screen" href="<?php print $base_path.$theme_path."/variations/theme-0/theme.css"; ?>" />

<?php

    print "
      <style type=\"text/css\">
      .feature .view-header {
        background-color: #ccc;
        background-image: url('" . $base_path . $theme_path . "/images/stripes-light.png');
        background-repeat: repeat;
        height: 100%;
        width: 100%;
      }
      .feature .view-content {
        border-color: #000;
      }
      #front-header-tile {
        background-color: #ccc;
        background-image: url('" . $base_path . $theme_path . "/images/stripes.png');
        background-repeat: repeat;
        width: 50%;
        margin-left: -6px;
        padding-right: 6px;
      }
      #front-header > .container {
        height: auto;
      }
      #footer {
        background-color: #ccc;
        border-top: 2px solid #666;
        background-image: url('" . $base_path . $theme_path . "/images/stripes.png');
        background-repeat: repeat;
        height: 100%;
        width: 100%;
      }
    ";


    print '</style>';


?>

<?php print $scripts ?>

</head>

<body class="<?php print $body_classes; ?>">

  <div id="osu_navbar" role="navigation">
      <div class="container">
        <h2 class="osu-semantic">Ohio State nav bar</h2>
      <a href="#page-content" id="skip" class="osu-semantic">Skip to main content</a>
        <div class="univ_info">
          <p class="univ_name"><a href="http://osu.edu" title="The Ohio State University">The Ohio State University</a></p>
        </div><!-- /univ_info -->
        <div class="univ_links">
          <div class="links">
            <ul>
              <li><a href="http://www.osu.edu/help.php" class="help">Help</a></li>
              <li><a href="http://buckeyelink.osu.edu/" class="buckeyelink" >BuckeyeLink</a></li>
              <li><a href="http://www.osu.edu/map/" class="map">Map</a></li>
              <li><a href="http://www.osu.edu/findpeople.php" class="findpeople">Find People</a></li>
              <li><a href="https://email.osu.edu/" class="webmail">Webmail</a></li> 
              <li><a href="http://www.osu.edu/search/" class="search">Search Ohio State</a></li>
            </ul>
          </div><!-- /links -->
        </div><!-- /univ_links -->
      </div><!-- /container -->
  </div><!-- /osu_navbar -->

  <div id="header" style="background-color: #fff;">
    <div class="container">
      <div id="header-container" class="span-24">
        <?php if(false && !$is_front){ ?>
          <a href="http://artsandsciences.osu.edu/" id="small-banner-1" title="Arts and Sciences homepage">&nbsp;</a>
        <?php } ?>
        <div id="logo"<?php if($logo) print ' style="background-image: url(' . $logo . '); background-repeat: no-repeat;"'; ?>>
          <a href="<?php global $base_url; print $base_url; ?>" title="Back to <?php print $site_name; ?> home"><?php if(!$logo) print $site_name; else print "&nbsp;"; ?></a>
        </div><!-- .logo -->
        <a href="http://www.osu.edu/" id="osulogo" title="Ohio State University homepage">&nbsp;</a>
        <div id="navigation">
          <?php print $MainNav; ?>
        </div><!-- #navigation -->
      </div>
    </div> <!-- .container -->
    <div id="header-tile" style="background: <?php print '#fff'; if($logo) print ' url('.$logo.') no-repeat -575px 0px'; ?>;">&nbsp;</div>
  </div> <!-- #header -->
  <div id="headerbar">&nbsp;</div>

  <?php include($is_front ? "front.tpl.php" : "inner.tpl.php"); ?>

  <hr id="footer-border"/>
  <div id="footer">
    <div class="container">
      <?php if(true || !$is_front){ ?>
        <a href="http://artsandsciences.osu.edu/" id="small-banner-2" title="Arts and Sciences homepage">&nbsp;</a>
      <?php } ?>
      <div id="contact" class="span-7 append-1">
        <?php print $contact_region; ?>
      </div><!-- .contact -->
      <div id="footer-right" class="span-16 last">
        <div id="footer-top" class="span-16 last">
          <?php print $footer; ?>
        </div>
        <div id="footer-bottom" class="span-16 last">
          <?php print $footer_menu; ?>
        </div>
      </div>
    </div><!-- .container -->
  </div><!-- #footer -->

  <div id="footer_copyright" class="clearfix">
    <div class="small">
      <p>&copy; <?php print date("Y"); ?>, The Ohio State University, College of Arts and Sciences</p>
      <?php include("icons/uicons_basic.php"); ?>
    </div>
  </div>


<?php print $closure;?>

</body>

</html>

