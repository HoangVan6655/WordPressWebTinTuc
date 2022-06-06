<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Fluid_Magazine
 */

if ( ! function_exists( 'fluid_magazine_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function fluid_magazine_posted_on() {
    
    /* translators: used between list items, there is a space after the comma */
    $categories_list = get_the_category_list( ', ' );
    if ( $categories_list && fluid_magazine_categorized_blog() ) {
        echo '<span class="category">' .  $categories_list . '</span>'; // WPCS: XSS OK.
    }
    
    $byline = sprintf(
    esc_html_x( 'By %s', 'post author', 'fluid-magazine' ),
        '<a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a>'
    );
    
    if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
    echo '<span class="comments-link">';
        /* translators: %s: post title */
        comments_popup_link( sprintf( wp_kses( __( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'fluid-magazine' ), array( 'span' => array( 'class' => array() ) ) ), get_the_title() ) );
    echo '</span>';
    }
    
    fluid_magazine_entry_date();
    
    if( ! is_archive() ){ echo '<span class="byline"> ' . $byline . '</span>'; }

}
endif;


if ( ! function_exists( 'fluid_magazine_entry_date' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function fluid_magazine_entry_date() {
    
    $time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
   
    $time_string = sprintf( $time_string,
        esc_attr( get_the_date( 'c' ) ),
        esc_html( get_the_date() )
    );
    
    echo '<span class="posted-on"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a></span>';
}
endif;

function fluid_magazine_display_date(){

    $time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';

    $time_string = sprintf( $time_string,
        esc_attr( get_the_date( 'c' ) ),
        esc_html( get_the_date() )
    );
    
    echo '<span class="posted-on"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a></span>';
}

if ( ! function_exists( 'fluid_magazine_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function fluid_magazine_entry_footer() {
    // Hide category and tag text for pages.
    if ( 'post' === get_post_type() ) {
        echo '<div class="left">';
        $tags_list = get_the_tag_list();
        if ( $tags_list ) {
           echo '<span class="tag">' . $tags_list . '</span>';
        }
        echo '</div>';
    
    }
    
    edit_post_link(
    sprintf(
        /* translators: %s: Name of current post */
        esc_html__( 'Edit %s', 'fluid-magazine' ),
        the_title( '<span class="screen-reader-text">"', '"</span>', false )
    ),
    '<span class="edit-link">',
    '</span>'
    );
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function fluid_magazine_categorized_blog() {
    if ( false === ( $all_the_cool_cats = get_transient( 'fluid_magazine_categories' ) ) ) {
    // Create an array of all the categories that are attached to posts.
    $all_the_cool_cats = get_categories( array(
        'fields'     => 'ids',
        'hide_empty' => 1,
        // We only need to know if there is more than one category.
        'number'     => 2,
    ) );
    
    // Count the number of categories that are attached to the posts.
    $all_the_cool_cats = count( $all_the_cool_cats );
    
    set_transient( 'fluid_magazine_categories', $all_the_cool_cats );
    }
    
    if ( $all_the_cool_cats > 1 ) {
    // This blog has more than 1 category so fluid_magazine_categorized_blog should return true.
    return true;
    } else {
    // This blog has only 1 category so fluid_magazine_categorized_blog should return false.
    return false;
    }
}

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function fluid_magazine_home_categories() {

/* translators: used between list items, there is a space after the comma */
    $categories_list = get_the_category_list( ', ' );
    if ( $categories_list && fluid_magazine_categorized_blog() ) {
        printf( '<span class="category">%1$s</span>', $categories_list ); // WPCS: XSS OK.
    }
}

if( ! function_exists( 'fluid_magazine_get_social_links' ) ):
/**
 * Callback for Social Links 
 */
function fluid_magazine_get_social_links(){
    $facebook  = get_theme_mod( 'fluid_magazine_facebook' );
    $twitter   = get_theme_mod( 'fluid_magazine_twitter' );
    $pinterest = get_theme_mod( 'fluid_magazine_pinterest' );
    $linkedin  = get_theme_mod( 'fluid_magazine_linkedin' );
    $gplus     = get_theme_mod( 'fluid_magazine_gplus' );
    $instagram = get_theme_mod( 'fluid_magazine_instagram' );
    $youtube   = get_theme_mod( 'fluid_magazine_youtube' );
    $ok        = get_theme_mod( 'fluid_magazine_odnoklassniki' );
    $vk        = get_theme_mod( 'fluid_magazine_vk' );
    $xing      = get_theme_mod( 'fluid_magazine_xing' );
    
    if( $facebook || $twitter || $pinterest || $linkedin || $gplus || $instagram || $youtube || $ok || $vk || $xing ){
    ?>
    <ul class="social-networks">
    <?php if( $facebook ){ ?>
        <li><a href="<?php echo esc_url( $facebook ); ?>" target="_blank" title="<?php esc_attr_e( 'Facebook', 'fluid-magazine' );?>"><i class="fab fa-facebook-f"></i></a></li>
    <?php } if( $twitter ){ ?>
        <li><a href="<?php echo esc_url( $twitter ); ?>" target="_blank" title="<?php esc_attr_e( 'Twitter', 'fluid-magazine' );?>"><i class="fab fa-twitter"></i></a></li>
    <?php } if( $gplus ){ ?>
        <li><a href="<?php echo esc_url( $gplus ); ?>" target="_blank" title="<?php esc_attr_e( 'Google Plus', 'fluid-magazine' );?>"><i class="fab fa-google-plus-g"></i></a></li>
    <?php } if( $linkedin ){ ?>
        <li><a href="<?php echo esc_url( $linkedin ); ?>" target="_blank" title="<?php esc_attr_e( 'LinkedIn', 'fluid-magazine' );?>"><i class="fab fa-linkedin-in"></i></a></li>
    <?php } if( $pinterest ){ ?>
        <li><a href="<?php echo esc_url( $pinterest ); ?>" target="_blank" title="<?php esc_attr_e( 'Pinterest', 'fluid-magazine' );?>"><i class="fab fa-pinterest-p"></i></a></li>
    <?php } if( $instagram ){ ?>
        <li><a href="<?php echo esc_url( $instagram ); ?>" target="_blank" title="<?php esc_attr_e( 'Instagram', 'fluid-magazine' );?>"><i class="fab fa-instagram"></i></a></li>
    <?php } if( $youtube ){ ?>
        <li><a href="<?php echo esc_url( $youtube ); ?>" target="_blank" title="<?php esc_attr_e( 'YouTube', 'fluid-magazine' );?>"><i class="fab fa-youtube"></i></a></li>
    <?php } if( $ok ){?>
            <li><a href="<?php echo esc_url( $ok );?>" target="_blank" title="<?php esc_attr_e( 'OK', 'fluid-magazine' ); ?>"><i class="fab fa-odnoklassniki"></i></a></li>
    <?php } if( $vk ){?>
            <li><a href="<?php echo esc_url( $vk );?>" target="_blank" title="<?php esc_attr_e( 'VK', 'fluid-magazine' ); ?>"><i class="fab fa-vk"></i></a></li>
    <?php } if( $xing ){?>
            <li><a href="<?php echo esc_url( $xing );?>" class="fa fa-xing" target="_blank" title="<?php esc_attr_e( 'Xing', 'fluid-magazine' ); ?>"><i class="fab fa-xing"></i></a></li>
    <?php } ?>
  </ul>
    <?php
    }
}
endif;

if( ! function_exists( 'fluid_magazine_breadcrumbs_cb' ) ) :
/**
 * Breadcrumb 
*/
function fluid_magazine_breadcrumbs_cb() {    
    global $post;
    
    $post_page   = get_option( 'page_for_posts' ); //The ID of the page that displays posts.
    $show_front  = get_option( 'show_on_front' ); //What to show on the front page
    $showCurrent = get_theme_mod( 'fluid_magazine_ed_current', '1' ); // 1 - show current post/page title in breadcrumbs, 0 - don't show
    $delimiter   = get_theme_mod( 'fluid_magazine_breadcrumb_separator', __( '>', 'fluid-magazine' ) ); // delimiter between crumbs
    $home        = get_theme_mod( 'fluid_magazine_breadcrumb_home_text', __( 'Home', 'fluid-magazine' ) ); // text for the 'Home' link
    $before      = '<span class="current" itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">'; // tag before the current crumb
    $after       = '</span>'; // tag after the current crumb
    $ed_breadcrumb = get_theme_mod( 'fluid_magazine_ed_breadcrumb' ); 

    $depth = 1; 

    if ( $ed_breadcrumb ) {  
        echo '<div id="crumbs" itemscope itemtype="https://schema.org/BreadcrumbList"><span itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><a itemprop="item" href="' . esc_url( home_url() ) . '" class="home_crumb"><span itemprop="name">' . esc_html( $home ) . '</span></a><meta itemprop="position" content="'. absint( $depth ).'" /><span class="separator">' . $delimiter . '</span></span>';
            if( is_home() && ! is_front_page() ){            
                $depth = 2;
                if( $showCurrent ) echo $before . '<span itemprop="name">' . esc_html( single_post_title( '', false ) ) .'</span><meta itemprop="position" content="'. absint( $depth ).'" />'. $after;          
            }elseif( is_category() ){            
                $depth = 2;
                $thisCat = get_category( get_query_var( 'cat' ), false );
                if( $show_front === 'page' && $post_page ){ //If static blog post page is set
                    $p = get_post( $post_page );
                    echo '<span itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><a itemprop="item" href="' . esc_url( get_permalink( $post_page ) ) . '"><span itemprop="name">' . esc_html( $p->post_title ) . '</span></a><meta itemprop="position" content="'. absint( $depth ).'" /><span class="separator">' . $delimiter . '</span></span>';
                    $depth ++;  
                }

                if ( $thisCat->parent != 0 ) {
                    $parent_categories = get_category_parents( $thisCat->parent, false, ',' );
                    $parent_categories = explode( ',', $parent_categories );

                    foreach ( $parent_categories as $parent_term ) {
                        $parent_obj = get_term_by( 'name', $parent_term, 'category' );
                        if( is_object( $parent_obj ) ){
                            $term_url    = get_term_link( $parent_obj->term_id );
                            $term_name   = $parent_obj->name;
                            echo '<span itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><a itemprop="item" href="' . esc_url( $term_url ) . '"><span itemprop="name">' . esc_html( $term_name ) . '</span></a><meta itemprop="position" content="'. absint( $depth ).'" /><span class="separator">' . $delimiter . '</span></span>';
                            $depth ++;
                        }
                    }
                }

                if( $showCurrent ) echo $before . '<span itemprop="name">' .  esc_html( single_cat_title( '', false ) ) . '</span><meta itemprop="position" content="'. absint( $depth ).'" />' . $after;

            }elseif( is_tag() ){            
                $queried_object = get_queried_object();
                $depth = 2;

                if( $showCurrent ) echo $before . '<span itemprop="name">' . esc_html( single_tag_title( '', false ) ) .'</span><meta itemprop="position" content="'. absint( $depth ).'" />'. $after;    
            }elseif( is_author() ){            
                $depth = 2;
                global $author;
                $userdata = get_userdata( $author );
                if( $showCurrent ) echo $before . '<span itemprop="name">' . esc_html( $userdata->display_name ) .'</span><meta itemprop="position" content="'. absint( $depth ).'" />'. $after;  
            }elseif( is_day() ){            
                $depth = 2;
                echo '<span itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><a itemprop="item" href="' . esc_url( get_year_link( get_the_time( __( 'Y', 'fluid-magazine' ) ) ) ) . '"><span itemprop="name">' . esc_html( get_the_time( __( 'Y', 'fluid-magazine' ) ) ) . '</span></a><meta itemprop="position" content="'. absint( $depth ).'" /><span class="separator">' . $delimiter . '</span></span>';
                $depth ++;
                echo '<span itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><a itemprop="item" href="' . esc_url( get_month_link( get_the_time( __( 'Y', 'fluid-magazine' ) ), get_the_time( __( 'm', 'fluid-magazine' ) ) ) ) . '"><span itemprop="name">' . esc_html( get_the_time( __( 'F', 'fluid-magazine' ) ) ) . '</span></a><meta itemprop="position" content="'. absint( $depth ).'" /><span class="separator">' . $delimiter . '</span></span>';
                $depth ++;
                if( $showCurrent ) echo $before .'<span itemprop="name">'. esc_html( get_the_time( __( 'd', 'fluid-magazine' ) ) ) .'</span><meta itemprop="position" content="'. absint( $depth ).'" />'. $after;
                 
            }elseif( is_month() ){            
                $depth = 2;
                echo '<span itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><a itemprop="item" href="' . esc_url( get_year_link( get_the_time( __( 'Y', 'fluid-magazine' ) ) ) ) . '"><span itemprop="name">' . esc_html( get_the_time( __( 'Y', 'fluid-magazine' ) ) ) . '</span></a><meta itemprop="position" content="'. absint( $depth ).'" /><span class="separator">' . $delimiter . '</span></span>';
                $depth++;
                if( $showCurrent ) echo $before .'<span itemprop="name">'. esc_html( get_the_time( __( 'F', 'fluid-magazine' ) ) ) .'</span><meta itemprop="position" content="'. absint( $depth ).'" />'. $after;      
            }elseif( is_year() ){            
                $depth = 2;
                if( $showCurrent ) echo $before .'<span itemprop="name">'. esc_html( get_the_time( __( 'Y', 'fluid-magazine' ) ) ) .'</span><meta itemprop="position" content="'. absint( $depth ).'" />'. $after; 
            }elseif( is_single() && !is_attachment() ) {
                //For Woocommerce single product            
                if( fluid_magazine_woocommerce_activated() && 'product' === get_post_type() ){ 
                    if ( wc_get_page_id( 'shop' ) ) { 
                        //Displaying Shop link in woocommerce archive page
                        $_name = wc_get_page_id( 'shop' ) ? get_the_title( wc_get_page_id( 'shop' ) ) : '';
                        if ( ! $_name ) {
                            $product_post_type = get_post_type_object( 'product' );
                            $_name = $product_post_type->labels->singular_name;
                        }
                        echo ' <a href="' . esc_url( get_permalink( wc_get_page_id( 'shop' ) ) ) . '" itemprop="item"><span itemprop="name">' . esc_html( $_name) . '</span></a> ' . '<span class="separator">' . $delimiter . '</span>';
                    }
                
                    if ( $terms = wc_get_product_terms( $post->ID, 'product_cat', array( 'orderby' => 'parent', 'order' => 'DESC' ) ) ) {
                        $main_term = apply_filters( 'woocommerce_breadcrumb_main_term', $terms[0], $terms );
                        $ancestors = get_ancestors( $main_term->term_id, 'product_cat' );
                        $ancestors = array_reverse( $ancestors );

                        foreach ( $ancestors as $ancestor ) {
                            $ancestor = get_term( $ancestor, 'product_cat' );    
                            if ( ! is_wp_error( $ancestor ) && $ancestor ) {
                                echo '<span itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><a href="' . esc_url( get_term_link( $ancestor ) ) . '" itemprop="item"><span itemprop="name">' . esc_html( $ancestor->name ) . '</span></a><meta itemprop="position" content="'. absint( $depth ).'" /><span class="separator">' . $delimiter . '</span></span>';
                                $depth++;
                            }
                        }
                        echo '<span itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><a href="' . esc_url( get_term_link( $main_term ) ) . '" itemprop="item"><span itemprop="name">' . esc_html( $main_term->name ) . '</span></a><meta itemprop="position" content="'. absint( $depth ).'" /><span class="separator">' . $delimiter . '</span></span>';
                    }
                
                    if( $showCurrent ) echo $before .'<span itemprop="name">'. esc_html( get_the_title() ) .'</span><meta itemprop="position" content="'. absint( $depth ).'" />'. $after;
                                   
                }else{ 
                    //For Post                
                    $cat_object       = get_the_category();
                    $potential_parent = 0;
                    $depth            = 2;
                    
                    if( $show_front === 'page' && $post_page ){ //If static blog post page is set
                        $p = get_post( $post_page );
                        echo '<span itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><a href="' . esc_url( get_permalink( $post_page ) ) . '" itemprop="item"><span itemprop="name">' . esc_html( $p->post_title ) . '</span></a><meta itemprop="position" content="'. absint( $depth ).'" /><span class="separator">' . $delimiter . '</span></span>';  
                        $depth++;
                    }
                    
                    if( is_array( $cat_object ) ){ //Getting category hierarchy if any
            
                        //Now try to find the deepest term of those that we know of
                        $use_term = key( $cat_object );
                        foreach( $cat_object as $key => $object ){
                            //Can't use the next($cat_object) trick since order is unknown
                            if( $object->parent > 0  && ( $potential_parent === 0 || $object->parent === $potential_parent ) ){
                                $use_term = $key;
                                $potential_parent = $object->term_id;
                            }
                        }
                        
                        $cat = $cat_object[$use_term];
                  
                        $cats = get_category_parents( $cat, false, ',' );
                        $cats = explode( ',', $cats );

                        foreach ( $cats as $cat ) {
                            $cat_obj = get_term_by( 'name', $cat, 'category' );
                            if( is_object( $cat_obj ) ){
                                $term_url    = get_term_link( $cat_obj->term_id );
                                $term_name   = $cat_obj->name;
                                echo '<span itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><a itemprop="item" href="' . esc_url( $term_url ) . '"><span itemprop="name">' . esc_html( $term_name ) . '</span></a><meta itemprop="position" content="'. absint( $depth ).'" /><span class="separator">' . $delimiter . '</span></span>';
                                $depth ++;
                            }
                        }
                    }
        
                    if ( $showCurrent ) echo $before .'<span itemprop="name">'. esc_html( get_the_title() ) .'</span><meta itemprop="position" content="'. absint( $depth ).'" />'. $after;
                                 
                }        
            }elseif( is_page() ){            
                $depth = 2;
                if( $post->post_parent ){            
                    global $post;
                    $depth = 2;
                    $parent_id  = $post->post_parent;
                    $breadcrumbs = array();
                    
                    while( $parent_id ){
                        $current_page  = get_post( $parent_id );
                        $breadcrumbs[] = $current_page->ID;
                        $parent_id     = $current_page->post_parent;
                    }
                    $breadcrumbs = array_reverse( $breadcrumbs );
                    for ( $i = 0; $i < count( $breadcrumbs); $i++ ){
                        echo '<span itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><a href="' . esc_url( get_permalink( $breadcrumbs[$i] ) ) . '" itemprop="item"><span itemprop="name">' . esc_html( get_the_title( $breadcrumbs[$i] ) ) . '</span></a><meta itemprop="position" content="'. absint( $depth ).'" /></span>';
                        if ( $i != count( $breadcrumbs ) - 1 ) echo ' <span class="separator">' . esc_html( $delimiter ) . '</span> ';
                        $depth++;
                    }

                    if ( $showCurrent ) echo ' <span class="separator">' . esc_html( $delimiter ) . '</span> ' . $before .'<span itemprop="name">'. esc_html( get_the_title() ) .'</span><meta itemprop="position" content="'. absint( $depth ).'" /></span>'. $after;      
                }else{
                    if ( $showCurrent ) echo $before .'<span itemprop="name">'. esc_html( get_the_title() ) .'</span><meta itemprop="position" content="'. absint( $depth ).'" />'. $after; 
                }
            }elseif( is_search() ){            
                $depth = 2;
                if( $showCurrent ) echo $before .'<span itemprop="name">'. esc_html__( 'Search Results for "', 'fluid-magazine' ) . esc_html( get_search_query() ) . esc_html__( '"', 'fluid-magazine' ) .'</span><meta itemprop="position" content="'. absint( $depth ).'" />'. $after;      
            }elseif( fluid_magazine_woocommerce_activated() && ( is_product_category() || is_product_tag() ) ){ 
                //For Woocommerce archive page        
                $depth = 2;
                if ( wc_get_page_id( 'shop' ) ) { 
                    //Displaying Shop link in woocommerce archive page
                    $_name = wc_get_page_id( 'shop' ) ? get_the_title( wc_get_page_id( 'shop' ) ) : '';
                    if ( ! $_name ) {
                        $product_post_type = get_post_type_object( 'product' );
                        $_name = $product_post_type->labels->singular_name;
                    }
                    echo ' <a href="' . esc_url( get_permalink( wc_get_page_id( 'shop' ) ) ) . '" itemprop="item"><span itemprop="name">' . esc_html( $_name) . '</span></a> ' . '<span class="separator">' . $delimiter . '</span>';
                }
                $current_term = $GLOBALS['wp_query']->get_queried_object();
                if( is_product_category() ){
                    $ancestors = get_ancestors( $current_term->term_id, 'product_cat' );
                    $ancestors = array_reverse( $ancestors );
                    foreach ( $ancestors as $ancestor ) {
                        $ancestor = get_term( $ancestor, 'product_cat' );    
                        if ( ! is_wp_error( $ancestor ) && $ancestor ) {
                            echo '<span itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><a href="' . esc_url( get_term_link( $ancestor ) ) . '" itemprop="item"><span itemprop="name">' . esc_html( $ancestor->name ) . '</span></a><meta itemprop="position" content="'. absint( $depth ).'" /><span class="separator">' . $delimiter . '</span></span>';
                            $depth ++;
                        }
                    }
                }           
                if( $showCurrent ) echo $before . '<span itemprop="name">' . esc_html( $current_term->name ) .'</span><meta itemprop="position" content="'. absint( $depth ).'" />' . $after;           
            }elseif( fluid_magazine_woocommerce_activated() && is_shop() ){ //Shop Archive page
                $depth = 2;
                if ( get_option( 'page_on_front' ) == wc_get_page_id( 'shop' ) ) {
                    return;
                }
                $_name = wc_get_page_id( 'shop' ) ? get_the_title( wc_get_page_id( 'shop' ) ) : '';
                $shop_url = wc_get_page_id( 'shop' ) && wc_get_page_id( 'shop' ) > 0  ? get_the_permalink( wc_get_page_id( 'shop' ) ) : home_url( '/shop' );
        
                if ( ! $_name ) {
                    $product_post_type = get_post_type_object( 'product' );
                    $_name = $product_post_type->labels->singular_name;
                }
                if( $showCurrent ) echo $before . '<span itemprop="name">' . esc_html( $_name ) .'</span><meta itemprop="position" content="'. absint( $depth ).'" />'. $after;                    
            }elseif( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {            
                $depth = 2;
                $post_type = get_post_type_object(get_post_type());
                if( get_query_var('paged') ){
                    echo '<span itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><a href="' . esc_url( get_post_type_archive_link( $post_type->name ) ) . '" itemprop="item"><span itemprop="name">' . esc_html( $post_type->label ) . '</span></a><meta itemprop="position" content="'. absint( $depth ).'" />';
                    echo ' <span class="separator">' . $delimiter . '</span></span> ' . $before . sprintf( __('Page %s', 'fluid-magazine'), get_query_var('paged') ) . $after;
                }elseif( is_archive() ){
                    echo $before .'<a itemprop="item" href="' . esc_url( get_post_type_archive_link( $post_type->name ) ) . '"><span itemprop="name">'. esc_html( $post_type->label ) .'</span></a><meta itemprop="position" content="'. absint( $depth ).'" />'. $after;
                }else{
                    echo $before .'<a itemprop="item" href="' . esc_url( get_post_type_archive_link( $post_type->name ) ) . '"><span itemprop="name">'. esc_html( $post_type->label ) .'</span></a><meta itemprop="position" content="'. absint( $depth ).'" />'. $after;
                }              
            }elseif( is_attachment() ){            
                $depth  = 2;
                $parent = get_post( $post->post_parent );
                $cat    = get_the_category( $parent->ID );
                if( $cat ){
                    $cat = $cat[0];
                    echo get_category_parents( $cat, TRUE, ' <span class="separator">' . $delimiter . '</span> ');
                    echo '<span itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem"><a href="' . esc_url( get_permalink( $parent ) ) . '" itemprop="item"><span itemprop="name">' . esc_html( $parent->post_title ) . '<span></a><meta itemprop="position" content="'. absint( $depth ).'" />' . ' <span class="separator">' . $delimiter . '</span></span>';
                }
                if( $showCurrent ) echo $before .'<a itemprop="item" href="' . esc_url( get_the_permalink() ) . '"><span itemprop="name">'. esc_html( get_the_title() ) .'</span></a><meta itemprop="position" content="'. absint( $depth ).'" />'. $after;   
            }elseif ( is_404() ){
                if( $showCurrent ) echo $before . esc_html__( '404 Error - Page not Found', 'fluid-magazine' ) . $after;
            }
            if( get_query_var('paged') ) echo __( ' (Page', 'fluid-magazine' ) . ' ' . get_query_var('paged') . __( ')', 'fluid-magazine' );        
            echo '</div>';
    }
} 
endif;
add_action( 'fluid_magazine_breadcrumbs', 'fluid_magazine_breadcrumbs_cb' );

if( ! function_exists( 'fluid_magazine_pagination' ) ) :
/**
 * Pagination
*/
function fluid_magazine_pagination(){
    
    if( is_single() ){
        the_post_navigation();
    }else{
        the_posts_pagination( array(
            'prev_text'          => __('Prev', 'fluid-magazine'),
            'next_text'          => __('Next', 'fluid-magazine'),
            'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'fluid-magazine' ) . ' </span>',
         ) );
    }
    
}
endif;

/**
 * Return sidebar layouts for pages
*/
function fluid_magazine_sidebar_layout(){
    global $post;
    
    if( get_post_meta( $post->ID, 'fluid_magazine_sidebar_layout', true ) ){
        return get_post_meta( $post->ID, 'fluid_magazine_sidebar_layout', true );    
    }else{
        return 'right-sidebar';
    }
}

/**
 * Returns Section header
*/
function fluid_magazine_get_section_header( $section_title, $section_content ){
    if( $section_title || $section_content ){ ?>
    <header class="header">
    <?php 
        if( $section_title ) echo '<h2 class="title">' . esc_html( $section_title ) . '</h2>';
        if( $section_content ) echo wpautop( wp_kses_post( $section_content ) ); 
    ?>
    </header>
    <?php
    }
}

/**
 * Filer For Archive Header 
*/
function fluid_magazine_get_archive_title($title){
    if ( is_category() ) {
        $title = single_cat_title( '', false );
    } elseif ( is_tag() ) {
        $title = single_tag_title( '', false );
    } elseif ( is_author() ) {
        $title = '<span class="vcard">' . get_the_author() . '</span>' ;
    } else {
        $title = ( single_month_title( ' ',false ) ); 
    }

    return $title;
}
add_filter( 'get_the_archive_title', 'fluid_magazine_get_archive_title' );

/**
 * Returns Slider Section Callack 
*/
function fluid_magazine_slider_cb(){
    
    $fluid_magazine_slider_caption  = get_theme_mod( 'fluid_magazine_slider_caption', '1' );
    $fluid_magazine_slider_cat      = get_theme_mod( 'fluid_magazine_slider_cat' );   
    $fluid_magazine_slider_readmore = get_theme_mod( 'fluid_magazine_slider_readmore', __( 'Read More', 'fluid-magazine' ) );

    if( $fluid_magazine_slider_cat ){
        $slider_qry = new WP_Query( array( 
            'post_type'             => 'post', 
            'post_status'           => 'publish',
            'posts_per_page'        => -1,                    
            'cat'                   => $fluid_magazine_slider_cat,
            'ignore_sticky_posts'   => true
        ) );
        if( $slider_qry->have_posts() ){
            echo '<div class="banner"><div id="banner-slider" class="owl-carousel" >';
            
            while( $slider_qry->have_posts()) {
                $slider_qry->the_post();
                if( has_post_thumbnail() ){
                ?>
                <div>
                <?php 
                    the_post_thumbnail( 'fluid-magazine-slider' ); 
                    if( $fluid_magazine_slider_caption ){ ?> 
                        <div class="banner-text">
                            <div class="holder">    
                                <?php fluid_magazine_home_categories(); ?>
                                <strong class="title">
                                    <a href ="<?php the_permalink(); ?>">
                                        <?php the_title(); ?>
                                    </a> 
                                </strong>
                                <?php if( $fluid_magazine_slider_readmore ){ ?><a href="<?php the_permalink(); ?>" class="btn-readmore"><?php echo esc_html( $fluid_magazine_slider_readmore ); ?></a> <?php } ?>
                            </div>
                        </div>
                    <?php } ?>
                </div>
                <?php 
                }
            } 
            wp_reset_postdata();

            echo '</ul></div><button class="btn-down">';
                esc_html_e('Go Down','fluid-magazine' );
            echo '</button></div><div id="next-section"></div>';             
        }
    }   
}
add_action( 'fluid_magazine_slider', 'fluid_magazine_slider_cb' );

if( ! function_exists( 'fluid_magazine_header_ads_cb' ) ) :
/**
 * Header AD
*/
function fluid_magazine_header_ads_cb(){
    $ed_header_ad = get_theme_mod( 'fluid_magazine_ed_header_ad' ); //from customizer
    $ad_img       = get_theme_mod( 'fluid_magazine_header_ad' ); //from customizer
    $ad_link      = get_theme_mod( 'fluid_magazine_header_ad_link' ); //from customizer
    $ad_image     = wp_get_attachment_image_src( $ad_img, 'full' );
    $target       = get_theme_mod( 'fluid_magazine_open_link_diff_tab', '1' ) ? 'target="_blank"' : '';
    
    if( $ed_header_ad && $ad_img ){ ?>
    <div class="advertise-holder">
        <?php if( $ad_link ) echo '<a href="' . esc_url( $ad_link ) . '" ' . $target . '>'; ?>
            <img src="<?php echo esc_url( $ad_image[0] ); ?>"  />
        <?php if( $ad_link ) echo '</a>'; ?>        
    </div>
    <?php
    }
}
endif;
add_action( 'fluid_magazine_header_ad', 'fluid_magazine_header_ads_cb' );

if( ! function_exists( 'fluid_magazine_get_home_catpost' ) ) :
/**
 * Helper function to retrieve category listing in home page.
*/
function fluid_magazine_get_home_catpost( $cat_id, $paged){    
    if( $cat_id ){
    $cat = get_category( $cat_id ); ?>
      
    <h2 class="main-title"><a href="<?php echo esc_url( get_category_link( $cat_id ) ); ?>"><?php echo esc_html( $cat->name ); ?></a></h2>
    <?php
        $post_one_qry = new WP_Query( array( 
            'cat'                   => $cat_id ,
            'post_status'           => 'publish',
            'posts_per_page'        => $paged,
            'ignore_sticky_posts'   => true ) );

        if( $post_one_qry->have_posts() ){
            while ($post_one_qry->have_posts()) : $post_one_qry->the_post(); 
            
                echo '<article class="post">';

                    fluid_magazine_cat_content_image();
                    ?>
                <div class="text-holder">
                    <header class="entry-header">
                
                            <h3 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                            <div class="entry-meta">
                                <?php fluid_magazine_entry_date() ?>
                            </div>
                
                    </header>
                        <div class="entry-content">
                            <?php the_excerpt(); ?>
                        </div>
                    <footer class="entry-footer">
                        <span class="byline"><?php esc_html_e( 'Posted by', 'fluid-magazine' ) ; ?> <a href="<?php the_permalink(); ?>"><?php the_author(); ?></a></span>
                    </footer>
                </div>
            <?php echo '</article>' ;            
            endwhile;
            wp_reset_postdata();
        }
    }       
}
endif;


if( ! function_exists( 'fluid_magazine_get_home_blog_post' ) ) :
/**
 * Helper function to retrieve category listing in home page.
*/
function fluid_magazine_get_home_blog_post( $cat_id, $paged){ 
    if( $cat_id ){
        $cat = get_category( $cat_id );    
    } ?>
    <section class="latest-blog">
    <?php
    $fluid_magazine_readmore_text = get_theme_mod( 'fluid_magazine_readmore_text', __( 'Read More', 'fluid-magazine' ) );

    if ($cat_id) { ?>
        <h2 class="main-title"><a href="<?php echo esc_url( get_category_link( $cat_id ) ); ?>"><?php echo esc_html( $cat->name ); ?></a></h2>
        <?php 
    }else{ ?>
        <h2 class="main-title"><?php esc_html_e( 'Latest Blog','fluid-magazine' ); ?></h2>
        <?php 
    }

    echo '<div class="blog-holder">';

        $blog_qry = new WP_Query( array( 
            'cat'                   => $cat_id,
            'post_status'           => 'publish',
            'posts_per_page'        => $paged,
            'ignore_sticky_posts'   => true ) );

        if( $blog_qry->have_posts() ){
            while ($blog_qry->have_posts()) : $blog_qry->the_post(); 
                echo '<div class="post">';
                    /**
                     * Before Post entry content
                     * 
                     * @see fluid_magazine_blog_content_image - 10
                     * @see fluid_magazine_start_post_entry_header - 20
                     * @see fluid_magazine_post_entry_header  - 30
                    */
                    do_action( 'fluid_magazine_before_blog_entry_content' ); ?>

                    <div class="entry-content">
                        <?php the_excerpt(); ?>
                    </div>
                    
                    <?php if( $fluid_magazine_readmore_text ){ ?>
                        <div class="entry-footer">
                            <a href="<?php the_permalink() ?>" class="btn-readmore"><?php echo esc_html( $fluid_magazine_readmore_text ); ?></a>
                        </div>
                    <?php } 
                echo '</div>';
                echo '</div>';
            endwhile;
            wp_reset_postdata();
        }
    echo '</div>';
    ?>
    </section>
    <?php
}
endif;



if( class_exists( 'WP_Customize_Control') ) {

class Fluid_Magazine_Info_Text extends WP_Customize_Control{

    public function render_content(){
    ?>
        <span class="customize-control-title">
            <?php echo esc_html( $this->label ); ?>
        </span>

        <?php if($this->description){ ?>
            <span class="description customize-control-description">
            <?php echo wp_kses_post($this->description); ?>
            </span>
        <?php }
    }

}
}

/**
 * Is Woocommerce activated
*/
if ( ! function_exists( 'fluid_magazine_woocommerce_activated' ) ) {
  function fluid_magazine_woocommerce_activated() {
    if ( class_exists( 'woocommerce' ) ) { return true; } else { return false; }
  }
}


if( ! function_exists( 'fluid_magazine_featured_post_query' ) ) :
/**
 * Function to query category posts in home page
*/
function fluid_magazine_featured_post_query( $grid_class=false, $image_size, $post_per_page, $offset = false ){
    $fluid_magazine_feature_section_cat = get_theme_mod( 'fluid_magazine_featured_section_cat' );
    $args = array(
        'post_type'           => 'post',
        'post_status'         => 'publish',
        'ignore_sticky_posts' => true,
        'cat'                 => $fluid_magazine_feature_section_cat,
        'posts_per_page'      => $post_per_page
    );

    if( $offset ) $args['offset'] = $offset;
        
    $qry = new WP_Query( $args );
            
    if( $fluid_magazine_feature_section_cat && $qry->have_posts() ){      
        
        while( $qry->have_posts() ){
            $qry->the_post(); ?>
            <article id="post-<?php the_ID(); ?>" <?php post_class( $grid_class ); ?>>
                <a href="<?php the_permalink(); ?>" class="post-thumbnail">
                    <?php 
                        if( has_post_thumbnail() ){ 
                            the_post_thumbnail( $image_size ); 
                        }else{
                            fluid_magazine_get_fallback_svg( $image_size );
                        } 
                    ?>
                </a>
                <header class="entry-header">
                    <h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                    <?php fluid_magazine_home_categories(); ?>
                </header>
            </article>
            <?php
        }
        wp_reset_postdata();                                          
    }
}
endif;


if( ! function_exists( 'fluid_magazine_feature_cat_post' ) ) :
/**
 * Function to query category posts in home page
*/
function fluid_magazine_feature_cat_post(){ ?>
    <div class="featured-post">
        <div class="grid-sizer"></div>
        <?php 
            fluid_magazine_featured_post_query( 'grid-item--width1', 'fluid-magazine-thumb-large', 1 ); 
            fluid_magazine_featured_post_query( '', 'fluid-magazine-thumb-small', 2, 1 ); 
            fluid_magazine_featured_post_query( 'grid-item--width3', 'fluid-magazine-thumb-medium', 1, 3 ); 
            fluid_magazine_featured_post_query( '', 'fluid-magazine-thumb-small', 2, 4 ); 
            fluid_magazine_featured_post_query( 'grid-item--width1', 'fluid-magazine-thumb-large', 1, 6 ); 
            fluid_magazine_featured_post_query( 'grid-item--width3', 'fluid-magazine-thumb-medium', 1, 7 ); 
        ?>
    </div>
    <?php
}
endif;
add_action( 'fluid_magazine_featured', 'fluid_magazine_feature_cat_post' );

if( ! function_exists( 'wp_body_open' ) ) :
/**
 * Fire the wp_body_open action.
 * Added for backwards compatibility to support pre 5.2.0 WordPress versions.
*/
function wp_body_open() {
	/**
	 * Triggered after the opening <body> tag.
    */
	do_action( 'wp_body_open' );
}
endif;

if( ! function_exists( 'fluid_magazine_get_image_sizes' ) ) :
/**
 * Get information about available image sizes
 */
function fluid_magazine_get_image_sizes( $size = '' ) {
 
    global $_wp_additional_image_sizes;
 
    $sizes = array();
    $get_intermediate_image_sizes = get_intermediate_image_sizes();
 
    // Create the full array with sizes and crop info
    foreach( $get_intermediate_image_sizes as $_size ) {
        if ( in_array( $_size, array( 'thumbnail', 'medium', 'medium_large', 'large' ) ) ) {
            $sizes[ $_size ]['width'] = get_option( $_size . '_size_w' );
            $sizes[ $_size ]['height'] = get_option( $_size . '_size_h' );
            $sizes[ $_size ]['crop'] = (bool) get_option( $_size . '_crop' );
        } elseif ( isset( $_wp_additional_image_sizes[ $_size ] ) ) {
            $sizes[ $_size ] = array( 
                'width' => $_wp_additional_image_sizes[ $_size ]['width'],
                'height' => $_wp_additional_image_sizes[ $_size ]['height'],
                'crop' =>  $_wp_additional_image_sizes[ $_size ]['crop']
            );
        }
    } 
    // Get only 1 size if found
    if ( $size ) {
        if( isset( $sizes[ $size ] ) ) {
            return $sizes[ $size ];
        } else {
            return false;
        }
    }
    return $sizes;
}
endif;

if ( ! function_exists( 'fluid_magazine_get_fallback_svg' ) ) :    
/**
 * Get Fallback SVG
*/
function fluid_magazine_get_fallback_svg( $post_thumbnail ) {
    if( ! $post_thumbnail ){
        return;
    }
    
    $image_size = fluid_magazine_get_image_sizes( $post_thumbnail );
     
    if( $image_size ){ ?>
        <div class="svg-holder">
             <svg class="fallback-svg" viewBox="0 0 <?php echo esc_attr( $image_size['width'] ); ?> <?php echo esc_attr( $image_size['height'] ); ?>" preserveAspectRatio="none">
                    <rect width="<?php echo esc_attr( $image_size['width'] ); ?>" height="<?php echo esc_attr( $image_size['height'] ); ?>" style="fill:#e0dfdf;"></rect>
            </svg>
        </div>
        <?php
    }
}
endif;

if( ! function_exists( 'fluid_magazine_fonts_url' ) ) :
/**
 * Register custom fonts.
 */
function fluid_magazine_fonts_url() {
    $fonts_url = '';

    /*
    * translators: If there are characters in your language that are not supported
    * by Hind, translate this to 'off'. Do not translate into your own language.
    */
    $hind = _x( 'on', 'Hind font: on or off', 'fluid-magazine' );
    
    /*
    * translators: If there are characters in your language that are not supported
    * by Poppins, translate this to 'off'. Do not translate into your own language.
    */
    $poppins = _x( 'on', 'Poppins font: on or off', 'fluid-magazine' );

    /*
    * translators: If there are characters in your language that are not supported
    * by Droid Serif, translate this to 'off'. Do not translate into your own language.
    */
    $droid_serif = _x( 'on', 'Droid Serif font: on or off', 'fluid-magazine' );

    if ( 'off' !== $hind || 'off' !== $poppins || 'off' !== $droid_serif ) {
        $font_families = array();

        if( 'off' !== $hind ){
            $font_families[] = 'Hind:400,600,700';
        }

        if( 'off' !== $poppins ){
            $font_families[] = 'Poppins:300,400,500,600,700';
        }

        if( 'off' !== $droid_serif ){
            $font_families[] = 'Droid Serif:400i';
        }

        $query_args = array(
            'family'  => urlencode( implode( '|', $font_families ) ),
            'display' => urlencode( 'fallback' ),
        );

        $fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
    }

    return esc_url( $fonts_url );
}
endif;