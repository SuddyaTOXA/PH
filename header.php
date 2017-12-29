<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="format-detection" content="telephone=no">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="shortcut icon" href="<?= get_bloginfo('template_url') ?>/favicon.ico">
    <link rel="apple-touch-icon" href="<?= get_bloginfo('template_url') ?>/img/touch-icon.gif">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <div class="wrapper">
        <a class="btn-jump-to-content smooth-scroll" href="#main-content">Skip Navigation</a>
        <header class="header" id="header">
            <div class="container">
                <div class="logo">
                    <a href="<?php echo home_url(); ?>" title="<?php bloginfo('name'); ?>">
	                    <?php
                            if ( get_field('logo', 'option') ) {
                                $logo_url = get_field('logo', 'option');
                            } elseif ( has_custom_logo() ) {
                                $custom_logo = wp_get_attachment_image_src( get_theme_mod('custom_logo'), 'full' );
                                $logo_url = $custom_logo[0];
                            } else {
                                $logo_url = get_bloginfo('template_url') . '/img/logo.svg';
                            }
	                    ?>
                        <img src="<?php echo $logo_url; ?>" alt="<?php bloginfo('name'); ?>">
                    </a>
                </div>

                <div class="mobile-menu-toggle">
                    <span></span>
                </div>

                <div class="header-btn-box">
                    <ul class="logged-list">
                        <li><a href="#">My Account</a></li>
                        <li><a href="#">My subscription <span class="subscription">!</span></a></li>
                    </ul>
                    <a href="#" class="btn login-btn">Login</a>
                    <a href="#" class="btn pink join-btn">Join</a>
                    <a href="#" class="btn grey logout-btn">Logout</a>
                </div>

	            <?php wp_nav_menu(array(
		            'theme_location'  => 'main-menu',
		            'menu'            => 'Main Menu',
		            'container'       => 'nav',
		            'container_class' => 'main-nav desktop',
		            'container_id'    => false,
		            'items_wrap'      => '<ul>%3$s</ul>',
		            'depth'           => 2
	            )); ?>


                <div class="mobile-menu-wrap">
                    <div class="mobile-menu-box">
	                    <?php wp_nav_menu(array(
		                    'theme_location'  => 'main-menu',
		                    'menu'            => 'Main Menu',
		                    'container'       => false,
		                    'menu_class'      => 'mobile-menu',
		                    'items_wrap'      => '<ul class="%2$s">%3$s</ul>',
		                    'depth'           => 2
	                    )); ?>

                    </div>
                    <div class="mobile-menu-overlay"></div>
                </div>

            </div>
        </header>
        <div id="main-content">