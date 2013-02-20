<?php
add_action('admin_menu', 'cartopress_admin_menu' );
add_action('admin_init', 'cartopress_admin_init');

function cartopress_section_main_output() {
	echo '<p>Intro text for our settings section</p>';
}

function cp_cartodb_account_input() {
	$value = get_option('cp_cartodb_account');
	echo "<input id='plugin_text_string' name='cp_cartodb_account' size='20' type='text' value='$value' />";
}

function cartopress_options() {
    //must check that the user has the required capability 
    ?>
    <div class="wrap">
    <?php screen_icon(); ?>
    <h2><?php _e( 'CartoPress Settings', 'cartopress' ) ?></h2>
	<form action="options.php" method="post">  
	<?php settings_fields('cartopress'); ?>
	<?php do_settings_sections('cartopress'); ?>
	<p class="submit">
	<input type="submit" name="Submit" class="button-primary" value="<?php esc_attr_e('Save Changes') ?>" />
	</p>
	</form>
	</div>
	<?php
 
}

function cartopress_admin_menu() {
	if (!current_user_can('manage_options'))
	{
		wp_die( __('You do not have sufficient permissions to access this page.') );
	}
	add_options_page( __( 'CartoPress Options', 'cartopress'), __('CartoPress', 'cartopress'), 'manage_options', 'cartopress', 'cartopress_options');
}

function cartopress_admin_init() {
	register_setting('cartopress', 'cp_cartodb_account' );
	add_settings_section('cartopress_section_main', __("CartoDB Main Settings", 'cartopress' ), 'cartopress_section_main_output', 'cartopress');
	add_settings_field('cp_cartodb_account', __("CartoDB Account Name:", 'cartopress' ), 'cp_cartodb_account_input', 'cartopress', 'cartopress_section_main');
}
?>