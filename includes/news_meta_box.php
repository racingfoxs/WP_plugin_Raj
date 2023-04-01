<?php


//adding metabox
function rp_render_nlocation_meta_box($post)
{
    
    ?>
    <div class="inside">
        <p>
            <label for="nlocation"> Location</label>
            <input type="text" id="news_location" value="<?php echo get_post_meta( $post->ID, '_nlocation', true ) ?>" name="nlocation"/>
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
    if ( defined(' DOING_AUTOSAVE') && DOING_AUTOSAVE)
        return;
    if (isset($_POST['nlocation'])){
        update_post_meta( $post_id, '_nlocation', $_POST['nlocation']);
    }
}

add_action( 'save_post_news', 'rp_save_meta_data', 10 );

