<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( 'No Direct Access' );
}


function shortcode_function( $atts, $content = '' ) {
	$atts = shortcode_atts(
		array(
			'title' => 'Default Title',
			'color' => 'red',
		),
		$atts
	);
	ob_start();
	?>
	<div class='rp-h2'>
		<h2>
			<?php echo $atts['title']; ?>
		</h2>Color :
		<span style="color:<?php echo $atts['color']; ?>">Color </span>
		Content : <?php echo $content; ?>
	</div>

	<?php
	return ob_get_clean();
}

add_shortcode( 'my-raj-shortcode', 'shortcode_function' );

function my_shortcode( $atts, $content = null ) {
	$atts = shortcode_atts(
		array(
			'title' => 'My Title',
			'color' => '#000000',
		),
		$atts
	);

	$title = $atts['title'];
	$color = $atts['color'];

	ob_start();
	?>
	<div class='rp-h2'>
		<h2>
			<?php echo $title; ?>
		</h2>
		This is shortcode
		<span style="color:<?php echo $color; ?>">Color </span>
		<?php echo $content; ?>
	</div>

	<?php
	return ob_get_clean();
}
add_shortcode( 'my_shortcode', 'my_shortcode' );
