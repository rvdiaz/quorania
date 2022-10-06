<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package quorania-microsite
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<!-- <header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header> --> <!-- .entry-header -->

	<div class="entry-content">
		<?php if(get_field( 'starter_content' )) { 
		
			echo get_field( 'starter_content' );

		} ?>
<!------------- PROMOCION  --------------------------->		

<?php include('templates/promocion.php'); ?>

<!------------- Ubicación y entorno  --------------------------->

<?php include('templates/ubicacion-entorno.php'); ?>


<!------------- Acceso --------------------------->

<?php include('templates/login.php'); ?>

<!------------- Quorania --------------------------->
	
<?php include('templates/quorania.php'); ?>



<!------------- Contacto --------------------------->
	
<?php include('templates/contacto.php'); ?>


<!------------- Pisos  --------------------------->

<?php include('templates/pisos.php'); ?>


	




		
<?php if(get_field( 'end_content' )) { 
		
	echo get_field( 'end_content' );

} ?>


		
	</div><!-- .entry-content -->

</article><!-- #post-<?php the_ID(); ?> -->



