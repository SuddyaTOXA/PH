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
        <header class="header <?php if (is_user_logged_in()) { echo 'logged'; } ?>" id="header">
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
                    <?php if (is_user_logged_in()) { ?>
                        <ul class="logged-list">
                            <li><a href="<?php echo get_permalink(13); ?>">My Account</a></li>
                            <li><a href="<?php echo get_permalink(19); ?>">My subscription <span class="subscription">!</span></a></li>
                        </ul>
                    <?php } ?>
                    <a href="<?php echo get_permalink(177); ?>" class="btn login-btn">Login</a>
                    <a href="<?php echo get_permalink(179); ?>" class="btn pink join-btn">Join</a>
	                <?php if (is_user_logged_in()) { ?>
                        <a href="<?php echo get_permalink(178); ?>" class="btn grey logout-btn">Logout</a>
	                <?php } ?>
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
                        <div class="header-btn-box">
                            <a href="<?php echo get_permalink(177); ?>" class="btn login-btn">Login</a>
                            <a href="<?php echo get_permalink(179); ?>" class="btn pink join-btn">Join</a>
	                        <?php if (is_user_logged_in()) { ?>
                                <a href="<?php echo get_permalink(178); ?>" class="btn grey logout-btn">Logout</a>
	                        <?php } ?>

	                        <?php if (is_user_logged_in()) { ?>
                                <ul class="logged-list">
                                    <li><a href="<?php echo get_permalink(13); ?>">My Account</a></li>
                                    <li><a href="<?php echo get_permalink(19); ?>">My subscription <span class="subscription">!</span></a></li>
                                </ul>
	                        <?php } ?>
                        </div>

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