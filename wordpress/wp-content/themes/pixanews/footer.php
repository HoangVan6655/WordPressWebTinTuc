<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Pixanews
 */

?>
	<?php do_action('pixanews_before_footer'); ?>
	<?php get_template_part( 'template-parts/footer/footer-widgets'); ?>
	<?php get_template_part( 'template-parts/footer/colophon'); ?>
	<?php do_action('pixanews_after_footer'); ?>
</div><!-- #page -->

<?php get_template_part( 'template-parts/header-mobile/sidr' ); ?>
<?php wp_footer(); ?>

</body>
</html>
