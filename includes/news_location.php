<?php
function get_table_name(){
    global $wpdb;
    $table_name = $wpdb->prefix . 'rp_news_location';
    return $table_name;
}
function rp_create_news_location_table()
{
    global $wpdb;
    $table_name = get_table_name();
    $charset = $wpdb->get_charset_collate();
    $sql = "CREATE TABLE $table_name(post_id int(11) NOT NULL,lat decimal (9, 6) NOT NULL,lon decimal(9, 6) NOT NULL,PRIMARY KEY(post_id)) $charset;";
    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);
}
register_activation_hook(RP_PLUGIN_FILE, 'rp_create_news_location_table');
function rp_get_news_location($post_id)
{
    global $wpdb;
    $table_name = get_table_name();
    $get_location = get_transient( 'rp_get_location'. $post_id );
    if($get_location){
        return $get_location;
    }
        $results = $wpdb->get_row(query: "SELECT * FROM $table_name WHERE post_id = " . intval($post_id));
        set_transient('rp_get_loction'. $post_id, $results);
        return $results;
    
}

function rp_save_news_location($post_id, $lat, $lon)
{
    global $wpdb;
    $table_name = get_table_name();;
    $sql_insert = "INSERT INTO `$table_name`
          (`post_id`,`lat`,`lon`) 
   values ($post_id, $lat, $lon)";



    if ( rp_get_news_location($post_id)) {

        $wpdb->update(
            $table_name,
            array(
                'lat' => $lat,
                'lon' => $lon
            ),
            array( 'post_id'=> $post_id),
            array(
                '%f',
                '%f'
            ),
            array(
                '%d'
            )
            );        
        
    } else {
        $wpdb->query($sql_insert);
        // $wpdb->insert(
        //     $table_name,
        //     array(
        //         'post_id'=> $post_id,
        //         'lat' => $lat,
        //         'lon' => $lon
        //     ),
        //     array(
        //         '%d',
        //         '%f',
        //         '%f'
        //     )
        //     );
    }  
    delete_transient('rp_get_loction'. $post_id);  
    
}