<?php

	// import options page fields into acf
	// add_action('acf/init', function(){ 
	// });

	// generate variables.scss

		// when theme is updated via wp pusher
		add_action('wppusher_theme_was_updated', function($stylesheet) use ($notifier) {
			generate_variables_scss();
		});
	
		// when any post is saved
		add_action( 'acf/save_post', 'generate_variables_scss', 20 );

		function generate_variables_scss() {

			$theme = get_stylesheet_directory();
			ob_start();
			require($theme . '/scss/assets/variables.php');
			$scss = ob_get_clean();
			file_put_contents($theme . '/scss/assets/_variables.scss', $scss, LOCK_EX);
			touch($theme . '/scss/style.scss');
			
		}

	// add scripts

	
	add_action( 'wp_enqueue_scripts', 'switchreclamebureau_adding_scripts', 999 );	
	function switchreclamebureau_adding_scripts() {
			$maps_api_key = get_field('options_maps_key', 'options');
			// $maps_api_key = 'AIzaSyDWoSM3uHPncI05dg05dAN1GGsRC80BOxE';
			wp_enqueue_script('main', get_template_directory_uri() . '/js/main.js', array('jquery'), filemtime(get_stylesheet_directory() . '/js/main.js'));
			wp_enqueue_script('owl', get_template_directory_uri() . '/js/vendor/owl.carousel.min.js', array(), filemtime(get_stylesheet_directory() . '/js/vendor/owl.carousel.min.js'));
			wp_enqueue_script('dotdotdot', get_template_directory_uri() . '/js/vendor/dotdotdot.js', array(), filemtime(get_stylesheet_directory() . '/js/vendor/dotdotdot.js'));
			wp_enqueue_script('modernizr', get_template_directory_uri() . '/js/vendor/modernizr-2.8.3-respond-1.4.2.min.js', array(), filemtime(get_stylesheet_directory() . '/js/vendor/modernizr-2.8.3-respond-1.4.2.min.js'));
			wp_enqueue_script('google-maps-api', 'https://maps.googleapis.com/maps/api/js?key='.$maps_api_key);
			wp_enqueue_script('google-maps-settings', get_template_directory_uri() . '/js/vendor/google-maps-settings.js', array(), filemtime(get_stylesheet_directory() . '/js/vendor/google-maps-settings.js'));
			$primaryColor = get_field('color-primary', 'options');
			$secondaryColor = get_field('color-secondary', 'options');
			echo '<script type="text/javascript">setColors("'.$primaryColor.'", "'.$secondaryColor.'");</script>';
			// wp_enqueue_script('acf', get_template_directory_uri() . 'plugins/advanced-custom-fields/js/js/input.min.js', array('jquery'), filemtime(get_stylesheet_directory() . 'plugins/advanced-custom-fields/js/js/input.min.js'));
		}

	// add styles
	  
		add_action('wp_enqueue_scripts', 'switchreclamebureau_adding_styles' );	
		function switchreclamebureau_adding_styles() {

			wp_enqueue_style('ff-primary', get_field('ff_primary_url', 'option') ? get_field('ff_primary_url', 'option') : 'https://use.typekit.net/kll4grl.css');
			wp_enqueue_style('ff-secondary', get_field('ff_secondary_url', 'option') ? get_field('ff_secondary_url', 'option') : 'https://fonts.googleapis.com/css?family=Lato:300,400,700,900');
			wp_enqueue_style('style', get_template_directory_uri() . '/css/style.css', array(), filemtime( get_stylesheet_directory() . '/css/style.css' ));
		}

	// acf init

		add_action('acf/init', 'my_acf_init');
		function my_acf_init() {

			// import option fields

			include 'acf-fields.php';

			// acf - gutenberg full width

			add_action('admin_head', 'editor_full_width_gutenberg');
			function editor_full_width_gutenberg() {
				echo 
				'<style>
					.wp-block {
						max-width: none !important;
					}
				</style>';
			}

			// acf - create block categories

			add_filter( 'block_categories', function( $categories, $post ) {
				return array_merge(
					$categories,
					array(
						array(
							'slug' => 'switch-blocks',
							'title' => __( 'Switch Blocks', 'switch-blocks' ),
						),
					)
				);
			}, 10, 2 );

			// acf - register blocks

			function switch_register_block($name, $icon) {

				if( function_exists('acf_register_block') ) {
			
					acf_register_block(array(
						'name'				=> $name,
						'title'				=> __(ucfirst($name)),
						'description'		=> __('A custom ' . $name . ' block.'),
						'render_callback'	=> 'render_block_' . $name,
						'mode' 				=> 'edit',
						'category'			=> 'switch-blocks',
						'icon'				=> $icon,
						'keywords'			=> array($name),
						'supports'			=> array(
												'mode' 				=> false, 
												'align' 			=> false, 
												'customClassName' 	=> false, 
												'className' 		=> false, 
												'html' 				=> false, 
												'reusable' 			=> false,
						),
					));
				}
			
			}

			// acf - render blocks

			include 'partials/blocks/card.php';
			include 'partials/blocks/content.php';
			include 'partials/blocks/faq.php';
			include 'partials/blocks/form.php';
			include 'partials/blocks/gallery.php';
			include 'partials/blocks/hero.php';
			include 'partials/blocks/highlight.php';
			include 'partials/blocks/intro.php';
			include 'partials/blocks/map.php';
			include 'partials/blocks/open.php';
			include 'partials/blocks/post.php';
			include 'partials/blocks/reference.php';
			include 'partials/blocks/search.php';
			include 'partials/blocks/spacer.php';
			include 'partials/blocks/table.php';
			include 'partials/blocks/usp.php';
				
			// acf - allowed blocks

			add_filter( 'allowed_block_types', 'switch_allowed_block_types' );
			function switch_allowed_block_types( $allowed_blocks ) {

				return array(
					'acf/card',
					'acf/content',
					'acf/faq',
					'acf/form',
					'acf/gallery',
					'acf/hero',
					'acf/intro',
					'acf/map',
					'acf/open',
					'acf/reference',
					'acf/search',
					'acf/spacer',
					'acf/table',
					'acf/usp',
				);
			}

			// acf - basic wysiwyg - https://www.tiny.cloud/docs-3x/reference/buttons/

			add_filter("mce_buttons", "base_extended_editor_mce_buttons", 0);
			function base_extended_editor_mce_buttons($buttons) {
				return array('formatselect', 'bold', 'italic', 'strikethrough', 'bullist', 'link', 'unlink', 'blockquote');
			}

			add_filter('tiny_mce_before_init', 'base_custom_mce_format' );
			function base_custom_mce_format($init) {
				$init['block_formats'] = 'Paragraph=p;Subtitle=h3;Title=h2;';
				return $init;
			}
			
			// acf - google maps			
			
			acf_update_setting('google_api_key', 'AIzaSyDWoSM3uHPncI05dg05dAN1GGsRC80BOxE');

			// acf - options page

			if( function_exists('acf_add_options_page') ) {
	
				acf_add_options_page(array(
					'page_title' 	=> 'Options',
					'menu_title'	=> 'Options',
					'menu_slug' 	=> 'theme-general-settings',
					'capability'	=> 'edit_posts',
					'redirect'		=> false
				));
			
			}
		}

	// custom image sizes

		add_image_size( '640-16-9', 640, 360, true );
		add_image_size( '640-4-3', 640, 480, true );
		add_image_size( '640-1-1', 640, 640, true );
		add_image_size( '960-16-9', 960, 540, true );
		add_image_size( '960-4-3', 960, 720, true );
		add_image_size( '960-1-1', 960, 960, true );
		add_image_size( '1280-16-9', 1280, 720, true );
		add_image_size( '1280-4-3', 1280, 960, true );
		add_image_size( '1920-16-9', 1920, 1080, true );

		add_image_size( '640', 640, 640 );
		add_image_size( '960', 960, 540 );
		add_image_size( '1280', 1280, 720 );
		add_image_size( '1920', 1920, 1080 );

	// register menu
		
		add_action( 'init', 'register_menu' );
		function register_menu() {
			register_nav_menu('menu',__( 'Primary Menu' ));
		}
	
	// custom post types

		// add featured image

		add_theme_support( 'post-thumbnails' );

		// create custom post type

		add_action( 'init', 'create_post_types' );
		function create_post_types() {

			function create_post_type($name) {
				register_post_type( $name,
					array(
					'labels'                => array(
						'name'                => $name,
						'singular_name'       => $name,
						'menu_name'           => $name,
						'add_new'             => 'New',
						'add_new_item'        => 'New',
						'new_item'            => 'New',
						'edit'                => 'Edit',
						'edit_item'           => 'Edit',
						'view'                => 'View',
						'view_item'           => 'View',
						'search_items'        => 'Search',
						'not_found'           => 'Not found',
						'not_found_in_trash'  => 'Not found in trash',
					),
					'public'                => true,
					'menu_position'         => 10,
					'supports'           	=> array( 'title', 'editor', 'revisions', 'thumbnail' ),
					'show_in_rest' 			=> true,
					)
				);
			}
			create_post_type('Blog');
			create_post_type('News');
			create_post_type('Projects');
			create_post_type('Vacancies');
			create_post_type('Facebook');
		}

		// remove default post type

		add_action( 'admin_menu', 'remove_post_type' );
		function remove_post_type(){
			remove_menu_page( 'edit.php' );
		}

		// add custom post type to search

		// add_filter( 'pre_get_posts', 'custom_post_type_to_search' );
		// function custom_post_type_to_search( $query ) {
		// 	if ( !is_admin() ) {
		// 		if ( $query->is_search ) {
		// 			$query->set( 'post_type', array( 'post', 'activities', 'locations', 'news' ) );
		// 		}
		// 	}
		// 	return $query;
		// }
	
	// gravity forms

		// price - change position currency

		add_filter( 'gform_currencies', 'gw_modify_currencies' );
		function gw_modify_currencies( $currencies ) {

			$currencies['EUR'] = array(
				'name'               => esc_html__( 'Euro', 'gravityforms' ),
				'symbol_left'        => '&#8364;',
				'symbol_right'       => '',
				'symbol_padding'     => ' ',
				'thousand_separator' => '.',
				'decimal_separator'  => ',',
				'decimals'           => 2
			);

			return $currencies;
		}

		// submit button - change input to button
		
		add_filter( 'gform_submit_button', 'input_to_button', 10, 2 );
		function input_to_button( $button, $form ) {
			$dom = new DOMDocument();
			$dom->loadHTML( $button );
			$input = $dom->getElementsByTagName( 'input' )->item(0);
			$new_button = $dom->createElement( 'button' );
			$new_button->appendChild( $dom->createTextNode( $input->getAttribute( 'value' ) ) );
			$input->removeAttribute( 'value' );
			foreach( $input->attributes as $attribute ) {
				$new_button->setAttribute( $attribute->name, $attribute->value );
			}
			$input->parentNode->replaceChild( $new_button, $input );
		
			return $dom->saveHtml( $new_button );
		}
		
		// submit button - add custom class

		add_filter( 'gform_submit_button', 'add_custom_css_classes', 10, 2 );
		function add_custom_css_classes( $button, $form ) {
			$dom = new DOMDocument();
			$dom->loadHTML( $button );
			$input = $dom->getElementsByTagName( 'button' )->item(0);
			$classes = $input->getAttribute( 'class' );
			$classes .= " button button--filled-secondary";
			$input->setAttribute( 'class', $classes );
			return $dom->saveHtml( $input );
		}

		// submit button - change spinner

		add_filter( 'gform_ajax_spinner_url', 'tgm_io_custom_gforms_spinner' );
		function tgm_io_custom_gforms_spinner( $src ) {
			return get_stylesheet_directory_uri() . '/img/icons/loading.svg';
		}

		// submit validation - validation error

		add_filter( 'gform_validation_message', 'change_message', 10, 2 );
		function change_message( $message, $form ) {
			return "<div class='validation_error'>Niet alle verplichte velden zijn (correct) ingevuld.</div>";
		}
				
	// websquad login logo

		add_action('login_head', 'custom_loginlogo');
		function custom_loginlogo() {
			echo '<style type="text/css"> h1 a { margin: 0px !important; background-size: 100% !important; width: 280px !important; height: 120px !important; position: relative !important; left: 50% !important; margin-left: -140px !important; margin-bottom: 40px !important; background-image: url('.get_bloginfo('template_directory').'/img/template-logo.png) !important; } </style>';
		}

	// remove admin bar push down
	
		add_action('get_header', 'my_filter_head');
		function my_filter_head() {
			remove_action('wp_head', '_admin_bar_bump_cb');
		}
		
	// allow upload - svg

		function cc_mime_types($mimes) {
			$mimes['svg'] = 'image/svg';
			return $mimes;
		}
		add_filter('upload_mimes', 'cc_mime_types');

	// post load more
	
		// tutorial - https://weichie.com/blog/ajax-load-more-posts-wordpress/

		// result - http://localhost/websquad/wordpress/wp-json/websquad/posts?post-type=news&post-per-page=1&post-current-page=1

		// register route

		add_action( 'rest_api_init', function () {

			register_rest_route( 'websquad', '/posts', array(
				'methods' => array('GET'),
				'callback' => 'post_load',
			) );

		});

		// set function

		function post_load( WP_REST_Request $request ) {

			// vars

			$post_data = array();
			$post_type = $request->get_param('post-type');
			$post_per_page = $request->get_param('post-per-page');
			$post_current_page = $request->get_param('post-current-page');
			$post_current_page = (isset($post_current_page) || !(empty($post_current_page))) ? $post_current_page : 1;
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

				// $type = $post_type != 'facebook' ? '' : get_field('facebook_type', $id);
				// $image = $post_type != 'facebook' ? get_the_post_thumbnail_url($id, '960-1-1') : get_field('facebook_image', $id);
				// $title = $post_type != 'facebook' ? get_the_title($id) : get_the_date('d.m.Y', $id);
				// $text = $post_type != 'facebook' ? '' : get_field('facebook_text', $id);
				// $button = $post_type != 'facebook' ? get_the_permalink($id) : get_field('facebook_link', $id);

				// data

				$post_data[] = (object)array(

					'id' => $id,
					'type' => $type,
					'image' => $image,
					'title' => $title,
					'date' => $date,
					'text' => $text,
					'button' => $button,
				
				);

			endwhile;

			wp_reset_postdata(); 

			return $post_data;

		}


	// facebook posts

		// facebook posts - cron schedules - 10 minutes

		add_filter( 'cron_schedules', 'every_ten_minutes' );
		function every_ten_minutes( $schedules ) {
			$schedules['ten_minutes'] = array(
				'interval' => 600,
				'display'  => esc_html__( 'Every ten minutes' ),
			);
			return $schedules;
		}

		if ( ! wp_next_scheduled( 'every_ten_minutes' ) ) {
			wp_schedule_event( time(), 'ten_minutes', 'every_ten_minutes' );
		}

		// facebook posts - get posts

		add_action( 'every_ten_minutes', 'update_facebook' );
		// add_action( 'init', 'update_facebook' );
		function update_facebook() {

			// vars

			$fb_page = get_field('options_facebook_page', 'option');
			$fb_access_token = get_field('options_facebook_access_token', 'option');
		
			if ($fb_page && $fb_access_token) {
		
				// vars

				$fb_json = 'https://graph.facebook.com/v4.0/' . $fb_page . '/posts?access_token=' . $fb_access_token . '&fields=id,created_time,full_picture,message,status_type,permalink_url&limit=32';
				$fb_results = json_decode(file_get_contents($fb_json),true);
		
				foreach ($fb_results['data'] as $fbResult) {
		
					// vars

					$id = $fbResult['id'];
					$created_time = new DateTime($fbResult['created_time']);
					$created_time = $created_time->setTimezone(new DateTimeZone("Europe/Amsterdam"));
					$date_time = $created_time->format('Y-m-d H:i:s');
					$type = $fbResult['status_type'];
					if (strpos($type, 'video') !== false) { $type = 'video'; }
					if (strpos($type, 'photo') !== false) { $type = 'photo'; }		
					$image = $fbResult['full_picture'];
					$text = $fbResult['message'];
					$text = str_replace("\n", '<br/>', $text);
					$text = str_replace("'", "\&#39;", $text);
					$link = $fbResult['permalink_url'];
					
					// add post to database
		
					if (null == get_page_by_title($id, 'OBJECT', 'facebook') && $type != 'shared_story' && strlen($text) > 0 && !empty($image)) {
		
						$post_id = wp_insert_post(
							array(
								'post_name'		=>	$id,
								'post_title'	=>	$id,
								'post_status'	=>	'publish',
								'post_type'		=>	'facebook',
								'post_date'		=>	$date_time,
							)
						);
		
						// upload image
		
						require_once(ABSPATH . 'wp-admin/includes/media.php');
						require_once(ABSPATH . 'wp-admin/includes/file.php');
						require_once(ABSPATH . 'wp-admin/includes/image.php');
						$image_attachment = media_sideload_image($image, $post_id, $text, 'src');
		
						// save to post
						
						update_post_meta($post_id, 'facebook_type', $type);
						update_post_meta($post_id, 'facebook_image', $image_attachment);		
						update_post_meta($post_id, 'facebook_text', $text);
						update_post_meta($post_id, 'facebook_link', $link);
					}
		
				}
		
			} else {
		
				return;
		
			}
		}

	// debug to console

		function debug_to_console( $data ) {
			$output = $data;
			if ( is_array( $output ) )
				$output = implode( ',', $output);
			echo "<script>console.log('" . $output . "');</script>";
		}

		// debug_to_console('test');
?>