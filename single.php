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
                    <div class="blog-inner">
                        <div class="blog-box">
                            <div class="blog-top-box">
                                <div class="blog-date">
                                    <span><?php echo $month; ?></span>
                                    <span class="month"><?php echo $date; ?></span>
                                </div>
                                <div class="blog-logo-wrap">
	                                <?php
                                        if (has_post_thumbnail()) {
	                                        the_post_thumbnail('full', array(
				                                'alt'   => esc_attr($post->post_title)
			                                ));
	                                    }
	                                ?>
                                </div>
                            </div>
                            <h2 class="blog-list-title"><?php echo $title; ?></h2>
                            <div class="blog-info-box">
		                        <?php
		                        if ($author) {
			                        echo '<a href="'. $author_link. '" title="'. $author .'">'. $author .'</a>';
		                        }

		                        if ($cats) {
			                        echo '<span>';
			                        if (is_array($cats) && count($cats) > 0) {
				                        $c = 0;
				                        foreach ($cats as $cat) {
					                        if ($c !== 0) echo ", ";
					                        echo $cat->name;
					                        $c++;
				                        }
			                        }
			                        echo '</span>';
		                        }

		                        $num_comments = get_comments_number();
		                        if ( comments_open() ) {
			                        if ( $num_comments == 0 ) {
				                        echo '<span>'. __('No Comments') .'</span>';
			                        } elseif ($num_comments == 1) {
				                        echo '<a href="#comments" title="Comments">'. __('1 Comment') .'</a>';
			                        } else {
				                        echo '<a href="#comments" title="Comments">'. $num_comments . __(' Comments') .'</a>';
			                        }
		                        }
		                        ?>
                            </div>
                        </div>

                        <div class="content">
	                        <?php  the_content(); ?>
                        </div>

                        <div class="next-prev-box">
                            <?php
                                if ($previous_post) {
                                    echo '<a href="'.$prev_link.'" class="btn big prev-post-btn" title="'.$prev_title.'"><i class="fa fa-angle-left" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;Previous Post</a>';
                                }
                                if ($next_post) {
                                    echo '<a href="'.$next_link.'" class="btn big next-post-btn" title="'.$next_title.'">Next post&nbsp;&nbsp;&nbsp;<i class="fa fa-angle-right" aria-hidden="true"></i></a>';
                                }
                            ?>

                        </div>

                        <?php
                            if ( comments_open() || get_comments_number() ) {
                                comments_template();
                            }
                        ?>
                    </div>
                </div>
            </div>

            <aside class="sidebar">
	            <?php get_sidebar(); ?>
            </aside>

        </div>
    </section>
<?php endwhile; else: endif; ?>


<?php get_footer(); ?>