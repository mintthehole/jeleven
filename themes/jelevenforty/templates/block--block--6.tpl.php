<?php
//** jelevenforty - HEADER BLOCK **//

/**
 * @file
 * Default theme implementation to display a block.
 *
 * Available variables:
 * - $block->subject: Block title.
 * - $content: Block content.
 * - $block->module: Module that generated the block.
 * - $block->delta: An ID for the block, unique within each module.
 * - $block->region: The block region embedding the current block.
 * - $classes: String of classes that can be used to style contextually through
 *   CSS. It can be manipulated through the variable $classes_array from
 *   preprocess functions. The default values can be one or more of the
 *   following:
 *   - block: The current template type, i.e., "theming hook".
 *   - block-[module]: The module generating the block. For example, the user
 *     module is responsible for handling the default user navigation block. In
 *     that case the class would be 'block-user'.
 * - $title_prefix (array): An array containing additional output populated by
 *   modules, intended to be displayed in front of the main title tag that
 *   appears in the template.
 * - $title_suffix (array): An array containing additional output populated by
 *   modules, intended to be displayed after the main title tag that appears in
 *   the template.
 *
 * Helper variables:
 * - $classes_array: Array of html class attribute values. It is flattened
 *   into a string within the variable $classes.
 * - $block_zebra: Outputs 'odd' and 'even' dependent on each block region.
 * - $zebra: Same output as $block_zebra but independent of any block region.
 * - $block_id: Counter dependent on each block region.
 * - $id: Same output as $block_id but independent of any block region.
 * - $is_front: Flags true when presented in the front page.
 * - $logged_in: Flags true when the current user is a logged-in member.
 * - $is_admin: Flags true when the current user is an administrator.
 * - $block_html_id: A valid HTML ID and guaranteed unique.
 *
 * @see template_preprocess()
 * @see template_preprocess_block()
 * @see template_process()
 *
 * @ingroup themeable
 */
?>
<div id="<?php print $block_html_id; ?>" class="<?php print $classes; ?>"<?php print $attributes; ?>>
<!-- Custom Header Starts Here -->
  <div id="full-width">
    <div id="top-menu-left">
    <!--Language Menu -->
     <ul class="lang-menu">
        <?php
        $domains = domain_domains();
        ?>
        <?php
        foreach ($domains as $domain) {
        ?>
          <li><a href="<?php echo $domain["path"]; ?>"><?php echo $domain["sitename"]; ?></a></li>

        <?php
        }
        ?>

        </ul>
      <!-- ENDS Language Menu-->
    </div>
    <div id="top-menu-right">
      <?php $main_menu = menu_navigation_links('main-menu'); ?>
      <?php if ($main_menu): ?>
        <div id="main-menu" class="navigation">
          <?php print theme('links__system_main_menu', array(
            'links' => $main_menu,
            'attributes' => array(
              'id' => 'main-menu-links',
              'class' => array('links', 'clearfix'),
            ),
            'heading' => array(
              'text' => t('Main menu'),
              'level' => 'h2',
              'class' => array('element-invisible'),
            ),
          )); ?>
        </div> <!-- /#main-menu -->
      <?php endif; ?>
    </div>
    <div id="site-header">
      <!-- LOGO Starts Here: Code To Retrive The Logo -->
      Logo
        <?php 
          global $base_url;
          drupal_theme_initialize();
        
          if (!$logo = theme_get_setting('logo_path')) {
              $logo = theme_get_setting('logo');
               ?>
              <img src="<?php echo $logo;?>" alt="<?php echo $logo;?>" title="<?php echo $logo;?>" id="logo">
              <?php
          }

          if (!empty($logo)) {
            // [1]
            // Remove the base URL from the result returned by theme_get_setting('logo').
            // If you don't need the relative path, you can remove this code.
            if (strpos($logo, $base_url) === 0) {
            $logo = drupal_substr($logo, drupal_strlen($base_url));
             ?>
              <img src="<?php echo $logo;?>" alt="<?php echo $logo;?>" title="<?php echo $logo;?>" id="logo">
              <?php
            }
            // [1]
            // …
          }
          ?>
      <!-- ENDS Code To Retrive The Logo -->    
      <div class="pull-right">
        Serach
      </div>
    </div>
    <div id="primary-menu" class="pull-right">
       <?php echo build_category_menu(); ?>
    </div>
  </div>
<!-- ENDS - Custom Header  -->
</div><!-- id="<?php print $block_html_id; ?>" -->
