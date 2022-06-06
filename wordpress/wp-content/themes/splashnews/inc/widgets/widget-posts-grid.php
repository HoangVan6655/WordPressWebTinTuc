<?php
    require_once get_template_directory() . '/inc/widgets/widgets-base.php';

    if (!class_exists('SplashNews_Featured_Post')) :
        /**
         * Adds SplashNews_Featured_Post widget.
         */
        class SplashNews_Featured_Post extends DarkNews_Widget_Base
        {
            /**
             * Sets up a new widget instance.
             *
             * @since 1.0.0
             */
            function __construct()
            {
                $this->text_fields = array(
                    'darknews-featured-posts-title',
                    'darknews-number-of-posts'
                
                );
                $this->select_fields = array(
                    
                    'darknews-select-category',
                
                );
                
                $widget_ops = array(
                    'classname' => 'darknews_featured_posts_widget',
                    'description' => __('Displays grid from selected categories.', 'splashnews'),
                    'customize_selective_refresh' => false,
                );
                
                parent::__construct('darknews_featured_posts', __('AFTDN Post Grid', 'splashnews'), $widget_ops);
            }
            
            /**
             * Front-end display of widget.
             *
             * @see WP_Widget::widget()
             *
             * @param array $args Widget arguments.
             * @param array $instance Saved values from database.
             */
            
            public function widget($args, $instance)
            {
                
                $instance = parent::darknews_sanitize_data($instance, $instance);
                
                
                /** This filter is documented in wp-includes/default-widgets.php */
    
                $darknews_featured_news_title = apply_filters('widget_title', $instance['darknews-featured-posts-title'], $instance, $this->id_base);
    
                $darknews_number_of_featured_news = !empty($instance['darknews-number-of-posts']) ? $instance['darknews-number-of-posts'] :6;
                $darknews_category = !empty($instance['darknews-select-category']) ? $instance['darknews-select-category'] : '0';

                $color_class = '';
                if(absint($darknews_category) > 0){
                    $color_id = "category_color_" . $darknews_category;
                    // retrieve the existing value(s) for this meta field. This returns an array
                    $term_meta = get_option($color_id);
                    $color_class = ($term_meta) ? $term_meta['color_class_term_meta'] : 'category-color-1';
                }
                
                
                
                // open the widget container
                echo $args['before_widget'];
                ?>
                <section class="aft-blocks af-main-banner-featured-posts pad-v">
                    <div class="af-main-banner-featured-posts featured-posts darknews-customizer">
                        <?php if (!empty($darknews_featured_news_title)): ?>
                            <?php darknews_render_section_title($darknews_featured_news_title, $color_class); ?>
                        <?php endif; ?>
                        <div class="section-wrapper af-widget-body">
                            <div class="af-container-row clearfix">
                                <?php
                                    $darknews_featured_posts = darknews_get_posts($darknews_number_of_featured_news, $darknews_category);
                                    if ($darknews_featured_posts->have_posts()) :
                                        while ($darknews_featured_posts->have_posts()) :
                                            $darknews_featured_posts->the_post();
                                            global $post;
                                            ?>
                                            <div class="col-4 pad float-l ">
                                                <?php do_action('darknews_action_loop_grid', $post->ID); ?>
                                            </div>
                                        <?php endwhile;
                                    endif;
                                    wp_reset_postdata();
                                ?>
                            </div>
                        </div>
                    </div>

                </section>
                <?php
                // close the widget container
                echo $args['after_widget'];
            }
            
            /**
             * Back-end widget form.
             *
             * @see WP_Widget::form()
             *
             * @param array $instance Previously saved values from database.
             */
            public function form($instance)
            {
                $this->form_instance = $instance;
                $categories = darknews_get_terms();
                if (isset($categories) && !empty($categories)) {
                    // generate the text input for the title of the widget. Note that the first parameter matches text_fields array entry
                    echo parent::darknews_generate_text_input('darknews-featured-posts-title', __('Title', 'splashnews'), 'Posts Grid');
                    echo parent::darknews_generate_select_options('darknews-select-category', __('Select Category', 'splashnews'), $categories);

                    
                }
                

                
            }
            
        }
    endif;