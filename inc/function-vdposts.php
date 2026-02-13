<?php
function module_vdposts($args = null, $style = null)
{
    $row = $style == 'posts6' || $style == 'posts7' ? 'row velocity-post-row' : '';

    if (isset($args['sortby'])) {
        if ($args['sortby'] == 'view') {
            $args = apply_filters(
                'velocity_child_popular_query_args',
                array_merge($args, [
                    'orderby' => 'comment_count',
                    'order'   => 'DESC',
                ])
            );
        }
        unset($args['sortby']);
    }

    $the_query = new WP_Query($args);

    if ($the_query->have_posts()) {
        echo '<div class="' . esc_attr($row) . ' module-vdposts module-vdposts-' . esc_attr($style) . '">';
        while ($the_query->have_posts()) {
            $the_query->the_post();

            switch ($style) {
                case 'posts1':
?>
                    <div class="posts-item pb-1 mb-2">
                        <div class="ratio ratio-16x9 mb-2">
                            <?php echo velocity_child_post_thumbnail_html(['size' => 'medium']); ?>
                        </div>
                        <div class="post-text">
                            <h5>
                                <a class="fw-bold d-block" href="<?php echo esc_url(get_the_permalink()); ?>"><?php echo esc_html(get_the_title()); ?></a>
                            </h5>
                            <?php echo velocity_child_post_meta_html(); ?>
                            <div class="post-excerpt mb-2 text-muted">
                                <?php echo esc_html(vdberita_limit_text(strip_tags(get_the_content()), 25)); ?>
                            </div>
                        </div>
                    </div>
                <?php
                    break;
                case 'posts2':
                ?>
                    <div class="posts-item pb-1 mb-2">
                        <div class="row">
                            <div class="col-4 col-md-5">
                                <div class="ratio ratio-4x3">
                                    <?php echo velocity_child_post_thumbnail_html(); ?>
                                </div>
                            </div>
                            <div class="col-8 col-md-7 ps-0">
                                <h6 class="m-0">
                                    <a class="fw-bold" href="<?php echo esc_url(get_the_permalink()); ?>" title="<?php echo esc_attr(get_the_title()); ?>">
                                        <?php echo esc_html(vdberita_limit_text(get_the_title(), 8)); ?>
                                    </a>
                                </h6>
                                <div class="post-date py-2">
                                    <?php echo velocity_child_post_meta_html(); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php
                    break;
                case 'posts3':
                ?>
                    <div class="posts-item border-bottom pb-1 mb-2">
                        <div class="row">
                            <div class="col-4">
                                <div class="ratio ratio-1x1">
                                    <?php echo velocity_child_post_thumbnail_html(); ?>
                                </div>
                            </div>
                            <div class="col-8 ps-0">
                                <h6 class="mb-0">
                                    <a class="fw-bold" href="<?php echo esc_url(get_the_permalink()); ?>" title="<?php echo esc_attr(get_the_title()); ?>">
                                        <?php echo esc_html(vdberita_limit_text(get_the_title(), 8)); ?>
                                    </a>
                                </h6>
                                <div class="post-date">
                                    <div class="py-1 px-2 text-muted">
                                        <?php echo velocity_child_post_meta_html(); ?>
                                    </div>
                                </div>
                                <div class="post-excerpt text-muted">
                                    <small>
                                        <?php echo esc_html(vdberita_limit_text(strip_tags(get_the_content()), 5)); ?>
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php
                    break;
                case 'posts4':
                    echo '<a class="d-flex w-100 border-bottom pb-1 mb-1" href="' . esc_url(get_the_permalink()) . '">';
                    echo velocity_child_icon_svg('file-text', 'mt-1 me-2');
                    echo '<span>' . esc_html(get_the_title()) . '</span>';
                    echo '</a>';
                ?>
                <?php
                    break;
                case 'posts5':
                ?>
                    <div class="posts-item border-bottom pb-1 mb-2">
                        <div class="post-date">
                            <div class="py-1 px-2 text-muted">
                                <?php echo velocity_child_post_meta_html(); ?>
                            </div>
                        </div>
                        <h6>
                            <a class="fw-bold" href="<?php echo esc_url(get_the_permalink()); ?>" title="<?php echo esc_attr(get_the_title()); ?>">
                                <?php echo esc_html(vdberita_limit_text(get_the_title(), 9)); ?>
                            </a>
                        </h6>
                    </div>
                <?php
                    break;
                case 'posts6':
                ?>
                    <div class="col-md-3 col-6 p-1">
                        <div class="posts-item">
                            <div class="ratio ratio-4x3">
                                <?php echo velocity_child_post_thumbnail_html(); ?>
                            </div>
                            <div class="post-text p-2">
                                <h6 class="fw-bold">
                                    <a class="d-block" href="<?php echo esc_url(get_the_permalink()); ?>" title="<?php echo esc_attr(get_the_title()); ?>">
                                        <?php echo esc_html(vdberita_limit_text(get_the_title(), 6)); ?>
                                    </a>
                                </h6>
                            </div>
                        </div>
                    </div>
                <?php
                    break;
                case 'posts7':
                ?>
                    <div class="col-6 p-1">
                        <div class="posts-item">
                            <div class="ratio ratio-4x3">
                                <?php echo velocity_child_post_thumbnail_html(); ?>
                            </div>
                            <div class="post-text py-2">
                                <h6 class="fw-bold m-0">
                                    <a class="text-theme" href="<?php echo esc_url(get_the_permalink()); ?>" title="<?php echo esc_attr(get_the_title()); ?>">
                                        <?php echo esc_html(vdberita_limit_text(get_the_title(), 8)); ?>
                                    </a>
                                </h6>
                            </div>
                        </div>
                    </div>
                <?php
                    break;
                case 'posts8': ?>
                    <div class="posts-item">
                        <div class="row m-0 align-items-center">
                            <div class="col-md-5 order-md-1 order-2 px-1">
                                <div class="post-text">
                                    <h6>
                                        <a class="fw-bold d-block h6" href="<?php echo esc_url(get_the_permalink()); ?>">
                                            <?php echo esc_html(get_the_title()); ?>
                                        </a>
                                    </h6>
                                    <div class="konten">
                                        <?php echo esc_html(vdberita_limit_text(strip_tags(get_the_content()), 25)); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-7 order-md-2 order-1 p-1">
                                <div class="ratio ratio-16x9">
                                    <?php echo velocity_child_post_thumbnail_html(); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php
                    break;
                case 'posts9': ?>
                    <div class="posts-item">
                        <div class="row m-0 align-items-center">
                            <div class="col-md-7 p-1">
                                <div class="ratio ratio-16x9">
                                    <?php echo velocity_child_post_thumbnail_html(); ?>
                                </div>
                            </div>
                            <div class="col-md-5 p-1">
                                <div class="post-text">
                                    <h6>
                                        <a class="fw-bold d-block h6" href="<?php echo esc_url(get_the_permalink()); ?>">
                                            <?php echo esc_html(get_the_title()); ?>
                                        </a>
                                    </h6>
                                    <div class="konten">
                                        <?php echo esc_html(vdberita_limit_text(strip_tags(get_the_content()), 25)); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php
                    break;
                case 'carousel':
                ?>
                    <div class="carousel-post-item px-1">
                        <div class="row bg-muted mx-3">
                            <div class="col-4 col-md-5 pt-2">
                                <div class="ratio ratio-4x3">
                                    <?php echo velocity_child_post_thumbnail_html(); ?>
                                </div>
                            </div>
                            <div class="col-8 col-md-7 pt-2 ps-0">
                                <div class="post-text">
                                    <h6 class="fw-bold">
                                        <a href="<?php echo esc_url(get_the_permalink()); ?>" title="<?php echo esc_attr(get_the_title()); ?>">
                                            <?php echo esc_html(vdberita_limit_text(get_the_title(), 6)); ?>
                                        </a>
                                    </h6>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php
                    break;
                case 'homespecial':
                ?>
                    <div class="posts-item home-special p-2 mb-2 position-relative">
                        <div class="ratio ratio-16x9 mb-2">
                            <?php echo velocity_child_post_thumbnail_html(); ?>
                        </div>
                        <div class="post-text text-white">
                            <div class="py-2 px-1 text-white">
                                <?php echo velocity_child_post_meta_html(); ?>
                            </div>
                            <h6>
                                <a class="fw-bold text-white d-block h6" href="<?php echo esc_url(get_the_permalink()); ?>">
                                    <?php echo esc_html(get_the_title()); ?>
                                </a>
                            </h6>
                            <div class="konten">
                                <small>
                                    <?php echo esc_html(vdberita_limit_text(strip_tags(get_the_content()), 25)); ?>
                                </small>
                            </div>
                        </div>
                    </div>
<?php
                    break;
                case 'postslist':
                    echo '<h6 class="vpost-list"><a class="d-flex w-100 fw-bold text-white mb-2" href="' . esc_url(get_the_permalink()) . '">';
                    echo '<span>' . esc_html(get_the_title()) . '</span>';
                    echo '</a></h6>';
                    break;
                default:
                    echo '<div class="posts-item border-bottom pb-1 mb-2">';
                    echo '<a href="' . esc_url(get_the_permalink()) . '">' . esc_html(get_the_title()) . '</a>';
                    echo '</div>';
                    break;
            }
        }
        echo '</div>';
    }

    wp_reset_postdata();
}
