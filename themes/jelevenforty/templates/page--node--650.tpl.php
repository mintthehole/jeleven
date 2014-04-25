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
    <?php $nodes = get_nodes_for_content_type('books',2); // custom function
    	$options = array('absolute' => TRUE);
     ?>
    <?php 		
		foreach ($nodes as $node) {
	?>
		<section class="book-home-excerpts">
			<?php $url = url('node/' . $node->nid, $options); ?>
			<h3><?php print '<a href="'.$url.'">'. $node->title.' </a>';  ?>
			</h3>
			<?php print drupal_render( field_view_field('node', $node, 'field_book_author') );  ?>
			<span><figure class="thumbnail"> <?php print drupal_render( field_view_field('node', $node, 'field_book_thumbnail') );  ?></figure></span>
			<span id="description">
				<?php print drupal_render( field_view_field('node', $node, 'field_about_this_book') );  ?>
			</span>
			<span class="read-more"><?php print '<a href="'.$url.'">Read More</a>';  ?> </span>
		</section><!--ENDS class="article-home-excerpts" -->

	<?php 						  
		}
	?>		
    </div><!-- id="left-content" -->
    <div id="right-side-bar">
      <center>
        Right Nav
      </center>
    </div><!-- id="right-side-bar" -->
  </div><!-- id="full-width" -->
  <footer>
    <?php print render($page['footer']); ?>
  </footer><!-- footer -->
</div><!-- id="body-wrapper" -->