<?php 

// register block

switch_register_block('card', 'megaphone');

// render block

function render_block_card() {

	// vars

	$align = get_field('align');
	$background = get_field('background');
	$color = get_field('color');
	$id = get_field('id');
	$image = get_field('image');

	?>

	<div id="<?php echo $id; ?>" class="card card--<?php echo $align; ?> card--<?php echo $background; ?> card--<?php echo $color; ?> card--<?php echo $image; ?>">

	<?php

	if( have_rows('flexible_content') ):

		while ( have_rows('flexible_content') ) : the_row();

			if( get_row_layout() == 'highlight' ):

				?>

				<div class="card__container">

					<?php

					if( have_rows('repeater') ):

						while ( have_rows('repeater') ) : the_row();

							// vars

							$image = get_sub_field('image');
							$text = get_sub_field('text');
							$button = get_sub_field('button');
					
							?>

							<div class="card__item animate__animated animate__bounceInUp">

								<?php if ($image): ?>

									<div class="card__image">

										<a <?php if ($button): ?>href="<?php echo $button['url']; ?>" target="<?php echo $button['target']; ?>"<?php endif; ?>>

											<img src="<?php echo $image['sizes']['960-1-1']; ?>" alt="<?php echo $image['title']; ?>">
										
										</a>

									</div>

								<?php endif; ?>

								<?php if ($text): ?>

									<div class="card__text wysiwyg">

										<?php echo $text; ?>

									</div>

								<?php endif; ?>

								<?php if ($button): ?>

									<div class="card__button">

										<a class="button button--filled-secondary" href="<?php echo $button['url']; ?>" target="<?php echo $button['target']; ?>"><?php echo $button['title']; ?></a>

									</div>

								<?php endif; ?>

							</div>

							<?php 

						endwhile;
					
					endif;

					?>

				</div>
				
				<?php

			endif;

			if( get_row_layout() == 'child' ):

				?>

				<div class="card__container">

					<?php
	
					// vars

					$child_parent = get_sub_field('parent');
					$child_query = new WP_Query(
						array(  
							'post_parent' => $child_parent,
							'post_type' => 'page',
							'post_status' => 'publish',
							'orderby' => array(
								'menu_order' => 'asc'
							),
							'posts_per_page' => -1,
							'paged' => $post_current_page
						)
					);

					while ( $child_query->have_posts() ) : $child_query->the_post();

						// vars

						$image = get_the_post_thumbnail_url($child->ID, '960-1-1');
						$text = get_the_title($child->ID);
						$button = get_the_permalink($child->ID);

						?>

						<div class="card__item animate__animated animate__bounceInUp">

							<?php if ($image): ?>

								<div class="card__image">

									<a href="<?php echo $button; ?>">

										<img src="<?php echo $image; ?>" alt="<?php echo $text; ?>">
									
									</a>

								</div>

							<?php endif; ?>

							<?php if ($text): ?>

								<div class="card__text">

									<h2><?php echo $text; ?></h2>

								</div>

							<?php endif; ?>

							<?php if ($button): ?>

								<div class="card__button">

									<a class="button button--filled-secondary" href="<?php echo $button; ?>">Bekijk</a>

								</div>

							<?php endif; ?>

						</div>

						<?php

					endwhile;

					wp_reset_postdata(); 

					?>

				</div>

				<?php

			endif;

			if( get_row_layout() == 'post' ):

				// vars

				$post_type = get_sub_field('type');
				$post_per_page = get_sub_field('per_page');
				$post_more = get_sub_field('more');
				$post_current_page = (get_query_var('paged')) ? get_query_var('paged') : 1;
				$post_query = new WP_Query(
					array(  
						'post_type' => $post_type,
						'post_status' => 'publish',
						'orderby' => array(
							'post_date' => 'desc', 
						),
						'posts_per_page' => $post_per_page,
						'paged' => $post_current_page
					)
				);
				$post_max_pages = $post_query->max_num_pages;
				$post_text_more = 'Laad meer';
				$post_text_loading = 'Aan het laden ...';
				$post_text_done = 'Uitgeladen';

				?>

				<div class="card__container" 
					
					data-post-type="<?php echo $post_type; ?>"
					data-post-per-page="<?php echo $post_per_page; ?>"
					data-post-max-pages="<?php echo $post_max_pages; ?>"
					data-post-text-more="<?php echo $post_text_more; ?>"
					data-post-text-loading="<?php echo $post_text_loading; ?>"
					data-post-text-done="<?php echo $post_text_done; ?>"
				
				>

					<?php
						
					while ( $post_query->have_posts() ) : $post_query->the_post();

						// vars

						$id = get_the_ID();

						if ($post_type == 'facebook'):

							$type = get_field('facebook_type', $id);
							$image = get_field('facebook_image', $id);
							$title = get_the_date('d.m.Y', $id);
							$text = get_field('facebook_text', $id);
							$button = get_field('facebook_link', $id);

						elseif ($post_type == 'projects'):

							$post = get_post($id);
							$blocks = parse_blocks($post->post_content);
							$type = '';
							$image = get_the_post_thumbnail_url($id, '960-1-1');
							$title = $blocks[0]['attrs']['data']['title'];
							$date = get_the_date('d.m.Y', $id);
							$text = $blocks[0]['attrs']['data']['text'];
							$button = $blocks[0]['attrs']['data']['button_left']['url'];

						else:

							$type = '';
							$image = get_the_post_thumbnail_url($id, '960-1-1');
							$title = get_the_title($id);
							$text = '';
							$button = get_the_permalink($id);

						endif;

						?>

						<div class="card__item animate__animated animate__bounceInUp">

							<?php if ($image): ?>

								<div class="card__image <?php if ($type == 'video'): ?>card__image--video<?php endif; ?>">

									<a href="<?php echo $button; ?>" <?php if ($post_type == 'facebook' || $post_type == 'projects' ): ?>target="_blank"<?php endif; ?>>

										<img src="<?php echo $image; ?>" alt="<?php echo $title; ?>">
									
									</a>

								</div>

							<?php endif; ?>

							<?php if ($title): ?>

								<div class="card__text">

									<h2><?php echo $title; ?></h2>

									<?php if ($post_type == 'projects'): ?>

										<h3><?php echo $date; ?></h3>
										
									<?php endif; ?>

									<p><?php echo $text; ?></p>

								</div>

							<?php endif; ?>

							<?php if ($button): ?>

								<div class="card__button">

									<a class="button button--filled-secondary" href="<?php echo $button; ?>" <?php if ($post_type == 'facebook' || $post_type == 'projects' ): ?>target="_blank"<?php endif; ?>>Bekijk</a>

								</div>

							<?php endif; ?>

						</div>

						<?php

					endwhile;

					?>

				</div>

				<?php 
				
				if ($post_more): 
				
					?>

					<div class="card__load-more">

						<button class="button button--filled-secondary <?php echo ($post_max_pages == 1) ? 'button--disabled' : '' ; ?>" <?php echo ($post_max_pages == 1) ? 'disabled' : '' ; ?>><?php echo ($post_max_pages == 1) ? $post_text_done : $post_text_more ; ?></button>

					</div>

					<?php 
				
				endif;

				wp_reset_postdata(); 

			endif;

		endwhile;

	endif;

	?>

	</div>

	<?php
	
}

?>