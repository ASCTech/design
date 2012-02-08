<?php
// $Id: calendar-year.tpl.php,v 1.6.2.1 2008/06/14 11:38:34 karens Exp $
/**
 * @file
 * Template to display a view as a calendar year.
 * 
 * @see template_preprocess_calendar_year.
 *
 * $view: The view.
 * $months: An array with a formatted month calendar for each month of the year.
 * $min_date_formatted: The minimum date for this calendar in the format YYYY-MM-DD HH:MM:SS.
 * $max_date_formatted: The maximum date for this calendar in the format YYYY-MM-DD HH:MM:SS.
 * 
 */
//dsm('Display: '. $display_type .': '. $min_date_formatted .' to '. $max_date_formatted);

	$view_arg = "";
	if($active_date = strtotime(basename($_GET['q']))){
		$view_arg = basename($_GET['q']);
	}else{
		$active_date = time();
		$view_arg = date("Y-m");
	}
?>

<div class="calendar-calendar"><div class="year-view">
<table class="mini">
  <tbody>
		<tr><td><?php print $months[intval(date("n", $active_date))]; ?></td></tr>  
  </tbody>
</table>
</div></div>