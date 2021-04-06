<?php get_header(); ?>

<main>
	<article>

		<?php while ( have_posts() ) : the_post(); ?>
			<?php the_content(); ?>
		<?php endwhile; ?>
		
		<?php wp_reset_query(); ?>

	</article>
</main>

<?php get_footer(); ?>

