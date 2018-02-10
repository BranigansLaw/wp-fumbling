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
<li class="service">
	<span><?php the_title() ?> <?php echo ( get_field( 'time' ) ? "(" . get_field( 'time' ) . ")" : "" ) ?></span><span><?php the_field( 'price' ) ?></span>

	<?php
	if ( have_rows( 'bullets' ) ) :
	?>
	<ul>
		<?php
		while ( have_rows( 'bullets' ) ) : the_row()
		?>
		<li>
			<?php the_sub_field( 'bullet_text' ) ?>
			<?php if ( get_sub_field( 'duration' ) ) : ?>
			(<?php the_sub_field( 'duration' ) ?>)
			<?php endif; ?>
		</li>
		<?php
		endwhile;
		?>
	</ul>
	<?php
	endif;
	?>
</li>