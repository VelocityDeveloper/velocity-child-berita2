<div class=" top-strip-part bg-color-theme d-md-block d-none">
    <div class="row m-0 align-items-center">
        <div class="col-md-2">
            <div class="text-center bg-light text-muted"><small><?php echo do_shortcode('[velocity-date]'); ?></small></div>
        </div>
        <div class="col-12 col-md-10">
            <nav id="main-nav" class="navbar navbar-expand-md float-end d-block navbar-dark p-0" aria-labelledby="main-nav-label">
                <div class="secondary-menu position-relative text-end">

                    <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#navbarNavOffcanvas2" aria-controls="navbarNavOffcanvas2" aria-expanded="false" aria-label="<?php esc_attr_e('Toggle navigation', 'justg'); ?>">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="offcanvas offcanvas-start bg-dark" tabindex="-1" id="navbarNavOffcanvas2">
                        <div class="offcanvas-header justify-content-end">
                            <button type="button" class="btn-close btn-close-white text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                        </div><!-- .offcancas-header -->

                        <!-- The WordPress Menu goes here -->
                        <?php
                        wp_nav_menu(
                            array(
                                'theme_location'  => 'secondary',
                                'container_class' => 'secondary-menu-body offcanvas-body',
                                'container_id'    => '',
                                'menu_class'      => 'navbar-nav justify-content-start flex-grow-1 text-uppercase',
                                'fallback_cb'     => '',
                                'menu_id'         => 'secondary-menu',
                                'depth'           => 1,
                                'walker'          => new justg_WP_Bootstrap_Navwalker(),
                            )
                        );
                        ?>
                    </div><!-- .offcanvas -->
                </div>
            </nav>
        </div>
    </div>
</div>

<div class="top-brand-row">
    <div class="row py-2 align-items-center">
        <?php if(has_custom_logo()) : ?>
            <div class="col-md-3 pe-md-0 mb-2 mb-md-0">
                <div class="text-center text-md-start">
                    <?php echo the_custom_logo(); ?>
                </div>
            </div>
        <?php endif; ?>
        <div class="col-md">
            <?php echo get_berita_iklan('iklan_header'); ?>
        </div>
    </div>
</div>

<div class="row d-none d-md-flex text-center align-items-center bg-white m-0 mb-2">
    <div class="col-2 px-0 bg-color-theme text-white py-2">
        <div class="text-center p-0 position-relative velocity-headline-title">DON'T MISS:</div>
    </div>

    <div class="col-5 pe-0 text-start">
        <div class="vertical-post-header">
            <?php $headerposts = get_posts(array(
                'showposts' => 3,
                'post_type' => array('post'),
            ));
            foreach ($headerposts as $post) {
                echo '<div><a class="text-dark" href="' . get_the_permalink($post->ID) . '">' . get_the_title($post->ID) . '</a></div>';
            } ?>
        </div>
    </div>

    <div class="col-2 ps-0 pe-1">
        <div class="text-end p-0">
            <?php
            $sosmed = ['facebook', 'twitter', 'instagram', 'youtube'];
            foreach ($sosmed as $key) {
                $datalink  = velocitytheme_option('link_sosmed_' . $key);
                if ($datalink) {
                    echo '<a class="btn btn-sm p-1 btn-' . $key . ' ms-1" href="' . $datalink . '" target="_blank">';
                    echo '<img class="rounded-circle" src="' . get_stylesheet_directory_uri() . '/img/icon-' . $key . '.jpg" width="24" height="24">';
                    echo '</a>';
                }
            }
            ?>
        </div>
    </div>

    <div class="col-3 px-0 align-items-center">
        <div class="search-header float-end">
            <form action="" method="get" id="search">
                <div class="d-inline-block">
                    <input type="text" name="s" placeholder="Search" class="form-control-sm bg-transparent border-0 rounded-0 py-0">
                </div>
                <div class="d-inline-block">
                    <button type="submit" class="btn btn-link bg-color-theme rounded-0 text-secondary text-white px-3 py-1">
                        <?php echo velocity_child_icon_svg('search'); ?>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="scrollHeader">
    <div class="velocity-navbar container bg-dark p-0">
        <nav id="main-nav" class="navbar navbar-expand-md bg-dark d-block navbar-dark shadow-sm p-0" aria-labelledby="main-nav-label">

            <h2 id="main-nav-label" class="screen-reader-text">
                <?php esc_html_e('Main Navigation', 'justg'); ?>
            </h2>

            <div class="menu-shell navbar-dark">
                <div class="menu-header">
                    <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#navbarNavOffcanvas" aria-controls="navbarNavOffcanvas" aria-expanded="false" aria-label="<?php esc_attr_e('Toggle navigation', 'justg'); ?>">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="offcanvas offcanvas-start bg-black" tabindex="-1" id="navbarNavOffcanvas">

                        <div class="offcanvas-header justify-content-end">
                            <button type="button" class="btn-close btn-close-white text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                        </div><!-- .offcancas-header -->

                        <!-- The WordPress Menu goes here -->
                        <?php
                        wp_nav_menu(
                            array(
                                'theme_location'  => 'primary',
                                'container_class' => 'offcanvas-body',
                                'container_id'    => '',
                                'menu_class'      => 'navbar-nav justify-content-start flex-grow-1 pe-3 text-uppercase',
                                'fallback_cb'     => '',
                                'menu_id'         => 'main-menu',
                                'depth'           => 4,
                                'walker'          => new justg_WP_Bootstrap_Navwalker(),
                            )
                        );
                        ?>
                    </div><!-- .offcanvas -->
                </div>
            </div>

        </nav><!-- .site-navigation -->
    </div>
</div>
