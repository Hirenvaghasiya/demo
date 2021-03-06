<?php
/*----------------------------------------------------------------
 * SINGLE PAGE
-----------------------------------------------------------------*/
add_action( 'igthemes_single_page', 'igthemes_page_header', 10 );
add_action( 'igthemes_single_page', 'igthemes_page_content', 20 );
add_action( 'igthemes_single_page', 'igthemes_page_footer', 30 );

/*----------------------------------------------------------------
 * PAGE HEADER
-----------------------------------------------------------------*/
if ( ! function_exists( 'igthemes_page_header' ) ) {
	// start function
    function igthemes_page_header() { ?>

    <header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
        <div class="entry-meta">
			<?php igthemes_posted_on(); ?>
		</div><!-- .entry-meta -->
	</header><!-- .entry-header -->

   <?php }
}

/*----------------------------------------------------------------
 * PAGE CONTENT
-----------------------------------------------------------------*/
if ( ! function_exists( 'igthemes_page_content' ) ) {
	// start function
	function igthemes_page_content() { ?>

		<div class="entry-content">
        <?php
            igthemes_post_thumbnail( 'full' );

			the_content();

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'store-wp' ),
				'after'  => '</div>',
			) );
		?>
		
<?php }
}

/*----------------------------------------------------------------
 * PAGE FOOTER
-----------------------------------------------------------------*/
if ( ! function_exists( 'igthemes_page_footer' ) ) {
	// start function
	function igthemes_page_footer() { ?>
	<?php if ( get_edit_post_link() ) : ?>
		<footer class="entry-footer">
			<?php
				edit_post_link(
					sprintf(
						/* translators: %s: Name of current post */
						esc_html__( 'Edit %s', 'store-wp' ),
						the_title( '<span class="screen-reader-text">"', '"</span>', false )
					),
					'<span class="edit-link">',
					'</span>'
				);
			?>
		</footer><!-- .entry-footer -->
	<?php endif; ?>
<?php }
}
