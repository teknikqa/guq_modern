<?php
/**
 * @file
 * Display Suite 1 column template.
 */
$body = field_view_field('fieldable_panels_pane', $elements['#fieldable_panels_pane'], 'field_body', array('label' => 'hidden'));

?>
<<?php print $ds_content_wrapper;
print $layout_attributes; ?> class="ds-1col  <?php print $classes; ?> clearfix" style="border: 1px solid <?php print $field_color[0]['rgb']; ?>">

<?php if (isset($title_suffix['contextual_links'])): ?>
  <?php print render($title_suffix['contextual_links']); ?>
<?php endif; ?>

<div class="banner-heading" style="background: <?php print $field_color[0]['rgb']; ?>">
  <?php print $elements['#fieldable_panels_pane']->title; ?>
</div>
<div class="banner-content" style="color: <?php print $field_color[0]['rgb']; ?>">
  <?php print render($body); ?>
</div>
<?php if(isset($field_link[0])): ?>
<div class="banner-link">
  <?php print '<a href="' . $field_link[0]['url'] . '" style="color: ' . $field_color[0]['rgb'] . '">' . $field_link[0]['title'] . '</a>' ; ?>
</div>
<?php endif; ?>
</<?php print $ds_content_wrapper ?>>

<?php if (!empty($drupal_render_children)): ?>
  <?php print $drupal_render_children ?>
<?php endif; ?>
