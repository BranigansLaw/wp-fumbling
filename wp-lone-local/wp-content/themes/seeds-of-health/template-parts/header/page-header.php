<?php
/**
 * Displays header page info
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */
?>

<?php
	if ( is_front_page() ) :
?>
<header class="homepage-slider-container">
    <div id="slider">
        <!-- Loading Screen -->
        <div data-u="loading" class="jssorl-009-spin" style="position:absolute;top:0px;left:0px;width:100%;height:100%;text-align:center;background-color:rgba(0,0,0,0.7);">
            <img style="margin-top:-19px;position:relative;top:50%;width:38px;height:38px;" src="../svg/loading/static-svg/spin.svg" />
        </div>

        <!-- Slides Container -->
        <div data-u="slides">
	        <div>
	            <img data-u="image" src="http://localhost/wp-fumbling/wp-lone-local/wp-content/uploads/2018/01/HomeDesktopSlide2.jpg" />
	        </div>
	        <div>
	            <img data-u="image" src="http://localhost/wp-fumbling/wp-lone-local/wp-content/uploads/2018/01/chinese-medicine-1024x684.jpg" />
	        </div>
	        <div>
	            <img data-u="image" src="http://localhost/wp-fumbling/wp-lone-local/wp-content/uploads/2018/01/acupuncture-300x200.jpg" />
	        </div>
        </div>
        
        <div data-u="navigator" class="jssorb031" style="position:absolute;bottom:12px;right:12px;" data-autocenter="1" data-scale="0.5" data-scale-bottom="0.75">
            <div data-u="prototype" class="i" style="width:16px;height:16px;">
                <svg viewBox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;">
                    <circle class="b" cx="8000" cy="8000" r="5800"></circle>
                </svg>
            </div>
        </div>
        <!--#endregion Bullet Navigator Skin End -->
    
        <div data-u="arrowleft" class="jssora051" style="width:55px;height:55px;top:0px;left:25px;" data-autocenter="2" data-scale="0.75" data-scale-left="0.75">
            <svg viewBox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;">
                <polyline class="a" points="11040,1920 4960,8000 11040,14080 "></polyline>
            </svg>
        </div>
        <div data-u="arrowright" class="jssora051" style="width:55px;height:55px;top:0px;right:25px;" data-autocenter="2" data-scale="0.75" data-scale-right="0.75">
            <svg viewBox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;">
                <polyline class="a" points="4960,1920 11040,8000 4960,14080 "></polyline>
            </svg>
        </div>
        <!--#endregion Arrow Navigator Skin End -->
    </div>
    <!-- Jssor Slider End -->
</header>
<?php
	else :
?>
<header class="seeds-subtitle-header" style="background-image: url('<?php echo get_the_post_thumbnail_url(get_the_ID(),'full') ?>')">
	<div class="inner">
		<h1><?php the_title() ?></h1>
	</div>
</header>
<?php
	endif;
?>
<section class="seeds-subtitle-header-content">
	<div class="inner">
		<h2><?php the_field( 'subtitle' ) ?></h2>
		<div><?php the_content() ?></div>
	</div>
</section>