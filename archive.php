<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Puzzle_Blog
 */

get_header(); ?>

<?php
if (isset($_GET["cat"]) || isset($_GET["city"])) {
$yerozellik=$_GET["cat"];
$city=$_GET["city"];
printarr($city); 
}

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
            'value'       => $city,
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
            'field' => $yerozellik,
            'terms' => $yerozellik,
        )
         
    )
);

$yer = get_posts( $args );
printarr($yer); ?>

<div class="container  pt-5">
    <div class="row">
        <div class="col-sm-8">
            <div class="row">
                <!--Gezilecek Yerler-->
                <div class="col-sm-12 pl-0">
                    <div class="row">
                        <div class="col-sm-6">
                            <p class="blog-title">Gezilecek Yerler</p>
                        </div>
                        <div class="col-sm-12">
                            <hr class="blog-hr">
                        </div>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="row justify-content-between">
                        <div class="col-sm-4 mb-4 pl-0 pr-0">
	                        <div class="col-sm-11 blog-border pl-0 pr-0">
	                            <div class="col-sm-12 pl-0 pr-0">
	                                <img class="img-fluid" src="img/1.png" alt="">
	                            </div>
	                            <div class="col-sm-12 pt-2">
	                                <h4><strong>Göynük Kanyonu</strong></h4>
	                                <p class="font-13">
	                                    Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat.
	                                    Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. <span class="font-13 font-weight-bold color-orange">Devamını Oku...</span></p>
	                            </div>
	                        </div>
                   		</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
get_footer();
