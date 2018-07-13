<?php
/**
 * Register a custom post type called "sehir".
 *
 * @see get_post_type_labels() for label keys.
 */

add_action( 'init', 'sehir_init' );// Admin arayüzünde görmek için Kullanılır.
add_action( 'init', 'para_birimi' );// Admin arayüzünde görmek için Kullanılır.
add_action( 'init', 'iklim_feature');// Admin arayüzünde görmek için Kullanılır.
add_action( 'init', 'dil_feature');// Admin arayüzünde görmek için Kullanılır.
add_action( 'cmb2_admin_init', 'sehir_details' ); // Admin arayüzünde görmemek için Kullanılır.
add_action( 'cmb2_admin_init', 'sehir_yillik_hava' ); // Admin arayüzünde görmemek için Kullanılır.
add_action( 'cmb2_admin_init', 'genel_bilgiler' ); // Admin arayüzünde görmemek için Kullanılır.
add_action( 'cmb2_admin_init', 'sehir_havalimani' ); // Admin arayüzünde görmemek için Kullanılır.
//get_page_template();
require get_template_directory() . '/extra/sehir-kodlar.php';
function sehir_init() {
    $labels = array(
        'name'                  => _x( 'Şehirler', 'Post type general name', 'puzzle' ),
        'singular_name'         => _x( 'Şehirler', 'Post type singular name', 'puzzle' ),
        'menu_name'             => _x( 'Şehirler', 'Admin Menu text', 'puzzle' ),
        'name_admin_bar'        => _x( 'Şehirler', 'Add New on Toolbar', 'puzzle' ),
        'add_new'               => __( 'Şehir Ekle', 'puzzle' ),
        'add_new_item'          => __( 'Yeni Şehir Ekle', 'puzzle' ),
        'new_item'              => __( 'Yeni Şehir', 'puzzle' ),
        'edit_item'             => __( 'Şehir Düzenle', 'puzzle' ),
        'view_item'             => __( 'Şehir Görüntüle', 'puzzle' ),
        'all_items'             => __( 'Tüm Şehirler', 'puzzle' ),
        'search_items'          => __( 'Şehir Ara', 'puzzle' ),
        'parent_item_colon'     => __( 'Parent Şehir:', 'puzzle' ),
        'not_found'             => __( 'Şehir Bulunamadı.', 'puzzle' ),
        'not_found_in_trash'    => __( 'Şehir Bulunamadı.', 'puzzle' ),
        'featured_image'        => _x( 'Öne Çıkan Görsel', 'Overrides the “Featured Image” phrase for this post type. Added in 4.3', 'puzzle' ),
        'set_featured_image'    => _x( 'Öne Çıkan Görsel Ayarla', 'Overrides the “Set featured image” phrase for this post type. Added in 4.3', 'puzzle' ),
        'remove_featured_image' => _x( 'Öne Çıkan Görseli Kaldır', 'Overrides the “Remove featured image” phrase for this post type. Added in 4.3', 'puzzle' ),
        'use_featured_image'    => _x( 'Öne Çıkan Görsel Olarak Kullan', 'Overrides the “Use as featured image” phrase for this post type. Added in 4.3', 'puzzle' ),
        'archives'              => _x( 'Şehir Arşivi', 'The post type archive label used in nav menus. Default “Post Archives”. Added in 4.4', 'puzzle' ),
        'insert_into_item'      => _x( 'Şehir İçine sehirleştir', 'Overrides the “Insert into post”/”Insert into page” phrase (used when inserting media into a post). Added in 4.4', 'puzzle' ),
        'uploaded_to_this_item' => _x( 'Bu Şehir Yüklendi', 'Overrides the “Uploaded to this post”/”Uploaded to this page” phrase (used when viewing media attached to a post). Added in 4.4', 'puzzle' ),
        'filter_items_list'     => _x( 'Filtre Uygula', 'Screen reader text for the filter links heading on the post type listing screen. Default “Filter posts list”/”Filter pages list”. Added in 4.4', 'puzzle' ),
        'items_list_navigation' => _x( 'Şehir Navigasyon', 'Screen reader text for the pagination heading on the post type listing screen. Default “Posts list navigation”/”Pages list navigation”. Added in 4.4', 'puzzle' ),
        'items_list'            => _x( 'Şehir List', 'Screen reader text for the items list heading on the post type listing screen. Default “Posts list”/”Pages list”. Added in 4.4', 'puzzle' ),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'sehir' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 4,
        'supports'           => array( 'title','thumbnail', 'editor', 'comments'),
        'taxonomies' => array('sehir_feature'),
        'menu_icon'   => 'dashicons-admin-multisite',
    );

    register_post_type( 'sehir', $args );
}

