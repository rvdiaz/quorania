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
		<?php if( get_field('template') ){ ?>
 		<?php 	if( get_field('template') == 'promocion' ): ?>

 					<div class="promocion">
						<img class="promocion--background--image" src="<?php echo get_field('promo_background_image'); ?>">
						<div class="promocion--pastilla">
						  <?php	if( get_field('group') ): 
						  			if( get_field('group')['group_logo'] ): ?>
										<img class="promocion--pastilla--logo" src="<?php echo get_field('group')['group_logo']; ?>">
							<?php   endif; ?>
							<?php	if( get_field('group')['group_title'] ): ?>
										<div class="promocion--pastilla--title"><?php echo get_field('group')['group_title']; ?></div>
							<?php   endif; ?>
							<?php	if( get_field('group')['group_text'] ): ?>
										<div class="promocion--pastilla--text"><?php echo get_field('group')['group_text']; ?></div>
							<?php   endif; ?>
							<?php  if( get_field('group')['group_promo'] ): ?>
								<?php  if( sizeof( get_field('group')['group_promo'] ) > 0 ): ?>
										<div class="promocion--pastilla--promos">
							<?php			foreach( get_field('group')['group_promo'] as $pastilla_promo ): ?>
												<div>
												  <?php if($pastilla_promo['group_promo_icon']): ?>	
													<span class="promocion--pastilla--promos--icon"><img src="<?php echo $pastilla_promo['group_promo_icon']; ?>"></span>
												  <?php endif; ?>
												  <?php if($pastilla_promo['group_promo_title']): ?>	
													<span class="promocion--pastilla--promos--title"><?php echo $pastilla_promo['group_promo_title'] ?></span>
												  <?php endif; ?>
												  <?php if($pastilla_promo['group_promo_value']): ?>
													<span class="promocion--pastilla--promos--value"><?php echo $pastilla_promo['group_promo_value'] ?></span>
												  <?php endif; ?>	
												</div>
							<?php 			endforeach; ?>
										</div>
								<?php	endif; ?>			
							<?php	endif; ?>	
						 <?php endif; ?>
						 <?php if( get_field('group')['dossier']): ?>
						 		 <a class="promocion--pastilla--dossier" href="<?php echo get_field('group')['dossier']['url']; ?>"><span><?php _e('DOSSIER PROMOCIÓN','quorania-microsite'); ?></span><img src="<?php echo wp_get_upload_dir()['url'].'/file-download.svg'; ?>"></a>
						 <?php endif; ?>
						</div>
					</div>


 		  <?php endif; ?>

		<?php } ?>

<!------------- Ubicación y entorno  --------------------------->

		<?php if( get_field('template') == 'ubicacion_entorno' ){ ?>


		<?php } ?>




<!------------- Quorania --------------------------->
	
	<?php if( get_field('template') == 'quorania' ){ ?>

			<div class="quorania">
				<div class="quorania--left_content">
					<?php if( get_field('quorania_leftside_image') ): ?>						
					 		<img src="<?php echo get_field('quorania_leftside_image'); ?>">
					<?php endif; ?>
				</div>
				<div class="quorania--right_content">
					<h3 class="quorania--right_content--title"><?php echo get_field('first_title'); ?></h3>
					<div class="quorania--right_content--text"><?php echo get_field('first_text'); ?></div>
					<h4 class="quorania--right_content--title_promotions"><?php echo get_field('second_title'); ?></h4>
					<div class="quorania--right_content--promotions">
						<?php
							if( have_rows('promotions') ):    
							    while( have_rows('promotions') ) : the_row(); ?>
							    	<div class="quorania--right_content--promotions--item">							        
								     <?php if(get_sub_field('promotions_image')): ?>
								     		<img src="<?php echo get_sub_field('promotions_image'); ?>">      
								     <?php endif; ?>
								     		<div class="quorania--right_content--promotions--item--text">
									     		<div class="quorania--right_content--promotions--item--text--name"><?php echo get_sub_field('promotions_title'); ?></div>
									     		<div class="quorania--right_content--promotions--item--text--city"><?php echo get_sub_field('promotions_subtitle'); ?></div>   		
								     		</div>
							     	</div>
							    
						<?php   endwhile;							    
							endif;
						?>
					</div>
				</div>
			</div>


	<?php } ?>

	
<!------------- Acceso --------------------------->
	
<?php if( get_field('template') == 'acceso' ){ 
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
?>
<div class="acceso">
	<div class='wrapperLogin'>
		<div class="logo-title-container">
			<div class="logo-login">
				<?php if(get_field('logo_login')) {?>
					<img src="<?php echo get_field('logo_login') ?>" alt="quorania">
				<?php } ?>
			</div>
			<div class="title-login">
				<?php if(get_field('title_login')) {?>
					<span> <?php echo get_field('title_login') ?></span>
					<hr class="title-login-separator"/>
				<?php } ?>
			</div>
		</div>
		<?php wp_login_form($args);?>
		<p class="errorMessage">
			<?php
				if (isset($_GET['reason'])){
					$aux=$_GET['reason'];
				}
				switch ($aux) {
					case 'empty_username':
						echo "The username field is empty";
						break;
					case 'empty_password':
						echo "The password field is empty.";
						break;
					case 'incorrect_password':
						echo "The password you entered for the username is incorrect.";
						break;
					case 'invalid_username':
						echo "The username is not registered on this site. If you are unsure of your username, try your email address instead.";
						break;
					default:
						echo "";
						break;
				}
			?> 
		</p>
    </div>
</div>
<?php } ?>


