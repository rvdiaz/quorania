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