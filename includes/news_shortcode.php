<?php
if(!defined('ABSPATH'))
die("No Direct Access");


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