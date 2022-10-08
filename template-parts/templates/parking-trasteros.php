<!------------- Pisos  --------------------------->

<?php if( get_field('template') == 'parking_trasteros' ){ 				

$args = array(
          'post_type' => 'parking_boxroom',                
          'post_status' => 'publish'
          );
          
$query = new WP_Query($args);
if ( $query->have_posts() ): 
    $buildings  = $surface = $price = array();	 
    $maxprice=0;	
    $minprice=100000;
      while ( $query->have_posts() ): $query->the_post();
            if(get_the_terms( get_the_ID(), 'building' ))
           $buildings = array_merge($buildings, get_the_terms( get_the_ID(), 'building' ));
           $price[ get_field('parking_price',get_the_ID()) ] = get_field('parking_price',get_the_ID());  
           $priceCurrent = get_field('floor_price',get_the_ID());
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
      asort($price);
?>	
<div class="pisos parking-traseros">
    <section class="pisos--filters">
        <div class="pisos--filters--container">
            <div class="pisos--filters--container--logo"><img src="<?php echo get_header_image(); ?>"></div>
                <div class="pisos--filters--container--items">
                    <div class="pisos--filters--container--items--item">
                        <?php if( sizeof($buildings)>0 ): ?>
                            <div class="pisos--filters--container--items--item--heading"><?php _e('Edificios','quorania-microsite'); ?></div>
                            <div class="pisos--filters--container--items--item--content pisos--filters--container--items--item--content-parking">
                                <?php 
                                    foreach($buildings as $b): ?>
                                        <span onclick="SelectFilter(event)" class="" data-building="<?php echo$b; ?>"><?php echo $b; ?></span>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="pisos--filters--container--items--item">
                       
                    </div>
                   					
                    <div class="pisos--filters--container--items--item">
                        <div class="pisos--filters--container--items--item--heading"><?php _e('Precio','quorania-microsite'); ?></div>
                        <div class="pisos--filters--container--items--item--content">
                            <div class="input-range-wrapper">
                                <input type="range" id="price-range-data-parking" value="0" name="price_range_parking" min="<?php echo $minprice; ?>" max="<?php echo $maxprice; ?>" step="">
                                <output id="price-range-data-parking-out" name="outvol" for="price-range-data-parking"></output>
                            </div>
                        </div>
                    </div>						
                </div>
            <div class="pisos--filters--container--button"><button class="restore-filters-button"><span>X</span> Restaurar Filtros</button></div>
        </div>					
    </section>
    <section class="pisos--list" id="pisos_list">
        <div class="pisos--list--container">
            <div class="pisos--list--container--heading pisos--list--container--heading--parking">
                    <div class="pisos--list--container--heading--item"><?php _e('Unidad', 'quorania-microsite'); ?></div>
                    <div class="pisos--list--container--heading--item"><?php _e('Planta', 'quorania-microsite'); ?></div>
                    <div class="pisos--list--container--heading--item"><?php _e('Edificio', 'quorania-microsite'); ?></div>
                    <div class="pisos--list--container--heading--item"><?php _e('Precios', 'quorania-microsite'); ?></div>
                    <div class="pisos--list--container--heading--item"><?php _e('Escalera', 'quorania-microsite'); ?></div>
                    <div class="pisos--list--container--heading--item"><?php _e('Planos', 'quorania-microsite'); ?></div>
            </div>
            <div class="pisos--list--container--body pisos--list--container--body--parking">
                <?php echo do_shortcode( '[parking_page_filter]' ); ?>
            </div>
        </div>
    </section>


    
        
</div>		
<?php endif;  ?>
<?php wp_reset_postdata(); } ?>