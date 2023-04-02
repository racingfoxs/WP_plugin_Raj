<?php
if(!defined('ABSPATH'))
die("No Direct Access");

//adding metabox
function rp_render_nlocation_meta_box($post)
{
    wp_nonce_field( 'rp_meta_save', 'news_metabox_nonce' );
    
    ?>
    <div class="inside">
        <p>
            <label for="nlocation"> Location</label>
            <input type="text" id="news_location" value="<?php echo esc_attr(  get_post_meta( $post->ID, '_nlocation', true ) ) ?>" name="nlocation"/>
</p>
    </div>
    <?php
}

//creating meta deta funcation
function rp_meta_box_location()
{
    add_meta_box('new_meta_box', 'News Location', 'rp_render_nlocation_meta_box', 'news', 'normal', 'low');
}

add_action('add_meta_boxes_news', 'rp_meta_box_location');


//savig meta data
function rp_save_meta_data( $post_id){

    if ( !isset( $_POST['news_metabox_nonce'] ) || !wp_verify_nonce( $_POST['news_metabox_nonce'] , 'rp_meta_save' ) ){
        return;

    }

    if ( defined(' DOING_AUTOSAVE') && DOING_AUTOSAVE){
        return;

    }

    if ( !current_user_can( 'edit_post', $post_id )){
        return;

    }


    if (isset( $_POST['nlocation'] )){
        update_post_meta( $post_id, '_nlocation', sanitize_text_field( $_POST['nlocation'] ));
    }
}


//is_int is_email also there for check

add_action( 'save_post_news', 'rp_save_meta_data', 10 );

