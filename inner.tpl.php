<?php if ($node->type == 'blog' || $title == 'Open Studio') { print '<div id="blognode">'; } ?>
  <?php if($breadcrumb){ ?>
  <div id="breadcrumb-filler">&nbsp;</div>
  <?php } ?>
  <div id="header-shadow">&nbsp;</div>
  <div id="main-content" class="container">
    <a id="page-content"></a>
    <?php if($right){ ?><div class="clearfix" id="sidebar-filler"><div class="clearfix"><?php } ?>
      <?php if($breadcrumb){ ?>
      <div id="breadcrumb"><?php print $breadcrumb ?> &gt; <?php print $title; ?></div>
      <?php } ?>
      <div class="span-<?php $right ? print "16" : print "24"; ?>" id="leftcontent">

        <?php if($messages){ ?>
          <div id="message"><?php print $messages ?></div>
        <?php } ?>
        <?php if($tabs){ ?>
          <?php print $tabs ?>
        <?php } ?>
        <?php if($title && (!$node->type || !in_array($node->type, $no_title_node_types))){ ?>
        <?php if ($node->type != 'blog' && $title != 'Open Studio') { print '<h1 id="title">' . $title . '</h1>'; } ?>
        <?php } ?>

        <div class="content">
          <?php print $before_content ?>
          <?php print $content ?>
          <?php print $after_content ?>
        </div>

      </div><!-- #leftcontent-nostyle -->

      <?php if($right){ ?>
        <div class="span-6 last" id="sidebar">
          <?php print $right; ?>
        </div> <!-- #sidebar -->
      <?php } ?>
    <?php if($right){ ?></div></div><?php } ?>
  </div>
<?php if ($node->type == 'blog' || $title == 'Open Studio') { print '</div>'; } ?>