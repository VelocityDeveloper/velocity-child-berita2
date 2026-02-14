<?php

/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package justg
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

get_header();

$container = velocitytheme_option('justg_container_type', 'container');
?>

<div class="wrapper" id="index-wrapper">

    <div class="container p-0">
        <div class="row m-0">
            <div class="col-md-8 px-0">
                <?php
                // The Query
                $posts_query = new WP_Query(
                    array(
                        'post_type'         => 'post',
                        'posts_per_page'    => 3,
                    )
                );
                // The Loop
                $nm = 1;
                if ($posts_query->have_posts()) { ?>
                    <div id="carouselHome" class="carousel slide carousel-fade" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            <?php
                            while ($posts_query->have_posts()) {
                                $posts_query->the_post();
                            ?>
                                <div class="slideshow-post-item carousel-item  <?php echo ($nm == 1 ? 'active' : ''); ?>">
                                    <a class="d-block position-relative" href="<?php echo get_the_permalink(); ?>">
                                        <div class="d-none d-md-block ratio ratio-16x9 bg-light overflow-hidden">
                                            <?php echo velocity_child_post_thumbnail_html(['size' => 'large', 'linked' => false]); ?>
                                        </div>
                                        <div class="d-md-none d-block ratio ratio-4x3 bg-light overflow-hidden">
                                            <?php echo velocity_child_post_thumbnail_html(['size' => 'large', 'linked' => false]); ?>
                                        </div>
                                        <div class="carousel-caption text-start bg-darkopacity p-2">
                                            <h6 class="title-carousel fw-bold text-white text-shadow"><?php echo vdberita_limit_text(get_the_title(), 10); ?></h6>
                                        </div>
                                    </a>
                                </div>
                            <?php
                                $nm++;
                            }
                            $nm = 0; ?>
                        </div>
                        <div class="carousel-indicators">
                            <?php
                            while ($posts_query->have_posts()) :
                                $posts_query->the_post();
                                echo '<button type="button" data-bs-target="#carouselHome" data-bs-slide-to="' . $nm . '" ' . ($nm == 0 ? 'class="active"' : '') . ' aria-current="true" aria-label="Slide ' . $nm . '"></button>';
                                $nm++;
                            endwhile; ?>
                        </div>
                    </div>
                <?php
                }
                /* Restore original Post Data */
                wp_reset_postdata();
                ?>
            </div>
            <div class="col-md-4 d-none d-md-block p-0">
                <?php
                // The Query
                $posts_query2 = new WP_Query(
                    array(
                        'post_type'         => 'post',
                        'posts_per_page'    => 2,
                        'offset'    => 5,
                    )
                );
                if ($posts_query2->have_posts()) :
                    while ($posts_query2->have_posts()) :
                        $posts_query2->the_post(); ?>
                        <div class="position-relative">
                            <div class="ratio ratio-16x9">
                                <?php echo velocity_child_post_thumbnail_html(); ?>
                            </div>
                            <div class="post-text position-absolute bg-darkopacity start-0 bottom-0 p-3">
                                <h6 class="m-0">
                                    <a class="text-white text-shadow fw-bold" href="<?php echo get_the_permalink(); ?>" title="<?php echo get_the_title(); ?>">
                                        <?php echo vdberita_limit_text(get_the_title(), 8); ?>
                                    </a>
                                </h6>
                            </div>
                        </div>
                <?php
                    endwhile;
                endif;
                ?>
            </div>
        </div>

        <?php $tags = get_terms(array(
            'taxonomy' => 'post_tag',
            'orderby' => 'count',
            'order' => 'DESC',
            'number' => 5,
        ));
        if (!empty($tags)) :
            echo '<div class="row align-items-stretch bg-light m-0">';
            echo '<div class="col-sm-3 col-md-2 px-0 bg-color-theme text-white py-1 align-items-center d-flex"><div class="text-center col-12 p-0 secondary-font">TRENDING</div></div>';
            echo '<div class="col-sm-9 col-md-10 pe-0 text-start align-items-center d-flex"><div class="col-12 p-0">';
            foreach ($tags as $tag) :
                echo '<a class="py-2 px-3 d-inline-block text-theme" href="' . esc_url(get_term_link($tag->term_id)) . '">' . esc_attr('#' . $tag->name) . '</a>';
            endforeach;
            echo '</div></div>';
            echo '</div>';
        endif;
        ?>
    </div>

    <div class="<?php echo esc_attr($container); ?>" id="content" tabindex="-1">
        <div class="row">
            <!-- Do the left sidebar check -->
            <?php do_action('justg_before_content'); ?>

            <div class="col-md mb-3">

                <main class="site-main col order-2" id="main">

                    <?php
                    $highlight_title = velocitytheme_option('title_posts_highlight', 'Recent Posts');
                    $highlight_title = $highlight_title ? $highlight_title : 'Recent Posts';
                    $highlight_cat = absint(velocitytheme_option('cat_posts_highlight'));
                    $highlight_cat_link = $highlight_cat ? get_category_link($highlight_cat) : '';
                    ?>
                    <div class="post-hightlight">
                        <h4 class="widget-title velocity-title text-white mb-3">
                            <span class="d-inline-block bg-color-theme py-1 px-3">
                                <?php if ($highlight_cat && !is_wp_error($highlight_cat_link)) : ?>
                                    <a class="text-white" href="<?php echo esc_url($highlight_cat_link); ?>"><?php echo esc_html($highlight_title); ?></a>
                                <?php else : ?>
                                    <?php echo esc_html($highlight_title); ?>
                                <?php endif; ?>
                            </span>
                        </h4>
                        <div class="part-hightlight">
                            <div class="part-carousel-home bg-muted">
                                <?php
                                $highlight_args = array(
                                    'post_type' => 'post',
                                    'posts_per_page' => 8,
                                );
                                if ($highlight_cat) {
                                    $highlight_args['cat'] = $highlight_cat;
                                }
                                module_vdposts($highlight_args, 'carousel'); ?>
                            </div>
                        </div>
                    </div>

                    <?php
                    $post1_title = velocitytheme_option('title_posts_home_1', 'Recent Posts');
                    $post1_title = $post1_title ? $post1_title : 'Recent Posts';
                    $post1_cat = absint(velocitytheme_option('cat_posts_home_1'));
                    $post1_cat_link = $post1_cat ? get_category_link($post1_cat) : '';
                    ?>
                    <div class="part-posts-home-1 pt-3">
                        <h4 class="widget-title velocity-title text-white mb-3">
                            <span class="d-inline-block bg-color-theme py-1 px-3">
                                <?php if ($post1_cat && !is_wp_error($post1_cat_link)) : ?>
                                    <a class="text-white" href="<?php echo esc_url($post1_cat_link); ?>"><?php echo esc_html($post1_title); ?></a>
                                <?php else : ?>
                                    <?php echo esc_html($post1_title); ?>
                                <?php endif; ?>
                            </span>
                        </h4>

                        <div class="part_posts_home_1">
                            <div class="row">
                                <div class="col-md-6 pe-md-1">
                                    <?php
                                    $post1_args = array(
                                        'post_type' => 'post',
                                        'posts_per_page' => 1,
                                    );
                                    if ($post1_cat) {
                                        $post1_args['cat'] = $post1_cat;
                                    }
                                    module_vdposts($post1_args, 'posts1');
                                    ?>
                                </div>
                                <div class="col-md-6 ps-md-1">
                                    <?php
                                    $post1_args = array(
                                        'post_type' => 'post',
                                        'posts_per_page' => 4,
                                        'offset' => 1,
                                    );
                                    if ($post1_cat) {
                                        $post1_args['cat'] = $post1_cat;
                                    }
                                    module_vdposts($post1_args, 'posts2');
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php
                    $post2_title = velocitytheme_option('title_posts_home_2', 'Recent Posts');
                    $post2_title = $post2_title ? $post2_title : 'Recent Posts';
                    $post2_cat = absint(velocitytheme_option('cat_posts_home_2'));
                    $post2_cat_link = $post2_cat ? get_category_link($post2_cat) : '';
                    ?>
                    <div class="part_posts_home_2 py-2">
                        <h4 class="widget-title velocity-title text-white mb-3">
                            <span class="d-inline-block bg-color-theme py-1 px-3">
                                <?php if ($post2_cat && !is_wp_error($post2_cat_link)) : ?>
                                    <a class="text-white" href="<?php echo esc_url($post2_cat_link); ?>"><?php echo esc_html($post2_title); ?></a>
                                <?php else : ?>
                                    <?php echo esc_html($post2_title); ?>
                                <?php endif; ?>
                            </span>
                        </h4>

                        <div class="row">
                            <div class="col-md-6 pe-md-1">
                                <div class="part-post-home-2 pb-2">
                                    <?php
                                    $post2_args = array(
                                        'post_type' => 'post',
                                        'posts_per_page' => 1,
                                    );
                                    if ($post2_cat) {
                                        $post2_args['cat'] = $post2_cat;
                                    }
                                    echo module_vdposts($post2_args, 'posts1'); ?>
                                </div>
                            </div>
                            <div class="col-md-6 ps-md-1">
                                <div class="part-post-home-2 p-3 bg-color-theme h-100">
                                    <?php
                                    $post2_args = array(
                                        'post_type' => 'post',
                                        'posts_per_page' => 5,
                                        'offset'    => 1,
                                    );
                                    if ($post2_cat) {
                                        $post2_args['cat'] = $post2_cat;
                                    }
                                    echo module_vdposts($post2_args, 'postslist'); ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php
                    $post3_title = velocitytheme_option('title_posts_home_3', 'Recent Posts');
                    $post3_title = $post3_title ? $post3_title : 'Recent Posts';
                    $post3_cat = absint(velocitytheme_option('cat_posts_home_3'));
                    $post3_cat_link = $post3_cat ? get_category_link($post3_cat) : '';
                    ?>
                    <div class="part_posts_home_3 mt-3">
                        <h4 class="widget-title velocity-title text-white mb-3">
                            <span class="d-inline-block bg-color-theme py-1 px-3">
                                <?php if ($post3_cat && !is_wp_error($post3_cat_link)) : ?>
                                    <a class="text-white" href="<?php echo esc_url($post3_cat_link); ?>"><?php echo esc_html($post3_title); ?></a>
                                <?php else : ?>
                                    <?php echo esc_html($post3_title); ?>
                                <?php endif; ?>
                            </span>
                        </h4>

                        <div class="part-post-home-3">
                            <?php
                            $post3_args = array(
                                'post_type' => 'post',
                                'posts_per_page' => 1,
                            );
                            if ($post3_cat) {
                                $post3_args['cat'] = $post3_cat;
                            }
                            $post3_query = new WP_Query($post3_args);

                            if ($post3_query->have_posts()) :
                                while ($post3_query->have_posts()) :
                                    $post3_query->the_post(); ?>
                                    <div class="posts-items row">
                                        <div class="col-md-6 pe-md-1 mb-2 mb-md-0">
                                            <div class="border ratio ratio-4x3 mb-2">
                                                <?php echo velocity_child_post_thumbnail_html(['size' => 'medium']); ?>
                                            </div>
                                        </div>
                                        <div class="col-md-6 ps-md-1">
                                            <div class="border post-text p-2">
                                                <h5>
                                                    <a class="fw-bold d-block" href="<?php echo get_the_permalink(); ?>"><?php echo get_the_title(); ?></a>
                                                </h5>
                                                <div class="post-excerpt mb-2 text-muted">
                                                    <?php echo vdberita_limit_text(strip_tags(get_the_content()), 25); ?>
                                                </div>
                                                <hr />
                                                <?php
                                                $post3sub_args = array(
                                                    'post_type' => 'post',
                                                    'posts_per_page' => 2,
                                                    'offset'    => 1
                                                );
                                                if ($post3_cat) {
                                                    $post3sub_args['cat'] = $post3_cat;
                                                }
                                                $post3sub_query = new WP_Query($post3sub_args);
                                                if ($post3sub_query->have_posts()) :
                                                    echo '<div class="row m-0">';
                                                    while ($post3sub_query->have_posts()) :
                                                        $post3sub_query->the_post();
                                                        echo '<div class="col-md-6 px-1 pb-2">';
                                                        echo '<h6 class="fw-bold m-0"><a href="' . get_the_permalink() . '">' . get_the_title() . '</a></h6>';
                                                        echo '</div>';
                                                    endwhile;
                                                    echo '</div>';
                                                endif;
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                            <?php
                                endwhile;
                            endif;
                            ?>
                        </div>
                    </div>

                </main><!-- #main -->
            </div>
            <!-- Do the right sidebar check. -->
            <?php do_action('justg_after_content'); ?>
        </div><!-- .row -->

        <div class="row my-2 velocity-row">
            <div class="col-md px-md-2 py-2"><?php echo get_berita_iklan('iklan_home_bawah_1'); ?></div>
            <div class="col-md px-md-2 py-2"><?php echo get_berita_iklan('iklan_home_bawah_2'); ?></div>
        </div>

        <div class="velocity-bottom">
            <div class="row velocity-row text-start">
                <?php for ($x = 1; $x <= 4; $x++) {
                    if (is_active_sidebar('bottom-sidebar' . $x)) : ?>
                        <div class="col-md p-md-2">
                            <?php dynamic_sidebar('bottom-sidebar' . $x); ?>
                        </div>
                    <?php endif; ?>
                <?php } ?>
            </div>
        </div>

    </div><!-- #content -->

</div><!-- #index-wrapper -->

<?php
get_footer();
