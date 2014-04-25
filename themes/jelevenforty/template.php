<?php
/**
 * @file
 * Contains the theme's functions to manipulate Drupal's default markup.
 *
 * Complete documentation for this file is available online.
 * @see https://drupal.org/node/1728096
 */


/**
 * Override or insert variables into the maintenance page template.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("maintenance_page" in this case.)
 */
/* -- Delete this line if you want to use this function
function STARTERKIT_preprocess_maintenance_page(&$variables, $hook) {
  // When a variable is manipulated or added in preprocess_html or
  // preprocess_page, that same work is probably needed for the maintenance page
  // as well, so we can just re-use those functions to do that work here.
  STARTERKIT_preprocess_html($variables, $hook);
  STARTERKIT_preprocess_page($variables, $hook);
}
// */

/**
 * Override or insert variables into the html templates.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("html" in this case.)
 */
/* -- Delete this line if you want to use this function
function STARTERKIT_preprocess_html(&$variables, $hook) {
  $variables['sample_variable'] = t('Lorem ipsum.');

  // The body tag's classes are controlled by the $classes_array variable. To
  // remove a class from $classes_array, use array_diff().
  //$variables['classes_array'] = array_diff($variables['classes_array'], array('class-to-remove'));
}
// */

/**
 * Override or insert variables into the page templates.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("page" in this case.)
 *//* -- Delete this line if you want to use this function
*/
function jelevenforty_preprocess_page(&$variables, $hook) {
  if (isset($variables['node'])) {
   $variables['theme_hook_suggestions'][] = 'page__'. str_replace('_', '--', $variables['node']->type);
  }
  if (arg(0) == 'taxonomy' && arg(1) == 'term' && is_numeric(arg(2))) {
    $vars['theme_hook_suggestions'][] = 'page__taxonomy';
  }
}


/**
 * Override or insert variables into the node templates.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("node" in this case.)
 */
/* -- Delete this line if you want to use this function
function STARTERKIT_preprocess_node(&$variables, $hook) {
  $variables['sample_variable'] = t('Lorem ipsum.');

  // Optionally, run node-type-specific preprocess functions, like
  // STARTERKIT_preprocess_node_page() or STARTERKIT_preprocess_node_story().
  $function = __FUNCTION__ . '_' . $variables['node']->type;
  if (function_exists($function)) {
    $function($variables, $hook);
  }
}
// */

/**
 * Override or insert variables into the comment templates.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("comment" in this case.)
 */
/* -- Delete this line if you want to use this function
function STARTERKIT_preprocess_comment(&$variables, $hook) {
  $variables['sample_variable'] = t('Lorem ipsum.');
}
// */

/**
 * Override or insert variables into the region templates.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("region" in this case.)
 */
/* -- Delete this line if you want to use this function
function STARTERKIT_preprocess_region(&$variables, $hook) {
  // Don't use Zen's region--sidebar.tpl.php template for sidebars.
  //if (strpos($variables['region'], 'sidebar_') === 0) {
  //  $variables['theme_hook_suggestions'] = array_diff($variables['theme_hook_suggestions'], array('region__sidebar'));
  //}
}
// */

/**
 * Override or insert variables into the block templates.
 *
 * @param $variables
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("block" in this case.)
 */
/* -- Delete this line if you want to use this function
function STARTERKIT_preprocess_block(&$variables, $hook) {
  // Add a count to all the blocks in the region.
  // $variables['classes_array'][] = 'count-' . $variables['block_id'];

  // By default, Zen will use the block--no-wrapper.tpl.php for the main
  // content. This optional bit of code undoes that:
  //if ($variables['block_html_id'] == 'block-system-main') {
  //  $variables['theme_hook_suggestions'] = array_diff($variables['theme_hook_suggestions'], array('block__no_wrapper'));
  //}
}
// */

