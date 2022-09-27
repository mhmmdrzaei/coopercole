<?php

/** Tell WordPress to run theme_setup() when the 'after_setup_theme' hook is run. */

if ( ! function_exists( 'theme_setup' ) ):

function theme_setup() {

	/* This theme uses post thumbnails (aka "featured images")
	*  all images will be cropped to thumbnail size (below), as well as
	*  a square size (also below). You can add more of your own crop
	*  sizes with add_image_size. */
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size(120, 90, true);
	add_image_size('square', 150, 150, true);



	// Add default posts and comments RSS feed links to head
	add_theme_support( 'automatic-feed-links' );

	/* This theme uses wp_nav_menu() in one location.
	* You can allow clients to create multiple menus by
  * adding additional menus to the array. */
	register_nav_menus( array(
		'primary' => 'Primary Navigation',
		'exhibtionYears' =>'Exhibtion Years'
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
	) );

}
endif;

add_action( 'after_setup_theme', 'theme_setup' );

/* Add all our CSS files here.
We'll let WordPress add them to our templates automatically instead
of writing our own link tags in the header. */

function cooper_styles(){
	wp_enqueue_style('style', get_stylesheet_uri() );

	wp_enqueue_style('fontawesome', '//use.fontawesome.com/releases/v5.0.7/css/all.css');
}

add_action( 'wp_enqueue_scripts', 'cooper_styles');

function wpb_add_google_fonts() {
 
wp_enqueue_style( 'wpb-google-fonts', 'https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,400;0,700;1,400;1,700&display=swap', false ); 
}
 
add_action( 'wp_enqueue_scripts', 'wpb_add_google_fonts' );
/* Add all our JavaScript files here.
We'll let WordPress add them to our templates automatically instead
of writing our own script tags in the header and footer. */

function cooper_scripts() {

	//Don't use WordPress' local copy of jquery, load our own version from a CDN instead
	// wp_deregister_script('ymlp');
 //  wp_enqueue_script(
 //  	'ymlp',
 //  	"https" . ($_SERVER['SERVER_PORT'] == 443 ? "s" : "") . "://signup.ymlp.com/signup.js?id=guqjmsegmgs",
 //  	false, //dependencies
 //  	null, //version number
 //  	true //load in footer
 //  );
  	// wp_deregister_script('masonryjs');
   //  wp_enqueue_script(
   //  	'masonaryjs',
   //  	"https" . ($_SERVER['SERVER_PORT'] == 443 ? "s" : "") . "://masonry.desandro.com/masonry.pkgd.js",
   //  	false, //dependencies
   //  	null, //version number
   //  	true //load in footer
   //  );
	wp_deregister_script('swiperjs');
  wp_enqueue_script(
  	'swiperjs',
  	"https" . ($_SERVER['SERVER_PORT'] == 443 ? "s" : "") . "://unpkg.com/swiper/swiper-bundle.min.js",
  	false, //dependencies
  	null, //version number
  	true //load in footer
  );
  	wp_deregister_script('jquery');
  wp_enqueue_script(
  	'jquery',
  	"https" . ($_SERVER['SERVER_PORT'] == 443 ? "s" : "") . "://code.jquery.com/jquery-latest.min.js",
  	false, //dependencies
  	null, //version number
  	true //load in footer
  );

  wp_enqueue_script(
    'plugins', //handle
    get_template_directory_uri() . '/js/plugins.js', //source
    false, //dependencies
    null, // version number
    true //load in footer
  );

  wp_enqueue_script(
    'scripts', //handle
    get_template_directory_uri() . '/js/main.min.js', //source
    array( 'jquery', 'plugins' ), //dependencies
    null, // version number
    true //load in footer
  );
  wp_localize_script( 'scripts', 'AjaxHandler', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );



  wp_enqueue_script( 'modernizr', get_template_directory_uri() . '/js/modernizr/modernizr-2.8.3.min.js', null, null, false );
}


add_action( 'wp_enqueue_scripts', 'cooper_scripts');



/* Custom Title Tags */

