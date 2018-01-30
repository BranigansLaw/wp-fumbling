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
<header class="seeds-subtitle-header" style="background-image: url('<?php echo get_the_post_thumbnail_url(get_the_ID(),'full') ?>')">
	<div class="inner">
		<h1><?php the_title() ?></h1>
	</div>
</header>
<section class="seeds-subtitle-header-content">
	<div class="inner">
		<h2><?php the_field( 'subtitle' ) ?></h2>
		<div><?php the_content() ?></div>
	</div>
</section>