function para_birimi(){
  $labels = array(
    'name' => _x( 'Para Birimleri', 'puzzle' ),
    'singular_name' => _x( 'Para Özelliği', 'puzzle' ),
    'edit_item'         => __( 'Düzenle', 'puzzle' ),
    'update_item'       => __( 'Güncelle', 'puzzle' ),
    'add_new_item'      => __( 'Yeni Para Birimi Ekle', 'puzzle' ),
    'not_found'         => __( 'Para Birimi Bulunamadı', 'puzzle' ),
  );

  register_taxonomy('para_birimi',array('sehir'), array(
    'hierarchical' => false,
    'labels' => $labels,
    'show_ui' => true,
    'query_var' => true,
    'show_in_nav_menus' => true,
    'rewrite' => array('slug' => 'para_birimi', 'with_front' => false),
    'meta_box_cb'       => false,
  ));
}

function iklim_feature(){
  $labels = array(
    'name' => _x( 'İklim Özellikleri', 'puzzle' ),
    'singular_name' => _x( 'İklim Özelliği', 'puzzle' ),
    'edit_item'         => __( 'Düzenle', 'puzzle' ),
    'update_item'       => __( 'Güncelle', 'puzzle' ),
    'add_new_item'      => __( 'Yeni İklim Ekle', 'puzzle' ),
    'not_found'         => __( 'İklim Bulunamadı', 'puzzle' ),
  );

  register_taxonomy('iklim_feature',array('sehir'), array(
    'hierarchical' => false,
    'labels' => $labels,
    'show_ui' => true,
    'query_var' => true,
    'show_in_nav_menus' => true,
    'rewrite' => array('slug' => 'iklim_feature', 'with_front' => false),
    'meta_box_cb'       => false,
  ));
}
function dil_feature(){
  $labels = array(
    'name' => _x( 'Dil Özellikleri', 'puzzle' ),
    'singular_name' => _x( 'Dil Özelliği', 'puzzle' ),
    'edit_item'         => __( 'Düzenle', 'puzzle' ),
    'update_item'       => __( 'Güncelle', 'puzzle' ),
    'add_new_item'      => __( 'Yeni Dil Ekle', 'puzzle' ),
    'not_found'         => __( 'Dil Bulunamadı', 'puzzle' ),
  );

  register_taxonomy('dil_feature',array('sehir'), array(
    'hierarchical' => false,
    'labels' => $labels,
    'show_ui' => true,
    'query_var' => true,
    'show_in_nav_menus' => true,
    'rewrite' => array('slug' => 'dil_feature', 'with_front' => false),
    'meta_box_cb'       => false,
  ));
}

