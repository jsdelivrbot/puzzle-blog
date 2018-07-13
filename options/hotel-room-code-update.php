<?php
/*room code update*/
global $wpdb;

$query = $wpdb->get_results("SELECT * FROM $wpdb->postmeta WHERE meta_key = 'hotel_details_code' AND  meta_value = '".$args['otel_select']."' LIMIT 1", ARRAY_A);

if(isset($query[0]['post_id'])):
    $htl_content = get_post_meta($query[0]['post_id'], '', true);
    $htl_rooms = maybe_unserialize( $htl_content['hotel_room_repeat_group'][0]);
    $hotelCode = $htl_content['hotel_details_code'][0];

    foreach ($response->$hotelCode->Rooms as $key => $value) {
        $rm_code = $value->HotelRoomCode;
        foreach ($htl_rooms as $key1 => $value1) {
            if(strtolower(trim($value1['hotel_room_title'])) == strtolower(trim($value->HotelRoomTitle))){
                $htl_rooms[$key1]['hotel_room_code'] = $rm_code;
            }
        }
    }

    $updateRoom = maybe_serialize( $htl_rooms );

    $updateQuery = $wpdb->get_results("UPDATE $wpdb->postmeta SET meta_value = '".$updateRoom."' WHERE meta_key = 'hotel_room_repeat_group' and post_id = '".$query[0]['post_id']."'");
else:
    echo 'Oda Eşleşmesi Bulunamadı';

endif;