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
	wp_enqueue_style( 'lightbox-css', get_template_directory_uri() . '/assets/lightbox/css/lightbox.min.css', array(), _S_VERSION);
	wp_enqueue_style( 'videobox-css', get_template_directory_uri() . '/assets/rbox/jquery-rbox.css', array(), _S_VERSION);
	

	wp_enqueue_script( 'quorania-microsite-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );
	wp_enqueue_script( 'quorania-microsite-script', get_template_directory_uri() . '/js/user-administration.js', array('jquery'), _S_VERSION, true );
	wp_enqueue_script( 'quorania-microsite-script-map', get_template_directory_uri() . '/js/map.js', array('jquery'), _S_VERSION, true );
	wp_enqueue_script( 'quorania-microsite-script-pisos-filter', get_template_directory_uri() . '/js/pisos-filter.js', array('jquery'), _S_VERSION, true );
	wp_enqueue_script( 'quorania-microsite-script-parking-filter', get_template_directory_uri() . '/js/parking-filter.js', array('jquery'), _S_VERSION, true );

	wp_enqueue_script( 'lightbox-js', get_template_directory_uri() . '/assets/lightbox/js/lightbox.min.js', array('jquery'), _S_VERSION, true );
	wp_enqueue_script( 'videobox-js', get_template_directory_uri() . '/assets/rbox/jquery-rbox.js', array('jquery'), _S_VERSION, true );

	wp_localize_script( 'quorania-microsite-script', 'ajax', array( 'url' => admin_url( 'admin-ajax.php' ) ) );
	wp_localize_script( 'quorania-microsite-script-map', 'ajax', array( 'url' => admin_url( 'admin-ajax.php' ) ) );
	wp_localize_script( 'quorania-microsite-script-pisos-filter', 'ajax', array( 'url' => admin_url( 'admin-ajax.php' ) ) );
	wp_localize_script( 'quorania-microsite-script-parking-filter', 'ajax', array( 'url' => admin_url( 'admin-ajax.php' ) ) );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}

