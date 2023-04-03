<?php

/*
Plugin Name: Raj Plugin
Plugin URI: https://github.com/
Description: Plugin Development.
Version: 1.0
Requires at least: 5.0
Requires PHP: 5.2
Author: Automattic
Author URI: https://github.com/
License: GPLv2 or later
*/

echo "Raj";
require_once(dirname(__FILE__) . '/includes/news_meta_box.php');
require_once(dirname(__FILE__) . '/includes/news_shortcode.php');
require_once(dirname(__FILE__) . '/includes/news_custom_post_types.php');

// function rp_change_my_array($value){
//     $value['five'] = 5;
//     return $value;
// }
// add_filter( 'rp_my_array', 'rp_change_my_array', 10 , 1);



// function rp_change_my_array2($value ){
//     $value['second'] = 9;
//     return $value;
// }
// add_filter( 'rp_my_array', 'rp_change_my_array2', 2 , 1 );


// $my_array = apply_filters( 'rp_my_array', ['first' => 1, 'second' => 2, 'third' => 3, 'four' => 4] );

// var_dump($my_array);


// add_action( 'rp_action_content', 'change_content', 19, 1 );
// function change_content(){
//     echo "Hi";
// }
/*
?>


<div>
    <h2> Raj H2 </h2>
    <p> Content </p>
    <?php do_action( 'rp_action_content' ); ?>
</div>
*/



//shortcode


// function filter_content ($content){
//     global $post;

//     return $content . "<h3>After Content</h3>" .$post->post_date;
// }


// function filter_content ($content){
//     if( is_page(  )){
//         $content = str_ireplace('lorem ipsum', 'Raj' , $content);
//         $content = $content . "<h3>After Content</h3>";
//     }    
//     return $content ;
// }

// add_filter( 'the_content', 'filter_content');

// function exclude_single_posts_home($query) {
// 	if ( $query->is_home() && $query->is_main_query() ) {
// 		$query->set( 'post__not_in', array( 14 ) );
// 	}
// }
// add_action( 'pre_get_posts', 'exclude_single_posts_home' );

// function my_the_posts($posts, $query = false) {
//     $ads_page = get_page_by_title( 'Ads Page' );
//     array_splice($posts, 1, 0, array($ads_page));
//     return $posts;
// }
// add_filter( 'the_posts', 'my_the_posts' );



if (!defined('ABSPATH'))
    die("No Direct Access");

define('RP_PLUGIN_FILE', __FILE__);

function rp_adding_meta_nlocation($content)
{
    if (is_singular('news')) {
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
            'numberposts' => 3,
            'post_type'=> 'news',
            // 'exclude'=> get_the_ID(  ),
            'post__not_in'=> array(get_the_ID(  )),
            'meta_key'=> '_nlocation',
            'meta_value'=>esc_html(get_post_meta(get_the_ID(), '_nlocation', true)) ,
        );
        $wp_query = New WP_Query($args);

        // $latest_post =  $wp_query->query($args);
        if($wp_query->have_posts()){
        ob_start();
        ?>
        <h3>Latest News </h3>
        <ul>
            <?php while ($wp_query->have_posts()): $wp_query->the_post(); ?>
               
                <li>
                    <a href='<?php echo get_the_permalink( $wp_query->post->ID ); ?>'><?php echo the_title( ); ?></a>
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