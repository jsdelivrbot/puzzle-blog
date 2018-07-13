<?php
/**
 * Puzzle Blog functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Puzzle_Blog
 */

if ( ! function_exists( 'puzzle_blog_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function puzzle_blog_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Puzzle Blog, use a find and replace
		 * to change 'puzzle-blog' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'puzzle-blog', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
        // Bu tema bir yerde wp_nav_menu() kullanıyor.
        register_nav_menus(array(
            'primary' => 'Ana Menü',
            'mobile' => 'Mobil Menü',
            'secondary' => 'footerMenu1',
            'third' => 'footerMenu3',
        ));

        

        /*
         * Switch default core markup for search form, comment form, and comments to output valid HTML5.
         * Geçerli HTML5'i çıktılamak için arama formu, açıklama formu ve yorumları için varsayılan temel işaretlemeyi değiştirin.
         */
        add_theme_support('html5', array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
        ));

        // Set up the WordPress core custom background feature.
        // WordPress çekirdeğinin özel arka plan özelliğini ayarlayın.
        add_theme_support('custom-background', apply_filters('puzzle_custom_background_args', array(
            'default-color' => 'ffffff',
            'default-image' => '',
        )));

        // Add theme support for selective refresh for widgets.
        // Widgetler için seçici yenileme için tema desteği ekleyin.
        add_theme_support('customize-selective-refresh-widgets');

        // remove title
        // başlığı kaldır
        remove_action('wp_head', '_wp_render_title_tag', 1);
	}
