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
                                            <?php
                                            if (has_post_thumbnail()) {
                                                $img_atr = wp_get_attachment_image_src(get_post_thumbnail_id(), 'large');
                                                echo '<img class="w-100" src="' . $img_atr[0] . '" alt="' . get_the_title() . '" loading="lazy">';
                                            } else {
                                                echo '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 60 60" style="background-color: #ececec;width: 100%;height: auto;enable-background:new 0 0 60 60;" xml:space="preserve" width="' . $width . '" height="' . $height . '"><g><g><path d="M55.201,15.5h-8.524l-4-10H17.323l-4,10H12v-5H6v5H4.799C2.152,15.5,0,17.652,0,20.299v29.368   C0,52.332,2.168,54.5,4.833,54.5h50.334c2.665,0,4.833-2.168,4.833-4.833V20.299C60,17.652,57.848,15.5,55.201,15.5z M8,12.5h2v3H8   V12.5z M58,49.667c0,1.563-1.271,2.833-2.833,2.833H4.833C3.271,52.5,2,51.229,2,49.667V20.299C2,18.756,3.256,17.5,4.799,17.5H6h6   h2.677l4-10h22.646l4,10h9.878c1.543,0,2.799,1.256,2.799,2.799V49.667z" data-original="#000000" class="active-path" data-old_color="#000000" fill="#5F7D95"/><path d="M30,14.5c-9.925,0-18,8.075-18,18s8.075,18,18,18s18-8.075,18-18S39.925,14.5,30,14.5z M30,48.5c-8.822,0-16-7.178-16-16   s7.178-16,16-16s16,7.178,16,16S38.822,48.5,30,48.5z" data-original="#000000" class="active-path" data-old_color="#000000" fill="#5F7D95"/><path d="M30,20.5c-6.617,0-12,5.383-12,12s5.383,12,12,12s12-5.383,12-12S36.617,20.5,30,20.5z M30,42.5c-5.514,0-10-4.486-10-10   s4.486-10,10-10s10,4.486,10,10S35.514,42.5,30,42.5z" data-original="#000000" class="active-path" data-old_color="#000000" fill="#5F7D95"/><path d="M52,19.5c-2.206,0-4,1.794-4,4s1.794,4,4,4s4-1.794,4-4S54.206,19.5,52,19.5z M52,25.5c-1.103,0-2-0.897-2-2s0.897-2,2-2   s2,0.897,2,2S53.103,25.5,52,25.5z" data-original="#000000" class="active-path" data-old_color="#000000" fill="#5F7D95"/></g></g> </svg>';
                                            } ?>
                                        </div>
                                        <div class="d-md-none d-block ratio ratio-4x3 bg-light overflow-hidden">
                                            <?php
                                            if (has_post_thumbnail()) {
                                                $img_atr = wp_get_attachment_image_src(get_post_thumbnail_id(), 'large');
                                                echo '<img class="w-100" src="' . $img_atr[0] . '" alt="' . get_the_title() . '" loading="lazy">';
                                            } else {
                                                echo '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 60 60" style="background-color: #ececec;width: 100%;height: auto;enable-background:new 0 0 60 60;" xml:space="preserve" width="' . $width . '" height="' . $height . '"><g><g><path d="M55.201,15.5h-8.524l-4-10H17.323l-4,10H12v-5H6v5H4.799C2.152,15.5,0,17.652,0,20.299v29.368   C0,52.332,2.168,54.5,4.833,54.5h50.334c2.665,0,4.833-2.168,4.833-4.833V20.299C60,17.652,57.848,15.5,55.201,15.5z M8,12.5h2v3H8   V12.5z M58,49.667c0,1.563-1.271,2.833-2.833,2.833H4.833C3.271,52.5,2,51.229,2,49.667V20.299C2,18.756,3.256,17.5,4.799,17.5H6h6   h2.677l4-10h22.646l4,10h9.878c1.543,0,2.799,1.256,2.799,2.799V49.667z" data-original="#000000" class="active-path" data-old_color="#000000" fill="#5F7D95"/><path d="M30,14.5c-9.925,0-18,8.075-18,18s8.075,18,18,18s18-8.075,18-18S39.925,14.5,30,14.5z M30,48.5c-8.822,0-16-7.178-16-16   s7.178-16,16-16s16,7.178,16,16S38.822,48.5,30,48.5z" data-original="#000000" class="active-path" data-old_color="#000000" fill="#5F7D95"/><path d="M30,20.5c-6.617,0-12,5.383-12,12s5.383,12,12,12s12-5.383,12-12S36.617,20.5,30,20.5z M30,42.5c-5.514,0-10-4.486-10-10   s4.486-10,10-10s10,4.486,10,10S35.514,42.5,30,42.5z" data-original="#000000" class="active-path" data-old_color="#000000" fill="#5F7D95"/><path d="M52,19.5c-2.206,0-4,1.794-4,4s1.794,4,4,4s4-1.794,4-4S54.206,19.5,52,19.5z M52,25.5c-1.103,0-2-0.897-2-2s0.897-2,2-2   s2,0.897,2,2S53.103,25.5,52,25.5z" data-original="#000000" class="active-path" data-old_color="#000000" fill="#5F7D95"/></g></g> </svg>';
                                            } ?>
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
                                <?php if (has_post_thumbnail()) : ?>
                                    <a href="<?php echo get_the_permalink(); ?>">
                                        <img src="<?php echo wp_get_attachment_image_url(get_post_thumbnail_id(), 'full'); ?>" alt="" loading="lazy">
                                    </a>
                                <?php endif; ?>
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
        <div class="row m-0">
            <!-- Do the left sidebar check -->
            <?php do_action('justg_before_content'); ?>

            <div class="col-md mb-3">

                <main class="site-main col order-2" id="main">

                    <?php
                    $highlight_title  = velocitytheme_option('title_posts_highlight', 'Recent Posts');
                    $highlight_cat  = velocitytheme_option('cat_posts_highlight');
                    ?>
                    <div class="post-hightlight">
                        <h4 class="widget-title velocity-title text-white mb-3">
                            <?php if ($highlight_cat) : ?>
                                <span class="d-inline-block bg-color-theme py-1 px-3">
                                    <a class="text-white" href="<?php echo get_tag_link($highlight_cat); ?>"><?php echo $highlight_title; ?></a>
                                </span>
                            <?php endif; ?>
                        </h4>
                        <div class="part-hightlight">
                            <div class="part-carousel-home">
                                <?php
                                $highlight_args = array(
                                    'post_type' => 'post',
                                    'cat'       => $highlight_cat,
                                    'posts_per_page' => 8,
                                );
                                module_vdposts($highlight_args, 'carousel'); ?>
                            </div>
                        </div>
                    </div>

                    <?php
                    $post1_title    = velocitytheme_option('title_posts_home_1', 'Recent Posts');
                    $post1_cat      = velocitytheme_option('cat_posts_home_1');
                    ?>
                    <div class="part-posts-home-1 pt-3">
                        <h4 class="widget-title velocity-title text-white mb-3">
                            <?php if ($post1_cat) : ?>
                                <span class="d-inline-block bg-color-theme py-1 px-3">
                                    <a class="text-white" href="<?php echo get_tag_link($post1_cat); ?>"><?php echo $post1_title; ?></a>
                                </span>
                            <?php endif; ?>
                        </h4>

                        <div class="part_posts_home_1">
                            <div class="row m-0">
                                <div class="col-md-6 px-1">
                                    <?php
                                    $post1_args = array(
                                        'post_type' => 'post',
                                        'cat'       => $post1_cat,
                                        'posts_per_page' => 1,
                                    );
                                    module_vdposts($post1_args, 'posts1');
                                    ?>
                                </div>
                                <div class="col-md-6 px-1">
                                    <?php
                                    $post1_args = array(
                                        'post_type' => 'post',
                                        'cat'       => $post1_cat,
                                        'posts_per_page' => 5,
                                        'offset' => 1,
                                    );
                                    module_vdposts($post1_args, 'posts2');
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php
                    $post2_title    = velocitytheme_option('title_posts_home_2', 'Recent Posts');
                    $post2_cat      = velocitytheme_option('cat_posts_home_2');
                    ?>
                    <div class="part_posts_home_2 py-2">
                        <h4 class="widget-title velocity-title text-white mb-3">
                            <?php if ($post2_cat) : ?>
                                <span class="d-inline-block bg-color-theme py-1 px-3">
                                    <a class="text-white" href="<?php echo get_tag_link($post2_cat); ?>"><?php echo $post2_title; ?></a>
                                </span>
                            <?php endif; ?>
                        </h4>

                        <div class="row m-0">
                            <div class="col-md-6 px-1">
                                <div class="part-post-home-2 py-2">
                                    <?php
                                    $post2_args = array(
                                        'post_type' => 'post',
                                        'cat'       => $post2_cat,
                                        'posts_per_page' => 1,
                                    );
                                    echo module_vdposts($post2_args, 'posts1'); ?>
                                </div>
                            </div>
                            <div class="col-md-6 px-1">
                                <div class="part-post-home-2 p-3 bg-color-theme h-100">
                                    <?php
                                    $post2_args = array(
                                        'post_type' => 'post',
                                        'cat'       => $post2_cat,
                                        'posts_per_page' => 5,
                                        'offset'    => 1,
                                    );
                                    echo module_vdposts($post2_args, 'postslist'); ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php
                    $post3_title    = velocitytheme_option('title_posts_home_3', 'Recent Posts');
                    $post3_cat      = velocitytheme_option('cat_posts_home_3');
                    ?>
                    <div class="part_posts_home_3 mt-3 p-1">
                        <h4 class="widget-title velocity-title text-white mb-3">
                            <?php if ($post3_cat) : ?>
                                <span class="d-inline-block bg-color-theme py-1 px-3">
                                    <a class="text-white" href="<?php echo get_tag_link($post3_cat); ?>"><?php echo $post3_title; ?></a>
                                </span>
                            <?php endif; ?>
                        </h4>

                        <div class="part-post-home-3 p-md-2">
                            <?php
                            $post3_args = array(
                                'post_type' => 'post',
                                'cat'       => $post3_cat,
                                'posts_per_page' => 1,
                            );
                            $post3_query = new WP_Query($post3_args);

                            if ($post3_query->have_posts()) :
                                while ($post3_query->have_posts()) :
                                    $post3_query->the_post(); ?>
                                    <div class="posts-items row m-0">
                                        <div class="col-md-6 px-md-1 px-0">
                                            <div class="border ratio ratio-4x3 mb-2">
                                                <?php if (has_post_thumbnail()) : ?>
                                                    <a href="<?php echo get_the_permalink(); ?>">
                                                        <img src="<?php echo wp_get_attachment_url(get_post_thumbnail_id(), 'medium'); ?>" alt="" loading="lazy">
                                                    </a>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <div class="col-md-6 px-md-1 px-0">
                                            <div class="border post-text p-3">
                                                <h5>
                                                    <a class="fw-bold d-block" href="<?php echo get_the_permalink(); ?>"><?php echo get_the_title(); ?></a>
                                                </h5>
                                                <div class="post-excerpt mb-2 text-muted">
                                                    <?php echo vdberita_limit_text(strip_tags(get_the_content()), 12); ?>
                                                </div>
                                                <hr />
                                                <?php
                                                $post3sub_args = array(
                                                    'post_type' => 'post',
                                                    'cat'       => $post3_cat,
                                                    'posts_per_page' => 2,
                                                    'offset'    => 1
                                                );
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

        <div class="row m-0 my-3">
            <div class="col-md-6 p-1"><?php echo get_berita_iklan('iklan_home_bawah_1'); ?></div>
            <div class="col-md-6 p-1"><?php echo get_berita_iklan('iklan_home_bawah_2'); ?></div>
        </div>

        <div class="velocity-bottom">
            <div class="row text-start m-0">
                <?php for ($x = 1; $x <= 4; $x++) {
                    if (is_active_sidebar('bottom-sidebar' . $x)) : ?>
                        <div class="col-md px-1">
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
