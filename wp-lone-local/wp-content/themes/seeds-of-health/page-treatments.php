<?php
/**
 * Template Name: Treatments
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

				<section class="services">
					<div class="inner">
						<div class="row">
							<?php
								$service_args = array(
									'post_type'			=> 'services',
									'post_status'		=> 'publish',
									'posts_per_page'	=> -1,
									'meta_key'			=> 'preganacy_service',
									'meta_value'		=> get_field( 'pregnancy_only_treatments' ) ? 1 : 0
								);

								$services = new WP_Query( $service_args );
				
								// Start the loop.
								while ( $services->have_posts() ) : $services->the_post();

									get_template_part( 'template-parts/service/service-single', 'display' );

								endwhile;

								wp_reset_postdata();
							?>
						</div>
					</div>
				</section>
				<?php
					if ( !get_field( 'pregnancy_only_treatments' ) ) :
						$pregnancy_section_image_url = get_field('pregnancy_treatments_background')['url'];
				?>
					<section class="parallax pregnancy_treatments" style="background-image: url('<?php echo $pregnancy_section_image_url ?>')">
						<div class="inner">
							<div class="parallax-content">
								<h2>Pregnancy</h2>
								<div class="row">
									<?php
										$service_args = array(
											'post_type'			=> 'services',
											'post_status'		=> 'publish',
											'posts_per_page'	=> -1,
											'meta_key'			=> 'preganacy_service',
											'meta_value'		=> 1
										);

										$services = new WP_Query( $service_args );

										$num_columns = 4;

										$count = 0;
						
										// Start the loop.
										while ( $services->have_posts() ) : $services->the_post();

											if ( $count % $num_columns == 0 ) :
									?>
												<div class="row">
									<?php
											endif;
									?>

									<div class="col-md-<?php echo 12 / $num_columns ?>">
									<?php
											get_template_part( 'template-parts/service/service-single', 'display' );
									?>
									</div>
									<?php
											if ( $count % $num_columns == ( $num_columns - 1 ) ) :
									?>

												</div>
									<?php
											endif;

											$count++;

										endwhile;

										wp_reset_postdata();
									?>
								</div>
								<div class="call-to-action-button">
									<a href="<?php the_field( 'pregnancy_treatments_button_target' ) ?>" class="btn btn-primary">
										<?php the_field( 'pregnancy_treatments_button_text' ) ?>
									</a>
								</div>
							</div>
						</div>
					</section>
					<section class="testimonials">
						<div class="inner">
							<div class="row">
								<h2>Testimonials</h2>
								<?php 
									$testimonials = get_field( 'testimonials' );

									$contact_form_class = $testimonials ? 'col-md-4' : 'col-md-12';

									if ( $testimonials ) :
								?>
									<div class="col-md-8">
								<?php

										foreach( $testimonials as $post ) : setup_postdata( $post ); 

											get_template_part( 'template-parts/testimonial/testimonial-single', 'display' );
										
										endforeach;

										wp_reset_postdata();
								?>
									</div>
								<?php
									endif;
								?>
								<div class="<?php echo $contact_form_class ?>">
									<?php
										$contact_form = get_field( 'contact_form' );

										if ( $contact_form ) {

											echo do_shortcode( '[contact-form-7 id="' . $contact_form->ID . '" title="' . $contact_form->post_title . '"]' );

										}
									?>
								</div>
							</div>
						</div>
					</section>
				<?php
					endif;
				?>
				<?php
				// If comments are open or we have at least one comment, load up the comment template.
				//if ( comments_open() || get_comments_number() ) :
				//	comments_template();
				//endif;
				?>
			<?php
			endwhile; // End of the loop.
			?>

		</main><!-- #main -->
	</div><!-- #primary -->
</div><!-- .wrap -->

<?php get_footer(); ?>