<?php
/**
 * Template Name: Treatments
 *
 * @package WordPress
 * @subpackage Seeds of Health Theme
 * @since Seeds of Health Theme 1.0.1
 */

get_header(); ?>

<div class="">
	<main id="main" class="site-main main-content-fade" role="main">
		<?php
		// Start the loop.
		while ( have_posts() ) : the_post();

			// Include the page content template.
			get_template_part( 'template-parts/content', 'home' );

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) {
				comments_template();
			}

			// End of the loop.
		endwhile;
		?>
		
		Treatments
	</main><!-- .site-main -->

</div><!-- .content-area -->

<?php get_footer(); ?>