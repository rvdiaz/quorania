<!------------- Galeria --------------------------->
	
<?php if( get_field('template') == 'galeria' ){ ?>	       
			<div class="galeria">
			    <div class="galeria--background">

				<div class="galeria--content">
				    <div class="galeria--content--title">
					   <div class="centered">
					       <?php if( get_field('gallery_logo') ): ?>
							    <img  src="<?php echo get_field('gallery_logo'); ?>">
						   <?php endif; ?>
						</div>
				    </div>
				    <div class="galeria--content--groups">
					    <?php $group_photos = get_field('group_photos'); ?>

						<?php if ($group_photos): ?>
							<?php if ($group_photos["group_photos_backgroud"]): ?>
								<div class="galeria--content--groups--box">
								    <img  src="<?php echo esc_url($group_photos['group_photos_backgroud']); ?>">
									<div class="galeria--content--groups--box--contact">
									   <?php if ($group_photos["group_photos_icon"]): ?>
									        <img src="<?php echo esc_url($group_photos['group_photos_icon']); ?>">
										    <a href="<?php echo $group_photos['group_photos_backgroud']; ?>" data-lightbox="group-lightbox">
											    <?php echo $group_photos['group_photos_text']; ?>
											</a>
											<?php if ($group_photos["group_photos_gallery"]): ?>
												<?php foreach( $group_photos["group_photos_gallery"] as $image_id ): ?>
													<a href="<?php echo $image_id; ?>" data-lightbox="group-lightbox" class="group-photo">Imagen</a>
												<?php endforeach ?>	
											<?php endif; ?>
									   <?php endif; ?>
									</div>
								</div>
							<?php endif; ?>
						<?php endif; ?>

						<?php $group_videos = get_field('group_videos'); ?>

						<?php if ($group_videos): ?>
							<?php $group_videos_video = $group_videos["group_videos_video"]; ?>
							<?php if ($group_videos_video): ?>
								<?php foreach( $group_videos_video as $video ) { ?>								    
								    <div class="galeria--content--groups--box">										
									    <img src="<?php echo esc_url($video['group_videos_video_backgroud']); ?>">
										<div class="galeria--content--groups--box--contact">
									        <?php if ($video["group_videos_video_icon"]): ?>
									            <img src="<?php echo esc_url($video['group_videos_video_icon']); ?>">
											    <?php if ($video["group_videos_video_text"]): ?>
													<?php if ($video["group_videos_video_video"]): ?>
														<a href="" class="rbox-iframe" data-rbox-type="iframe" data-rbox-iframe=
"<?php echo $video['group_videos_video_video']; ?>"/><?php echo $video['group_videos_video_text']; ?></a>
													<?php else: ?>
														<a href="#"/><?php echo $video['group_videos_video_text']; ?></a>
													<?php endif; ?>												    
												<?php endif; ?>
									        <?php endif; ?>
									    </div>
								    </div>
								<?php } ?>
							<?php endif; ?>
						<?php endif; ?>

						<?php $group_tour_virtual = get_field('group_tour_virtual'); ?>

						<?php if ($group_videos): ?>
							<?php $group_tour_virtual_tour = $group_tour_virtual["group_tour_virtual_tour"]; ?>
							<?php if ($group_tour_virtual_tour): ?>
								<?php $count = 0; ?>
								<?php foreach( $group_tour_virtual_tour as $tour ) { ?>
									<?php if ($count > 0): ?>
										<?php break; ?>
									<?php endif; ?>
									<?php $couunt++; ?>
								    <div class="galeria--content--groups--box">
									    <img  src="<?php echo esc_url($tour['group_tour_virtual_tour_backgroud']); ?>">
										<div class="galeria--content--groups--box--contact">
									        <?php if ($tour["group_tour_virtual_tour_icon"]): ?>
									            <img src="<?php echo esc_url($tour['group_tour_virtual_tour_icon']); ?>">
											    <?php if ($tour["group_tour_virtual_tour_text"]): ?>
													<?php if ($tour["group_tour_virtual_tour_file"]): ?>
														<a href="javascript:;" onClick=
"get_visit('<?php echo get_the_ID(); ?>', '<?php echo get_template_directory_uri()."/visita-virtual/index.php"; ?>', '<?php echo get_template_directory_uri()."/visita-virtual/update-xml.php"; ?>');" /><?php echo $tour['group_tour_virtual_tour_text']; ?></a>
													<?php else: ?>
														<a href="#" /><?php echo $tour['group_tour_virtual_tour_file']; ?></a>
													<?php endif; ?>												    
												<?php endif; ?>
									        <?php endif; ?>
									    </div>									    
								    </div>
								<?php } ?>
							<?php endif; ?>
						<?php endif; ?>			        
					    
				    </div>	   				    
				</div>


			    </div>	
			    			    
			</div>

<?php } ?>