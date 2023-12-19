function upload_files_to_database($post_id) {
    $upload_dir = wp_upload_dir();
    $messages = [];

    if (!empty($upload_dir['basedir']) && !empty($_FILES['file']['name'])) {
        $user_dirname = $upload_dir['basedir'] . '/cxc-images/';
        $user_baseurl = $upload_dir['baseurl'] . '/cxc-images/';

        // Check if directory exists before attempting to create
        if (!file_exists($user_dirname)) {
            wp_mkdir_p($user_dirname);
        }

        $file_count = count($_FILES['file']['name']);

        for ($i = 0; $i < $file_count; $i++) {
            $filename = $_FILES['file']['name'][$i];
            $existing_file = $user_dirname . $filename;

            if (file_exists($existing_file)) {
                $messages[] = array('success' => false, 'message' => "File '{$filename}' already exists");
            } else {
                $filename = wp_unique_filename($user_dirname, $filename);
                $success = move_uploaded_file($_FILES['file']['tmp_name'][$i], $user_dirname . $filename);
                $image_url = $user_baseurl . $filename;

                // Save file information as post meta
                add_post_meta($post_id, 'cxc_uploaded_file_' . $i, $image_url);

                $messages[] = array('success' => $success, 'cxc_image_url' => $image_url);
            }
        }
    }

    wp_send_json($messages);
}
