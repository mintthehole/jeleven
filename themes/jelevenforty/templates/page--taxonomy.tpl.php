<?php
?>



  <div id="body-wrapper">
  	<header>
  		<?php   print render($page['header']);  ?>
  	</header>
  </div>
  <div id="full-width">
  	<h2>
  		<?php print $title ?>
  	</h2>
  	<?php print $breadcrumb; ?>
  	<!-- Admin Menu Starts Here -->
  		<?php if ($tabs): ?><?php print render($tabs); ?></div><?php endif; ?>
  	<!-- Ends - Admin Menu -->
  </div>
  <div id="full-width">
    <div id="featured-header">
      <center>

        <?php //print render($page['content']); ?>
      </center>

    </div> <!-- id="featured-header"  -->
  </div><!-- id="full-width" -->

  <div id="full-width">
    <div id="left-content">

    <?php $tid = taxonomy_term_load(arg(2))->tid; ?>
    <?php echo($tid); ?>

    </div><!-- id="left-content" -->
    <div id="right-side-bar">
	  <?php   print render($page['highlighted']);  ?>
    </div><!-- id="right-side-bar" -->
  </div><!-- id="full-width" -->
  <footer>
    <?php print render($page['footer']); ?>
  </footer><!-- footer -->
</div><!-- id="body-wrapper" -->