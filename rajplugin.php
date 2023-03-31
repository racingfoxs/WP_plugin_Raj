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

// function rp_change_my_array($value){
//     $value['five'] = 5;
//     return $value;
// }
// add_filter( 'rp_my_array', 'rp_change_my_array', 10 , 1);


// function rp_change_my_array2($value){
//     $value['second'] = 9;
//     return $value;
// }
// add_filter( 'rp_my_array', 'rp_change_my_array2', 8 , 1);

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


function shortcode_function($atts, $content = '')
{
    $atts = shortcode_atts(
        array(
            'title' => 'Default Title',
            'color' => 'red'
        ),
        $atts
    );
    ob_start();
    ?>
    <div class='rp-h2'>
        <h2>
            <?php echo $atts['title']; ?>
        </h2>
        This is shortcode
        <span style="color:<?php echo $atts['color']; ?>">Color </span>
        <?php echo $content; ?>
        <?php echo get_the_title() ?>
    </div>

    <?php
    return ob_get_clean();
}

add_shortcode('my-raj-shortcode', 'shortcode_function');

// function filter_content ($content){
//     global $post;
    
//     return $content . "<h3>After Content</h3>" .$post->post_date;
// }


function filter_content ($content){
    if( is_page(  )){
        $content = str_ireplace('lorem ipsum', 'Raj' , $content);
        $content = $content . "<h3>After Content</h3>";
    }    
    return $content ;
}

add_filter( 'the_content', 'filter_content');

// function exclude_single_posts_home($query) {
// 	if ( $query->is_home() && $query->is_main_query() ) {
// 		$query->set( 'post__not_in', array( 14 ) );
// 	}
// }
// add_action( 'pre_get_posts', 'exclude_single_posts_home' );

function my_the_posts($posts, $query = false) {
    $ads_page = get_page_by_title( 'Ads Page' );
    array_splice($posts, 1, 0, array($ads_page));
    return $posts;
}
add_filter( 'the_posts', 'my_the_posts' );