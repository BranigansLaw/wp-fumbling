<?php 
/*
 * Template Name: Portfolio Masonry
 */	
	get_header(); 	
	wp_enqueue_script( 'prettyphotojs' );
	wp_enqueue_script( 'isotopejs' );
	?>

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<h1 class="pgheadertitle animated fadeInLeft"><?php the_title(); ?></h1>
		<div class="headerdivider"></div>
		</div>
	</div>
</div>


<!-- Portfolio Categories
================================================== -->
<div class="container">
	<div class="row">	
		<div class="col-md-12">
			<div id="filter">
				<ul>
					<li><a href="#" class="selected" data-filter="*"><?php _e('All', 'tdwowbiscaya'); ?></a></li>
				<?php
				wp_list_categories( array(
						'taxonomy' => 'masonry-portfolio-categories',
						'hide_empty' => 0,
						'title_li' => '',
						'depth' => 1,
						'walker' => new Category_Walker(),
						'show_option_none' => ''
					) 
				); 
				?>
				</ul>
			</div>
		</div>
	</div>
</div>
	
<div class="container">
	<div class="row tiles">
		
		<!-- Portfolio 
		================================================== -->
			
		<?php 				
		$all_terms = get_terms( 'masonry-portfolio-categories', array('hide_empty' => 0 ) );				
		$count = 1;					
		$args = array(
			'post_type' => 'masonry-portfolio',
			'posts_per_page' => -1
		);				
		query_posts($args);				
		if (have_posts()) : while (have_posts()) : the_post();
		$terms = get_the_terms( get_the_ID(), 'masonry-portfolio-categories' ); 				
		$featured = get_post_meta(get_the_ID(), 'pt_featured', TRUE); 
		$imgurl = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
		?>	
		
		<div data-order='<?php echo $count; ?>' data-id="id-<?php echo $count; ?>" class="col-md-<?php echo $smof_data['portfoliocolumns']; ?> <?php if($terms) : foreach ($terms as $term) { echo 'term-'.$term->term_id.' '; } endif; ?>">
			<div class="boxcontainer">
				<?php if ( has_post_thumbnail() ) : ?><?php the_post_thumbnail(''); ?>
				<div class="roll">
					<div class="wrapcaption">
						<a href="<?php the_permalink(); ?>"><i class="fa fa-link captionicons"></i></a>
						<a data-gal="prettyPhoto[gallery]" href="<?php echo $imgurl; ?>" title="<?php the_title(); ?>"><i class="fa fa-search-plus captionicons"></i></a>
					</div>
				</div>
				<h1><a href="<?php the_permalink(); ?>" title="<?php printf(__('Permanent Link to %s', 'tdwowbiscaya'), get_the_title()); ?>"><?php the_title(); ?></a></h1>
				<?php the_excerpt(); ?>					
			</div>
		<?php endif; ?>
		</div>
		<?php $count++; endwhile; endif; ?>	
		
	</div>	
</div>
		

<?php get_footer(); ?>