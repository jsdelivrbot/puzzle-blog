<?php
/**
 * Register a custom post type called "hotel".
 *
 * @see get_post_type_labels() for label keys.
 */

add_action( 'init', 'hotel_init' );
add_action('init','hotel_locations1');
add_action('init','hotel_locations2');
add_action('init','hotel_locations3');
add_action( 'cmb2_admin_init', 'hotel_details' );

function hotel_init(){
    $labels = array(
        'name'                  => _x( 'Otel', 'Post type general name', 'puzzle' ),
        'singular_name'         => _x( 'Otel', 'Post type singular name', 'puzzle' ),
        'menu_name'             => _x( 'Otel', 'Admin Menu text', 'puzzle' ),
        'name_admin_bar'        => _x( 'Otel', 'Add New on Toolbar', 'puzzle' ),
        'add_new'               => __( 'Otel Ekle', 'puzzle' ),
        'add_new_item'          => __( 'Yeni Otel Ekle', 'puzzle' ),
        'new_item'              => __( 'Yeni Otel', 'puzzle' ),
        'edit_item'             => __( 'Otel Düzenle', 'puzzle' ),
        'view_item'             => __( 'Oteli Görüntüle', 'puzzle' ),
        'all_items'             => __( 'Tüm Oteller', 'puzzle' ),
        'search_items'          => __( 'Otel Ara', 'puzzle' ),
        'parent_item_colon'     => __( 'Parent Otel:', 'puzzle' ),
        'not_found'             => __( 'Otel Bulunamadı.', 'puzzle' ),
        'not_found_in_trash'    => __( 'Otel Bulunamadı.', 'puzzle' ),
        'featured_image'        => _x( 'Öne Çıkan Görsel', 'Overrides the “Featured Image” phrase for this post type. Added in 4.3', 'puzzle' ),
        'set_featured_image'    => _x( 'Öne Çıkan Görsel Ayarla', 'Overrides the “Set featured image” phrase for this post type. Added in 4.3', 'puzzle' ),
        'remove_featured_image' => _x( 'Öne Çıkan Görseli Kaldır', 'Overrides the “Remove featured image” phrase for this post type. Added in 4.3', 'puzzle' ),
        'use_featured_image'    => _x( 'Öne Çıkan Görsel Olarak Kullan', 'Overrides the “Use as featured image” phrase for this post type. Added in 4.3', 'puzzle' ),
        'archives'              => _x( 'Otel Arşivi', 'The post type archive label used in nav menus. Default “Post Archives”. Added in 4.4', 'puzzle' ),
        'insert_into_item'      => _x( 'Otel İçine Yerleştir', 'Overrides the “Insert into post”/”Insert into page” phrase (used when inserting media into a post). Added in 4.4', 'puzzle' ),
        'uploaded_to_this_item' => _x( 'Bu Otele Yüklendi', 'Overrides the “Uploaded to this post”/”Uploaded to this page” phrase (used when viewing media attached to a post). Added in 4.4', 'puzzle' ),
        'filter_items_list'     => _x( 'Filtre Uygula', 'Screen reader text for the filter links heading on the post type listing screen. Default “Filter posts list”/”Filter pages list”. Added in 4.4', 'puzzle' ),
        'items_list_navigation' => _x( 'Otel Navigasyon', 'Screen reader text for the pagination heading on the post type listing screen. Default “Posts list navigation”/”Pages list navigation”. Added in 4.4', 'puzzle' ),
        'items_list'            => _x( 'Otel List', 'Screen reader text for the items list heading on the post type listing screen. Default “Posts list”/”Pages list”. Added in 4.4', 'puzzle' ),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'hotel' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 4,
        'supports'           => array( 'title','thumbnail', 'editor', 'comments'),
        'menu_icon'   => 'dashicons-building',
    );

    register_post_type( 'hotel', $args );
}

