<?php
/**
 * @file
 * Display Suite 1 column template.
 */
$style = $elements['#view_mode'];
switch ($style) {
  case 'large':
    $image_options['style'] = 'campus_life_large';
    break;
  case 'medium' :
    $image_options['style'] = 'campus_life_medium';
    break;
  case 'small' :
    $image_options['style'] = 'campus_life_small';
    break;
  default:
    $image_options['style'] = 'campus_life_large';
}
$image = field_view_field('fieldable_panels_pane', $elements['#fieldable_panels_pane'], 'field_image', array('label' => 'hidden', 'settings' => array('image_style' => $image_options['style'])));
$url = $field_link[0]['url'];
if ($field_link[0]['url'] == $field_link[0]['title']) {
  $title = '';
  $title_text = '';
} else {
  $title_text = $field_link[0]['title'];
  $title = '<span class="cp-fpp-inner-link" style="background: ' . $field_color[0]['rgb'] . '">' . $field_link[0]['title'] . '</span>';
}
$body = field_view_field('fieldable_panels_pane', $elements['#fieldable_panels_pane'], 'field_body', array('label' => 'hidden'));
?>
<<?php print $ds_content_wrapper;
print $layout_attributes; ?> class="ds-1col cl-<?php print $style; ?>-image-block cl-image-block <?php print $classes; ?> clearfix">

<?php if (isset($title_suffix['contextual_links'])): ?>
  <?php print render($title_suffix['contextual_links']); ?>
<?php endif; ?>

<?php print '<a href="' . $url . ' ">' . render($image) . $title  . '</a>'; ?>
<?php if($title_text != ''): ?>
<a href="<?php print $url; ?>" class="cl-image-details" style="background: <?php print 'rgb(' . hex2RGB($field_color[0]['rgb'], TRUE) . ')' ;?>;background: <?php print 'rgba(' . hex2RGB($field_color[0]['rgb'], TRUE) . ', 0.85)' ;?>">
  <div class="cl-image-title"><?php print $title_text;  ?></div>
  <div class="cl-image-description"><?php print render($body); ?></div>
  <?php print '<span class="cl-image-details-link">' . t('View the details') . '</span>'; ?>
</a>
<?php endif; ?>
</<?php print $ds_content_wrapper ?>>

<?php if (!empty($drupal_render_children)): ?>
  <?php print $drupal_render_children ?>
<?php endif; ?>
