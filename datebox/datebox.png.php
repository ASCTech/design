<?php

$parseddate = str_replace(" (All day)", "", $_GET['d']);

$date = strtotime(strip_tags($parseddate));

if(!$date){
  print "No date";
  exit;
}

header("Content-Type: image/x-png");

$d = date("D", $date);      // Top text
$j = date("j", $date);      // Middle text
$m = date("M", $date);      // Bottom text
$w = 40;                    // Image width
$h = 45;                    // Image height
$font1 = "arialbd";         // Font for top and bottom text
$font2 = "arialbd";         // font for middle text
$fs1 = 7;                   // Font size for top and bottom text
$fs2 = 16;                  // Font size for middle text
$pad = 3;                   // Vertical padding between text and edge


// Themes

// Default background color R, G, B
$br = 113;
$bg = 116;
$bb = 0;

// Default foreground color R, G, B
$fr = 255;
$fg = 255;
$fb = 255;

switch($_GET['t']){
  case 1: // Greenish Brown
    $br = 113;
    $bg = 116;
    $bb = 0;
  break;
  case 2: // ASC Orange
    $br = 220;
    $bg = 133;
    $bb = 5;
  break;
  case 3: // ASC Neutral
    $br = 144;
    $bg = 135;
    $bb = 121;
  break;
  case 4: // QuickSites Default
    $fr = 255;
    $fg = 255;
    $fb = 255;
    $br = 144;
    $bg = 135;
    $bb = 121;
  break;
  case 5: // QuickSites Default
    $fr = 255;
    $fg = 255;
    $fb = 255;
    $br = 37;
    $bg = 109;
    $bb = 143;
  break;
}

$img = imagecreatetruecolor($w, $h);

$bgc = imagecolorallocate($img, $br, $bg, $bb); // Background color
$fgc = imagecolorallocate($img, $fr, $fg, $fb); // Foreground color

// End Themes
function hcenter($width){
  return round(($GLOBALS['w'] - $width) / 2);
}

imagefill($img, 0, 0, $bgc);

$bb = imagettfbbox($fs1, 0, $font1, strtoupper($d));
imagettftext($img, $fs1, 0, hcenter($bb[2]), -$bb[5]+$pad, $fgc, $font1, strtoupper($d));

$bb = imagettfbbox($fs2, 0, $font2, $j);
imagettftext($img, $fs2, 0, hcenter($bb[2]), ceil(($h-$bb[5])/2), $fgc, $font2, $j);

$bb = imagettfbbox($fs1, 0, $font1, strtoupper($m));
imagettftext($img, $fs1, 0, hcenter($bb[2]), $h-$pad, $fgc, $font1, strtoupper($m));

imagepng($img, NULL, 0);
imagedestroy($img);

?>