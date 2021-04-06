<?php 

// register block

switch_register_block('table', 'editor-table');

// render block

function render_block_table() {
		
	// vars

	$background = get_field('background');
	$id = get_field('id');

	?>

	<div id="<?php echo $id; ?>" class="table table--<?php echo $align; ?> table--<?php echo $background; ?>">

		<div class="wrapper">
	
			<?php

			if( have_rows('repeater') ):
				
				?>

				<ul>

				<?php
		
				while ( have_rows('repeater') ) : the_row();
	
					// vars

					$type = get_sub_field('type');
					$left = get_sub_field('left_column');
					$right = get_sub_field('right_column');

					?>

						<li class="table__row table__row--<?php echo $type; ?>">
							
							<?php if ($left): ?>

								<span class="table__col table__col--left"><?php echo $left; ?></span>
							
							<?php endif; ?>

							<?php if ($right): ?>

								<span class="table__col table__col--right"><?php echo $right; ?></span>
								
							<?php endif; ?>
							
						</li>

					<?php
	
				endwhile;

				?>

				</ul>

				<?php
		
			endif;

			?>

		</div>
	</div>

	<?php 

}

?>