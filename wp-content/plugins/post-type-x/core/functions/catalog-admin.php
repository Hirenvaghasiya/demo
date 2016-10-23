<?php

if ( !defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Manages admin only functions
 *
 * @version		1.0.0
 * @package		post-type-x/functions
 * @author 		Norbert Dreszer
 */
function toolbar_link_to_products_archive_edit( $wp_admin_bar ) {
	$listing_id = get_product_listing_id();
	if ( !empty( $listing_id ) && is_post_type_archive( 'al_product' ) && $listing_id != 'noid' && current_user_can( 'edit_pages' ) ) {
		if ( is_plural_form_active() ) {
			$names	 = get_catalog_names();
			$label	 = sprintf( __( 'Edit %s Listing', 'post-type-x' ), ic_ucfirst( $names[ 'singular' ] ) );
		} else {
			$label = __( 'Edit Product Listing', 'post-type-x' );
		}
		$args = array(
			'id'	 => 'edit',
			'title'	 => $label,
			'href'	 => admin_url( 'post.php?post=' . $listing_id . '&action=edit' ),
			'meta'	 => array( 'class' => 'edit-products-page' ),
		);
		$wp_admin_bar->add_node( $args );
	}
}

add_action( 'admin_bar_menu', 'toolbar_link_to_products_archive_edit', 999 );