// Function to get the nodes of content type by passinbg the content type and range
function get_nodes_for_content_type($content_type,$range){
  $nodes = array();
  $options = array('absolute' => TRUE);
  $query = new EntityFieldQuery();
  $query
   ->entityCondition('entity_type', 'node')
   ->entityCondition('bundle', $content_type)
   ->propertyCondition('status', 1)
   ->propertyOrderBy('created', 'DESC')
   ->range(0, $range);
  $result = $query->execute();
  if (!empty($result['node'])) {
    $subtitle_nids = array_keys($result['node']);
    $nodes = node_load_multiple($subtitle_nids);
    return $nodes;
  }
  return $content_type;
}
// Ends get_nodes_for_content_type



// Function to get the node from id
function get_node_for_id($content_type,$id){
  $query = new EntityFieldQuery();
  $entities = $query->entityCondition('entity_type', 'node')
  ->entityCondition('bundle',$content_type )
  ->propertyCondition('id', $id)
  ->range(0,1)
  ->execute();

  if (!empty(
  $entities['node'])) {
    $node = node_load(array_shift(array_keys($entities['node'])));
  }
}
// Function to get the node from id


// Start get_nodes_for_content_type_with_series
function get_nodes_for_content_type_with_series($content_type,$range,$series_id){
  $nodes = array();
  $options = array('absolute' => TRUE);
  $query = new EntityFieldQuery();
  $query
   ->entityCondition('entity_type', 'node')
   ->entityCondition('bundle', $content_type)
   ->propertyCondition('status', 1)
   ->propertyOrderBy('created', 'DESC')
   ->fieldCondition('field_sermons_', 'target_id', $series_id, '=');
   if ($range){
    $query->range(0, $range);
   }


  $result = $query->execute();
  if (!empty($result['node'])) {
    $subtitle_nids = array_keys($result['node']);
    $nodes = node_load_multiple($subtitle_nids);
    return $nodes;
  }
  return $content_type;
}
// Ends get_nodes_for_content_type_with_series


// Start get_nodes_for_content_type_with__no_series
function get_nodes_for_content_type_with_no_series($content_type,$range){
  $nodes = array();
  $options = array('absolute' => TRUE);
  $query = new EntityFieldQuery();
  $query
   ->entityCondition('entity_type', 'node')
   ->entityCondition('bundle', $content_type)
   ->propertyCondition('status', 1)
   ->propertyOrderBy('created', 'DESC')
   ->fieldCondition('field_sermons_', 'target_id', 'NULL', '<>');
   // $query->addTag('node_access');
   // ->addTag('node_access');
  $result = $query->execute();
  if (!empty($result['node'])) {
    $sub_query = new EntityFieldQuery();
    $sub_query
     ->entityCondition('entity_type', 'node')
     ->entityCondition('bundle', $content_type)
     ->propertyCondition('status', 1)
     ->propertyOrderBy('created', 'DESC')
     ->entityCondition('entity_id', array_keys($result['node']), 'NOT IN')
     ->addTag('node_access')
     ->range(0, $range);
     $sub_result = $sub_query->execute();
     if (!empty($sub_result['node'])) {
       $sub_nids = array_keys($sub_result['node']);
       $nodes = node_load_multiple($sub_nids);
       return $nodes;
     }
  }
  return $content_type;
}
// Ends get_nodes_for_content_type_with__no_series


// Start get_nodes_for_content_type_wftw_with_date_range
function get_nodes_for_content_type_wftw_with_date_range($content_type,$str_date,$end_date){
  $nodes = array();
  $options = array('absolute' => TRUE);
  $query = new EntityFieldQuery();
  $query
   ->entityCondition('entity_type', 'node')
   ->entityCondition('bundle', $content_type)
   ->propertyCondition('status', 1)
   ->propertyOrderBy('created', 'DESC')
   ->fieldCondition('field_wftw_date', 'value', array($str_date,$end_date), 'BETWEEN');

  $result = $query->execute();
  if (!empty($result['node'])) {
    $subtitle_nids = array_keys($result['node']);
    $nodes = node_load_multiple($subtitle_nids);
    return $nodes;
  }
  return $content_type;
}
// Ends get_nodes_for_content_type_wftw_with_date_range


