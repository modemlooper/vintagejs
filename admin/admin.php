<?php
add_action('admin_menu', 'vintagejs_plugin_menu');
add_action('network_admin_menu', 'vintagejs_plugin_menu');


function vintagejs_plugin_menu() {
	add_submenu_page( 'themes.php', 'Vintage JS', 'Vintage JS', 'manage_options', 'vintagejs', 'vintagejs_plugin_options');

	//call register settings function
	add_action( 'admin_init', 'vintagejs_register_settings' );
}


function vintagejs_register_settings() {
	//register our settings
	register_setting( 'vintagejs_plugin_options', 'add2homescreen' );
	register_setting( 'vintagejs_plugin_options', 'style' );
	register_setting( 'vintagejs_plugin_options', 'lazyload' );
	register_setting( 'vintagejs_plugin_options', 'admob-on-off' );
	register_setting( 'vintagejs_plugin_options', 'admob' );
}


function vintagejs_plugin_options() {
	if (!current_user_can('manage_options'))  {
		wp_die( __('You do not have sufficient permissions to access this page.') );

	}

?>

			<?php if ( !empty( $_GET['updated'] ) ) : ?>
				<div id="message" class="updated">
					<p><strong><?php _e('settings saved.', 'vintagejs' ); ?></strong></p>
				</div>
			<?php endif; ?>



<div class="wrap">
<h2><?php _e('Vintage JS Settings', 'vintagejs') ?></h2>
<p>More options and settings will be here in a future version.</p>

<p>To add vintage effect to an image you check the add vintage filter box during the image upload dialog an then insert iamge to post.</p>

<p><img src="<?php echo (WP_PLUGIN_URL . '/vintagejs/admin/upload.png'); ?>"/></p>
</div>

<?php
}
?>