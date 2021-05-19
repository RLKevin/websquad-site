// colors

$cl-black:					<?= get_field('cl_black', 'option') 					? get_field('cl_black', 'option') 			: '#000000'; ?>;
$cl-white:					<?= get_field('cl_white', 'option') 					? get_field('cl_white', 'option') 			: '#ffffff'; ?>;
$cl-grey:					<?= get_field('cl_grey', 'option') 						? get_field('cl_grey', 'option') 			: '#eeeeee'; ?>;
$cl-primary:				<?= get_field('cl_primary', 'option') 					? get_field('cl_primary', 'option') 		: '#C6006D'; ?>;
$cl-primary-text:			<?= get_field('cl_primary_text', 'option') 				? get_field('cl_primary_text', 'option') 	: '$cl-black'; ?>;
$cl-secondary:				<?= get_field('cl_secondary', 'option') 				? get_field('cl_secondary', 'option') 		: '#5F207A'; ?>;
$cl-secondary-text:			<?= get_field('cl_secondary_text', 'option') 			? get_field('cl_secondary_text', 'option') 	: '$cl-black'; ?>;
$cl-error:					<?= get_field('cl_error', 'option') 					? get_field('cl_error', 'option') 			: '#EA4335'; ?>;
				
// font size						
				
$fs-tiny:					<?= get_field('fs_small', 'option') 					? get_field('fs_small', 'option') * 0.75 	: 16 * 0.75; ?>px;
$fs-small:					<?= get_field('fs_small', 'option') 					? get_field('fs_small', 'option') 			: 16; ?>px;
$fs-medium:					<?= get_field('fs_small', 'option') 					? get_field('fs_small', 'option') *	1.25	: 16 * 1.25; ?>px;
$fs-large:					<?= get_field('fs_small', 'option') 					? get_field('fs_small', 'option') *	1.5		: 16 * 1.5; ?>px;
$fs-huge:					<?= get_field('fs_small', 'option') 					? get_field('fs_small', 'option') *	2		: 16 * 2; ?>px;
				
// letter spacing				
				
$ls_medium:					<?= get_field('ls_medium', 'option') 					? get_field('ls_medium', 'option')			: 0.6; ?>px;
				
// line-height				
				
$lh-small:					<?= get_field('lh_large', 'option') 					? get_field('lh_large', 'option') * 0.6		: 1.2; ?>;
$lh-medium: 				<?= get_field('lh_large', 'option') 					? get_field('lh_large', 'option') *	0.8		: 1.6; ?>;
$lh-large: 					<?= get_field('lh_large', 'option') 					? get_field('lh_large', 'option')			: 2.0; ?>;
				
// font weight						
				
$fw-light:					<?= get_field('fw_light', 'option') 					? get_field('fw_light', 'option') 			: '300'; ?>;
$fw-regular:				<?= get_field('fw_regular', 'option') 					? get_field('fw_regular', 'option') 		: '400'; ?>;
$fw-medium:					<?= get_field('fw_medium', 'option') 					? get_field('fw_medium', 'option') 			: '600'; ?>;
$fw-bold:					<?= get_field('fw_bold', 'option') 						? get_field('fw_bold', 'option') 			: '700'; ?>;
				
// font family					
				
$ff-primary:				<?= get_field('ff_primary', 'option') 					? get_field('ff_primary', 'option') 		: "'lexia', serif"; ?>;
$ff-secondary:				<?= get_field('ff_secondary', 'option') 				? get_field('ff_secondary', 'option') 		: "'Lato', sans-serif"; ?>;

// border radius

$br-rectangle-top-left:		<?= get_field('br_rectangle_top_left', 'option') 		? get_field('br_rectangle_top_left', 'option') 		: '0'; ?>px;
$br-rectangle-top-right:	<?= get_field('br_rectangle_top_right', 'option') 		? get_field('br_rectangle_top_right', 'option') 	: '0'; ?>px;
$br-rectangle-bottom-right:	<?= get_field('br_rectangle_bottom_right', 'option') 	? get_field('br_rectangle_bottom_right', 'option') 	: '0'; ?>px;
$br-rectangle-bottom-left:	<?= get_field('br_rectangle_bottom_left', 'option') 	? get_field('br_rectangle_bottom_left', 'option') 	: '0'; ?>px;

$br-square-top-left:		<?= get_field('br_square_top_left', 'option') 			? get_field('br_square_top_left', 'option') 		: '0'; ?>px;
$br-square-top-right:		<?= get_field('br_square_top_right', 'option') 			? get_field('br_square_top_right', 'option') 	: '0'; ?>px;
$br-square-bottom-right:	<?= get_field('br_square_bottom_right', 'option') 		? get_field('br_square_bottom_right', 'option') 	: '0'; ?>px;
$br-square-bottom-left:		<?= get_field('br_square_bottom_left', 'option') 		? get_field('br_square_bottom_left', 'option') 	: '0'; ?>px;

// animation

$preferred-animation:       <?= get_field('animation', 'option')                    ? get_field('animation', 'option')              : 'none'; ?>;