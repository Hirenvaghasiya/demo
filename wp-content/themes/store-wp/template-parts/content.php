<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Store_WP
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php
	/**
	 * Functions hooked into igthemes_single_post 
	 */
	do_action( 'igthemes_single_post' );
	?>
</article><!-- #post-## -->
