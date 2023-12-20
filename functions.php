<?php 

if(!defined('ABSPATH'))
{
    exit;
}

include_once(get_template_directory() . '/lib/helpers.php');
include_once(get_template_directory() . '/lib/utils.php');





//images
add_theme_support( 'post-thumbnails' );




add_action('wp_enqueue_scripts', 'enqueue_custom_scripts');
function enqueue_custom_scripts() {
    //css
    wp_enqueue_style( 'style-all_styles-css', get_template_directory_uri() .'/css/all_styles.css', array(), '1.0.1' );
    //js
    wp_enqueue_script('jquery');
    wp_enqueue_script('custom-script', get_template_directory_uri() . '/assets/js/st.js');
    wp_localize_script('custom-script', 'ajaxpagination', array(
        'ajaxurl' => admin_url('admin-ajax.php'),
        'noposts' => __('No more posts found', 'text-domain'),
    ));
}





?>