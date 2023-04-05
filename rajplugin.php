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
Text Domain: raj-plugin
*/

// phpinfo();
// xdebug_info();


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
define('RP_VERSION', '1.0');



require_once(dirname(__FILE__) . '/includes/wp_requirements.php');

$my_plugin_requirements = new RP_Requirements(
    'Raj Plugin',
    RP_PLUGIN_FILE,
    array(
        'PHP' => '7.4',
        'WordPress' => '5.0',
    )
);

if ( false === $my_plugin_requirements->pass()){
    $my_plugin_requirements->halt();
    return;
}


require_once(dirname(__FILE__) . '/includes/news_location.php');
require_once(dirname(__FILE__) . '/includes/news_meta_box.php');
require_once(dirname(__FILE__) . '/includes/news_shortcode.php');
require_once(dirname(__FILE__) . '/includes/news_custom_post_types.php');
require_once(dirname(__FILE__) . '/includes/admin_settings.php');
require_once(dirname(__FILE__) . '/includes/news-content.php');
require_once(dirname(__FILE__) . '/includes/insert_post_activation.php');


function addStyleFrontEnd()
{
    if (is_singular('news')) {
        wp_enqueue_style('news-setting-style', plugins_url('includes/css/frontend.css', RP_PLUGIN_FILE), array(), RP_VERSION);
        wp_enqueue_script('news-setting-script', plugins_url('includes/js/frontend.js', RP_PLUGIN_FILE), array(), RP_VERSION);
    }
}

add_action('wp_enqueue_scripts', 'addStyleFrontEnd');