<!------------- Contacto --------------------------->
	
<?php if( get_field('template') == 'contacto' ){ ?>	       
			<div class="contacto">
				<div class="contacto--left_content">
					<?php if( get_field('contact_leftside_image') ): ?>						
					 		<img src="<?php echo get_field('contact_leftside_image'); ?>">
					<?php endif; ?>
				</div>
				<div class="contacto--right_content">
				    <h3 class="contacto--right_content--title"><?php echo get_field('contact_title'); ?></h3>
					<hr/>
					<?php if( have_rows('team') ): ?>
						<?php while( have_rows('team') ) : the_row(); ?>
						    <div class="contacto--right_content--team">
								<?php if( get_sub_field('team_photo') ): ?>						
					 		        <img src="<?php echo get_sub_field('team_photo'); ?>">
					            <?php endif; ?>
								<div class="contacto--right_content--team--data">
								    <?php while( have_rows('team_data') ) : the_row(); ?>
									    <p <?php if( get_sub_field('is_bold') ): ?> class="bold" <?php endif; ?>>
									        <?php if( get_sub_field('team_icon') ): ?>						
					 		                    <img src="<?php echo get_sub_field('team_icon'); ?>">
					                        <?php endif; ?>
										    <?php echo get_sub_field('team_text'); ?>
										</p>
								    <?php endwhile; ?>	
								</div>
						    </div>													
						<?php endwhile; ?>	
					<?php endif; ?>	
				</div>
			</div>


	<?php } ?>