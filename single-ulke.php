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

$zoomkontrol= $content['ulke_detayzoomkontrol'][0];
$enlem  = $content['ulke_detayenlem'][0]; 
$boylam = $content['ulke_detayboylam'][0];
$map=$enlem.",".$boylam;
/*$kt= explode (",",$kordinat);*/
$cap=$content['ulke_detaykonumcap'][0];
$enlem1=$enlem+$cap;
$enlem2=$enlem-$cap;
$boylam1=$boylam+$cap;
$boylam2=$boylam-$cap;

$selectname="Ülke";
$id = get_the_ID();
 $terms = get_posts( array(
        'post_type' => 'sehir',
        'posts_per_page' => -1,
        'orderby'          => 'title',
        'order'          => 'ASC',
        'meta_key'         => 'sehir_detayulke_',
        'meta_value'       => $id,
    ) );

    $tempaa = array();

    foreach ($terms as $key => $value) {
        $tempaa[$value -> guid] = $value -> post_title;
    }


    $popsehir = get_posts( array(
        'post_type' => 'sehir',
        'posts_per_page' => -1,
        'orderby'          => 'title',
        'order'          => 'ASC',
        'meta_query' => array(
        array(
            'key'         => 'sehir_detayulke_', 
            'value'       => $id,
            'compare' => '='
        ),

        array(
            'key'         => '_is_ns_featured_post', 
            'value'       => 'yes',
            'compare' => '='
        )
    ),
        
    ) ); 
//printarr($popsehir);


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
            'key'         => 'icerik_detay__ulke', 
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

$gezyer = get_posts( $args );


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
            'key'         => 'icerik_detay__ulke', 
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
            'key'         => 'icerik_detay__ulke', 
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

//Okunma sayısı
setPostViews(get_the_ID()); 
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
$otelgenel = get_post_meta(get_the_ID(), '', true);
$hotelcod=$otelgenel['hotel_details_code'][0];

// Maps google Bitiş.


