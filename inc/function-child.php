<?php

/**
 * Fuction yang digunakan di theme ini.
 */
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

add_action('after_setup_theme', 'velocitychild_theme_setup', 20);

function velocitychild_theme_setup()
{
    register_nav_menus(
        array(
            'secondary' => __('Secondary Menu', 'justg'),
        )
    );

    //remove action from Parent Theme
    remove_action('justg_header', 'justg_header_menu');
    remove_action('justg_do_footer', 'justg_the_footer_open');
    remove_action('justg_do_footer', 'justg_the_footer_content');
    remove_action('justg_do_footer', 'justg_the_footer_close');
    remove_theme_support('custom-header');
}

add_action('customize_register', 'velocitychild_customize_register');
function velocitychild_customize_register($wp_customize)
{
    $wp_customize->add_panel('panel_berita', [
        'priority'    => 10,
        'title'       => esc_html__('Berita', 'justg'),
        'description' => esc_html__('', 'justg'),
    ]);

    // Section media banner (tanpa field warna/background).
    $wp_customize->add_section('section_iklanberita', [
        'panel'    => 'panel_berita',
        'title'    => __('Iklan', 'justg'),
        'priority' => 10,
    ]);

    $fieldiklan = [
        'iklan_header'  => [
            'label'       => 'Iklan Header',
            'description' => 'Iklan Halaman Depan 728x90',
        ],
        'iklan_archive'  => [
            'label'       => 'Iklan Archive',
            'description' => 'Iklan Halaman Depan 700x140',
        ],
        'iklan_single1'  => [
            'label'       => 'Iklan Single 1',
            'description' => 'Iklan Halaman Depan 650x100',
        ],
        'iklan_single2'  => [
            'label'       => 'Iklan Single 2',
            'description' => 'Iklan Halaman Depan 650x100',
        ],
        'iklan_home_bawah_1'  => [
            'label'       => 'Iklan Home Bawah 1',
            'description' => 'Iklan Halaman Depan Bawah 600x80',
        ],
        'iklan_home_bawah_2'  => [
            'label'       => 'Iklan Home Bawah 2',
            'description' => 'Iklan Halaman Depan Bawah 600x80',
        ],
    ];

    foreach ($fieldiklan as $idfield => $datafield) {
        $wp_customize->add_setting('image_' . $idfield, [
            'default'           => '',
            'sanitize_callback' => 'esc_url_raw',
        ]);

        $wp_customize->add_control(
            new WP_Customize_Image_Control(
                $wp_customize,
                'image_' . $idfield,
                [
                    'label'       => sprintf(__('Gambar %s', 'justg'), $datafield['label']),
                    'description' => $datafield['description'],
                    'section'     => 'section_iklanberita',
                ]
            )
        );

        $wp_customize->add_setting('link_' . $idfield, [
            'default'           => '',
            'sanitize_callback' => 'esc_url_raw',
        ]);

        $wp_customize->add_control('link_' . $idfield, [
            'type'     => 'url',
            'label'    => sprintf(__('Link %s', 'justg'), $datafield['label']),
            'section'  => 'section_iklanberita',
            'priority' => 10,
        ]);
    }

    $wp_customize->add_section('section_sosmedberita', [
        'panel'    => 'panel_berita',
        'title'    => __('Sosial Media', 'justg'),
        'priority' => 20,
    ]);

    $fieldsosmed = [
        'facebook'  => ['label' => 'Facebook'],
        'twitter'   => ['label' => 'X / Twitter'],
        'instagram' => ['label' => 'Instagram'],
        'youtube'   => ['label' => 'Youtube'],
    ];

    foreach ($fieldsosmed as $idfield => $datafield) {
        $wp_customize->add_setting('link_sosmed_' . $idfield, [
            'default'           => 'https://' . $idfield . '.com/',
            'sanitize_callback' => 'esc_url_raw',
        ]);

        $wp_customize->add_control('link_sosmed_' . $idfield, [
            'type'     => 'url',
            'label'    => sprintf(__('Link %s', 'justg'), $datafield['label']),
            'section'  => 'section_sosmedberita',
            'priority' => 10,
        ]);
    }

    $wp_customize->add_section('section_homeberita', [
        'panel'    => 'panel_berita',
        'title'    => __('Home', 'justg'),
        'priority' => 30,
    ]);

    $fieldposts = [
        'posts_highlight'  => [
            'label'   => 'Posts Highlight',
            'section' => 'section_homeberita',
            'title'   => 'Recent Posts',
        ],
        'posts_home_1'  => [
            'label'   => 'Posts Home 1',
            'section' => 'section_homeberita',
            'title'   => 'Recent Posts',
        ],
        'posts_home_2'  => [
            'label'   => 'Posts Home 2',
            'section' => 'section_homeberita',
            'title'   => 'Recent Posts',
        ],
        'posts_home_3'  => [
            'label'   => 'Posts Home 3',
            'section' => 'section_homeberita',
            'title'   => 'Recent Posts',
        ],
    ];

    $categories = velocitychild_get_category_choices();
    foreach ($fieldposts as $idfield => $datafield) {
        if (isset($datafield['title'])) {
            $wp_customize->add_setting('title_' . $idfield, [
                'default'           => $datafield['title'],
                'sanitize_callback' => 'sanitize_text_field',
            ]);

            $wp_customize->add_control('title_' . $idfield, [
                'type'     => 'text',
                'label'    => sprintf(__('Judul %s', 'justg'), $datafield['label']),
                'section'  => $datafield['section'],
                'priority' => 10,
            ]);
        }

        $wp_customize->add_setting('cat_' . $idfield, [
            'default'           => '',
            'sanitize_callback' => 'velocitychild_sanitize_select',
        ]);

        $wp_customize->add_control('cat_' . $idfield, [
            'type'     => 'select',
            'label'    => sprintf(__('Kategori %s', 'justg'), $datafield['label']),
            'section'  => $datafield['section'],
            'choices'  => $categories,
            'priority' => 10,
        ]);
    }
}

