<?php 
add_action('admin_head', 'shortcode_button');

function shortcode_button() {
echo'<style>.mceIcon.mce_mygallery_button{background:url('.get_bloginfo('template_directory').'/inc/shortcodes/img/shortcodes.png) no-repeat  !important;width:20px;height:20px;cursor:pointer;}</style>';
}

/*********************************************************************************************
SHORTCODES IN WIDGETS
*********************************************************************************************/
add_filter('widget_text', 'do_shortcode');

/*********************************************************************************************
CLEAN SHORTCODES
*********************************************************************************************/
function wpex_clean_shortcodes($content){   
    $array = array (
        '<p>[' => '[', 
        ']</p>' => ']', 
        ']<br />' => ']'
    );
    $content = strtr($content, $array);
    return $content;
}
add_filter('the_content', 'wpex_clean_shortcodes');

/*********************************************************************************************
ACCORDION

[wow_accordion]
[wow_accordion_section title="Title 1"]Content one[/wow_accordion_section]
[wow_accordion_section title="Title 2"]Content two[/wow_accordion_section]
[/wow_accordion]
*********************************************************************************************/
// MainPart Shortcode
if( !function_exists('wow_accordion_main_shortcode') ) {

	function wow_accordion_main_shortcode( $atts, $content = null  ) {
		
		// Enque scripts
		wp_enqueue_script('jquery-ui-accordion');
		wp_enqueue_script('wow_accordion');
		
		// Display the accordion	
		return '<div class="wow-accordion">' . do_shortcode($content) . '</div>';
	}
	add_shortcode( 'wow_accordion', 'wow_accordion_main_shortcode' );
}


// SectionPart Shortcode
if( !function_exists('wow_accordion_section_shortcode') ) {
	
	function wow_accordion_section_shortcode( $atts, $content = null  ) {
		extract( shortcode_atts( array(
		  'title' => 'Title',
		), $atts ) );
		  
	   return '<h3 class="wow-accordion-trigger fontbold"><a href="#">'. $title .'</a></h3><div>' . do_shortcode($content) . '</div>';
	}
	
	add_shortcode( 'wow_accordion_section', 'wow_accordion_section_shortcode' );
}

/*********************************************************************************************
BOXES [wow_box color="olive/blue/green/red/gray/yellow/white" float="left/right/none" text_align="center" width="50%"] [/wow_box]
*********************************************************************************************/
if( !function_exists('boxes_shortcode') ) { 
	function boxes_shortcode( $atts, $content = null ) {
		extract( shortcode_atts( array(
			'color' => '',
			'float' => '',
			'text_align' => '',
			'width' => ''
		  ), $atts ) );
		  $alert_content = '';
		  $alert_content .= '<div class="box' . $color . ' coloredbox pull-'.$float.'" style="text-align:'. $text_align .'; width:'. $width .';"><div class="padding15">';
		  $alert_content .= ' '. do_shortcode($content) .'</div></div>';
		  return $alert_content;
	}
	add_shortcode('wow_box', 'boxes_shortcode');
}

/*********************************************************************************************
BOXFANCY 1 [wow_fancybox1 title="My Title" icon="star" hidelink="yes/no" link=""][/wow_fancybox1]
*********************************************************************************************/
if( !function_exists('wow_fancybox1_shortcode') ) {
	function wow_fancybox1_shortcode( $atts, $content = null ) {
		extract( shortcode_atts( array(	
	   'title' => 'My New Box',
	   'hidelink' => 'yes',
	   'link' => '',	   
	   'icon' => ''
	   ), $atts ) );
	   
	   //set variables
		$hide_link = ( $hidelink == 'yes' ) ? 'wowhideme' : NULL;
	   
	   return '<div class="box1"><div class="striped"></div><h6><i class=" fa fa-'. $icon . ' "></i> '. $title . ' </h6>'. do_shortcode($content) .'<span class="boxlink '. $hide_link .' "><a href=" '. $link . ' " class="defaultbutton mainthemebgcolor"><i class="fa fa-link"></i></a></span></div>';
	}
	add_shortcode( 'wow_fancybox1', 'wow_fancybox1_shortcode' );
}

/*********************************************************************************************
BOXFANCY 2 [wow_fancybox2 icon="tags" title="My Title"]...[/wow_fancybox2]
*********************************************************************************************/
if( !function_exists('wow_fancybox2_shortcode') ) {
	function wow_fancybox2_shortcode( $atts, $content = null ) {
		extract( shortcode_atts( array(	
	   'title' => 'My New Box',
	   'icon' => ''
	   ), $atts ) );
	   
	   return '<h1 class="fancybox2 title fontregular"><i class="fa fa-'. $icon . ' "></i> '. $title . ' </h1><div class="fancybox2">'. do_shortcode($content) .'</div>';
	}
	add_shortcode( 'wow_fancybox2', 'wow_fancybox2_shortcode' );
}

/*********************************************************************************************
BOXFANCY 3 [wow_fancybox3 icon="microphone" title="My Title" description="my description here" linktext="contact us" linkurl="#"]
*********************************************************************************************/
if( !function_exists('wow_fancybox3_shortcode') ) {
	function wow_fancybox3_shortcode( $atts, $content = null ) {
		extract( shortcode_atts( array(	
	   'title' => '',
	   'description' => '',
	   'icon' => '',
	   'linktext' => '',
	   'linkurl' => ''
	   ), $atts ) );
	   
	   return '<div class="col-md-4"><i class="fa fa-'.$icon.' infoareaicon"></i><div class="infoareawrap"><h1 class="text-center subtitle">'.$title.'</h1><p class="text-center">'.$description.'</p><p class="text-center"><a href="'.$linkurl.'">'.$linktext.'</a></p></div></div>';
	}
	add_shortcode( 'wow_fancybox3', 'wow_fancybox3_shortcode' );
}


