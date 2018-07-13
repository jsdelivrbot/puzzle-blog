<?php
/**
 * Register a custom post type called "yer".
 *
 * @see get_post_type_labels() for label keys.
 */

add_action( 'init', 'yer_init' );
add_action( 'init', 'yer_feature' );// Admin arayüzünde görmek için Kullanılır.
add_action( 'init', 'random_feature');// Admin arayüzünde görmek için Kullanılır.
add_action( 'cmb2_admin_init', 'yer_details' );
add_action( 'cmb2_admin_init', 'hotel_details' );
add_action( 'cmb2_admin_init', 'genel_bilgiler' );
//add_action( 'cmb2_admin_init', 'tour_details' ); // Admin arayüzünde görmemek için Kullanılır.
//get_page_template();

function yer_init() {
    $labels = array(
        'name'                  => _x( 'İçerikler', 'Post type general name', 'puzzle' ),
        'singular_name'         => _x( 'İçerikler', 'Post type singular name', 'puzzle' ),
        'menu_name'             => _x( 'İçerikler', 'Admin Menu text', 'puzzle' ),
        'name_admin_bar'        => _x( 'İçerikler', 'Add New on Toolbar', 'puzzle' ),
        'add_new'               => __( 'İçerik Ekle', 'puzzle' ),
        'add_new_item'          => __( 'Yeni İçerik Ekle', 'puzzle' ),
        'new_item'              => __( 'Yeni İçerik', 'puzzle' ),
        'edit_item'             => __( 'İçerik Düzenle', 'puzzle' ),
        'view_item'             => __( 'İçerik Görüntüle', 'puzzle' ),
        'all_items'             => __( 'Tüm İçerikler', 'puzzle' ),
        'search_items'          => __( 'İçerik Ara', 'puzzle' ),
        'parent_item_colon'     => __( 'Parent İçerik:', 'puzzle' ),
        'not_found'             => __( 'İçerik Bulunamadı.', 'puzzle' ),
        'not_found_in_trash'    => __( 'İçerik Bulunamadı.', 'puzzle' ),
        'featured_image'        => _x( 'Öne Çıkan Görsel', 'Overrides the “Featured Image” phrase for this post type. Added in 4.3', 'puzzle' ),
        'set_featured_image'    => _x( 'Öne Çıkan Görsel Ayarla', 'Overrides the “Set featured image” phrase for this post type. Added in 4.3', 'puzzle' ),
        'remove_featured_image' => _x( 'Öne Çıkan Görseli Kaldır', 'Overrides the “Remove featured image” phrase for this post type. Added in 4.3', 'puzzle' ),
        'use_featured_image'    => _x( 'Öne Çıkan Görsel Olarak Kullan', 'Overrides the “Use as featured image” phrase for this post type. Added in 4.3', 'puzzle' ),
        'archives'              => _x( 'İçerik Arşivi', 'The post type archive label used in nav menus. Default “Post Archives”. Added in 4.4', 'puzzle' ),
        'insert_into_item'      => _x( 'İçerik İçine Yerleştir', 'Overrides the “Insert into post”/”Insert into page” phrase (used when inserting media into a post). Added in 4.4', 'puzzle' ),
        'uploaded_to_this_item' => _x( 'Bu İçerik Yüklendi', 'Overrides the “Uploaded to this post”/”Uploaded to this page” phrase (used when viewing media attached to a post). Added in 4.4', 'puzzle' ),
        'filter_items_list'     => _x( 'Filtre Uygula', 'Screen reader text for the filter links heading on the post type listing screen. Default “Filter posts list”/”Filter pages list”. Added in 4.4', 'puzzle' ),
        'items_list_navigation' => _x( 'İçerik Navigasyon', 'Screen reader text for the pagination heading on the post type listing screen. Default “Posts list navigation”/”Pages list navigation”. Added in 4.4', 'puzzle' ),
        'items_list'            => _x( 'İçerik List', 'Screen reader text for the items list heading on the post type listing screen. Default “Posts list”/”Pages list”. Added in 4.4', 'puzzle' ),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'yer' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 5,
        'supports'           => array( 'title','thumbnail', 'editor', 'comments'),
        'taxonomies' => array('yer_feature'),
        'menu_icon'   => 'dashicons-welcome-write-blog',
    );

    register_post_type( 'yer', $args );
}
function yer_feature(){
  $labels = array(
    'name' => _x( 'Yer Özellikleri', 'puzzle' ),
    'singular_name' => _x( 'Yer Özellik', 'puzzle' ),
    'edit_item'         => __( 'Düzenle', 'puzzle' ),
    'update_item'       => __( 'Güncelle', 'puzzle' ),
    'add_new_item'      => __( 'Yeni Özellik Ekle', 'puzzle' ),
    'not_found'         => __( 'Özellik Bulunamadı', 'puzzle' ),
  );

  register_taxonomy('yer_feature',array('yer'), array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'query_var' => true,
    'show_in_nav_menus' => true,
    'rewrite' => array('slug' => 'yer_feature', 'with_front' => false),
  ));
}
function hotel_details(){
    $prefix = 'hotel_details_';
    $cmb = new_cmb2_box( array(
        'id'            => $prefix.'metabox',
        'title'         => __( 'Sadece Otel İçin Detaylar', 'puzzle' ),
        'object_types'  => array( 'yer'), // Post type
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
    $cmb->add_field( array(
        'name'           => 'Otel Kaç Yıldız',
        'id'             => $prefix . 'star',
        'type'           => 'select',
        'show_option_none' => true,
        'options'          => array(
            '1' => __( 'Tek Yıldız', 'cmb2' ),
            '2'   => __( '2 Yıldız', 'cmb2' ),
            '3'     => __( '3 Yıldız', 'cmb2' ),
            '4'     => __( '4 Yıldız', 'cmb2' ),
            '5'     => __( '5 Yıldız', 'cmb2' ),
            ),
    ) );
    
}

function random_feature(){
  $labelss = array(
    'name' => _x( 'Gösterim Alanları', 'puzzle' ),
    'singular_name' => _x( 'Gösterim Özelliği', 'puzzle' ),
    'edit_item'         => __( 'Düzenle', 'puzzle' ),
    'update_item'       => __( 'Güncelle', 'puzzle' ),
    'add_new_item'      => __( 'Yeni Alan Ekle', 'puzzle' ),
    'not_found'         => __( 'Gösterim Alanı Bulunamadı', 'puzzle' ),
  );

  register_taxonomy('random_feature',array('yer'), array(
    'hierarchical' => true,
    'labels' => $labelss,
    'show_ui' => true,
    'query_var' => true,
    'show_in_nav_menus' => true,
    'rewrite' => array('slug' => 'random_feature', 'with_front' => false),
    
  ));
}


function yer_details(){
    $prefix = 'icerik_detay_';
    $cmb = new_cmb2_box( array(
        'id'            => $prefix.'metabox',
        'title'         => __( 'İçerik Detayları', 'puzzle' ),
        'object_types'  => array( 'yer'), // Post type
        'context'       => 'normal',
        'priority'      => 'high',
        'show_names'    => true, // Show field names on the left
        // 'cmb_styles' => false, // false to disable the CMB stylesheet
        // 'closed'     => true, // Keep the metabox closed by default
    ) );
    $cmb->add_field( array(
    'name' => 'Resimler',
    'desc' => 'Lütfen resim yükleyin (760 x 539)...',
    'id'   => $prefix . 'images',
    'type' => 'file_list',
    // 'preview_size' => array( 100, 100 ), // Default: array( 50, 50 )
    'query_args' => array( 'type' => 'image' ), // Only images attachment
    // Optional, override default text strings
    'text' => array(
        'add_upload_files_text' => 'Resim Ekle', // default: "Add or Upload Files"
        'remove_image_text' => 'Resim Kaldır', // default: "Remove Image"
    ),
) );
  /* $cmb->add_field( array(
        'name'    => 'Büyük Resim',
        'desc'    => 'Lütfen resim yükleyin (760 x 539)...',
        'id'      => $prefix . 'image',
        'type'    => 'file',
        // Optional:
        'options' => array(
            'url' => true, // Hide the text input for the url
        ),
        'text'    => array(
            'add_upload_file_text' => 'Resim Ekle' // Change upload button text. Default: "Add or Upload File"
        )
    ) );*/

     $terms = get_posts( array(
        'post_type' => 'sehir',
        'posts_per_page' => -1,
        'order'          => 'ASC',
    ) );

    $temp = array();

    foreach ($terms as $key => $value) {
        $temp[$value -> ID] = $value -> post_title;
    }

    $cmb->add_field( array(
        'name'           => 'Bulunduğu Şehir',
        'id'             => $prefix . 'sehir-isim',
        'type'           => 'select',
        'show_option_none' => true,
        'options'        =>  $temp,
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
        'id'             => $prefix . '_ulke',
        'type'           => 'select',
        'show_option_none' => true,
        'options'        =>  $temp,
    ) );

     $terms = get_terms( array(
        'taxonomy' => 'yer_feature',
        'hide_empty' => false,
    ) );

    $temp = array();

    foreach ($terms as $key => $value) {
        $temp[$value -> name] = $value -> name;
    }

    $cmb->add_field( array(
        'name'           => 'İçerik Başlık Yer Özelliği',
        'id'             => $prefix . 'select',
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
        'default' => '12',
        'type' => 'text',
    ) );

     /* $cmb->add_field( array(
        'name'    => 'İçerik Yazısı',
        'id'      => $prefix .'bilgi',
        'type'    => 'wysiwyg',
        'options' => array(),
        'sanitization_cb' => 'allow_html',
    ) );*/



}



?>