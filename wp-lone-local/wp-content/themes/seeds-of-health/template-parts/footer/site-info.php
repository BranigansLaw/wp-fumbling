<?php
/**
 * Displays footer site info
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

?>
<div class="site-info">
	<div class="footer-page-title"><?php bloginfo( 'name' ); ?></div>
	<div>
		<span class="address"><?php echo get_theme_mod( 'company_address' ); ?></span> | 
		T. <span class="phone"><?php echo get_theme_mod( 'company_phone' ); ?></span> | 
		E. <span class="email"><?php echo get_theme_mod( 'company_email' ); ?></span>
	</div>
	<div>Copyright 2018 Seeds of Health Acupuncture</div>
</div><!-- .site-info -->
