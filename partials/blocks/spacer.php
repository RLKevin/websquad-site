<?php 

// register block

switch_register_block('spacer', 'minus');

// render block

function render_block_spacer() {
		
	// vars
	
	$margin = get_field('margin');
	$background = get_field('background');
	$id = get_field('id');

	?>

	<div id="<?php echo $id; ?>" class="spacer spacer--<?php echo $background; ?> spacer--<?php echo $margin; ?>"></div>

	<?php

}

?>