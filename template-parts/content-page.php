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

<!------------- Acceso --------------------------->

<?php if( get_field('template') == 'acceso' ){ 
	$user=wp_get_current_user();
	if($user->exists()){
	$id=$user->id;
	$lista_viviendas_adquiridas= get_field('lista_viviendas_adquiridas','user_'.$id);
	$lista_parqueos_trasteros= get_field('lista_parqueos_trasteros','user_'.$id);
	$lista_contratos= get_field('lista_contratos','user_'.$id);
	$lista_pagos= get_field('lista_pagos','user_'.$id);
	$lista_pbc= get_field('lista_pbc','user_'.$id);
	$lista_comunicados= get_field('lista_comunicados','user_'.$id);
	$lista_otros= get_field('lista_otros','user_'.$id);
	$lista_fotos_promocion= get_field('lista_fotos_promocion','user_'.$id);
	$contacto=get_field('contacto','user_'.$id);
	?>
	<div class="administration-user">
	<div class="logoWrapper">
		<?php if(get_field('logo_login')) {?>
			<img src="<?php echo get_field('logo_login') ?>" alt="quorania">
		<?php } ?>
	</div>
	<section class="pisos--list" id="pisos_list">
		<div class="pisos--list--container">
			<div class="pisos--list--title">
				<p>Vivienda Adquirida</p>
				<hr class="title-login-separator"/>
			</div>
			<div class="user-field-wrapper">
				<div class="pisos--list--container--heading user_fields_vivienda">
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
				<?php if($lista_viviendas_adquiridas) {
					$count=1;
					foreach ($lista_viviendas_adquiridas as $vivienda) {
						$idvivienda=$vivienda["vivienda_aquirida"]->ID;
						$row_class = ($count%2 == 0) ? 'pisos--list--container--body--row pair' : 'pisos--list--container--body--row odd'; 
						?>
						<div class="<?php echo $row_class ?> user_fields_vivienda">
							<div class="pisos--list--container--body--row--cell"><?php echo get_field('parking_number',$idvivienda); ?> </div>
					 		<div class="pisos--list--container--body--row--cell"><?php echo get_field('door',$idvivienda); ?> </div>
					  		<div class="pisos--list--container--body--row--cell"><?php echo get_field('bedrooms_number',$idvivienda); ?> </div>
					  		<div class="pisos--list--container--body--row--cell"><?php echo get_field('bathrooms_number',$idvivienda); ?> </div>
					  		<div class="pisos--list--container--body--row--cell"><?php echo get_field('study_number',$idvivienda); ?> </div>
					  		<div class="pisos--list--container--body--row--cell"><?php echo get_field('m2_builded',$idvivienda); ?> </div>
					  		<div class="pisos--list--container--body--row--cell"><?php echo get_field('m2_useful',$idvivienda); ?> </div>
					  		<div class="pisos--list--container--body--row--cell"><?php echo get_field('m2_balconies',$idvivienda); ?> </div>
					  		<div class="pisos--list--container--body--row--cell"><?php echo get_field('m2_terraces',$idvivienda); ?> </div>
					  		<div class="pisos--list--container--body--row--cell"><?php echo get_field('m2_garden',$idvivienda); ?> </div>
					  		<div class="pisos--list--container--body--row--cell"><?php echo get_field('floor_price',$idvivienda); ?> </div>
							<div class="pisos--list--container--body--row--cell">
							  <a href="<?php echo get_field('floor_plane',$idvivienda); ?>" download><img src="<?php echo wp_get_upload_dir()['baseurl'].'/2022/10/Vector-1-overlay.png'; ?>"></a>
							</div>
						</div>
						<?php
						$count++;
						}
						?>
						<?php } ?>
				</div>
			</div>
		</div>
	</section>
	<section class="pisos--list" >
		<div class="pisos--list--container">
			<div class="pisos--list--title">
				<p>Parquing y/o trastero adquirido</p>
				<hr class="title-login-separator"/>
			</div>
			<div class="user-field-wrapper">
			<div class="pisos--list--container--heading user_fields_parquing">
				<div class="pisos--list--container--heading--item"><?php _e('Unidad', 'quorania-microsite'); ?></div>
				<div class="pisos--list--container--heading--item"><?php _e('Planta', 'quorania-microsite'); ?></div>
				<div class="pisos--list--container--heading--item"><?php _e('Escalera', 'quorania-microsite'); ?></div>
				<div class="pisos--list--container--heading--item"><?php _e('Precio', 'quorania-microsite'); ?></div>
				<div class="pisos--list--container--heading--item"><?php _e('Planos', 'quorania-microsite'); ?></div>
			</div>
			<div class="pisos--list--container--body">
				<?php if($lista_parqueos_trasteros) {
				$count=1;
					foreach ($lista_parqueos_trasteros as $parqueos) {
						$idparqueos=$parqueos["parqueo_trastero"]->ID;
						$row_class = ($count%2 == 0) ? 'pisos--list--container--body--row pair' : 'pisos--list--container--body--row odd'; 
						?>
						<div class="<?php echo $row_class ?> user_fields_parquing">
							<div class="pisos--list--container--body--row--cell"><?php if($parqueos["parqueo_trastero"]->post_title) echo $parqueos["parqueo_trastero"]->post_title; else echo '-'?> </div>

					 		<div class="pisos--list--container--body--row--cell"><?php if(get_field('floor_number',$idparqueos)) echo get_field('floor_number',$idparqueos); else echo '-'?> </div>
							 <div class="pisos--list--container--body--row--cell"><?php if(get_field('escalera',$idparqueos)) echo get_field('escalera',$idparqueos); else echo '-'?> </div>
					  		<div class="pisos--list--container--body--row--cell"><?php if(get_field('parking_price',$idparqueos)) echo get_field('parking_price',$idparqueos); else echo '-'?> </div>
					  		<div class="pisos--list--container--body--row--cell">
							  <a href="<?php echo get_field('parking_plane',$idparqueos); ?>" download><img src="<?php echo wp_get_upload_dir()['baseurl'].'/2022/10/Vector-1-overlay.png'; ?>"></a>
							 </div>
						</div>
						<?php
						$count++;
						     }
						?>
					<?php } ?>
			</div>
			</div>
		</div>
	</section>
	<section class="pisos--list">
		<div class="pisos--list--container container-accordion">
		<div class="pisos--list--title">
			<p>Documentación</p>
			<hr class="title-login-separator"/>
		</div>
		<?php if($lista_contratos){ ?> 
		<div class="accordion-user-wrapper">
			<button class="accordion-user-administration">Contrato <img src="<?php echo wp_get_upload_dir()['baseurl'].'/2022/10/Vector-3.png'; ?>"></button>
			<div class="panel">
				<?php foreach ($lista_contratos as $contratos) {?>
					<a href="<?php echo $contratos['contratos']; ?>" download>
						<img src="<?php echo wp_get_upload_dir()['baseurl'].'/2022/10/Vector-1-overlay.png'; ?>">
						<span><?php echo $contratos['titulo_contrato']?></span></a>
				<?php } ?>
			</div>
		</div>
		<?php } ?>
		<?php if($lista_pagos){ ?> 
		<div class="accordion-user-wrapper">
			<button class="accordion-user-administration">Pagos <img src="<?php echo wp_get_upload_dir()['baseurl'].'/2022/10/Vector-3.png'; ?>"></button>
			<div class="panel">
				<?php foreach ($lista_pagos as $pagos) {?>
					<a href="<?php echo $pagos['pagos']; ?>" download>
						<img src="<?php echo wp_get_upload_dir()['baseurl'].'/2022/10/Vector-1-overlay.png'; ?>">
						<span><?php echo $pagos['titulo_pago']?></span></a>
				<?php } ?>
			</div>
			</div>
		<?php } ?>
		<?php if($lista_pbc){ ?> 
			<div class="accordion-user-wrapper">
		<button class="accordion-user-administration">PBC <img src="<?php echo wp_get_upload_dir()['baseurl'].'/2022/10/Vector-3.png'; ?>"></button>
			<div class="panel">
				<?php foreach ($lista_pbc as $pbc) {?>
					<a href="<?php echo $pbc['pbc']; ?>" download>
						<img src="<?php echo wp_get_upload_dir()['baseurl'].'/2022/10/Vector-1-overlay.png'; ?>">
						<span><?php echo $pbc['titulo_pbc']?></span>
					</a>
				<?php } ?>
			</div>
			</div>
		<?php } ?>
		<?php if($lista_comunicados){ ?> 
			<div class="accordion-user-wrapper">
		<button class="accordion-user-administration">Comunicados <img src="<?php echo wp_get_upload_dir()['baseurl'].'/2022/10/Vector-3.png'; ?>"></button>
			<div class="panel">
				<?php foreach ($lista_comunicados as $comunicados) {?>
				<a href="<?php echo $comunicados['comunicados']; ?>" download>
					<img src="<?php echo wp_get_upload_dir()['baseurl'].'/2022/10/Vector-1-overlay.png'; ?>">
					<span><?php echo $comunicados['titulo_comunicado']?></span>
				</a>
			<?php } ?>
			</div>
			</div>
		<?php } ?>
		<?php if($lista_otros){ ?> 
			<div class="accordion-user-wrapper">
		<button class="accordion-user-administration">Otros <img src="<?php echo wp_get_upload_dir()['baseurl'].'/2022/10/Vector-3.png'; ?>"></button>
			<div class="panel">
				<?php foreach ($lista_otros as $otros) {?>
					<a href="<?php echo $otros['otros']; ?>" download>
						<img src="<?php echo wp_get_upload_dir()['baseurl'].'/2022/10/Vector-1-overlay.png'; ?>">
						<span><?php echo $otros['titulo_otros']?></span>
					</a>
				<?php } ?>
			</div>
			</div>
		<?php } ?>
		</div>
	</section>
	<section class="pisos--list">
		<div class="pisos--list--container">
			<div class="pisos--list--title">
				<p>Fotos de la Promoción</p>
				<hr class="title-login-separator"/>
			</div>
			<?php if($lista_fotos_promocion) {?>
			<div class="gallery-container">
				<?php foreach ($lista_fotos_promocion as $promocion) {
				?>
				<div class="image-wrapper">
					<img class="image-promo" src="<?php echo $promocion['foto_promocion'] ?>">
					<a href="<?php echo $promocion['foto_promocion'] ?>" download>
						<img src="<?php echo wp_get_upload_dir()['baseurl'].'/2022/10/Vector-1-overlay.png'; ?>">
					</a>
				</div>
				<?php } ?>
			</div>
			<?php } ?>
		</div>
	</section>
	<section class="pisos--list">
		<div class="pisos--list--container">
			<div class="pisos--list--title">
				<p>Contacto</p>
				<hr class="title-login-separator"/>
			</div>
			<?php if($contacto) {?>
			<div class="contacto-container">
				<a href="mailto:<?php echo $contacto ?>"><img src="<?php echo wp_get_upload_dir()['baseurl'].'/2022/10/Vector-overlay.png'; ?>"><?php echo $contacto ?></a>
			</div>
			<?php } ?>
		</div>
	</section>
</div>
<?php
	} else {?>
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

<?php }} ?> 

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