/*********************************************************************************************
BOX SHADOW [wow_boxsh effect="2"]...[/wow_boxsh]
*********************************************************************************************/
// MainPart Shortcode
if( !function_exists('wow_boxsh_shortcode') ) {

	function wow_boxsh_shortcode( $atts, $content = null  ) {
		 extract( shortcode_atts( array(
			'effect' => ''
		), $atts ) );
		
		return '<div class="box effect' . $effect . '">' . do_shortcode($content) . '</div>';
	}
	
	add_shortcode( 'wow_boxsh', 'wow_boxsh_shortcode' );
}


/********************************************************************************************************************
BUTTONS [wow_button type="square/round" size="small/medium/big" color="mainthemebgcolor/blue/green/orange/black/violet/red/yellow/teal" fancy="shadow/noshadow" url="#" text="Download" blank="true/false"]
*********************************************************************************************************************/
function buttons( $atts, $content = null ) {
	extract( shortcode_atts( array(
	'type' => 'round', /* round, square */
	'icon' => '', 
	'size' => 'medium', /* small, medium, big */
	'color' => 'blue', /* mainthemebgcolor, blue, green, orange, black, violet, red, yellow, teal */
	'fancy' => 'noshadow', /* shadow, noshadow */
	'url'  => '',
	'blank'     => 'false',
	'text' => '', 
	), $atts ) );
	
	$blank_link = '';
	if ( $blank == 'true' )
		$blank_link = "target=\"_blank\"";
	
	$output = '<a href="' . $url . '"  '.$blank_link.' class="sbutton '. $type . ' ' .$fancy. ' '. $size . ' ' . $color;
	$output .= '">';
	$output .= '<i class="fa fa-'.$icon.'"></i> '.$text;
	$output .= '</a>';
	
	return $output;
}

add_shortcode('wow_button', 'buttons');


/*********************************************************************************************
CALL TO ACTION [wow_callaction title="Hello" description="some description" btn1="Get Theme" btn1icon="shopping-cart" btn1link="#" btn2="Learn More" btn2icon="microphone" btn2link="#"]
*********************************************************************************************/
if( !function_exists('wow_callaction') ) {
function wow_callaction_shortcode($atts, $content = null) {
	extract(shortcode_atts(array(
      "title" => 'Hello World',
	  "description" => 'Win a free theme today',
	  "btn1" => 'Get Asher',
	  "btn1icon" => 'shopping-cart',
	  "btn1link" => '#',
	  "btn2" => 'Learn More',
	  "btn2icon" => 'microphone',
	  "btn2link" => '#',
   ), $atts));
return '<div class="calltoactionarea text-center" style="padding-top:30px;"><h1>'.$title.'</h1><p>'.$description.'</p><a href="'.$btn1link.'" class="buttonblack"><i class="fa fa-'.$btn1icon.'"></i> '.$btn1.'</a>   <a href="'.$btn2link.'" class="buttoncolor mainthemebgcolor"><i class="fa fa-'.$btn2icon.'"></i> '.$btn2.'</a></div>';
}
add_shortcode( 'wow_callaction', 'wow_callaction_shortcode' );
}


/*********************************************************************************************
CLEAR [wow_clear]
*********************************************************************************************/
if( !function_exists('wow_clear_floats_shortcode') ) {
	function wow_clear_floats_shortcode() {
	   return '<div class="clearfix"></div>';
	}
	add_shortcode( 'wow_clear', 'wow_clear_floats_shortcode' );
}

/*********************************************************************************************
COLORME [wow_colorme]...[/wow_colorme]
*********************************************************************************************/
if( !function_exists('wow_colorme') ) {
function wow_colorme_shortcode( $atts, $content = null ) {
   return '<span class="mainthemetextcolor">'.do_shortcode($content).'</span>';
}
add_shortcode('wow_colorme', 'wow_colorme_shortcode');
}


/*********************************************************************************************
CONTACT  [wow_contact email=youraddress@email.com]
*********************************************************************************************/
function mytheme_enqueue_scripts() {
   // Enque scripts
		wp_enqueue_script('wowplaceholder');
}
add_action('wp_enqueue_scripts', 'mytheme_enqueue_scripts');
$cs_base_dir = get_template_directory_uri(); 

function pippin_shortcode_contact( $atts, $content = null)	{
 
	// gives access to the plugin's base directory
	global $cs_base_dir;
 
	extract( shortcode_atts( array(
      'email' => get_bloginfo('admin_email')
      ), $atts ) ); 
 
	$content .= '
		<script type="text/javascript"> 
			var $j = jQuery.noConflict();
			$j(window).load(function(){				
				$j("#contact-form").submit(function() {
				  // validate and process form here
					var str = $j(this).serialize();					 
					   $j.ajax({
					   type: "POST",
					   url: "' . $cs_base_dir . '/sendmail.php",
					   data: str,
					     success: function(msg){						
							$j("#note").ajaxComplete(function(event, request, settings)
							{ 
								if(msg == "OK") // Message Sent? Show the Thank You message and hide the form
								{
									result = "Your message has been sent. Thank you!";
									$j("#fields").hide();
								}
								else
								{
									result = msg;
								}								 
								$j(this).html(result);							 
							});					 
						}	
					 });					 
					return false;
				});			
			});
		</script>';
		
        // now we put all of the HTML for the form into a PHP string
		$content .= '<div id="post-a-comment" class="clear">';
			$content .= '<div id="fields">';
				$content .= '<form id="contact-form">';
					$content .= '<input name="to_email" type="hidden" id="to_email" value="' . $email . '"/>';
					$content .= '';
						$content .= '<input name="name" type="text" id="name" class="smoothborder" placeholder="' . __('Your Name *', 'asher').'"/>';
					$content .= '<br/>';
					$content .= '';
						$content .= '<input name="email" type="text" id="email" class="smoothborder" placeholder="' . __('E-mail address *', 'asher').'"/>';
					$content .= '<br/>';
					
					$content .= '<textarea rows="6" name="message" class="smoothborder" placeholder="' . __('Message *', 'asher').'"></textarea><br/>';
					$content .= '<input type="submit" value="' . __('Submit', 'asher').'" class="btn btn-primary" id="contact-submit" />';
				$content .= '</form>';
			$content .= '</div><!--end fields-->';
			$content .= '<br/><div id="note"></div> <!--notification area used by jQuery/Ajax -->';
		$content .= '</div>';
	return $content;
}
add_shortcode('wow_contact', 'pippin_shortcode_contact');

