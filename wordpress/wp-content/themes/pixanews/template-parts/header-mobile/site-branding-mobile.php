<div id="site-branding-mobile">
	<?php if (get_theme_mod('pixanews-mobile-logo')) : ?>
		<img class="custom-logo custom-logo-mobile" alt="<?php echo esc_attr(get_bloginfo('name')); ?>" src="<?php echo esc_url(get_theme_mod('pixanews-mobile-logo')); ?>">
	<?php elseif( has_custom_logo() ) : ?>
		<?php the_custom_logo(); ?>
	<?php else : ?>
		<div class="site-title h1"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></div>
	<?php endif; ?>
</div><!-- .site-branding -->