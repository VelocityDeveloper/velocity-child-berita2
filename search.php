<?php

/**
 * The template for displaying search results pages
 *
 * @package justg
 */

defined('ABSPATH') || exit;

get_header();

get_template_part(
    'loop-templates/layout',
    'archive-like',
    [
        'wrapper_id'   => 'search-wrapper',
        'header_title' => sprintf(
            esc_html__('Search Results for: %s', 'justg'),
            esc_html(get_search_query())
        ),
        'header_desc'  => '',
    ]
);

get_footer();
