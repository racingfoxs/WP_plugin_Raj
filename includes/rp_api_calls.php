<?php 

/*
function rp_api_call($content) {
    $url = 'https://jsonplaceholder.typicode.com/posts';
    $response = wp_remote_get( $url );
    $datas     = json_decode( wp_remote_retrieve_body( $response ));
    // if(is_array($response)){
    //     $data = $response['body'];
    // }
    foreach($datas as $data){
        ?>
        <h2><?php echo esc_html( $data->title) ?></h2>
        <p><?php echo esc_html( $data->body) ?></P>
        <?php
    }
    

}
add_filter('the_content', 'rp_api_call');

*/