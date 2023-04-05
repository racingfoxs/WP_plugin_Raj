<?php 
function rp_adding_meta_nlocation($content)
{
    if (is_singular('news')) {
        $location = hwy_get_news_location(get_the_ID());
        $content = '<p>' . esc_html($location->lat) . ',' . esc_html($location->lon) . '</p>' . $content;
        $content .= '<p>' . esc_html(get_post_meta(get_the_ID(), '_nlocation', true)) . '</p>';
    }
    return $content;
}

add_filter('the_content', 'rp_adding_meta_nlocation', 8);


//addingpost to end

function rp_add_post_to_end($content)
{
    // global $post;
    if (is_singular('news')) {
        $args = array(
            // 'numberposts' => intval(get_option('rp_related_amount'), 3)
            'posts_per_page' => intval(get_option('rp_related_amount'), 3),
            'post_type' => 'news',
            // 'exclude'=> get_the_ID(  ),
            'post__not_in' => array(get_the_ID()),
            'meta_key' => '_nlocation',
            'meta_value' => esc_html(get_post_meta(get_the_ID(), '_nlocation', true)),
        );
        $wp_query = new WP_Query($args);

        // $latest_post =  $wp_query->query($args);
        if ($wp_query->have_posts() && get_option('rp_show_related', true)) {
            ob_start();
            ?>
            <h3 class='raj-news-title'>
                <?php echo esc_html(get_option('rp_news_title', 'Related News')); ?>
            </h3>
            <p>
                <?php echo intval(get_option('rp_related_amount')); ?>
            </p>
            <ul>
                <?php while ($wp_query->have_posts()):
                    $wp_query->the_post(); ?>

                    <li>
                        <a href='<?php echo get_the_permalink($wp_query->post->ID); ?>'><?php echo the_title(); ?></a>
                    </li>
                <?php endwhile; ?>
            </ul>
            <?php
            $content .= ob_get_clean();
            wp_reset_postdata(); //because we are calling global
        }
    }
    return $content;
}

add_filter('the_content', 'rp_add_post_to_end', 12);