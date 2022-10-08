<!------------- Pisos  --------------------------->

<?php if( get_field('template') == 'pisos' ){ 				

$args = array(
          'post_type' => 'floor',                
          'post_status' => 'publish'
          );
          
$query = new WP_Query($args);
if ( $query->have_posts() ): 
    $buildings = $bedrooms = $surface = $price = array();	 
    $maxsurface=$maxprice=0;	
    $minsurface=$minprice=100000;
      while ( $query->have_posts() ): $query->the_post();
            if(get_the_terms( get_the_ID(), 'building' ))
           $buildings = array_merge($buildings, get_the_terms( get_the_ID(), 'building' ));
           $bedrooms[ get_field('bedrooms_number',get_the_ID()) ] = get_field('bedrooms_number',get_the_ID());
           $surface[ get_field('m2_builded',get_the_ID()) ] = get_field('m2_builded',get_the_ID());
           $price[ get_field('floor_price',get_the_ID()) ] = get_field('floor_price',get_the_ID());  
           $surfaceCurrent= get_field('m2_builded',get_the_ID());
           $priceCurrent = get_field('floor_price',get_the_ID());
            if($surfaceCurrent<$minsurface)
                $minsurface=$surfaceCurrent;

            if($surfaceCurrent>$maxsurface)
                $maxsurface=$surfaceCurrent;

            if($priceCurrent<$minprice)
                $minprice=$priceCurrent;

            if($priceCurrent>$maxprice)
                $maxprice=$priceCurrent;
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
                        <?php if( sizeof($buildings)>0 ): ?>
                            <div class="pisos--filters--container--items--item--heading"><?php _e('Edificios','quorania-microsite'); ?></div>
                            <div class="pisos--filters--container--items--item--content pisos--filters--container--items--item--content-buildings">
                                <?php 
                                    foreach($buildings as $b): ?>
                                        <span onclick="SelectFilter(event)" class="" data-building="<?php echo$b; ?>"><?php echo $b; ?></span>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="pisos--filters--container--items--item">
                        <?php if( sizeof($bedrooms) > 0 ): ?>
                            <div class="pisos--filters--container--items--item--heading"><?php _e('Dormitorios','quorania-microsite'); ?></div>
                            <div class="pisos--filters--container--items--item--content pisos--filters--container--items--item--content-bedrooms">
                                <?php 
                                      foreach($bedrooms as $b): 
                                      ?>
                                          <span onclick="SelectFilter(event)" class="bedrooms" data-bedroom="<?php echo $b; ?>"><?php echo $b; ?></span>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="pisos--filters--container--items--item">
                        <div class="pisos--filters--container--items--item--heading"><?php _e('Superficie','quorania-microsite'); ?></div>
                        <div class="pisos--filters--container--items--item--content">
                            <div class="input-range-wrapper">
                                <input type="range" id="surface-range-data" value="0" name="surface_range" min="<?php echo $minsurface ?>" max="<?php echo $maxsurface ?>" step="">
                                <output id="surface-range-data-out" name="outvol" for="surface-range-data"></output>
                            </div>
                        </div>
                    </div>							
                    <div class="pisos--filters--container--items--item">
                        <div class="pisos--filters--container--items--item--heading"><?php _e('Precio','quorania-microsite'); ?></div>
                        <div class="pisos--filters--container--items--item--content">
                            <div class="input-range-wrapper">
                                <input type="range" id="price-range-data" value="0" name="price_range" min="<?php echo $minprice; ?>" max="<?php echo $maxprice; ?>" step="">
                                <output id="price-range-data-out" name="outvol" for="price-range-data"></output>
                            </div>
                        </div>
                    </div>						
                </div>
            <div class="pisos--filters--container--button"><button class="restore-filters-button"><span>X</span> Restaurar Filtros</button></div>
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