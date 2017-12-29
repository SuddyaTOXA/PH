<?php
    $widget_id = "widget_" . $args["widget_id"];
    $title = apply_filters( 'widget_title', $instance['title'] );
    $posts_per_page = $instance["number"];

    echo $args['before_widget'];
        if ( ! empty( $title ) ) {
            echo $args['before_title'] . $title . $args['after_title'];
        }

        global $wp_query;

        $paged = get_query_var('paged') ? get_query_var('paged') : 1;
        $warg = array(
            'post_type'     => 'post',
            'post_status'   => 'publish',
            'posts_per_page' => $posts_per_page
        );
        $new_query = new WP_Query( $warg );

        if ($new_query->have_posts()) {

            echo '<div class="popular-box">
                    <ul class="popular-list">';
            while ($new_query->have_posts()) { $new_query->the_post();
                $title = get_the_title();
                $url = get_the_permalink();

                echo '<li>
                        <a href="'. $url .'" title="'. esc_attr($title) .'">
                            <div class="popular-img-wrap">'; ?>
                            <?php the_post_thumbnail('full', array(
                                'alt'   => esc_attr($post->post_title)
                            )); ?>
                <?php echo '</div>
                            <h3 class="popular-title">'. $title .'</h3>
                            <div class="popular-desc">';
                                 the_excerpt();
                    echo '</div>
                        </a>
                    </li>';
            }
            echo '</ul>
                </div>';

        } else {
            echo "<p class='no-results'>Sorry, no services found...</p>";
        }
        wp_reset_query();
    echo $args['after_widget'];
?>
