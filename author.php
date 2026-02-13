<?php

/**
 * The template for displaying author pages
 *
 * @package justg
 */

defined('ABSPATH') || exit;

get_header();

$author = get_queried_object();
$author_name = $author && isset($author->display_name) ? $author->display_name : '';
$author_desc = $author && !empty($author->description) ? wpautop($author->description) : '';

get_template_part(
    'loop-templates/layout',
    'archive-like',
    [
        'wrapper_id'   => 'author-wrapper',
        'header_title' => sprintf('%s %s', esc_html__('Author:', 'justg'), esc_html($author_name)),
        'header_desc'  => $author_desc,
    ]
);

get_footer();
