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
	$classes = get_field('classes');
	$image = get_field('image');

	?>

	<div id="<?= $id; ?>" class="card card--<?= $align; ?> card--<?= $background; ?> card--<?= $color; ?> card--<?= $image; ?> <?= $classes; ?>">

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

										<a <?php if ($button): ?>href="<?= $button['url']; ?>" target="<?= $button['target']; ?>"<?php endif; ?>>

											<img src="<?= $image['sizes']['960-1-1']; ?>" alt="<?= $image['title']; ?>">
										
										</a>

									</div>

								<?php endif; ?>

								<?php if ($text): ?>

									<div class="card__text wysiwyg">

										<?= $text; ?>

									</div>

								<?php endif; ?>

								<?php if ($button): ?>

									<div class="card__button">

										<a class="button button--filled-secondary" href="<?= $button['url']; ?>" target="<?= $button['target']; ?>"><?= $button['title']; ?></a>

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

									<a href="<?= $button; ?>">

										<img src="<?= $image; ?>" alt="<?= $text; ?>">
									
									</a>

								</div>

							<?php endif; ?>

							<?php if ($text): ?>

								<div class="card__text">

									<h2><?= $text; ?></h2>

								</div>

							<?php endif; ?>

							<?php if ($button): ?>

								<div class="card__button">

									<a class="button button--filled-secondary" href="<?= $button; ?>">Bekijk</a>

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
					
					data-post-type="<?= $post_type; ?>"
					data-post-per-page="<?= $post_per_page; ?>"
					data-post-max-pages="<?= $post_max_pages; ?>"
					data-post-text-more="<?= $post_text_more; ?>"
					data-post-text-loading="<?= $post_text_loading; ?>"
					data-post-text-done="<?= $post_text_done; ?>"
				
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
							$text = false;
							$button = get_the_permalink($id);

						endif;

						?>

						<div class="card__item animate__animated animate__bounceInUp">

							<?php if ($image): ?>

								<div class="card__image <?php if ($type == 'video'): ?>card__image--video<?php endif; ?>">

									<a href="<?= $button; ?>" <?php if ($post_type == 'facebook' || $post_type == 'projects' ): ?>target="_blank"<?php endif; ?>>

										<img src="<?= $image; ?>" alt="<?= $title; ?>">
									
									</a>

								</div>

							<?php endif; ?>

							<?php if ($title): ?>

								<div class="card__text">

									<h2><?= $title; ?></h2>

									<?php if ($post_type == 'projects'): ?>

										<h3><?= $date; ?></h3>
										
									<?php endif; ?>

									<?php if ($text): ?>

										<p><?= $text; ?></p>

									<?php endif; ?>
								</div>

							<?php endif; ?>

							<?php if ($button): ?>

								<div class="card__button">

									<a class="button button--filled-secondary" href="<?= $button; ?>" <?php if ($post_type == 'facebook' || $post_type == 'projects' ): ?>target="_blank"<?php endif; ?>>Bekijk</a>

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

						<button class="button button--filled-secondary <?= ($post_max_pages == 1) ? 'button--disabled' : '' ; ?>" <?= ($post_max_pages == 1) ? 'disabled' : '' ; ?>><?= ($post_max_pages == 1) ? $post_text_done : $post_text_more ; ?></button>

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