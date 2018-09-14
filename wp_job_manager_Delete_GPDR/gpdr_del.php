<?php
include('wp-load.php');
function gpdr_del($id){
    global $wpdb;
    $result = $wpdb->get_results("SELECT * FROM wp_posts left join  wp_postmeta on ID = post_id  WHERE post_status='trash' and post_type = 'resume' and (meta_key =  '_resume_file'OR meta_key =  '_candidate_photo') and post_id = $id;");
    //print_r($result);
    //print_r($result->meta_value);
    foreach( $result as $results ) {

        $filed = $results->meta_value;
        //$pippo = substr($filed,5);
        $gino = parse_url($filed, PHP_URL_PATH);
        //str_replace("http://","https://",$filed);
        unlink(ABSPATH.$gino);
        //log_this($gino);
        //var_dump();
        //echo $gino."<br>";
    }

}
function log_this(){
    
    $fileName = 'gpdr_del_log';
    ob_start();
    echo "<div>";
    echo "----------------------".date("Y-m-d H:i:s")."-----------------------------";
    echo "</div>";
    
    //  Return the contents of the output buffer
    $htmlStr = ob_get_contents();
    // Clean (erase) the output buffer and turn off output buffering
    ob_end_clean(); 
    // Write final string to file
    file_put_contents($fileName, $htmlStr);

}
?>