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

<article class="faq-detail">
	<header class="header">
		<?php
			if ( get_field( 'youtube_link' ) ) {

				$youtube_link = get_field( 'youtube_link' );
				parse_str( parse_url( $youtube_link, PHP_URL_QUERY ), $my_array_of_vars ); 

		?>
			<iframe width="560" height="315" src="https://www.youtube-nocookie.com/embed/<?php echo $my_array_of_vars['v'] ?>?rel=0&amp;showinfo=0" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>

		<?php
			}
			else if ( has_post_thumbnail() ) {
				echo '<a href="' . get_permalink() . '">' . wp_get_attachment_image( get_post_thumbnail_id(), 'full' ) . '</a>';
			}
		?>
	</header>
	<section class="content">
		<h3><?php the_title() ?></h3>
		<?php the_content( '<a class="btn btn-sm" href="' . get_permalink() . '">Learn More</a>' ) ?>
	</section>
</article>