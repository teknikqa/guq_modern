<?php

/**
 * @file template.php
 */
bootstrap_include('guq_modern', 'theme/alter.inc');
bootstrap_include('guq_modern', 'theme/field.func.php');
bootstrap_include('guq_modern', 'theme/page.vars.php');

function guq_modern_process_search_result(&$variables) {
  $variables['info_split']['type'] = $variables['result']['type'];
  if($variables['result']['entity_type'] == 'user') {
    $result = user_load($variables['result']['fields']['entity_id']);
    $variables['title'] = $result->realname;
  }
}

/**
 * Theme function to output tablinks for classic Quicktabs style tabs.
 *
 * @ingroup themeable
 */
function guq_modern_qt_quicktabs_tabset($vars) {
  $variables = array(
    'attributes' => array(
      'class' => 'quicktabs-tabs quicktabs-style-' . $vars['tabset']['#options']['style'],
    ),
    'items' => array(),
  );
  foreach (element_children($vars['tabset']['tablinks']) as $key) {
    $item = array();
    if (is_array($vars['tabset']['tablinks'][$key])) {
      $tab = $vars['tabset']['tablinks'][$key];
      if ($key == $vars['tabset']['#options']['active']) {
        $item['class'] = array('active');
      }
      $item['data'] = drupal_render($tab);
      $item['class'][] = drupal_html_class(trim($vars['tabset']['tablinks'][$key]['#title']));
      $variables['items'][] = $item;
    }
  }
  return theme('item_list', $variables);
}

/**
 * Overrides theme_menu_link().
 */
function guq_modern_menu_link(array $variables) {

  $element = $variables['element'];
  $element['dropdown'] = '';
  $sub_menu = '';

  #remove child items from employees menu for non logged in users.

  if ($element['#below']) {
    // Prevent dropdown functions from being added to management menu so it
    // does not affect the navbar module.
    if (($element['#original_link']['menu_name'] == 'management' && module_exists('navbar')) || ((!empty($element['#original_link']['depth'])) && (isset($element['#bid']) && $element['#bid']['module'] == 'menu_block'))) {
      $sub_menu = drupal_render($element['#below']);
    } elseif ((!empty($element['#original_link']['depth'])) && ($element['#original_link']['depth'] == 1)) {
      // Add our own wrapper.
      unset($element['#below']['#theme_wrappers']);
      $sub_menu = '<ul class="dropdown-menu">' . drupal_render($element['#below']) . '</ul>';
      // Generate as standard dropdown.

      $element['#attributes']['class'][] = 'dropdown';
      $element['#localized_options']['html'] = TRUE;

      // Set dropdown trigger element to # to prevent inadvertant page loading
      // when a submenu link is clicked.
      // don't add bootstrap data toggle classes to audience menu
      if ($variables['element']['#original_link']['menu_name'] != 'menu-audience-menu') {
        $element['#localized_options']['attributes']['data-target'] = '#';
        $element['#localized_options']['attributes']['class'][] = 'dropdown-toggle';
        $element['#localized_options']['attributes']['data-toggle'] = 'dropdown';
      }
    }
  }

  // On primary navigation menu, class 'active' is not set on active menu item.
  // @see https://drupal.org/node/1896674
  if (($element['#href'] == $_GET['q'] || ($element['#href'] == '<front>' && drupal_is_front_page())) && (empty($element['#localized_options']['language']))) {
    $element['#attributes']['class'][] = 'active';
  }

  if ($element['#original_link']['has_children'] && $element['#original_link']['menu_name'] != 'management') {
    $element['dropdown'] = '<span class="nav-class-caret"></span>';
  }
  $output = l($element['#title'], $element['#href'], $element['#localized_options']);
  return '<li' . drupal_attributes($element['#attributes']) . '>' . $output . $element['dropdown'] . $sub_menu . '</li>';
}

/**
 * Overrides theme_menu_local_tasks().
 */
