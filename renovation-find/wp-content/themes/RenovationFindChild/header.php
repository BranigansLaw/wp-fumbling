<?php global $smof_data;
/*
 * Header
 *
 */?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">  
	<meta http-equiv="X-UA-Compatible" content="IE=edge">  
	<title><?php wp_title( '|', true, 'right' ); bloginfo('name'); ?></title>
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<link rel="shortcut icon" href="<?php echo $smof_data['favicon_upload']; ?>"/> 
	<?php wp_head();?>
	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
	<script src="<?php echo get_template_directory_uri(); ?>/js/html5shiv.js"></script>
	<script src="<?php echo get_template_directory_uri(); ?>/js/respond.min.js"></script>
	<![endif]-->
	<!--[if lte IE 8]>    
    <![endif]-->	
	<!--[if IE]>
	<style>
	.isotope-hidden { display: none; }
	</style>
	<![endif]-->
	<?php
	if(isset($smof_data['g_select_body']) && $smof_data['g_select_body'] != '0'): ?>
	<link href='https://fonts.googleapis.com/css?family=<?php echo urlencode($smof_data['g_select_body']); ?>:300,400,400italic,500,600,700,700italic&amp;subset=latin,greek-ext,cyrillic,latin-ext,greek,cyrillic-ext,vietnamese' rel='stylesheet' type='text/css' />
	<?php endif;	
	get_template_part( 'css/mystyle', 'page' ); ?>
</head>
<body <?php body_class('boxedlayout'); ?>>
	<div class="boxedcontent">
		<div class="header">
			  <div class="container">
				<div class="row">
					<?php 
					if($smof_data['wowlogo_upload'] != '') { ?>
						<a class="navbar-brand" href="<?php echo home_url(); ?>">
							<img src="<?php echo $smof_data['wowlogo_upload']; ?>" alt="">
						</a>					
					<?php } else { ?>
						<a class="text-logo" href="<?php echo home_url(); ?>" title="<?php echo esc_attr(get_bloginfo('name')); ?>">
							<?php echo esc_attr(get_bloginfo('name')); ?>
						</a>
						<div class="navbar-text"><?php echo esc_attr( get_bloginfo( 'description') ); ?></div>
					<?php } ?>

					<div class="header-shortcode-box"><?php echo do_shortcode( '[RenovationFindBlogSelect]' ) ?></div>
				
					<?php 
					if($smof_data['header_socialicons'] != '') {
					echo '<ul class="social-icons list-soc header text-right">';
					echo $smof_data['header_socialicons'];
					echo '<ul>';
					}
					
					if($smof_data['header_infotoparea'] != '') {
					echo '<div class="">';
					echo $smof_data['header_infotoparea'];
					echo '</div>';
					} ?>
					
				</div>
			</div>
		</div>
		
		<div class="container">
		<nav class="navbar" role="navigation">				
			<?php
				if ( has_nav_menu( 'header' ) ) {							
				  wp_nav_menu( array(
					'theme_location'  => 'header',
					'container_class' => 'collapse navbar-collapse',
					'menu_class'      => 'nav navbar-nav',
					'menu_id'         => 'main-menu',
					'fallback_cb' 	  => false,
					'walker'          => new Cwd_wp_bootstrapwp_Walker_Nav_Menu()
				  ) );
				}
			?>
			<div class="headersearch">
			<form role="search" method="get" id="search" class="formheadersearch" action="<?php echo esc_url( home_url( '/' ) ); ?>">
				<input type="search" class="search-field" placeholder="<?php echo esc_attr_x( 'Enter search keywords here &hellip;', 'placeholder', 'tdwowbiscaya' ); ?>" value="<?php echo esc_attr( get_search_query() ); ?>" name="s" title="<?php _ex( 'Search for:', 'label', 'tdwowbiscaya' ); ?>">
				<input type="submit" class="search-submit" value="<?php echo esc_attr_x( '', 'submit button', 'tdwowbiscaya' ); ?>">
			</form>
			</div>
		</nav>
		<div class="menushadow"></div>
		</div>