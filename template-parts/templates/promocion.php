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