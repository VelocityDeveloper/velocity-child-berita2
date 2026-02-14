<?php

/**
 * Partial template for content in page.php
 *
 * @package justg
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;
?>

<article <?php post_class('block-primary'); ?> id="post-<?php the_ID(); ?>">
    <div class="card-breadcrumbs rounded-0 pt-2 px-3 mb-3">
        <?php echo justg_breadcrumb(); ?>
    </div>
    <header class="entry-header mb-2">
        <?php the_title('<h1 class="fs-4 entry-page-title">', '</h1>'); ?>
    </header><!-- .entry-header -->

    <?php echo get_the_post_thumbnail($post->ID, 'large'); ?>

    <div class="entry-content">

        <?php the_content(); ?>

        <?php
        wp_link_pages(
            array(
                'before' => '<div class="page-links">' . __('Pages:', 'justg'),
                'after'  => '</div>',
            )
        );
        ?>

    </div><!-- .entry-content -->

    <footer class="entry-footer">
        <div class="pb-3">
            <?php edit_post_link(__('Edit', 'justg'), '<span class="edit-link">' . velocity_child_icon_svg('pencil-square', 'me-1') . ' ', '</span>'); ?>
        </div>
    </footer><!-- .entry-footer -->

</article><!-- #post-## -->
