<?php
/**
 * Displays testimonial information
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */
?>

<article class="faq row">
	<div class="col-md-4">
		<?php
			if ( get_field( 'youtube_link' ) ) {
				echo "Show YouTube Video: " . get_field( 'youtube_link' );
			}
			else if ( has_post_thumbnail() ) {
				echo wp_get_attachment_image( get_post_thumbnail_id(), 'medium' );
			}
			else { ?>
				<div class="empty-box">Empty Box</div>
		<?php
			}
		?>
	</div>
	<div class="col-md-8">
		<h3><?php the_title() ?></h3>
		<?php the_content( '<a class="btn btn-sm" href="' . get_permalink() . '">Learn More</a>' ) ?>
	</div>
</article>