?>
    <div class="container mt-5">
        <div class="row">
            <div class="col-sm-12 blog-title">
                <p class="font-18 color-orange font-weight-bold yazi-decoration"><a href="#" class="yazi-decoration"><?=$content['ulke_detaykita_select'][0]?></a> > <?php echo the_title(); ?></p>
            </div> 
            <div class="col-sm-12">
                <div class="titlehr"></div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-8 p-0"  >
                <!--<img class="img-fluid" src="<?=$content['ulke_detayulke_image'][0]?>" alt="">-->
                <div class="col-sm-12">
                    <div class="slider-border">
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
                                <a class="d-inline" id="harita1-tab" data-toggle="tab" href="#harita1" role="tab" aria-controls="harita1" aria-selected="true"><button  class="etiketstyle-acik-mavi font-18 col-12 col-sm-auto mt-1"><i class="fa pz-icons-85 mr-2 font-15" aria-hidden="true"></i>Gezilecek Yerler</button></a>
                            </li>
                            <li class="d-inline p-0">
                                <a class="d-inline" id="harita2-tab" data-toggle="tab" href="#harita2" role="tab" aria-controls="harita2" aria-selected="false"><button  class="etiketstyle-mavi font-18 col-12 col-sm-auto mt-1"><i class="icon-bank mr-2 font-15" aria-hidden="true"></i>Tarihi Yerler</button></a>
                            </li>
                            <li class="d-inline p-0">
                                <a class="d-inline" id="harita3-tab" data-toggle="tab" href="#harita3" role="tab" aria-controls="harita3" aria-selected="false"><button  class="etiketstyle-eflatun font-18 col-12 col-sm-auto mt-1"><i class="icon-spotlights mr-2 font-15" aria-hidden="true"></i>Eğlence Mekanları</button></a>
                            </li>
                            <li class="d-inline p-0">
                                <a class="d-inline" id="harita4-tab" data-toggle="tab" href="#harita4" role="tab" aria-controls="harita4" aria-selected="false"><button  class="etiketstyle-turuncu font-18 col-12 col-sm-auto mt-1"><i class="pz-icons-95 mr-2 font-15" aria-hidden="true"></i>Oteller</button></a>
                            </li>
                            <li class="d-inline p-0">
                                <a class="d-inline " id="harita5-tab" data-toggle="tab" href="#harita5" role="tab" aria-controls="harita5" aria-selected="false"><button  class="etiketstyle-kirmizi font-18 col-12 col-sm-auto mt-1" active><i class="icon-international-delivery font-15" aria-hidden="true"></i></button></a>
                            </li>
                        </ul>
                    </div>
                    <script>
                      $(function () {
                        $('#myTab li:last-child a').tab('show')
                      })
                    </script>
                </div>
                <div class="col-sm-12 mt-3">
                    <div class="row">
                        <div class="col-6 col-sm-6">
                            <div class="category22 text-center mt-3 " style="width: 70%!important;">Ülke</div>
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
                <div class="col-sm-12">
                    <?php the_content( null, false ); ?>
                </div>
                <div class="col-sm-12">
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
                                <a href="<?=$home?>/ozellik/?cat=7&country=<?=$id?>" class="etiketstyle font-18 yazi-decoration" >Tümünü Gör >></a>
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
                                <a href="<?=$home?>/ozellik/?cat=8&country=<?=$id?>" class="etiketstyle font-18 yazi-decoration" >Tümünü Gör >></a>
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
                                <a href="<?=$home?>/ozellik/?cat=9&country=<?=$id?>" class="etiketstyle font-18 yazi-decoration" >Tümünü Gör >></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-4 p-0">
                <div class="col-sm-11">
                    <div class="row">
                        <div class="col-sm-12 blog-border p-0 ml-3 mr-3">
                            <div class="col-sm-12 pt-3">
                                <p class="blog-title blog-bold-subtitles"><i class="fa pz-icons-51 pr-3"></i>Genel Bilgiler</p>
                                <hr>
                                <div class="row">
                                    <div class="col-1 col-sm-1"><i class="fa pz-icons-38 color-orange"></i></div>
                                    <div class="col-4 col-sm-4 color-orange font-weight-bold">Para Birimi</div>
                                    <div class="col-1 col-sm-1 color-orange font-weight-bold">:</div>
                                    <div class="col-5 col-sm-5"><?=$content['ulke_genel_bilgiler_select'][0]?></div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-1 col-sm-1"><i class="fa pz-icons-se-82 color-orange"></i></div>
                                    <div class="col-4 col-sm-4 color-orange font-weight-bold">Nüfus</div>
                                    <div class="col-1 col-sm-1 color-orange font-weight-bold">:</div>
                                    <div class="col-5 col-sm-5"><?=$content['ulke_genel_bilgiler_nufusu'][0]?></div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-1 col-sm-1"><i class="fa pz-icons-62 color-orange color-orange font-weight-bold"></i></div>
                                    <div class="col-4 col-sm-4 color-orange font-weight-bold">Konuşulan Dil</div>
                                    <div class="col-1 col-sm-1 color-orange font-weight-bold">:</div>
                                    <div class="col-5 col-sm-5"><?=$content['ulke_genel_bilgiler_ulke_dil_feature_'][0]?></div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-1 col-sm-1"><i class="fa pz-icons-76 color-orange color-orange font-weight-bold"></i></div>
                                    <div class="col-4 col-sm-4 color-orange font-weight-bold" >Zaman Dilimi</div>
                                    <div class="col-1 col-sm-1 color-orange font-weight-bold">:</div>
                                    <div class="col-5 col-sm-5"><?=$content['_date_time'][0]?></div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-1 col-sm-1"><i class="fa pz-icons-02 color-orange color-orange font-weight-bold"></i></div>
                                    <div class="col-4 col-sm-4 color-orange font-weight-bold" >Başkenti</div>
                                    <div class="col-1 col-sm-1 color-orange font-weight-bold">:</div>
                                    <div class="col-5 col-sm-5"><?=$content['ulke_genel_bilgiler_başkent'][0]?></div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-1 col-sm-1 pt-2"><i class="fa pz-icons-85 color-orange color-orange font-weight-bold "></i></div>
                                    <div class="col-4 col-sm-4 color-orange font-weight-bold">Şehirler</div>
                                    <div class="col-1 col-sm-1 color-orange font-weight-bold">:</div>
                                    <div class="col-5 col-sm-5">
                                        <form>
                                            <select name="city" value="city" class="w-100 font-14 border-edecee h-40px color-808080" id="city">
                                                    <?php  foreach ($tempaa as $key => $value) {
                                                   ?>
                                                    <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
                                                    <?php }?>
                                            </select>
                                        </form>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <span onclick="cityLocation()">

                                            <button class="etiketstyle font-14 yazi-decoration w-100 font-weight-bold mt-4 mb-4" >
                                                <center>
                                                    Seçilen Şehiri Gör >>
                                                </center>
                                            </button>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 p-0  mt-3 ml-3 mr-3">
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
                        <div class="col-sm-12 p-0 mt-3 ml-3 mr-3">
                            
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
                                                    <?php if ($otelmapsstar) { for ($i=0; $i <$otelmapsstar ; $i++) { ?><i class=" fa fa-star"></i><?php } }?>
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
