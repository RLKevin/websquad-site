<?php 

// register block - for icon use https://developer.wordpress.org/resource/dashicons/

switch_register_block('hero', 'images-alt');

// render block

function render_block_hero() {

	// vars
	$id = get_field('id');
	$scroll = get_field('scroll');
	$align = get_field('options_header_align', 'option');

	?>

	<div id="<?php echo $id; ?>" class="hero">

		<div class="hero__slider slider">

			<?php
			
			if( have_rows('repeater') ):
			
				while ( have_rows('repeater') ) : the_row();

					// vars
					$image = get_sub_field('image');
					$title = get_sub_field('title');
					$subtitle = get_sub_field('subtitle');
					$button_left = get_sub_field('button_left');
					$button_right = get_sub_field('button_right');
					$header_align = get_field('options_header_align', 'option');

					?>
					
					<div class="hero__container hero__container--<?php echo $align; ?>">	
						
						<div class="hero__image" style="background-image: url(<?php echo $image['sizes']['1920-16-9']; ?>);">
						</div>
						
						<div class="hero__text">

							<div class="wrapper">

								<?php if ($title): ?>

									<h2><?php echo $title; ?></h2>

								<?php endif; ?>

								<?php if ($subtitle): ?>

									<h3><?php echo $subtitle; ?></h3>

								<?php endif; ?>
							
								<?php if ($button_left || $button_right ): ?>

									<div class="hero__button-container">

										<?php if ($button_left): ?>

											<a class="button button--filled-secondary" href="<?php echo $button_left['url']; ?>" target="<?php echo $button_left['target']; ?>"><?php echo $button_left['title']; ?></a>

										<?php endif; ?>

										<?php if ($button_right): ?>

											<a class="button button--filled-secondary" href="<?php echo $button_right['url']; ?>" target="<?php echo $button_right['target']; ?>"><?php echo $button_right['title']; ?></a>

										<?php endif; ?>

									</div>
									
								<?php endif; ?>

							</div>

						</div>

					</div>

					<?php 
				
				endwhile; 
			
			endif;
			
			?>

		</div>

		<?php 
		
		if ($scroll): 
		
		?>

			<div class="hero__scroll-button">
				<a href="#<?php echo $scroll; ?>">
					<svg aria-hidden="true" focusable="false" data-prefix="far" data-icon="arrow-down" class="svg-inline--fa fa-arrow-down fa-w-14" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M441.9 250.1l-19.8-19.8c-4.7-4.7-12.3-4.7-17 0L250 385.4V44c0-6.6-5.4-12-12-12h-28c-6.6 0-12 5.4-12 12v341.4L42.9 230.3c-4.7-4.7-12.3-4.7-17 0L6.1 250.1c-4.7 4.7-4.7 12.3 0 17l209.4 209.4c4.7 4.7 12.3 4.7 17 0l209.4-209.4c4.7-4.7 4.7-12.3 0-17z"></path></svg>
				</a>
			</div>
		
		<?php 
	
		endif;



	?>

	</div>

	<?php

}

?>