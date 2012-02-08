    <div id="front-header">
      <div class="container">
        <div id="front-image" class="span-12 append-1">
          <?php print $front_image; ?>
        </div>
        <div id="front-content" class="span-12">
          <?php print $before_content ?>
          <?php print $after_content ?>
        </div>
      </div>
      <div id="front-header-tile">
        <div id="front-links" class="span-8 append-3">
          <?php print $front_links; ?>
        </div>
      </div>
      <div id="front-header-banner">
        <div class="container">
          <a href="http://artsandsciences.osu.edu/" id="aslink" title="Arts and Sciences homepage">&nbsp;</a>
        </div>
      </div>
    </div>

<!-- Content -->
    <div id="main-content" class="container">
      <a id="page-content"></a>
      <div>
        <div class="content"><div>
          <?php if($messages){ ?>
            <div id="message"><?php print $messages; ?></div>
          <?php } ?>

          <div id="features">
            <div id="front_block1" class="feature span-6">
              <div class="content">
                <?php print $events; ?>
              </div>
            </div>
            <div id="front_block2" class="feature span-6 last">
              <div class="content">
                <?php print $openstudio; ?>
              </div>
            </div>
            <div id="front_block3" class="feature span-12 last">
              <div class="content">
                <?php print $people; ?>
              </div>
            </div>
          </div>
        </div>
      </div>

      </div><!-- #leftcontent-nostyle -->

    </div>