<?php
/**
 * @file
 * Returns the HTML for a node.
 *
 * Complete documentation for this file is available online.
 * @see https://drupal.org/node/1728164
 */
?>
<?php
?>
  


  <div id="body-wrapper">
    <header>
      <?php   print render($page['header']);  ?>
    </header>
  </div>
  <div id="full-width">

    <?php print $breadcrumb; ?>
    <!-- Admin Menu Starts Here -->
      <?php if ($tabs): ?><?php print render($tabs); ?></div><?php endif; ?>
    <!-- Ends - Admin Menu -->
  </div>
  <div id="full-width">
    <div id="featured-header">
      <center>
        
        
      </center>

    </div> <!-- id="featured-header"  -->
  </div><!-- id="full-width" -->

  <div id="full-width">
    <div id="left-content">
      <h2>
        <?php print $title ?>
      </h2>
      <?php print render($page['content']); ?> 
      <?php print render($page['content']); ?>   
        <?php // custom function
          $options = array('absolute' => TRUE);
         ?>
        <ul>
         <?php $sermon_nodes = get_nodes_for_content_type_with_series('sermon',null,$node->nid); // custom function
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
    </div><!-- id="left-content" -->
    <div id="right-side-bar">
  <?php   print render($page['highlighted']);  ?>      
    </div><!-- id="right-side-bar" -->
  </div><!-- id="full-width" -->
  <footer>
    <?php print render($page['footer']); ?>
  </footer><!-- footer -->
</div><!-- id="body-wrapper" -->
