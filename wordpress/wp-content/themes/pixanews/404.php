<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Pixanews
 */

get_header();
?>

	<main id="primary" class="site-main">

		<section class="error-404 not-found">
			<header class="page-header">
				<h1 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'pixanews' ); ?></h1>
			</header><!-- .page-header -->

			<div class="page-content">
				<p><?php esc_html_e( 'It looks like nothing was found at this location. ', 'pixanews' ); ?></p>
			
				<?php
				if (get_theme_mod('pixanews-enable-404-posts', false)) : ?>
					<div class="featured-module featured-module-style2 row">
							<div class="module-title module-title-style2 col-md-12">
								<h2>
									<span><?php _e('Other Posts you may like','pixanews'); ?></span>
								</h2>
							</div>
						<?php 
							$args = array(
								'posts_per_page' => 4,
								'ignore_sticky_posts' => 1 //Customizations to follow
							);
							
							$featured_module_posts = new WP_Query($args); 
								while ($featured_module_posts -> have_posts()) : $featured_module_posts -> the_post();
								?>
							
								<div class="featured-post col-sm-6 col-md-3 col-lg-3 small"> 
									<?php $primary_category = pixanews_primary_category(); 
										if (true) :
											echo "<a href='".esc_url($primary_category['url'])."' class='category-ribbon'>".esc_html($primary_category['category_name'])."</a>";	
										endif;
									?>
									<a href="<?php the_permalink(); ?>">
										<?php 
										if (has_post_thumbnail()):
											the_post_thumbnail( 'pixanews-thumbnail-4x3' );
										else: ?>
											<img src="<?php echo esc_url(get_template_directory_uri()."/design-files/images/thumbnail.jpg"); ?>"><?php 
										endif;	?>
										<h2 class="entry-title"><?php the_title(); ?></h2>
										<?php 
											$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
											$time_string = sprintf(
												$time_string,
												esc_attr( get_the_date( DATE_W3C ) ),
												esc_html( get_the_date() ), 
												esc_attr( get_the_modified_date( DATE_W3C ) ),
												esc_html( get_the_modified_date() )
											);
										?> 
										<div class="footer-meta"><?php echo $time_string; ?></div>
									</a>
								</div>
								
								<?php 
								endwhile;
								wp_reset_postdata(); ?>
						  
					</div> <?php
					endif;
					?>
			</div><!-- .page-content -->
		</section><!-- .error-404 -->

	</main><!-- #main -->

<?php
get_footer();
