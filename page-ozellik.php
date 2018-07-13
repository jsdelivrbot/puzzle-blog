<?php
/**
 * Template Name: Yer Özelliği
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Puzzle_Blog
 */

get_header(); ?>
<?php  
$default_posts_per_page = get_option( 'posts_per_page' );
//?cat=7&city=91
if (isset($_GET["cat"]) && isset($_GET["city"])){
$yerozellik=$_GET["cat"];
 $city=$_GET["city"];
$args = array(
    'posts_per_page'   => -1,
    'offset'           => 0,
    'child_of'     => 0,
    'category'         => '',
    'category_name'    => '',
    'orderby'          => 'title',
    'order'            => 'ASC',
    'include'          => '',
    'exclude'          => '',
    'meta_key'         => 'icerik_detay_sehir-isim',
    'meta_value'       => $city,
    'post_type'        => 'yer',
    'post_mime_type'   => '',
    'post_parent'      => '',
    'author'           => '',
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
$yer = get_posts( $args );
$iceriksehir = get_post_meta($city, '', true);
$ulke=$iceriksehir['sehir_detayulke_'][0];
$count=count($yer);
}
elseif (isset($_GET["cat"]) && isset($_GET["country"])){

$yerozellik=$_GET["cat"];
 $ulke=$_GET["country"];
     if ($ulke!=0) {
           
    $args = array(
        'posts_per_page'   => -1,
        'orderby'          => 'title',
        'order'            => 'ASC',
        'include'          => '',
        'exclude'          => '',
        'meta_key'         => 'icerik_detay__ulke',
        'meta_value'       => $ulke,
        'post_type'        => 'yer',
        'post_mime_type'   => '',
        'post_parent'      => '',
        'author'           => '',
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
    $yer = get_posts( $args );
    $count=count($yer);
    }
    if ($ulke==0){
        $args = array(
        'posts_per_page'   => -1,
        'orderby'          => 'title',
        'order'            => 'ASC',
        'post_type'        => 'yer',
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
    $yer = get_posts( $args );
    $ulke='81';
    $count=count($yer);
    }
}else{
$ulke='81';
$yerozellik='7';

$args = array(
    'posts_per_page'   => -1,
    'offset'           => 0,
    'child_of'     => 0,
    'category'         => '',
    'category_name'    => '',
    'orderby'          => 'title',
    'order'            => 'ASC',
    'include'          => '',
    'exclude'          => '',
    'meta_key'         => 'icerik_detay__ulke',
    'meta_value'       => $ulke,
    'post_type'        => 'yer',
    'post_mime_type'   => '',
    'post_parent'      => '',
    'author'           => '',
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
$yer = get_posts( $args );
$count=count($yer);

}

$term = get_term( $yerozellik );

   $popsehir = get_posts( array(
        'post_type' => 'sehir',
        'posts_per_page' => -1,
        'orderby'          => 'title',
        'order'          => 'ASC',
        'meta_query' => array(
        array(
            'key'         => 'sehir_detayulke_', 
            'value'       => $ulke,
            'compare' => '='
        ),

        array(
            'key'         => '_is_ns_featured_post', 
            'value'       => 'yes',
            'compare' => '='
        )
    ),
        
    ) );
   $sorgu=$count/$default_posts_per_page;
$id=$ulke;
$ulkeicerk = get_post_meta($id);
//printarr($ulkeicerk);  

$enlem  = $ulkeicerk['ulke_detayenlem'][0]; 
$boylam = $ulkeicerk['ulke_detayboylam'][0];
$map=$enlem.",".$boylam;
$cap=$ulkeicerk['ulke_detaykonumcap'][0];
$enlem1=$enlem+$cap;
$enlem2=$enlem-$cap;
$boylam1=$boylam+$cap;
$boylam2=$boylam-$cap;


    $args = array(
    'posts_per_page'   => -1,
    'offset'           => 0,
    'child_of'     => 0,
    'category'         => '',
    'category_name'    => '',
    'orderby'          => 'date',
    'order'            => 'ASC',
    'include'          => '',
    'exclude'          => '',
    'meta_query' => array(
        array(
            'key'         => 'icerik_detay_enlem', 
            'value'       => $enlem,
            'compare' => '!='
        ),
        array(
            'key'         => 'icerik_detay_enlem', 
            'value'       => $enlem1,
            'compare' => '<'
        ),
         array(
            'key'         => 'icerik_detay_enlem', 
            'value'       => $enlem2,
            'compare' => '>'
        ),
          array(
            'key'         => 'icerik_detay_boylam', 
            'value'       => $boylam,
            'compare' => '!='
        ),
           array(
            'key'         => 'icerik_detay_boylam', 
            'value'       => $boylam1,
            'compare' => '<'
        ),
            array(
            'key'         => 'icerik_detay_boylam', 
            'value'       => $boylam2,
            'compare' => '>'
        )
    ),
    'post_type'        => 'yer',
    'post_mime_type'   => '',
    'post_parent'      => '',
    'author'           => '',
    'author_name'      => '',
    'post_status'      => 'publish',
    'suppress_filters' => true,
    'tax_query' => array(
        array(
            'taxonomy' => 'yer_feature',
            'field' => '26',
            'terms' => '26',
        ) 
    )
);
$otelmaps = get_posts( $args );



?>

<div class="container mt-3">
    <div class="row">
        <div class="col-sm-8 ">
            <div class="row">
                <div class="col-sm-12">
                    <div class="row">
                        <div class="col-sm-6">
                            <p class="blog-title"><?=$term->name?></p>
                        </div>
                        <div class="col-sm-12">
                            <div class="titlehr"></div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="entry-content">
                        <?php  
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
                                'paged' => 1,
                                'post_status'      => 'publish',
                                'suppress_filters' => true,
                                'tax_query' => array(
                                    array(
                                        'taxonomy' => 'yer_feature',
                                        'field' => $yerozellik,
                                        'terms' => $yerozellik,
                                    ))
                            );
                            $yer = get_posts( $args );
                            $iceriksehir = get_post_meta($city, '', true);
                            $ulke=$iceriksehir['sehir_detayulke_'][0];

                            }
                            elseif (isset($_GET["cat"]) && isset($_GET["country"])){
                            $yerozellik=$_GET["cat"];
                             $ulke=$_GET["country"];

                            if ($ulke!=0) {
           
                                $args = array(
                                    'posts_per_page'   => $default_posts_per_page,
                                    'orderby'          => 'title',
                                    'order'            => 'ASC',
                                    'include'          => '',
                                    'exclude'          => '',
                                    'meta_key'         => 'icerik_detay__ulke',
                                    'meta_value'       => $ulke,
                                    'post_type'        => 'yer',
                                    'post_mime_type'   => '',
                                    'post_parent'      => '',
                                    'author'           => '',
                                    'paged' => 1,
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
                                $yer = get_posts( $args );
                                }
                                else{
                                    $args = array(
                                    'posts_per_page'   => $default_posts_per_page,
                                    'offset'           => 0,
                                    'child_of'     => 0,
                                    'category'         => '',
                                    'category_name'    => '',
                                    'orderby'          => 'title',
                                    'order'            => 'ASC',
                                    'include'          => '',
                                    'exclude'          => '',
                                    'post_type'        => 'yer',
                                    'post_mime_type'   => '',
                                    'post_parent'      => '',
                                    'author'           => '',
                                    'paged' => 1,
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
                                $yer = get_posts( $args );
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
                                'paged' => 1,
                                'post_status'      => 'publish',
                                'suppress_filters' => true,
                                'tax_query' => array(
                                    array(
                                        'taxonomy' => 'yer_feature',
                                        'field' => $yerozellik,
                                        'terms' => $yerozellik,
                                    ))
                            );
                            $yer = get_posts( $args );

                            } 
                       
                        $my_posts = new WP_Query( $args );

                        if ( $my_posts->have_posts() ) : 
                        ?>
                            <div class="my-posts row m-0">
                                    <?php while ( $my_posts->have_posts() ) : $my_posts->the_post() ?>
                                        <div class="col-sm-4 p-0  mb-4 blog-border yazi-decoration cursor brightness-kapsayici askintest">
                                            <a href="<?=get_permalink(get_the_ID(), false );?>" class="yazi-decoration ">
                                                <div class="col-sm-12 pl-0 pr-0 brightness-cards kucuk-cards-sm" >
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
                            </div>
                        <?php endif ?>
                        <div class="loadmore"><center><span class="etiketstyle font-18 yazi-decoration gizlegoster1 w-50 mb-3">Devamını Göster</span><h3 class="gizlegoster2 ">Tümü Gösterildi.</h3> </center></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-4 p-0">
            <div class="col-sm-12">
                <div class="row">
                    <div class="col-sm-12">
                        <p class="blog-title">Popüler Şehirler</p>
                        <hr class="blog-hr mt-1">
                        <?php foreach($popsehir as $popsehirler){ $sehrid = get_post_meta($popsehirler->ID ); ?>
                        <a href="<?=get_permalink( $popsehirler->ID, false );?>" target="_blank" title="<?=$popsehirler->post_title?>" class=" facility-rect-box yazi-decoration">
                            <div class="frb-img-box">
                                <img class="otl-img" alt="<?=$value->post_title?>"  src="<?=wp_get_attachment_image_url(get_post_thumbnail_id($popsehirler->ID), array(245, 165, true), '', array('style' => 'width: 100%; height: 100%;'))?>">
                            </div> 
                            <div class="frb-info-box">
                                <h3 class="frb-title"><?=$popsehirler->post_title?></h3>
                                <span class="frb-sub-title font-13">
                                    <i class="fa pz-icons-se-82 color-orange mr-2"></i><strong>Nüfus: </strong><?=$sehrid['genel_bilgiler_nufusu'][0] ?> kişi
                                </span>
                                <strong class="frb-title font-14" style="float: right;">Şehre Git  >></strong>
                            </div>
                        </a>
                        <?php } ?>
                    </div>
                    <div class="col-sm-12 ">
                            
                                <p class="blog-title">Öne Çıkan Oteller</p>
                                <hr class="blog-hr mt-1">
                                <?php foreach ($otelmaps as $key => $value) { 
                                    $otelmapsgenel = get_post_meta($value-> ID, '', true);
                                        $otelmapsgenelimg=$otelmapsgenel['_thumbnail_id'][0];
                                        $otelmapsgenelulke = get_posts($otelmapsgenel['icerik_detay__ulke'][0], '', true);
                                        $otelmapsstar=$otelmapsgenel['hotel_details_star'][0];
                                        $otelmapsgenelulke=$otelmapsgenel['_thumbnail_id'][0];
                                        $otelmapsenlem=$otelmapsgenel['icerik_detay_enlem'][0];
                                        $otelmapsboylam=$otelmapsgenel['icerik_detay_boylam'][0];
                                        $distance = getDistanceBetweenPointsNew($otelmapsenlem, $otelmapsboylam, $enlem, $boylam);
                                        $mesafeyuvarla=round($distance["kilometers"],1);
                                        $mesafedk=round($mesafeyuvarla*60/45);


                                      //printarr(  $otelmapsgenel);
                                    ?>

                                    <a href="<?=$otelmapsgenel['hotel_details_hotel_url'][0] ?>" target="_blank" title="<?=$value->post_title?>" class=" facility-rect-box yazi-decoration">
                                        <div class="frb-img-box">
                                            <img class="otl-img" alt="<?=$value->post_title?>"  src="<?=wp_get_attachment_image_url($otelmapsgenelimg)?>">
                                        </div> 
                                        <div class="frb-info-box">
                                            <h3 class="frb-title"><?=$value->post_title?></h3>
                                            <span class="frb-sub-title m-0">
                                                <i class="fa fa-map-marker color-orange "></i> <?=get_the_title($otelmapsgenel['icerik_detay__ulke'][0]) ?> / <?=get_the_title($otelmapsgenel['icerik_detay_sehir-isim'][0]) ?>
                                            </span>
                                            <span class="frb-sub-title">
                                                <span class="stars">
                                                    <?php if ($otelmapsstar) { for ($i=0; $i <$otelmapsstar ; $i++) { ?><i class=" fa fa-star"></i><?php } }?>
                                                </span>
                                                <strong class="frb-title font-13" style="float: right;">Rezervasyon >></strong>
                                            </span>
                                        </div>
                                    </a>
                                <?php } ?>
                        </div>
                </div>
            </div>    
        </div>
        <!--<div class="col-sm-4  pr-0">
            <div class="row">
                    <div class="col-sm-12">
                        <div class="row">
                            <div class="col-sm-12 mt-4">
                                <p class="blog-title">Popüler Şehirler</p>
                                <hr class="blog-hr mt-1">
                                <?php foreach($popsehir as $popsehirler){ ?>
                                <div class="card mb-2">
                                    <div class="row m-0">
                                        <div class="col-sm-6 d-flex p-0 ">
                                            <?= wp_get_attachment_image(get_post_thumbnail_id($popsehirler->ID), array(245, 165, true), '', array('style' => 'width: 100%; height: 100%;'));?>
                                        </div>
                                        <div class="col-sm-6 py-3">
                                            <h3 class="card-title"><?=$popsehirler->post_title?></h3>
                                            <a href="<?=get_permalink( $popsehirler->ID, false );?>" class="btn btn-outline-success blog-btn font-weight-bold align-self-end" style="border-radius: 15px;">Şehire Git</a>
                                        </div> 
                                    </div>
                                </div>
                                 <?php } ?>
                            </div> 
                        </div>
                    </div>
            </div>
            <div class="row">
                    <div class="col-sm-12">
                        <div class="row">
                            <?php get_sidebar('kategori'); ?>
                        </div>
                    </div>
            </div>
        </div>-->
    </div>
</div>
<script type="text/javascript">
var ajaxurl = "<?php echo admin_url( 'admin-ajax.php' ); ?>";
var page = 2;
function continueHideShow(){
    var count = $('.askintest').length;
    if(<?=$count?> > count){
        $('.gizlegoster1').show();
        $('.gizlegoster2').hide();
    }
    else
    {
        $('.gizlegoster1').hide();
        $('.gizlegoster2').show();
    }

}

jQuery(function($) {
    continueHideShow();
    $('body').on('click', '.loadmore', function() {
        var data = {
            'action': 'load_posts_by_ajax',
            'page': page,
            'security': '<?php echo wp_create_nonce("load_more_posts"); ?>'
        };

        $.post(ajaxurl, data, function(response) {
            $('.my-posts').append(response);
            page++;
            continueHideShow();
        });
    });
});
// Scrol aşağı indiğinde
/* $(window).scroll(function() {
        if ($(window).scrollTop() == $(document).height() - $(window).height()) {
            var data = {
                'action': 'load_posts_by_ajax',
                'page': page,
                'security': '<?php echo wp_create_nonce("load_more_posts"); ?>'
            };

            $.post(ajaxurl, data, function(response) {
                $('.my-posts').append(response);
                page++;
            });
        }
    }); */


</script>

<?php
get_footer();