function guq_modern_menu_local_tasks(&$variables) {
  $output = '';

  if (!empty($variables['primary'])) {
    $variables['primary']['#prefix'] = '<h2 class="element-invisible">' . t('Primary tabs') . '</h2>';
    $variables['primary']['#prefix'] .= '<div class="primary-tabs-wrapper">';
    $variables['primary']['#prefix'] .= '<div class="container">';
    $variables['primary']['#prefix'] .= '<ul class="tabs--primary nav nav-tabs">';
    $variables['primary']['#suffix'] = '</ul>';
    $variables['primary']['#suffix'] .= '</div>';
    $variables['primary']['#suffix'] .= '</div>';
    $output .= drupal_render($variables['primary']);
  }

  if (!empty($variables['secondary'])) {
    $variables['secondary']['#prefix'] = '<h2 class="element-invisible">' . t('Secondary tabs') . '</h2>';
    $variables['secondary']['#prefix'] .= '<div class="container">';
    $variables['secondary']['#prefix'] .= '<ul class="tabs--secondary pagination pagination-sm">';
    $variables['secondary']['#suffix'] = '</ul>';
    $variables['secondary']['#suffix'] .= '</div>';
    $output .= drupal_render($variables['secondary']);
  }

  return $output;
}

/**
 * Theme function for the ical icon used by attached iCal feed.
 *
 */
function guq_modern_date_ical_icon($variables) {

  switch ($variables['view']->current_display) {
    case 'event_by_current_students_visibility_ical':
      $var = t('Add All Current Student Events');
      break;

    case 'event_by_research_visibility_ical':
      $var = t('Add All Research Events');
      break;

    case 'event_by_faculty_visibility_ical':
      $var = t('Add All Faculty Events');
      break;

    case 'block_ical_node':
      $var = t('Add To Calendar');
      break;

    default:
      $var = t('Add All Events');
      break;
  }

  if ($image = theme('image', $variables)) {
    return "<a href='{$variables['url']}' class='ical-icon btn btn-default btn-xs'><i class='fa fa-calendar'></i> <small>$var</small></a>";
  } else {
    return "<a href='{$variables['url']}' class='ical-icon btn btn-default btn-xs'><i class='fa fa-calendar'></i> <small>$var</small></a>";
  }
}

/**
 * Implements hook_form_FORM_ID_alter
 */
/* function guq_modern_form_custom_search_blocks_form_1_alter(&$form, &$form_state, $form_id) {
  $solr_search = apachesolr_get_solr();
  $current_query = apachesolr_current_query($solr_search->getId());
  $params = $current_query->getParam('q');
  list($search_term, $after) = explode('-', $params, 2);
  $form['custom_search_blocks_form_1']['#default_value'] = trim($search_term);
  $form['advanced'] = array(
  '#type' => 'fieldset',
  '#title' => t('Advanced search'),
  '#weight' => -6,
  '#collapsible' => TRUE,
  '#collapsed' => TRUE,
  );
  $form['advanced']['custom_search_criteria_or'] = $form['custom_search_criteria_or'];
  $form['advanced']['custom_search_criteria_phrase'] = $form['custom_search_criteria_phrase'];
  $form['advanced']['custom_search_criteria_negative'] = $form['custom_search_criteria_negative'];
  unset($form['custom_search_criteria_or']);
  unset($form['custom_search_criteria_phrase']);
  unset($form['custom_search_criteria_negative']);

  } */

function guq_modern_views_mini_pager($vars) {
  //var_dump($vars);die;
  global $pager_page_array, $pager_total;

  $tags = $vars['tags'];
  $element = $vars['element'];
  $parameters = $vars['parameters'];

  // current is the page we are currently paged to
  $pager_current = $pager_page_array[$element] + 1;
  // max is the maximum page number
  $pager_max = $pager_total[$element];
  // End of marker calculations.

  if ($pager_total[$element] > 1) {

    $li_previous = theme('pager_previous', array(
      'text' => (isset($tags[1]) ? " " : t('‹‹')),
      'element' => $element,
      'interval' => 1,
      'parameters' => $parameters,
      )
    );

    if (empty($li_previous)) {
      $li_previous = "&nbsp;";
    }

    $li_next = theme('pager_next', array(
      'text' => (isset($tags[3]) ? " " : t('››')),
      'element' => $element,
      'interval' => 1,
      'parameters' => $parameters,
      )
    );

    if (empty($li_next)) {
      $li_next = "&nbsp;";
    }

    $items[] = array(
      'class' => array('pager-previous'),
      'data' => $li_previous,
    );

    $items[] = array(
      'class' => array('pager-current'),
      'data' => t('@current of @max', array('@current' => $pager_current, '@max' => $pager_max)),
    );

    $items[] = array(
      'class' => array('pager-next'),
      'data' => $li_next,
    );
    return theme('item_list', array(
      'items' => $items,
      'title' => NULL,
      'type' => 'ul',
      'attributes' => array('class' => array('pager')),
      )
    );
  }
}

