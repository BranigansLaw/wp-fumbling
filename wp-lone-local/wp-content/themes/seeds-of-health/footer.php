<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.2
 */

?>

		</div><!-- #content -->

		<footer id="colophon" class="site-footer" role="contentinfo">
			<div class="wrap">
				<?php
				get_template_part( 'template-parts/footer/footer', 'widgets' );
				?>

					<nav class="social-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Footer Social Links Menu', 'twentyseventeen' ); ?>">
						<li class="menu-item menu-item-type-custom menu-item-object-custom">
							<a href="<?php echo get_theme_mod( 'company_facebook' ); ?>" target="_blank">
								<span class="screen-reader-text">Facebook</span>
								<svg class="icon icon-facebook" aria-hidden="true" role="img"> 
									<use href="#icon-facebook" xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-facebook"></use> 
								</svg>
							</a>
						</li>
						<li class="menu-item menu-item-type-custom menu-item-object-custom rainbow">
							<img src="<?php echo get_stylesheet_directory_uri() . '/img/rainbow-icon.png' ?>" />
						</li>
						<li class="menu-item menu-item-type-custom menu-item-object-custom">
							<a href="<?php echo get_theme_mod( 'company_linkedin' ); ?>" target="_blank">
								<span class="screen-reader-text">LinkedIn</span>
								<svg class="icon icon-linkedin" aria-hidden="true" role="img"> 
									<use href="#icon-linkedin" xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-linkedin"></use> 
								</svg>
							</a>
						</li>
					</nav><!-- .social-navigation -->

				<?php
				get_template_part( 'template-parts/footer/site', 'info' );
				?>
			</div><!-- .wrap -->
		</footer><!-- #colophon -->
	</div><!-- .site-content-contain -->
</div><!-- #page -->
<?php wp_footer(); ?>

</body>
</html>
