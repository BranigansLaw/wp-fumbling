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
		T. <span class="phone"><a href="tel:+1<?php echo get_theme_mod( 'company_phone' ) ?>"><?php echo get_theme_mod( 'company_phone' ); ?></a></span> | 
		E. <span class="email"><a href="mailto:<?php echo get_theme_mod( 'company_email' ); ?>"><?php echo get_theme_mod( 'company_email' ); ?></a></span>
	</div>
	<div>Copyright 2018 Seeds of Health Acupuncture</div>
</div><!-- .site-info -->
