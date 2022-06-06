<?php if (get_theme_mod('pixanews-enable-top-bar', false)) : ?>
<div id="top-bar">
	<div class="container">
		<div class="row top-bar-wrapper">
			<?php if (get_theme_mod('pixanews-enable-date', true)) : ?>
			<div id="top-bar-left" class="col">
				<?php echo esc_html(date('j F, Y')); ?>
			</div>
			<?php endif; ?>
			<div id="top-bar-right" class="col">
				<?php
					wp_nav_menu(
						array(
							'theme_location' => 'menu-top',
							'menu_id'        => 'top-menu',
						)
					);
				?>
			</div>
		</div>
	</div>
</div><!--#top-bar-->
<?php endif; ?>