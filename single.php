<?php

/**
 * The template for displaying all single posts
 *
 * @package justg
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

get_header();
$container  = velocitytheme_option('justg_container_type', 'container');
$full_url   = get_the_post_thumbnail_url(get_the_ID(), 'full');
$format     = get_post_format() ?: 'standard';
?>

<div class="wrapper" id="single-wrapper">

    <div class="<?php echo esc_attr($container); ?>" id="content" tabindex="-1">

        <div class="card-breadcrumbs pt-2 px-3 mb-3">
            <?php echo justg_breadcrumb(); ?>
        </div>

        <div class="row m-0 mx-md-2">

            <!-- Do the left sidebar check -->
            <?php do_action('justg_before_content'); ?>

            <main class="site-main col order-2" id="main">

                <?php

                while (have_posts()) {
                    the_post();
                    $author_id = get_post_field('post_author', get_the_ID());
                    $author_link = get_author_posts_url($author_id);
                ?>

                    <?php the_title('<h1 class="entry-title h4 fw-bold">', '</h1>'); ?>

                    <div class="text-secondary velocity-post-info">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
                            <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6" />
                        </svg>
                        <span class="align-middle"><a href="<?php echo $author_link; ?>"><?php echo get_the_author(); ?></a></span>
                        <div class="px-2 d-inline-block">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-clock" viewBox="0 0 16 16">
                                <path d="M8 3.5a.5.5 0 0 0-1 0V9a.5.5 0 0 0 .252.434l3.5 2a.5.5 0 0 0 .496-.868L8 8.71z" />
                                <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16m7-8A7 7 0 1 1 1 8a7 7 0 0 1 14 0" />
                            </svg>
                            <span class="align-middle"><?php echo get_the_date('j F Y, H:i a'); ?></span>
                        </div>
                        <?php $getcategories = get_the_category(get_the_ID()); ?>
                        <?php if ($getcategories) : ?>
                            <div class="px-2 d-inline-block">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-card-list" viewBox="0 0 16 16">
                                    <path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2z" />
                                    <path d="M5 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 5 8m0-2.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5m0 5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5m-1-5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0M4 8a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0m0 2.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0" />
                                </svg>
                                <span class="align-middle">
                                    <?php foreach ($getcategories as $index => $term) : ?>
                                        <?php echo $index === 0 ? '' : ','; ?>
                                        <a href="<?php echo get_tag_link($term->term_id); ?>"> <?php echo $term->name; ?> </a>
                                        <?php if ($index > 1) {
                                            break;
                                        } ?>
                                    <?php endforeach; ?>
                                </span>
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="entry-content">
                        <div class="my-3">
                            <?php get_berita_iklan('iklan_single1'); ?>
                        </div>
                        <div class="ratio ratio-16x9 mb-2">
                            <?php
                            if ($full_url && $format !== 'video') {
                                echo '<img class="img-fluid w-100 mb-2" src="' . $full_url . '" loading="lazy">';
                            }
                            ?>
                        </div>

                        <?php the_content(); ?>
                        <div class="pb-3">
                            <?php edit_post_link(__('Edit', 'justg'), '<span class="edit-link"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> ', '</span>'); ?>
                        </div>
                        <?php get_berita_iklan('iklan_content_2'); ?>

                        <?php
                        wp_link_pages(
                            array(
                                'before' => '<div class="page-links">' . __('Pages:', 'justg'),
                                'after'  => '</div>',
                            )
                        );
                        ?>
                    </div><!-- .entry-content -->

                    <div class="card rounded-0 p-3">
                        <div class="share-post">
                            <?php echo justg_share(); ?>
                        </div>
                    </div>

                    <div class="my-3">
                        <?php get_berita_iklan('iklan_single2'); ?>
                    </div>

                    <div class="single-post-nav my-3">
                        <div class="nav-post">
                            <div class="d-md-flex justify-content-between pt-1 btn-group" role="group" aria-label="Navigation Post">
                                <?php
                                $prev_post = get_adjacent_post(false, '', true);
                                if (!empty($prev_post)) {
                                    echo '<a href="' . get_permalink($prev_post->ID) . '" class="btn btn-sm text-start text-theme" title="' . $prev_post->post_title . '"><i class="fa fa-angle-left me-2" aria-hidden="true"></i>' . $prev_post->post_title . '</a>';
                                }
                                $next_post = get_adjacent_post(false, '', false);
                                if (!empty($next_post)) {
                                    echo '<a href="' . get_permalink($next_post->ID) . '" class="btn btn-sm text-end text-theme" title="' . $next_post->post_title . '">' . $next_post->post_title . '<i class="fa fa-angle-right ms-2" aria-hidden="true"></i></a>';
                                }
                                ?>
                            </div>
                        </div>
                    </div>

                    <div class="related-post">
                        <h4 class="widget-title velocity-title text-white mb-3">
                            <span class="d-inline-block bg-color-theme py-1 px-3">Berita Terkait</span>
                        </h4>

                        <div class="related-post">
                            <?php
                            module_vdposts(array(
                                'post_type'         => 'post',
                                'posts_per_page'    => 4,
                                'post__not_in'      => [get_the_ID()],
                                'category__in'      => wp_get_post_categories(get_the_ID()),
                            ), 'posts6');
                            ?>
                        </div>
                    </div>

                <?php

                    // If comments are open or we have at least one comment, load up the comment template.
                    if (comments_open() || get_comments_number()) {
                        do_action('justg_before_comments');
                        comments_template();
                        do_action('justg_after_comments');
                    }
                }
                ?>

            </main><!-- #main -->

            <!-- Do the right sidebar check. -->
            <?php do_action('justg_after_content'); ?>

        </div><!-- .row -->

    </div><!-- #content -->

</div><!-- #single-wrapper -->

<?php
get_footer();
