<?php
/*
* Display Header(masthead) Based on user chosen style
*/ 
function pixanews_display_masthead($style) { 

	switch ($style) {
		case 'style1' : ?>
			<header id="masthead" class="site-header style1 d-none d-sm-none d-md-block">
				<div>
					<?php get_template_part( 'template-parts/header/style1/top-bar'); ?>
					<?php get_template_part( 'template-parts/header/style1/middle-bar'); ?>	
					<?php get_template_part( 'template-parts/header/style1/bottom-bar'); ?>
				</div>		
			</header><!-- #masthead -->
		<?php break;
		case 'style2' : ?>
			<header id="masthead" class="site-header style2 d-none d-sm-none d-md-block">
				<div>
					<?php get_template_part( 'template-parts/header/style2/top-bar'); ?>
					<?php get_template_part( 'template-parts/header/style2/middle-bar'); ?>	
					<?php get_template_part( 'template-parts/header/style2/bottom-bar'); ?>
				</div>		
			</header><!-- #masthead -->
		<?php break; 		
	} //endswitch
} //endfunction