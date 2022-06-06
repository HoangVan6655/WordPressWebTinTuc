<?php 
if ( (get_theme_mod('pixanews-enable-ticker-sitewide') && !is_paged()) 
	||	(get_theme_mod('pixanews-enable-ticker') && is_home() && !is_paged()) )  : ?>
	<?php $ticker_disable_class = get_theme_mod('pixanews-ticker-disable-phone', true) ? 'd-none d-sm-none d-md-block' : "enabled-on-phone"; ?>
		<div class="acme-ticker-wrapper container <?php echo esc_attr($ticker_disable_class); ?>">
			<div class="acme-news-ticker">
					<div class="acme-news-ticker-label"><?php echo esc_html(get_theme_mod('pixanews-ticker-label',__('Latest Posts','pixanews'))); ?></div>
					<div class="acme-news-ticker-box">
						<ul class="my-news-ticker">
						<?php 
							$args = array(
								'posts_per_page' => get_theme_mod('pixanews-ticker-count', 6)
							);
							if (get_theme_mod('pixanews-ticker-cat')) { 
								$args['category__in'] = array(get_theme_mod('pixanews-ticker-cat')); 
							}
								
							
							
							$ticker_posts = new WP_Query($args); 
							while ($ticker_posts -> have_posts()) : $ticker_posts -> the_post();
							?>
							
							<li class="ticker-post"> 
								<a href="<?php the_permalink(); ?>">
									<?php the_title(); ?>
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
									<span class="footer-meta"><?php echo $time_string; ?></span>
								</a>
							</li>
							
							<?php endwhile; 
							wp_reset_postdata(); ?>
						</ul>
					</div>
					<div class="acme-news-ticker-controls acme-news-ticker-vertical-controls">
						<button class="acme-news-ticker-arrow acme-news-ticker-prev"></button>
						<button class="acme-news-ticker-pause"></button>
						<button class="acme-news-ticker-arrow acme-news-ticker-next"></button>
					</div>
			</div> 
		</div>
<?php endif; ?>