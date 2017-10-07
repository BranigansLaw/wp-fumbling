<?php
/*
Template Name: Testimonials
*/
get_header(); 
wp_enqueue_script( 'isotopejs', null, false );
?>

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<h1 class="pgheadertitle animated fadeInLeft"><?php the_title(); ?></h1>
		<div class="headerdivider"></div>
		</div>
	</div>
</div>

<div class="container">	
	<div class="row tiles testimonialpage">					
		<?php
		global $wp_query;
		query_posts( array('post_type' => array( 'testimonials' ),'showposts' => 12, 'paged'=>$paged )
		);?>
		<?php if ( have_posts() ) : ?>
		<?php while ( have_posts() ) : the_post();	?>
		<!-- box -->
				<div class="col-md-4">
					<div class="testimonial">
						<h4><?php global $post; echo get_the_post_thumbnail($post->ID, 'testimonial-thumb'); ?>
						<?php echo get_the_title(); ?></h4>
						<?php the_content(); ?>
						</div>
					<div class="author-wrapper">
						<div class="arrow">
						</div>
						<div class="testimonial-name fontbold">
							 <?php echo get_post_meta($post->ID, 'tname', true); ?> <span><?php echo get_post_meta($post->ID, 'tposition', true); ?></span>
						</div>
					</div>
				<?php edit_post_link( __( 'Edit this testimonial', 'tdwowbiscaya' ), '<span class="edit-link" style="clear:both;float:none;color:#ccc;display:block;font-size:11px;">', '</span>' ); ?>
				</div>
				<!-- box -->
		
		<?php endwhile;
		else: ?>		
		<?php endif; ?>	
	</div>
	
	<div class="clearfix"></div>								
			<?php wow_pagination();?>			
			<?php wp_reset_query(); ?>
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>	
				<div class="entry-content">
					<?php the_content(); ?>
					<?php
						wp_link_pages( array(
							'before' => '<div class="page-links">' . __( 'Pages:', 'tdwowbiscaya' ),
							'after'  => '</div>',
						) );
					?>
				</div><!-- .entry-content -->
				<?php edit_post_link( __( 'Edit this page', 'tdwowbiscaya' ), '<footer class="entry-meta"><span class="edit-link">', '</span></footer>' ); ?>
			</article><!-- #post-## -->
				

</div>
<?php get_footer(); ?>