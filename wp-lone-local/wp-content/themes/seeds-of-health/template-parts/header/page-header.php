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
<header class="seeds-subtitle-header">
	<h1><?php the_title() ?></h1>
	<img src="featured-image" />
	<h2>Subtitle (if exists)</h2>
	<div><?php the_content() ?></div>
</header>