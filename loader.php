<?php
/*
Plugin Name: Vintage.js
Plugin URI: http://vintagejs.com
Description: VintageJS allows you to apply a custom retro, vintage look to WordPress post images.
Author: modemlooper
Version: 1.0
Author URI: http://taptappress.com
*/


function vintagejs_scripts() {
	wp_enqueue_script( "vintagejs", path_join(WP_PLUGIN_URL, basename( dirname( __FILE__ ) )."/vintage.min.js"), array( 'jquery' ) );
}
add_action('wp_print_scripts', 'vintagejs_scripts');


function vintagejs_styles() {
	wp_enqueue_style( "vintagejs", path_join(WP_PLUGIN_URL, basename( dirname( __FILE__ ) )."/css/vintagejs.css") );
}
add_action('wp_print_styles', 'vintagejs_styles');


function vintagejs_insert_head() {
?>
<script>
jQuery(function () {
    jQuery('img.vintage').click(function (e) {
    	e.preventDefault(); 
    });
    jQuery('img.vintage').vintage();
});
</script>

<?php
}
add_action('wp_head', 'vintagejs_insert_head');


?>