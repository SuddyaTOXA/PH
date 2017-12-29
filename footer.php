    </div>
</div>
<footer id="footer">
    <div class="container">
        <ul class="footer-list">
            <li>
                <div class="footer-box">
                    <div class="footer-logo">
                        <a href="<?php echo home_url(); ?>" title="<?php bloginfo('name'); ?>">
	                        <?php
                                if ( get_field('footer_logo', 'option') ) {
                                    $logo_url = get_field('footer_logo', 'option');
                                } else {
	                                $logo_url = get_bloginfo('template_url') . '/img/logo_dark.svg';
                                }
                            ?>
                            <img src="<?php echo $logo_url; ?>" alt="<?php bloginfo('name'); ?>">
                        </a>
                    </div>
                    <p class="copyright">© 2018 Program Hopper</p>
                </div>
            </li>
            <li>
                <div class="footer-box">
                    <span class="footer-title">Contact Us</span>
                    <a href="tel: 1 541 754 30110" class="footer-link">(541) 754-3010</a>
                    <a href="mailto: info@hopper.com" class="footer-link">info@hopper.com</a>
                </div>
            </li>
            <li>
                <div class="footer-box">
	                <?php wp_nav_menu(array(
		                'theme_location'  => 'footer-menu',
		                'menu'            => 'Footer Menu',
		                'container'       => false,
		                'menu_class'      => 'footer-menu',
		                'items_wrap'      => '<ul class="%2$s">%3$s</ul>',
		                'depth'           => 1
	                )); ?>
                </div>
            </li>
        </ul>
    </div>
</footer>

    <?php wp_footer(); ?>
</body>
</html>