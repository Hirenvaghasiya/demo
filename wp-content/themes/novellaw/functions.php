<?php
add_action( 'wp_enqueue_scripts', 'novellaw_child_enqueue_styles',99);
function novellaw_child_enqueue_styles() {
    $parent_style = 'novellaw-parent-style';
    wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
	 wp_enqueue_style( 'novellaw-child-style',get_stylesheet_directory_uri() . '/novellaw.css', array( $parent_style ));
}
require_once (get_stylesheet_directory() . '/inc/customizer.php'); 
?>