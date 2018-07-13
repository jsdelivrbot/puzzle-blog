<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Puzzle_Blog
 */

 get_header(); ?>
<div class="container">
    <br>
<div class="col-sm-12 text-center">
    <h1 class="p-20"> <strong>HATA</strong></h1>
    <h1></strong>Sayfa Bulunamadı!</strong></h1>
    <br>
    <div class="d-flex align-items-end">
        <img src="<?php bloginfo('template_url'); ?>/img/404.png" class="img-fluid rounded mx-auto d-block"> 
    </div>
</div>
</div>
<?php get_footer(); ?>