if( function_exists('acf_add_options_page') ) {
	
	acf_add_options_page(array(
		'page_title' 	=> 'Ubicaciones y Entornos',
		'menu_title'	=> 'Ubicaciones y Entornos',
		'menu_slug' 	=> 'theme-general-settings',
		'capability'	=> 'edit_posts',
		'icon_url' => 'dashicons-admin-site',
		'redirect'		=> false
	));
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

add_filter('login_redirect', 'my_login_redirect', 10, 3);
function my_login_redirect($redirect_to, $requested_redirect_to, $user) {
	$referrer = $_SERVER['HTTP_REFERER']; 
	$roles = $user->roles;
    if (is_wp_error($user)) {
        $error_types = array_keys($user->errors);
		if (is_array($error_types) && !empty($error_types)) {
            $error_type = $error_types[0];
        }
		if ( !empty( $referrer ) && !strstr( $referrer,'wp-login' ) && !strstr( $referrer,'wp-admin' ) ){ 
			$referrer = esc_url( remove_query_arg( 'login', $referrer ) );
			wp_redirect( $referrer . "?login=failed&reason=" . $error_type );
        	exit;
		}
    } else {

		if ( !empty( $referrer ) && !strstr( $referrer,'wp-login' ) && !strstr( $referrer,'wp-admin' ) && !$roles[0]=='Administrator')
        	return get_site_url().'/acceso';
		else
			return admin_url();
    }
}

//filtro y shortcode de pagina de pisos


add_shortcode( 'pisos_page_filter', 'pisos_page_filter_result' );
function pisos_page_filter_result($atts){
	$lenght=wp_count_posts('floor')->publish;
	$itemsPagination=10;
	$countItemPagination=$itemsPagination;
	$countPaginationClasses=1;
	$args = array(
		'post_type' => 'floor',                
		'post_status' => 'publish',
		'posts_per_page' => -1
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
	<?php while ( $query->have_posts() ): $query->the_post();
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
			if($lenght/$itemsPagination>1){
				if($count<=$countItemPagination)
					$row_class .= ' floor-pagination floor-pagination-'.$countPaginationClasses;
				else
					{
					$countPaginationClasses++;
					$row_class .= ' floor-pagination floor-pagination-'.$countPaginationClasses;	
					$countItemPagination+=$itemsPagination;
					}
			}
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
				<div class="pisos--list--container--body--row--cell"><a href="<?php echo get_field('floor_plane'); ?>" download><img src="<?php echo wp_get_upload_dir()['url'].'/file-download-1.svg'; ?>"></a></div>
			</div>
		  <?php $count++; 
		endif;
		endwhile; 
		if($lenght/$itemsPagination>1){
			$lenghtArray=intdiv($lenght,$itemsPagination);
		?>
		<div class="floor-pagination-wrapper">
			<button class="prev-button"><</button>
			<?php 
			if($lenght%$itemsPagination!=0)
			   $lenghtArray++;
				for($i=1;$i<=$lenghtArray;$i++){ ?>
				<button class="pagination-button pagination-button-<?php echo $i?>"><?php echo $i; ?></button>
			<?php } ?>
			<button class="next-button">></button>
		</div>
		<?php
		} 
		wp_reset_postdata();

endif;	
return ob_get_clean();
} 

add_action('wp_ajax_nopriv_quorania_filter', 'quorania_pisos_filter');
add_action('wp_ajax_quorania_filter', 'quorania_pisos_filter');
function quorania_pisos_filter(){
	$dataSend= $_POST['dataSend'];
	$bedroomsSelected=array();
	$buildingsSelected=array();
	$price=array();
	$surface=array();

	$itemsPagination=10;
	$countItemPagination=$itemsPagination;
	$countPaginationClasses=1;

	if($dataSend['bedrooms']){
		$bedroomsSelected=(count($dataSend['bedrooms'])>0)? 
		array(
			'key'=>"bedrooms_number",
			'value'=>$dataSend['bedrooms'],
			'compare'=>'in'
		)	
		:
		array();
	}
	if($dataSend['buildings']){
		$buildingsSelected=(count($dataSend['buildings'])>0)? 
		array(array(
			'taxonomy'=>"building",
			'field'=>'slug',
			'terms'    => $dataSend['buildings'],
			'operator' => 'IN',
		))	
		:
		array();
	}
	if($dataSend['price']){
		$price=($dataSend['price']!=$dataSend['minPrice'])? 
		array(
			'key'=>"floor_price",
			'value'=>$dataSend['price'],
			'compare'=>'<=',
			'type'=>'numeric'
		)	
		:
		array();
	}
	if($dataSend['surface']){
		$surface=($dataSend['surface']!=$dataSend['minSurface'])? 
		array(
			'key'=>"m2_builded",
			'value'=>$dataSend['surface'],
			'compare'=>'<=',
			'type'=>'numeric'
		)	
		:
		array();
	}
	$args = array();
	if(count($buildingsSelected)==0 && count($bedroomsSelected)==0 && $dataSend['price']==$dataSend['minPrice'] && $dataSend['surface']==$dataSend['minSurface']){
		$args = array(
			'post_type' => 'floor',                
			'post_status' => 'publish',
			'posts_per_page' => -1
		);	
	}else {
		$args = array(
			'post_type' => 'floor',                
			'post_status' => 'publish',
			'posts_per_page' => -1,
			'meta_query'=>array(
				$price,
				$bedroomsSelected,
				$surface
			),
			'tax_query'=>$buildingsSelected
		);	
	}	
	$query = new WP_Query($args);
	if ( $query->have_posts() ){
		$count=1;
		while ( $query->have_posts() ){
			$query->the_post();
			$length=$query->found_posts;
			$row_class = ($count%2 == 0) ? 'pisos--list--container--body--row pair' : 'pisos--list--container--body--row odd';
			if(get_field('floor_reserved') == true)
			$row_class = $row_class.' floor__reserved';
			
			if($length/$itemsPagination>1){
				if($count<=$countItemPagination){
					$row_class .= ' floor-pagination floor-pagination-'.$countPaginationClasses;
				}else
				{
				$countPaginationClasses++;
				$row_class .= ' floor-pagination floor-pagination-'.$countPaginationClasses;	
				$countItemPagination+=$itemsPagination;
				}
			}

			$building_to_show = sizeof( get_the_terms( get_the_ID(), 'building' ) ) > 0 ? get_the_terms( get_the_ID(), 'building' )[0]->name : '';
			$html.=$aux.'<div class="'.$row_class.'">	
				<div class="pisos--list--container--body--row--cell">'. $building_to_show .'</div>
				<div class="pisos--list--container--body--row--cell">'. get_field("parking_number").'</div>
				<div class="pisos--list--container--body--row--cell">'. get_field("door").'</div>
				<div class="pisos--list--container--body--row--cell">'. get_field('bedrooms_number').'</div>
				<div class="pisos--list--container--body--row--cell">'. get_field("bathrooms_number").'</div>
				<div class="pisos--list--container--body--row--cell">'. get_field("study_number").'</div>
				<div class="pisos--list--container--body--row--cell">'. get_field('m2_builded').'</div>
				<div class="pisos--list--container--body--row--cell">'. get_field("m2_useful").'</div>
				<div class="pisos--list--container--body--row--cell">'. get_field("m2_balconies").'</div>
				<div class="pisos--list--container--body--row--cell">'. get_field("m2_terraces").'</div>
				<div class="pisos--list--container--body--row--cell">'. get_field("m2_garden").'</div>
				<div class="pisos--list--container--body--row--cell">'. get_field('floor_price').'</div>
				<div class="pisos--list--container--body--row--cell"><a href="'.get_field('floor_plane').'"download><img src="'.wp_get_upload_dir()["url"].'/file-download-1.svg"/></a></div></div>';
				$count++;
			}
				if($length/$itemsPagination>1){
				$lenghtArray=intdiv($length,$itemsPagination);
				$html.='<div class="floor-pagination-wrapper">
					<button class="prev-button"><</button>';
				if($length%$itemsPagination!=0){
			  		$lenghtArray++;
				}
				for($i=1;$i<=$lenghtArray;$i++){
					$html.='<button class="pagination-button pagination-button-'.$i.'">'.$i.'</button>';
				}
				$html.='<button class="next-button">></button></div>';
				}
			
		echo $html;
	
	} else
	echo '<p class="not-results-filter">No se encontraron resultados</p>';
	wp_die();
}

//filtro y shortcode de pagina de trasteros o parqueos

add_shortcode( 'parking_page_filter', 'parking_page_filter_result' );
function parking_page_filter_result($atts){
	$lenght=wp_count_posts('parking_boxroom')->publish;
	$itemsPagination=10;
	$countItemPagination=$itemsPagination;
	$countPaginationClasses=1;
	$args = array(
		   		'post_type' => 'parking_boxroom',                
		   		'post_status' => 'publish',
				'posts_per_page' => -1
		   	);
	$query = new WP_Query($args);

	if ( $query->have_posts() ): ?>
	 <?php $count=1; ?> 	
	<?php	while ( $query->have_posts() ): $query->the_post();
				$terms = array();
				foreach (get_the_terms( get_the_ID(), 'building' ) as $term) {
					array_push($terms, $term->name);
				}
			    if( !isset($atts['buildings']) || ( isset($atts['buildings']) && in_array($atts['buildings'], $terms) ) ): ?>
			    	<?php $row_class = ($count%2 == 0) ? 'pisos--list--container--body--row pair' : 'pisos--list--container--body--row odd'; ?>
			    	<?php 
			    		  if(get_field('parking_reserved') == true):
			    		    $row_class = $row_class.'parking_reserved';
			    	 	  endif; 
					
						if($lenght/$itemsPagination>1){
							if($count<=$countItemPagination)
								$row_class .= ' floor-pagination floor-pagination-'.$countPaginationClasses;
							else
								{
								$countPaginationClasses++;
								$row_class .= ' floor-pagination floor-pagination-'.$countPaginationClasses;	
								$countItemPagination+=$itemsPagination;
								}
						}
					 ?>
			        <div class="<?php echo $row_class; ?> row-parking">
			         	<?php $building_to_show = sizeof( get_the_terms( get_the_ID(), 'building' ) ) > 0 ? get_the_terms( get_the_ID(), 'building' )[0]->name : ''; ?>   		
					 	<div class="pisos--list--container--body--row--cell"><?php echo get_the_title(); ?> </div>  
					 	<div class="pisos--list--container--body--row--cell"><?php echo get_field('floor_number'); ?> </div>
						<div class="pisos--list--container--body--row--cell"><?php echo $building_to_show; ?> </div>
					  	<div class="pisos--list--container--body--row--cell"><?php echo get_field('parking_price'); ?> </div>
					  	<div class="pisos--list--container--body--row--cell"><?php echo get_field('escalera'); ?> </div>
					  	<div class="pisos--list--container--body--row--cell"><a href="<?php echo get_field('parking_plane'); ?>" download><img src="<?php echo wp_get_upload_dir()['url'].'/file-download-1.svg'; ?>"></a></div>
				    </div>
		  <?php $count++; endif;
		endwhile; 
		if($lenght/$itemsPagination>1){
			$lenghtArray=intdiv($lenght,$itemsPagination);
		?>
		<div class="floor-pagination-wrapper">
			<button class="prev-button"><</button>
			<?php 
			if($lenght%$itemsPagination!=0)
			   $lenghtArray++;
				for($i=1;$i<=$lenghtArray;$i++){ ?>
				<button class="pagination-button pagination-button-<?php echo $i?>"><?php echo $i; ?></button>
			<?php } ?>
			<button class="next-button">></button>
		</div>
		<?php
		} 
		wp_reset_postdata(); ?>
	  <?php	
	endif;	

	return ob_get_clean();
}
add_action('wp_ajax_nopriv_quorania_filter_parking', 'quorania_pisos_filter_parking');
add_action('wp_ajax_quorania_filter_parking', 'quorania_pisos_filter_parking');

function quorania_pisos_filter_parking(){
	$dataSend= $_POST['dataSend'];
	$buildingsSelected=array();
	$price=array();
	$tipoSelected=array();
	$tipoOpcion1=array();
	$tipoOpcion2=array();
	$html='';

	$itemsPagination=10;
	$countItemPagination=$itemsPagination;
	$countPaginationClasses=1;


	 if($dataSend['buildings']){
		$buildingsSelected=(count($dataSend['buildings'])>0)? 
		array(
			array(
			'taxonomy'=>"building",
			'field'=>'slug',
			'terms'    => $dataSend['buildings'],
			'operator' => 'IN',
		))	
		:
		array();
	}
	
	if($dataSend['price']){
		$price=($dataSend['price']!=$dataSend['minPrice'])? 
		array(
			'key'=>"parking_price",
			'value'=>$dataSend['price'],
			'compare'=>'<=',
			'type'=>'numeric'
		)	
		:
		array();
	}
	
	if($dataSend['tipo']){
		$tipoSelected=count($dataSend['tipo']);
		if($tipoSelected>0){
			$tipoOpcion1 = array(
				'key'=>'tipo',
				'value'=>$dataSend['tipo'][0],
				'compare'=>'LIKE'
			);
			if($tipoSelected>1)
			$tipoOpcion2 = array(
				'key'=>'tipo',
				'value'=>$dataSend['tipo'][1],
				'compare'=>'LIKE'
			);
		}
	}

	$args = array();
	if(count($buildingsSelected)==0 && $tipoSelected==0 && $dataSend['price']==$dataSend['minPrice']){
		$args = array(
			'post_type' => 'parking_boxroom',                
			'post_status' => 'publish',
			'posts_per_page' => -1
		);	
	}else {
		$args = array(
			'post_type' => 'parking_boxroom',                
			'post_status' => 'publish',
			'posts_per_page' => -1,
			'meta_query'=>array(
				array(
					'relation' => 'OR',
					$tipoOpcion1,
					$tipoOpcion2
				),
				$price
			),
			'tax_query'=>$buildingsSelected
		);
	}	 
	$query = new WP_Query($args);
	if ( $query->have_posts() ){
		 $count=1;
		 while ( $query->have_posts() ){
			$length=$query->found_posts;
			$query->the_post();
			$building=get_the_terms( get_the_ID(), 'building' )[0]->name;
			$row_class = ($count%2 == 0) ? 'pisos--list--container--body--row pair' : 'pisos--list--container--body--row odd';

			if($length/$itemsPagination>1){
				if($count<=$countItemPagination){
					$row_class .= ' floor-pagination floor-pagination-'.$countPaginationClasses;
				}else
				{
				$countPaginationClasses++;
				$row_class .= ' floor-pagination floor-pagination-'.$countPaginationClasses;	
				$countItemPagination+=$itemsPagination;
				}
			}

			if(get_field('parking_reserved') == true)
			    $row_class = $row_class.' floor__reserved';
				$html.='<div class="'.$row_class.' row-parking">	
				<div class="pisos--list--container--body--row--cell">'. get_the_title().'</div>
				<div class="pisos--list--container--body--row--cell">'. get_field('floor_number').'</div>
				<div class="pisos--list--container--body--row--cell">'. $building.'</div>
				<div class="pisos--list--container--body--row--cell">'. get_field('parking_price').'</div>
				<div class="pisos--list--container--body--row--cell">'. get_field('escalera').'</div>
				<div class="pisos--list--container--body--row--cell"><a href="'.get_field('parking_plane').'" download><img src="'.wp_get_upload_dir()['url'].'/file-download-1.svg"/></a></div></div>';
			$count++;
		} 
		if($length/$itemsPagination>1){
			$lenghtArray=intdiv($length,$itemsPagination);
			$html.='<div class="floor-pagination-wrapper">
				<button class="prev-button"><</button>';
			if($length%$itemsPagination!=0){
				  $lenghtArray++;
			}
			for($i=1;$i<=$lenghtArray;$i++){
				$html.='<button class="pagination-button pagination-button-'.$i.'">'.$i.'</button>';
			}
			$html.='<button class="next-button">></button></div>';
			}
			echo $html;
	}else 
		echo '<p class="not-results-filter">No se encontraron resultados</p>';

		wp_die();	
}

//unzip html files before ACF UPLOAD FILE
function pre_save_post( $post_id ) {

    // vars
    $title = $post_id; // $_POST['fields']['field_5b334ccda54b8'];
    $group_tour_virtual = get_field('group_tour_virtual', $post_id);
	$group_tour_virtual_tour = $group_tour_virtual["group_tour_virtual_tour"];
	$count = 0;
	foreach( $group_tour_virtual_tour as $tour ) {
		if ($count > 0) {
			break;
		}
		$count++;
		$attachment_id = $tour['group_tour_virtual_tour_file']['url'];
	}
	
    // $file_name_without_zip = preg_replace('/.zip$/', '', $file_name);
    // $timestamp = time();

    // echo ('<pre>');
    // print_r($attachment_id);
    // echo ('</pre>');
    
    if( $post_id && $attachment_id ) {  //what should go here?
        require_once(ABSPATH .'/wp-admin/includes/file.php');
        WP_Filesystem();
		//global $wp_filesystem;
        $destination = wp_upload_dir();

        // CREAMOS LA CARPETA CON EL POST-ID SI NO EXISTE
        $save_folder = $title;		
        if (!file_exists( $destination['basedir'] . '/tour-virtual/'. $save_folder )) {            
			//$wp_filesystem->rmdir($destination['basedir'] . '/tour-virtual/'.$save_folder, true);
			wp_mkdir_p( $destination['basedir'] . '/tour-virtual/'.$save_folder, 0777);
        }
        
        // RUTAS
        $uploads_path = $destination['path'];
        $destination_path = $destination['basedir'] . '/tour-virtual/' . $save_folder . '/';
        $zip_file = $uploads_path .'/'. $tour['group_tour_virtual_tour_file']['filename'];

		error_log("SIIII".$zip_file );
		error_log("SIIII".$destination_path );

        // UNZIP FILE
        $unzipfile = unzip_file( $zip_file, $destination_path);

        // echo 'destination: '.$destination;
        // echo 'uploads_path: '.$uploads_path;
        // echo 'destination_path: '.$destination_path;
        // echo 'filename: '.$attachment_id['filename'];
        // echo 'zip_file: '.$zip_file;
        // die();

    }

    // return the new ID
    return $post_id;
}
add_action( 'save_post', 'pre_save_post' );