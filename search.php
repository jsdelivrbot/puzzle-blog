<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Puzzle_Blog
 */

get_header();
	$query = get_search_query();
	$taxonmy = explode('=', $query)[0];
	$term = explode('=', $query)[1];
	$type = get_query_var('post_type');

	$args = array(
    'posts_per_page'   => 99,
    'offset'           => 0,
    'category'         => '',
    'category_name'    => '',
    'orderby'          => 'date',
    'order'            => 'DESC',
    'include'          => '',
    'exclude'          => '',
    'meta_key'         => '',
    'meta_value'       => '',
    'post_type'        => $type,
    'post_mime_type'   => '',
    'post_parent'      => '',
    'author'           => '',
    'author_name'      => '',
    'post_status'      => 'publish',
    'suppress_filters' => true,
    'tax_query' => array(
        array(
            'taxonomy' => $taxonmy,
            'field' => 'slug',
            'terms' => $term,
        )
      )
	);

	$temps = get_posts( $args );

	if ( is_array($temps) && count($temps) > 0){
		if($type === "hotel") get_template_part( 'template-search/content', 'hotel-search' );
	}
	else{
		get_template_part( 'template-parts/content', 'none' );
	}
get_footer();