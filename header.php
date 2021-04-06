<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
  
  	<head>
    
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width, initial-scale=1">
    
		<title><?php wp_title('|',1,'right'); ?> <?php bloginfo('name'); ?></title>
		
		<meta name="description" content="<?php bloginfo('description'); ?>">
		<meta property="og:title" content="<?php bloginfo('name'); ?>" />
		<meta property="og:description" content="<?php bloginfo('description'); ?>">
		<meta property="og:url" content="<?php echo get_site_url(); ?>" />
		<meta property="og:image" content="<?php echo get_site_icon_url(); ?>" />
		<meta property="og:image:secure_url" content="<?php echo get_site_icon_url(); ?>" />
    
    	<?php wp_head(); ?>
    
		<script type="text/javascript">

			var site_url = "<?php echo get_site_url(); ?>";
			var page_id = "<?php echo get_the_ID(); ?>";
			var template = '<?= get_template_directory_uri(); ?>';

		</script>

		<?php 

			// vars

			$tag_manager_head = get_field('options_tag_manager_head', 'option');

			if ($tag_manager_head):

				echo $tag_manager_head;

			endif;

		?>

  	</head>
  
  	<body>

		<?php 

			// vars
			
			$tag_manager_body = get_field('options_tag_manager_body', 'option');

			if ($tag_manager_body):

				echo $tag_manager_body;

			endif;

		?>

		<?php get_template_part('partials/header'); ?>