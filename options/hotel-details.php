<?php

global $wpdb;
global $response;
global $value;

//$query = $wpdb->get_results("SELECT * FROM $wpdb->postmeta WHERE meta_key = 'hotel_details_code' AND  meta_value = '".$args['otel_select']."' LIMIT 1", ARRAY_A);

$balayi = array(
    'details' => '',
    'items'   => array()
);

/*otel genel detayları*/
$detail = array(
    'hotelcode' => $response -> $value -> Locations[0] -> HotelLocationHotelCode,
    'title' => $response -> $value -> Rooms[0] -> items[0] -> HotelFactSheetHotelTitle,
    'content' => $response -> $value -> Showcase -> Description,
    'city' => $response -> $value -> Locations[0] -> CityName,
    'map'  => $response -> $value -> Locations[0] -> HotelLocationLatitude .','. $response -> $value -> Locations[0] -> HotelLocationLongitude,
    'thumbnail' => 'http://file.puzzlesistem.com/'.$response -> $value -> Showcase -> Picture,
    'Featured' => array(),
    'Gallery'  => array(),
);

foreach ($response -> $value -> Pictures -> Hotel as $key6 => $pic2) {
    $detail['Gallery'][] = 'http://file.puzzlesistem.com/'.$pic2 -> UploadFilePath;
}

foreach ($response -> $value -> General as $key4 => $htl) {
    if($htl -> SectionCode == 'SEC_92d6496f3556e2'){
        foreach ($htl -> items as $key5 => $htl1) {
            if($htl1 -> HotelFactSheetValue1 != 'Yok'){
                $tt = $htl1 -> HotelFactSheetValue1 == "Ücretli" || $htl1 -> HotelFactSheetValue1 == "Ücretsiz" ? $htl1 -> SectionTitle.' ('.$htl1 -> HotelFactSheetValue1.')' : $htl1 -> SectionTitle;
                $detail['Featured'][] = array(
                    'title' => $tt,
                    'icon'  => '<i class="fa '.$htl1 -> Icon.'"></i>',
                );
            }
        }
    }else if($htl -> SectionCode == 'SEC_3203e68d320328'){
        foreach ($htl -> items as $key => $htl1) {
            if($htl1 -> SectionCode === "SEC_d2204c49466beb"){
                $balayi['details'] = $htl1 -> HotelFactSheetValue2;
            }else if($htl1 -> HotelFactSheetValue1 != "Yok"){
                $balayi['items'][] = $htl1 -> HotelFactSheetSectionTitle;
            }
        }
    }
}

$postarr = array(
    'post_type' => 'hotel',
    'post_status' => 'publish',
    'post_title' => mb_convert_case($detail['title'], MB_CASE_TITLE, "UTF-8"),
    'post_content' => $detail['content'],
    'post_excerpt' => ''
);

$rooms = array();

foreach ($response -> $value -> Rooms as $key => $value1) {

    $rooms[$value1 -> HotelRoomCode] = array(
        'HotelRoomCode' => $value1 -> HotelRoomCode,
        'HotelRoomTitle' => mb_convert_case($value1 -> HotelRoomTitle, MB_CASE_TITLE, "UTF-8"),
        'Featured' => array(),
        'Gallery'  => array(),
    );

    foreach ($value1 -> items as $key2 => $item) {
        if(isset($item -> HotelFactSheetValue1) && $item -> HotelFactSheetValue1 != 'Yok'){
            $tt = $item -> HotelFactSheetValue1 == "Ücretli" || $item -> HotelFactSheetValue1 == "Ücretsiz" ? mb_convert_case($item -> SectionTitle, MB_CASE_TITLE, "UTF-8").' ('.$item -> HotelFactSheetValue1.')' : mb_convert_case($item -> SectionTitle, MB_CASE_TITLE, "UTF-8");
            $rooms[$value1 -> HotelRoomCode]['Featured'][] = array(
                'title' => $tt,
                'icon'  => '<i class="fa '.$item -> Icon.'"></i>',
            );
        }
    }

    if(isset($value1 -> pictures))
    foreach ($value1 -> pictures as $key3 => $pic) {
        $rooms[$value1 -> HotelRoomCode]['Gallery'][] = 'http://file.puzzlesistem.com/'.$pic -> UploadFilePath;
    }
}


$location = "";
$temp = array('hotel_locations');
$args = array(
    'hide_empty' => 0
);
$terms = get_terms( $temp, $args);
$isterm = isExistTerm($terms,$detail['city']);
if($isterm == false){
    $id = wp_insert_term(
      $detail['city'], // the term
      'hotel_locations', // the taxonomy
      array(
        'description'=> '',
        'slug' => $detail['city']
      )
    );
    PLL()->model->term->set_language($id, $lang );
    $location = $id['term_id'] ;
}else{
    $location = array(
        0 => $isterm
    ) ;
}

