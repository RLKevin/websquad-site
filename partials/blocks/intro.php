<?php 

// register block
	
switch_register_block('intro', 'editor-aligncenter');

// render block

function render_block_intro() {
		
	// vars
	
	$title = get_field('title');
	$text = get_field('text');
	$button_left = get_field('button_left');
	$button_right = get_field('button_right');
	$background = get_field('background');
	$image = get_field('image');
	$id = get_field('id');

	?>

	<div id="<?php echo $id; ?>" class="intro">

		<?php if ($title): ?>

			<div class="intro__title intro__title--<?php echo $background; ?>" <?php if ($image): ?>style="background-image: url('<?php echo $image['sizes']['1920-16-9']; ?>')"<?php endif; ?>>

				<div class="wrapper">

					<h1><?php echo $title; ?></h1>

				</div>

			</div>

		<?php endif; ?>

		<?php if ($text):?>
			
			<div class="intro__text wysiwyg">

				<div class="wrapper">

					<?php echo $text; ?>

					<?php if ($button_left || $button_right ): ?>

						<div class="intro__button-container">

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

		<?php endif; ?>

	</div>

	<?php 

}

?>