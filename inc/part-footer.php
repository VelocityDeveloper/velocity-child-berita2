<footer class="bg-transparent site-footer container p-md-0 mb-3 px-3" id="colophon">
    <div class="velocity-footer p-2 pb-0">
        <div class="row text-start m-0">
            <?php for ($x = 1; $x <= 4; $x++) {
                if (is_active_sidebar('footer-widget' . $x)) : ?>
                    <div class="col-md p-2">
                        <?php dynamic_sidebar('footer-widget' . $x); ?>
                    </div>
                <?php endif; ?>
            <?php } ?>
        </div>
    </div>

    <div class="velocity-page-footer site-info p-2 bg-dark text-center text-secondary position-relative">
        <small>
            © <?php echo date("Y"); ?> <?php echo get_bloginfo('name'); ?>. All Rights Reserved.<br />
            Design by <a class="text-secondary" href="https://velocitydeveloper.com" target="_blank" rel="noopener noreferrer"> Velocity Developer </a>
        </small>
    </div>
    <!-- .site-info -->
</footer>