$feature = array();
$taxonomies = array('hotel_feature');
$args = array(
    'hide_empty' => 0
);

$terms = get_terms( $taxonomies, $args);
foreach ($detail['Featured'] as $key => $value) {
    $isterm = isExistTerm($terms,$value['title']);
    if($isterm == false){
        $id = wp_insert_term(
          $value['title'], // the term
          'hotel_feature', // the taxonomy
          array(
            'description'=> '',
            'slug' => $value['title'],
            'term_type' => 'templ_upload_font',
            'term_font_icon' => $value['icon'],
          )
        );
        $feature[] = $id['term_id'] ;
        PLL()->model->term->set_language($id, $lang );
    }else{
        $feature[] = $isterm ;
    }
}

/*layer slider*/
$temp = array();
$count = 0;
foreach ($detail['Gallery'] as $key => $value) {
    if($count === 7) break;
    $item = Generate_Featured_Image($value,$detail['title']);
    if($item != "") $temp[] = $item;
    $count++;
}

$slider = array(
    'properties' => array(
        'title' => $detail['title'],
        'type' => 'responsive',
        'width' => '1920',
        'height' => '650',
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
foreach ($temp as $key => $value) {
    if($count === 7) break;
    $slider['layers'][] = array(
        'properties' => array(
            'background' => wp_get_attachment_url($value),
            'backgroundThumb' => wp_get_attachment_url($value),
            'backgroundId' => '',
            'bgsize' => 'cover',
            'bgposition' => '50% 100%',
            'slidedelay' => '4000',
        ),
    );
    $count++;
}


/*Room Feat*/
$temp = array('hotel_room_feature');
$args = array(
    'hide_empty' => 0
);
$terms = get_terms( $temp, $args);
$temp = $rooms;
$rooms = array();

foreach ($temp as $key => $value) {
    $thmid = Generate_Featured_Image($value['Gallery'][0],$value['HotelRoomTitle']);
    /*room featured*/
    $featureroom = array();
    foreach ($value['Featured'] as $key1 => $value1) {
        $isterm = isExistTerm($terms,$value1['title']);
        if($isterm == false){
            try {
                $id = wp_insert_term(
                  $value1['title'], // the term
                  'hotel_room_feature', // the taxonomy
                  array(
                    'description'=> '',
                    'slug' => $value1['title'],
                    'term_type' => 'templ_upload_font',
                    'term_font_icon' => $value1['icon'],
                  )
                );
                if(!is_wp_error($id) && isset($id['term_id'])){
                    $featureroom[] = get_term($id['term_id'], 'hotel_room_feature') -> name ;
                    PLL()->model->term->set_language($id['term_id'], $lang );
                }

            } catch (Exception $e) {

            }
        }else{
            $featureroom[] = get_term($isterm, 'hotel_room_feature') -> name ;
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
            'title' => $detail['title'].'-'.$value['HotelRoomTitle'],
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
    $slideid = addSlider($sliderroom, $detail['title'].'-'.$value['HotelRoomTitle']);

    $rooms[] = array(
        'hotel_room_code'     => $value['HotelRoomCode'],
        'hotel_room_title'    => $value['HotelRoomTitle'],
        'hotel_room_wysiwyg'  => '',
        'hotel_room_image_id' => $thmid,
        'hotel_room_image'    => wp_get_attachment_url($thmid),
        'hotel_room_featured' => $featureroom,
        'hotel_room_select'   => $slideid,

    );
}

/*payment method*/

$cards = array(
    0 => 'fa-cc-visa',
    1 => 'fa-cc-mastercard',
    2 => 'fa-cc-discover'
);


$slideid = addSlider($slider, $detail['title'].'- Genel');
$post_id = wp_insert_post( $postarr, false );
add_post_meta( $post_id, 'hotel_details_select', $slideid, true );
add_post_meta( $post_id, 'hotel_details_code', $detail['hotelcode'], true );
add_post_meta( $post_id, 'hotel_details_map', $detail['map'], true );
add_post_meta( $post_id, 'hotel_room_repeat_group', $rooms, true );
add_post_meta( $post_id, 'hotel_details_allow_card', $cards, true );
add_post_meta( $post_id, 'hotel_honey_moon_wysiwyg', $balayi['details'], true );
add_post_meta( $post_id, 'hotel_honey_moon_title', $balayi['items'], true );
wp_set_post_terms($post_id, $feature, 'hotel_feature');
wp_set_post_terms($post_id, $location, 'hotel_locations');

echo "Ekleme Başarılı TAŞO ❤ MİMİ  ✔";

