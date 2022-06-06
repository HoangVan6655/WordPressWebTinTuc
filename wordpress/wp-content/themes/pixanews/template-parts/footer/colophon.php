<footer id="colophon" class="site-footer">
	<div class="site-info">
		<?php 
			if (get_theme_mod('pixanews-copyright-text')) : 
				echo esc_html(get_theme_mod('pixanews-copyright-text'));
			else :	
				_e('© ','pixanews'); ?> <?php echo esc_html(get_bloginfo('name'));?> <?php echo esc_html(date('Y'));
			endif;	
		?>
		<span class="sep"> | </span>
			<?php
			/* translators: 1: Theme name, 2: Theme author. */
			printf( esc_html__( 'Designed by %1$s.', 'pixanews' ), '<a href="https://pixahive.com/themes/pixanews/">PixaHive</a>' );
			?>
	</div><!-- .site-info -->
</footer><!-- #colophon -->