/*********************************************************************************************
DIVIDER [divider]
*********************************************************************************************/
if( !function_exists('divider_shortcode') ) {
function divider_shortcode($atts, $content = null) {	
return '<hr>';
}
add_shortcode("wow_divider", "divider_shortcode");
}

/*********************************************************************************************
GOOGLE MAP [wow_googlemap src="Your Map Full Url" width="100%" height="480px"]
*********************************************************************************************/
if( !function_exists('google_maps_shortcode') ) {
function google_maps_shortcode($atts, $content = null) {
	extract(shortcode_atts(array(
      "width" => '%',
      "height" => '',
      "src" => ''
   ), $atts));
	
return '<iframe class="gmap" style="width:'.$width.'; height:'.$height.'; margin:5px 0 0 0; border:0px;" src="'.$src.'&amp;output=embed"></iframe>';
}
add_shortcode("wow_googlemap", "google_maps_shortcode");
}

/*********************************************************************************************
ICON [wow_icon type="star" size="13"]
*********************************************************************************************/
if( !function_exists('wow_icon_shortcode') ) {
function wow_icon_shortcode($atts, $content = null) {
	extract(shortcode_atts(array(
      "type" => 'user',
	  "size" => 'user',
   ), $atts));
return '<i class="fa fa-'.$type.'" style="font-size:'.$size.'px;"></i>';
}
add_shortcode("wow_icon", "wow_icon_shortcode");
}


/*********************************************************************************************
LEAD [wow_lead]...[/wow_lead]
*********************************************************************************************/
if( !function_exists('wow_lead_shortcode') ) {
function wow_lead_shortcode($atts, $content = null) {
	extract(shortcode_atts(array(
       
   ), $atts) );
	return '<div class="row text-center intro"><div class="col-md-12"><div class="featured lead">' . do_shortcode($content) . '</div></div></div>';
	
}
add_shortcode("wow_lead", "wow_lead_shortcode");
}


/*********************************************************************************************
LIST STYLES
[wow_list style="check/circleok/arrow/star/doublearrow/chevron/hand/thumb/asterisk/circlearrow/circleplus/longarrow"]<li>Cars</li><li>Dolls</li>[/wow_list]
*********************************************************************************************/
if( !function_exists('wow_list_shortcode') ) {
	function wow_list_shortcode( $atts, $content = null  ) {
		extract( shortcode_atts( array(
			'style' => '',
		  ),
		  $atts ) );
	 return '<div class="unstyle"><ul class="'. $style .'list">' . do_shortcode($content) . '</ul></div>';
	}
	add_shortcode( 'wow_list', 'wow_list_shortcode' );
}

/*********************************************************************************************
PANEL
[wow_panel]...[/wow_panel]
*********************************************************************************************/
if( !function_exists('wow_panel_shortcode') ) {

	function wow_panel_shortcode( $atts, $content = null  ) {	
			
		return '<div class="panel">' . do_shortcode($content) . '</div>';
	}
	add_shortcode( 'wow_panel', 'wow_panel_shortcode' );
}


/*********************************************************************************************
PANEL 1
[wow_panel1]...[/wow_panel1]
*********************************************************************************************/
if( !function_exists('wow_panel1_shortcode') ) {

	function wow_panel1_shortcode( $atts, $content = null  ) {	
	
		return '<div class="panel1">' . do_shortcode($content) . '</div>';
	}
	add_shortcode( 'wow_panel1', 'wow_panel1_shortcode' );
}

/*********************************************************************************************
PANEL 2
[wow_actionpanel icon="link" actiontext="Download" link="#"]...[/wow_actionpanel]
*********************************************************************************************/
// MainPart Shortcode
if( !function_exists('wow_actionpanel_shortcode') ) {

	function wow_actionpanel_shortcode( $atts, $content = null  ) {
		 extract( shortcode_atts( array(
			'icon' => '',
			'actiontext' => '',
			'link' => ''
		), $atts ) );
		
		return '<div class="info-box shadow-large"><div class="info-box-inner"><div class="info-content">' . do_shortcode($content) . '</div><a style="float: right;" class="btn btn-primary btn-large" href="' . $link . '"><i class="fa fa-' . $icon . '"></i> '. $actiontext .'</a><div class="clearfix"></div></div></div>';
	}
	add_shortcode( 'wow_actionpanel', 'wow_actionpanel_shortcode' );
}

/*********************************************************************************************
PRICING TABLE 

[wow_pricing_table size="col-md-4"]
[wow_pricing plan="Gold" cost="$29.99" per="per month" button_url="#" button_text="Sign Up" button_target="self" button_rel="nofollow" featured="yes"]
<ul>
	<li>5 products</li>
	<li>1 image per product</li>
	<li>basic stats</li>
	<li>non commercial</li>
</ul>
[/wow_pricing]
[/wow_pricing_table]

*********************************************************************************************/
 
/*main*/
if( !function_exists('wow_pricing_table_shortcode') ) {
	function wow_pricing_table_shortcode( $atts, $content = null  ) {
	   extract( shortcode_atts( array(
			'size' => 'col-md-4'
		), $atts ) );
	   return '<div class="wow-pricing-table '. $size .'">' . do_shortcode($content) . '</div>';
	}
	add_shortcode( 'wow_pricing_table', 'wow_pricing_table_shortcode' );
}

