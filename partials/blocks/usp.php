<?php 

// register block

switch_register_block('usp', 'yes');

// render block

function render_block_usp() {

	// vars

	$background = get_field('background');
	$id = get_field('id');

	?>

	<div id="<?php echo $id; ?>" class="usp usp--<?php echo $align; ?> usp--<?php echo $background; ?>">

		<?php

		if( have_rows('repeater') ):

			?>
				
			<div class="usp__slider slider">

				<?php 
				
				while ( have_rows('repeater') ) : the_row();

					// vars

					$text = get_sub_field('text');

					?>

					<div class="usp__slide">

						<p>

							<?php echo $text; ?>

						</p>

					</div>

					<?php 
				
				endwhile; 
				
				?>
				
			</div>

			<?php 

		endif;
		
		?>

	</div>

	<?php

}

?>