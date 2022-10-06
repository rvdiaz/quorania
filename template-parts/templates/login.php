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
							<div class="pisos--list--container--body--row--cell"><?php if(get_field('parking_number',$idvivienda)) echo get_field('parking_number',$idvivienda); else echo '-';?></div>
					 		<div class="pisos--list--container--body--row--cell"><?php if(get_field('door',$idvivienda)) echo get_field('door',$idvivienda); else echo '-';?></div>
					  		<div class="pisos--list--container--body--row--cell"><?php if(get_field('bedrooms_number',$idvivienda)) echo get_field('bedrooms_number',$idvivienda); else echo '-';?></div>
					  		<div class="pisos--list--container--body--row--cell"><?php if(get_field('bathrooms_number',$idvivienda)) echo get_field('bathrooms_number',$idvivienda); else echo '-'; ?></div>
					  		<div class="pisos--list--container--body--row--cell"><?php if(get_field('study_number',$idvivienda)) echo get_field('study_number',$idvivienda); else echo '-';?></div>
					  		<div class="pisos--list--container--body--row--cell"><?php if(get_field('m2_builded',$idvivienda)) echo get_field('m2_builded',$idvivienda); else echo '-';?></div>
					  		<div class="pisos--list--container--body--row--cell"><?php if(get_field('m2_useful',$idvivienda)) echo get_field('m2_useful',$idvivienda); else echo '-';?></div>
					  		<div class="pisos--list--container--body--row--cell"><?php if(get_field('m2_balconies',$idvivienda)) echo get_field('m2_balconies',$idvivienda); else echo '-';?></div>
					  		<div class="pisos--list--container--body--row--cell"><?php if(get_field('m2_terraces',$idvivienda)) echo get_field('m2_terraces',$idvivienda); else echo '-';?></div>
					  		<div class="pisos--list--container--body--row--cell"><?php if(get_field('m2_garden',$idvivienda)) echo get_field('m2_garden',$idvivienda); echo '-';?></div>
					  		<div class="pisos--list--container--body--row--cell"><?php if(get_field('floor_price',$idvivienda)) echo get_field('floor_price',$idvivienda); else echo '-';?></div>
							<div class="pisos--list--container--body--row--cell">
							  <a href="<?php echo get_field('floor_plane',$idvivienda); ?>" download><img src="<?php echo wp_get_upload_dir()['baseurl'].'/2022/09/file-download-1.svg';?>"></a>
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
							  <a href="<?php echo get_field('parking_plane',$idparqueos); ?>" download><img src="<?php echo wp_get_upload_dir()['baseurl'].'/2022/09/file-download-1.svg'; ?>"></a>
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
			<button class="accordion-user-administration">Contrato <img src="<?php echo wp_get_upload_dir()['baseurl'].'/2022/10/Accordion.png'; ?>"></button>
			<div class="panel">
				<?php foreach ($lista_contratos as $contratos) {?>
					<a href="<?php echo $contratos['contratos']; ?>" download>
						<img src="<?php echo wp_get_upload_dir()['baseurl'].'/2022/09/file-download-1.svg'; ?>">
						<span><?php echo $contratos['titulo_contrato']?></span></a>
				<?php } ?>
			</div>
		</div>
		<?php } ?>
		<?php if($lista_pagos){ ?> 
		<div class="accordion-user-wrapper">
			<button class="accordion-user-administration">Pagos <img src="<?php echo wp_get_upload_dir()['baseurl'].'/2022/10/Accordion.png'; ?>"></button>
			<div class="panel">
				<?php foreach ($lista_pagos as $pagos) {?>
					<a href="<?php echo $pagos['pagos']; ?>" download>
						<img src="<?php echo wp_get_upload_dir()['baseurl'].'/2022/09/file-download-1.svg'; ?>">
						<span><?php echo $pagos['titulo_pago']?></span></a>
				<?php } ?>
			</div>
			</div>
		<?php } ?>
		<?php if($lista_pbc){ ?> 
			<div class="accordion-user-wrapper">
		<button class="accordion-user-administration">PBC <img src="<?php echo wp_get_upload_dir()['baseurl'].'/2022/10/Accordion.png'; ?>"></button>
			<div class="panel">
				<?php foreach ($lista_pbc as $pbc) {?>
					<a href="<?php echo $pbc['pbc']; ?>" download>
						<img src="<?php echo wp_get_upload_dir()['baseurl'].'/2022/09/file-download-1.svg'; ?>">
						<span><?php echo $pbc['titulo_pbc']?></span>
					</a>
				<?php } ?>
			</div>
			</div>
		<?php } ?>
		<?php if($lista_comunicados){ ?> 
			<div class="accordion-user-wrapper">
		<button class="accordion-user-administration">Comunicados <img src="<?php echo wp_get_upload_dir()['baseurl'].'/2022/10/Accordion.png'; ?>"></button>
			<div class="panel">
				<?php foreach ($lista_comunicados as $comunicados) {?>
				<a href="<?php echo $comunicados['comunicados']; ?>" download>
					<img src="<?php echo wp_get_upload_dir()['baseurl'].'/2022/09/file-download-1.svg'; ?>">
					<span><?php echo $comunicados['titulo_comunicado']?></span>
				</a>
			<?php } ?>
			</div>
			</div>
		<?php } ?>
		<?php if($lista_otros){ ?> 
			<div class="accordion-user-wrapper">
		<button class="accordion-user-administration">Otros <img src="<?php echo wp_get_upload_dir()['baseurl'].'/2022/10/Accordion.png'; ?>"></button>
			<div class="panel">
				<?php foreach ($lista_otros as $otros) {?>
					<a href="<?php echo $otros['otros']; ?>" download>
						<img src="<?php echo wp_get_upload_dir()['baseurl'].'/2022/09/file-download-1.svg'; ?>">
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
						<img src="<?php echo wp_get_upload_dir()['baseurl'].'/2022/09/file-download-1.svg'; ?>">
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
				<a href="mailto:<?php echo $contacto ?>"><img src="<?php echo wp_get_upload_dir()['baseurl'].'/2022/09/mail.svg'; ?>"><?php echo $contacto ?></a>
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