<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package implecode
 */
get_header();
?>
&nbsp;
<?php echo do_shortcode("[R-slider id='1']"); ?>
<div id="primary" class="content-area">
	<div id="container_sidebar_wrap">
		<main id="main" class="site-main" role="main">
		<h1>WELCOME TO NEVERTITI GOLDSMITH </h1>
		<p>
			We are one of India’s biggest manufacturer exporter of Jewellery Tools / Watch Making Tools / Aluminium round tins & boxes. It’s been more than 40 years serving our valued customers. Our goods are being export worldwide.
</p>
<p>
The company was founded by my father Mr. Kasturi lal Bhalla in 1972. He started business with USD 50 only, (today we are a Multi Million company).
		</p>
<a href="http://localhost/demo/about-us/">Read More</a>
</main>
</div>
</div>
<!-- <div id="primary" class="content-area">
	<div id="container_sidebar_wrap">
		<main id="main" class="site-main" role="main">
			<?php if ( is_home() ) { ?>
				<header class="page-header">
					<h1 class="page-title">Blog</h1>
				</header>
			<?php } if ( have_posts() ) : ?>

				<?php /* Start the Loop */ ?>
				<?php while ( have_posts() ) : the_post(); ?>

					<?php
					/* Include the Post-Format-specific template for the content.
					 * If you want to override this in a child theme, then include a file
					 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
					 */
					get_template_part( 'content', get_post_format() );
					?>

				<?php endwhile; ?>

				<?php implecode_paging_nav(); ?>

			<?php else : ?>

				<?php //get_template_part( 'content', 'none' ); ?>

			<?php endif; ?>

		</main><!-- #main -->
		<div id="main_sidebar" role="complementary">
			<?php dynamic_sidebar( 'right-sidebar' ); ?>
		</div>
	</div> 
</div><!-- #primary -->

<?php
get_footer();
