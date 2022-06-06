<div id="middle-bar">
	<div class="container">
		<div class="row">
			<div class="social-menu-wrapper col">
				<?php if (has_nav_menu( 'social' )) : ?>
						<?php wp_nav_menu(
							array(
								'theme_location' => 'social',
								'menu_id'        => 'social-menu',
							)
						); ?>
				<?php endif; ?>
			</div>
			
			<div id="site-branding" class="col">
				<?php
				the_custom_logo(); ?>
					<div class="site-title h1"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></div>
			</div><!-- .site-branding -->
			
			<div id="top-search" class="col">
				<?php
					get_search_form();
				?>	
			</div>
		</div>
	</div>
</div>