// Build a dropdown for category
  function build_category_dropdown($cont_type){
    $name = 'tags';
    $myvoc = taxonomy_vocabulary_machine_name_load($name);
    $tree = taxonomy_get_tree($myvoc->vid);
    $drop = '<select ONCHANGE="location = this.options[this.selectedIndex].value;">';
    $drop .= "<option>Category</option>";
    foreach ($tree as $term) {

$term1 = taxonomy_term_load($term->tid); // load term object
//print_r($term1);
      $term_uri = taxonomy_term_uri($term1); // get array with path
      $term_title = taxonomy_term_title($term1);
      $term_path = $term_uri['path'];
 //$link = l($term_title,$term_path);
//echo drupal_get_path_alias($term_path);
     //print_r($term);
     // print_r(drupal_get_path_alias(taxonomy_term_uri($term->vid)));
       $drop .= "<option value='";
       $drop .= "http://localhost/labs/?q=".$cont_type."-by-category/".drupal_get_path_alias($term_path);
       $drop .= "'>";
       $drop .= $term->name;
       $drop .= "</option>";
    }
  $drop .= '</select>';
  return $drop;
}

// Ends  Build a dropdown for category

// Build a category menu
  function build_category_menu(){
    $name = 'tags';
    $myvoc = taxonomy_vocabulary_machine_name_load($name);
    $tree = taxonomy_get_tree($myvoc->vid);
    $drop = '<ul class="cat-menu">';
      foreach ($tree as $term) {

      $term1 = taxonomy_term_load($term->tid); // load term object
//print_r($term1);
      $term_uri = taxonomy_term_uri($term1); // get array with path
      $term_title = taxonomy_term_title($term1);
      $term_path = $term_uri['path'];
 //$link = l($term_title,$term_path);
//echo drupal_get_path_alias($term_path);
     //print_r($term);
     // print_r(drupal_get_path_alias(taxonomy_term_uri($term->vid)));
       $drop .= '<li><a href=';
       $drop .= '"http://localhost/labs/?q='.drupal_get_path_alias($term_path).'">';
       $drop .= $term->name;
       $drop .= "</a>";
       $drop .= "</li>";
    }
  $drop .= '</ul><!--ENDS cat-menu -->';
  return $drop;
}

// Ends  Build a category menu

/** Colorbox code **/

//drupal_add_js(drupal_get_path('theme', 'jeleven40').'js/jquery.min.js', array('weight' => JS_THEME));
drupal_add_css(drupal_get_path('theme', 'jelevenforty').'/css/bootstrap.min.css');
drupal_add_js(drupal_get_path('theme', 'jelevenforty').'/js/endless.js');
drupal_add_js(drupal_get_path('theme', 'jelevenforty').'/js/jelevenforty.js');

drupal_add_js(drupal_get_path('theme', 'jelevenforty').'/js/jquery.colorbox.js');
drupal_add_js(drupal_get_path('theme', 'jelevenforty').'/js/jquery.js');
drupal_add_js(drupal_get_path('theme', 'jelevenforty').'/js/docs.js');
drupal_add_js(drupal_get_path('theme', 'jelevenforty').'/js/bootstrap.js');



/* ENDS - Colorbox code */



// Start get_nodes_for_book_chapters
function get_nodes_for_content_type_with_chapters($content_type,$chap_id){
  $nodes = array();
  $options = array('absolute' => TRUE);
  $query = new EntityFieldQuery();
  $query
   ->entityCondition('entity_type', 'node')
   ->entityCondition('bundle', $content_type)
   ->propertyCondition('status', 1)
   ->propertyOrderBy('created', 'ASC')
   ->fieldCondition('field_book_title', 'target_id', $chap_id, '=');



  $result = $query->execute();
  if (!empty($result['node'])) {
    $subtitle_nids = array_keys($result['node']);
    $nodes = node_load_multiple($subtitle_nids);
    return $nodes;
  }

  return $content_type;
}
// Ends get_nodes_for_book_chapters