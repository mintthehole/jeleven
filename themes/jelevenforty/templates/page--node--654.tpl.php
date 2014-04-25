<?php
?>
  
 <?php //** jelevenforty - WFTW HOME PAGE TEMPLATE **// ?>

 <?php 
    // Retrieving the year get parameter 
    $year=$_GET['y']; 
    $month=$_GET['m'];
    //Data sanitization
  if(isset($year)){
     if(($year<2001)||($year>date('Y'))){
      $year=date('Y');  // if the parameter is not the date value then it will reassign current year 
      }
    }
    if(isset($month)){
     if(($month<01)||($month>12)){
      $month=01; // if the parameter is not the date value then it will reassign jan month
      }
    }

    //ENDS- Data sanitization
    // if the year parameter is not set then use the current year
    if(!isset($year)){$year=date('Y');
       $str_date=substr((date('Y-m-d')),0,8)."01"; 
       $end_date= date('Y-m-d',strtotime($str_date . "+1 month"));

    }elseif( (isset($year))&&(!isset($month)) ){
       $str_date=$year."-01-01"; 
       $end_date= date('Y-m-d',strtotime($str_date . "+1 month"));

    }elseif( (isset($year))&&(isset($month)) ){
       $str_date=$year."-".$month."-01"; 
       $end_date= date('Y-m-d',strtotime($str_date . "+1 month"));

    }

    //echo date('Y');
    //echo $year;
    //echo $month;
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
    <div id="wftw_month_bar">
    <h2><?php echo $year;?></h2>
      <ul class="wftw_month_bar">
        <?php
          $i = 1;
          foreach (date_month_names(true) as $mon) {
        ?>
          <li <?php if($month==$i) echo 'class="current"';?>>
              <a href="http://localhost/labs/?q=wftw&y=<?php echo $year;?>&m=<?php echo $i;?>"> 
              <?php echo $mon; ?>
              </a>
            </li>

        <?php
          $i++;
         }
        ?>
      </ul>​
    </div><!--ENDS wftw_month_bar -->

    <?php $nodes = get_nodes_for_content_type_wftw_with_date_range('wftw',strtotime($str_date),strtotime($end_date)); // custom function
    	$options = array('absolute' => TRUE);
     ?>
    <?php 		
		foreach ($nodes as $node) {
	?>
		<section class="wftw-home-excerpts">
			<?php $url = url('node/' . $node->nid, $options); ?>
			<h3><?php print '<a href="'.$url.'">'. $node->title.' </a>';  ?>
			</h3>
			<?php print drupal_render( field_view_field('node', $node, 'field_wftw_author') );  ?>
			<span>
      <figure class="thumbnail"> <?php print drupal_render( field_view_field('node', $node, 'field_wftw_image') );  ?></figure>
      </span>
			
      <span id="description">
        <b>
          <?php $wftw_date_value = field_get_items('node', $node, 'field_wftw_date'); 
          $wftw_date = $wftw_date_value[0][value]; 
          echo format_date($wftw_date, 'custom', 'Y M j');
          ?>
        </b>
				<?php print drupal_render( field_view_field('node', $node, 'field_wftw_description') );  ?>
        <?php print drupal_render( field_view_field('node', $node, 'field_test_date') );  ?>
			</span>
			<span class="read-more"><?php print '<a href="'.$url.'">Read More</a>';  ?> </span>
		</section><!--ENDS class="article-home-excerpts" -->

	<?php 						  
		}
	?>		
    </div><!-- id="left-content" -->
    <div id="right-side-bar">
    <!--WFTW Filters -->
      <select class="wftw_year" ONCHANGE="location = this.options[this.selectedIndex].value;">
          <option>Year</option>
          <option value="http://localhost/labs/?q=wftw&y=2001">2001</option>
          <option value="http://localhost/labs/?q=wftw&y=2002">2002</option>
          <option value="http://localhost/labs/?q=wftw&y=2003">2003</option>
          <option value="http://localhost/labs/?q=wftw&y=2004">2004</option>
          <option value="http://localhost/labs/?q=wftw&y=2005">2005</option>
          <option value="http://localhost/labs/?q=wftw&y=2006">2006</option>
          <option value="http://localhost/labs/?q=wftw&y=2007">2007</option>
          <option value="http://localhost/labs/?q=wftw&y=2008">2008</option>
          <option value="http://localhost/labs/?q=wftw&y=2009">2009</option>
          <option value="http://localhost/labs/?q=wftw&y=2010">2010</option>
          <option value="http://localhost/labs/?q=wftw&y=2011">2011</option>
          <option value="http://localhost/labs/?q=wftw&y=2012">2012</option>
          <option value="http://localhost/labs/?q=wftw&y=2013">2013</option>
          <option value="http://localhost/labs/?q=wftw&y=2014">2014</option>
      </select>​

      <select class="wftw_month" ONCHANGE="location = this.options[this.selectedIndex].value;">
          <option>Month</option>
          <option value="http://localhost/labs/?q=wftw&y=<?php echo $year;?>&m=01">Jan</option>
          <option value="http://localhost/labs/?q=wftw&y=<?php echo $year;?>&m=02">Feb</option>
          <option value="http://localhost/labs/?q=wftw&y=<?php echo $year;?>&m=03">Mar</option>
          <option value="http://localhost/labs/?q=wftw&y=<?php echo $year;?>&m=04">Apr</option>
          <option value="http://localhost/labs/?q=wftw&y=<?php echo $year;?>&m=05">May</option>
          <option value="http://localhost/labs/?q=wftw&y=<?php echo $year;?>&m=06">Jun</option>
          <option value="http://localhost/labs/?q=wftw&y=<?php echo $year;?>&m=07">Jul</option>
          <option value="http://localhost/labs/?q=wftw&y=<?php echo $year;?>&m=08">Aug</option>
          <option value="http://localhost/labs/?q=wftw&y=<?php echo $year;?>&m=09">Sep</option>
          <option value="http://localhost/labs/?q=wftw&y=<?php echo $year;?>&m=10">Oct</option>
          <option value="http://localhost/labs/?q=wftw&y=<?php echo $year;?>&m=11">Nov</option>
          <option value="http://localhost/labs/?q=wftw&y=<?php echo $year;?>&m=12">Dec</option>
      </select>​
    <!-- ENDS WFTW Filters -->
    
    
	  <p> MOST READ ARTICLE</p>
    
    <!-- Subscribe to WFTW -->
        <?php 
            $block = block_load('block', '7');      //1 is the block id for Our Meeting
            $output = drupal_render(_block_get_renderable_array(_block_render_blocks(array($block))));        
            print $output;
            
        ?>

===================
<?php
//mktime(hour,minute,second,month,day,year);
//date('w',mktime(0,0,0,$month,$startdate,$year));
?>
====================


    <!-- ENDS Subscribe to WFTW -->
    </div><!-- id="right-side-bar" -->
  </div><!-- id="full-width" -->
  <footer>
    <?php print render($page['footer']); ?>
  </footer><!-- footer -->
</div><!-- id="body-wrapper" -->