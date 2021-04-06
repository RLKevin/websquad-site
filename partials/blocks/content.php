<?php 

// register block

switch_register_block('content', 'text');

// render block

function render_block_content() {
		
	// vars

	$align = get_field('align');
	$background = get_field('background');
	$id = get_field('id');

	?>

	<div id="<?php echo $id; ?>" class="content content--<?php echo $align; ?> content--<?php echo $background; ?>">
	
		<?php

		if( have_rows('flexible_content') ):

			while ( have_rows('flexible_content') ) : the_row();

				if( get_row_layout() == 'button' ):

					// vars

					$button_left = get_sub_field('button_left');
					$button_right = get_sub_field('button_right');

					?>
									
					<div class="content__button-container">

						<div class="wrapper">

							<?php if ($button_left || $button_right ): ?>

								<?php if ($button_left): ?>

									<a class="button button--filled-secondary" href="<?php echo $button_left['url']; ?>" target="<?php echo $button_left['target']; ?>"><?php echo $button_left['title']; ?></a>

								<?php endif; ?>

								<?php if ($button_right): ?>

									<a class="button button--filled-secondary" href="<?php echo $button_right['url']; ?>" target="<?php echo $button_right['target']; ?>"><?php echo $button_right['title']; ?></a>

								<?php endif; ?>

							<?php endif; ?>
						
						</div>

					</div>
					
					<?php

				endif;

				if( get_row_layout() == 'file' ):

					?>

					<div class="content__file">

						<div class="wrapper">

							<?php

							if( have_rows('repeater') ): 
													
								while ( have_rows('repeater') ) : the_row();

									// vars

									$file = get_sub_field('file');

									?>
									
									<a href="<?php echo $file['url']; ?>" download><?php echo $file['title']; ?>
										<svg aria-hidden="true" focusable="false" data-prefix="far" data-icon="arrow-to-bottom" class="svg-inline--fa fa-arrow-to-bottom fa-w-12" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><path fill="currentColor" d="M348.5 232.1l-148 148.4c-4.7 4.7-12.3 4.7-17 0l-148-148.4c-4.7-4.7-4.7-12.3 0-17l19.6-19.6c4.8-4.8 12.5-4.7 17.1.2l93.7 97.1V44c0-6.6 5.4-12 12-12h28c6.6 0 12 5.4 12 12v248.8l93.7-97.1c4.7-4.8 12.4-4.9 17.1-.2l19.6 19.6c4.9 4.7 4.9 12.3.2 17zM372 428H12c-6.6 0-12 5.4-12 12v28c0 6.6 5.4 12 12 12h360c6.6 0 12-5.4 12-12v-28c0-6.6-5.4-12-12-12z"></path></svg>
									</a>
									
									<?php
								
								endwhile;

							endif;

							?>

						</div>

					</div>
					
					<?php

				endif;

				if( get_row_layout() == 'image' ):

					?>

					<div class="content__image">
						
						<?php

						if( have_rows('repeater') ): 
					
							?>

							<div class="content__slider slider">
								
								<?php while ( have_rows('repeater') ) : the_row();
				
									// vars

									$image = get_sub_field('image');
				
									?>

									<img src="<?php echo $image['sizes']['1920-16-9']; ?>" alt="<?php echo $image['title']; ?>">
				
								<?php endwhile; ?>

							</div>
					
							<?php 
					
						endif;

						?>

					</div>

					<?php

				endif;

				if( get_row_layout() == 'spacer' ):

					// vars
					$margin = get_sub_field('margin');

					?>
									
					<div class="content__spacer content__spacer--<?php echo $margin; ?>"></div>
					
					<?php

				endif;

				if( get_row_layout() == 'text' ):

					?>
									
					<div class="content__text wysiwyg">

						<div class="wrapper">

							<?php the_sub_field('text'); ?>

						</div>

					</div>
					
					<?php

				endif;

				if( get_row_layout() == 'text_code' ):

					?>
									
					<div class="content__text-code wysiwyg">

						<div class="wrapper">

							<?php

							// vars

							$text = get_sub_field('text');
							$button_left = get_sub_field('button_left');
							$button_right = get_sub_field('button_right');
							$code = get_sub_field('code');

							?>

							<div class="content__col content__col--text">

								<?php if ($text): ?>

									<?php echo $text; ?>

								<?php endif; ?>

								<?php if ($button_left || $button_right ): ?>

									<div class="content__button-container">

										<?php if ($button_left): ?>

											<a class="button button--filled-secondary" href="<?php echo $button_left['url']; ?>" target="<?php echo $button_left['target']; ?>"><?php echo $button_left['title']; ?></a>

										<?php endif; ?>

										<?php if ($button_right): ?>

											<a class="button button--filled-secondary" href="<?php echo $button_right['url']; ?>" target="<?php echo $button_right['target']; ?>"><?php echo $button_right['title']; ?></a>

										<?php endif; ?>

									</div>

								<?php endif; ?>

							</div>
									
							<div class="content__col content__col--code">

								<?php echo $code; ?>

							</div>

						</div>

					</div>
					
					<?php

				endif;

				if( get_row_layout() == 'text_image' ):

					?>

					<div class="content__text-image wysiwyg">

						<div class="wrapper">

							<?php

							// vars

							$text = get_sub_field('text');
							$button_left = get_sub_field('button_left');
							$button_right = get_sub_field('button_right');
							$image = get_sub_field('image');

							?>

							<div class="content__col content__col--text">

								<?php if ($text): ?>

									<?php echo $text; ?>

								<?php endif; ?>

								<?php if ($button_left || $button_right ): ?>

									<div class="content__button-container">

										<?php if ($button_left): ?>

											<a class="button button--filled-secondary" href="<?php echo $button_left['url']; ?>" target="<?php echo $button_left['target']; ?>"><?php echo $button_left['title']; ?></a>

										<?php endif; ?>

										<?php if ($button_right): ?>

											<a class="button button--filled-secondary" href="<?php echo $button_right['url']; ?>" target="<?php echo $button_right['target']; ?>"><?php echo $button_right['title']; ?></a>

										<?php endif; ?>

									</div>

								<?php endif; ?>

							</div>
									
							<div class="content__col content__col--image">

								<img src="<?php echo $image['sizes']['1280-16-9']; ?>" alt="<?php echo $image['title']; ?>">

							</div>

						</div>

					</div>
					
					<?php

				endif;

				if( get_row_layout() == 'text_video' ):

					?>

					<div class="content__text-video wysiwyg">

						<div class="wrapper">

							<?php

							// vars

							$text = get_sub_field('text');
							$button_left = get_sub_field('button_left');
							$button_right = get_sub_field('button_right');
							$image = get_sub_field('image');
							$video = get_sub_field('video');

							?>

							<div class="content__col content__col--text">

								<?php if ($text): ?>

									<?php echo $text; ?>

								<?php endif; ?>

								<?php if ($button_left || $button_right ): ?>

									<div class="content__button-container">

										<?php if ($button_left): ?>

											<a class="button button--filled-secondary" href="<?php echo $button_left['url']; ?>" target="<?php echo $button_left['target']; ?>"><?php echo $button_left['title']; ?></a>

										<?php endif; ?>

										<?php if ($button_right): ?>

											<a class="button button--filled-secondary" href="<?php echo $button_right['url']; ?>" target="<?php echo $button_right['target']; ?>"><?php echo $button_right['title']; ?></a>

										<?php endif; ?>

									</div>

								<?php endif; ?>

							</div>
									
							<div class="content__col content__col--video">

								<div class="content__video-container">
									
									<img src="<?php echo $image['sizes']['1280-16-9']; ?>" alt="<?php echo $image['title']; ?>">

									<?php echo $video; ?>

								</div>

							</div>

						</div>

					</div>
					
					<?php

				endif;

				if( get_row_layout() == 'video' ):

					// vars

					$image = get_sub_field('image');
					$video = get_sub_field('video');

					?>
									
					<div class="content__video">

						<div class="content__video-container">
								
							<img src="<?php echo $image['sizes']['1920-16-9']; ?>" alt="<?php echo $image['title']; ?>">

							<?php echo $video; ?>

						</div>

					</div>
					
					<?php

				endif;

			endwhile;

		endif;

		?>

	</div>

	<?php 

}

?>