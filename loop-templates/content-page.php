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
        <?php the_title('<h4 class="entry-page-title">', '</h4>'); ?>
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
            <?php edit_post_link(__('Edit', 'justg'), '<span class="edit-link"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> ', '</span>'); ?>
        </div>
    </footer><!-- .entry-footer -->

</article><!-- #post-## -->