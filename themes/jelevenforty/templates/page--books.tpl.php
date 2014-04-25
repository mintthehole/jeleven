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
        poll

      </center>

    </div> <!-- id="featured-header"  -->
  </div><!-- id="full-width" -->

  <div id="full-width">
    <h2>
      <?php print $title ?>
    </h2>
    <div class='container-fluid'>
      <div id="book_header" class='col-xs-12'>
        <div id='book_image' class="col-xs-3">
          <figure style="width:160px;vertical-align:middle">
            <?php print drupal_render( field_view_field('node', $node, 'field_book_cover_image') );  ?>
          </figure>
        </div>

        <div id="book_info" class="col-xs-5">
          <?php print drupal_render( field_view_field('node', $node, 'body') );  ?>
          <br>
          Author:
          <?php
          $author_val = field_get_items('node', $node, 'field_book_author');
          $author_id = $author_val[0][target_id];
          $author = node_load($author_id);
         ?>
         <?php print $author -> title ?>
         <br>
          Download Links
          <br>
          <div class='container-fluid'>
            <div class='col-xs-12'>
              <div class='col-xs-3 well'>
                 PDF:<?php print drupal_render( field_view_field('node', $node, 'field_book_pdf_file') );  ?>
              </div>
              <div class='col-xs-3 well'>
                Mobi <?php print drupal_render( field_view_field('node', $node, 'field_book_pdf_file') );  ?>
              </div>
              <div class='col-xs-3 well'>
                epub
              </div>
            </div>
          </div>
        </div>
        <div id="featured_book_div" class="col-xs-4 well">
          Featured Div
        </div>
    </div>
    <div class="container bs-docs-container">
      <div id="book_content" class="row">

        <div class="col-md-9" role="main">
          <div id="chapters" class="scroll">
            <div id="about">
              <?php print drupal_render( field_view_field('node', $node, 'field_about_this_book') );  ?>

            </div>


            <?php $chapters = get_nodes_for_content_type_with_chapters('bchapters',$node -> nid) ?>
            <hr>
            <?php
              $options = array('absolute' => TRUE);
            ?>
            <?php  foreach ($chapters as $chapter) {?>
              <?php $url = url('node/' . $chapter->nid, $options); ?>
              <div class='next jscroll-next hide'>
                <a href="<?php echo $url ?>" cid="<?php echo $chapter->nid; ?>">next page</a>
              </div>
            <?php }?>

          </div>
          </div>
        <div id="nav1wrap" class="col-xs-3">
          <div class="bs-docs-sidebar hidden-print affix-top">
            <ul class="nav bs-docs-sidenav">
              <li class="active chap_li about_book">
                <a href="#about">About This Book</a>
              </li>
              <?php
                $options = array('absolute' => TRUE);
              ?>
              <?php $chapters = get_nodes_for_content_type_with_chapters('bchapters',$node -> nid) ?>

                <?php     foreach ($chapters as $chapter) {?>
                  <li class="chap_li">
                    <?php print '<a  href="#'.$chapter->nid.'" id=chapter_'.$chapter->nid.'>'. $chapter->title.' </a>';  ?>
                </li><!--ENDS class="article-home-excerpts" -->

              <?php }?>


            </ul>
          </div>

        </div>
      </div>
    </div>

  </div><!-- id="full-width" -->

</div><!-- id="body-wrapper" -->
