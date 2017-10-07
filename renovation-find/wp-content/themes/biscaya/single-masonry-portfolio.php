<?php
/**
 * The Template for displaying single masonry portfolio.
 */

get_header(); ?>

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<h1 class="pgheadertitle animated fadeInLeft"><?php the_title(); ?></h1>
		<div class="headerdivider"></div>
		</div>
	</div>
</div>
<div class="container">
	<div id="primary">
		<div role="main">
			<?php while ( have_posts() ) : the_post(); ?>
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
				<?php 
				// If comments are open or we have at least one comment, load up the comment template
					if ( comments_open() || '0' != get_comments_number() )
						comments_template();
				?>
			<?php endwhile; // end of the loop. ?>
		</div>
	</div><!-- #primary -->	
</div><!-- container -->
<?php get_footer(); ?>