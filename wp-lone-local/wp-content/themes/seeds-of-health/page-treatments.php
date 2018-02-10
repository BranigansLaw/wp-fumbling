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
		<main id="main" class="site-main treatments-template" role="main">

			<?php
			while ( have_posts() ) : the_post();
			?>
				<?php get_template_part( 'template-parts/header/page', 'header' ); ?>
			
				<section class="services">
					<div class="inner">
						<div class="row">
							<?php
								$pregnancy_only = get_field( 'pregnancy_only_treatments' ) ? 1 : 0;
							
								$service_args = array(
									'post_type'			=> 'services',
									'post_status'		=> 'publish',
									'posts_per_page'	=> -1
								);
							
								if ( $pregnancy_only ) {
									$service_args['meta_key'] = 'preganacy_service';
									$service_args['meta_value'] = true;
								}
								else {
									$service_args['meta_key'] = 'list_in_other_services';
									$service_args['meta_value'] = true;
								}

								$services = new WP_Query( $service_args );
							
								$count = 0;
				
								// Start the loop.
								while ( $services->have_posts() ) : $services->the_post();

									if ( $pregnancy_only ) {
										get_template_part( 'template-parts/service/service-single', 'pregnancy' );
									}
									else {
										get_template_part( 'template-parts/service/service-single', 'other' );
									}

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
					<section class="services-with-prices">
						<div class="inner services-list row">
							<h3>
								Our Services
							</h3>
							<ul>
							<?php 
								$services = get_field( 'services_listed' );

								if ( $services ) {

									foreach( $services as $post ) : setup_postdata( $post ); 
							?>

							<div>

										<?php get_template_part( 'template-parts/service/service-single', 'prices' ); ?>

							</div>

							<?php

									endforeach;

									wp_reset_postdata();
								}
							?>
							</ul>
						</div>					
					</section>
					<section class="parallax pregnancy_treatments no-margin" style="background-image: url('<?php echo $pregnancy_section_image_url ?>')">
						<div class="inner">
							<div class="parallax-content">
								<h2>Pregnancy</h2>
								<div class="row">
									<div class="col-md-12">
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
								</div>
								<div class="call-to-action-button">
									<a href="<?php the_field( 'pregnancy_treatments_button_target' ) ?>" class="btn btn-primary">
										<?php the_field( 'pregnancy_treatments_button_text' ) ?>
									</a>
								</div>
							</div>
						</div>
					</section>
					<section class="personal-publication">
						<div class="inner">
							<h2><?php the_field( 'personal_publications_title' ) ?></h2>
							<div>
								<?php the_field( 'personal_publication_content' ) ?>
							</div>
						</div>
					</section>
					<section class="testimonials">
						<div class="inner">
							<div class="row">
								<h2>Testimonials</h2>
								<?php 
									$testimonials = get_field( 'testimonials' );

									   if ( $testimonials ) :
								?>
									<div>
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
								<div class="testimonial-submission">
									<h2><?php the_field( 'submit_testimonial_title' ) ?></h2>
									<div>
										<?php the_field( 'submit_tesimonial_content' ) ?>
									</div>
									<div class="row">
										<div class="col-md-6 col-md-offset-3">
											<?php
												$contact_form = get_field( 'submit_testimonial_form' );

												if ( $contact_form ) {

													echo do_shortcode( '[contact-form-7 id="' . $contact_form->ID . '" title="' . $contact_form->post_title . '"]' );

												}
											?>
										</div>
									</div>
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