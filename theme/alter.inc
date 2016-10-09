<?php

/**
 * Implements hook_css_alter().
 */
function guq_modern_css_alter(&$css) {
  $user_module_path = drupal_get_path('module', 'user');
  $theme_path = drupal_get_path('theme', 'guq_modern');
  // Add user theme.
  $user_css = $user_module_path . '/user.css';
  $css[$user_css] = array(
    'data' => $user_css,
    'type' => 'file',
    'every_page' => TRUE,
    'media' => 'all',
    'preprocess' => TRUE,
    'group' => CSS_THEME,
    'browsers' => array('IE' => TRUE, '!IE' => TRUE),
    'weight' => 0
  );
}

/**
 * Implements hook_form_alter().
 */
function guq_modern_form_alter(&$form, &$form_state, $form_id) {
  if ($form_id) {
    switch ($form_id) {
      case 'search_block_form':
        $form['search_block_form']['#title'] = t('Search this site');
        $form['search_block_form']['#title_display'] = 'invisible';
        break;
    }
  }
}
