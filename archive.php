<?php

/**
 * The template for displaying archive pages
 *
 * @package justg
 */

defined('ABSPATH') || exit;

get_header();

get_template_part(
    'loop-templates/layout',
    'archive-like',
    [
        'wrapper_id'   => 'archive-wrapper',
        'header_title' => get_the_archive_title(),
        'header_desc'  => get_the_archive_description(),
    ]
);

get_footer();
