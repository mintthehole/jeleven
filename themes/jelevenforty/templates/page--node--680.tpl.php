<?php
?>
  <?php //** jelevenforty - STUDY SERIES TEMPLATE **// ?>


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
    <?php $nodes = get_nodes_for_content_type('studyseries',4); // custom function
      $options = array('absolute' => TRUE);
     ?>
    <ul>
    
    <?php     foreach ($nodes as $node) {?>
      <li class="sermons-listing">
        <?php $url = url('node/' . $node->nid, $options); ?>
        <h5>
          <?php print '<a href="'.$url.'">'. $node->title.' </a>';  ?>
        </h5>
        <ul>
         <?php $sermon_nodes = get_nodes_for_content_type_with_series('sermon',4,$node->nid); // custom function
         ?>
         <?php  foreach ($sermon_nodes as $sermon_node) { ?>
          <li>
            <?php $sermon_url = url('node/' . $sermon_node->nid, $options); ?>
            <h6>
              <?php print '<a href="'.$sermon_url.'">'. $sermon_node->title.' </a>';  ?>
            </h6>
          </li>
         <?php }?>
        </ul>

    </li><!--ENDS class="article-home-excerpts" -->

  <?php }?>
  </ul>    
    </div><!-- id="left-content" -->
    <div id="right-side-bar">
    <?php echo build_category_dropdown("sermon"); ?>
    <!-- Recent Sermons List -->
    <?php
        $block = block_load('views', 'recent_sermons_view-block');      
        $output = drupal_render(_block_get_renderable_array(_block_render_blocks(array($block))));        
        print $output;
    ?>

   <!-- ENDS - Recent Sermons List --> 
    
	  
    </div><!-- id="right-side-bar" -->
  </div><!-- id="full-width" -->
  <footer>
    <?php print render($page['footer']); ?>
  </footer><!-- footer -->
</div><!-- id="body-wrapper" -->