<?php

/**
 * Formats a link field widget.
 */
function guq_modern_link_field($vars) {
  drupal_add_css(drupal_get_path('module', 'link') . '/link.css');
  $element = $vars['element'];
  // Prefix single value link fields with the name of the field.
  if (empty($element['#field']['multiple'])) {
    if (isset($element['url']) && !isset($element['title'])) {
      $element['url']['#title_display'] = 'invisible';
    }
  }

  $output = '';
  $output .= '<div class="link-field-subrow clearfix">';
  if (isset($element['title'])) {
    $element['title']['#title_display'] = 'invisible';
    $element['title']['#attributes']['placeholder'] = $element['title']['#title'];
    $output .= '<div class="link-field-title link-field-column">' . drupal_render($element['title']) . '</div>';
  }
  $element['url']['#title_display'] = 'invisible';
  $element['url']['#attributes']['placeholder'] = $element['url']['#title'];
  $output .= '<div class="link-field-url' . (isset($element['title']) ? ' link-field-column' : '') . '">' . drupal_render($element['url']) . '</div>';
  $output .= '</div>';
  if (!empty($element['attributes']['target'])) {
    $output .= '<div class="link-attributes">' . drupal_render($element['attributes']['target']) . '</div>';
  }
  if (!empty($element['attributes']['title'])) {
    $output .= '<div class="link-attributes">' . drupal_render($element['attributes']['title']) . '</div>';
  }
  return $output;
}