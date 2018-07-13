<?php

global $wpdb;
global $response;
global $value;

$hotel_title = $response -> $value -> HotelName;

$query = $wpdb->get_results("SELECT * FROM $wpdb->postmeta WHERE meta_key = 'mc_hotel_details_otel_id' AND  meta_value = '".$args['otel_select']."' LIMIT 1", ARRAY_A);

if(isset($query[0]['post_id']) === false) return;
$rooms = array();
foreach ($response -> $value -> Rooms as $key => $value1) {
    $rooms[$value1 -> HotelRoomCode] = array(
        'HotelRoomCode' => $value1 -> HotelRoomCode,
        'HotelRoomTitle' => mb_convert_case($value1 -> HotelRoomTitle, MB_CASE_TITLE, "UTF-8"),
        'Featured' => array(),
        'Gallery'  => array(),
    );

    //printarr($value1);
    if(isset($value1 -> items) !== false){
        foreach ($value1 -> items as $key2 => $item) {
            if(isset($item -> HotelFactSheetValue1) && $item -> HotelFactSheetValue1 == 'Var'){
                $rooms[$value1 -> HotelRoomCode]['Featured'][] = array(
                    'title' => mb_convert_case($item -> SectionTitle, MB_CASE_TITLE, "UTF-8"),
                    'icon'  => '<i class="fa '.$item -> Icon.'"></i>',
                );
            }
        }
    }
    if(isset($value1 -> pictures))
    foreach ($value1 -> pictures as $key3 => $pic) {
        $rooms[$value1 -> HotelRoomCode]['Gallery'][] = 'http://file.puzzlesistem.com/'.$pic -> UploadFilePath;
    }
}

/*Room Feat*/
$temp = array('mice_room_feature');
$args = array(
    'hide_empty' => 0
);
$terms = get_terms( $temp, $args);
$temp = $rooms;
$rooms = array();



foreach ($temp as $key => $value) {
    if(isset($value['Gallery'][0]))
    $thmid = Generate_Featured_Image($value['Gallery'][0],$value['HotelRoomTitle']);

    /*room featured*/
    $featureroom = array();
    foreach ($value['Featured'] as $key1 => $value1) {
        $isterm = isExistTerm($terms,$value1['title']);
        if($isterm == false){
            $id = wp_insert_term(
              $value1['title'], // the term
              'mice_room_feature', // the taxonomy
              array(
                'description'=> '',
                'slug' => $value1['title'],
                'term_type' => 'templ_upload_font',
                'term_font_icon' => $value1['icon'],
              )
            );
            if(!is_wp_error($id) && isset($id['term_id'])){
                $featureroom[] = get_term($id['term_id'], 'mice_room_feature') -> name ;
                PLL()->model->term->set_language($id['term_id'], $lang );
            }
        }else{
            $featureroom[] = get_term($isterm, 'mice_room_feature') -> name ;
        }
    }

    /*layer slider room*/

    $tempslide = array();
    $count = 0;
    foreach ($value['Gallery'] as $key1 => $value1) {
        if($count === 7) break;
        $item = Generate_Featured_Image($value1,$value['HotelRoomTitle']);
        if($item != "") $tempslide[] = $item;
        $count++;
    }

    $sliderroom = array(
        'properties' => array(
            'title' => $hotel_title.'-'.$value['HotelRoomTitle'],
            'type' => 'responsive',
            'width' => '675',
            'height' => '425',
            'fitScreenWidth' => 'true',
            'allowFullscreen' => 'true',
            'globalBGPosition' => '50% 50%',
            'navprevnext' => true,
            'navstartstop' => true,
            'navbuttons' => true,
            'hoverprevnext' => true,
            'circletimer' => true,
            'sliderfadeinduration' => '350',
            'forceLayersOutDuration' => '750',
        ),
        'layers' => array(),
    );

    $count = 0;
    foreach ($tempslide as $key1 => $value1) {
        if($count === 7) break;
        $sliderroom['layers'][] = array(
            'properties' => array(
                'background' => wp_get_attachment_url($value1),
                'backgroundThumb' => wp_get_attachment_url($value1),
                'backgroundId' => '',
                'bgsize' => 'cover',
                'bgposition' => '50% 100%',
                'slidedelay' => '4000',
            ),
        );
        $count++;
    }
    //printarr($tempslide);
    $slideid = addSlider($sliderroom, $hotel_title.'-'.$value['HotelRoomTitle']);

    $rooms[] = array(
        'mc_room_code'     => $value['HotelRoomCode'],
        'mc_room_title'    => $value['HotelRoomTitle'],
        'mc_room_wysiwyg'  => '',
        'mc_room_image_id' => $thmid,
        'mc_room_image'    => wp_get_attachment_url($thmid),
        'mc_room_featured' => $featureroom,
        'mc_room_select'   => $slideid,

    );
}

update_post_meta( $query[0]['post_id'], 'mc_room_repeat_group', $rooms);

echo "Mice otel odası tamamdır TAŞO :)";
