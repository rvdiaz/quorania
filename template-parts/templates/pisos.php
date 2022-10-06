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