/*section*/
if( !function_exists('wow_pricing_shortcode') ) {
	function wow_pricing_shortcode( $atts, $content = null  ) {
		
		extract( shortcode_atts( array(
			'position' => '',
			'featured' => 'no',
			'plan' => 'Basic',
			'cost' => '$20',
			'per' => 'month',
			'button_url' => '#',
			'button_text' => 'Purchase',			
			'button_target' => 'self',
			'button_rel' => 'nofollow'			
		), $atts ) );
		
		//set variables
		$featured_pricing = ( $featured == 'yes' ) ? 'featured' : NULL;
				
		//start content  
		$pricing_content ='';
		$pricing_content .= '<div class="wow-pricing '. $featured_pricing .' wow-column-'. $position. '">';
			$pricing_content .= '<div class="wow-pricing-header">';
				$pricing_content .= '<h5>'. $plan. '</h5>';
				$pricing_content .= '<div class="wow-pricing-cost">'. $cost .'</div><div class="wow-pricing-per">'. $per .'</div>';
			$pricing_content .= '</div>';
			$pricing_content .= '<div class="wow-pricing-content">';
				$pricing_content .= ''. $content. '';
			$pricing_content .= '</div>';
			if( $button_text ) {
				$pricing_content .= '<div class="wow-pricing-button"><a href="'. $button_url .'" class="wow-button buttonprice" target="_'. $button_target .'" rel="'. $button_rel .'"><span class="wow-button-inner">'. $button_text .'</span></a></div>';
			}
		$pricing_content .= '</div>';  
		return $pricing_content;
	}
	
	add_shortcode( 'wow_pricing', 'wow_pricing_shortcode' );
}



/*********************************************************************************************
PRIVATE CONTENT [wow_member]This text will be only displayed to registered users.[/wow_member]  
*********************************************************************************************/
function cwc_member_check_shortcode( $atts, $content = null ) {  
     if ( is_user_logged_in() && !is_null( $content ) && !is_feed() )  
         return do_shortcode($content);
    return '';  
}  
  
add_shortcode( 'wow_member', 'cwc_member_check_shortcode' );  

/*********************************************************************************************
PROGRESS BAR
[wow_skills]
[skill width="100%" icon="legal" text="Legal Issues"]
[skill width="100%" icon="legal" text="Legal Issues"]
[/wow_skills]
*********************************************************************************************/
// MainPart Shortcode
if( !function_exists('wow_skills_shortcode') ) {

	function wow_skills_shortcode( $atts, $content = null  ) {
		 extract( shortcode_atts( array(
			'icon' => '',
			'actiontext' => '',
			'link' => ''
		), $atts ) );
		
		return '<ul id="skill">' . do_shortcode($content) . '</ul>';
	}
	
	add_shortcode( 'wow_skills', 'wow_skills_shortcode' );
}


if( !function_exists('skill_shortcode') ) {

	function skill_shortcode( $atts, $content = null  ) {
		 extract( shortcode_atts( array(
			'icon' => '',
			'text' => '',
			'width' => ''
		), $atts ) );
		
		return '<li><span class="thebar progressdefault" style="width:' . $width . ';"></span><h3 class="fontregular"><i class="fa fa-' . $icon . '"></i> ' . $text . '</h3></li>';
	}
	
	add_shortcode( 'skill', 'skill_shortcode' );
}



/*********************************************************************************************
RECENT POSTS [wow_recentposts bloglink="#"]
*********************************************************************************************/
function my_recent_posts_shortcode($atts){
extract(shortcode_atts(array(      
	  "bloglink" => ''
), $atts) );
 $q = new WP_Query( 
   array( 'orderby' => 'date', 'posts_per_page' => '4', 'ignore_sticky_posts' => 1) 
 );
global $post;
$list = '<div class="row recent-posts"><div class="clearfix"></div> <ul class="unstyle">';

while($q->have_posts()) : $q->the_post();

$list .= '<li class="col-md-3 unstyle"><article><a class="imgOpa" href="' . get_permalink() . '">' . get_the_post_thumbnail ($post->ID, 'recentprojects-thumb') . '</a><div class="insidetext"><h1><a href="' . get_permalink() . '">' . get_the_title() . '</a></h1>' . '<div class="date"><span class="day mainthemebgcolor">' . get_the_time('d') . '</span><span class="month">' . get_the_time('M') . '</span></div><p>' . get_custom_excerpt(115) . ' <a href="' . get_permalink() . '"> <span class="mute">[...]</span> </a></p></div></article></li>';

endwhile;

wp_reset_query();

return $list . '</ul></div><div class="clearfix"></div>';

}

add_shortcode('wow_recentposts', 'my_recent_posts_shortcode');


/*********************************************************************************************
RECENT PORTFOLIO [wow_recentportfolio]
*********************************************************************************************/
function my_recent_portfolio_shortcode($atts){
		wp_enqueue_script('carouselrecentportfoliojs');
		wp_enqueue_script('carouseljs');
		wp_enqueue_script('prettyphotojs'); 
		wp_enqueue_script('isotopejs');
   $q = new WP_Query( 
   array( 'orderby' => 'date', 'posts_per_page' => '8', 'post_type' => 'masonry-portfolio', 'ignore_sticky_posts' => 1) 
 );


$list = '<div class="recent-portfolio"><div class="list_carousel"><div class="carousel_nav"><a class="prev" id="car_prev" href="#"><span>prev</span></a><a class="next" id="car_next" href="#"><span>next</span></a></div><div class="clearfix"></div> <ul id="recent-portfolio">';

while($q->have_posts()) : $q->the_post();
global $post;
global $post_id;
$imgurl = wp_get_attachment_url( get_post_thumbnail_id ($post->ID, 'recentprojects-thumb') );

$list .= '<li><div class="boxcontainer"><a class="imgOpa imgproject" href="' . get_permalink() . '">' . get_the_post_thumbnail ($post->ID, 'recentprojects-thumb') . '</a><div class="roll"><div class="wrapcaption"><a href="' . get_permalink() . '"><i class="fa fa-link captionicons"></i></a>  <a data-gal="prettyPhoto[gallery1]" href="' .$imgurl. '" title="' . get_the_title() . '"><i class="fa fa-search-plus captionicons"></i></a></div></div><h1><a href="' . get_permalink() . '">' . get_the_title() . '</a></h1><p>' . get_the_excerpt() . '</p></div></li>';

endwhile;

wp_reset_query();

return $list . '</ul></div></div><div class="clearfix"></div>';

}

