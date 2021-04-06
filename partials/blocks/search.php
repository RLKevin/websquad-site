<?php 

// register block

switch_register_block('search', 'search');

// render block

function render_block_search() {
		
	// vars

	$page_not_found_id = (get_page_by_path('pagina-niet-gevonden'))->ID;
	$search_id = (get_page_by_path('zoeken'))->ID;
	$thanks_id = (get_page_by_path('bedankt'))->ID;
	$exclude = $page_not_found_id . ', ' . $search_id . ', ' . $thanks_id . ', ' . get_field('exclude');
	$search = $_GET["keyword"];
	$the_query = new WP_Query(
		array(
			's' => $search, 
			'posts_per_page'		=> $items,
			'post_type'				=> array('page', 'blog', 'news', 'projects', 'vacancies'),
			'post__not_in' 			=> explode(',', $exclude),
			'posts_per_page'		=> '-1',
			'orderby' 				=> 'menu_order', 
			'order' 				=> 'asc',
		) 
	);
	$count = $the_query -> post_count;
	$align = get_field('align');
	$background = get_field('background');
	$id = get_field('id');

	?>

	<div id="<?php echo $id; ?>" class="search search--<?php echo $align; ?> search--<?php echo $background; ?>">

		<div class="wrapper">
		
			<h2>Resultaten voor <?php echo $search; ?></h2>
			<h3>Er <?php echo ($count == 1 ? 'is' : 'zijn'); ?> <?php echo ($count == 0 ? 'geen' : $count); ?> <?php echo ($count == 1 ? 'resultaat' : 'resultaten'); ?> gevonden.</h3>

			<?php 

			while ($the_query -> have_posts()): $the_query -> the_post();

				// vars

				$link = get_the_permalink();
				$title = get_the_title();

				?>

				<a href="<?php echo $link; ?>"><?php echo $title; ?>
					<svg aria-hidden="true" focusable="false" data-prefix="far" data-icon="arrow-right" class="svg-inline--fa fa-arrow-right fa-w-14" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M218.101 38.101L198.302 57.9c-4.686 4.686-4.686 12.284 0 16.971L353.432 230H12c-6.627 0-12 5.373-12 12v28c0 6.627 5.373 12 12 12h341.432l-155.13 155.13c-4.686 4.686-4.686 12.284 0 16.971l19.799 19.799c4.686 4.686 12.284 4.686 16.971 0l209.414-209.414c4.686-4.686 4.686-12.284 0-16.971L235.071 38.101c-4.686-4.687-12.284-4.687-16.97 0z"></path></svg>
				</a>

				<?php

			endwhile;

			?>

		</div>
	</div>

	<?php 

}

?>