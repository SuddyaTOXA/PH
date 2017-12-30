<?php get_header(); ?>

<?php
if ( have_posts() ) : while ( have_posts() ) : the_post();

	$title = strip_tags(get_the_title());
	$url = get_the_permalink();
	$month = get_the_date( 'M' );
	$date = get_the_date( 'j' );
	$author = get_the_author();
	$author_id = get_the_author_meta(ID);
	$author_link = get_author_posts_url($author_id ,$author);
	$num_comments = 0;
	$category = 'category';
	$cats = wp_get_post_terms( $post->ID, $category, array('orderby' => 'term_order', 'parent' => 0) );
	$next_post = get_adjacent_post(false,'',false);
	$previous_post = get_adjacent_post(false,'',true);
	$next_link = get_permalink($next_post->ID);
	$prev_link = get_permalink($previous_post->ID);
	$next_title = $next_post->post_title;
	$prev_title = $previous_post->post_title;
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