add_shortcode('wow_recentportfolio', 'my_recent_portfolio_shortcode');


/***********************************************************************************************
SLIDER 
[wow_slider]
[wow_image link="fulllinktopic1.jpg" title="Welcome" text="This is my website" fadefrom="Top/Bottom/Left/Right" targetlink="#"]
[wow_image link="fulllinktopic2.jpg" title="Best Services" text="For you and your company" fadefrom="Top/Bottom/Left/Right" targetlink="#"]
[/wow_slider]
*********************************************************************************************/
if( !function_exists('camera_slider_func') ) {
function camera_slider_func( $atts, $content = null ) {
	//Enque camera slider script
	wp_enqueue_script('camerajs');
    $output  =  '<div class="camera_wrap pattern_4 camera_emboss" id="camera_wrap_4">';  
    $output .=  do_shortcode($content);
    $output .=  '</div><div class="text-center"><img src="'.get_template_directory_uri() . '/img/sha.png" class="slidershadowcam" alt=""></div>';
    return $output;
}
add_shortcode( 'wow_slider', 'camera_slider_func' ); 
}

if( !function_exists('camera_image_shortcode') ) {
function camera_image_shortcode( $atts) {
    extract( shortcode_atts( array(
    'link' => '',
	'title' => '',
	'text' => '',
	'targetlink' => '',
	'showtext' => '',
	'fadefrom' => ''
    ), $atts )
    );
    return '<div data-src="'.$link.'"><div class="'.$showtext.' camera_caption fadeFrom'.$fadefrom.'"><a href="'.$targetlink.'"><h1>'.$title.'</h1><span class="mainthemebgcolor">'.$text.'</span></a></div></div>';
}
add_shortcode( 'wow_image', 'camera_image_shortcode' );
}


/***********************************************************************************************
SLIDER FLEXSLIDER
[wow_flexslider]
[wow_fleximage link="fulllinktopic1.jpg"]
[wow_fleximage link="fulllinktopic2.jpg"]
[/wow_flexslider]
*********************************************************************************************/
if( !function_exists('flex_slider_func') ) {
function flex_slider_func( $atts, $content = null ) {
	//Enque camera slider script
	wp_enqueue_script('flexsliderjs');	
	wp_enqueue_script('flexsliderbasicjs');	
    $output  =  '<div class="fullwidth flexslider" id="basic-slider"><ul class="slides">';  
    $output .=  do_shortcode($content);
    $output .=  '</ul></div>';
    return $output;
}
add_shortcode( 'wow_flexslider', 'flex_slider_func' ); 
}

if( !function_exists('flex_image_shortcode') ) {
function flex_image_shortcode( $atts) {
    extract( shortcode_atts( array(
    'link' => ''
    ), $atts )
    );
    return '<li><img src="'.$link.'" alt="slide"></li>';
}
add_shortcode( 'wow_fleximage', 'flex_image_shortcode' );
}


/***********************************************************************************************
SLIDER CONTENT
[wow_contentslider]
[wow_slidertext title="hello" text="some text here"]
[wow_slidertext title="hello" text="some text here"]
[/wow_contentslider]
*********************************************************************************************/
if( !function_exists('contentslider_func') ) {
function contentslider_func( $atts, $content = null ) {
	//Enque camera slider script
	wp_enqueue_script( 'flexsliderjs' );			
	wp_enqueue_script('flexslidertestimonialsjs');
    $output  =  '<div class="testimonial fullwidth flexslider" id="testimonials-slider"><ul class="slides">';  
    $output .=  do_shortcode($content);
    $output .=  '</ul></div>';
    return $output;
}
add_shortcode( 'wow_contentslider', 'contentslider_func' ); 
}

if( !function_exists('slidertext_shortcode') ) {
function slidertext_shortcode( $atts) {
    extract( shortcode_atts( array(
    'title' => '',
	'text' => ''
    ), $atts )
    );
    return '<li><div class="slide-text"><div><h2 class="animated fadeInDown"><span class="uppercase">'.$title.'</span></h2><p>'.$text.'</p></div></div></li>';
}
add_shortcode( 'wow_slidertext', 'slidertext_shortcode' );
}


/*********************************************************************************************
SERVICES 
[wow_wrapservices]
[wow_sbox title="" icon="" link=""]
content here...
[/wow_sbox]
[wow_sbox title="" icon="" link=""]
content here...
[/wow_sbox]
[wow_sbox title="" icon="" link="" active="yes"]
content here...
[/wow_sbox]
[wow_sbox title="" icon="" link=""]
content here...
[/wow_sbox]
[/wow_wrapservices]
*********************************************************************************************/
if( !function_exists('wow_wrapservices') ) {
function wow_wrapservices_shortcode($atts, $content = null) {
	extract(shortcode_atts(array(), $atts) );
	return '<div class="row text-center service-box">' . do_shortcode($content) . '</div>';
	
}
add_shortcode("wow_wrapservices", "wow_wrapservices_shortcode");
}


/*********************************************************************************************
SERVICES 
[wow_grayarea]
[wow_sbox title="" icon="" link="" moretext="Read more"]
content here...
[/wow_sbox]
[wow_sbox title="" icon="" link="" moretext="Read more"]
content here...
[/wow_sbox]
[wow_sbox title="" icon="" link="" active="yes" moretext="Read more"]
content here...
[/wow_sbox]
[wow_sbox title="" icon="" link="" moretext="Read more"]
content here...
[/wow_sbox]
[/wow_grayarea]
*********************************************************************************************/
if( !function_exists('wow_grayarea') ) {
function wow_grayarea_shortcode($atts, $content = null) {
	extract(shortcode_atts(array(
      "title" => ''	  
   ), $atts) );
	return '<div class="graysection text-center"><div class="row">' . do_shortcode($content) . '</div></div>';
	
}
add_shortcode("wow_grayarea", "wow_grayarea_shortcode");
}

