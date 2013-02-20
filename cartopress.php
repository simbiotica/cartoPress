<?php
/*
Plugin Name: CartoPress
Description: CartoPress integrates CartoDB into WordPress.
Version: 0.1.0
Author: Tiagojsag
License: GPLv2 or later
*/

/**
	This program is free software; you can redistribute it and/or
	modify it under the terms of the GNU General Public License
	as published by the Free Software Foundation; either version 2
	of the License, or (at your option) any later version.
	
	This program is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	GNU General Public License for more details.
	
	You should have received a copy of the GNU General Public License
	along with this program; if not, write to the Free Software
	Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
*/

if ( is_admin() )
	require_once dirname( __FILE__ ) . '/admin.php';

function cartodb_tag_func( $atts ) {
	extract(shortcode_atts( array(
		'table' => '',
		'width' => '100%',
		'height' => '300px',
		'x' => 0,
		'y' => 0,
		'zoom' => 1,
		'filter' => '1=1'
	), $atts ));
	
	if (empty($table))
		return;
	
	$mapId = rand(); 
	
	$output = '
	<div id="cartopressmap-'.$mapId.'" style="width:'.$width.';height:'.$height.'" class="map"></div>
	<script>
		window.onload = 
			main({
				user: \''.get_option('cp_cartodb_account').'\',
				table: \''.$table.'\',
				map: \'cartopressmap-'.$mapId.'\',
				x: '.$x.',
				y: '.$y.',
				zoom: '.$zoom.',
				filter:  "'.htmlspecialchars_decode($filter).'"
			});
		
	</script>
	';
	return $output;
}

function check_shortcode($posts) {
	if ( empty($posts) )
		return $posts;

	foreach ($posts as $post) {
		if ( stripos($post->post_content, '[cartodb') !== false )
		{
			wp_enqueue_style('cartodb', 'http://libs.cartocdn.com/cartodb.js/v2/themes/css/cartodb.css');
			wp_enqueue_style('cartopress', '/wp-content/plugins/cartopress/assets/css/cartopress.css');
			wp_enqueue_script('cartodb','http://libs.cartocdn.com/cartodb.js/v2/cartodb.js', array('jquery'));
			wp_enqueue_script('cartopress', '/wp-content/plugins/cartopress/assets/js/script.js', array('jquery', 'cartodb'));
		}
		break;
	}
	return $posts;
}

add_action('the_posts', 'check_shortcode');
add_shortcode( 'cartodb', 'cartodb_tag_func' );
?>
