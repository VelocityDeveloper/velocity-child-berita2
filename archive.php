<?php

/**
 * The template for displaying archive pages
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package justg
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

get_header();

$container = velocitytheme_option('justg_container_type', 'container');
?>

<div class="wrapper" id="archive-wrapper">

    <div class="<?php echo esc_attr($container); ?>" id="content" tabindex="-1">

        <div class="card-breadcrumbs pt-2 px-3 mb-3">
            <?php echo justg_breadcrumb(); ?>
        </div>

        <div class="row m-0">
            <!-- Do the left sidebar check -->
            <?php do_action('justg_before_content'); ?>

            <main class="site-main col order-2 px-0" id="main">

                <?php if (have_posts()) : ?>
                    <header class="page-header block-primary">
                        <?php the_archive_title('<h4 class="fw-bold d-inline-block mb-0">', '</h4>'); ?>
                        <?php the_archive_description('<div class="taxonomy-description">', '</div>'); ?>
                    </header><!-- .page-header -->
                    <div class="my-3">
                        <?php get_berita_iklan('iklan_archive'); ?>
                    </div>
                    <?php
                    // Start the loop.
                    while (have_posts()) :
                        the_post();
                    ?>
                        <article class="block-primary mb-4">
                            <div class="row m-0">
                                <div class="col-md-4 col-5 px-2">
                                    <div class="post-tumbnail position-relative">
                                        <a href="<?php echo get_permalink(); ?>">
                                            <div class="ratio ratio-4x3">
                                                <?php
                                                if (has_post_thumbnail()) {
                                                    $img_atr = wp_get_attachment_image_src(get_post_thumbnail_id(), 'medium');
                                                    echo '<img src="' . $img_atr[0] . '" alt="' . get_the_title() . '" loading="lazy"/>';
                                                } else {
                                                    echo '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 60 60" style="background-color: #ececec;width: 100%;height: auto;enable-background:new 0 0 60 60;" xml:space="preserve" width="' . $width . '" height="' . $height . '"><g><g><path d="M55.201,15.5h-8.524l-4-10H17.323l-4,10H12v-5H6v5H4.799C2.152,15.5,0,17.652,0,20.299v29.368   C0,52.332,2.168,54.5,4.833,54.5h50.334c2.665,0,4.833-2.168,4.833-4.833V20.299C60,17.652,57.848,15.5,55.201,15.5z M8,12.5h2v3H8   V12.5z M58,49.667c0,1.563-1.271,2.833-2.833,2.833H4.833C3.271,52.5,2,51.229,2,49.667V20.299C2,18.756,3.256,17.5,4.799,17.5H6h6   h2.677l4-10h22.646l4,10h9.878c1.543,0,2.799,1.256,2.799,2.799V49.667z" data-original="#000000" class="active-path" data-old_color="#000000" fill="#5F7D95"/><path d="M30,14.5c-9.925,0-18,8.075-18,18s8.075,18,18,18s18-8.075,18-18S39.925,14.5,30,14.5z M30,48.5c-8.822,0-16-7.178-16-16   s7.178-16,16-16s16,7.178,16,16S38.822,48.5,30,48.5z" data-original="#000000" class="active-path" data-old_color="#000000" fill="#5F7D95"/><path d="M30,20.5c-6.617,0-12,5.383-12,12s5.383,12,12,12s12-5.383,12-12S36.617,20.5,30,20.5z M30,42.5c-5.514,0-10-4.486-10-10   s4.486-10,10-10s10,4.486,10,10S35.514,42.5,30,42.5z" data-original="#000000" class="active-path" data-old_color="#000000" fill="#5F7D95"/><path d="M52,19.5c-2.206,0-4,1.794-4,4s1.794,4,4,4s4-1.794,4-4S54.206,19.5,52,19.5z M52,25.5c-1.103,0-2-0.897-2-2s0.897-2,2-2   s2,0.897,2,2S53.103,25.5,52,25.5z" data-original="#000000" class="active-path" data-old_color="#000000" fill="#5F7D95"/></g></g> </svg>';
                                                } ?>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-md-8 col-7 px-2">
                                    <div class="post-text">
                                        <?php
                                        the_title(
                                            sprintf('<h5 class="fw-bold m-0"><a href="%s" rel="bookmark">', esc_url(get_permalink())),
                                            '</a></h5>'
                                        );
                                        ?>
                                        <div class="post-date text-muted py-2"><?php echo get_the_date('j F Y'); ?></div>
                                        <div class="post-excerpt d-md-block d-none">
                                            <?php echo vdberita_limit_text(strip_tags(get_the_content()), 15); ?>
                                            <div class="py-2">
                                                <a class="btn btn-sm bg-color-theme text-white" href="<?php echo get_the_permalink(); ?>">
                                                    <small>READ MORE</small>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </article>
                <?php
                    endwhile;
                else :
                    get_template_part('loop-templates/content', 'none');
                endif;
                ?>
                <!-- Display the pagination component. -->
                <?php justg_pagination(); ?>

            </main><!-- #main -->

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

</div><!-- #archive-wrapper -->

<?php
get_footer();