function sehir_details(){
    $prefix = 'sehir_detay';
    $cmb = new_cmb2_box( array(
        'id'            => $prefix.'metabox',
        'title'         => __( 'Şehir Bilgileri', 'puzzle' ),
        'object_types'  => array( 'sehir'), // Post type
        'context'       => 'normal',
        'priority'      => 'high',
        'show_names'    => true, // Show field names on the left
        // 'cmb_styles' => false, // false to disable the CMB stylesheet
        // 'closed'     => true, // Keep the metabox closed by default
    ) );

    $cmb->add_field( array(
        'name'    => 'Büyük Resim',
        'desc'    => 'Lütfen resim yükleyin (760 x 539)...',
        'id'      => $prefix . 'sehir_image',
        'type'    => 'file',
        // Optional:
        'options' => array(
            'url' => true, // Hide the text input for the url
        ),
        'text'    => array(
            'add_upload_file_text' => 'Resim Ekle' // Change upload button text. Default: "Add or Upload File"
        )
    ) );

    $terms = get_posts( array(
        'post_type' => 'ulke',
        'posts_per_page' => -1,
        'order'          => 'ASC',
    ) );

    $temp = array();

    foreach ($terms as $key => $value) {
        $temp[$value -> ID] = $value -> post_title;
    }

    $cmb->add_field( array(
        'name'           => 'Ülke',
        'id'             => $prefix . 'ulke_',
        'type'           => 'select',
        'show_option_none' => true,
        'options'        =>  $temp,
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

      $cmb->add_field(array(
        'name' => 'Zoom',
        'id'   => $prefix . 'zoomkontrol',
        'desc'    => '0 - 18 Arası Bir Değer Giriniz.',
        'default' => '10',
        'type' => 'text',
        'attributes'  => array(
            'required'    => 'required',
   
        ),
    ) );

}

function genel_bilgiler(){
    $prefix = 'genel_bilgiler_';
    $cmb = new_cmb2_box( array(
        'id'            => $prefix.'metabox',
        'title'         => __( 'Genel Bilgiler', 'puzzle' ),
        'object_types'  => array( 'sehir'), // Post type
        'context'       => 'normal',
        'priority'      => 'high',
        'show_names'    => true, // Show field names on the left
        // 'cmb_styles' => false, // false to disable the CMB stylesheet
        // 'closed'     => true, // Keep the metabox closed by default
    ) );
        $terms = get_terms( array(
        'taxonomy' => 'para_birimi',
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

         $iklim_terms = get_terms( array(
        'taxonomy' => 'iklim_feature',
        'hide_empty' => false,
    ) );

    $iklim_temp = array();

    foreach ($iklim_terms as $iklim_key => $iklim_value) {
        $iklim_temp[$iklim_value -> name] = $iklim_value -> name;
    }

    $cmb->add_field( array(
        'name'           => 'İklimi',
        'id'             => $prefix . 'iklim_feature_',
        'type'           => 'select',
        'show_option_none' => true,
        'options'        =>  $iklim_temp,
    ) );
     $cmb->add_field( array(
    'name'    => 'Nüfusu',
    'id'      => $prefix .'nufusu',
    'type'    => 'text',
    ) );

        $dil_terms = get_terms( array(
        'taxonomy' => 'dil_feature',
        'hide_empty' => false,
    ) );

    $dil_temp = array();

    foreach ($dil_terms as $dil_key => $dil_value) {
        $dil_temp[$dil_value -> name] = $dil_value -> name;
    }

    $cmb->add_field( array(
        'name'           => 'Konuşulan Dil',
        'id'             => $prefix . 'dil_feature_',
        'type'           => 'select',
        'show_option_none' => true,
        'options'        =>  $dil_temp,
    ) );

    
}
function sehir_havalimani(){
    $prefix = 'sehir_havalimani_';
    $cmb = new_cmb2_box( array(
        'id'            => $prefix.'metabox',
        'title'         => __( 'Havalimanı Bilgisi', 'puzzle' ),
        'object_types'  => array( 'sehir'), // Post type
        'context'       => 'normal',
        'priority'      => 'high',
        'show_names'    => true, // Show field names on the left
        // 'cmb_styles' => false, // false to disable the CMB stylesheet
        // 'closed'     => true, // Keep the metabox closed by default
    ) );

    $group = $cmb->add_field( array(
        'id'          => $prefix . 'repeat_group',
        'type'        => 'group',
        'description' => __( 'Şehire Ait Havalimanları', 'puzzle' ),
        'repeatable'  => true,
        'options'     => array(
            'group_title'   => __( 'Havalimanı {#}', 'puzzle' ), // since version 1.1.4, {#} gets replaced by row number
            'add_button'    => __( 'Havalimanı Ekle', 'puzzle' ),
            'remove_button' => __( 'Havalimanı Sil', 'puzzle' ),
            'sortable'      => true, // beta
            // 'closed'     => true, // true to have the groups closed by default
        ),
    ) );

    $cmb->add_group_field( $group, array(
        'name' => 'Havalimanı Adı',
        'id'   => $prefix . 'title',
        'type' => 'text',
        'default' => '',
        // 'repeatable' => true, // Repeatable fields are supported w/in repeatable groups (for most types)
    ) );

   
    $cmb->add_group_field( $group,array(
        'name' => 'Enlem',
        'id'   => $prefix . 'enlem',
        'default' => '',
        'type' => 'text',
        'attributes'  => array(
            'placeholder' => '35.330273',
        ),
    ) );
      $cmb->add_group_field( $group,array(
        'name' => 'Boylam',
        'id'   => $prefix . 'boylam',
        'default' => '',
        'type' => 'text',
        'attributes'  => array(
            'placeholder' => '35.330273',
        ),
    ) );

}
function sehir_yillik_hava(){
    $prefix = 'sehir_hava_durumu';
    $cmb = new_cmb2_box( array(
        'id'            => $prefix.'metabox',
        'title'         => __( 'Hava Durumu', 'puzzle' ),
        'object_types'  => array( 'sehir'), // Post type
        'context'       => 'normal',
        'priority'      => 'high',
        'show_names'    => true, // Show field names on the left
        // 'cmb_styles' => false, // false to disable the CMB stylesheet
        // 'closed'     => true, // Keep the metabox closed by default
    ) );
    global $sehir_kodlari;
    $cmb->add_field( array(
        'name'           => 'Şehir Kodu',
        'id'             => $prefix . '_sehir_kod',
        'type'           => 'select',
        'show_option_none' => true,
        'options'        =>  $sehir_kodlari,
    ) );

    $cmb->add_field( array(
    'name' => 'Yıllık Hava Durumu Ortalaması',
    'type' => 'title',
    'id'   => 'wiki_test_title'
) );

   $cmb->add_field(array(
        'name'    => 'Ocak Sıcaklık',
        'id'      => $prefix . 'ocak',
        'type'    => 'text_small',
        'default' => '12',
        'desc' => '°C',
    ) );

   $cmb->add_field(array(
        'name'    => 'Şubat Sıcaklık',
        'default' => '12',
        'id'      => $prefix . 'subat',
        'type'    => 'text_small',
        'desc' => '°C',
    ) );
   $cmb->add_field(array(
        'name'    => 'Mart Sıcaklık',
        'id'      => $prefix . 'mart',
        'type'    => 'text_small',
        'default' => '14',
        'desc' => '°C',
    ) );
   $cmb->add_field(array(
        'name'    => 'Nisan Sıcaklık',
        'id'      => $prefix . 'nisan',
        'type'    => 'text_small',
        'default' => '16',
        'desc' => '°C',
    ) );
   $cmb->add_field(array(
        'name'    => 'Mayıs Sıcaklık',
        'id'      => $prefix . 'mayis',
        'type'    => 'text_small',
        'default' => '20',
        'desc' => '°C',
    ) );
   $cmb->add_field(array(
        'name'    => 'Haziran Sıcaklık',
        'id'      => $prefix . 'haziran',
        'type'    => 'text_small',
        'default' => '24',
        'desc' => '°C',
    ) );
   $cmb->add_field(array(
        'name'    => 'Temmuz Sıcaklık',
        'id'      => $prefix . 'temmuz',
        'type'    => 'text_small',
        'default' => '27',
        'desc' => '°C',
    ) );
   $cmb->add_field(array(
        'name'    => 'Ağustos Sıcaklık',
        'default' => '28',
        'id'      => $prefix . 'agustos',
        'type'    => 'text_small',
        'desc' => '°C',
    ) );
   $cmb->add_field(array(
        'name'    => 'Eylül Sıcaklık',
        'default' => '25',
        'id'      => $prefix . 'eylul',
        'type'    => 'text_small',
        'desc' => '°C',
    ) );
   $cmb->add_field(array(
        'name'    => 'Ekim Sıcaklık',
        'default' => '22',
        'id'      => $prefix . 'ekim',
        'type'    => 'text_small',
        'desc' => '°C',
    ) );
   $cmb->add_field(array(
        'name'    => 'Kasım Sıcaklık',
        'default' => '17',
        'id'      => $prefix . 'kasim',
        'type'    => 'text_small',
        'desc' => '°C',
    ) );
   $cmb->add_field(array(
        'name'    => 'Aralık Sıcaklık',
        'default' => '13',
        'id'      => $prefix . 'aralik',
        'type'    => 'text_small',
        'desc' => '°C',
    ) );
}
?>