<?php
function module_vdposts($args = null, $style = null)
{
    $row = $style == 'posts6' || $style == 'posts7' ? 'row m-0' : '';

    if (isset($args['sortby'])) {
        if ($args['sortby'] == 'view') {
            $args['orderby']    = 'meta_value_num';
            $args['meta_key']   = 'hit';
        }
        unset($args['sortby']);
    }

    // The Query
    $the_query = new WP_Query($args);

    // The Loop
    if ($the_query->have_posts()) {
        echo '<div class="' . $row . ' module-vdposts module-vdposts-' . $style . '">';
        while ($the_query->have_posts()) {
            $the_query->the_post();

            switch ($style) {
                case 'posts1':
?>
                    <div class="posts-item pb-1 mb-2">
                        <div class="ratio ratio-16x9 mb-2">
                            <?php if (has_post_thumbnail()) : ?>
                                <a href="<?php echo get_the_permalink(); ?>">
                                    <img src="<?php echo wp_get_attachment_url(get_post_thumbnail_id(), 'medium'); ?>" alt="" loading="lazy">
                                </a>
                            <?php endif; ?>
                        </div>
                        <div class="post-text">
                            <h5>
                                <a class="fw-bold d-block" href="<?php echo get_the_permalink(); ?>"><?php echo get_the_title(); ?></a>
                            </h5>
                            <small><i class="fa fa-calendar"></i> <?php echo get_the_date('j F Y'); ?> / <i class="fa fa-eye"></i> <?php echo justg_get_hit(); ?> views </small>
                            <div class="post-excerpt mb-2 text-muted">
                                <?php echo vdberita_limit_text(strip_tags(get_the_content()), 25); ?>
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
                                    <?php if (has_post_thumbnail()) : ?>
                                        <a href="<?php echo get_the_permalink(); ?>">
                                            <img src="<?php echo wp_get_attachment_image_url(get_post_thumbnail_id(), 'full'); ?>" alt="" loading="lazy">
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="col-8 col-md-7 ps-0">
                                <h6 class="m-0">
                                    <a class="fw-bold" href="<?php echo get_the_permalink(); ?>" title="<?php echo get_the_title(); ?>">
                                        <?php echo vdberita_limit_text(get_the_title(), 8); ?>
                                    </a>
                                </h6>
                                <div class="post-date py-2">
                                    <small><i class="fa fa-calendar"></i> <?php echo get_the_date('j F Y'); ?> / <i class="fa fa-eye"></i> <?php echo justg_get_hit(); ?> views </small>
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
                                    <?php if (has_post_thumbnail()) : ?>
                                        <a href="<?php echo get_the_permalink(); ?>">
                                            <img src="<?php echo wp_get_attachment_image_url(get_post_thumbnail_id(), 'full'); ?>" alt="" loading="lazy">
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="col-8 ps-0">
                                <h6 class="mb-0">
                                    <a class="fw-bold" href="<?php echo get_the_permalink(); ?>" title="<?php echo get_the_title(); ?>">
                                        <?php echo vdberita_limit_text(get_the_title(), 8); ?>
                                    </a>
                                </h6>
                                <div class="post-date">
                                    <div class="py-1 px-2 text-muted">
                                        <small><i class="fa fa-calendar"></i> <?php echo get_the_date('j F Y'); ?> / <i class="fa fa-eye"></i> <?php echo justg_get_hit(); ?> views </small>
                                    </div>
                                </div>
                                <div class="post-excerpt text-muted">
                                    <small>
                                        <?php echo vdberita_limit_text(strip_tags(get_the_content()), 5); ?>
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php
                    break;
                case 'posts4':
                    echo '<a class="d-flex w-100 border-bottom pb-1 mb-1" href="' . get_the_permalink() . '">';
                    echo '<i class="fa fa-file-text-o mt-1 me-2"></i>';
                    echo '<span>' . get_the_title() . '</span>';
                    echo '</a>';
                ?>
                <?php
                    break;
                case 'posts5':
                ?>
                    <div class="posts-item border-bottom pb-1 mb-2">
                        <div class="post-date">
                            <div class="py-1 px-2 text-muted">
                                <small><i class="fa fa-calendar"></i> <?php echo get_the_date('j F Y'); ?> / <i class="fa fa-eye"></i> <?php echo justg_get_hit(); ?> views </small>
                            </div>
                        </div>
                        <h6>
                            <a class="fw-bold" href="<?php echo get_the_permalink(); ?>" title="<?php echo get_the_title(); ?>">
                                <?php echo vdberita_limit_text(get_the_title(), 9); ?>
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
                                <?php if (has_post_thumbnail()) : ?>
                                    <a href="<?php echo get_the_permalink(); ?>">
                                        <img src="<?php echo wp_get_attachment_image_url(get_post_thumbnail_id(), 'full'); ?>" alt="" loading="lazy">
                                    </a>
                                <?php endif; ?>
                            </div>
                            <div class="post-text p-2">
                                <h6 class="fw-bold" href="<?php echo get_the_permalink(); ?>" title="<?php echo get_the_title(); ?>">
                                    <?php echo vdberita_limit_text(get_the_title(), 6); ?>
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
                                <?php if (has_post_thumbnail()) : ?>
                                    <a href="<?php echo get_the_permalink(); ?>">
                                        <img src="<?php echo wp_get_attachment_image_url(get_post_thumbnail_id(), 'full'); ?>" alt="" loading="lazy">
                                    </a>
                                <?php endif; ?>
                            </div>
                            <div class="post-text py-2">
                                <h6 class="fw-bold m-0">
                                    <a class="text-theme" href="<?php echo get_the_permalink(); ?>" title="<?php echo get_the_title(); ?>">
                                        <?php echo vdberita_limit_text(get_the_title(), 8); ?>
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
                                        <a class="fw-bold d-block h6" href="<?php echo get_the_permalink(); ?>">
                                            <?php echo get_the_title(); ?>
                                        </a>
                                    </h6>
                                    <div class="konten">
                                        <?php echo vdberita_limit_text(strip_tags(get_the_content()), 25); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-7 order-md-2 order-1 p-1">
                                <div class="ratio ratio-16x9">
                                    <?php if (has_post_thumbnail()) : ?>
                                        <a href="<?php echo get_the_permalink(); ?>">
                                            <img src="<?php echo wp_get_attachment_image_url(get_post_thumbnail_id(), 'full'); ?>" alt="" loading="lazy">
                                        </a>
                                    <?php endif; ?>
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
                                    <?php if (has_post_thumbnail()) : ?>
                                        <a href="<?php echo get_the_permalink(); ?>">
                                            <img src="<?php echo wp_get_attachment_image_url(get_post_thumbnail_id(), 'full'); ?>" alt="" loading="lazy">
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="col-md-5 p-1">
                                <div class="post-text">
                                    <h6>
                                        <a class="fw-bold d-block h6" href="<?php echo get_the_permalink(); ?>">
                                            <?php echo get_the_title(); ?>
                                        </a>
                                    </h6>
                                    <div class="konten">
                                        <?php echo vdberita_limit_text(strip_tags(get_the_content()), 25); ?>
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
                        <div class="row bg-muted m-0">
                            <div class="col-4 p-2">
                                <div class="ratio ratio-4x3">
                                    <?php if (has_post_thumbnail()) : ?>
                                        <a href="<?php echo get_the_permalink(); ?>">
                                            <img src="<?php echo wp_get_attachment_image_url(get_post_thumbnail_id(), 'full'); ?>" alt="" loading="lazy">
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="col-8 p-2">
                                <div class="post-text">
                                    <h6 class="fw-bold">
                                        <a href="<?php echo get_the_permalink(); ?>" title="<?php echo get_the_title(); ?>">
                                            <?php echo vdberita_limit_text(get_the_title(), 6); ?>
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
                            <?php if (has_post_thumbnail()) : ?>
                                <a class="text-white" href="<?php echo get_the_permalink(); ?>">
                                    <img src="<?php echo wp_get_attachment_image_url(get_post_thumbnail_id(), 'full'); ?>" alt="" loading="lazy">
                                </a>
                            <?php endif; ?>
                        </div>
                        <div class="post-text text-white">
                            <div class="py-2 px-1 text-white">
                                <small><i class="fa fa-calendar"></i> <?php echo get_the_date('j F Y'); ?> / <i class="fa fa-eye"></i> <?php echo justg_get_hit(); ?> views </small>
                            </div>
                            <h6>
                                <a class="fw-bold text-white d-block h6" href="<?php echo get_the_permalink(); ?>">
                                    <?php echo get_the_title(); ?>
                                </a>
                            </h6>
                            <div class="konten">
                                <small>
                                    <?php echo vdberita_limit_text(strip_tags(get_the_content()), 25); ?>
                                </small>
                            </div>
                        </div>
                    </div>
<?php
                    break;
                case 'postslist':
                    echo '<h6 class="vpost-list"><a class="d-flex w-100 fw-bold text-white mb-2" href="' . get_the_permalink() . '">';
                    echo '<span>' . get_the_title() . '</span>';
                    echo '</a></h6>';
                    break;
                default:
                    echo '<div class="posts-item border-bottom pb-1 mb-2">';
                    echo '<a href="' . get_the_permalink() . '">' . get_the_title() . '</a>';
                    echo '</div>';
                    break;
            }
        }
        echo '</div>';
    }
    /* Restore original Post Data */
    wp_reset_postdata();
}
