<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Pixanews
 */

get_header();
?>

	<main id="primary" class="site-main <?php do_action('pixanews_primary_width_class') ?>">

		<?php if ( have_posts() ) : ?>

			<header class="page-header page-entry-header">
				<?php
				the_archive_title( '<h1 class="page-title"><span>', '</span></h1>' );
				the_archive_description( '<div class="archive-description">', '</div>' );
				?>
			</header><!-- .page-header -->

			<?php
			do_action( 'pixanews_before_loop' );
			/* Start the Loop */
			while ( have_posts() ) :
				the_post();

				/*
				 * Include the Post-Type-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
				 */
				do_action('pixanews_blog_layout');

			endwhile;
			do_action( 'pixanews_after_loop' );

			the_posts_pagination( apply_filters( 'pixanews_posts_pagination_args', array(
				'class'	=>	'pixanews-pagination',
				'prev_text'	=> '<i class="fa fa-angle-left"></i>',
				'next_text'	=> '<i class="fa fa-angle-right"></i>'
			) ) );

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>

	</main><!-- #main -->

<?php
get_sidebar();
get_footer();