function hotel_details(){
    $prefix = 'hotel_details_';
    $cmb = new_cmb2_box( array(
        'id'            => $prefix.'metabox',
        'title'         => __( 'Otel Detayları', 'puzzle' ),
        'object_types'  => array( 'hotel'), // Post type
        'context'       => 'normal',
        'priority'      => 'high',
        'show_names'    => true, // Show field names on the left
        // 'cmb_styles' => false, // false to disable the CMB stylesheet
        // 'closed'     => true, // Keep the metabox closed by default
    ) );

    $cmb->add_field( array(
        'name' => __( 'Hotel Code', 'cmb2' ),
        'id'   => $prefix.'code',
        'type' => 'text',
        /*'attributes'  => array(
            'disabled'    => 'disabled',
        ),*/
    ) );

    $cmb->add_field( array(
    'name' => __( 'Hotel URL', 'cmb2' ),
    'id'   => $prefix . 'hotel_url',
    'default' => 'www.puzzletravel.com/tr/',
    'type' => 'text_url',
    // 'protocols' => array( 'http', 'https', 'ftp', 'ftps', 'mailto', 'news', 'irc', 'gopher', 'nntp', 'feed', 'telnet' ), // Array of allowed protocols
) );

    $cmb->add_field(array(
        'name' => 'Enlem',
        'id'   => $prefix . 'enlem',
        'default' => '',
        'type' => 'text',
        'attributes'  => array(
            'placeholder' => '35.330273',
        ),
    ) );
      $cmb->add_field(array(
        'name' => 'Boylam',
        'id'   => $prefix . 'boylam',
        'default' => '',
        'type' => 'text',
        'attributes'  => array(
            'placeholder' => '35.330273',
        ),
    ) );
    
}
function hotel_locations1(){
  $labels = array(
    'name' => _x( 'Ülke', 'puzzle' ),
    'singular_name' => _x( 'Otel Lokasyon 1', 'puzzle' ),
    'edit_item'         => __( 'Düzenle', 'puzzle' ),
    'update_item'       => __( 'Güncelle', 'puzzle' ),
    'add_new_item'      => __( 'Yeni Lokasyon Ekle', 'puzzle' ),
    'not_found'         => __( 'Lokasyon Bulunamadı', 'puzzle' ),
  );

  register_taxonomy('hotel_locations1',array('hotel'), array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'query_var' => true,
    'show_in_nav_menus' => true,
    'rewrite' => array('slug' => 'hotel_locations1', 'with_front' => false),
  ));
}
function hotel_locations2(){
  $labels = array(
    'name' => _x( 'Şehir', 'puzzle' ),
    'singular_name' => _x( 'Otel Lokasyon 2', 'puzzle' ),
    'edit_item'         => __( 'Düzenle', 'puzzle' ),
    'update_item'       => __( 'Güncelle', 'puzzle' ),
    'add_new_item'      => __( 'Yeni Lokasyon Ekle', 'puzzle' ),
    'not_found'         => __( 'Lokasyon Bulunamadı', 'puzzle' ),
  );

  register_taxonomy('hotel_locations2',array('hotel'), array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'query_var' => true,
    'show_in_nav_menus' => true,
    'rewrite' => array('slug' => 'hotel_locations2', 'with_front' => false),
  ));
}
function hotel_locations3(){
  $labels = array(
    'name' => _x( 'Yerleşke', 'puzzle' ),
    'singular_name' => _x( 'Otel Lokasyon', 'puzzle' ),
    'edit_item'         => __( 'Düzenle', 'puzzle' ),
    'update_item'       => __( 'Güncelle', 'puzzle' ),
    'add_new_item'      => __( 'Yeni Lokasyon Ekle', 'puzzle' ),
    'not_found'         => __( 'Lokasyon Bulunamadı', 'puzzle' ),
  );

  register_taxonomy('hotel_locations3',array('hotel'), array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'query_var' => true,
    'show_in_nav_menus' => true,
    'rewrite' => array('slug' => 'hotel_locations3', 'with_front' => false),
  ));
}