function hackeryou_wp_title( $title, $sep ) {
	global $paged, $page;

	if ( is_feed() ) {
		return $title;
	}

	// Add the site name.
	$title .= get_bloginfo( 'name', 'display' );

	// Add the site description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) ) {
		$title = "$title $sep $site_description";
	}

	// Add a page number if necessary.
	if ( ( $paged >= 2 || $page >= 2 ) && ! is_404() ) {
		$title = "$title $sep " . sprintf( __( 'Page %s', 'hackeryou' ), max( $paged, $page ) );
	}

	return $title;
}
add_filter( 'wp_title', 'hackeryou_wp_title', 10, 2 );

/*
  Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 */
function hackeryou_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'hackeryou_page_menu_args' );


/*
 * Sets the post excerpt length to 40 characters.
 */
function hackeryou_excerpt_length( $length ) {
	return 70;
}
add_filter( 'excerpt_length', 'hackeryou_excerpt_length' );

/*
 * Returns a "Continue Reading" link for excerpts
 */
function hackeryou_continue_reading_link() {
	return '<br> <a class="newsReadMore" href="'. get_permalink() . '">Read More <span class="meta-nav"></span></a>';
}

/**
 * Replaces "[...]" (appended to automatically generated excerpts) with an ellipsis and hackeryou_continue_reading_link().
 */
function hackeryou_auto_excerpt_more( $more ) {
	return ' &hellip;' . hackeryou_continue_reading_link();
}
add_filter( 'excerpt_more', 'hackeryou_auto_excerpt_more' );

/**
 * Adds a pretty "Continue Reading" link to custom post excerpts.
 */
function hackeryou_custom_excerpt_more( $output ) {
	if ( has_excerpt() && ! is_attachment() ) {
		$output .= hackeryou_continue_reading_link();
	}
	return $output;
}
add_filter( 'get_the_excerpt', 'hackeryou_custom_excerpt_more' );


/*
 * Register a single widget area.
 * You can register additional widget areas by using register_sidebar again
 * within hackeryou_widgets_init.
 * Display in your template with dynamic_sidebar()
 */
