<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Puzzle_Blog
 */

get_header(); ?>

<?php
$home=home_url();
while ( have_posts() ) : the_post();
   
$content = get_post_meta(get_the_ID(), '', true);
//printarr($content); 
$selectname="Şehir";
$zoomkontrol= $content['sehir_detayzoomkontrol'][0];
$enlem  = $content['sehir_detayenlem'][0]; 
$boylam = $content['sehir_detayboylam'][0];
$map=$enlem.",".$boylam;
/*$kt= explode (",",$kordinat);*/
$enlem1=$enlem+0.8;
$enlem2=$enlem-0.8;
$boylam1=$boylam+0.8;
$boylam2=$boylam-0.8;


//$distance = getDistanceBetweenPointsNew($enlem1, $boylam1, $enlem2, $boylam2);
//$asdasdasd=$distance["kilometers"];
//printarr($distance);
//printarr($asdasdasd);


$ulkeid = $content['sehir_detayulke_'][0];
 $ulkepost = get_posts( array(
        'post_type' => 'ulke',
        'posts_per_page' => -1,
        'page_id' =>  $ulkeid,
        'order'          => 'ASC',
    ) );
 $temp = array();
foreach ($ulkepost as $key => $value) {
        $tempa = $value -> post_title;
        $templink = $value -> guid;
        $tempid = $value -> ID;
        $ulkese = get_post_meta($tempid, '', true);

    }
$havalmn = maybe_unserialize( $content['sehir_havalimani_repeat_group'][0]);

$id = get_the_ID();

$args = array(
    'posts_per_page'   => 3,
    'offset'           => 0,
    'child_of'     => 0,
    'category'         => '',
    'category_name'    => '',
    'orderby'          => 'date',
    'order'            => 'DESC',
    'include'          => '',
    'exclude'          => '',
    'meta_query' => array(
        array(
            'key'         => 'icerik_detay_sehir-isim', 
            'value'       => $id,
            'compare' => '='
        ),

        array(
            'key'         => '_is_ns_featured_post', 
            'value'       => 'yes',
            'compare' => '='
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
            'field' => '7',
            'terms' => '7',
        )
         
    )
);
//printarr($args); 
$gezyer = get_posts( $args );


//printarr($gezyer); 

$args = array(
    'posts_per_page'   => 3,
    'offset'           => 0,
    'child_of'     => 0,
    'category'         => '',
    'category_name'    => '',
    'orderby'          => 'date',
    'order'            => 'DESC',
    'include'          => '',
    'exclude'          => '',
    'meta_query' => array(
        array(
            'key'         => 'icerik_detay_sehir-isim', 
            'value'       => $id,
            'compare' => '='
        ),

        array(
            'key'         => '_is_ns_featured_post', 
            'value'       => 'yes',
            'compare' => '='
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
            'field' => '8',
            'terms' => '8',
        )
    )
);
$taryer = get_posts( $args );
//printarr($taryer); 

//printarr($tarihyer);

$args = array(
    'posts_per_page'   => 3,
    'offset'           => 0,
    'child_of'     => 0,
    'category'         => '',
    'category_name'    => '',
    'orderby'          => 'date',
    'order'            => 'DESC',
    'include'          => '',
    'exclude'          => '',
    'meta_query' => array(
        array(
            'key'         => 'icerik_detay_sehir-isim', 
            'value'       => $id,
            'compare' => '='
        ),

        array(
            'key'         => '_is_ns_featured_post', 
            'value'       => 'yes',
            'compare' => '='
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
            'field' => '9',
            'terms' => '9',
        )
    )
);

$eylenceyer = get_posts( $args );

//Maps google başlangıç
$args = array(
    'posts_per_page'   => -1,
    'offset'           => 0,
    'child_of'     => 0,
    'category'         => '',
    'category_name'    => '',
    'orderby'          => 'date',
    'order'            => 'DESC',
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
            'field' => '7',
            'terms' => '7',
        )
         
    )
);
$gezmaps = get_posts( $args );


