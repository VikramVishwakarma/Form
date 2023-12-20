<?php
add_action('wp_ajax_load', 'load');
add_action('wp_ajax_nopriv_load', 'load');

function load()
{
    $user_id = get_current_user_id();
    $params  = array();
    parse_str($_POST['formData'], $params);
    $cardnumber =   sanitize_text_field($params['cardNumber']);
    $cardname   =   sanitize_text_field($params['cardName']);
    $cardmonth  =   sanitize_text_field($params['cardMonth']);
    $cardCvv    =   sanitize_text_field($params['cardCvv']);
    $userCard   =   sanitize_text_field($params['user_card']);

    $userAlert = $params['user_alert'];
    $metaAlert = array(
        'user_alert' => $userAlert
    );

    // Function to get value
    function get_my_value()
    {
        return get_option('my_value');
    }
    // Retrieving value stored in set_my_value
    $stored_value = get_my_value();
    echo"<pre>";
    print_r($stored_value);

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////



    //image
    if (get_user_meta($user_id, 'image')) {
        update_user_meta($user_id, 'image', $stored_value);
        $response = ['response' => '201', 'message' => 'image Updated successfully'];
    } else {
        add_user_meta($user_id, 'image', $stored_value);
        $response = ['response' => '200', 'message' => 'image Add successfully'];
    }



    //Card number
    if (get_user_meta($user_id, 'cardNumber')) {
        update_user_meta($user_id, 'cardNumber', $cardnumber);
        $response = ['response' => '201', 'message' => 'Card number Updated successfully'];
    } else {
        add_user_meta($user_id, 'cardNumber', $cardnumber);
        $response = ['response' => '200', 'message' => 'Card number Add successfully'];
    }

    //Card name
    if (get_user_meta($user_id, 'cardName')) {
        update_user_meta($user_id, 'cardName', $cardname);
        $response = ['response' => '201', 'message' => 'Card name Update successfully'];
    } else {
        add_user_meta($user_id, 'cardName', $cardname, true);
        $response = ['response' => '200', 'message' => 'Card name Add successfully'];
    }



    //Card number
    if (get_user_meta($user_id, 'cardMonth')) {
        update_user_meta($user_id, 'cardMonth', $cardmonth);
        $response = ['response' => '201', 'message' => 'Month Updated successfully'];
    } else {
        add_user_meta($user_id, 'cardMonth', $cardmonth);
        $response = ['response' => '200', 'message' => 'Month Add successfully'];
    }

    //Card number
    if (get_user_meta($user_id, 'cardCvv')) {
        update_user_meta($user_id, 'cardCvv', $cardCvv);
        $response = ['response' => '201', 'message' => 'Cvv Updated successfully'];
    } else {
        add_user_meta($user_id, 'cardCvv', $cardCvv);
        $response = ['response' => '200', 'message' => 'Cvv Add successfully'];
    }


    //Card number
    if (get_user_meta($user_id, 'user_card')) {
        update_user_meta($user_id, 'user_card', $userCard);
        $response = ['response' => '201', 'message' => 'Card Updated successfully'];
    } else {
        add_user_meta($user_id, 'user_card', $userCard);
        $response = ['response' => '200', 'message' => 'Card Add successfully'];
    }

    if (get_user_meta($user_id, 'user_alert')) {
        update_user_meta($user_id, 'user_alert', $metaAlert);
        $response = ['response' => '201', 'message' => 'Alert message Update successfully'];
    } else {
        add_user_meta($user_id, 'user_alert', $metaAlert, true);
        $response = ['response' => '200', 'message' => 'Alert message successfully'];
    }
    echo json_encode(['response' => $response]);
    wp_die();
}



/* Upload File Data With Ajax*/
add_action('wp_ajax_filename_get', 'filename_get');
add_action('wp_ajax_nopriv_filename_get', 'filename_get');

function filename_get()
{
    $arr            =   array();
    $upload_dir     =   wp_upload_dir(); 
    $uploaded_files =   $_FILES['image_upload'];


    // Check if directory exists before attempting to create
    $user_dirname = $upload_dir['basedir'] . '/cxc-images/';
    if (!file_exists($user_dirname)) {
        wp_mkdir_p($user_dirname);
    }


    foreach ($uploaded_files['name'] as $key => $value) {
        $file_name   = $uploaded_files['name'][$key];
        $file_tmp    = $uploaded_files['tmp_name'][$key];
        $target_file = $user_dirname . basename($file_name);

        array_push($arr, $target_file);
        move_uploaded_file($file_tmp, $target_file);
    }
    // Passing the value
    // function set_my_value($value)
    // {
    //     update_option('my_value', $value);
    // }

    // // Storing value using set_my_value function
    // set_my_value($arr);
    wp_die();
}




add_action('wp_ajax_upload_file_data', 'upload_file_data');
add_action('wp_ajax_nopriv_upload_file_data', 'upload_file_data');

function upload_file_data()
{

    $arr            =   array();
    $upload_dir     =   wp_upload_dir(); 
    $uploaded_files =   $_FILES['image_upload'];


    // Check if directory exists before attempting to create
    $user_dirname = $upload_dir['basedir'] . '/cxc-images/';
    if (!file_exists($user_dirname)) {
        wp_mkdir_p($user_dirname);
    }


    foreach ($uploaded_files['name'] as $key => $value) {
        $file_name   = $uploaded_files['name'][$key];
        // $file_tmp    = $uploaded_files['tmp_name'][$key];
        $target_file = $user_dirname . basename($file_name);

        array_push($arr, $target_file);
        // move_uploaded_file($file_tmp, $target_file);
    }
    // Passing the value
    function set_my_value($value)
    {
        update_option('my_value', $value);
    }

    // Storing value using set_my_value function
    set_my_value($arr);
    wp_die();
}



// Created the table on Database when theme of wordpress will active.    
// include(get_template_directory() . '/lib/another_php_file.php');
// add_action("after_switch_theme", "mytheme_create_extra_table");

// function mytheme_create_extra_table(){
//     global $wpdb;

//     require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );

//     $table_name = $wpdb->prefix . 'atm_details';  //get the database table prefix to create my new table

//     $sql = "CREATE TABLE $table_name (
//       id int(10) unsigned NOT NULL AUTO_INCREMENT,
//       card_Number int(20) NOT NULL,
//       card_Holder varchar(255) NOT NULL,
//       cvv int(4) NOT NULL,
//       PRIMARY KEY  (id)
//     ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";

//     dbDelta( $sql );
// }
?>