/*********************************************************************************************
SERVICES BOX 
*********************************************************************************************/

if( !function_exists('wow_sbox') ) {
function wow_sbox_shortcode($atts, $content = null) {
	extract(shortcode_atts(array(
      "title" => '',
	  "icon" => '',
	  "link" => '',
	  "moretext" => '',
	  "featured" => 'no'
   ), $atts) );
   //set variables
		$featured_sbox = ( $featured == 'yes' ) ? 'active' : NULL;
	return '<div class="col-md-3"><div class="icon-box-top '. $featured_sbox .' "><a href="'.$link.'"><i class="fontawesome-icon medium circle-white center fa fa-'.$icon.'"></i></a><a href="'.$link.'"><h1>'.$title.'</h1></a>' . do_shortcode($content) . '<span class="moretext"><a href="'.$link.'">'.$moretext.'</a></span></div></div>';
	
}
add_shortcode("wow_sbox", "wow_sbox_shortcode");
}



/*********************************************************************************************
SPACING [wow_spacing size="20px"]
*********************************************************************************************/
if( !function_exists('wow_spacing_shortcode') ) {
	function wow_spacing_shortcode( $atts ) {
		extract( shortcode_atts( array(
			'size' => '',
		  ),
		  $atts ) );
	 return '<div style="height: '. $size .'"></div>';
	}
	add_shortcode( 'wow_spacing', 'wow_spacing_shortcode' );
}



/*********************************************************************************************
TEAM BOX
[wow_teambox name="Emma" position="Manager" description="text here" imglink="#"] 
[wow_social icon="facebook" link="#"] 
[wow_social icon="twitter" link="#"] 
[wow_social icon="linkedin" link="#"] 
[wow_social icon="google-plus" link="#"] 
[wow_social icon="pinterest" link="#"] 
[/wow_teambox]
*********************************************************************************************/
// MainPart Shortcode
if( !function_exists('wow_teambox_shortcode') ) {

	function wow_teambox_shortcode( $atts, $content = null  ) {	
	
		extract( shortcode_atts( array(
			'name' => '',
			'position' => '',
			'description' => '',
			'imglink' => ''			
		), $atts ) );
		
		return '<div class="thumbnail"><img src="' . $imglink . '" alt=""><div class="caption"><h4>' . $name . '</h4><span class="fontitalic">' . $position . '</span><p>' . $description . '<br></p><ul class="social-icons">' . do_shortcode($content) . '</ul></div></div>';
	}
	
	add_shortcode( 'wow_teambox', 'wow_teambox_shortcode' );
}

// SecondPart Shortcode
if( !function_exists('wow_social_shortcode') ) {

	function wow_social_shortcode( $atts, $content = null  ) {
		 extract( shortcode_atts( array(
			'icon' => '',
			'link' => ''			
		), $atts ) );
		
		return '<li><a href="' . $link . '"><i class="fa fa-' . $icon . '"></i></a></li>';
	}
	
	add_shortcode( 'wow_social', 'wow_social_shortcode' );
}




/*********************************************************************************************
TESTIMONIAL
[wow_testimonial]
[wow_quote name="John" imglink="#" text="text here"]
[/wow_testimonial]
*********************************************************************************************/
// MainPart Shortcode
if( !function_exists('wow_testimonial_shortcode') ) {

	function wow_testimonial_shortcode( $atts, $content = null  ) {
	
	wp_enqueue_script('wow-testimonial');
	
		 extract( shortcode_atts( array(
			
		), $atts ) );
		
		return '<div id="quotes">' . do_shortcode($content) . '</div>';
	}
	
	add_shortcode( 'wow_testimonial', 'wow_testimonial_shortcode' );
}

// SecondPart Shortcode
if( !function_exists('wow_quote_shortcode') ) {

	function wow_quote_shortcode( $atts, $content = null  ) {
		 extract( shortcode_atts( array(
			'name' => '',
			'imglink' => '',
			'text' => '',
		), $atts ) );
		
		return '<div class="textItem"><div class="avatar"><img src="' . $imglink . '" alt="' . $name . '"></div><p><span style="font-family:arial;">"</span>' . $text . '<span style="font-family:arial;">"</span></p><p><b>' . $name . '</b></p></div>';
	}
	
	add_shortcode( 'wow_quote', 'wow_quote_shortcode' );
}







/*********************************************************************************************
TOGGLE [wow_toggle title="Your title or question"]Your content or answer[/wow_toggle]
*********************************************************************************************/
if( !function_exists('wow_toggle_shortcode') ) {
	function wow_toggle_shortcode( $atts, $content = null ) {
		extract( shortcode_atts( array( 'title' => 'Toggle Title' ), $atts ) );
		 
		// Enque scripts
		wp_enqueue_script('wow_toggle');
		
		// Display the Toggle
		return '<div class="wow-toggle"><h3 class="wow-toggle-trigger">'. $title .'</h3><div class="wow-toggle-container">' . do_shortcode($content) . '</div></div>';
	}
	add_shortcode('wow_toggle', 'wow_toggle_shortcode');
}

/*********************************************************************************************
TOGGLE SIMPLE [toggle title="Toggle Title"]Your content[/toggle]
*********************************************************************************************/
function toggle_shortcode( $atts, $content = null ) {
   extract( shortcode_atts( array(
      'title' => '',
      ), $atts ) );        
   return '<div class="toggle">'.esc_attr($title).'</div><div class="toggle_content"><span class="tc">'.$content.'</span></div>';
}
add_shortcode('toggle', 'toggle_shortcode');

/********************************************************************************************************************
TITLE [wow_title align="left/center" text="This is my title"]
*********************************************************************************************************************/
function title( $atts, $content = null ) {
	extract( shortcode_atts( array(
	'text' => '',
	'align' => 'left',
	), $atts ) );
	
	$output = '<div class="titleborder '.$align.'"><div><h1>';	
	$output .= $text;
	$output .= '</h1></div></div>';
	
	return $output;
}

