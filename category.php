<?php
/**
 * 
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Puzzle_Blog
 */

get_header(); ?>

<?php

while ( have_posts() ) : the_post();
$content = get_post_meta(get_the_ID(), '', true);?>
//printarr($content); 


<div class="container mt-5">
    <div class="row">
        <div class="col-sm-4 blog-home-1 align-items-end w-100">
            <div class="category text-center">TARİHİ MEKAN</div>
            <p class="news-title">Kıbrısta mutlaka görmeniz gereken
                10 tarihi mekan!</p>
            <p class="text-white news-text">Lorem Ipsum, dizgi ve baskı endüstrisinde kullanılan mıgır metinlerdir....</p>
        </div>
        <div class="col-sm-4 blog-home-1 align-items-end w-100">
            <div class="category text-center">TARİHİ MEKAN</div>
            <p class="news-title">Kıbrısta mutlaka görmeniz gereken
                10 tarihi mekan!</p>
            <p class="text-white news-text">Lorem Ipsum, dizgi ve baskı endüstrisinde kullanılan mıgır metinlerdir....</p>
        </div>
        <div class="col-sm-4 blog-home-1 align-items-end w-100">
            <div class="category text-center">TARİHİ MEKAN</div>
            <p class="news-title">Kıbrısta mutlaka görmeniz gereken
                10 tarihi mekan!</p>
            <p class="text-white news-text">Lorem Ipsum, dizgi ve baskı endüstrisinde kullanılan mıgır metinlerdir....</p>
        </div>
    </div>
</div>

<?php
endwhile;
get_footer();
