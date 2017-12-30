<?php
// loading styles and scripts
function load_style_script(){
    wp_enqueue_style('fonts', '//fonts.googleapis.com/css?family=Anton|Montserrat|Open+Sans|Pathway+Gothic+One', array(), null);
    wp_enqueue_style('font-awesome.min', '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css', array(), '4.7.0');
    wp_enqueue_style('styles', get_template_directory_uri() . '/assets/css/screen.css', array(), null );
    wp_enqueue_style('style', get_stylesheet_uri(), array(), null );

	wp_deregister_script( 'jquery' );
	if (comments_open() && is_single()) {
		wp_enqueue_script( 'comment-reply' );
	}
	wp_enqueue_script('jquery', '//ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js', array(), '3.2.1', true );
	wp_enqueue_script('jquery.validate', '//cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.min.js', array(), '1.17.0', true );
    wp_enqueue_script('smooth-scroll.min', get_template_directory_uri() . '/assets/js/smooth-scroll.min.js', array(), '10.2.0', true );
    wp_enqueue_script('scripts', get_template_directory_uri() . '/assets/js/custom/scripts.js', array('jquery'), null, true );
}
add_action('wp_enqueue_scripts', 'load_style_script');



// add ie conditional html5 shiv to header
function add_ie_html5_shiv () {
    global $is_IE;
    if ($is_IE) {
        echo '<!--[if lt IE 9]>';
        echo '<script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>';
        echo '<![endif]-->';
    }
}
add_action('wp_head', 'add_ie_html5_shiv');


// logo at the entrance to the admin panel
function my_custom_login_logo(){
    echo '<style type="text/css">
            h1 a {height:32px !important; width:320px !important; background-size:contain !important; background-image:url('.get_bloginfo("template_url").'/img/logo.png) !important;}
        </style>';
}
add_action('login_head', 'my_custom_login_logo');

add_filter( 'login_headerurl', create_function('', 'return get_home_url();') );
add_filter( 'login_headertitle', create_function('', 'return false;') );


// no information explaining the situation will appear when an incorrect login or password is entered
add_filter('login_errors',create_function('$a', "return null;"));


// delete unnecessary items in wp_head
remove_action( 'wp_head', 'feed_links_extra', 3 );
remove_action( 'wp_head', 'feed_links', 2 );
remove_action( 'wp_head', 'rsd_link' );
remove_action( 'wp_head', 'wlwmanifest_link' );
remove_action( 'wp_head', 'index_rel_link' );
remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );
remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );
remove_action( 'wp_head', 'adjacent_posts_rel_link', 10, 0 );
remove_action( 'wp_head', 'wp_generator' );


// remove the wrapped <p> tag from images in the content
function filter_ptags_on_images($content){
   return preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
}
add_filter('the_content', 'filter_ptags_on_images');


// automatic generation of the tag <title>
add_theme_support( 'title-tag' );
// adding html5 markup
add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption' ) );

// support custom logo
add_theme_support( 'custom-logo', array(
    'flex-height' => true,
    'flex-width'  => true
) );
add_theme_support( 'custom-logo' );


// support thumbnails
if ( function_exists( 'add_theme_support' ) ) {
    add_theme_support( 'post-thumbnails' );
}

//custom thumbnails size
//if ( function_exists( 'add_image_size' ) ) {
//    add_image_size( 'blog-thumb', 258, 172, true );
//}

// support menus
if ( function_exists( 'register_nav_menus' ) ) {
    register_nav_menus(array(
        'main-menu'     => 'Main Menu',
	    'footer-menu'     => 'Footer Menu'
    ));
}

// for excerpts
function new_excerpt_more( $more ) {
    return '&nbsp;&hellip;';
}
add_filter( 'excerpt_more', 'new_excerpt_more' );

// for Options Page
if (function_exists('acf_set_options_page_menu')){
	acf_add_options_page('Theme Options');
}


//for widget
//require_once('inc/custom_widget.php' );

function new_excerpt_length($length) {
  return 30;
}
add_filter('excerpt_length', 'new_excerpt_length');


// register widget panels
function register_my_widgets(){
    register_sidebar( array(
        'name'          => 'Sidebar',
        'id'            => 'sidebar',
        'class'         => 'sidebar',
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => "</section>\n",
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => "</h4>\n",
    ) );
}
add_action( 'widgets_init', 'register_my_widgets' );



/* Hack on overwriting the guid parameter when publishing or updating a post in the admin panel (the permalink in the current structure is written)
--------------------------------------------------------------------------------------------------------------------------------- */
function guid_write( $id ){
    if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE  ) return false; // if this is autosave

    global $wpdb;

    if( $id = (int) $id )
        $wpdb->query("UPDATE $wpdb->posts SET guid='". get_permalink($id) ."' WHERE ID=$id LIMIT 1");
}
add_action ('save_post', 'guid_write', 100);



// prohibit access to the file editor by a direct link wp-admin/theme-editor.php:
function disable_editing_theme() {
    if (stripos($_SERVER['PHP_SELF'], '/wp-admin/theme-editor.php')) :
        wp_redirect(admin_url());
        exit;
    endif;
}
add_action('admin_init', 'disable_editing_theme', 999);

// Delete the menu item Editor from the admin menu:
function remove_theme_editor_page() {
    remove_submenu_page('themes.php', 'theme-editor.php');
}
add_action('admin_menu', 'remove_theme_editor_page', 999);


