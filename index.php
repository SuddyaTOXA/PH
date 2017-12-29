<?php get_header(); ?>

<!--    --><?php //get_template_part('inc/banner'); ?>

    <section class="section-blog" id="main-content">
        <div class="container">

            <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                <div class="content">
                    <?php the_content(); ?>
                </div>
            <?php endwhile; else: endif; ?>

        </div>
    </section>

<?php get_footer(); ?>