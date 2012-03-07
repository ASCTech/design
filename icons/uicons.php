<p>
	If you are having trouble accessing this site and need to<br />
	request an alternate format, please contact: <a href="http://artsandsciences.osu.edu/contact/contact.cfm">Web Manager</a>
</p>
<p>

<?php $theme_path = base_path() . path_to_theme(); ?>

<?php if(user_is_logged_in()) { ?>
  <a href="http://jigsaw.w3.org/css-validator/check/referer" style="margin-right: 5px; text-decoration: none; border-bottom: none;"><img src="<?php print $theme_path; ?>/icons/w3c_css.png" height="13px" title="Validate CSS" alt="Validate CSS" /></a>
	<a href="http://validator.w3.org/check?uri=referer" style="margin-right: 5px; text-decoration: none; border-bottom: none;"><img src="<?php print $theme_path; ?>/icons/w3c_xhtml.png" height="13px" title="Validate XHTML" alt="Validate XHTML" /></a>
<?php } ?>

<?php if(!user_is_logged_in()) { ?>
	<a href="<?php base_path();?>user/login?<?=drupal_get_destination();?>" style="text-decoration: none; border-bottom: none;"><img src="<?php print $theme_path; ?>/icons/user.gif" height="13px" title="Site Administrator Login" alt="Site Administrator Login" /></a>
<?php } else { ?>
	<a href="<?php base_path();?>logout?<?=drupal_get_destination();?>" style="text-decoration: none; border-bottom: none;"><img src="<?php print $theme_path; ?>/icons/user_out.gif" height="13px" title="Logout" alt="Logout" /></a>
<?php } ?>
</p>

<script type="text/javascript">
var oldonload = window.onload;
var newonload = function(){
	if(document.getElementById("edit-name")){
		document.getElementById("edit-name").focus();
	}
};
if(typeof window.onload != 'function'){
	window.onload = newonload;
}else{
	window.onload = function(){
		oldonload();
		newonload();
	};
}
</script>
