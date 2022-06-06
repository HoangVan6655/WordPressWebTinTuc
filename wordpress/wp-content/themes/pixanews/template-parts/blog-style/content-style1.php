<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Pixanews
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('row blog-style1'); ?>>
	<div class="thumbnail col-md-4 col-lg-5">
		<?php $primary_category = pixanews_primary_category(); 
			if (true) :
				echo "<a href='".esc_url($primary_category['url'])."' class='category-ribbon'>".esc_html($primary_category['category_name'])."</a>";	
			endif;
		?>
		<a href="<?php the_permalink(); ?>"><?php 
		if (has_post_thumbnail()):
			the_post_thumbnail( 'pixanews-thumbnail-4x3' );
		else: ?>
			<img src="<?php echo esc_url( get_template_directory_uri()."/design-files/images/thumbnail.jpg" ); ?>"><?php 
		endif;	?></a>
		
	</div>
	
	<div class="post-details col-md-8 col-lg-7">
		<?php the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' ); ?>
		
		<div class="entry-meta">
			<?php
			pixanews_posted_on();
			pixanews_posted_by();
			?>
		</div><!-- .entry-meta -->
		
		<div class="entry-excerpt">
			<?php the_excerpt(); ?>
		</div>
		
	</div>

</article><!-- #post-<?php the_ID(); ?> -->
