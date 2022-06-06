<div id="bottom-bar">
	<nav id="site-navigation" class="main-navigation">
		<div class="container">
			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'menu-1',
					'menu_id'        => 'primary-menu',
				)
			);
			?>
		</div>
	</nav><!-- #site-navigation -->
</div>