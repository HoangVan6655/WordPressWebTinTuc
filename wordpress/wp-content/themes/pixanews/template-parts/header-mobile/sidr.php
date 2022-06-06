<div id="sidr">
	<button class="go-to-bottom"><i class="fa fa-down"></i></button>
	<button id="close-menu" class="toggle-menu-link"><i class="fa fa-times"></i></button>
	<?php get_search_form(); ?>
	<?php if (has_nav_menu( 'social' )) : ?>
		<div class="sidr-social-menu-wrapper">
			<?php wp_nav_menu(
				array(
					'theme_location' => 'social',
					'menu_id'        => 'social-menu-sidr',
				)
			); ?>
		</div>
	<?php endif; ?>
	<div class="sidr-menu-wrapper">
		<?php wp_nav_menu(
			array(
				'theme_location' => 'mobile',
				'menu_id'        => 'mobile-menu-sidr',
			)
		); ?>
	</div>
	<button class="go-to-top"><i class="fa fa-up"></i></button>
	
</div>