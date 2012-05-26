<?php
/*
Plugin Name: Vintage.js
Plugin URI: http://vintagejs.com
Description: VintageJS allows you to apply a custom retro, vintage, instagram type filter to WordPress post images.
Author: modemlooper
Version: 1.0
Author URI: http://taptappress.com
*/

require(  WP_PLUGIN_DIR . '/vintagejs/admin/admin.php' );

if ( !function_exists( 'bp_core_install' ) ) {
	require(  WP_PLUGIN_DIR . '/vintagejs/bp/bp-core.php' );
}


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



function change_image_tag_class($class_name){
$class_name = 'vintage';
return $class_name;
}

function add_class_vintage(){
	add_filter('get_image_tag_class','change_image_tag_class');
}


function my_image_attachment_fields_to_edit($form_fields, $post) {    
    $form_fields["custom5"] = array(  
        "label" => __("Custom Text Field"),  
        "input" => "text", // this is default if "input" is omitted  
        "value" => get_post_meta($post->ID, "_custom5", true)  
    );  
  

    $form_fields["custom5"]["label"] = __("Vintage Filter");  
    $form_fields["custom5"]["input"] = "html";  
    $form_fields["custom5"]["html"] = "add vintage filter: 
    <input type='checkbox' value='vintage' 
    name='attachments[{$post->ID}][custom5]' 
    id='attachments[{$post->ID}][custom5]' />";
  
    return $form_fields;  
}  
// attach our function to the correct hook  
add_filter("attachment_fields_to_edit", "my_image_attachment_fields_to_edit", null, 2); 


function my_image_attachment_fields_to_save($post, $attachment) {    
    if( isset($attachment['custom5']) ){  
    
	    add_class_vintage();   
        // update_post_meta(postID, meta_key, meta_value);  
        update_post_meta($post['ID'], '_custom5', $attachment['custom5']);    
    }  
   
    return $post; 
    
}  
add_filter("attachment_fields_to_save", "my_image_attachment_fields_to_save", null, 2);
?>