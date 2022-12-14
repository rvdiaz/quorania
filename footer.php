<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package quorania-microsite
 */

?>

	<footer id="colophon" class="site-footer">
		<!-- <div class="site-info">
			 <a href="<?php echo esc_url( __( 'https://wordpress.org/', 'quorania-microsite' ) ); ?>">
				<?php
				/* translators: %s: CMS name, i.e. WordPress. */
				printf( esc_html__( 'Proudly powered by %s', 'quorania-microsite' ), 'WordPress' );
				?>
			</a>
			<span class="sep"> | </span>
				<?php
				/* translators: 1: Theme name, 2: Theme author. */
				/*printf( esc_html__( 'Theme: %1$s by %2$s.', 'quorania-microsite' ), 'quorania-microsite', '<a href="http://underscores.me/">R</a>' );*/
				?>
		</div>  --> <!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->
<script src="https://maps.googleapis.com/maps/api/js?key=<?php echo get_field('api_google_map','option')?>&callback=initMap" defer></script>
<script>
    jQuery(document).ready(function($) {
		$(".rbox-iframe").rbox({
           'type': 'iframe',
        });

		get_visit = function (vid, vurl, vurl_update){
			$.post( vurl_update, { id: vid } )
			.done(function( ) {
                location.href= vurl;
            });
		}
	});
</script>	
		
<?php wp_footer(); ?>

</body>
</html>