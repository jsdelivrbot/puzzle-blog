<?php

    function Generate_Featured_Image( $image_url,$name){
        $upload_dir = wp_upload_dir();
        $request  = wp_remote_get( $image_url );
        $image_data = wp_remote_retrieve_body( $request );
        if ( 'OK' !== wp_remote_retrieve_response_message( $image_data ) OR 200 !== wp_remote_retrieve_response_code( $image_data ) ):
        $wp_filetype = wp_check_filetype($image_url, null );
        $filename = uniqid(clean_string($name)).'.'.$wp_filetype['ext'];
        if(wp_mkdir_p($upload_dir['path']))     $file = $upload_dir['path'] . '/' . $filename;
        else $file = $upload_dir['basedir'] . '/' . $filename;
        file_put_contents($file, $image_data);
        $attachment = array(
            'post_mime_type' => $wp_filetype['type'],
            'post_title' => sanitize_file_name($filename),
            'post_content' => '',
            'post_status' => 'inherit'
        );
        $attach_id = wp_insert_attachment( $attachment, $file);

        require_once(ABSPATH . 'wp-admin/includes/image.php');
        $attach_data = wp_generate_attachment_metadata( $attach_id, $file );
        $res1 = wp_update_attachment_metadata( $attach_id, $attach_data );
        //printarr(filesize(get_attached_file($attach_id)));
        if(wp_attachment_is_image($attach_id) && filesize(get_attached_file($attach_id)) > 0){
            return $attach_id;
        }else{
            return '';
        }

        else:
            return '';
        endif;
    }

    function addSlider($data,$title){
        return LS_Sliders::add($title, $data);
    }

    function isExistTerm($terms,$name){
        foreach ($terms as $key => $value) {
            if(mb_strtolower($value -> name) == mb_strtolower($name)){
                return $value -> term_id;
            }
        }
        return false;
    }