endif;
add_action( 'after_setup_theme', 'puzzle_blog_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function puzzle_blog_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'puzzle_blog_content_width', 640 );
}
add_action( 'after_setup_theme', 'puzzle_blog_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */

/* printarr **** Kod görüntüleme */
//printarr($content);

function printarr($array) {
    echo '<textarea style="width:500px;height:500px;position:relative;z-index:9999999;">' . print_r($array, true) . '</textarea>';
}


  /* register new sidebar - 
        yeni kenar çubuğunu kaydet*/
function puzzle_blog_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Yer Sidebar', 'puzzle-blog' ),
		'id'            => 'sidebar_1',
		'description'   => esc_html__( 'Bileşenleri buraya ekleyin.', 'puzzle-blog' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
         register_sidebar( array(
        'name'          => esc_html__( 'Şehir Sidebar', 'puzzle-blog' ),
        'id'            => 'sidebar_2',
        'description'   => esc_html__( 'Bileşenleri buraya ekleyin.', 'puzzle-blog' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );

        register_sidebar( array(
        'name'          => esc_html__( 'Ülke Sidebar', 'puzzle-blog' ),
        'id'            => 'sidebar_3',
        'description'   => esc_html__( 'Bileşenleri buraya ekleyin.', 'puzzle-blog' ),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ) );
}
add_action( 'widgets_init', 'puzzle_blog_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function puzzle_scripts() {
    wp_register_style( 'weather-icons-css', get_template_directory_uri() .'/css/weather/css/weather-icons.min.css', false, NULL, 'all');
    wp_register_style( 'style-css', get_template_directory_uri() .'/css/style.css', false, NULL, 'all');
    wp_register_style( 'style-css2', get_template_directory_uri() .'/style.css', false, NULL, 'all');
    wp_register_style( 'bootstrap-css', get_template_directory_uri() .'/css/bootstrap.css', false, NULL, 'all');
    wp_register_style( 'bootstrap3-css', get_template_directory_uri() .'/css/bootstrap-3.3.7.min.css', false, NULL, 'all');
   // wp_register_style( 'icon-css', 'https://cdn.rawgit.com/askingokyildiz/askingokyildiz.github.io/8c347c31/assets/fonts.css', false, NULL, 'all' );
    wp_register_style( 'icon-css', get_template_directory_uri() .'/icon/puzzle-icon/assets/fonts.css', false, NULL, 'all' );
    wp_register_style( 'icon-css2', get_template_directory_uri() .'/icon/fontello//css/askingokyildiz.css', false, NULL, 'all' );
    wp_register_style( 'font-awesome',  get_template_directory_uri() .'/css/font-awesome-4.7.0/css/font-awesome.css', NULL, true );
    wp_register_style( 'flexslider-css',  get_template_directory_uri() .'/css/flexSlider/flexslider.css', NULL, true );
    wp_register_script('jquery-js', 'https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js', NULL, true);
    wp_register_script('jquery2-js', 'http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js', NULL, true);
    wp_register_script( 'bootstrap-js', get_template_directory_uri() .'/js/bootstrap-3.3.7.min.js', NULL, true );
    wp_register_script( 'tether-js', get_template_directory_uri() .'/js/tether.min.js', NULL, true );
    wp_register_script( 'flexslider-js', get_template_directory_uri() .'/css/flexSlider/js/jquery.flexslider.js', NULL, true );
    wp_register_script('loader-js', 'https://www.gstatic.com/charts/loader.js', NULL, true);
    wp_enqueue_script('puzzle-maps', 'https://maps.googleapis.com/maps/api/js?key=AIzaSyBfMNQ8HOhn6g7OMwI49j1Sl82vPOgP9lQ&region=TR', array(), '20170519', true);
    wp_register_script( 'script-js', get_template_directory_uri() .'/js/script.js', NULL, true );
    
    
    wp_enqueue_style( 'weather-icons-css' );
    wp_enqueue_style( 'style-css' );
    wp_enqueue_style( 'style-css2' );
    wp_enqueue_style( 'bootstrap-css' );
    wp_enqueue_style( 'bootstrap3-css' );
    wp_enqueue_style( 'icon-css' );
    wp_enqueue_style( 'icon-css2' );
    wp_enqueue_style( 'font-awesome' );
    wp_enqueue_style( 'flexslider-css' );
    wp_enqueue_script( 'jquery-js' );
    wp_enqueue_script( 'jquery2-js' );
    wp_enqueue_script( 'bootstrap-js');
    wp_enqueue_script( 'tether-js' );
    wp_enqueue_script( 'tether-js' );
    wp_enqueue_script( 'loader-js');
    wp_enqueue_script( 'puzzle-maps');
    wp_enqueue_script( 'script-js');
    
}
add_action( 'wp_enqueue_scripts', 'puzzle_scripts' );

/* Implement the Custom Header feature. Özel Üstbilgi özelliğini uygulama */
/* Custom MetaBoxes */
require_once get_template_directory() . '/metabox/init.php';
require get_template_directory() . '/extra/icerik-register.php';
require get_template_directory() . '/extra/ulke-register.php';
require get_template_directory() . '/extra/sehir-register.php';
//require get_template_directory() . '/extra/hotel-register.php';


//css ve js dosyalarını fonksiyona gömme.
/**function my_scripts_enqueue() {
    wp_register_script( 'jquery', (get_template_directory_uri()."/js/jquery.js"), array('jquery'), '3.2.1', true ); // ilk alan script adınız, ikinci alan temanızdaki yolu, üçüncü alan jqueryden sonra çağrılması komutu, son alan da versiyon bilgisi. son alan olduğu gibi kalabilir.
    wp_register_script( 'bootstrap-js', (get_template_directory_uri()."/js/bootstrap.js"), array('bootstrap_js'), '4' ); 
    
    wp_register_style( 'stil-dosyam', (get_template_directory_uri()."/css/style.css"), false, '1.0.0', 'all'); // ilk alan css adınız, ikinci alan temanızdaki yolu, üçüncü alan neyden sonra yer alacağı (false kalsın), dördüncü alan versiyon (olduğu gibi kalabilir), beşinci alan türü. all kalabilir.
    wp_register_style( 'bootstrap-css', (get_template_directory_uri()."/css/bootstrap.css"), false, '4', 'all');  
    wp_enqueue_style('puzzleicon', 'https://cdn.rawgit.com/askingokyildiz/askingokyildiz.github.io/8c347c31/assets/fonts.css', '', '4.5.0', 'all');
 
    wp_enqueue_script('jquery'); // yukarıda kaydettiğimiz javascript dosyamızın ismi
    wp_enqueue_script('bootstrap-js'); 
    wp_enqueue_style( 'stil-dosyam' ); // yukarıda kaydettiğimiz stil dosyamızın ismi "stil_dosyam"
    wp_enqueue_style( 'bootstrap-css' ); 
    wp_enqueue_style( 'puzzleicon' ); 
}
add_action( 'wp_enqueue_scripts', 'my_scripts_enqueue' );
//css ve js dosyalarını fonksiyona gömme Bitti.*/



//WordPress Eklentisiz Okunma Sayısını Gösterme
function getPostViews($postID){
$count_key = 'post_views_count';
$count = get_post_meta($postID, $count_key, true);
if($count==''){
delete_post_meta($postID, $count_key);
add_post_meta($postID, $count_key, '0');
return "0 Kişi"; // 0 Okunmada gözükecek yazı.
}
return $count.' Kişi'; // x Okunmada gözükecek yazı
}
function setPostViews($postID) {
$count_key = 'post_views_count';
$count = get_post_meta($postID, $count_key, true);
if($count==''){
$count = 0;
delete_post_meta($postID, $count_key);
add_post_meta($postID, $count_key, '0');
}else{
$count++;
update_post_meta($postID, $count_key, $count);
}
}

//kategori Listeleme Başla

add_action('wp_ajax_load_posts_by_ajax', 'load_posts_by_ajax_callback');
add_action('wp_ajax_nopriv_load_posts_by_ajax', 'load_posts_by_ajax_callback');

function load_posts_by_ajax_callback() {
    check_ajax_referer('load_more_posts', 'security');
    $paged = $_POST['page']; 
    //printarr($content);
    if (isset($_GET["cat"]) && isset($_GET["city"])){
    $yerozellik=$_GET["cat"];
     $city=$_GET["city"];
    $args = array(
        'posts_per_page'   => $default_posts_per_page,
        'orderby'          => 'title',
        'order'            => 'ASC',
        'meta_key'         => 'icerik_detay_sehir-isim',
        'meta_value'       => $city,
        'post_type'        => 'yer',
        'paged' => $paged,
        'post_status'      => 'publish',
        'suppress_filters' => true,
        'tax_query' => array(
            array(
                'taxonomy' => 'yer_feature',
                'field' => $yerozellik,
                'terms' => $yerozellik,
            ))
    );
    $iceriksehir = get_post_meta($city, '', true);
    $ulke=$iceriksehir['sehir_detayulke_'][0];

    }
    elseif (isset($_GET["cat"]) && isset($_GET["country"])){
    $yerozellik=$_GET["cat"];
     $ulke=$_GET["country"];
        if ($ulke!=0) {
           
            $args = array(
                'posts_per_page'   =>  $default_posts_per_page,
                'orderby'          => 'title',
                'order'            => 'ASC',
                'meta_key'         => 'icerik_detay__ulke',
                'meta_value'       => $ulke,
                'post_type'        => 'yer',
                'paged' => $paged,
                'post_status'      => 'publish',
                'suppress_filters' => true,
                'tax_query' => array(
                    array(
                        'taxonomy' => 'yer_feature',
                        'field' => $yerozellik,
                        'terms' => $yerozellik,
                    ))
            );
            }
            if ($ulke==0) {
                $args = array(
                'posts_per_page'   => $default_posts_per_page,
                'orderby'          => 'title',
                'order'            => 'ASC',
                'post_type'        => 'yer',
                'paged' =>  $paged,
                'author_name'      => '',
                'post_status'      => 'publish',
                'suppress_filters' => true,
                'tax_query' => array(
                    array(
                        'taxonomy' => 'yer_feature',
                        'field' => $yerozellik,
                        'terms' => $yerozellik,
                    ))
            );
            $ulke='81';
            }
    }else{
    $ulke='81';
    $yerozellik='7';

    $args = array(
        'posts_per_page'   => $default_posts_per_page,
        'orderby'          => 'title',
        'order'            => 'ASC',
        'meta_key'         => 'icerik_detay__ulke',
        'meta_value'       => $ulke,
        'post_type'        => 'yer',
        'paged' => $paged,
        'post_status'      => 'publish',
        'suppress_filters' => true,
        'tax_query' => array(
            array(
                'taxonomy' => 'yer_feature',
                'field' => $yerozellik,
                'terms' => $yerozellik,
            ))
    );

    }

    /**$args = array(
        'post_type' => 'post',
        'post_status' => 'publish',
        'posts_per_page' => '2',
        'paged' => $paged,
    );**/
    $my_posts = new WP_Query( $args );
    
    if ( $my_posts->have_posts() ) :
        ?>
        <?php while ( $my_posts->have_posts() ) : $my_posts->the_post() ?>
            <div class="col-sm-4 p-0  mb-4 blog-border yazi-decoration cursor brightness-kapsayici askintest">
                <a href="<?=get_permalink(get_the_ID(), false );?>" class="yazi-decoration ">
                    <div class="col-sm-12 pl-0 pr-0 brightness-cards" style="width: 100%; height: 153px;">
                        <img src='<?=wp_get_attachment_image_url(get_post_thumbnail_id(get_the_ID()),array(245, 165, true));?>' style="width: 100%; height: 100%;">
                    </div>
                    <div class="col-sm-12 pt-2">
                        <h4><strong class="yazi-decoration brightness-title news-title3"><?php the_title() ?></strong></h4>
                        <p class="font-14 yazi-decoration" style="color:#808080;">
                            <?php $icer=get_the_excerpt();?> 
                            <?=mb_substr($icer,0,160,'UTF-8'); ?>...</p>
                    </div>
                </a>
            </div>
        <?php endwhile ?>
        <?php
    endif;

    wp_die();
}
//kategori Listeleme Bitir

require get_template_directory() . '/options/hotel-content-api.php';

//map Mesafe Hesaplama
function getDistanceBetweenPointsNew($latitude1, $longitude1, $latitude2, $longitude2) {
    $theta = $longitude1 - $longitude2;
    $miles = (sin(deg2rad($latitude1)) * sin(deg2rad($latitude2))) + (cos(deg2rad($latitude1)) * cos(deg2rad($latitude2)) * cos(deg2rad($theta)));
    $miles = acos($miles);
    $miles = rad2deg($miles);
    $miles = $miles * 60 * 1.1515;
    $seamiles = $miles * 0.868976242;
    $feet = $miles * 5280;
    $yards = $feet / 3;
    $kilometers = $miles * 1.609344;
    $meters = $kilometers * 1000;
    return compact('miles','feet','yards','kilometers','meters','seamiles'); 
}
?>