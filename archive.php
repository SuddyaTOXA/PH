<?php get_header(); ?>
    <section class="section section-blog">
        <div class="container">
            <div class="content-wrap">
                <div class="content-inner">
					<?php

					global $new_query;
					$paged = get_query_var('paged') ? get_query_var('paged') : 1;
					$args = array(
						'post_type'     => 'post',
						'post_status'   => 'publish',
						'orderby'       => 'date',
						'order'         => 'DESC',
						'paged'         => $paged,
					);
					$new_query = new WP_Query( $args );

					if ($new_query->have_posts()) {
						echo '<ul class="blog-list">';
						while ($new_query->have_posts()) {
							$new_query->the_post();
							get_template_part('loop', 'post');
						}
						echo '</ul>';

						get_template_part('inc/pagination');
					} else {
						echo "<p class='no-results'>Sorry, no articles found...</p>";
					}
					wp_reset_query();
					?>
					<?php /*


                    <div class="pagination-box">
                        <div class="nav-links">
                            <a class="prev page-numbers" href="#">Previous page</a>
                            <a class="page-numbers" href="#"><span class="meta-nav screen-reader-text">Page </span>1</a>
                            <span class="page-numbers current"><span class="meta-nav screen-reader-text">Page </span>2</span>
                            <a class="page-numbers" href="#"><span class="meta-nav screen-reader-text">Page </span>3</a>
                            <a class="next page-numbers" href="#">Next page</a>
                        </div>
                    </div>
                     */ ?>
                </div>
            </div>
            <aside class="sidebar">
				<?php get_sidebar(); ?>
            </aside>
        </div>
    </section>


<?php get_footer(); ?>