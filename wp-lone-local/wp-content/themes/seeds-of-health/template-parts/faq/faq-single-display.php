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
		<div class="thumbnail">
		<?php
			if ( get_field( 'youtube_link' ) ) {

				$youtube_link = get_field( 'youtube_link' );
				parse_str( parse_url( $youtube_link, PHP_URL_QUERY ), $my_array_of_vars ); 

				echo do_shortcode( '[video_lightbox_youtube video_id="' . $my_array_of_vars['v'] . '" width="640" height="480" anchor="click here to open YouTube video" auto_thumb="1"]' );
			}
			else if ( has_post_thumbnail() ) {
				echo '<a href="' . get_permalink() . '">' . wp_get_attachment_image( get_post_thumbnail_id(), 'medium' ) . '</a>';
			}
			else { ?>
				<a href="<?php the_permalink() ?>" class="empty-box">FAQ</a>
		<?php
			}
		?>
		</div>
	</div>
	<div class="col-md-8">
		<h3><?php the_title() ?></h3>
		<?php the_content( '<a class="btn btn-sm" href="' . get_permalink() . '">Learn More</a>' ) ?>
	</div>
</article>