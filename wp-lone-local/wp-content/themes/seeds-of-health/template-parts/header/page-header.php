<?php
/**
 * Displays header page info
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */
?>
<header class="seeds-subtitle-header">
	<div class="inner">
		<h1><?php the_title() ?></h1>
		<div class="header-image-container">
			<?php
				if ( has_post_thumbnail() ) {
					echo wp_get_attachment_image( get_post_thumbnail_id(), 'medium' );
				}
				else { ?>
					<div class="empty-box">Empty Box</div>
			<?php
				}
			?>
		</div>
		<h2><?php the_field( 'subtitle' ) ?></h2>
		<div><?php the_content() ?></div>
	</div>
</header>