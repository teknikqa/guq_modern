<?php
/**
 * @file
 * Display Suite 1 column template.
 */
// Check the style.

if (count($node->field_news_front_style) > 0) {
  $field_news_front_style_lang = field_language('node', $node, 'field_news_front_style');
  $style = trim($node->field_news_front_style[$field_news_front_style_lang][0]['value']);
} else {
  $style = 'square';
}

switch ($style) {
  case 'square':
    $block_classes = ' homepage-square-style col-md-3 col-sm-3 col-xs-12 hide-front-image homepage-all-block';
    break;
  case 'horizontal':
    $block_classes =  ' homepage-horizontal-style col-md-6 col-sm-6 col-xs-12 homepage-all-block';
    break;
  case 'vertical':
    $block_classes =  ' homepage-vertical-style col-md-3 col-sm-3 col-xs-12 homepage-all-block';
    break;
}
if (count($node->field_category) > 0) {
  $weights = array(
    156 => 0, // Alumni.
    176 => 0, // Others. 
    171 => 0, // Faculty.
    161 => 1, // Student life 
    146 => 2, // Research.
    151 => 3, // CIRS.
  );

  $weight_categories = array(
    0 => t('News'),
    1 => t('Student Life'),
    2 => t('Research'),
    3 => t('CIRS'),
  );

  $field_category_lang = field_language('node', $node, 'field_category');

  $current_category = 0;
  foreach ($node->field_category[$field_category_lang] as $category) {
    if ($current_category < $weights[$category['tid']]) {
      $current_category = $weights[$category['tid']];
    }
  }
  $category_markup = '<div class="homepage-block-category">' . $weight_categories[$current_category] . '</div>';
  $classes .= ' homepage-category-' . $current_category;
}
?>
<div class="<?php print $block_classes; ?>">
  <<?php print $ds_content_wrapper; print $layout_attributes; ?> class="ds-1col  <?php print $classes . ' homepage-all-' . $style; ?> clearfix">

  <?php if (isset($title_suffix['contextual_links'])): ?>
    <?php print render($title_suffix['contextual_links']); ?>
  <?php endif; ?>

  <?php print $ds_content; ?>
  <?php print $category_markup; ?>
  </<?php print $ds_content_wrapper ?>>

  <?php if (!empty($drupal_render_children)): ?>
    <?php print $drupal_render_children ?>
  <?php endif; ?>
</div>