add_shortcode('wow_title', 'title'); 


// Text features

function dropcap_shortcode( $atts, $content = null ) {
   return '<p class="dropcap"><span class="dropcap">'.$content.'</span></p>';
}
add_shortcode('dropcap', 'dropcap_shortcode');

function highlight_shortcode( $atts, $content = null ) {
   return '<span class="highlight">'.$content.'</span>';
}
add_shortcode('highlight', 'highlight_shortcode');

function highlightbold_shortcode( $atts, $content = null ) {
   return '<span class="highlight-bold fontbold">'.$content.'</span>';
}
add_shortcode('highlightbold', 'highlightbold_shortcode');

// Text boxes
function insetright_shortcode( $atts, $content = null ) {
   extract( shortcode_atts( array(
      'title' => 'Caption',
      ), $atts ) );  
   return '<span class="inset-right fontitalic"><span class="inset-right-title">'.esc_attr($title).'</span>'.$content.'</span>';
}
add_shortcode('insetright', 'insetright_shortcode');

function insetleft_shortcode( $atts, $content = null ) {
   extract( shortcode_atts( array(
      'title' => 'Caption',
      ), $atts ) );  
   return '<span class="inset-left fontitalic"><span class="inset-left-title">'.esc_attr($title).'</span>'.$content.'</span>';
}
add_shortcode('insetleft', 'insetleft_shortcode');

function important_shortcode( $atts, $content = null ) {
   extract( shortcode_atts( array(
      'title' => '',
      ), $atts ) );        
   return '<div class="important"><span class="important-title">'.esc_attr($title).'</span>'.$content.'</div> ';
}
add_shortcode('important', 'important_shortcode');

function notice_shortcode( $atts, $content = null ) {
   return '<div class="notice">'.do_shortcode($content).'</div>';
}
add_shortcode('notice', 'notice_shortcode');

/*********************************************************************************************
H1 TITLE [wow_h1]...[/wow_h1]
*********************************************************************************************/
if( !function_exists('wow_h1') ) {
function wow_h1_shortcode( $atts, $content = null ) {
   return '<h1>'.do_shortcode($content).'</h1>';
}
add_shortcode('wow_h1', 'wow_h1_shortcode');
}

/*********************************************************************************************
H2 TITLE [wow_h2]...[/wow_h2]
*********************************************************************************************/
if( !function_exists('wow_h2') ) {
function wow_h2_shortcode( $atts, $content = null ) {
   return '<h2>'.do_shortcode($content).'</h2>';
}
add_shortcode('wow_h2', 'wow_h2_shortcode');
}

/*********************************************************************************************
H3 TITLE [wow_h3]...[/wow_h3]
*********************************************************************************************/
if( !function_exists('wow_h3') ) {
function wow_h3_shortcode( $atts, $content = null ) {
   return '<h3>'.do_shortcode($content).'</h3>';
}
add_shortcode('wow_h3', 'wow_h3_shortcode');
}

/*********************************************************************************************
H4 TITLE [wow_h4]...[/wow_h4]
*********************************************************************************************/
if( !function_exists('wow_h4') ) {
function wow_h4_shortcode( $atts, $content = null ) {
   return '<h4>'.do_shortcode($content).'</h4>';
}
add_shortcode('wow_h4', 'wow_h4_shortcode');
}

/*********************************************************************************************
H5 TITLE [wow_h5]...[/wow_h5]
*********************************************************************************************/
if( !function_exists('wow_h5') ) {
function wow_h5_shortcode( $atts, $content = null ) {
   return '<h5>'.do_shortcode($content).'</h5>';
}
add_shortcode('wow_h5', 'wow_h5_shortcode');
}








/*********************************************************************************************
BOOTSTRAP SHORTCODES
*********************************************************************************************/

/*----------------------------------------------------------------------------------------*/
/* BOOTSTRAP ALERTS [wow_alert type="block/error/success/info" text="hello"]
/*-----------------------------------------------------------------------------------------*/

function wow_shortcode_alert( $atts, $content = null ) {

	extract( shortcode_atts( array(
		"type" => '',
		"close" => true,
		'color' => '',
		'text' => ''
		), $atts ) );

	return '<div class="alert alert-' . $type . '">' . do_shortcode( $content ) . '<button type="button" class="close" data-dismiss="alert">&times;</button>' . $text . ' </div>';
}

add_shortcode( 'wow_alert', 'wow_shortcode_alert' );


/*----------------------------------------------------------------------------------------*/
/*    PACKAGE
/*-----------------------------------------------------------------------------------------*/

class BoostrapShortcodes {

	function __construct() {
    add_action( 'init', array( $this, 'add_shortcodes' ) ); 
}
	function add_shortcodes() {
	add_shortcode('span', array( $this, 'bs_span' ));
    add_shortcode('row', array( $this, 'bs_row' ));
	add_shortcode('collapsibles', array( $this, 'bs_collapsibles' ));
    add_shortcode('collapse', array( $this, 'bs_collapse' ));
	add_shortcode('table', array( $this, 'bs_table' ));
	add_shortcode('tabs', array( $this, 'bs_tabs' ));
    add_shortcode('tab', array( $this, 'bs_tab' ));
}


    /*--------------------------------------------------------------------------------------    *
    * SPANS 
    *-------------------------------------------------------------------------------------*/
    function bs_span( $atts, $content = null ) {
    extract(shortcode_atts(array(
      "size" => 'size'
    ), $atts));

    return '<div class="col-md-' . $size . '">' . do_shortcode( $content ) . '</div>';

  }
  
  
  
	/*--------------------------------------------------------------------------------------    *
	* ROWS 
    *-------------------------------------------------------------------------------------*/
    function bs_row( $atts, $content = null ) {
    
    return '<div class="shortcode row">' . do_shortcode( $content ) . '</div>';
	
  }
  
