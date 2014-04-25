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
        
        <?php print render($page['content']); ?>
      </center>

    </div> <!-- id="featured-header"  -->
  </div><!-- id="full-width" -->

  <div id="full-width">
    <div id="left-content">
    <?php $nodes = get_nodes_for_content_type_with_no_series('sermon',4); // custom function
      $options = array('absolute' => TRUE);
     ?>
    <ul>
    <?php     foreach ($nodes as $node) {?>
      <li class="sermons-listing">
        <?php $url = url('node/' . $node->nid, $options); ?>
        <h5>
          <?php print '<a href="'.$url.'">'. $node->title.' </a>';  ?>
        </h5>
    </li><!--ENDS class="article-home-excerpts" -->

  <?php }?>
  </ul>    
    </div><!-- id="left-content" -->
    <div id="right-side-bar">
	<?php   print render($page['highlighted']);  ?>      
    </div><!-- id="right-side-bar" -->
  </div><!-- id="full-width" -->
  <footer>
    <?php print render($page['footer']); ?>
  </footer><!-- footer -->
</div><!-- id="body-wrapper" -->