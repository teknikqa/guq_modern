<?php

/**
 * @file
 * page.vars.php
 */

/**
 * Implements hook_preprocess_page().
 *
 * @see page.tpl.php
 */
function guq_modern_preprocess_page(&$variables) {
  global $language;

  // #RA:2015-05-07:Rhed+OtOc7:GUQ:
  // Change the site logo based on langauge.
  $theme_full_path = base_path() . path_to_theme();
  if($language->language == 'ar') {
    $variables['sfsq_logo'] = $theme_full_path . '/sfsq_logo-ar.png';
    $variables['logo'] =  $theme_full_path . '/logo-ar.png';
    $variables['cirs_logo'] = $theme_full_path . '/cirs-logo-ar.png';
    $variables['guq_cirs_logo'] = $theme_full_path . '/guq_cirs_logo-ar.png';
  }
  else {
  $variables['sfsq_logo'] = $theme_full_path . '/sfsq_logo.png';
  $variables['cirs_logo'] = $theme_full_path . '/cirs_logo.png';
  $variables['guq_cirs_logo'] = $theme_full_path . '/guq_cirs_logo.png';
  }
  // Add information about the number of sidebars.
  $variables['print_logo'] = base_path() . path_to_theme() . '/logo-print.png';
  if (!empty($variables['page']['sidebar_first']) && !empty($variables['page']['sidebar_second'])) {
    $variables['content_column_class'] = ' col-md-6 col-sm-9 col-md-push-3 col-xs-12 col-sm-push-3';
    $variables['first_sidebar_column_class'] = ' col-md-pull-6 col-sm-pull-9';
    $variables['second_sidebar_column_class'] = '';
  } elseif (!empty($variables['page']['sidebar_first']) && empty($variables['page']['sidebar_second'])) {
    $variables['content_column_class'] = ' col-md-9 col-sm-9 col-md-push-3 col-xs-12 col-sm-push-3';
    $variables['first_sidebar_column_class'] = ' col-md-pull-9 col-sm-pull-9';
    $variables['second_sidebar_column_class'] = '';
  } elseif (empty($variables['page']['sidebar_first']) && !empty($variables['page']['sidebar_second'])) {
    $variables['content_column_class'] = ' col-md-9 col-sm-8 col-xs-12';
    $variables['first_sidebar_column_class'] = '';
    $variables['second_sidebar_column_class'] = ' col-sm-3';
  } else {
    $variables['content_column_class'] = ' col-sm-12';
    $variables['first_sidebar_column_class'] = '';
    $variables['second_sidebar_column_class'] = '';
  }
  drupal_add_js(drupal_get_path('theme', 'guq_modern') . '/js/packery.pkgd.min.js');
  // Add needed JS on campus life page
  if (arg(0) == 'campus-life') {
    drupal_add_js(drupal_get_path('theme', 'guq_modern') . '/js/jquery.stellar.min.js');

    // #RA:2014-11-05: Only use the campus-life-editors behaviers for:
    //                              Administrator = 16
    //                              Super admin  = 31
    if ($GLOBALS['user']->uid > 0 && ( $GLOBALS['user']->uid == 1 || isset($GLOBALS['user']->roles[16]) || isset($GLOBALS['user']->roles[31]))) {
      // #RA:2014-10-16: Add campus life editors behaviors.
      drupal_add_js(drupal_get_path('theme', 'guq_modern') . '/js/campus-life-editors-' . $language->language . '.js');
    } else {
      // #RA:2014-10-16: Add campus life behaviors for not logged in visitors.
      drupal_add_js(drupal_get_path('theme', 'guq_modern') . '/js/campus-life-' . $language->language . '.js');
    }
  }

  // Unset the page title if no_title context is set
  if (context_isset('context', 'no_title')) {
    $variables['title'] = '';
  }

  if (context_isset('context', 'news_and_events')) {
    $variables['page_title'] = t('News & Events');
    if (!isset($variables['node'])) {
      $variables['content_title'] = drupal_get_title();
    }
  }

  // #RA:2014-09-16:  Set the section title for research.
  if (context_isset('context', 'research_section_title')) {
    $variables['page_title'] = t('Research');
    if (!isset($variables['node'])) {
      $variables['content_title'] = drupal_get_title();
    }
  }

  // Check if page is Basic page, where title should be part of panel tpl.
  $variables['is_page'] = FALSE;
  if (isset($variables['node']) && $variables['node']->type == 'page') {
    $variables['is_page'] = TRUE;
  }

  // Handle basic page title
  $menu_links = menu_get_active_trail();
  $links_count = count($menu_links);
  if ($menu_links[0]['href'] == '<front>' && $links_count > 2) {
    $variables['page_title'] = $menu_links[1]['title'];
    $variables['content_title'] = $menu_links[$links_count - 1]['title'];
  } else {
    if (isset($menu_links[$links_count - 1]['menu_name'])) {
      $variables['page_title'] = $menu_links[$links_count - 1]['title'];
    }
  }

  // Add page title suffix only to the landling page
  if ($menu_links[0]['href'] == '<front>' && $links_count == 2) {
    if (isset($variables['node'])) {
      $field_title_lang = field_language('node', $variables['node'], 'field_title');
      if (isset($variables['node']->field_title[$field_title_lang][0]['value'])) {
        $variables['page_title_suffix'] = $variables['node']->field_title[$field_title_lang][0]['value'];
      }
    }
  }

  // #RA:2014-08-03: add the admin.css file for logged in users only.
  if ($GLOBALS['user']->uid > 0) {
    drupal_add_css(drupal_get_path('theme', 'guq_modern') . '/css/admin.css');
  }

  // Default doamin path variable
  global $_domain;
  $variables['current_domain_id'] = $_domain['domain_id'];
  $default_domain = domain_default();
  $variables['default_doamin'] = domain_get_path($default_domain);

  if ((isset($_GET['q']) && strpos($_GET['q'], 'user') === 0)) {
    $variables['page_title'] = t('Profile');
  }

  // #RA:2015-06-30:junOw5kuacev$:GUQ:
  // Translate custom page title and page_title values.
  if (isset($variables['title'])) {
    $variables['title'] = t($variables['title']);
  }

  if (isset($variables['page_title'])) {
    $variables['page_title'] = t($variables['page_title']);
  }

}

