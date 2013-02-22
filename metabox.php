<?php

/*
Copyright (C) 2011  Alexander Zagniotov

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program.  If not, see <http://www.gnu.org/licenses/>.
*/

add_action('admin_menu', 'cgmp_google_map_meta_boxes');

if ( !function_exists('cgmp_google_map_meta_boxes') ):
function cgmp_google_map_meta_boxes() {
		$id = "google_map_shortcode_builder";
		$title = "AZ :: Google Map Shortcode Builder"; 
		$context = "normal";

      $setting_builder_location = get_option(CGMP_DB_SETTINGS_BUILDER_LOCATION);
      if (isset($setting_builder_location) && $setting_builder_location == "true") {                                          
         add_meta_box($id, $title, 'cgmp_render_shortcode_builder_form', 'post', $context, 'high');                        
         add_meta_box($id, $title, 'cgmp_render_shortcode_builder_form', 'page', $context, 'high');                                                            
      }

      $custom_post_types = get_option(CGMP_DB_SETTINGS_CUSTOM_POST_TYPES);
      if (isset($custom_post_types) && trim($custom_post_types) != "") {
         $custom_post_types_arr = explode(",", $custom_post_types);
         foreach ($custom_post_types_arr as $type) {
            $type = trim(strtolower($type));
            if ($type == 'page' || $type == 'post') {
               continue;
            }
            add_meta_box($id, $title, 'cgmp_render_shortcode_builder_form', $type, $context, 'high');
         }
      }
}
endif;


if ( !function_exists('cgmp_render_shortcode_builder_form') ):
function cgmp_render_shortcode_builder_form() {

		include_once(CGMP_PLUGIN_INCLUDE_DIR.'/shortcode_builder_form.php');
		echo cgmp_render_template_with_values(array("MAP_CONFIGURATION_FORM_TOKEN" => $map_configuration_template), "map_shortcode_builder_metabox.tpl");
}
endif;

?>
