<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Store_WP
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
    <a class="skip-link screen-reader-text" href="#main"><?php esc_html_e( 'Skip to content', 'store-wp' ); ?></a>

    <header id="masthead" class="site-header" role="banner">

    <?php
    /**
     * Functions hooked in to igthemes_before_content
     */
    do_action( 'igthemes_header' ); ?>

    </header><!-- #masthead -->

    <?php
    /**
     * Functions hooked in to igthemes_before_content
     */
    do_action( 'igthemes_before_content' ); ?>

    <div id="content" class="site-content">

    <?php
    /**
     * Functions hooked in to igthemes_content_top
     */
    do_action( 'igthemes_content_top' ); ?>