// get current URL
function current_url() {
    global $wp;
    if(!$wp->did_permalink){
        $output = home_url(add_query_arg($wp->query_string));
    } else {
        $output = home_url(add_query_arg(array(),$wp->request).'/');
    }

    return $output;
}

// add svg
function add_file_types_to_uploads($file_types){
	$new_filetypes = array();
	$new_filetypes['svg'] = 'image/svg+xml';
	$file_types = array_merge($file_types, $new_filetypes );
	return $file_types;
}
add_action('upload_mimes', 'add_file_types_to_uploads');

//custom comments
require_once('inc/custom_comment.php' );

//coaches shortcode
function coaches_shortcode_func($atts){
	extract( shortcode_atts( array(
		'id' => ''
	), $atts ) );
	$id = $atts['id'];
	$output = '';
	$coaches = get_field('coaches', $id);
	if ($coaches && is_array($coaches)) {
		$count = 1;
		$output .= '<div class="coaches-box"><ul class="coaches-list">';
		foreach ($coaches as $coach) {
			$photo = $coach['photo'];
			$name = $coach['name'];
			$region = $coach['region'];
			$division = $coach['division'];
			$age = $coach['age'];
			$height = $coach['height'];
			$weight = $coach['weight'];
			$affiliate = $coach['affiliate'];
			$team = $coach['team'];
			$social_links = $coach['social_links'];

			$output .= '<li>
							<div class="coach-box">';
				if ($photo) {
					$output .= '<div class="coach-img-wrap">
		                            <img src="'.$photo.'" alt="'.$name.'">
		                        </div>';
				}
				if ($name) { $output .= '<h3 class="coach-name">'.$name.'</h3>'; }
				if ($region || $division || $age || $height || $weight || $affiliate || $team) {
					$output .= '<ul class="coach-info-list">';
					if ($region) {
						$output .= '<li>
										<div class="coach-info-table">';
						if ( $count % 2 ) {
							$output .= '<span class="coach-info-title">Region</span>
	                                           <span>' . $region . '</span>';
						} else {
							$output .= ' <span>' . $region . '</span>
												<span class="coach-info-title">Region</span>';
						}
							$output .= '</div>
									</li>';
					}
					if ($division) {
						$output .= '<li>
										<div class="coach-info-table">';
						if ( $count % 2 ) {
							$output .= '<span class="coach-info-title">Division</span>
                                   <span>' . $division . '</span>';
						} else {
							$output .= '<span>' . $division . '</span>
									<span class="coach-info-title">Division</span>';
						}
							$output .= '</div>
									</li>';
					}
					if ($age) {
						$output .= '<li>
										<div class="coach-info-table">';
						if ( $count % 2 ) {
							$output .= '<span class="coach-info-title">Age</span>
                                   <span>' . $age . '</span>';
						} else {
							$output .= ' <span>' . $age . '</span>
									<span class="coach-info-title">Age</span>';
						}
							$output .= '</div>
									</li>';
					}
					if ($height) {
						$output .= '<li>
										<div class="coach-info-table">';
						if ( $count % 2 ) {
							$output .= '<span class="coach-info-title">Height</span>
                                   <span>' . $height . '</span>';
						} else {
							$output .= ' <span>' . $height . '</span>
									<span class="coach-info-title">Height</span>';
						}
							$output .= '</div>
									</li>';
					}
					if ($weight) {
						$output .= '<li>
										<div class="coach-info-table">';
						if ( $count % 2 ) {
							$output .= '<span class="coach-info-title">Weight</span>
                                   <span>' . $weight . '</span>';
						} else {
							$output .= ' <span>' . $weight . '</span>
									<span class="coach-info-title">Weight</span>';
						}
							$output .= '</div>
									</li>';
					}
					if ($affiliate) {
						$output .= '<li>
										<div class="coach-info-table">';
						if ( $count % 2 ) {
							$output .= '<span class="coach-info-title">Affiliate</span>
                                   <span>' . $affiliate . '</span>';
						} else {
							$output .= ' <span>' . $affiliate . '</span>
									<span class="coach-info-title">Affiliate</span>';
						}
							$output .= '</div>
									</li>';
					}
					if ($team) {
						$output .= '<li>
										<div class="coach-info-table">';
						if ( $count % 2 ) {
							$output .= '<span class="coach-info-title">Team</span>
                                   <span>' . $team . '</span>';
						} else {
							$output .= ' <span>' . $team . '</span>
									<span class="coach-info-title">Team</span>';
						}
							$output .= '</div>
									</li>';
					}
					$output .= '</ul>';

					if ($social_links && is_array($social_links)) {
						$output .='<ul class="coach-social-list">';
						foreach ($social_links as $link) {
							$facebook = $link['facebook'];
							$instagram = $link['instagram'];
							if ($facebook) {
								$output .='<li>
			                                <a href="'.$facebook.'" title="'.$name.'"><i class="fa fa-facebook" aria-hidden="true"></i></a>
			                            </li>';
							}
							if ($instagram) {
								$output .='<li>
			                                <a href="'.$instagram.'" title="'.$name.'"><i class="fa fa-instagram" aria-hidden="true"></i></a>
			                            </li>';
							}
						}
						$output .='</ul>';
					}
				}
			$output .= '	</div>
						</li>';
			$count++;
		}
		$output .= '</ul>
				</div>';
	}


	/*
	$output .= ' <ul class="coaches-list">
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
                                    <span>5\'10"</span>
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
                                    <span>6\'0"</span>
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
            </ul>';
*/
	return $output;
}

add_shortcode('coaches', 'coaches_shortcode_func' );