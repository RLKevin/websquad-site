<?php 

// register block

switch_register_block('map', 'location');


// render block

function render_block_map() {
		
	// vars

	$map = get_field('map');
	$company = get_field('options_company', 'option');
	$street = get_field('options_street', 'option');
	$postalCode = get_field('options_postal_code', 'option');
	$city = get_field('options_city', 'option');
	$phone = get_field('options_phone_number', 'option');
	$phone_stripped = str_replace([' ', '-'], '', $phone);
	$email = get_field('options_email_address', 'option');
	$id = get_field('id');

	?>

	<div id="<?php echo $id; ?>" class="map">
			
		<div class="map__map">

			<div class="marker" data-lat="<?php echo $map['lat']; ?>" data-lng="<?php echo $map['lng']; ?>"></div>

		</div>

		<div class="wrapper">

			<div class="map__content">
				
				<h2><?php echo $company; ?></h2>
				
				<ul>

					<li>

						<?php echo $street; ?>

					</li>

					<li>

						<?php echo $postalCode; ?> <?php echo $city; ?>

					</li>

				</ul>
				
				<ul>
						
					<?php if ($phone): ?>

						<li>

							<a class="phone" href="tel:<?php echo $phone_stripped; ?>"><?php echo $phone; ?></a>

						</li>

					<?php endif ?>

					<?php if ($email): ?>

						<li>

							<a class="mail" href="mailto:<?php echo $email; ?>"><?php echo $email; ?></a>

						</li>

					<?php endif ?>

				</ul>

			</div>

		</div>

	</div>

	<?php 

}

?>