/**
 * Implements template_preprocess_field().
 */
function guq_modern_preprocess_field(&$vars, $hook) {
  // Check for the basic page slides
  if ($vars['element']['#entity_type'] == 'field_collection_item' && $vars['element']['#bundle'] == 'field_slides') {
    if ($vars['element']['#field_type'] == 'text_long' && $vars['element']['#items'][0]['format'] == null) {
      $vars['items'][0]['#markup'] = nl2br($vars['items'][0]['#markup']);
    }
  }

  // Rewrite partner link field
  if ($vars['element']['#bundle'] == 'partner' && $vars['element']['#field_type'] == 'link_field' && $vars['element']['#view_mode'] == 'full') {
    $vars['items'][0]['#element']['title'] = t('please visit their website');
    $name = $vars['element']['#object']->title;
    $vars['label'] = t('To learn more about @name, ', array('@name' => $name));
  }

  // Rewrite researcher name in Arabic
   if ($vars['element']['#bundle'] == 'research_person') {
    global $language ;
    $translated_node = translation_node_get_translations($vars['element']['#object']->tnid);
    if ( $language->language == 'ar' && $translated_node['ar'] != NULL) {
        $vars['items'][0]['#markup'] = $translated_node['ar']->title ;
      }
  }

  switch ($vars['element']['#field_name']) {
    case 'field_person_type':
      // #RA:2014-07-24: Add person type key as a css class to the field.
      $field_person_type_lang = field_language('user', $vars['element']['#object'], 'field_person_type');
      $vars['classes_array'][] = $vars['element']['#object']->field_person_type[$field_person_type_lang][0]['value'];
      break;
  }
}
