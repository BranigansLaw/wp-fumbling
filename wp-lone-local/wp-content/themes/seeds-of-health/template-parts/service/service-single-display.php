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
	<h3>Service: <?php the_title() ?>: $<?php the_field( 'price' ) ?></h3>
	<div>
		<?php the_content() ?>
	</div>
</article>