$args = array(
    'posts_per_page'   => -1,
    'offset'           => 0,
    'child_of'     => 0,
    'category'         => '',
    'category_name'    => '',
    'orderby'          => 'date',
    'order'            => 'DESC',
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
            'field' => '8',
            'terms' => '8',
        )
         
    )
);
$tarmaps = get_posts( $args );


$args = array(
    'posts_per_page'   => -1,
    'offset'           => 0,
    'child_of'     => 0,
    'category'         => '',
    'category_name'    => '',
    'orderby'          => 'date',
    'order'            => 'DESC',
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
            'field' => '9',
            'terms' => '9',
        )
         
    )
);
$eylenmaps = get_posts( $args );

$args = array(
    'posts_per_page'   => 15,
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
$otelgenel = get_post_meta(get_the_ID(), '', true);
$hotelcod=$otelgenel['hotel_details_code'][0];

// Maps google Bitiş.


//Okunma sayısı
setPostViews(get_the_ID()); 

//Havadurumu
$sehir_kodu = $content['sehir_hava_durumu_sehir_kod'][0];
require_once('api/weather-api.php');
$hava = $weathers->query->results->channel->item->condition->code;
$derece = $weathers->query->results->channel->item->condition->temp;
$wind = $weathers->query->results->channel->wind->speed;
$nem = $weathers->query->results->channel->atmosphere->humidity;

//printarr($ulkepost); 

$id=get_the_ID();
//Slider için resim
$args = array(
    'posts_per_page'   => -1,
    'offset'           => 0,
    'child_of'     => 0,
    'category'         => '',
    'category_name'    => '',
    'orderby'          => 'date',
    'order'            => 'DESC',
    'include'          => '',
    'exclude'          => '',
    'meta_query' => array(
        array(
            'key'         => 'icerik_detay_sehir-isim', 
            'value'       => $id,
            'compare' => '='
        ),
        array(
            'key'         => 'icerik_detay_select', 
            'value'       => "Oteller",
            'compare' => '!='
        )
        
    ),
    'post_type'        => 'yer',
    'post_mime_type'   => '',
    'post_parent'      => '',
    'author'           => '',
    'author_name'      => '',
    'post_status'      => 'publish',
    'suppress_filters' => true,
   
);
$sehiryerler = get_posts( $args );
//printarr($sehiryerler); 
 
                                   


?>
<script src="<?php bloginfo('template_url'); ?>/css/flexSlider/js/modernizr.js"></script>
<script src="<?php bloginfo('template_url'); ?>/css/flexSlider/js/jquery.flexslider.js"></script>
<script src="<?php bloginfo('template_url'); ?>/css/flexSlider/js/shCore.js"></script>
<script src="<?php bloginfo('template_url'); ?>/css/flexSlider/js/shBrushXml.js"></script>
<script src="<?php bloginfo('template_url'); ?>/css/flexSlider/js/shBrushJScript.js"></script>
<script src="<?php bloginfo('template_url'); ?>/css/flexSlider/js/jquery.easing.js"></script>
<script src="<?php bloginfo('template_url'); ?>/css/flexSlider/js/jquery.mousewheel.js"></script>
<script src="<?php bloginfo('template_url'); ?>/css/flexSlider/js/demo.js"></script>

    <div class="container mt-5">
        <div class="row">
            <div class="col-sm-12 blog-title">
                <p class="font-18 color-orange font-weight-bold yazi-decoration"><a href="#" class="yazi-decoration"><?=$ulkese['ulke_detaykita_select'][0]?></a> > <a href="<?=$templink?>" class="yazi-decoration"><?php echo $tempa ?></a> > <?php echo the_title(); ?></p>
            </div> 
            <div class="col-sm-12">
                <div class="titlehr"></div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-8 p-0">
                <!--Silider başlangıç -->
                <div class="col-sm-12">

                    <ul class="nav nav-tabs" role="tablist">
                        <li class="active"><a href="#fotogaleri" id="fotogaleri-tab" data-toggle="tab" aria-controls="fotogaleri" aria-selected="true" class="color-orange font-weight-bold"><i class="fa fa-picture-o"></i> Foto Galeri</a></li>
                        <li><a href="#harita" id="harita-tab" data-toggle="tab" aria-controls="harita" aria-selected="true" class="color-orange font-weight-bold"><i class="fa pz-icons-01"></i> Harita</a></li>
                    </ul>

                    <div class="tab-content slider-border" id="tabmenu-yer" role="tabpanel" aria-labelledby="tabmenu-yer">
                        <div id="fotogaleri" class="tab-pane fade in active">
                            <!-- Place somewhere in the <body> of your page -->
                            <div id="slider" class="flexslider">
                              <ul class="slides">
                                <?php foreach ($sehiryerler as $key => $value) {
                                    $yerid = get_post_meta($value->ID);
                                    $yerimages = get_post_meta( $value->ID, 'icerik_detay_images', 1 );
                                    //printarr($yerid); 
                                    foreach ($yerimages as $key => $imagesurl) {
                                        break;
                                    }
                                    ?>

                                <li>
                                  <img src='<?=$imagesurl?>' style="height: 400px;"/>
                                </li>
                                <?php } ?>
                                <!-- items mirrored twice, total of 12 -->
                              </ul>
                            </div>
                            <div id="carousel" class="flexslider">
                              <ul class="slides">
                                <?php foreach ($sehiryerler as $key => $value) {
                                    $yerid = get_post_meta($value->ID);
                                    $yerimages = get_post_meta( $value->ID, 'icerik_detay_images', 1 );
                                    //printarr($yerid); 
                                    foreach ($yerimages as $key => $imagesurl) {
                                        break;
                                    }

                                    ?>
                                <li >
                                  <img src='<?=$imagesurl?>'  />
                                </li>
                                <?php } ?>
                                <!-- items mirrored twice, total of 12 -->
                              </ul>
                            </div>
                        </div>
                        <div id="harita" class="tab-pane fade ">

                            <div class="tab-content">
                                <div class="tab-pane " id="harita1" role="tabpanel" aria-labelledby="harita1-tab">
                                    <div class="map p-1">
                                        <?php include('extra/google-maps.php'); ?>
                                        <div id="konum-maps" style="width:100%; height:485px;"></div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="harita2" role="tabpanel" aria-labelledby="harita2-tab">
                                    <div class="map p-1">
                                        <?php include('extra/google-maps2.php'); ?>
                                        <div id="konum-maps2" style="width:100%; height:485px;"></div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="harita3" role="tabpanel" aria-labelledby="harita3-tab">
                                    <div class="map p-1">
                                        <?php include('extra/google-maps3.php'); ?>
                                        <div id="konum-maps3" style="width:100%; height:485px;"></div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="harita4" role="tabpanel" aria-labelledby="harita4-tab">
                                    <div class="map p-1">
                                        <?php include('extra/google-maps4.php'); ?>
                                        <div id="konum-maps4" style="width:100%; height:485px;"></div>
                                    </div>
                                </div>
                                <div class="tab-pane active" id="harita5" role="tabpanel" aria-labelledby="harita5-tab">
                                    <div class="map p-1">
                                        <?php include('extra/google-maps5.php'); ?>
                                        <div id="konum-maps5" style="width:100%; height:485px;"></div>
                                    </div>
                                </div>
                            </div>
                            <ul class="m-0" id="myTab" role="tablist">
                                <li class="d-inline p-0">
                                    <a class="d-inline" id="harita1-tab" data-toggle="tab" href="#harita1" role="tab" aria-controls="harita1" aria-selected="true"><button  class="butn  etiketstyle font-18 col-12 col-sm-auto mt-1"><i class="fa pz-icons-85 mr-2 font-15" aria-hidden="true"></i>Gezilecek Yerler</button></a>
                                </li>
                                <li class="d-inline p-0">
                                    <a class="d-inline" id="harita2-tab" data-toggle="tab" href="#harita2" role="tab" aria-controls="harita2" aria-selected="false"><button  class="butn  etiketstyle font-18 col-12 col-sm-auto mt-1"><i class="icon-bank mr-2 font-15" aria-hidden="true"></i>Tarihi Yerler</button></a>
                                </li>
                                <li class="d-inline p-0">
                                    <a class="d-inline" id="harita3-tab" data-toggle="tab" href="#harita3" role="tab" aria-controls="harita3" aria-selected="false"><button  class="butn  etiketstyle font-18 col-12 col-sm-auto mt-1"><i class="icon-spotlights mr-2 font-15" aria-hidden="true"></i>Eğlence Mekanları</button></a>
                                </li>
                                <li class="d-inline p-0">
                                    <a class="d-inline" id="harita4-tab" data-toggle="tab" href="#harita4" role="tab" aria-controls="harita4" aria-selected="false"><button  class="butn  etiketstyle font-18 col-12 col-sm-auto mt-1"><i class="pz-icons-95 mr-2 font-15" aria-hidden="true"></i>Oteller</button></a>
                                </li>
                                <li class="d-inline p-0">
                                    <a class="d-inline " id="harita5-tab" data-toggle="tab" href="#harita5" role="tab" aria-controls="harita5" aria-selected="false"><button  class=" butn  etiketstyle font-18 col-12 col-sm-auto mt-1" active><i class="icon-international-delivery font-15" aria-hidden="true"></i></button></a>
                                </li>
                            </ul>
                            <script>
                              $(function () {
                                $('#myTab li:last-child a').tab('show')
                              })
                            </script>
                        </div>
                    </div>
                    
                    <script type="text/javascript">

                        $('#fotogaleri a[href="#profile"]').tab('show') // Select tab by name
                        $('#harita a[href="#profile"]').tab('show') // Select tab by name
                        $(window).load(function() {
                          // The slider being synced must be initialized first
                          $('#carousel').flexslider({
                            animation: "slide",
                            controlNav: false,
                            animationLoop: true,
                            slideshow: false,
                            itemWidth: 150,
                            itemMargin: 5,
                            asNavFor: '#slider'
                          });
                         
                          $('#slider').flexslider({
                            animation: "slide",
                            controlNav: false,
                            animationLoop: false,
                            slideshow: false,
                            sync: "#carousel"
                          });
                        });
                    </script>
                </div> 

                <!--Silider bitiş -->
                <div class="col-sm-12">
                    <div class="row">
                        <div class="col-6 col-sm-6">
                            <div class="category22 text-center mt-3 " style="width: 70%!important;">ŞEHİR</div>
                        </div>
                        <div class="col-6 col-sm-6 ">
                            <div class="row m-0 mt-2" style="float:right;">      
                                <p class="million m-0 pr-2  font-20"><strong><i class="fa fa-bullhorn" aria-hidden="true"></i> <?php echo getPostViews(get_the_ID()); ?></strong></p>
                                <p class="read font-20 m-0"> Okudu</p>
                            </div> 
                        </div>
                    </div>
                </div>
                <div class="col-sm-12">
                    <p class="news-title2 mb-2 mt-0"><?php echo the_title(); ?>
                        
                    </p>
                </div>
                <div class="col-sm-12 ">
                    <div class="row">
                        <div class="col-sm-12">
                            <?php the_content( null, false ); ?>
                        </div>
                        
                        <!--Gezilecek Yerler-->
                        <div class="col-sm-12">
                            <div class="row">
                                <div class="col-sm-6 pt-3">
                                    <p class="blog-title">Gezilecek Yerler</p>
                                </div>
                                <div class="col-sm-12">
                                    <div class="titlehr"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 ">
                            <div class="row p-0 m-0">
                                <?php foreach($gezyer as $temp):?>
                                <div class="col-sm-4 p-0 m-0 mb-4 blog-border yazi-decoration cursor brightness-kapsayici">
                                    <a href="<?=get_permalink( $temp -> ID, false );?>" class="yazi-decoration ">
                                        <div class="col-sm-12 pl-0 pr-0 brightness-cards" style="width: 100%; height: 153px;">
                                            <img src='<?=wp_get_attachment_image_url(get_post_thumbnail_id($temp->ID),array(245, 165, true));?>' style="width: 100%; height: 100%;">
                                            
                                        </div>
                                        <div class="col-sm-12 pt-2">
                                            <h4><strong class="yazi-decoration brightness-title news-title3"><?=$temp -> post_title?></strong></h4>
                                            <p class="font-14 yazi-decoration" style="color:#808080;">
                                                <?=mb_substr($temp->post_content,0,160,'UTF-8'); ?>...</p>
                                        </div>
                                    </a>
                                </div>
                                <?php endforeach;?>
                                <div class="col-sm-12 text-right p-0">
                                    <a href="<?=$home?>/ozellik/?cat=7&city=<?=$id?>" class="etiketstyle font-18 yazi-decoration" >Tümünü Gör >></a>
                                </div>
                            </div>
                        </div>
                        <!--Tarihi Mekanlar-->
                        <div class="col-sm-12">
                            <div class="row">
                                <div class="col-sm-6 pt-3">
                                    <p class="blog-title">Tarihi Mekanlar</p>
                                </div>
                                <div class="col-sm-12">
                                    <div class="titlehr"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 ">
                            <div class="row p-0 m-0">
                                <?php foreach($taryer as $tarihyer):?>
                                <div class="col-sm-4 p-0 m-0 mb-4 blog-border yazi-decoration cursor brightness-kapsayici">
                                    <a href="<?=get_permalink( $temp -> ID, false );?>" class="yazi-decoration ">
                                        <div class="col-sm-12 pl-0 pr-0 brightness-cards" style="width: 100%; height: 153px;">
                                            <img src='<?=wp_get_attachment_image_url(get_post_thumbnail_id($tarihyer->ID),array(245, 165, true));?>' style="width: 100%; height: 100%;">
                                            
                                        </div>
                                        <div class="col-sm-12 pt-2">
                                            <h4><strong class="yazi-decoration brightness-title news-title3"><?=$tarihyer -> post_title?></strong></h4>
                                            <p class="font-14 yazi-decoration" style="color:#808080;">
                                                <?=mb_substr($tarihyer->post_content,0,160,'UTF-8'); ?>...</p>
                                        </div>
                                    </a>
                                </div>
                                <?php endforeach;?>
                                <div class="col-sm-12 text-right p-0">
                                    <a href="<?=$home?>/ozellik/?cat=8&city=<?=$id?>" class="etiketstyle font-18 yazi-decoration" >Tümünü Gör >></a>
                                </div>
                            </div>
                        </div>
                       
                        <!--Eğlence Mekanları-->
                        <div class="col-sm-12">
                            <div class="row">
                                <div class="col-sm-6 pt-3">
                                    <p class="blog-title">Eğlence Mekanları</p>
                                </div>
                                <div class="col-sm-12">
                                    <div class="titlehr"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 ">
                            <div class="row p-0 m-0">
                                <?php foreach($eylenceyer as $eylenyer){ ?>
                                <div class="col-sm-4 p-0 m-0 mb-4 blog-border yazi-decoration cursor brightness-kapsayici">
                                    <a href="<?=get_permalink( $temp -> ID, false );?>" class="yazi-decoration ">
                                        <div class="col-sm-12 pl-0 pr-0 brightness-cards" style="width: 100%; height: 153px;">
                                            <img src='<?=wp_get_attachment_image_url(get_post_thumbnail_id($eylenyer->ID),array(245, 165, true));?>' style="width: 100%; height: 100%;">
                                            
                                        </div>
                                        <div class="col-sm-12 pt-2">
                                            <h4><strong class="yazi-decoration brightness-title news-title3"><?=$eylenyer -> post_title?></strong></h4>
                                            <p class="font-14 yazi-decoration" style="color:#808080;">
                                                <?=mb_substr($eylenyer->post_content,0,160,'UTF-8'); ?>...</p>
                                        </div>
                                    </a>
                                </div>
                                <?php } ?>
                                <div class="col-sm-12 text-right p-0 mb-3">
                                    <a href="<?=$home?>/ozellik/?cat=9&city=<?=$id?>" class="etiketstyle font-18 yazi-decoration" >Tümünü Gör >></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
            <div class="col-sm-4">
                <div class="col-sm-12 p-0">
                    <div class="row">
                        <div class="col-sm-11 blog-border ml-3 mr-3">
                            <div class="row">
                                <div class="col-sm-12 pt-3">
                                    <p class="blog-title blog-bold-subtitles"><i class="fa pz-icons-51 pr-3"></i>Genel Bilgiler</p>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="row">
                                                <div class="col-1 col-sm-1"><i class="fa pz-icons-38 color-orange"></i></div>
                                                <div class="col-4 col-sm-4 color-orange font-weight-bold">Para Birimi</div>
                                                <div class="col-1 col-sm-1 color-orange font-weight-bold">:</div>
                                                <div class="col-5 col-sm-5"><?=$content['genel_bilgiler_select'][0]?></div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="row">
                                                <div class="col-1 col-sm-1"><i class="fa pz-activities-36 color-orange"></i></div>
                                                <div class="col-4 col-sm-4 color-orange font-weight-bold">İklimi</div>
                                                <div class="col-1 col-sm-1 color-orange font-weight-bold">:</div>
                                                <div class="col-5 col-sm-5"><?=$content['genel_bilgiler_iklim_feature_'][0]?></div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="row">
                                                <div class="col-1 col-sm-1"><i class="fa pz-icons-se-82 color-orange"></i></div>
                                                    <div class="col-4 col-sm-4 color-orange font-weight-bold">Nüfus</div>
                                                    <div class="col-1 col-sm-1 color-orange font-weight-bold">:</div>
                                                <div class="col-5 col-sm-5"><?=$content['genel_bilgiler_nufusu'][0]?></div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="row">
                                                <div class="col-1 col-sm-1"><i class="fa pz-icons-62 color-orange color-orange font-weight-bold"></i></div>
                                                <div class="col-4 col-sm-4 color-orange font-weight-bold pr-0">Konuşulan Dil</div>
                                                <div class="col-1 col-sm-1 color-orange font-weight-bold">:</div>
                                                <div class="col-5 col-sm-5"><?=$content['genel_bilgiler_dil_feature_'][0]?></div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row pt-1">
                                       <div class="col-sm-12">
                                            <p class="blog-bold-subtitles"><i class="fa pz-icons-03"></i>Havalimanı Bilgisi</p>
                                            <hr>
                                            <div class="row">
                                                <div class="col-sm-12 ">
                                                    <?php foreach ($havalmn as $key => $value): 
                                                            $havalmnmapsenlem=$value['sehir_havalimani_enlem'];
                                                            $havalmnmapsboylam=$value['sehir_havalimani_boylam'];
                                                            $havalmndistance = getDistanceBetweenPointsNew($havalmnmapsenlem, $havalmnmapsboylam, $enlem, $boylam);
                                                            $havalmnmesafeyuvarla=round($havalmndistance["kilometers"],1);
                                                            //printarr($enlem); ?>
                                                            <div class="row mr-0 ml-0">
                                                                <i class="fa pz-icons-03 color-orange"></i>
                                                                <p class="color-gray font-14 pl-3"><?=$value['sehir_havalimani_title'];?></p>
                                                                <p class="color-gray font-14 pl-3 pb-2"><strong>Merkeze: </strong><?=$havalmnmesafeyuvarla?> km</p>
                                                            </div>
                                                        <?php endforeach ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> 
                        </div>
                        <div class="col-sm-11 blog-border mt-3 ml-3 mr-3">
                            <span class="cursor">
                                <div class="row">
                                    <div class="col-sm-12 pl-0 pr-0 pt-0">
                                        <div id="chart_div" style="width: 100%; height: 200px;"></div>
                                        <script type="text/javascript">
                                            google.charts.load('current', {packages: ['corechart']});
                                            google.charts.setOnLoadCallback(drawChart);

                                            function drawChart() {

                                                var data = google.visualization.arrayToDataTable([

                                                    ['Aylar', '°C', { role: 'style'}],
                                                    ['Oca', <?=$content['sehir_hava_durumuocak'][0];?>, ''],            // RGB value
                                                    ['Şub', <?=$content['sehir_hava_durumusubat'][0];?>, ''],            // English color name
                                                    ['Mar', <?=$content['sehir_hava_durumumart'][0];?>, ''],
                                                    ['Nis', <?=$content['sehir_hava_durumunisan'][0];?>, ''],
                                                    ['May', <?=$content['sehir_hava_durumumayis'][0];?>, ''],
                                                    ['Haz', <?=$content['sehir_hava_durumuhaziran'][0];?>, ''],
                                                    ['Tem', <?=$content['sehir_hava_durumutemmuz'][0];?>, ''],
                                                    ['Ağu', <?=$content['sehir_hava_durumuagustos'][0];?>, ''],
                                                    ['Eyl', <?=$content['sehir_hava_durumueylul'][0];?>, ''],
                                                    ['Eki', <?=$content['sehir_hava_durumuekim'][0];?>, ''],
                                                    ['Kas', <?=$content['sehir_hava_durumukasim'][0];?>, ''],
                                                    ['Ara', <?=$content['sehir_hava_durumuaralik'][0];?>, ''], // CSS-style declaration
                                                ]);
                                                 var options = {
                                                     title: 'Yıllık Hava Durumu Ortalaması',
                                                      bar: { groupWidth: '80%' },
                                                      colors: ['#FF7300'],
                                                        titleTextStyle: {
                                                            color: '#404040',    // any HTML string color ('red', '#cc00cc')
                                                            fontSize: 15, // 12, 18 whatever you want (don't specify px)
                                                            bold: true,    // true or false
                                                            italic: false   // true of false
                                                            }   
                                                   
                                                };
                                                var chart = new google.visualization.ColumnChart(document.getElementById('chart_div'));
                                                chart.draw(data, options);

                                            }
                                        </script>
                                    </div>
                                </div>
                            </span>
                             <hr>
                            <div class="row">
                                <div class="col-sm-12 mb-3">
                                    <div class="row">
                                        <div class="col-sm-11 color-orange font-12 font-weight-bold"> <?=setWeatherIcon($hava);?> Hava <?=$derece;?> °C | <i class="pz-activities-26" style="font-size: 14px !important;"></i> Rüzgar <?=$wind;?> km/s | Nem %<?=$nem;?> </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-11 p-0 mt-3 ml-3 mr-3">
                            
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
                                            <span class="frb-sub-title">
                                                <i class="fa fa-map-marker color-orange "></i> <?=get_the_title($otelmapsgenel['icerik_detay__ulke'][0]) ?> / <?=get_the_title($otelmapsgenel['icerik_detay_sehir-isim'][0]) ?>
                                            </span>
                                            <span class="frb-sub-title">
                                                <strong>Mesafe: </strong><?=$mesafeyuvarla?> km / <?=$mesafedk?> dk
                                                <span class="stars">

                                                    <?php 
                                                    if ($otelmapsstar) { for ($i=0; $i <$otelmapsstar ; $i++) { ?><i class=" fa fa-star"></i><?php } }?>
                                                </span>
                                            </span>
                                        </div>
                                    </a>
                                <?php } ?>
                        </div>
                    </div>
                </div> 
            </div>
        </div>
    </div>
</div>



<script>
    $('#show-map').on('click', function () {
        if($('.map').hasClass('d-none')){
            $('.map').removeClass('d-none');
        }
        else{
            $('.map').addClass('d-none');
        }
    })

</script>
<script>
    $(function () {
        $(".show-ml").slice(0, 6).show();
        $("#loadMore").on('click', function (e) {
            e.preventDefault();
            $(".show-ml:hidden").slice(0, 4).slideDown();
            if ($(".show-ml:hidden").length == 0) {
                $("#load").fadeOut('slow');
            }
        });
    });
</script>

<?php
endwhile;
get_footer();
