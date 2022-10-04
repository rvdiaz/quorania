<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package quorania-microsite
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'quorania-microsite' ); ?></a>

	<header id="masthead" class="site-header">
		<div class="site-header--container">
			<div class="site-branding">
				<?php
				the_custom_logo();
				if ( is_front_page() && is_home() ) :
					?>
					<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
					<?php
				else :
					?>
					<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
					<?php
				endif;
				$quorania_microsite_description = get_bloginfo( 'description', 'display' );
				if ( $quorania_microsite_description || is_customize_preview() ) :
					?>
					<p class="site-description"><?php echo $quorania_microsite_description; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>
				<?php endif; ?>
			</div><!-- .site-branding -->

			<nav id="site-navigation" class="main-navigation">
				<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Primary Menu', 'quorania-microsite' ); ?></button>
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'menu-1',
						'menu_id'        => 'primary-menu',
					)
				);
				?>
			</nav><!-- #site-navigation -->
			<?php 
			if(isset($_REQUEST['logout'])){
				wp_destroy_current_session();
				wp_clear_auth_cookie();
				wp_set_current_user( 0 );
			}
			$user=wp_get_current_user();
			if(!$user->exists()){ 
			?>
			<a href="<?php echo get_site_url() ?>/acceso"><img src="<?php echo wp_get_upload_dir()['baseurl'].'/2022/09/user-1.svg'; ?>"></a>
			<?php }else {?>
				<form action="#">
					<button class="logout_button" type="submit" name="logout">
						<span>Hola,  <?php echo $user->user_login ?></span>
						<img src="<?php echo wp_get_upload_dir()['baseurl'].'/2022/09/Ellipse-23.svg'; ?>"/></button>
				</form>	
			<?php } ?>
		</div>
	</header><!-- #masthead -->
