<div id="top-bar" class="">
	<div class="container">
		<div class="row top-bar-wrapper">
			<div id="top-bar-left" class="col d-none d-sm-block">
				<?php
					wp_nav_menu(
						array(
							'theme_location' => 'menu-top',
							'menu_id'        => 'top-menu',
						)
					);
				?>
			</div>
			<div id="top-bar-right" class="col">
				<?php get_template_part( 'template-parts/header/mobile-menu' ); ?>
				<?php
					get_search_form();
					?>
					<?php if (has_nav_menu( 'social' )) : ?>
						<div class="social-menu-wrapper">
							<?php wp_nav_menu(
								array(
									'theme_location' => 'social',
									'menu_id'        => 'social-menu',
								)
							); ?>
						</div>
					<?php endif; ?>
			</div>
		</div>
	</div>
</div><!--#top-bar-->