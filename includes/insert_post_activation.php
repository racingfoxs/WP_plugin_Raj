<?php 

function rp_add_post_on_activation()
{
    $post_title = 'Raj Insert Post';
    if (post_exists($post_title)) {
        return;
    }

    $post_id = wp_insert_post(
        array(
            'post_title' => $post_title,
            'post_status' => 'publish',
            'post_type' => 'page',
            'post_content' => '[my-raj-shortcode]',
        )
    );
    update_option('rp_page_id', $post_id);
}
register_activation_hook(RP_PLUGIN_FILE, 'rp_add_post_on_activation');

function filterContentPost($content)
{
    $post_id = get_option('rp_page_id', false);
    if (get_the_ID() == $post_id) {
        return '[my-raj-shortcode]';
    }
    return $content;
}

add_filter('the_content', 'filterContentPost');