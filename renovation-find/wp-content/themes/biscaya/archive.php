<?php
/**
 * The template for displaying Archive pages.
 */

get_header(); 
wp_enqueue_script( 'isotopejs', null, false );
?>

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<h1 class="pgheadertitle animated fadeInLeft">
			<?php
				if ( is_category() ) :
					single_cat_title();

				elseif ( is_tag() ) :
					single_tag_title();

				elseif ( is_author() ) :
					/* Queue the first post, that way we know
					 * what author we're dealing with (if that is the case).
					*/
					the_post();
					printf( __( 'Author: %s', 'tdwowbiscaya' ), '<span class="vcard">' . get_the_author() . '</span>' );
					/* Since we called the_post() above, we need to
					 * rewind the loop back to the beginning that way
					 * we can run the loop properly, in full.
					 */
					rewind_posts();

				elseif ( is_day() ) :
					printf( __( 'Day: %s', 'tdwowbiscaya' ), '<span>' . get_the_date() . '</span>' );

				elseif ( is_month() ) :
					printf( __( 'Month: %s', 'tdwowbiscaya' ), '<span>' . get_the_date( 'F Y' ) . '</span>' );

				elseif ( is_year() ) :
					printf( __( 'Year: %s', 'tdwowbiscaya' ), '<span>' . get_the_date( 'Y' ) . '</span>' );

				elseif ( is_tax( 'post_format', 'post-format-aside' ) ) :
					_e( 'Asides', 'tdwowbiscaya' );

				elseif ( is_tax( 'post_format', 'post-format-image' ) ) :
					_e( 'Images', 'tdwowbiscaya');

				elseif ( is_tax( 'post_format', 'post-format-video' ) ) :
					_e( 'Videos', 'tdwowbiscaya' );

				elseif ( is_tax( 'post_format', 'post-format-quote' ) ) :
					_e( 'Quotes', 'tdwowbiscaya' );

				elseif ( is_tax( 'post_format', 'post-format-link' ) ) :
					_e( 'Links', 'tdwowbiscaya' );

				else :
					_e( 'Archives', 'tdwowbiscaya' );

				endif;
			?>
			</h1>
			<?php
			// Show an optional term description.
			$term_description = term_description();
			if ( ! empty( $term_description ) ) :
				printf( '<div class="taxonomy-description">%s</div>', $term_description );
			endif;
		?>
		<div class="headerdivider"></div>
		</div>
	</div>
</div>

<div class="container">
	<div class="row">
		<div class="col-md-8">	
			<div class="row tiles blogindex content-area">
				<?php if ( have_posts() ) : ?>	
					<?php /* Start the Loop */ ?>
					<?php while ( have_posts() ) : the_post(); ?>
						<div <?php post_class("col-md-6"); ?> id="post-<?php the_ID(); ?>">							
							<div class="inneritem">
								<div class="wrapinneritem">
								<header class="entry-header sectiontitlepost">
									<h1 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>
									<div class="entry-meta">
										<div class="pull-left"><i class="fa fa-calendar"></i>&nbsp; <?php the_time(__('j/m/Y','')) ?></div>
										<div class="text-right"><i class="fa fa-comment"></i>&nbsp;  <?php comments_popup_link( __( 'Add Comment', 'tdwowbiscaya' ), __( '1 Comment', 'tdwowbiscaya' ), __( '% Comments', 'tdwowbiscaya' ), '', __( 'Comments off', 'tdwowbiscaya' ) ); ?></div>
									</div><!-- .entry-meta -->
									<a class="entry-thumbnail" href="<?php the_permalink() ?>" title="<?php the_title() ?>"><?php global $post; echo get_the_post_thumbnail($post->ID, 'recentprojects-thumb'); ?></a>
									
								</header><!-- .entry-header -->
								<div class="entry-content">
									
									<?php echo get_custom_excerpt(160); ?> <a href="<?php the_permalink(); ?>">[...]</a>
								</div><!-- .entry-content -->							
								</div>
							</div>
						</div><!-- #boxportfolio-## -->
					<?php endwhile; ?>
				<?php else : ?>
					<?php get_template_part( 'no-results', 'archive' ); ?>
				<?php endif; ?>
			</div><!-- #content -->	
			<div class="clearfix"></div>								
			<?php wow_pagination();?>	
		</div><!-- .col-md-8 -->		
		<?php get_sidebar(); ?>		
	</div><!-- .row -->
</div>
<?php get_footer(); ?>