    /*--------------------------------------------------------------------------------------    *
    * COLLAPSIBLES 
    *-------------------------------------------------------------------------------------*/
  function bs_collapsibles( $atts, $content = null ) {
    
    if( isset($GLOBALS['collapsibles_count']) )
      $GLOBALS['collapsibles_count']++;
    else
      $GLOBALS['collapsibles_count'] = 0;

    $defaults = array();
    extract( shortcode_atts( $defaults, $atts ) );
    
    // Extract the tab titles for use in the tab widget.
    preg_match_all( '/collapse title="([^\"]+)"/i', $content, $matches, PREG_OFFSET_CAPTURE );
    
    $tab_titles = array();
    if( isset($matches[1]) ){ $tab_titles = $matches[1]; }
    
    $output = '';
    
    if( count($tab_titles) ){
      $output .= '<div class="accordion" id="accordion-' . $GLOBALS['collapsibles_count'] . '">';
      $output .= do_shortcode( $content );
      $output .= '</div>';
    } else {
      $output .= do_shortcode( $content );
    }
    
    return $output;
  }
  



	/*--------------------------------------------------------------------------------------
    *COLLAPSE 
    *-------------------------------------------------------------------------------------*/
  function bs_collapse( $atts, $content = null ) {

    if( !isset($GLOBALS['current_collapse']) )
      $GLOBALS['current_collapse'] = 0;
    else 
      $GLOBALS['current_collapse']++;


    $defaults = array( 'title' => 'Tab', 'state' => '');
    extract( shortcode_atts( $defaults, $atts ) );
    
    if (!empty($state)) 
      $state = 'in';

    return '
    <div class="accordion-group">
      <div class="accordion-heading fontbold">
        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion-' . $GLOBALS['collapsibles_count'] . '" href="#collapse_' . $GLOBALS['current_collapse'] . '_'. sanitize_title( $title ) .'">
          ' . $title . ' 
        </a>
      </div>
      <div id="collapse_' . $GLOBALS['current_collapse'] . '_'. sanitize_title( $title ) .'" class="accordion-body collapse ' . $state . '">
        <div class="accordion-inner">
          ' . $content . ' 
        </div>
      </div>
    </div>
    ';
  }
  
    /*--------------------------------------------------------------------------------------
    *
    * simple_table
    * 
    *-------------------------------------------------------------------------------------*/
  function bs_table( $atts ) {
      extract( shortcode_atts( array(
          'cols' => 'none',
          'data' => 'none',
          'type' => 'type'
      ), $atts ) );
      $cols = explode(',',$cols);
      $data = explode(',',$data);
      $total = count($cols);
      $output = '';
      $output .= '<table class="table table-'. $type .' table-bordered"><tr>';
      foreach($cols as $col):
          $output .= '<th>'.$col.'</th>';
      endforeach;
      $output .= '</tr><tr>';
      $counter = 1;
      foreach($data as $datum):
          $output .= '<td>'.$datum.'</td>';
          if($counter%$total==0):
              $output .= '</tr>';
          endif;
          $counter++;
      endforeach;
          $output .= '</table>';
      return $output;
  }
  
  
    /*--------------------------------------------------------------------------------------
    *
    * bs_tabs
    *
    * @author Filip Stefansson
    * @since 1.0
    * Modified by TwItCh twitch@designweapon.com
    *Now acts a whole nav/tab/pill shortcode solution!
    *-------------------------------------------------------------------------------------*/
  function bs_tabs( $atts, $content = null ) {
    
    if( isset($GLOBALS['tabs_count']) )
      $GLOBALS['tabs_count']++;
    else
      $GLOBALS['tabs_count'] = 0;
    extract( shortcode_atts( array(
    'tabtype' => 'nav-tabs',
    'tabdirection' => '',
  ), $atts ) );
   //DW $defaults = array('tabtype' => 'bla', 'tabdirection' => 'one');
   //DW extract( shortcode_atts( $defaults, array(), $atts ) );
    
    // Extract the tab titles for use in the tab widget.
    preg_match_all( '/tab title="([^\"]+)"/i', $content, $matches, PREG_OFFSET_CAPTURE );
    
    $tab_titles = array();
    if( isset($matches[1]) ){ $tab_titles = $matches[1]; }
    
    $output = '';
    
    if( count($tab_titles) ){
      $output .= '<div class="tabbable tabs-'.$tabdirection.'"><ul class="nav '. $tabtype .'" id="custom-tabs-'. rand(1, 100) .'">';
      
      $i = 0;
      foreach( $tab_titles as $tab ){
        if($i == 0)
          $output .= '<li class="active">';
        else
          $output .= '<li>';

        $output .= '<a href="#custom-tab-' . $GLOBALS['tabs_count'] . '-' . sanitize_title( $tab[0] ) . '"  data-toggle="tab">' . $tab[0] . '</a></li>';
        $i++;
      }
        
        $output .= '</ul>';
        $output .= '<div class="tab-content">';
        $output .= do_shortcode( $content );
        $output .= '</div></div>';
    } else {
      $output .= do_shortcode( $content );
    }
    
    return $output;
  }
  



  /*--------------------------------------------------------------------------------------
    *
    * bs_tab
    *
    * @author Filip Stefansson
    * @since 1.0
    * 
    *-------------------------------------------------------------------------------------*/
  function bs_tab( $atts, $content = null ) {

    if( !isset($GLOBALS['current_tabs']) ) {
      $GLOBALS['current_tabs'] = $GLOBALS['tabs_count'];
      $state = 'active';
    } else {

      if( $GLOBALS['current_tabs'] == $GLOBALS['tabs_count'] ) {
        $state = ''; 
      } else {
        $GLOBALS['current_tabs'] = $GLOBALS['tabs_count'];
        $state = 'active';
      }
    }

    $defaults = array( 'title' => 'Tab');
    extract( shortcode_atts( $defaults, $atts ) );
    
    return '<div id="custom-tab-' . $GLOBALS['tabs_count'] . '-'. sanitize_title( $title ) .'" class="tab-pane ' . $state . '">'. do_shortcode( $content ) .'</div>';
  }
  

}

new BoostrapShortcodes()

?>