<?php get_header();

    $hero_show      = get_field('show_hero_banner');
    $hero_persons   = get_field('hero_persons');
    $hero_text      = get_field('hero_text');
    $hero_bg        = get_field('hero_image');
    $hero_logo      = get_field('hero_logo');

?>

    <?php if($hero_show) { ?>
        <section class="section section-hero">
            <div class="container">
                <div class="hero-cell">
	                <?php if($hero_persons && is_array($hero_persons)) {  ?>
                        <div class="hero-person-name">
			                <?php foreach ($hero_persons as $person) { ?>
                                <div class="hero-box">
                                    <span class="person-name">
                                        <?php
                                            if ($person['name']) { echo '<span>'. $person['name'] .'</span>'; }
                                            if ($person['surname']) { echo $person['surname']; }
                                        ?>
                                    </span>
                                </div>
			                <?php } ?>
                        </div>
	                <?php  }
                        if ($hero_text) { echo '<div class="hero-presents">'. $hero_text .'</div>'; }
                    ?>
                </div>
            </div>
            <div class="hero-title-box">
                <div class="hero-logo">
                    <?php
                        if ($hero_logo) {
                            $logo_url = esc_url($hero_logo);
                        } else {
                            $logo_url = get_bloginfo('template_url') . '/img/logo.svg';
                        }
                    ?>
                    <img src="<?php echo $logo_url; ?>" alt="<?php bloginfo('name'); ?>" class="hero-logo">
                </div>
            </div>
            <?php if ($hero_bg) { ?>
                <style>
                    .section-hero:before {
                        background-image: url(<?php echo esc_url($hero_bg); ?>);
                    }
                </style>
            <?php } ?>
        </section>
    <?php } ?>


    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
        <section class="section section-hero-content">
            <?php echo the_content(); ?>
        </section>
    <?php endwhile; else: endif; ?>

    <section class="section section-coaches">
        <div class="container">
            <h2 class="section-title"></h2>
            <div class="content">
                <p></p>
            </div>
            <ul class="coaches-list">
                <li>
                    <div class="coach-box">
                        <div class="coach-img-wrap">
                            <img src="img/ben_ico.jpg" alt="Ben">
                        </div>
                        <h3 class="coach-name">Ben Alderman</h3>
                        <ul class="coach-info-list">
                            <li>
                                <div class="coach-info-table">
                                    <span class="coach-info-title">Region</span>
                                    <span>Northern California</span>
                                </div>
                            </li>
                            <li>
                                <div class="coach-info-table">
                                    <span class="coach-info-title">Division</span>
                                    <span>Individual Men</span>
                                </div>
                            </li>
                            <li>
                                <div class="coach-info-table">
                                    <span class="coach-info-title">Age</span>
                                    <span>35</span>
                                </div>
                            </li>
                            <li>
                                <div class="coach-info-table">
                                    <span class="coach-info-title">Height</span>
                                    <span>5'10"</span>
                                </div>
                            </li>
                            <li>
                                <div class="coach-info-table">
                                    <span class="coach-info-title">Weight</span>
                                    <span>208 LB</span>
                                </div>
                            </li>
                            <li>
                                <div class="coach-info-table">
                                    <span class="coach-info-title">Affiliate</span>
                                    <span>Crossfit iron mile</span>
                                </div>
                            </li>
                            <li>
                                <div class="coach-info-table">
                                    <span class="coach-info-title">Team</span>
                                    <span>iron mile</span>
                                </div>
                            </li>
                        </ul>
                        <ul class="coach-social-list">
                            <li>
                                <a href="" title><i class="fa fa-facebook" aria-hidden="true"></i></a>
                            </li>
                            <li>
                                <a href="" title><i class="fa fa-instagram" aria-hidden="true"></i></a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li>
                    <div class="coach-box">
                        <div class="coach-img-wrap">
                            <img src="img/blair_ico.jpg" alt="Blair">
                        </div>
                        <h3 class="coach-name">Blair Morrison</h3>
                        <ul class="coach-info-list">
                            <li>
                                <div class="coach-info-table">
                                    <span>Northern California</span>
                                    <span class="coach-info-title">Region</span>
                                </div>
                            </li>
                            <li>
                                <div class="coach-info-table">
                                    <span>Masters men (35-39)</span>
                                    <span class="coach-info-title">Division</span>
                                </div>
                            </li>
                            <li>
                                <div class="coach-info-table">
                                    <span>35</span>
                                    <span class="coach-info-title">Age</span>
                                </div>
                            </li>
                            <li>
                                <div class="coach-info-table">
                                    <span>6'0"</span>
                                    <span class="coach-info-title">Height</span>
                                </div>
                            </li>
                            <li>
                                <div class="coach-info-table">
                                    <span>190 LB</span>
                                    <span class="coach-info-title">Weight</span>
                                </div>
                            </li>
                            <li>
                                <div class="coach-info-table">
                                    <span>Crossfit Anywhere</span>
                                    <span class="coach-info-title">Affiliate</span>
                                </div>
                            </li>
                            <li>
                                <div class="coach-info-table">
                                    <span>CF ANYWHERE TIEDYE NATION</span>
                                    <span class="coach-info-title">Team</span>
                                </div>
                            </li>
                        </ul>
                        <ul class="coach-social-list">
                            <li>
                                <a href="" title><i class="fa fa-facebook" aria-hidden="true"></i></a>
                            </li>
                            <li>
                                <a href="" title><i class="fa fa-instagram" aria-hidden="true"></i></a>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </section>

<?php get_footer(); ?>