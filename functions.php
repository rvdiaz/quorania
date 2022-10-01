<?php
/**
 * quorania-microsite functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package quorania-microsite
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function quorania_microsite_setup() {
	/*
		* Make theme available for translation.
		* Translations can be filed in the /languages/ directory.
		* If you're building a theme based on quorania-microsite, use a find and replace
		* to change 'quorania-microsite' to the name of your theme in all the template files.
		*/
	load_theme_textdomain( 'quorania-microsite', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
		* Let WordPress manage the document title.
		* By adding theme support, we declare that this theme does not use a
		* hard-coded <title> tag in the document head, and expect WordPress to
		* provide it for us.
		*/
	add_theme_support( 'title-tag' );

	/*
		* Enable support for Post Thumbnails on posts and pages.
		*
		* @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		*/
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus(
		array(
			'menu-1' => esc_html__( 'Primary', 'quorania-microsite' ),
		)
	);

	/*
		* Switch default core markup for search form, comment form, and comments
		* to output valid HTML5.
		*/
	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'style',
			'script',
		)
	);

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	/**
	 * Add support for core custom logo.
	 *
	 * @link https://codex.wordpress.org/Theme_Logo
	 */
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		)
	);
}
add_action( 'after_setup_theme', 'quorania_microsite_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function quorania_microsite_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'quorania_microsite_content_width', 640 );
}
add_action( 'after_setup_theme', 'quorania_microsite_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function quorania_microsite_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'quorania-microsite' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'quorania-microsite' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}

add_action( 'widgets_init', 'quorania_microsite_widgets_init' );
/**
 * Enqueue scripts and styles.
 */
function quorania_microsite_scripts() {
	wp_enqueue_style( 'quorania-microsite-style', get_stylesheet_uri(), array(), _S_VERSION );
	wp_style_add_data( 'quorania-microsite-style', 'rtl', 'replace' );

	wp_enqueue_script( 'quorania-microsite-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'quorania-microsite-script', get_template_directory_uri() . '/js/custom.js', array('jquery'), _S_VERSION, true );

	wp_localize_script( 'quorania-microsite-script', 'ajax', array( 'url' => admin_url( 'admin-ajax.php' ) ) );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'quorania_microsite_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Custom posts types.
 */
require get_template_directory() . '/inc/post-types.php';

/**
 * Custom login form.
 */

function quorania_microsite_login_page() {
	
	$args = array(
	
		'echo'           => true,
		'remember'       => true,
		'form_id'        => 'loginform',
		'id_username'    => 'user_login',
		'id_password'    => 'user_pass',
		'id_submit'      => 'wp-submit',
		'label_username' => __( 'Login', 'quorania-microsite' ),
		'label_password' => __( 'Contraseña', 'quorania-microsite' ),
		'label_log_in'   => __( 'Entrar', 'quorania-microsite' ),
		'value_username' => '',
		'remember' 		 => false
		
	);
	
	wp_login_form($args);
	
}
add_shortcode('quorania-microsite-login-page', 'quorania_microsite_login_page');

function quorania_microsite_redirect_after_login_fail( $username ) {

	$referrer = $_SERVER['HTTP_REFERER']; 
	if ( !empty( $referrer ) && !strstr( $referrer,'wp-login' ) && !strstr( $referrer,'wp-admin' ) ) {
		
		$referrer = esc_url( remove_query_arg( 'login', $referrer ) );
		wp_redirect( $referrer . '?login=failed' );
		exit;
	
	}

}
add_action( 'wp_login_failed', 'quorania_microsite_redirect_after_login_fail' );
/*
function quorania_microsite_redirect_after_login_fail_blank( $user, $username, $password ) {
	
	if ( is_wp_error( $user ) && isset( $_SERVER[ 'HTTP_REFERER' ] ) && !strpos( $_SERVER[ 'HTTP_REFERER' ], 'wp-admin' ) && !strpos( $_SERVER[ 'HTTP_REFERER' ], 'wp-login.php' ) ) {
		
		$referrer = $_SERVER[ 'HTTP_REFERER' ];
		foreach ( $user->errors as $key => $error ) {

			if ( in_array( $key, array( 'empty_password', 'empty_username') ) ) {
				
				unset( $user->errors[ $key ] );
				$user->errors[ 'custom_'.$key ] = $error;
			
			}
		
		}
		
	}

	return $user;
	
}
add_filter( 'authenticate', 'quorania_microsite_redirect_after_login_fail_blank', 31, 3);*/

add_shortcode( 'pisos_page_filter', 'pisos_page_filter_result' );

function pisos_page_filter_result($atts){

	$args = array(
		   		'post_type' => 'floor',                
		   		'post_status' => 'publish',
		   	);
	if($atts && (isset($atts['bedrooms']) || isset($atts['surface']) || isset($atts['price']) )){		
		$meta_query = [];		
		if( isset($atts['bedrooms']) ){ 
			$meta_query[] = [
								'key' => 'bedrooms_number',
								'value' => $atts['bedrooms'],
								'compare' => '='
							];
		}
		if( isset($atts['surface']) ){
			$meta_query[] = [
								'key' => 'm2_builded',
								'value' => $atts['surface'],
								'compare' => '='
							];
		}
		if( isset($atts['price']) ){
			$meta_query[] = [
								'key' => 'floor_price',
								'value' => $atts['price'],
								'compare' => '<='
							];
		}
		$args['meta_query'] = $meta_query;
	}
	
	$query = new WP_Query($args);

	if ( $query->have_posts() ): ?>
	 <?php $count=1; ?>
	 <?php ob_start(); ?>	  	
	<?php	while ( $query->have_posts() ): $query->the_post();
				$terms = array();
				foreach (get_the_terms( get_the_ID(), 'building' ) as $term) {
					array_push($terms, $term->name);
				}
			    if( !isset($atts['buildings']) || ( isset($atts['buildings']) && in_array($atts['buildings'], $terms) ) ): ?>
			    	<?php $row_class = ($count%2 == 0) ? 'pisos--list--container--body--row pair' : 'pisos--list--container--body--row odd'; ?>
			    	<?php 
			    		  if(get_field('floor_reserved') == true):
			    		    $row_class = $row_class.' floor__reserved';
			    	 	  endif; 
			    	 ?>
			        <div class="<?php echo $row_class; ?>">
			         <?php $building_to_show = sizeof( get_the_terms( get_the_ID(), 'building' ) ) > 0 ? get_the_terms( get_the_ID(), 'building' )[0]->name : ''; ?>   		
					  <div class="pisos--list--container--body--row--cell"><?php echo $building_to_show; ?> </div>
					  <div class="pisos--list--container--body--row--cell"><?php echo get_field('parking_number'); ?> </div>
					  <div class="pisos--list--container--body--row--cell"><?php echo get_field('door'); ?> </div>
					  <div class="pisos--list--container--body--row--cell"><?php echo get_field('bedrooms_number'); ?> </div>
					  <div class="pisos--list--container--body--row--cell"><?php echo get_field('bathrooms_number'); ?> </div>
					  <div class="pisos--list--container--body--row--cell"><?php echo get_field('study_number'); ?> </div>
					  <div class="pisos--list--container--body--row--cell"><?php echo get_field('m2_builded'); ?> </div>
					  <div class="pisos--list--container--body--row--cell"><?php echo get_field('m2_useful'); ?> </div>
					  <div class="pisos--list--container--body--row--cell"><?php echo get_field('m2_balconies'); ?> </div>
					  <div class="pisos--list--container--body--row--cell"><?php echo get_field('m2_terraces'); ?> </div>
					  <div class="pisos--list--container--body--row--cell"><?php echo get_field('m2_garden'); ?> </div>
					  <div class="pisos--list--container--body--row--cell"><?php echo get_field('floor_price'); ?> </div>
					  <div class="pisos--list--container--body--row--cell"><a href="<?php echo get_field('floor_plane'); ?>"><img src="<?php echo wp_get_upload_dir()['url'].'/file-download-1.svg'; ?>"></a></div>
				    </div>
		  <?php $count++; endif;
		endwhile; 
		wp_reset_postdata(); ?>
	  <?php	
	endif;	

	return ob_get_clean();
}

add_action('wp_ajax_nopriv_quorania_filter', 'quorania_pisos_filter');
add_action('wp_ajax_quorania_filter', 'quorania_pisos_filter');

function quorania_pisos_filter(){
	$buiding['building'] = $_POST['building'];
	//wp_send_json( array('building' => $buiding ));
	echo json_encode($buiding);
}




