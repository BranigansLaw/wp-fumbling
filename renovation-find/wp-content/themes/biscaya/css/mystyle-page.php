<style>
<?php
global $smof_data; // Custom Sink & Styles
if($smof_data['ownskin_color'] != '') { ?>
a, .colortext, code, .navbar-collapse .nav>li>a:hover, .infoareaicon, .fontawesome-icon.circle-white, .wowmetaposts span a:hover, h1.widget-title,.testimonial-name, .mainthemetextcolor, .icon-box-top h1:hover, .icon-box-top.active a h1 {color:<?php echo $smof_data['ownskin_color']; ?>;} 
.captionicons, .colorarea, .mainthemebgcolor , .dropdown-menu>li>a:hover, .dropdown-menu>li>a:focus, .dropdown-menu>.active>a:hover, .dropdown-menu>.active>a:focus,.icon-box-top i:hover, .grey-box-icon:hover .fontawesome-icon.circle-white,.grey-box-icon.active .fontawesome-icon.circle-white,.active i.fontawesome-icon,.widget_tag_cloud a, .tagcloud a, #back-top a:hover span, .add-on, #commentform input#submit, .featured .wow-pricing-per, .featured .wow-pricing-cost, .featured .wow-pricing-button .wow-button, .buttoncolor, ul.social-icons li, #skill i , .btn-primary, .pagination .current, .ui-tabs-active, footer#colophon a:hover,  .btn-primary:hover, .btn-primary:focus, .btn-primary:active, .btn-primary.active, .open .dropdown-toggle.btn-primary, footer#colophon .totop, span.htitle, .navbar-collapse .nav>li>a:hover, .navbar-nav>.active  {background-color: <?php echo $smof_data['ownskin_color']; ?>;} 
 #filter ul li .selected, .pagination .current {background-color:<?php echo $smof_data['ownskin_color']; ?> !Important;} 
 #search a,#search input.search-submit {background:<?php echo $smof_data['ownskin_color']; ?> url(<?php echo get_template_directory_uri(); ?>/img/part-btn-search.png) no-repeat center center;}
.wow-pricing-table>div.featured,.wow-accordion .wow-accordion-trigger.ui-state-active {border-top: <?php echo $smof_data['ownskin_color']; ?> 3px solid;}
.panel, .panel1 {border-left: 8px solid <?php echo $smof_data['ownskin_color']; ?>;}
footer#colophon h1 {border-bottom:1px solid <?php echo $smof_data['ownskin_color']; ?>;}
::selection {background: <?php echo $smof_data['ownskin_color']; ?>;color: #fff;text-shadow: none;}
.pgheadertitle:after {border-top:9px solid <?php echo $smof_data['ownskin_color']; ?>;}
.boxedcontent {border-top: 5px solid <?php echo $smof_data['ownskin_color']; ?>;}
<?php } ?>


body {	
	color:<?php echo $smof_data['body_font']['color']; ?>;	
	font-size: <?php echo $smof_data['body_font']['size']; ?>;	
	<?php
	if($smof_data['g_select_body'] != '0') {
		$font = '"'.$smof_data['g_select_body'].'", Arial, Helvetica, sans-serif !important';?>
	font-family:<?php echo $font;
	} else { ?>	
	font-family: <?php echo $smof_data['body_font']['face']; ?>;
	<?php } ?>
}

<?php if($smof_data['switch_themelayouts'] == '1') {	?>
	 body {margin-top: 79px; background:<?php echo $smof_data['body_background_color']; ?> url(<?php if($smof_data['custom_bg']): echo $smof_data['custom_bg']; endif; ?>); }
	.boxedlayout{max-width: 90%; margin: 0px auto;-moz-box-shadow: 0 0 14px rgba(0,0,0,0.15);-webkit-box-shadow: 0 0 14px rgba(0,0,0,0.15);box-shadow: 0 0 14px rgba(0,0,0,0.15);}
	.boxedcontent {z-index: 1;position: relative;}	
	.container {width: 95.25%;max-width: 100%;}
	.boxedlayout{max-width: <?php echo $smof_data['boxed_width']; ?>;margin:0px auto;margin-top: 40px;margin-bottom: 50px;}
	.graysection {margin-left: -40px;margin-right: -40px;}
	
	<?php if($smof_data['bgbody_upload'] != '') { ?>
	 body {background:<?php echo $smof_data['body_background_color']; ?> url(<?php echo $smof_data['bgbody_upload'];?>); 
			background-attachment:<?php echo $smof_data['bg_attachment']; ?>; background-repeat:<?php echo $smof_data['bg_repeat']; ?>;
			
			<?php if($smof_data['bg_full'] == '1') { ?>
				 -webkit-background-size: cover;
				  -moz-background-size: cover;
				  -o-background-size: cover;
				  background-size: cover;
				  background-attachment:fixed;
				  background-repeat:no-repeat;
				  background-position:center center;
			<?php } ?>
			
			}			
	
	<?php } ?>
	
<?php } ?>

h1, h2, h3, h4, h5, h6, .h1, .h2, .h3, .h4, .h5, .h6, .maintitle {	
	<?php
	if($smof_data['g_select_body'] != '0') {
		$font = '"'.$smof_data['g_select_body'].'", Arial, Helvetica, sans-serif !important';?>
	font-family:<?php echo $font;?>;
	<?php } ?>
}

<?php print($smof_data['custom_css']) ?>
</style>