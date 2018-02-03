<?php
/**
 * Displays service information
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */
?>
<article class="service">
	<h2><?php the_title() ?></h3>
	<h4>$<?php the_field( 'price' ) ?>.00</h4>
	<div>
		<?php the_content( '<a class="btn btn-sm" href="' . get_permalink() . '">Learn More</a>' ) ?>
	</div>
</article>