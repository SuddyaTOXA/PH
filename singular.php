<?php get_header(); ?>

<?php
if ( have_posts() ) : while ( have_posts() ) : the_post();

	$title = strip_tags(get_the_title());

?>

    <section class="section section-blog">
        <div class="container">
            <div class="content-wrap">
                <div class="content-inner">
                    <?php
                        if ($title) {
                            echo '<h1 class="section-title">'. $title .'</h1>';
                        }
                        ?>
                    <div class="content">
                        <?php
                            the_content();
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php endwhile; else: endif; ?>


<?php get_footer(); ?>