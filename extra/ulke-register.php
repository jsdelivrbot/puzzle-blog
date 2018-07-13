<?php
/**
 * Register a custom post type called "ulke".
 *
 * @see get_post_type_labels() for label keys.
 */

add_action( 'init', 'ulke_init' );// Admin arayüzünde görmek için Kullanılır.
add_action( 'init', 'ulke_para_birimi' );// Admin arayüzünde görmek için Kullanılır.
add_action( 'init', 'ulke_iklim_feature');// Admin arayüzünde görmek için Kullanılır.
add_action( 'init', 'ulke_dil_feature');// Admin arayüzünde görmek için Kullanılır.
add_action( 'cmb2_admin_init', 'ulke_details' ); // Admin arayüzünde görmemek için Kullanılır.
add_action( 'cmb2_admin_init', 'ulke_genel_bilgiler' ); // Admin arayüzünde görmemek için Kullanılır.
//add_action( 'cmb2_admin_init', 'tour_details' ); // Admin arayüzünde görmemek için Kullanılır.
//get_page_template();

function ulke_init() {
    $labels = array(
        'name'                  => _x( 'Ülkeler', 'Post type general name', 'puzzle' ),
        'singular_name'         => _x( 'Ülkeler', 'Post type singular name', 'puzzle' ),
        'menu_name'             => _x( 'Ülkeler', 'Admin Menu text', 'puzzle' ),
        'name_admin_bar'        => _x( 'Ülkeler', 'Add New on Toolbar', 'puzzle' ),
        'add_new'               => __( 'Ülke Ekle', 'puzzle' ),
        'add_new_item'          => __( 'Yeni Ülke Ekle', 'puzzle' ),
        'new_item'              => __( 'Yeni Ülke', 'puzzle' ),
        'edit_item'             => __( 'Ülke Düzenle', 'puzzle' ),
        'view_item'             => __( 'Ülke Görüntüle', 'puzzle' ),
        'all_items'             => __( 'Tüm Ülkeler', 'puzzle' ),
        'search_items'          => __( 'Ülke Ara', 'puzzle' ),
        'parent_item_colon'     => __( 'Parent Ülke:', 'puzzle' ),
        'not_found'             => __( 'Ülke Bulunamadı.', 'puzzle' ),
        'not_found_in_trash'    => __( 'Ülke Bulunamadı.', 'puzzle' ),
        'featured_image'        => _x( 'Öne Çıkan Görsel', 'Overrides the “Featured Image” phrase for this post type. Added in 4.3', 'puzzle' ),
        'set_featured_image'    => _x( 'Öne Çıkan Görsel Ayarla', 'Overrides the “Set featured image” phrase for this post type. Added in 4.3', 'puzzle' ),
        'remove_featured_image' => _x( 'Öne Çıkan Görseli Kaldır', 'Overrides the “Remove featured image” phrase for this post type. Added in 4.3', 'puzzle' ),
        'use_featured_image'    => _x( 'Öne Çıkan Görsel Olarak Kullan', 'Overrides the “Use as featured image” phrase for this post type. Added in 4.3', 'puzzle' ),
        'archives'              => _x( 'Ülke Arşivi', 'The post type archive label used in nav menus. Default “Post Archives”. Added in 4.4', 'puzzle' ),
        'insert_into_item'      => _x( 'Ülke İçine ulkeleştir', 'Overrides the “Insert into post”/”Insert into page” phrase (used when inserting media into a post). Added in 4.4', 'puzzle' ),
        'uploaded_to_this_item' => _x( 'Bu Ülke Yüklendi', 'Overrides the “Uploaded to this post”/”Uploaded to this page” phrase (used when viewing media attached to a post). Added in 4.4', 'puzzle' ),
        'filter_items_list'     => _x( 'Filtre Uygula', 'Screen reader text for the filter links heading on the post type listing screen. Default “Filter posts list”/”Filter pages list”. Added in 4.4', 'puzzle' ),
        'items_list_navigation' => _x( 'Ülke Navigasyon', 'Screen reader text for the pagination heading on the post type listing screen. Default “Posts list navigation”/”Pages list navigation”. Added in 4.4', 'puzzle' ),
        'items_list'            => _x( 'Ülke List', 'Screen reader text for the items list heading on the post type listing screen. Default “Posts list”/”Pages list”. Added in 4.4', 'puzzle' ),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'ulke' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 8,
        'supports'           => array( 'title','thumbnail', 'editor', 'comments'),
        'taxonomies' => array('ulke_feature'),
        'menu_icon'   => 'dashicons-admin-site',
    );

    register_post_type( 'ulke', $args );
}
function ulke_para_birimi(){
  $labels = array(
    'name' => _x( 'Para Birimleri', 'puzzle' ),
    'singular_name' => _x( 'Para Özelliği', 'puzzle' ),
    'edit_item'         => __( 'Düzenle', 'puzzle' ),
    'update_item'       => __( 'Güncelle', 'puzzle' ),
    'add_new_item'      => __( 'Yeni Para Birimi Ekle', 'puzzle' ),
    'not_found'         => __( 'Para Birimi Bulunamadı', 'puzzle' ),
  );

  register_taxonomy('ulke_para_birimi',array('ulke'), array(
    'hierarchical' => false,
    'labels' => $labels,
    'show_ui' => true,
    'query_var' => true,
    'show_in_nav_menus' => true,
    'rewrite' => array('slug' => 'ulke_para_birimi', 'with_front' => false),
    'meta_box_cb'       => false,
  ));
}
function ulke_iklim_feature(){
  $labels = array(
    'name' => _x( 'İklim Özellikleri', 'puzzle' ),
    'singular_name' => _x( 'İklim Özelliği', 'puzzle' ),
    'edit_item'         => __( 'Düzenle', 'puzzle' ),
    'update_item'       => __( 'Güncelle', 'puzzle' ),
    'add_new_item'      => __( 'Yeni İklim Ekle', 'puzzle' ),
    'not_found'         => __( 'İklim Bulunamadı', 'puzzle' ),
  );

  register_taxonomy('ulke_iklim_feature',array('ulke'), array(
    'hierarchical' => false,
    'labels' => $labels,
    'show_ui' => true,
    'query_var' => true,
    'show_in_nav_menus' => true,
    'rewrite' => array('slug' => 'ulke_iklim_feature', 'with_front' => false),
    'meta_box_cb'       => false,
  ));
}
function ulke_dil_feature(){
  $labels = array(
    'name' => _x( 'Dil Özellikleri', 'puzzle' ),
    'singular_name' => _x( 'Dil Özelliği', 'puzzle' ),
    'edit_item'         => __( 'Düzenle', 'puzzle' ),
    'update_item'       => __( 'Güncelle', 'puzzle' ),
    'add_new_item'      => __( 'Yeni Dil Ekle', 'puzzle' ),
    'not_found'         => __( 'Dil Bulunamadı', 'puzzle' ),
  );

  register_taxonomy('ulke_dil_feature',array('ulke'), array(
    'hierarchical' => false,
    'labels' => $labels,
    'show_ui' => true,
    'query_var' => true,
    'show_in_nav_menus' => true,
    'rewrite' => array('slug' => 'ulke_dil_feature', 'with_front' => false),
    'meta_box_cb'       => false,
  ));
}
function ulke_details(){
    $prefix = 'ulke_detay';
    $cmb = new_cmb2_box( array(
        'id'            => $prefix.'metabox',
        'title'         => __( 'Ülke Bilgileri', 'puzzle' ),
        'object_types'  => array( 'ulke'), // Post type
        'context'       => 'normal',
        'priority'      => 'high',
        'show_names'    => true, // Show field names on the left
        // 'cmb_styles' => false, // false to disable the CMB stylesheet
        // 'closed'     => true, // Keep the metabox closed by default
    ) );

   
        $cmb->add_field(array(
        'name'             => 'Bulunduğu Kıta',
        'id'               => $prefix . 'kita_select',
        'type'             => 'select',
        'show_option_none' => true,
        'options'          => array(
        'Avrupa' => __( 'Avrupa', 'cmb2' ),
        'Asya'   => __( 'Asya', 'cmb2' ),
        'Kuzey Amerika'     => __( 'Kuzey Amerika', 'cmb2' ),
        'Güney Amerika'     => __( 'Güney Amerika', 'cmb2' ),
        'Avustralya'     => __( 'Avustralya', 'cmb2' ),
        'Afrika'     => __( 'Afrika', 'cmb2' ),
        'Antarktika'     => __( 'Antarktika', 'cmb2' ),
    )) );

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

      $cmb->add_field(array(
        'name' => 'Zoom',
        'id'   => $prefix . 'zoomkontrol',
        'desc'    => '0 - 18 Arası Bir Değer Giriniz.',
        'default' => '7',
        'type' => 'text',
        'attributes'  => array(
            'required'    => 'required',
   
        ),
    ) );
      $cmb->add_field(array(
        'name' => 'Konum Çap',
        'id'   => $prefix . 'konumcap',
        'desc'    => '0.8, 2, 3 gibi deneme yanılma bir değer giriniz.',
        'type' => 'text',
        'attributes'  => array(
            'required'    => 'required',
   
        ),
    ) );
}
function ulke_genel_bilgiler(){
    $prefix = 'ulke_genel_bilgiler_';
    $cmb = new_cmb2_box( array(
        'id'            => $prefix.'metabox',
        'title'         => __( 'Genel Bilgiler', 'puzzle' ),
        'object_types'  => array( 'ulke'), // Post type
        'context'       => 'normal',
        'priority'      => 'high',
        'show_names'    => true, // Show field names on the left
        // 'cmb_styles' => false, // false to disable the CMB stylesheet
        // 'closed'     => true, // Keep the metabox closed by default
    ) );
        $terms = get_terms( array(
        'taxonomy' => 'ulke_para_birimi',
        'hide_empty' => false,
    ) );

    $temp = array();

    foreach ($terms as $key => $value) {
        $temp[$value -> name] = $value -> name;
    }

    $cmb->add_field( array(
        'name'           => 'Para Birimi',
        'id'             => $prefix . 'select',
        'type'           => 'select',
        'show_option_none' => true,
        'options'        =>  $temp,
    ) );

       /**  $iklim_terms = get_terms( array(
        'taxonomy' => 'ulke_iklim_feature',
        'hide_empty' => false,
    ) );

    $iklim_temp = array();

    foreach ($iklim_terms as $iklim_key => $iklim_value) {
        $iklim_temp[$iklim_value -> name] = $iklim_value -> name;
    }

    $cmb->add_field( array(
        'name'           => 'İklimi',
        'id'             => $prefix . 'ulke_iklim_feature_',
        'type'           => 'select',
        'show_option_none' => true,
        'options'        =>  $iklim_temp,
    ) );**/
     $cmb->add_field( array(
    'name'    => 'Nüfusu',
    'id'      => $prefix .'nufusu',
    'type'    => 'text',
    ) );

        $dil_terms = get_terms( array(
        'taxonomy' => 'ulke_dil_feature',
        'hide_empty' => false,
    ) );

    $dil_temp = array();

    foreach ($dil_terms as $dil_key => $dil_value) {
        $dil_temp[$dil_value -> name] = $dil_value -> name;
    }

    $cmb->add_field( array(
        'name'           => 'Konuşulan Dil',
        'id'             => $prefix . 'ulke_dil_feature_',
        'type'           => 'select',
        'show_option_none' => true,
        'options'        =>  $dil_temp,
    ) );

    $cmb->add_field( array(
    'name' => 'Kullanılan Zaman Dilimi',
    'id'   => '_date_time',
    'type' => 'select_timezone',
) );
    $cmb->add_field( array(
    'name'    => 'Başkenti',
    'id'      => $prefix .'başkent',
    'type'    => 'text',
    ) );
}


?>