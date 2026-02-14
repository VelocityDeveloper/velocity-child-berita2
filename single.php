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
$format     = get_post_format() ?: 'standard';
?>

<div class="wrapper" id="single-wrapper">

    <div class="<?php echo esc_attr($container); ?>" id="content" tabindex="-1">

        <div class="card-breadcrumbs pt-2 px-3 mb-3">
            <?php echo justg_breadcrumb(); ?>
        </div>

        <div class="row">

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
                        <?php echo velocity_child_icon_svg('person-fill'); ?>
                        <span class="align-middle"><a href="<?php echo $author_link; ?>"><?php echo get_the_author(); ?></a></span>
                        <div class="px-2 d-inline-block">
                            <?php echo velocity_child_icon_svg('clock'); ?>
                            <span class="align-middle"><?php echo get_the_date('j F Y, H:i a'); ?></span>
                        </div>
                        <?php $post_views = velocity_child_get_post_views(); ?>
                        <?php if ($post_views !== '') : ?>
                            <div class="px-2 d-inline-block">
                                <?php echo velocity_child_icon_svg('eye'); ?>
                                <span class="align-middle"><?php echo esc_html($post_views); ?></span>
                            </div>
                        <?php endif; ?>
                        <?php $getcategories = get_the_category(get_the_ID()); ?>
                        <?php if ($getcategories) : ?>
                            <div class="px-2 d-inline-block">
                                <?php echo velocity_child_icon_svg('card-list'); ?>
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
                            <?php
                            if ($format !== 'video') {
                                $thumbnail_id = get_post_thumbnail_id(get_the_ID());
                                $thumbnail_caption = $thumbnail_id ? wp_get_attachment_caption($thumbnail_id) : '';
                                echo '<figure class="mb-2">';
                                echo '<div class="ratio ratio-16x9">';
                                echo velocity_child_post_thumbnail_html(['post_id' => get_the_ID(), 'size' => 'full', 'linked' => false, 'class' => 'img-fluid w-100 h-100 object-fit-cover']);
                                echo '</div>';
                                if ($thumbnail_caption) {
                                    echo '<figcaption class="mt-2 text-muted small">' . esc_html($thumbnail_caption) . '</figcaption>';
                                }
                                echo '</figure>';
                            }
                            ?>

                        <?php the_content(); ?>
                        <div class="pb-3">
                            <?php edit_post_link(__('Edit', 'justg'), '<span class="edit-link">' . velocity_child_icon_svg('pencil-square', 'me-1') . ' ', '</span>'); ?>
                        </div>

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
                                    echo '<a href="' . get_permalink($prev_post->ID) . '" class="btn btn-sm text-start text-theme" title="' . $prev_post->post_title . '">' . velocity_child_icon_svg('chevron-left', 'me-2') . $prev_post->post_title . '</a>';
                                }
                                $next_post = get_adjacent_post(false, '', false);
                                if (!empty($next_post)) {
                                    echo '<a href="' . get_permalink($next_post->ID) . '" class="btn btn-sm text-end text-theme" title="' . $next_post->post_title . '">' . $next_post->post_title . velocity_child_icon_svg('chevron-right', 'ms-2') . '</a>';
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