function velocitychild_sanitize_select($value, $setting)
{
    $value = sanitize_text_field($value);
    $control = $setting->manager->get_control($setting->id);
    $choices = $control ? $control->choices : [];

    return isset($choices[$value]) ? $value : $setting->default;
}

function velocitychild_get_category_choices()
{
    $choices = [
        '' => esc_html__('Semua Kategori', 'justg'),
    ];

    $categories = get_categories([
        'taxonomy'   => 'category',
        'hide_empty' => false,
    ]);

    foreach ($categories as $category) {
        if ((int) $category->term_id === 1) {
            continue;
        }
        $choices[(string) $category->term_id] = $category->name;
    }

    return $choices;
}

if (!function_exists('justg_header_open')) {
    function justg_header_open()
    {
        echo '<header id="wrapper-header" class="bg-header header-full relative">';
        echo '<div id="wrapper-navbar" class="wrapper-fluid wrapper-navbar position-relative pb-0 p-md-0 p-2" itemscope itemtype="http://schema.org/WebSite">';
        echo '<div class="container mx-auto px-md-0 bg-transparent">';
    }
}
if (!function_exists('justg_header_close')) {
    function justg_header_close()
    {
        echo '</div>';
        echo '</div>';
        echo '</header>';
    }
}

///add action builder part
add_action('justg_header', 'justg_header_berita');
function justg_header_berita()
{
    require_once(get_stylesheet_directory() . '/inc/part-header.php');
}
add_action('justg_do_footer', 'justg_footer_berita');
function justg_footer_berita()
{
    require_once(get_stylesheet_directory() . '/inc/part-footer.php');
}

function velocity_child_no_image_url()
{
    return get_stylesheet_directory_uri() . '/img/no-image.webp';
}

function velocity_child_post_thumbnail_url($post_id = 0, $size = 'full')
{
    $post_id = $post_id ? absint($post_id) : get_the_ID();
    if (!$post_id) {
        return velocity_child_no_image_url();
    }

    $thumbnail_url = get_the_post_thumbnail_url($post_id, $size);
    if ($thumbnail_url) {
        return $thumbnail_url;
    }

    return velocity_child_no_image_url();
}

function velocity_child_post_thumbnail_html($args = [])
{
    $defaults = [
        'post_id'    => 0,
        'size'       => 'full',
        'class'      => 'img-fluid w-100 h-100 object-fit-cover',
        'linked'     => true,
        'link_class' => 'd-block w-100 h-100',
        'alt'        => '',
        'loading'    => 'lazy',
    ];
    $args = wp_parse_args($args, $defaults);

    $post_id = $args['post_id'] ? absint($args['post_id']) : get_the_ID();
    if (!$post_id) {
        return '';
    }

    $img_url = velocity_child_post_thumbnail_url($post_id, $args['size']);
    $img_alt = $args['alt'] !== '' ? $args['alt'] : wp_strip_all_tags(get_the_title($post_id));
    $img_html = '<img src="' . esc_url($img_url) . '" class="' . esc_attr($args['class']) . '" alt="' . esc_attr($img_alt) . '" loading="' . esc_attr($args['loading']) . '">';

    if (!$args['linked']) {
        return $img_html;
    }

    return '<a class="' . esc_attr($args['link_class']) . '" href="' . esc_url(get_permalink($post_id)) . '" title="' . esc_attr(get_the_title($post_id)) . '">' . $img_html . '</a>';
}

function get_berita_iklan($idiklan = null)
{
    if (!$idiklan) {
        return;
    }

    $iklan_content  = velocitytheme_option('image_' . $idiklan, '');
    if ($iklan_content) {
        $linkiklan = velocitytheme_option('link_' . $idiklan, '');
        echo '<div class="media-slot text-center">';
        echo $linkiklan ? '<a href="' . esc_url($linkiklan) . '" target="_blank" rel="noopener noreferrer">' : '';
        echo '<img class="img-fluid w-100" src="' . esc_url($iklan_content) . '" loading="lazy" alt="">';
        echo $linkiklan ? '</a>' : '';
        echo '</div>';
    }
}

