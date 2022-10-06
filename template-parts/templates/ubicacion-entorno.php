<?php if( get_field('template') == 'ubicacion_entorno' ){ ?>
<div class="ubicacion-entorno">
	<div id="map">
	</div>
	<div class="info">
		<input type="hidden" id="latitud-centro" value="<?php echo get_field('latitud_centro_mapa','option')?>">
		<input type="hidden" id="longitud-centro" value="<?php echo get_field('longitud_centro_mapa','option')?>">
	</div>
	<div class="menu-wrapper">
		<div class="logo-mapa-page">
			<?php if(get_field('logo_mapa_page','option')) {?>
				<img src="<?php echo get_field('logo_mapa_page','option') ?>" alt="quorania">
			<?php } ?>
		</div>
		<div class="title-mapa-page">
			<?php if(get_field('title_mapa_page','option')){ ?>
				<p><?php echo get_field('title_mapa_page','option')?></p>
			<?php } ?>
		</div>
		<div class="menu-options">
			<?php 
			if(get_field('list_locaciones','option'))
			foreach (get_field('list_locaciones','option') as $index => $location) {
				?>
			<button id="button-<?php echo $index?>" class="btn-map">
				<span class="image-map-button">
					<img class="img-btn-op" src="<?php echo wp_get_upload_dir()['baseurl'].'/2022/10/Vector.png';?>">
					<img class="img-btn-cl" src="<?php echo wp_get_upload_dir()['baseurl'].'/2022/10/Vector-1.png';?>">
				</span>
				<span class="title--map-btn">
					<?php echo $location['titulo_locacion'];?>
				</span>
			</button>
			<div class="location-info">
				<input class="direccion-location" type="hidden" value="<?php echo $location['direccion_locacion']?>">
				<input class="imagen-location" type="hidden" value="<?php echo $location['imagen_locacion']?>">
				<input class="latitud_locacion" type="hidden" value="<?php echo $location['latitud_locacion']?>">
				<input class="longitud_locacion" type="hidden" value="<?php echo $location['longitud_locacion']?>">
				<input class="id-button" type="hidden" value="button-<?php echo $index?>">
			</div>
			<?php } ?>
		</div>
	</div>
</div>


<?php } ?>