<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2010 osCommerce

  Released under the GNU General Public License
*/

  class bm_languages {
    var $code = 'bm_languages';
    var $group = 'boxes';
    var $title;
    var $description;
    var $sort_order;
    var $enabled = false;

    function bm_languages() {
      $this->title = MODULE_BOXES_LANGUAGES_TITLE;
      $this->description = MODULE_BOXES_LANGUAGES_DESCRIPTION;

      if ( defined('MODULE_BOXES_LANGUAGES_STATUS') ) {
        $this->sort_order = MODULE_BOXES_LANGUAGES_SORT_ORDER;
        $this->enabled = (MODULE_BOXES_LANGUAGES_STATUS == 'True');

        $this->group = ((MODULE_BOXES_LANGUAGES_CONTENT_PLACEMENT == 'Left Column') ? 'boxes_column_left' : 'boxes_column_right');
      }
    }

    function execute() {
      global $OSCOM_APP, $lng, $request_type, $oscTemplate;

      if ( $OSCOM_APP->getCode() != 'checkout' ) {
        if (!isset($lng) || (isset($lng) && !is_object($lng))) {
          include(DIR_WS_CLASSES . 'language.php');
          $lng = new language;
        }

        if (count($lng->catalog_languages) > 1) {
          $languages_string = '';
          reset($lng->catalog_languages);
          while (list($key, $value) = each($lng->catalog_languages)) {
            $languages_string .= '<a href="' . osc_href_link(null, osc_get_all_get_params(array('language', 'currency')) . 'language=' . $key, $request_type) . '">' . osc_image(DIR_WS_LANGUAGES .  $value['directory'] . '/images/' . $value['image'], $value['name']) . '</a>';
          }

          $data = '<li class="nav-header">' . MODULE_BOXES_LANGUAGES_BOX_TITLE . '</li>' .
                  '<li style="text-align: center;">' . $languages_string . '</li>';

          $oscTemplate->addBlock($data, $this->group);
        }
      }
    }

    function isEnabled() {
      return $this->enabled;
    }

    function check() {
      return defined('MODULE_BOXES_LANGUAGES_STATUS');
    }

    function install() {
      osc_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Enable Languages Module', 'MODULE_BOXES_LANGUAGES_STATUS', 'True', 'Do you want to add the module to your shop?', '6', '1', 'osc_cfg_select_option(array(\'True\', \'False\'), ', now())");
      osc_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Content Placement', 'MODULE_BOXES_LANGUAGES_CONTENT_PLACEMENT', 'Right Column', 'Should the module be loaded in the left or right column?', '6', '1', 'osc_cfg_select_option(array(\'Left Column\', \'Right Column\'), ', now())");
      osc_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Sort Order', 'MODULE_BOXES_LANGUAGES_SORT_ORDER', '0', 'Sort order of display. Lowest is displayed first.', '6', '0', now())");
    }

    function remove() {
      osc_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key in ('" . implode("', '", $this->keys()) . "')");
    }

    function keys() {
      return array('MODULE_BOXES_LANGUAGES_STATUS', 'MODULE_BOXES_LANGUAGES_CONTENT_PLACEMENT', 'MODULE_BOXES_LANGUAGES_SORT_ORDER');
    }
  }
?>