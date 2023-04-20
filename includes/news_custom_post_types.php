<?php
if (!defined('ABSPATH'))
    die("No Direct Access");

//add new custom post type

function new_post_type()
{
    $args = array(
        'public' => true,
        'label' => 'News',
        'has_archive' => true,
        'supports' => array('title', 'editor', 'thumbnail', 'excerpt'),
        'show_in_rest' => true,
    );
    register_post_type('news', $args);

    $args2 = array(
        'label' => 'News Category',
        'hierarchical' => true,
    );

    register_taxonomy('news-category', 'news', $args2);


}

add_action('init', 'new_post_type');


//activation  cpt
function activation_plug()
{
    new_post_type();
    flush_rewrite_rules();
}

register_activation_hook('RP_PLUGIN_FILE', 'activation_plug');