function hackeryou_widgets_init() {
	// Area 1, located at the top of the sidebar.
	register_sidebar( array(
		'name' => 'Primary Widget Area',
		'id' => 'primary-widget-area',
		'description' => 'The primary widget area',
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

}

add_action( 'widgets_init', 'hackeryou_widgets_init' );

/**
 * Removes the default styles that are packaged with the Recent Comments widget.
 */
function hackeryou_remove_recent_comments_style() {
	global $wp_widget_factory;
	remove_action( 'wp_head', array( $wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style' ) );
}
add_action( 'widgets_init', 'hackeryou_remove_recent_comments_style' );


if ( ! function_exists( 'hackeryou_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post—date/time and author.
 */
function hackeryou_posted_on() {
	printf('<span class="%1$s">Posted on</span> %2$s <span class="meta-sep">by</span> %3$s',
		'meta-prep meta-prep-author',
		sprintf( '<a href="%1$s" title="%2$s" rel="bookmark"><span class="entry-date">%3$s</span></a>',
			get_permalink(),
			esc_attr( get_the_time() ),
			get_the_date()
		),
		sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s">%3$s</a></span>',
			get_author_posts_url( get_the_author_meta( 'ID' ) ),
			sprintf( esc_attr( 'View all posts by %s'), get_the_author() ),
			get_the_author()
		)
	);
}
endif;

if ( ! function_exists( 'hackeryou_posted_in' ) ) :
/**
 * Prints HTML with meta information for the current post (category, tags and permalink).
 */
function hackeryou_posted_in() {
	// Retrieves tag list of current post, separated by commas.
	$tag_list = get_the_tag_list( '', ', ' );
	if ( $tag_list ) {
		$posted_in = 'This entry was posted in %1$s and tagged %2$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.';
	} elseif ( is_object_in_taxonomy( get_post_type(), 'category' ) ) {
		$posted_in = 'This entry was posted in %1$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.';
	} else {
		$posted_in = 'Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.';
	}
	// Prints the string, replacing the placeholders.
	printf(
		$posted_in,
		get_the_category_list( ', ' ),
		$tag_list,
		get_permalink(),
		the_title_attribute( 'echo=0' )
	);
}
endif;

/* Get rid of junk! - Gets rid of all the crap in the header that you dont need */

function clean_stuff_up() {
	// windows live
	remove_action('wp_head', 'rsd_link');
	remove_action('wp_head', 'wlwmanifest_link');
	// wordpress gen tag
	remove_action('wp_head', 'wp_generator');
	// comments RSS
	remove_action( 'wp_head', 'feed_links_extra', 3 );
	remove_action( 'wp_head', 'feed_links', 3 );
}

add_action('init', 'clean_stuff_up');


/* Here are some utility helper functions for use in your templates! */

/* pre_r() - makes for easy debugging. <?php pre_r($post); ?> */
function pre_r($obj) {
	echo "<pre>";
	print_r($obj);
	echo "</pre>";
}

/* is_blog() - checks various conditionals to figure out if you are currently within a blog page */
function is_blog () {
	global  $post;
	$posttype = get_post_type($post );
	return ( ((is_archive()) || (is_author()) || (is_category()) || (is_home()) || (is_single()) || (is_tag())) && ( $posttype == 'post')  ) ? true : false ;
}

// /* get_post_parent() - Returns the current posts parent, if current post if top level, returns itself */
// function get_post_parent($post) {
// 	if ($post->post_parent) {
// 		return $post->post_parent;
// 	}
// 	else {
// 		return $post->ID;
// 	}
// }
//p2p

function my_connection_types() {
    p2p_register_connection_type(
    	array(
	        'name' => 'art_to_exhibition',
	        'from' => 'art',
	        'to' => 'exhibition',
	        'admin_box' => array(
				'show' => 'any',
				'context' => 'advanced'
			),
	        'to_labels' => array(
				'singular_name' => __( 'Exhibitions', 'coopercole' ),
				'search_items' => __( 'Search Exhibitions', 'coopercole' ),
				'not_found' => __( 'No exhibitions found.', 'coopercole' ),
				'create' => __( 'Create Exhibition Connections', 'coopercole' ),
			),
			'from_labels' => array(
				'singular_name' => __( 'Artwork', 'coopercole' ),
				'search_items' => __( 'Search Artwork', 'coopercole' ),
				'not_found' => __( 'No artwork found.', 'coopercole' ),
				'create' => __( 'Create Artwork Connections', 'coopercole' ),
			),
			'sortable' => 'any'
    	)
    );
    p2p_register_connection_type(
    	array(
	        'name' => 'art_to_artist',
	        'from' => 'art',
	        'to' => 'artist',
	        'admin_box' => array(
				'show' => 'any',
				'context' => 'advanced'
			),
			'to_labels' => array(
				'singular_name' => __( 'Artist', 'coopercole' ),
				'search_items' => __( 'Search Artist', 'coopercole' ),
				'not_found' => __( 'No artists found.', 'coopercole' ),
				'create' => __( 'Create Artist Connections', 'coopercole' ),
			),
			'from_labels' => array(
				'singular_name' => __( 'Artwork', 'coopercole' ),
				'search_items' => __( 'Search Artwork', 'coopercole' ),
				'not_found' => __( 'No artwork found.', 'coopercole' ),
				'create' => __( 'Create Artwork Connections', 'coopercole' ),
			),
			'sortable' => 'any'
    	)
    );
    p2p_register_connection_type(
    	array(
	        'name' => 'art_to_art_fair',
	        'from' => 'art',
	        'to' => 'art-fair',
	        'admin_box' => array(
				'show' => 'any',
				'context' => 'advanced'
			),
	        'to_labels' => array(
				'singular_name' => __( 'Art Fair', 'coopercole' ),
				'search_items' => __( 'Search Art Fairs', 'coopercole' ),
				'not_found' => __( 'No Art Fairs found.', 'coopercole' ),
				'create' => __( 'Create Art Fair Connections', 'coopercole' ),
			),
			'from_labels' => array(
				'singular_name' => __( 'Artwork', 'coopercole' ),
				'search_items' => __( 'Search Artwork', 'coopercole' ),
				'not_found' => __( 'No artwork found.', 'coopercole' ),
				'create' => __( 'Create Artwork Connections', 'coopercole' ),
			),
			'sortable' => 'any'
    	)
    );
	p2p_register_connection_type(
    	array(
	        'name' => 'exhibition_to_artist',
	        'from' => 'exhibition',
	        'to' => 'artist',
	        'admin_box' => array(
				'show' => 'any',
				'context' => 'advanced'
			),
			'from_labels' => array(
				'singular_name' => __( 'Exhibitions', 'coopercole' ),
				'search_items' => __( 'Search Exhibitions', 'coopercole' ),
				'not_found' => __( 'No exhibitions found.', 'coopercole' ),
				'create' => __( 'Create Exhibition Connections', 'coopercole' ),
			),
			'to_labels' => array(
				'singular_name' => __( 'Artists', 'coopercole' ),
				'search_items' => __( 'Search Artists', 'coopercole' ),
				'not_found' => __( 'No artists found.', 'coopercole' ),
				'create' => __( 'Create Artists Connections', 'coopercole' ),
			),
			// 'sortable' => 'any'
		)
	);
	p2p_register_connection_type(
    	array(
	        'name' => 'art_fair_to_artist',
	        'from' => 'art-fair',
	        'to' => 'artist',
	        'admin_box' => array(
				'show' => 'any',
				'context' => 'advanced'
			),
			'from_labels' => array(
				'singular_name' => __( 'Art Fair', 'coopercole' ),
				'search_items' => __( 'Search Art Fairs', 'coopercole' ),
				'not_found' => __( 'No Art Fairs found.', 'coopercole' ),
				'create' => __( 'Create Art Fair Connections', 'coopercole' ),
			),
			'to_labels' => array(
				'singular_name' => __( 'Artists', 'coopercole' ),
				'search_items' => __( 'Search Artists', 'coopercole' ),
				'not_found' => __( 'No artists found.', 'coopercole' ),
				'create' => __( 'Create Artists Connections', 'coopercole' ),
			),
			// 'sortable' => 'any'
		)
	);
	p2p_register_connection_type(
    	array(
	        'name' => 'post_to_artist',
	        'from' => 'post',
	        'to' => 'artist',
	        'admin_box' => array(
				'show' => 'any',
				'context' => 'advanced'
			),
			'from_labels' => array(
				'singular_name' => __( 'News', 'coopercole' ),
				'search_items' => __( 'Search News', 'coopercole' ),
				'not_found' => __( 'No news found.', 'coopercole' ),
				'create' => __( 'Create News Connections', 'coopercole' ),
			),
			'to_labels' => array(
				'singular_name' => __( 'Artists', 'coopercole' ),
				'search_items' => __( 'Search Artists', 'coopercole' ),
				'not_found' => __( 'No artists found.', 'coopercole' ),
				'create' => __( 'Create Artists Connections', 'coopercole' ),
			)
		)
	);
	p2p_register_connection_type(
    	array(
	        'name' => 'post_to_exhibition',
	        'from' => 'post',
	        'to' => 'exhibition',
	        'admin_box' => array(
				'show' => 'any',
				'context' => 'advanced'
			),
			'from_labels' => array(
				'singular_name' => __( 'News', 'coopercole' ),
				'search_items' => __( 'Search News', 'coopercole' ),
				'not_found' => __( 'No news found.', 'coopercole' ),
				'create' => __( 'Create News Connections', 'coopercole' ),
			),
			'to_labels' => array(
				'singular_name' => __( 'Exhibitions', 'coopercole' ),
				'search_items' => __( 'Search Exhibitions', 'coopercole' ),
				'not_found' => __( 'No exhibitions found.', 'coopercole' ),
				'create' => __( 'Create Exhibitions Connections', 'coopercole' ),
			)
		)
	);
	p2p_register_connection_type(
    	array(
	        'name' => 'post_to_art_fair',
	        'from' => 'post',
	        'to' => 'art-fair',
	        'admin_box' => array(
				'show' => 'any',
				'context' => 'advanced'
			),
			'from_labels' => array(
				'singular_name' => __( 'News', 'coopercole' ),
				'search_items' => __( 'Search News', 'coopercole' ),
				'not_found' => __( 'No news found.', 'coopercole' ),
				'create' => __( 'Create News Connections', 'coopercole' ),
			),
			'to_labels' => array(
				'singular_name' => __( 'Art Fair', 'coopercole' ),
				'search_items' => __( 'Search Art Fairs', 'coopercole' ),
				'not_found' => __( 'No Art Fairs found.', 'coopercole' ),
				'create' => __( 'Create Art Fair Connections', 'coopercole' ),
			)
		)
	);
}






function register_my_meta_box() {
	add_meta_box( 'my-box', 'Connected Artworks Images', 'render_my_meta_box', 'exhibition', );
}


	p2p_create_connection( 'art_to_exhibition', array(
		'from' => $from_id,
		'to' => $to_id,
		'meta' => array(
			'date' => current_time('mysql')
		)
	) );

	// p2p_type( 'art_to_exhibition' )->connect( $from, $to, array(
	// 	'date' => current_time('mysql')
	// ) );

function render_my_meta_box( $post ) {
	echo 'Connected Artworks Images to Check';
	$connected = p2p_type( 'art_to_exhibition' )->get_connected( $post );

	// $connected= new WP_Query( array(
	//       'connected_type' => 'art_to_exhibition',
	//       'connected_items' => get_the_id(),
	//       'nopaging' => true,
	//     ) )
?>



<ul style="list-style: none; display: flex; flex-flow:wrap; width: 100%;">
<?php while ( $connected->have_posts() ) : $connected->the_post(); ?>
	<figure>
		<?php the_post_thumbnail('thumbnail'); ?>
	</figure>
<?php endwhile; ?>
</ul>
<?php
}

add_action( 'p2p_init', 'my_connection_types' );
add_action( 'add_meta_boxes', 'register_my_meta_box' );

//convert to cm
function convert_to_cm($inches = 0) {
	return round($inches / 0.393701, 2);
}

function cmp($a, $b) {
    return strcasecmp($a->lastname, $b->lastname);
}

function coopercole_tags() {
	?>
	<div class="tags">
		<?php

		$tags = [];
		$cats = get_the_category();

		$related_artists = new WP_Query( array(
		  'connected_type' => 'post_to_artist',
		  'connected_items' => get_the_id(),
		  'nopaging' => true
		) );

		$related_exhibitions = new WP_Query( array(
		  'connected_type' => 'post_to_exhibition',
		  'connected_items' => get_the_id(),
		  'nopaging' => true
		) );

		$related_art_fairs = new WP_Query( array(
		  'connected_type' => 'post_to_art_fair',
		  'connected_items' => get_the_id(),
		  'nopaging' => true
		) );

		$i = 0;

		foreach($cats as $cat) {
			$tags[] = '<a href="'.get_category_link( $cat->term_id ).'">'.$cat->cat_name.'</a>';
		}

		if($related_artists->have_posts()) : while($related_artists->have_posts()) : $related_artists->the_post();
			$tags[] = '<a href="'.get_permalink( get_the_id() ).'">'.get_the_title(get_the_id()).'</a>';
		endwhile; endif;

		if($related_exhibitions->have_posts()) : while($related_exhibitions->have_posts()) : $related_exhibitions->the_post();
			$tags[] = '<a href="'.get_permalink(get_the_id() ).'">'.get_the_title(get_the_id()).'</a>';
		endwhile; endif;

		if($related_art_fairs->have_posts()) : while($related_art_fairs->have_posts()) : $related_art_fairs->the_post();
			$tags[] = '<a href="'.get_permalink(get_the_id() ).'">'.get_the_title(get_the_id()).'</a>';
		endwhile; endif;

		

		foreach($tags as $tag) {

			if($i > 0) {
				echo ''.$tag;
			}

			else {
				echo $tag;
			}

			$i++;

		}


		?>
	</div>
	<?php
	wp_reset_postdata();
}
function coopercole_inner_tags() {
	?>
	<div class="tagsInner">
		<?php

		$tags = [];
		$cats = get_the_category();

		$related_artists = new WP_Query( array(
		  'connected_type' => 'post_to_artist',
		  'connected_items' => get_the_id(),
		  'nopaging' => true
		) );

		$related_exhibitions = new WP_Query( array(
		  'connected_type' => 'post_to_exhibition',
		  'connected_items' => get_the_id(),
		  'nopaging' => true
		) );

		$related_art_fairs = new WP_Query( array(
		  'connected_type' => 'post_to_art_fair',
		  'connected_items' => get_the_id(),
		  'nopaging' => true
		) );

		$i = 0;

		foreach($cats as $cat) {
			$tags[] = '<a href="'.get_category_link( $cat->term_id ).'">'.$cat->cat_name.'</a>';
		}

		if($related_exhibitions->have_posts()) : while($related_exhibitions->have_posts()) : $related_exhibitions->the_post();
			$tags[] = '<a class="newsRelatedExhibitions" href="'.get_permalink(get_the_id() ).'">'.get_the_title(get_the_id()).'</a>';
		endwhile; endif;

		if($related_art_fairs->have_posts()) : while($related_art_fairs->have_posts()) : $related_art_fairs->the_post();
			$tags[] = '<a class="newsRelatedArtFairs" href="'.get_permalink(get_the_id() ).'">'.get_the_title(get_the_id()).'</a>';
		endwhile; endif; ?>
		<?php

		if($related_artists->have_posts()) : while($related_artists->have_posts()) : $related_artists->the_post();
			$tags[] = '<div class="newsRelatedArtist"> <a href="'.get_permalink( get_the_id() ).'">'.get_the_title(get_the_id()).'</a></div>';
		endwhile; endif;
		

		foreach($tags as $tag) {

			if($i > 0) {
				echo ''.$tag;
			}

			else {
				echo $tag;
			}

			$i++;

		}


		?>
	
	<?php
	wp_reset_postdata();
}
/**
 * Extend WordPress search to include custom fields
 *
 * http://adambalee.com
 */

/**
 * Join posts and postmeta tables
 *
 * http://codex.wordpress.org/Plugin_API/Filter_Reference/posts_join
 */
function cf_search_join( $join ) {
    global $wpdb;

    if ( is_search() ) {
        $join .=' LEFT JOIN '.$wpdb->postmeta. ' ON '. $wpdb->posts . '.ID = ' . $wpdb->postmeta . '.post_id ';
    }

    return $join;
}
add_filter('posts_join', 'cf_search_join' );

/**
 * Modify the search query with posts_where
 *
 * http://codex.wordpress.org/Plugin_API/Filter_Reference/posts_where
 */
function cf_search_where( $where ) {
    global $pagenow, $wpdb;

    if ( is_search() ) {
        $where = preg_replace(
            "/\(\s*".$wpdb->posts.".post_title\s+LIKE\s*(\'[^\']+\')\s*\)/",
            "(".$wpdb->posts.".post_title LIKE $1) OR (".$wpdb->postmeta.".meta_value LIKE $1)", $where );
    }

    return $where;
}
add_filter( 'posts_where', 'cf_search_where' );

/**
 * Prevent duplicates
 *
 * http://codex.wordpress.org/Plugin_API/Filter_Reference/posts_distinct
 */
function cf_search_distinct( $where ) {
    global $wpdb;

    if ( is_search() || is_page_template( 'template-sponsors.php' )) {
        return "DISTINCT";
    }

    return $where;
}
add_filter( 'posts_distinct', 'cf_search_distinct' );

//
function helper_clean_url($input) {

	// in case scheme relative URI is passed, e.g., //www.google.com/
	$input = trim($input, '/');

	// If scheme not included, prepend it
	if (!preg_match('#^http(s)?://#', $input)) {
	    $input = 'http://' . $input;
	}

	$urlParts = parse_url($input);

	// remove www
	$domain = preg_replace('/^www\./', '', $urlParts['host']);

	return $domain;

}
//
/*
*	Adjust admin bar when browsing front end
* ============================================== */


if(is_user_logged_in()) {

	// add_action('wp_head', 'offset_header', 99);

	function offset_header() { ?>

		<style type="text/css">

			.website-header, .toggle-nav, .tickets, .menu-primary {
				top:32px;
			}

			html {
				margin-top: 0 !important;
			}

			* html body {
				margin-top: 0 !important;
			}

			@media screen and ( max-width: 782px ) {
				.website-header, .toggle-nav, .tickets, .menu-primary {
					top:46px;
				}
				html {
					margin-top: 0 !important;
				}
				* html body {
					margin-top: 0 !important;
				}
			}

		</style>

	<?php }

}
//theme setup

function my_acf_init() {
	
	acf_update_setting('google_api_key', 'AIzaSyDovfUJxvALAYE_sYRVM_VLGCeb63Wrgow');
}

add_action('acf/init', 'my_acf_init');

function posts_orderby_lastname ($orderby_statement) 
{
  $orderby_statement = "RIGHT(post_title, LOCATE(' ', REVERSE(post_title)) - 1) ASC";
    return $orderby_statement;
}

function theme_setup() {

	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );

	add_image_size( 'artist-featured', 1600, 1600, false );

	register_nav_menus( array(
		'primary_menu' => 'Primary Menu',
		'mobile_menu' => 'Mobile Menu',
		'footer_menu' => 'Footer Menu',
		'social_menu' => 'Social Menu',
		'languages_menu' => 'Languages Menu'
	) );


	if( function_exists('acf_add_options_page') ) {

		// add parent
		$parent = acf_add_options_page(array(
			'page_title' 	=> 'Theme General Settings',
			'menu_title' 	=> 'Theme Settings',
			'redirect' 		=> false
		));

	}

	add_theme_support('soil-clean-up');
	add_theme_support('soil-disable-trackbacks');
	add_theme_support('soil-disable-asset-versioning');
	add_theme_support('soil-nav-walker');
	// add_theme_support('soil-js-to-footer');

}

add_action( 'after_setup_theme', 'theme_setup' );

function register_query_vars( $vars ) {
	$vars[] = 'event_status';
	return $vars;
}
add_filter( 'query_vars', 'register_query_vars' );


add_filter( 'document_title_separator', 'cyb_document_title_separator' );
function cyb_document_title_separator( $sep ) {

    $sep = 	"|";

    return $sep;

}


// inquire
//AJAX Mohammad 



/*
*	Ajax Endpoints
* ============================================== */

function featured_work() {

	$id = $_REQUEST['id'];
	$work = new Wp_Query( [
		'post_type' => 'art',
		'p' => $id
	]);

	if($work->have_posts()) :

		while($work->have_posts()) : $work->the_post();

			get_template_part('single-art');

		endwhile; wp_reset_postdata();

	endif;

	exit();

}




add_filter('wp_mail_from','yoursite_wp_mail_from');
function yoursite_wp_mail_from($content_type) {
  return 'info@coopercolegallery.com';
}
add_filter('wp_mail_from_name','yoursite_wp_mail_from_name');
function yoursite_wp_mail_from_name($name) {
  return 'Cooper Cole Gallery';
}


add_action('wp_ajax_featured_work', 'featured_work');
add_action('wp_ajax_nopriv_featured_work', 'featured_work');



function inquire() {

	parse_str($_REQUEST['data'], $output);

	if( $output['message'] != '' ) {
		echo get_field('inquiry_fail_response', 'options');
		exit();
	}

	$subject = $output['subject'];
	$name = $output['name'];
	$email = $output['email'];
	$phone = $output['phone'];
	$location = $output['location'];
	$note = $output['note'];
	$link = $output['link'];
	$headers = array(
		'Reply-To: "'.$name.'" <'.$email.'>',
		'Content-Type: text/html; charset=UTF-8'
	);

	$to = array(
		get_field('inquiry_email', 'options'),
		$email
	);

	$message = $output['inquiry_message'];

	$message .= '<p>Contact Information<br/>';
	$message .= 'Name: '.$name.'<br/>';
	$message .= 'Email: '.$email.'<br/>';
	$message .= 'Phone: '.$phone.'</br>';
	$message .= 'Location: '.$location.'</br>';
	$message .= 'Additional Notes: '.$note.'</p>';

	$response = wp_mail( $to, $subject, $message, $headers );

	if($response) {
		echo get_field('inquiry_success_response', 'options');
	}
	else {
		echo get_field('inquiry_fail_response', 'options');
	}

	// if (!$result) {
	// 	global $ts_mail_errors;
	// 	global $phpmailer;
	// 	if (!isset($ts_mail_errors)) $ts_mail_errors = array();
	// 	if (isset($phpmailer)) {
	// 		$ts_mail_errors[] = $phpmailer->ErrorInfo;
	// 	}
	// 	var_dump($ts_mail_errors);
	// }

	exit();

}
add_action('wp_ajax_inquire', 'inquire');
add_action('wp_ajax_nopriv_inquire', 'inquire');

//catagory by year

/**
 * Display archive links based on year/month and format.
 *
 * The date archives will logically display dates with links to the archive post
 * page.
 *
 * The 'limit' argument will only display a limited amount of links, specified
 * by the 'limit' integer value. By default, there is no limit. The
 * 'show_post_count' argument will show how many posts are within the archive.
 * By default, the 'show_post_count' argument is set to false.
 *
 * For the 'format', 'before', and 'after' arguments, see {@link
 * get_archives_link()}. The values of these arguments have to do with that
 * function.
 *
 * @param string|array $args Optional. Override defaults.
 */
function wp_custom_archive($args = '') {
    global $wpdb, $wp_locale;

    $defaults = array(
        'limit' => '',
        'format' => 'html', 'before' => '',
        'after' => '', 'show_post_count' => false,
        'echo' => 1
    );

    $r = wp_parse_args( $args, $defaults );
    extract( $r, EXTR_SKIP );

    if ( '' != $limit ) {
        $limit = absint($limit);
        $limit = ' LIMIT '.$limit;
    }

    // over-ride general date format ? 0 = no: use the date format set in Options, 1 = yes: over-ride
    $archive_date_format_over_ride = 0;

    // options for daily archive (only if you over-ride the general date format)
    $archive_day_date_format = 'Y/m/d';

    // options for weekly archive (only if you over-ride the general date format)
    $archive_week_start_date_format = 'Y/m/d';
    $archive_week_end_date_format   = 'Y/m/d';

    if ( !$archive_date_format_over_ride ) {
        $archive_day_date_format = get_option('date_format');
        $archive_week_start_date_format = get_option('date_format');
        $archive_week_end_date_format = get_option('date_format');
    }

    //filters
    $where = apply_filters('customarchives_where', "WHERE post_type = 'exhibition' AND post_status = 'publish'", $r );
    $join = apply_filters('customarchives_join', "", $r);

    $output = '<ul>';

        $query = "SELECT YEAR(post_date) AS `year`, MONTH(post_date) AS `month`, count(ID) as posts FROM $wpdb->posts $join $where GROUP BY YEAR(post_date), MONTH(post_date) ORDER BY post_date DESC $limit";
        $key = md5($query);
        $cache = wp_cache_get( 'wp_custom_archive' , 'general');
        if ( !isset( $cache[ $key ] ) ) {
            $arcresults = $wpdb->get_results($query);
            $cache[ $key ] = $arcresults;
            wp_cache_set( 'wp_custom_archive', $cache, 'general' );
        } else {
            $arcresults = $cache[ $key ];
        }
        if ( $arcresults ) {
            $afterafter = $after;
            foreach ( (array) $arcresults as $arcresult ) {
                $url = get_month_link( $arcresult->year, $arcresult->month );
                /* translators: 1: month name, 2: 4-digit year */
                $text = sprintf(__('%s'), $wp_locale->get_month($arcresult->month));
                $year_text = sprintf('<li>%d</li>', $arcresult->year);
                if ( $show_post_count )
                    $after = '&nbsp;('.$arcresult->posts.')' . $afterafter;
                $output .= ( $arcresult->year != $temp_year ) ? $year_text : '';
                $output .= get_archives_link($url, $text, $format, $before, $after);

                $temp_year = $arcresult->year;
            }
        }

    $output .= '</ul>';

    if ( $echo )
        echo $output;
    else
        return $output;
}




