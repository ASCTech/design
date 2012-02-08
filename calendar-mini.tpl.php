<?php
// $Id: calendar-mini.tpl.php,v 1.1.2.6 2008/11/23 01:46:21 karens Exp $
/**
 * @file
 * Template to display a view as a mini calendar month.
 * 
 * @see template_preprocess_calendar_mini.
 *
 * $day_names: An array of the day of week names for the table header.
 * $rows: An array of data for each day of the week.
 * $view: The view.
 * $min_date_formatted: The minimum date for this calendar in the format YYYY-MM-DD HH:MM:SS.
 * $max_date_formatted: The maximum date for this calendar in the format YYYY-MM-DD HH:MM:SS.
 * 
 * $show_title: If the title should be displayed. Normally false since the title is incorporated
 *   into the navigation, but sometimes needed, like in the year view of mini calendars.
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

<div class="calendar-calendar"><div class="month-view">
	<?php if ($view->date_info->show_title): ?>
	  <?php print theme('date_navigation', $view); ?>
	<?php endif; ?>
<table class="mini">
  <thead>
    <tr>
      <?php foreach ($day_names as $cell): ?>
        <th class="<?php print $cell['class']; ?>">
          <?php print ($cell['data'] == "Thu") ? "R" : $cell['data'][0]; ?>
        </th>
      <?php endforeach; ?>
    </tr>
  </thead>
  <tbody>
    <?php foreach ((array) $rows as $row): ?>
      <tr>
        <?php foreach ($row as $cell): ?>
			<?php /* "Fix" the year bug*/ $cell['id'] = str_replace(date("-Y-"), date("-Y-", $active_date), $cell['id']); ?>
			<?php /* "Fix" the year bug*/ $cell['data'] = str_replace(date("/Y-"), date("/Y-", $active_date), $cell['data']); ?>
			<?php $linkdate = str_replace('Events-', '', $cell['id']); ?>
	          <td id="<?php print $cell['id']; ?>" class="<?php print $cell['class'].(preg_match("/-$view_arg$/", $cell['id']) ? " active":''); ?>">
	            <a href="/events/<?php print $linkdate; ?>" title="View events on <?php print $linkdate; ?>"><?php print $cell['data']; ?></a>
	          </td>
        <?php endforeach; ?>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>
</div></div>