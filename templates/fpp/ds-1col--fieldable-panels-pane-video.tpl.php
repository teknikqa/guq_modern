<?php
/**
 * @file
 * Display Suite 1 column template.
 */

$image = field_view_field('fieldable_panels_pane', $elements['#fieldable_panels_pane'], 'field_image', array('label' => 'hidden', 'settings' => array( 'image_style' => 'campus_life_large')));
?>
<<?php print $ds_content_wrapper;print $layout_attributes;?> class="ds-1col cl-video-block <?php print $classes; ?> clearfix">

<?php if (isset($title_suffix['contextual_links'])): ?>
  <?php print render($title_suffix['contextual_links']); ?>
<?php endif; ?>

<?php print '<a href="' . $field_link[0]['url'] . '"><i class="fa fa-play-circle"></i>' . render($image) . '<div class="cp-fpp-video-conainer"><div class="field-title">' . $field_link[0]['title'] . '</div><div class="video-description">' . $field_body[0]['value']. '</div></div></a>'; ?>
</<?php print $ds_content_wrapper ?>>

<?php if (!empty($drupal_render_children)): ?>
  <?php print $drupal_render_children ?>
<?php endif; ?>
