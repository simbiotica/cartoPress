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

		$settings = array();

		$json_string = file_get_contents(CGMP_PLUGIN_DATA_DIR."/".CGMP_JSON_DATA_HTML_ELEMENTS_FORM_PARAMS);
		$parsed_json = json_decode($json_string, true);

		if (is_array($parsed_json)) {
			foreach ($parsed_json as $data_chunk) {
				cgmp_set_values_for_html_rendering($settings, $data_chunk);
			}
		}

		$template_values = cgmp_build_template_values($settings);
		$map_configuration_template = cgmp_render_template_with_values($template_values, CGMP_HTML_TEMPLATE_MAP_CONFIGURATION_FORM);
?>
