<footer id="footer-widgets">
	<div class="container">
		<div class="row">
			<?php if (is_active_sidebar( 'footer-1' )) : ?>
				<div class="col-md-4 footer-column footer-column-1">
					<?php dynamic_sidebar( 'footer-1' ); ?>
				</div>
			<?php endif; ?>
			<?php if (is_active_sidebar( 'footer-2' )) : ?>
				<div class="col-md-4 footer-column footer-column-2">
					<?php dynamic_sidebar( 'footer-2' ); ?>
				</div>
			<?php endif; ?>
			<?php if (is_active_sidebar( 'footer-3' )) : ?>
				<div class="col-md-4 footer-column footer-column-3">
					<?php dynamic_sidebar( 'footer-3' ); ?>
				</div>
			<?php endif; ?>
		</div>
	</div>
</footer>