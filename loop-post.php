<?php 
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
?>
<li>
    <div class="blog-box">
        <div class="blog-top-box">
            <div class="blog-date">
                <span><?php echo $month; ?></span>
                <span class="month"><?php echo $date; ?></span>
            </div>
            <div class="blog-logo-wrap">
                <a href="<?php the_permalink(); ?>" title="<?= esc_attr($title); ?>">
	                <?php the_post_thumbnail('full', array(
		                'alt'   => esc_attr($post->post_title)
	                )); ?>
                </a>
            </div>
        </div>
        <a href="<?php the_permalink(); ?>" title="<?= esc_attr($title); ?>">
            <h2 class="blog-list-title"><?php echo $title; ?></h2>
        </a>
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
	                    echo '<a href="'. get_permalink() .'#comments" title="Comments">'. __('1 Comment') .'</a>';
                    } else {
	                    echo '<a href="'. get_permalink() .'#comments" title="Comments">'. $num_comments . __(' Comments') .'</a>';
                    }
                }
            ?>
        </div>
        <div class="blog-desc">
            <?php the_excerpt(); ?>
        </div>
        <a href="<?php the_permalink(); ?>" class="btn big pink" title="<?= esc_attr($title); ?>">Learn more</a>
    </div>
</li>