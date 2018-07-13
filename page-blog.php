<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Puzzle_Blog
 */
get_header(); 
//printarr($iceriksehir);  
$home=home_url();
$args = array(
    'posts_per_page'   => 7,
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
    'author_name'      => '',
    'post_status'      => 'publish',
    'suppress_filters' => true,
    'tax_query' => array(
        array(
            'taxonomy' => 'random_feature',
            'field' => 21,
            'terms' => 21,
        ))
);
$topyer1 = get_posts( $args );
 


$args = array(
    'posts_per_page'   => 6,
    'offset'           => 0,
    'child_of'     => 0,
    'category'         => '',
    'category_name'    => '',
    'orderby'          => 'date',
    'order'            => 'DESC',
    'include'          => '',
    'exclude'          => '',
    'meta_key'         => '_is_ns_featured_post',
    'meta_value'       => 'yes',
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
    'posts_per_page'   => 5,
    'offset'           => 0,
    'child_of'     => 0,
    'category'         => '',
    'category_name'    => '',
    'orderby'          => 'date',
    'order'            => 'DESC',
    'include'          => '',
    'exclude'          => '',
    'meta_key'         => '_is_ns_featured_post',
    'meta_value'       => 'yes',
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


$args = array(
    'posts_per_page'   => 6,
    'offset'           => 0,
    'child_of'     => 0,
    'category'         => '',
    'category_name'    => '',
    'orderby'          => 'date',
    'order'            => 'DESC',
    'include'          => '',
    'exclude'          => '',
    'meta_key'         => '_is_ns_featured_post',
    'meta_value'       => 'yes',
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

$id=81;
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



<div class="container p-0">
    <div class="d-none d-sm-block  mt-5"></div>
    <div class="row m-0">
        <?php foreach ($topyer1 as $key => $value): 
        $yericerik = get_post_meta($value->ID, '', true); ?>
        <?php //printarr($yericerik);  
        $yerimg=$yericerik['icerik_detay_image'][0];
        $topyerimages = get_post_meta( $value->ID, 'icerik_detay_images', 1 );
        //printarr($yerid); 
                                    
         ?>
            <?php if ($key<3){ 
                    foreach ($topyerimages as $key => $imagesurl) {
                                        break;
                                    }
                ?>
            
                <div class="col-sm-4 p-0 blog-home-1 align-items-end w-100 imgbrightness cursor" onclick="location.href='<?=$value->guid; ?>'">
                    <img class="card-img tam100" src='<?=$imagesurl?>' alt="<?=$value->post_title; ?>">
                    <div class="card-img-overlay ">
                        <div class="category2 text-center mb-2 m-100-35" style="cursor:pointer;"><?=$yericerik['icerik_detay_select'][0]?></div>
                        <p class="news-title mb-1 " ><?=$value->post_title; ?></p>
                        <p class="text-white news-text"><?=mb_substr($value->post_content,0,110,'UTF-8'); ?>...</p>
                    </div>
                        
                </div>
           
            <?php } ?>
                
        <?php endforeach ?>
    </div>

    <div class="row m-0">
        <?php foreach ($topyer1 as $key => $value): 
            $yericerik = get_post_meta($value->ID, '', true); 
            $yerimg=$yericerik['icerik_detay_image'][0];
            $topyerimages = get_post_meta( $value->ID, 'icerik_detay_images', 1 );
            //printarr($yerid); 
             ?>
                <?php if ($key>=3){ 
                        foreach ($topyerimages as $key => $imagesurl) {
                            break;
                        }?>
                    <div class="col-sm-3 p-0 blog-home-33 align-items-end w-100 imgbrightness cursor" onclick="location.href='<?=$value->guid; ?>'">
                        <img class="card-img  tam100" src='<?=$imagesurl?>' alt="<?=$value->post_title; ?>">
                        <div class="card-img-overlay ">
                            <div class="category2 text-center mb-2 m-100-20-33" style="cursor:pointer;"><?=$yericerik['icerik_detay_select'][0]?></div>
                            <p class="news-title mb-1 " ><?=$value->post_title; ?></p>
                            <p class="text-white news-text"><?=mb_substr($value->post_content,0,110,'UTF-8'); ?>...</p>
                        </div>
                    </div>
                <?php } ?>
                
        <?php endforeach ?>
    </div>
</div>
<div class="container mt-3">
    <div class="row">
        <div class="col-sm-8 ">
            <div class="row">
                <!--Gezilecek Yerler-->
                <div class="col-sm-12">
                    <div class="row">
                        <div class="col-sm-6">
                            <p class="blog-title">Gezilecek Yerler</p>
                        </div>
                        <div class="col-sm-12">
                            <div class="titlehr"></div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="col-sm-12">
                        <div class="row">
                            <?php foreach($gezyer as $temp):?>
                                <div class="col-sm-4 p-0 m-0 mb-4 blog-border yazi-decoration cursor brightness-kapsayici">
                                    <a href="<?=get_permalink( $temp -> ID);?>" class="yazi-decoration ">
                                        <div class="col-sm-12 pl-0 pr-0 brightness-cards kucuk-cards-sm">
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
                                <a href="<?=$home?>/ozellik/?cat=7&country=0" class="etiketstyle font-18 yazi-decoration" >Tümünü Gör >></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--Tarihi Mekanlar-->
                 <!--Tarihi Mekanlar-->
            <div class="row">
                <div class="col-sm-12">
                    <div class="row">
                        <div class="col-sm-6">
                        <p class="blog-title">Tarihi Yerler</p>
                        </div>
                        <div class="col-sm-12">
                            <div class="titlehr"></div>
                        </div>                            
                    </div>
                </div>
            </div>
            <div class="row m-0">
                 <?php foreach($taryer as $temp=> $value){ 
                    $taricerik = get_post_meta($value->ID, '', true); 
                    $tarimages = get_post_meta( $value->ID, 'icerik_detay_images', 1 );
                   
                
                    if ($temp<1){ 
                        foreach ($tarimages as $key => $imagesurl) {
                        break;
                            }
                        ?>
                        <div class="col-sm-8 p-0 align-items-end w-100 mb-4 cursor imgbrightness"  onclick="location.href='<?=$value->guid; ?>'">
                            <img class="card-img p-0" src='<?=$imagesurl?>' alt="<?=$value->post_title; ?>">
                            <div class="card-img-overlay ">
                                <div class="category2 text-center mb-2 m-100-40-25" style="cursor:pointer;"><?=$taricerik['icerik_detay_select'][0]?></div>
                                <p class="news-title mb-1 " ><?=$value->post_title; ?></p>
                                <p class="text-white news-text"><?=mb_substr($value->post_content,0,140,'UTF-8'); ?>...</p>
                            </div>
                        </div>
                        
                    <?php }else{?>
                        <div class="col-sm-4 p-0 m-0 mb-4 blog-border yazi-decoration cursor brightness-kapsayici">
                            <a href="<?=get_permalink( $value -> ID);?>" class="yazi-decoration ">
                                <div class="col-sm-12 pl-0 pr-0 brightness-cards kucuk-cards-sm" >
                                    <img src='<?=wp_get_attachment_image_url(get_post_thumbnail_id($value->ID),array(245, 165, true));?>' style="width: 100%; height: 100%;">
                                </div>
                                <div class="col-sm-12 pt-2">
                                    <h4><strong class="yazi-decoration brightness-title news-title3"><?=$value -> post_title?></strong></h4>
                                    <p class="font-14 yazi-decoration" style="color:#808080;">
                                        <?=mb_substr($value->post_content,0,160,'UTF-8'); ?>...</p>
                                </div>
                            </a>
                        </div>
                    <?php } ?>
                <?php }?> 
                <div class="col-sm-12 text-right p-0">
                    <a href="<?=$home?>/ozellik/?cat=8&country=0" class="etiketstyle font-18 yazi-decoration" >Tümünü Gör >></a>
                </div>
            </div>
            <!--Eğlence Mekanları-->
            <div class="row">
                <div class="col-sm-12">
                    <div class="row">
                        <div class="col-sm-6">
                        <p class="blog-title">Eğlence Mekanları</p>
                        </div>
                        <div class="col-sm-12">
                            <div class="titlehr"></div>
                        </div>                            
                    </div>
                </div>
            </div>
            <div class="col-sm-12">
                <div class="row ">
                   <?php foreach($eylenceyer as $temp):?>
                        <div class="col-sm-4 p-0 m-0 mb-4 blog-border yazi-decoration cursor brightness-kapsayici">
                            <a href="<?=get_permalink($temp -> ID);?>" class="yazi-decoration ">
                                <div class="col-sm-12 pl-0 pr-0 brightness-cards kucuk-cards-sm ">
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
                        <a href="<?=$home?>/ozellik/?cat=9&country=0" class="etiketstyle font-18 yazi-decoration" >Tümünü Gör >></a>
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
    </div>
</div>
<?php get_footer(); ?>