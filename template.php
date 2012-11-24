<?php
/**
 * @file
 *
 */

/**
 * Preprocess variables for node.tpl.php
 */
function caffeinated_preprocess_node(&$variables) {

  // Make tags.
  $items = field_get_items('node', $variables['node'], 'taxonomy_vocabulary_1');
  foreach ($items as $item) {
    $tags[] = field_view_value('node', $variables['node'], 'taxonomy_vocabulary_1', $item);
  }
  foreach ($tags as &$tag) {
    $tag['#title'] = '&' . $tag['#title'];
    $display_tags[] = render($tag);
  }
  $variables['tags'] = count($display_tags) ? t('In categories !tags', array('!tags' => implode('&nbsp; ', $display_tags))) : '';

  // Make a prettier "submitted" string.
  $variables['submitted'] = t('Posted by !user on @date.', array(
    '@date' => format_date($variables['created'], 'custom', 'l j F Y'),
    '!user' => theme('username', array('account' => $variables['user'])),
  ));

  unset($variables['content']['links']['blog']);
}

/**
 * Preprocess regions.
 */
function caffeinated_preprocess_region(&$variables) {
  if ($variables['region'] == 'sidebar_second') {
    $variables['classes_array'][] = 'well';
  }
}