function vdberita_limit_text($text, $limit)
{
    if (str_word_count($text, 0) > $limit) {
        $words = str_word_count($text, 2);
        $pos   = array_keys($words);
        $text  = substr($text, 0, $pos[$limit]) . '...';
    }
    return $text;
}

function velocity_child_get_post_views()
{
    // Prioritas ambil view dari plugin velocity-addons.
    if (shortcode_exists('velocity-hits')) {
        return trim(wp_strip_all_tags(do_shortcode('[velocity-hits format="number"]')));
    }

    return '';
}

function velocity_child_post_meta_html($date_format = 'j F Y', $show_views = true)
{
    $post_id = get_the_ID();
    if (!$post_id) {
        return '';
    }

    $output = '<small><span class="align-middle">' . velocity_child_icon_svg('calendar', 'me-1') . '</span> <span class="align-middle">' . esc_html(get_the_date($date_format, $post_id)) . '</span>';
    if ($show_views) {
        $views = velocity_child_get_post_views();
        if ($views !== '') {
            $output .= ' / <span class="align-middle">' . velocity_child_icon_svg('eye', 'me-1') . '</span> <span class="align-middle">' . esc_html($views) . '</span>';
        }
    }
    $output .= '</small>';

    return $output;
}

function velocity_child_icon_svg($icon, $class = '')
{
    $icons = [
        'calendar' => [
            'viewBox' => '0 0 16 16',
            'path'    => '<path d="M11 6.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5z"/> <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5M1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4z"/>',
        ],
        'eye' => [
            'viewBox' => '0 0 16 16',
            'path'    => '<path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13 13 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5s3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5s-3.879-1.168-5.168-2.457A13 13 0 0 1 1.172 8z"/> <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0"/>',
        ],
        'search' => [
            'viewBox' => '0 0 16 16',
            'path'    => '<path d="M11.742 10.344a6.5 6.5 0 1 0-1.398 1.398h-.001l3.85 3.85a1 1 0 0 0 1.414-1.414zm-5.242.656a5 5 0 1 1 0-10 5 5 0 0 1 0 10"/>',
        ],
        'file-text' => [
            'viewBox' => '0 0 16 16',
            'path'    => '<path d="M5 7h6v1H5zm0 2h6v1H5zm0 2h4v1H5z"/><path d="M4 0h5.5L14 4.5V15a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V1a1 1 0 0 1 1-1m5 1v3.5a.5.5 0 0 0 .5.5H13z"/>',
        ],
        'chevron-left' => [
            'viewBox' => '0 0 16 16',
            'path'    => '<path fill-rule="evenodd" d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0"/>',
        ],
        'chevron-right' => [
            'viewBox' => '0 0 16 16',
            'path'    => '<path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708"/>',
        ],
        'caret-left-fill' => [
            'viewBox' => '0 0 16 16',
            'path'    => '<path d="M10 12V4l-6 4z"/>',
        ],
        'caret-right-fill' => [
            'viewBox' => '0 0 16 16',
            'path'    => '<path d="m6 12 6-4-6-4z"/>',
        ],
        'pencil-square' => [
            'viewBox' => '0 0 16 16',
            'path'    => '<path d="M15.502 1.94a.5.5 0 0 1 0 .706l-1.75 1.75-2-2 1.75-1.75a.5.5 0 0 1 .707 0z"/><path d="M11.061 3.106 3 11.168V13h1.832l8.061-8.061z"/><path fill-rule="evenodd" d="M1 13.5V1a1 1 0 0 1 1-1h9.293L10.293 1H2v12h12V5.707l1-1V13.5a1 1 0 0 1-1 1h-12a1 1 0 0 1-1-1"/>',
        ],
        'person-fill' => [
            'viewBox' => '0 0 16 16',
            'path'    => '<path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1z"/><path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6"/>',
        ],
        'clock' => [
            'viewBox' => '0 0 16 16',
            'path'    => '<path d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71z"/><path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16m7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0"/>',
        ],
        'card-list' => [
            'viewBox' => '0 0 16 16',
            'path'    => '<path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2z"/><path d="M5 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 5 8m0-2.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5m0 5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5m-1-5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0M4 8a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0m0 2.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0"/>',
        ],
    ];

    if (!isset($icons[$icon])) {
        return '';
    }

    $svg_class = trim('bi align-middle bi-' . $icon . ' ' . $class);
    return '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="' . esc_attr($svg_class) . '" viewBox="' . esc_attr($icons[$icon]['viewBox']) . '" aria-hidden="true" focusable="false">' . $icons[$icon]['path'] . '</svg>';
}
