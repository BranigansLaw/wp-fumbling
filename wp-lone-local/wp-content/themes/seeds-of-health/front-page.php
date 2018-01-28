<?php
/**
 * Front page of the website
 *
 * @package WordPress
 * @subpackage Seeds of Health Theme
 * @since Seeds of Health Theme 1.0.1
 */

get_header(); ?>

<div class="wrap">
	<div id="primary" class="content-area">
		<main id="main" class="site-main homepage" role="main">
			<article>
			<?php
			// Used for sub post loops
			global $post;

			while ( have_posts() ) : the_post();
			?>
				<?php get_template_part( 'template-parts/header/page', 'header' ); ?>

				<section class="homepage-services">
					<div class="inner services-list row">
						<?php 
							$services = get_field( 'services' );

							if ( $services ) {

								foreach( $services as $post ) : setup_postdata( $post ); 
						?>

						<div class="col-md-4">

									<?php get_template_part( 'template-parts/service/service-single', 'display' ); ?>

						</div>

						<?php
								
								endforeach;

								wp_reset_postdata();
							}
						?>
					</div>
				</section>
				<section class="call-to-action upper">
					<div class="inner">
						<h2><?php the_field( 'call_to_action_title' ) ?></h2>
						<h4><?php the_field( 'call_to_action_subtitle' ) ?></h4>
						<a href="<?php the_field( 'call_to_action_target' ) ?>" class="btn btn-lg btn-primary">
							<?php the_field( 'call_to_action_button_text' ) ?>
						</a>
					</div>
				</section>
				<section class="benefits">
					<div class="inner">
						<h2><?php the_field( 'benefits_title' ) ?></h2>
						<h4><?php the_field( 'benefits_subtitle' ) ?></h4>
						<?php 
							if ( have_rows( 'benefits' ) ) : 
								while ( have_rows('benefits') ) : the_row();
						?>
								<div class="benefit row">
									<div class="col-md-3">
										<?php 
											$image = get_sub_field( 'benefit_image' );
											$size = 'medium';

											if( $image ) {

												echo wp_get_attachment_image( $image, $size );

											}
										?>
									</div>
									<div class="col-md-9">
										<h3><?php the_sub_field( 'benefit_title') ?></h3>
										<p>
											<?php the_sub_field( 'benefit_description' ) ?>
										</p>
										<a class="btn btn-sm" href="<?php the_sub_field( 'benefit_link' ) ?>">Read More</a>
									</div>
								</div>
						<?php
								endwhile;
							endif;
						?>
					</div>
				</section>
				<section class="testimonials">
					<div class="inner">
						<h2><?php the_field( 'testimonials_title' ) ?></h2>
						<?php 
							$testimonials = get_field( 'testimonials' );

							if ( $testimonials ) {

								foreach( $testimonials as $post ) : setup_postdata( $post ); 

									get_template_part( 'template-parts/testimonial/testimonial-single', 'display' );
								
								endforeach;

								wp_reset_postdata();
							}
						?>
					</div>
				</section>	
				<section class="call-to-action lower">
					<div class="inner">
						<?php
							$bottom_call_to_action_title =
								get_field( 'bottom_call_to_action_title' ) ?
									get_field( 'bottom_call_to_action_title' ) : 
									get_field( 'call_to_action_title' );
							$bottom_call_to_action_button_text =
								get_field( 'bottom_call_to_action_button_text' ) ?
									get_field( 'bottom_call_to_action_button_text' ) : 
									get_field( 'call_to_action_button_text' );
							$bottom_call_to_action_targer =
								get_field( 'bottom_call_to_action_targer' ) ?
									get_field( 'bottom_call_to_action_targer' ) : 
									get_field( 'call_to_action_target' );
							$bottom_call_to_action_text =
								get_field( 'bottom_call_to_action_text' ) ?
									get_field( 'bottom_call_to_action_text' ) : 
									get_field( 'call_to_action_button_text' );
						?>
						<h2><?php echo $bottom_call_to_action_title ?></h2>
						<h4><?php echo $bottom_call_to_action_button_text ?></h4>
						<a href="<?php echo $bottom_call_to_action_targer ?>" class="btn btn-lg btn-primary">
							<?php echo $bottom_call_to_action_text ?>
						</a>
					</div>
				</section>
				<section class="comments">
					<div class="inner">
						<?php

							// If comments are open or we have at least one comment, load up the comment template.
							//if ( comments_open() || get_comments_number() ) :
							//	comments_template();
							//endif;
						?>
					</div>
				</section>
			</article>
		<?php endwhile; ?>

		</main><!-- #main -->
	</div><!-- #primary -->
</div><!-- .wrap -->

<?php get_footer(); ?>