/**
 * Get mobile menu HTMl
 */
function get_mobile_menu() {
  return mobile_menu_wrapper('main-menu') . mobile_menu_wrapper('menu-audience-menu') . mobile_menu_wrapper('menu-secondary-menu');
}

/**
 * Menu with mobile menu theme.
 * @param type $name
 * @return type
 */
function mobile_menu_wrapper($name) {
  $tree = menu_tree_all_data($name, null);
  menu_tree_add_active_path($tree);
  $menu = menu_tree_output($tree);

  foreach ($menu as $key => &$item) {
    if (isset($item['#theme'])) {
      $item['#theme'] = 'menu_link__menu_mobile_menu';
    }
  }

  return '<div class="mobile-menu">' . render($menu) . '</div>';
}

/**
 * Overrides theme_menu_link().
 */
function guq_modern_menu_link__menu_mobile_menu(array $variables) {
  global $user;
  $element = $variables['element'];
  $sub_menu = '';
  $caret_class = 'mobile-menu-caret';
  $employee_icon = FALSE;

  if ($variables['element']['#original_link']['menu_name'] == 'menu-audience-menu' && $variables['element']['#original_link']['link_path'] == 'employees/login' && $user->uid == 0) {
    $employee_icon = TRUE;
    $caret_class .= ' employee-mobile-menu-caret';
  }

  if ($element['#below']) {
    if ((!empty($element['#original_link']['depth']))) {
      // Add our own wrapper.
      unset($element['#below']['#theme_wrappers']);
      foreach ($element['#below'] as $key => &$item) {
        if (isset($item['#theme']))
          $item['#theme'] = 'menu_link__menu_mobile_menu';
      }
      $sub_menu = '<span class="' . $caret_class . '"></span><ul class="dropdown-menu">' . drupal_render($element['#below']) . '</ul>';
      // Generate as standard dropdown.
      $element['#attributes']['class'][] = 'dropdown';
      $element['#localized_options']['html'] = TRUE;
      $element['#localized_options']['attributes']['class'][] = 'dropdown-toggle';
    }
  }

  // On primary navigation menu, class 'active' is not set on active menu item.
  // @see https://drupal.org/node/1896674
  if (($element['#href'] == $_GET['q'] || ($element['#href'] == '<front>' && drupal_is_front_page())) && (empty($element['#localized_options']['language']))) {
    $element['#attributes']['class'][] = 'active';
  }
  $output = l($element['#title'], $element['#href'], $element['#localized_options']);
  if (!$employee_icon) {
    return '<li' . drupal_attributes($element['#attributes']) . '>' . $output . $sub_menu . "</li>";
  } else {
    return '<li' . drupal_attributes($element['#attributes']) . '>' . $output . $sub_menu . '<span class="' . $caret_class . '"></span></li>';
  }
}

function guq_modern_preprocess_node(&$variables) {
  global $user;
  $user_roles = $user->roles;
  $node = $variables['node'];
  $view_mode = $variables['view_mode'];
    if ($node->type == ('downloadable_resource') && $view_mode == 'full' && !in_array('Super admin', $user_roles)) {
       $field_link_lang = field_language('node', $node, 'field_link');
       drupal_goto($node->field_link[$field_link_lang][0]['url']);
    }
}

/**
 * Implements hook_preprocess_button().
 */
function guq_modern_preprocess_button(&$vars) {
  // #RA:2015-03-16:yibnespOcurtoodsImBapKousOnpicpiejirbOcKec3Friorg+:
  //  A fix for the bootstrap buttons with null value of names.
  if (isset($vars['element']['#name']) &&
     ($vars['element']['#name'] == NULL || $vars['element']['#name'] == NULL )) {
      // If the name is set and is empty or NULL .. re-set it with id of the button.
     $vars['element']['#name'] = $vars['element']['#id'];
  }
}

