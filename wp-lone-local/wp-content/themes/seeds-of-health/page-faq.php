<?php
/**
 * Template Name: Faq
 *
 * @package WordPress
 * @subpackage Seeds of Health Theme
 * @since Seeds of Health Theme 1.0.1
 */

get_header(); ?>

<div class="wrap">
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<?php
			while ( have_posts() ) : the_post();
			?>
				<?php get_template_part( 'template-parts/header/page', 'header' ); ?>

				<section class="faq no-margin">
					<div class="inner">						
						<?php
							$service_args = array(
								'post_type'			=> get_field_object( 'faq_type' )['value'],
								'post_status'		=> 'publish',
								'posts_per_page'	=> -1
							);

							$services = new WP_Query( $service_args );

							global $count;
							$count = 0;
			
							// Start the loop.
							while ( $services->have_posts() ) : $services->the_post(); 

								if ( $count % 2 == 0 ) : ?>

								<div class="row">

							<?php
								endif;
						?>

							<div class="col-md-6">
								<?php get_template_part( 'template-parts/faq/faq-single', 'display' ); ?>
							</div>

						<?php

								if ( $count % 2 == 1 ) : ?>

								</div>

							<?php

								endif;

							$count++;

							endwhile;

							wp_reset_postdata();
						?>
					</div>
				</section>
				<?php
					$call_to_action_image_url = get_field('footer_image')['url'];
				?>
				<section class="parallax faq-footer" style="background-image: url('<?php echo $call_to_action_image_url ?>')">
					<div class="inner">
					</div>
				</section>


				<?php
				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;
				?>
			<?php
			endwhile; // End of the loop.
			?>

		</main><!-- #main -->
	</div><!-- #primary -->
</div><!-- .wrap -->

<?php get_footer(); ?>