<div class="block block-<? print $block->module?>" id="block-<?php print $block->module . "-" . $block->delta ?>">
	<?php if($block->subject){ ?>
	<h3><?php print $block->subject; ?></h3>
	<?php } ?>
	<div class="content"><?php print $block->content ?></div>
</div>

