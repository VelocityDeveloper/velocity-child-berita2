<?php
/**
 * Shared archive-like layout for archive and author pages.
 *
 * @package justg
 */

defined('ABSPATH') || exit;

$wrapper_id   = !empty($args['wrapper_id']) ? sanitize_html_class($args['wrapper_id']) : 'archive-wrapper';
$header_title = isset($args['header_title']) ? $args['header_title'] : '';
$header_desc  = isset($args['header_desc']) ? $args['header_desc'] : '';
$container    = velocitytheme_option('justg_container_type', 'container');
?>

<div class="wrapper" id="<?php echo esc_attr($wrapper_id); ?>">

    <div class="<?php echo esc_attr($container); ?>" id="content" tabindex="-1">

        <div class="card-breadcrumbs pt-2 px-3 mb-3">
            <?php echo justg_breadcrumb(); ?>
        </div>

        <div class="row">
            <?php do_action('justg_before_content'); ?>

            <main class="site-main col order-2 px-0" id="main">

                <?php if (have_posts()) : ?>
                    <header class="page-header block-primary">
                        <h4 class="fw-bold d-inline-block mb-0"><?php echo wp_kses_post($header_title); ?></h4>
                        <?php if (!empty($header_desc)) : ?>
                            <div class="taxonomy-description"><?php echo wp_kses_post($header_desc); ?></div>
                        <?php endif; ?>
                    </header>

                    <div class="my-3">
                        <?php get_berita_iklan('iklan_archive'); ?>
                    </div>

                    <?php while (have_posts()) : the_post(); ?>
                        <article class="block-primary mb-4">
                            <div class="row">
                                <div class="col-md-4 col-5 pe-2">
                                    <div class="post-tumbnail position-relative">
                                        <a href="<?php echo esc_url(get_permalink()); ?>">
                                            <div class="ratio ratio-4x3">
                                                <?php echo velocity_child_post_thumbnail_html(['size' => 'medium', 'linked' => false]); ?>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-md-8 col-7 ps-2">
                                    <div class="post-text">
                                        <?php
                                        the_title(
                                            sprintf('<h5 class="fw-bold m-0"><a href="%s" rel="bookmark">', esc_url(get_permalink())),
                                            '</a></h5>'
                                        );
                                        ?>
                                        <div class="post-date text-muted py-2"><?php echo esc_html(get_the_date('j F Y')); ?></div>
                                        <div class="post-excerpt d-md-block d-none">
                                            <?php echo esc_html(vdberita_limit_text(strip_tags(get_the_content()), 15)); ?>
                                            <div class="py-2">
                                                <a class="btn btn-sm bg-color-theme text-white" href="<?php echo esc_url(get_the_permalink()); ?>">
                                                    <small>READ MORE</small>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </article>
                    <?php endwhile; ?>
                <?php else : ?>
                    <?php get_template_part('loop-templates/content', 'none'); ?>
                <?php endif; ?>

                <?php justg_pagination(); ?>
            </main>

            <?php do_action('justg_after_content'); ?>
        </div>

        <div class="row my-2">
            <div class="col-md-6 pe-md-1 my-1"><?php echo get_berita_iklan('iklan_home_bawah_1'); ?></div>
            <div class="col-md-6 ps-md-1 my-1"><?php echo get_berita_iklan('iklan_home_bawah_2'); ?></div>
        </div>

        <div class="velocity-bottom">
            <div class="row velocity-row text-start">
                <?php for ($x = 1; $x <= 4; $x++) : ?>
                    <?php if (is_active_sidebar('bottom-sidebar' . $x)) : ?>
                        <div class="col-md p-md-2">
                            <?php dynamic_sidebar('bottom-sidebar' . $x); ?>
                        </div>
                    <?php endif; ?>
                <?php endfor; ?>
            </div>
        </div>

    </div>

</div>
