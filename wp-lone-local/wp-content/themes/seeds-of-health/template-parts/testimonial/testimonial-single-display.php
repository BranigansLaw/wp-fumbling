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
<article class="testimonial">
	<p>
		<?php the_field( 'testimonial' ) ?> —
		<span class="patient-name"><?php the_field( 'patient_name' ) ?></span>
		<span class="treatment-received">(<?php the_field( 'treatment_received' ) ?>)</span>
	</p>
</article>