<!------------- Pisos  --------------------------->

	<?php if( get_field('template') == 'pisos' ){ 				

			$args = array(
		              'post_type' => 'floor',                
		              'post_status' => 'publish'
		              );
		    $query = new WP_Query($args);

		    if ( $query->have_posts() ): 
		    	$buildings = $bedrooms = $surface = $price = array();		    	
				  while ( $query->have_posts() ): $query->the_post();
				   	$buildings = array_merge($buildings, get_the_terms( get_the_ID(), 'building' ));
				   	$bedrooms[ get_field('bedrooms_number',get_the_ID()) ] = get_field('bedrooms_number',get_the_ID());
				   	$surface[ get_field('m2_builded',get_the_ID()) ] = get_field('m2_builded',get_the_ID());
				   	$price[ get_field('floor_price',get_the_ID()) ] = get_field('floor_price',get_the_ID()); 	

				  endwhile;
				  $temp = array();
				  foreach ($buildings as $b) {
				  	$temp[$b->name] = $b->name;
				  }
				  $buildings = $temp;
				  asort($buildings);
				  asort($bedrooms);
				  asort($surface);
				  asort($price);
			?>	

			<div class="pisos">
				<section class="pisos--filters">
					<div class="pisos--filters--container">
						<div class="pisos--filters--container--logo"><img src="<?php echo get_header_image(); ?>"></div>
							<div class="pisos--filters--container--items">
								<div class="pisos--filters--container--items--item">
									<?php if( sizeof($buildings) > 1 ): ?>
										<div class="pisos--filters--container--items--item--heading"><?php _e('Edificios','quorania-microsite'); ?></div>
										<div class="pisos--filters--container--items--item--content">
											<?php 
											      foreach($buildings as $b): ?>
											      	<span class="" data-building="<?php echo$b; ?>"><?php echo $b; ?></span>
											<?php endforeach; ?>
										</div>
									<?php endif; ?>
								</div>
								<div class="pisos--filters--container--items--item">
									<?php if( sizeof($bedrooms) > 1 ): ?>
										<div class="pisos--filters--container--items--item--heading"><?php _e('Dormitorios','quorania-microsite'); ?></div>
										<div class="pisos--filters--container--items--item--content">
											<?php 
											      foreach($bedrooms as $b): ?>
											      	<span class="" data-bedroom="<?php echo$b; ?>"><?php echo $b; ?></span>
											<?php endforeach; ?>
										</div>
									<?php endif; ?>
								</div>
								<div class="pisos--filters--container--items--item">
									<div class="pisos--filters--container--items--item--heading"><?php _e('Superficie','quorania-microsite'); ?></div>
									<div class="pisos--filters--container--items--item--content">
										<input type="range" name="surface_range" min="<?php echo reset($surface); ?>" max="200" step="10">
									</div>
								</div>							
								<div class="pisos--filters--container--items--item">
									<div class="pisos--filters--container--items--item--heading"><?php _e('Precio','quorania-microsite'); ?></div>
									<div class="pisos--filters--container--items--item--content">
										<input type="range" name="price_range" min="<?php echo reset($price); ?>" max="1000000" step="1000">
									</div>
								</div>						
							</div>
						<div class="pisos--filters--container--button"><button></button></div>
					</div>					
				</section>
				<section class="pisos--list" id="pisos_list">
					<div class="pisos--list--container">
						<div class="pisos--list--container--heading">
								<div class="pisos--list--container--heading--item"><?php _e('Edificio', 'quorania-microsite'); ?></div>
								<div class="pisos--list--container--heading--item"><?php _e('Planta', 'quorania-microsite'); ?></div>
								<div class="pisos--list--container--heading--item"><?php _e('Puerta', 'quorania-microsite'); ?></div>
								<div class="pisos--list--container--heading--item"><?php _e('Dormitorios', 'quorania-microsite'); ?></div>
								<div class="pisos--list--container--heading--item"><?php _e('Baños', 'quorania-microsite'); ?></div>
								<div class="pisos--list--container--heading--item"><?php _e('Estudio', 'quorania-microsite'); ?></div>
								<div class="pisos--list--container--heading--item"><?php _e('m2 Construidos', 'quorania-microsite'); ?></div>
								<div class="pisos--list--container--heading--item"><?php _e('M2 Útiles', 'quorania-microsite'); ?></div>
								<div class="pisos--list--container--heading--item"><?php _e('Balcones', 'quorania-microsite'); ?></div>
								<div class="pisos--list--container--heading--item"><?php _e('Terrazas', 'quorania-microsite'); ?></div>
								<div class="pisos--list--container--heading--item"><?php _e('Jardín', 'quorania-microsite'); ?></div>
								<div class="pisos--list--container--heading--item"><?php _e('Precio', 'quorania-microsite'); ?></div>
								<div class="pisos--list--container--heading--item"><?php _e('Planos', 'quorania-microsite'); ?></div>
						</div>
						<div class="pisos--list--container--body">
							<?php echo do_shortcode( '[pisos_page_filter]' ); ?>
						</div>
					</div>
				</section>
					
			</div>		
<?php endif;  ?>
	<?php wp_reset_postdata(); } ?>




		
		<?php if(get_field( 'end_content' )) { 
		
			echo get_field( 'end_content' );

		} ?>


		
	</div><!-- .entry-content -->

</article><!-- #post-<?php the_ID(); ?> -->