/**
 * Returns HTML for a date element formatted as a Start/End combination.
 *
 *  $entity->date_id
 *    If set, this will show only an individual date on a field with
 *    multiple dates. The value should be a string that contains
 *    the following values, separated with periods:
 *    - module name of the module adding the item
 *    - node nid
 *    - field name
 *    - delta value of the field to be displayed
 *    - other information the module's custom theme might need
 *
 *    Used by the calendar module and available for other uses.
 *    example: 'date.217.field_date.3.test'
 *
 *  $entity->date_repeat_show
 *    If true, tells the theme to show all the computed values of a repeating
 *    date. If not true or not set, only the start date and the repeat rule
 *    will be displayed.
 *
 *  $dates['format']
 *    The format string used on these dates
 *  $dates['value']['local']['object']
 *    The local date object for the Start date
 *  $dates['value2']['local']['object']
 *    The local date object for the End date
 *  $dates['value']['local']['datetime']
 *    The datetime value of the Start date database (GMT) value
 *  $dates['value2']['local']['datetime']
 *    The datetime value of the End date database (GMT) value
 *  $dates['value']['formatted']
 *    Formatted Start date, i.e. 'February 15, 2007 2:00 pm';
 *  $dates['value']['formatted_date']
 *    Only the date part of the formatted Start date
 *  $dates['value']['formatted_time']
 *    Only the time part of the formatted Start date
 *  $dates['value2']['formatted']
 *    Formatted End date, i.e. 'February 15, 2007 6:00 pm';
 *  $dates['value2']['formatted_date']
 *    Only the date part of the formatted End date
 *  $dates['value2']['formatted_time']
 *    Only the time part of the formatted End date
 */
function guq_modern_date_display_combination($variables) {
  static $repeating_ids = array();

  $entity_type = $variables['entity_type'];
  $entity      = $variables['entity'];
  $field       = $variables['field'];
  $instance    = $variables['instance'];
  $langcode    = $variables['langcode'];
  $item        = $variables['item'];
  $delta       = $variables['delta'];
  $display     = $variables['display'];
  $field_name  = $field['field_name'];
  $formatter   = $display['type'];
  $options     = $display['settings'];
  $dates       = $variables['dates'];
  $attributes  = $variables['attributes'];
  $rdf_mapping = $variables['rdf_mapping'];
  $add_rdf     = $variables['add_rdf'];
  $precision   = date_granularity_precision($field['settings']['granularity']);

  $output = '';

  // If date_id is set for this field and delta doesn't match, don't display it.
  if (!empty($entity->date_id)) {
    foreach ((array) $entity->date_id as $key => $id) {
      list($module, $nid, $field_name, $item_delta, $other) = explode('.', $id . '.');
      if ($field_name == $field['field_name'] && isset($delta) && $item_delta != $delta) {
        return $output;
      }
    }
  }

  // Check the formatter settings to see if the repeat rule should be displayed.
  // Show it only with the first multiple value date.
  list($id) = entity_extract_ids($entity_type, $entity);
  if (!in_array($id, $repeating_ids) && module_exists('date_repeat_field') && !empty($item['rrule']) && $options['show_repeat_rule'] == 'show') {
    $repeat_vars = array(
      'field' => $field,
      'item' => $item,
      'entity_type' => $entity_type,
      'entity' => $entity,
    );
    $output .= theme('date_repeat_display', $repeat_vars);
    $repeating_ids[] = $id;
  }

  // If this is a full node or a pseudo node created by grouping multiple
  // values, see exactly which values are supposed to be visible.
  if (isset($entity->$field_name)) {
    $entity = date_prepare_entity($formatter, $entity_type, $entity, $field, $instance, $langcode, $item, $display);
    // Did the current value get removed by formatter settings?
    if (empty($entity->{$field_name}[$langcode][$delta])) {
      return $output;
    }
    // Adjust the $element values to match the changes.
    $element['#entity'] = $entity;
  }

  switch ($options['fromto']) {
    case 'value':
      $date1 = $dates['value']['formatted'];
      $date2 = $date1;
      break;
    case 'value2':
      $date2 = $dates['value2']['formatted'];
      $date1 = $date2;
      break;
    default:
      $date1 = $dates['value']['formatted'];
      $date2 = $dates['value2']['formatted'];
      break;
  }

  // Pull the timezone, if any, out of the formatted result and tack it back on
  // at the end, if it is in the current formatted date.
  $timezone = $dates['value']['formatted_timezone'];
  if ($timezone) {
    $timezone = ' ' . $timezone;
  }
  $date1 = str_replace($timezone, '', $date1);
  $date2 = str_replace($timezone, '', $date2);
  $time1 = preg_replace('`^([\(\[])`', '', $dates['value']['formatted_time']);
  $time1 = preg_replace('([\)\]]$)', '', $time1);
  $time2 = preg_replace('`^([\(\[])`', '', $dates['value2']['formatted_time']);
  $time2 = preg_replace('([\)\]]$)', '', $time2);

  // A date with a granularity of 'hour' has a time string that is an integer
  // value. We can't use that to replace time strings in formatted dates.
  $has_time_string = date_has_time($field['settings']['granularity']);
  if ($precision == 'hour') {
    $has_time_string = FALSE;
  }

  // No date values, display nothing.
  if (empty($date1) && empty($date2)) {
    $output .= '';
  }
  // Start and End dates match or there is no End date, display a complete
  // single date.
  elseif ($date1 == $date2 || empty($date2)) {
    $output .= theme('date_display_single', array(
      'date' => $date1,
      'timezone' => $timezone,
      'attributes' => $attributes,
      'rdf_mapping' => $rdf_mapping,
      'add_rdf' => $add_rdf,
      'dates' => $dates,
    ));
  }
  // Same day, different times, don't repeat the date but show both Start and
  // End times. We can NOT do this if the replacement value is an integer
  // instead of a time string.

  if ($has_time_string && $dates['value']['formatted_date'] == $dates['value2']['formatted_date']) {
    // Replace the original time with the start/end time in the formatted start
    // date. Make sure that parentheses or brackets wrapping the time will be
    // retained in the final result.
    $output = theme('date_display_range', array(
      'date1' => $time1,
      'date2' => $time2,
      'timezone' => $timezone,
      'attributes' => $attributes,
      'rdf_mapping' => $rdf_mapping,
      'add_rdf' => $add_rdf,
      'dates' => $dates,
    ));
  }
  else {
   $output = theme_date_display_combination($variables);
 }
 return $output;
}

