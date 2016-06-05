<?php
/**
 * @file
 * Display Suite 1 column template.
 */

$image = field_view_field('fieldable_panels_pane', $elements['#fieldable_panels_pane'], 'field_image', array('label' => 'hidden', 'settings' => array( 'image_style' => 'quick_links_icons')));
$body = field_view_field('fieldable_panels_pane', $elements['#fieldable_panels_pane'], 'field_body', array('label' => 'hidden'));
?>
<<?php print $ds_content_wrapper;print $layout_attributes;?> class="ds-1col quick-links-block <?php print $classes; ?> clearfix" style="border-top: 3px solid <?php print $field_color[0]['rgb']; ?>">

<?php if (isset($title_suffix['contextual_links'])): ?>
  <?php print render($title_suffix['contextual_links']); ?>
<?php endif; ?>
<div class="ql-title">
  <?php if ($elements['#fieldable_panels_pane']->link): ?>
    <a href="<?php print url($elements['#fieldable_panels_pane']->path); ?>">
      <?php print $elements['#fieldable_panels_pane']->title; ?>
    </a>
  <?php else: ?>
    <?php print $elements['#fieldable_panels_pane']->title; ?>
  <?php endif; ?>
</div>
<div class="ql-thumbnail pull-left"><?php print render($image); ?></div>
<div class="ql-content"><?php print render($body); ?></div>
</<?php print $ds_content_wrapper ?>>

<?php if (!empty($drupal_render_children)): ?>
  <?php print $drupal_render_children ?>
<?php endif; ?>
