<div id="node-<?php print $nid ?>" class="node<?php print ($sticky && $page == 0) ? " sticky" : ""; ?><?php print ($page == 0) ? " teaser" : " "; ?><?php print ' ' . ($node->type); ?><?php print ($submitted && !$page) ? " cal" : ""?>">
<?php print $picture ?>
<?php if ($page == 0) { ?>
  <h2 class="title"><a href="<?php print $node_url ?>"><?php print $title ?></a></h2>
  <?php if ($author || $terms) { ?>
    <div class="submitted">
    <?php if ($terms) { ?>
      <span class="taxonomy"><?php print $terms ?></span>
    <?php } ?>
    </div>
  <?php } ?>
<?php } ?>
<div class="content"><?php print $content ?></div>
<?php if ($links && $page == 0){ ?>
  <div class="links">&raquo; <?php print $links ?></div>
<?php } ?>
<?php if ($page) { ?>
  <div class="meta">

 <?php if ($terms) { ?>
   <div class="taxonomy"><?php print $terms ?></div>
 <?php } ?>

 </div>
<?php } ?>
</div>