/**
 * Returns HTML for a date element formatted as a range.
 */
function guq_modern_date_display_range($variables) {

  global $language ;
  $lang_name = $language->language ;
  $d1 = $variables['dates']['value']['formatted_iso'];
  $d2 = $variables['dates']['value2']['formatted_iso'];

  $start_date = '<span class="date-display-start"' . drupal_attributes($variables['attributes_start']) . '>' . format_date(strtotime($d1) ,'custom','F d Y') . '</span>';
  $start_time = '<span class="time-display-start"' . drupal_attributes($variables['attributes_start']) . '>' . format_date(strtotime($d1) ,'custom','h:i A') . '</span>';

  $end_date = '<span class="date-display-end"' . drupal_attributes($variables['attributes_end']) . '>' . format_date(strtotime($d2) ,'custom','F d Y') . '</span>';
  $end_time = '<span class="time-display-end"' . drupal_attributes($variables['attributes_end']) . '>' . format_date(strtotime($d2) ,'custom','h:i A') . '</span>';

  if($lang_name=="ar") {
    $start_date = '<span class="date-display-start"' . drupal_attributes($variables['attributes_start']) . '>' . format_date(strtotime($d1) ,'custom','d F') . '</span>';
    $end_date = '<span class="date-display-end"' . drupal_attributes($variables['attributes_end']) . '>' . format_date(strtotime($d2) ,'custom','d F') . '</span>';
  }

  // If microdata attributes for the start date property have been passed in,
  // add the microdata in meta tags.
  if (!empty($variables['add_microdata'])) {
    $start_date .= '<meta' . drupal_attributes($variables['microdata']['value']['#attributes']) . '/>';
    $end_date .= '<meta' . drupal_attributes($variables['microdata']['value2']['#attributes']) . '/>';
  }

  $dt1 = strtotime($d1);
  $dt2 = strtotime($d2);

  // Temp dates to compare.
  $temp1 = date('F jS Y', $dt1);
  $temp2 = date('F jS Y', $dt2);

  if ($temp1 == $temp2) {
      return t('<span class="date-and-time" ><span class="date" > !start-date</span><span class="time"> !start_time - !end_time </span></span>', array(
        '!start-date' => $start_date,
        '!start_time' => $start_time,
        '!end_time' => $end_time,
      )
    );

  }
  else {
    return t('<span class="date-and-time" ><span class="date" > !start-date - !end-date </span><span class="time"> !start_time - !end_time </span></span> ', array(
        '!start-date' => $start_date,
        '!end-date' => $end_date,
        '!start_time' => $start_time,
        '!end_time' => $end_time,
      )
    );
  }
}

/**
 * Returns date custom labels.
**/
function guq_modern_date_part_label_date($vars) {

  if ('field_event_date' == $vars['element']['#field']['field_name']) {
    return t($vars['element']['#date_title']);
  }
  else {
    return t('Date');
  }
}
