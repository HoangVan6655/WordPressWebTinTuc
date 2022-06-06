<?php
/**
 * Template Name: Home Page
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Fluid_Magazine
 */

$sidebar_layout = fluid_magazine_sidebar_layout(); 
get_header();
?>
<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">
    <?php 
        while ( have_posts() ) : the_post(); ?> 
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <div class="text-holder"> 
                    <div class="post-thumbnail">
                        <?php the_post_thumbnail(); ?>
                    </div>
                    <div class="text-holder">  
                        <div class="entry-content">
                            <?php the_content(); ?>
                        </div><!-- .entry-content -->
                    </div>
                </div>
            </article>
        <?php endwhile; ?>

    </main><!-- #main -->    
</div>
<?php if( $sidebar_layout == 'right-sidebar' )
get_sidebar();
get_footer();