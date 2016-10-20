<?php

if ( !defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
/**
 * Plugin Name: Catalog X
 * Plugin URI: https://implecode.com/wordpress/product-catalog/#cam=in-plugin-urls&key=plugin-url
 * Description: A minimalistic, modular catalog tool which comes with fully customizable, responsive front-end design, search and categories.
 * Version: 1.1.1
 * Author: impleCode
 * Author URI: https://implecode.com/#cam=in-plugin-urls&key=author-url
 * Text Domain: post-type-x
 * Domain Path: /lang/

  Copyright: 2015 impleCode.
  License: GNU General Public License v3.0
  License URI: http://www.gnu.org/licenses/gpl-3.0.html */
if ( !(is_admin() && isset( $_GET[ 'action' ] ) && $_GET[ 'action' ] == 'activate' && isset( $_GET[ 'plugin' ] ) && $_GET[ 'plugin' ] == 'ecommerce-product-catalog/ecommerce-product-catalog.php') ) {
	add_action( 'plugins_loaded', 'start_post_type_x', 5 );

	function start_post_type_x() {
		if ( !defined( 'AL_BASE_PATH' ) ) {
			if ( !defined( 'DEF_CATALOG_SINGULAR' ) ) {
				define( 'DEF_CATALOG_SINGULAR', __( 'Item', 'post-type-x' ) );
			}
			if ( !defined( 'DEF_CATALOG_PLURAL' ) ) {
				define( 'DEF_CATALOG_PLURAL', __( 'Catalog', 'ecommerce-product-catalog' ) );
			}
			if ( !defined( 'AL_BASE_TEMPLATES_PATH' ) ) {
				define( 'AL_BASE_TEMPLATES_PATH', dirname( __FILE__ ) );
			}
			if ( !defined( 'IC_CATALOG_PLUGIN_NAME' ) ) {
				define( 'IC_CATALOG_PLUGIN_NAME', 'Catalog X' );
			}
			if ( !defined( 'AL_PLUGIN_MAIN_FILE' ) ) {
				define( 'AL_PLUGIN_MAIN_FILE', __FILE__ );
			}
			require_once(dirname( __FILE__ ) . '/core/index.php' );
			remove_action( 'admin_init', 'ecommerce_product_catalog_upgrade' );
			add_action( 'admin_init', 'post_type_x_upgrade' );

			//add_filter( 'ic_extensions_remote_url', 'ic_post_type_x_extensions' );
			add_action( 'ic_before_extensions_list', 'type_x_free_extensions' );
			if ( !is_network_admin() ) {
				do_action( 'post_type_x_addons' );
			}
		}
	}

}

/**
 * Generates extension param for Post Type X
 *
 */
function ic_post_type_x_extensions( $param ) {
	$param .= '&extensions_ptx=1';
	return $param;
}

/**
 * Shows Post Type X free extensions
 *
 */
function type_x_free_extensions() {
	if ( false === ($extensions = get_site_transient( 'implecode_free_extensions_data' )) ) {
		$extensions = wp_remote_get( 'http://app.implecode.com/index.php?provide_extensions&free=1' );
		if ( !is_wp_error( $extensions ) && 200 == wp_remote_retrieve_response_code( $extensions ) ) {
			$extensions = json_decode( wp_remote_retrieve_body( $extensions ), true );
			if ( $extensions ) {
				set_site_transient( 'implecode_free_extensions_data', $extensions, 60 * 60 * 24 * 7 );
			}
		}
	}
	if ( !is_wp_error( $extensions ) ) {
		$all_ic_plugins = '';
		if ( function_exists( 'get_free_implecode_active_plugins' ) ) {
			$all_ic_plugins = get_free_implecode_active_plugins();
		}
		$not_active_ic_plugins = get_implecode_free_not_active_plugins();
		echo '<div class="free-extensions">';
		foreach ( $extensions as $extension ) {
			$extension[ 'type' ] = isset( $extension[ 'type' ] ) ? $extension[ 'type' ] : 'premium';
			echo extension_box( $extension[ 'name' ], $extension[ 'url' ], $extension[ 'desc' ], $extension[ 'comp' ], $extension[ 'slug' ], $all_ic_plugins, $not_active_ic_plugins, $extension[ 'type' ] );
		}
		echo '</div>';
	}
}

/**
 * Applies Post Type X upgrade functions
 *
 */
function post_type_x_upgrade() {
	if ( is_admin() ) {
		$plugin_data			 = get_plugin_data( AL_PLUGIN_MAIN_FILE );
		$plugin_version			 = $plugin_data[ "Version" ];
		$database_plugin_version = get_option( 'post_type_x_ver', $plugin_version );
		add_filter( 'ic_plugin_database_version', 'set_post_type_x_system_db_ver' );
		if ( $database_plugin_version != $plugin_version ) {
			update_option( 'post_type_x_ver', $plugin_version );
			$first_version				 = (string) get_option( 'first_activation_version', $plugin_version );
			$epc_database_plugin_version = get_option( 'ecommerce_product_catalog_ver', $plugin_version );
			if ( version_compare( $first_version, '1.1.0' ) < 0 && version_compare( $database_plugin_version, '1.1.0' ) < 0 && version_compare( $epc_database_plugin_version, '2.5.0' ) < 0 ) {
				save_default_multiple_settings();

				if ( false !== get_transient( 'implecode_hide_plugin_review_info' ) ) {
					set_site_transient( 'implecode_hide_plugin_review_info', 1 );
				}
				if ( false !== get_transient( 'implecode_hide_plugin_translation_info' ) ) {
					set_site_transient( 'implecode_hide_plugin_translation_info', 1 );
				}

				$single_options					 = get_product_page_settings();
				$single_options[ 'template' ]	 = 'plain';
				update_option( 'multi_single_options', $single_options );
			}
			flush_rewrite_rules();
		}
	}
}

/**
 * Returns Post Type X db version
 *
 * @return type
 */
function set_post_type_x_system_db_ver() {
	$plugin_data	 = get_plugin_data( AL_PLUGIN_MAIN_FILE );
	$plugin_version	 = $plugin_data[ "Version" ];
	return get_option( 'post_type_x_ver', $plugin_version );
}
