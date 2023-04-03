<?php
/**
 * Functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WordPress
 * @subpackage Narasix
 * @since 1.0.0
 */

/**
 * Theme set up
 */
if ( !function_exists( 'narasix_setup' ) ) {
	function narasix_setup() {

		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 */
		load_theme_textdomain( 'narasix', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		// Set content-width.
		global $content_width;
		if ( !isset( $content_width ) ) {
			$content_width = 1200;
		}

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );
		set_post_thumbnail_size( 1200, 9999 );

		// Add custom image sizes.

		add_image_size( 'narasix_lg', 1024, 9999, false );
		add_image_size( 'narasix_lg_1_1', 1024, 1024, true );
		add_image_size( 'narasix_lg_16_9', 1024, 576, true );

		add_image_size( 'narasix_md', 900, 9999, false );
		add_image_size( 'narasix_md_1_1', 900, 900, false );
		add_image_size( 'narasix_md_4_3', 900, 675, true );

		add_image_size( 'narasix_sm', 600, 9999, false );
		add_image_size( 'narasix_sm_4_5', 600, 750, true );
		add_image_size( 'narasix_sm_1_1', 600, 600, true );
		add_image_size( 'narasix_sm_4_3', 600, 450, true );

		add_image_size( 'narasix_xs_4_5', 300, 375, true );

		add_image_size( 'narasix_xxs_1_1', 150, 150, true );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
				'navigation-widgets',
			)
		);

		/*
		 * Enable support for Post Formats.
		 *
		 * See: https://codex.wordpress.org/Post_Formats
		 */
		add_theme_support( 'post-formats', array(
			'audio',
			'gallery',
			'image',
			'video',
		) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		// Add support for Block Styles.
		add_theme_support( 'wp-block-styles' );

		// Add support for full and wide align images.
		add_theme_support( 'align-wide' );

		// Add support for responsive embedded content.
		add_theme_support( 'responsive-embeds' );

		// Add support for editor styles.
		add_theme_support( 'editor-styles' );
	}
	add_action( 'after_setup_theme', 'narasix_setup' );
}

/**
 * Register navigation menus uses wp_nav_menu.
 */
if ( !function_exists( 'narasix_menus' ) ) {
	function narasix_menus() {
		$locations = array(
			'site-header'  	=> esc_html__( 'Site Header', 'narasix' ),
			'offcanvas'   			=> esc_html__( 'Off Canvas', 'narasix' ),
			'footer'   			=> esc_html__( 'Footer', 'narasix' ),
		);

		register_nav_menus( $locations );
	}
	add_action( 'init', 'narasix_menus' );
}

/**
 * Include a skip to content link at the top of the page so that users can bypass the menu.
 */
if ( !function_exists( 'narasix_skip_link' ) ) {
	function narasix_skip_link() {
		echo '<a class="skip-link sr-only" href="#site-content">' . esc_html__( 'Skip to the content', 'narasix' ) . '</a>';
	}
	add_action( 'wp_body_open', 'narasix_skip_link', 5 );
}

/**
 * Register widget areas.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
if ( !function_exists( 'narasix_sidebar_registration' ) ) {
	function narasix_sidebar_registration() {

		// Arguments used in all register_sidebar() calls.
		$shared_args = array(
			'before_title'  => '<h2>',
			'after_title'   => '</h2>',
			'before_widget' => '<div id="%1$s" class="widget titles %2$s">',
			'after_widget'  => '</div>',
		);

		register_sidebar(
			array_merge(
				$shared_args,
				array(
					'name'          => esc_html__( 'Default Sidebar', 'narasix' ),
					'id'          => 'nsix-default',
					'description'   => esc_html__( 'Add widgets here to display them in your sidebar on blog posts and archive pages.', 'narasix' ),
				)
			)
		);

		register_sidebar(
			array_merge(
				$shared_args,
				array(
					'name'          => esc_html__( 'Single Post Sidebar', 'narasix' ),
					'id'          => 'nsix-single',
					'description'   => esc_html__( 'Add widgets here to display them in your single post.', 'narasix' ),
				)
			)
		);

		register_sidebar(
			array_merge(
				$shared_args,
				array(
					'name'          => esc_html__( 'Sinngle Page Sidebar', 'narasix' ),
					'id'          => 'nsix-page',
					'description'   => esc_html__( 'Add widgets here to display them in your pages.', 'narasix' ),
				)
			)
		);

		register_sidebar(
			array_merge(
				$shared_args,
				array(
					'name'          => esc_html__( 'Custom Sidebar', 'narasix' ),
					'id'          => 'nsix-custom',
					'description'   => esc_html__( 'Add widgets here to display them in your pages.', 'narasix' ),
				)
			)
		);

		register_sidebar(
			array_merge(
				$shared_args,
				array(
					'name'        => esc_html__( 'Footer 1', 'narasix' ),
					'id'          => 'nsix-footer-1',
					'description' => esc_html__( 'Add widgets here to display them in site footer.', 'narasix' ),
				)
			)
		);

		register_sidebar(
			array_merge(
				$shared_args,
				array(
					'name'        => esc_html__( 'Footer 2', 'narasix' ),
					'id'          => 'nsix-footer-2',
					'description' => esc_html__( 'Add widgets here to display them in site footer.', 'narasix' ),
				)
			)
		);

		register_sidebar(
			array_merge(
				$shared_args,
				array(
					'name'        => esc_html__( 'Footer 3', 'narasix' ),
					'id'          => 'nsix-footer-3',
					'description' => esc_html__( 'Add widgets here to display them in site footer.', 'narasix' ),
				)
			)
		);

		register_sidebar(
			array_merge(
				$shared_args,
				array(
					'name'        => esc_html__( 'Footer 4', 'narasix' ),
					'id'          => 'nsix-footer-4',
					'description' => esc_html__( 'Add widgets here to display them in site footer.', 'narasix' ),
				)
			)
		);
	}
	add_action( 'widgets_init', 'narasix_sidebar_registration' );
}

/**
 * Enqueue scripts and styles.
 */
if ( !function_exists( 'narasix_scripts' ) ) {
	function narasix_scripts() {
    $theme_version = wp_get_theme()->get( 'Version' );

		// Theme stylesheet.
		wp_enqueue_style( 'narasix', get_template_directory_uri() . '/style.css', array(), $theme_version );

		// Tailwind stylesheet.
		wp_enqueue_style( 'tailwind', get_template_directory_uri() . '/vendors/tailwind/tailwind.css', array(), '4.5.3' );

		// Swiper stylesheet.
		wp_enqueue_style( 'swiper', get_template_directory_uri() . '/vendors/swiper/swiper-bundle.min.css', array(), '6.5.9' );

		// Swiper scripts.
		wp_enqueue_script( 'swiper', get_template_directory_uri() . '/vendors/swiper/swiper-bundle.min.js', array('jquery'), '6.5.9', true );

		// Slick stylesheet.
		wp_enqueue_style( 'slick', get_template_directory_uri() . '/vendors/slick/slick.css', array(), '1.8.0' );

		// Slick scripts.
		wp_enqueue_script( 'slick', get_template_directory_uri() . '/vendors/slick/slick.min.js', array('jquery'), '1.8.0', true );

		if ( is_single() ) {
		
			// PhotoSwipe stylesheet.
			wp_enqueue_style( 'photoswipe', get_template_directory_uri() . '/vendors/photoswipe/photoswipe.css', array(), '4.1.3' );
			wp_enqueue_style( 'photoswipe-skin', get_template_directory_uri() . '/vendors/photoswipe/default-skin/default-skin.css', array(), '4.1.3' );

			// PhotoSwipe scripts.
			wp_enqueue_script( 'photoswipe', get_template_directory_uri() . '/vendors/photoswipe/photoswipe.js', array(), '4.1.3', true );
			wp_enqueue_script( 'photoswipe-ui', get_template_directory_uri() . '/vendors/photoswipe/photoswipe-ui-default.min.js', array(), '4.1.3', true );
		
			wp_enqueue_script( 'jquery-validate', get_template_directory_uri() . '/vendors/jquery-validate/jquery.validate.min.js', array('jquery'), $theme_version, true );
		}

		// Theia sticky sidebar scripts.
		wp_enqueue_script( 'theia-sticky-sidebar', get_template_directory_uri() . '/vendors/theia-sticky-sidebar/theia-sticky-sidebar.min.js', array('jquery'), '1.7.0', true );

		// Theme scripts.
		wp_enqueue_script( 'nsix-narasix', get_template_directory_uri() . '/assets/js/narasix-scripts.js', array('jquery'), $theme_version, true );

		// Comment reply scripts.
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
	}
	add_action( 'wp_enqueue_scripts', 'narasix_scripts' );
}

/**
 * Enqueue block editor styles.
 */
if ( !function_exists( 'narasix_block_editor_styles' ) ) {
	function narasix_block_editor_styles() {
		wp_enqueue_style( 'narasix-editor-style-block', get_template_directory_uri() . '/assets/css/editor-style-block.css', array(), wp_get_theme()->get( 'Version' ), 'all' );
	}
	add_action( 'enqueue_block_editor_assets', 'narasix_block_editor_styles', 1, 1 );
}

/**
 * Enqueue classic editor styles.
 */
if ( !function_exists( 'narasix_classic_editor_styles' ) ) {
	function narasix_classic_editor_styles() {
		if ( !is_gutenberg_active() ) {
			// Enqueue editor styles.
			add_editor_style( 'assets/css/editor-style-classic.css' );
		}
	}
	add_action( 'init', 'narasix_classic_editor_styles' );
}

/**
 * Enqueue admin styles.
 */
if ( !function_exists( 'narasix_admin_styles' ) ) {
	function narasix_admin_styles() {
		wp_enqueue_style( 'narasix-editor-style-block', get_template_directory_uri() . '/assets/css/admin.css', array(), wp_get_theme()->get( 'Version' ), 'all' );
	}
	add_action( 'admin_enqueue_scripts', 'narasix_admin_styles' );
}

/**
 * Register theme's frontend variable
 */
if ( !function_exists( 'narasix_frontend_variable' ) ) {
	function narasix_frontend_variable() {
		$ajaxloadpost = array(
			'failText' => esc_html__( 'Error loading posts', 'narasix' ),
			'loadingText' => esc_html__( 'Loading', 'narasix' ),
			'noMoreText' => esc_html__( 'There are no posts left', 'narasix' ),
			'loadMoreText' => esc_html__( 'Load more', 'narasix' ),
		);

		$sticky_header = narasix_get_option( 'sticky_header', 'yes' );
		$sticky_sidebar = narasix_get_option( 'sticky_sidebar', 'yes' );
		$sticky_sidebar_margin_top = 20;

		if ( is_admin_bar_showing() ) {
			$sticky_sidebar_margin_top += 32;
		}

		if ( $sticky_sidebar === 'yes' ) {
			$sticky_sidebar_margin_top += 64;
		}

		$narasix_var = array(
			'ajaxURL' => admin_url( 'admin-ajax.php' ),
			'ajaxLoadPost' => $ajaxloadpost,
			'stickyHeader' => $sticky_header,
			'stickySidebar' => $sticky_sidebar,
			'stickySidebarMarginTop' => $sticky_sidebar_margin_top,
		);

		wp_localize_script( 'nsix-narasix', 'narasixVar', $narasix_var );
	}
	add_action( 'wp_enqueue_scripts', 'narasix_frontend_variable' );
}

/**
 * Include the TGM plugin activation configuration file.
 */
if ( !function_exists( 'narasix_tgmpa_plugin_implement' ) ) {
	function narasix_tgmpa_plugin_implement() {
		if ( file_exists( get_template_directory() . '/inc/tgmpa-configs.php' ) ) {
		    require_once get_template_directory() . '/inc/tgmpa-configs.php';
		}
	}
	add_action( 'after_setup_theme', 'narasix_tgmpa_plugin_implement' );
}

/**
 * Include custom comment helper.
 */
require_once get_template_directory() . '/inc/comments-helper.php';
 

/**
 * Include the One Click Demo Import plugin configuration file.
 */
if ( class_exists( 'OCDI_Plugin' ) && file_exists( get_template_directory() . '/inc/ocdi-configs.php' ) ) {
	require_once get_template_directory() . '/inc/ocdi-configs.php';
}

/**
 * Include the advanced custom fields plugin configuration file.
 */
require get_template_directory() . '/inc/theme-custom-acf.php';

/**
 * Implement Theme Options panel.
 */
if ( !function_exists( 'narasix_customizer' ) ) {
	function narasix_customizer() {
		if ( class_exists( 'Kirki' ) && file_exists( get_template_directory() . '/inc/theme-customizer.php' ) ) {
			require_once get_template_directory() . '/inc/theme-customizer.php';
		}
	}
	add_action( 'after_setup_theme', 'narasix_customizer' );
}

/**
 * Remove WordPress' inine styling of editor-style.css.
 */
if ( ! function_exists( 'narasix_remove_inline_editor_style' ) ) {
	function narasix_remove_inline_editor_style( $editor_settings ) {
		unset( $editor_settings['styles'][0] );
		return $editor_settings;
	}
}

/**
 * Add inline CSS in backend.
 */
if ( ! function_exists( 'narasix_editor_style' ) ) {
	function narasix_editor_style( $hook ) {

		if ( $hook === 'post-new.php' || $hook === 'post.php' ) {
			$inline_css = '';

			// Get options.
    		$body_typography = narasix_get_option( 'body_typography', [ 'font-family' => '', 'font-weight' => '' ] );
	    	$heading_typography = narasix_get_option( 'heading_typography', [ 'font-family' => '', 'font-weight' => '' ] );
	    	$post_body_typography = narasix_get_option( 'post_body_typography', [ 'font-family' => '', 'font-size' => '18px', 'line-height' => '1.7' ] );
	    	$post_body_typography_mobile = narasix_get_option( 'post_body_typography_mobile', [ 'font-size' => '16px', 'line-height' => '1.6' ] );
	    	$meta_typography = narasix_get_option( 'meta_typography', [ 'font-family' => '' ] );
		}
	}
	add_action( 'admin_enqueue_scripts', 'narasix_editor_style' );
}

/**
 * Generate inline CSS for background image.
 */
if ( !function_exists( 'narasix_css_background_img' ) ) {
	function narasix_css_background_img( $thumb_size = '' ) {
		$thumb_url = '';
		if ( has_post_thumbnail() ) {
			$thumb_id = get_post_thumbnail_id();
			$thumb_url_array = wp_get_attachment_image_src( $thumb_id, $thumb_size, true );
			$thumb_url = $thumb_url_array[0];
		}
		return ' style="background-image: url(' . esc_url( $thumb_url ) . ');"';
	}
}

/**
 * Create query args for featured block.
 */
if ( ! function_exists( 'narasix_featured_query_args' ) ) {
	function narasix_featured_query_args() {
		$args = array();
		$posts_per_page = 1;
		if ( current_user_can( 'read_private_posts' ) ) {
			$post_status = array( 'publish', 'private' );
		} else {
			$post_status = 'publish';
		}

		// create args base on method
		$args = array(
			'post_status' => $post_status,
			'posts_per_page'      => $posts_per_page,
			'ignore_sticky_posts' => 1,
			'orderby'   => 'date',
		);

		return $args;
	}
}

/**
 * Custom post excerpt words limit, must be used inside loop.
 */
if ( !function_exists( 'narasix_excerpt' ) ) {
	function narasix_excerpt( $limit = 20, $echo = true ) {
		if ( $echo ) {
			echo wp_trim_words( get_the_excerpt(), $limit );
		} else {
			return wp_trim_words( get_the_excerpt(), $limit );
		}
	}
}

/**
 * Display post featured image.
 */
if ( !function_exists( 'narasix_featured_img' ) ){
	function narasix_featured_img( $args ) {
			$thumbnail_default_switch = narasix_get_option( 'thumbnail_default_switch', 'yes' );
			$default_image = get_template_directory_uri().'/assets/placeholder.png';
			extract( $args );
			// Setting default values if variables not set.
			( isset( $size ) ) || $size = 'narasix_medium';
			( isset( $barebone ) ) || $barebone = false;
			( isset( $class ) ) || $class = '';
			( isset( $link ) ) || $link = true;
			( isset( $icon ) ) || $icon = 'no';
			( isset( $lazyload ) ) || $lazyload = true;

			if ( $lazyload ) {
					$lazyload = 'eager';
			}

			$attr = array(
					'loading' => $lazyload,
			);

			if ( ! has_post_thumbnail() ) {
					if ( $thumbnail_default_switch === 'yes' ) {
						echo '<img src="' . $default_image . '" class="size-narasix_sm_4_3 wp-post-image !rounded-lg w-full !h-full object-cover" alt="Default Image">';
					}
			}
			else{
					if ( has_post_thumbnail() ) {
							if ( !$barebone ) {
									$post_link = get_permalink();
									$post_format = get_post_format();

									if ( ( $icon === 'yes' ) && ( $post_format !== '' ) ) {
											$class .= ' post-image-has-format-icon';
									}

									if ( $class !== '' ) {
											echo '<div class="' . esc_attr( $class ) . '">';
									}
											the_post_thumbnail( $size, $attr );

											if ( $icon === 'yes' ) {
													narasix_post_format_icon();
											}

											if ( $link ) {
													echo '<a href="' . esc_url( $post_link ) . '" class="absolute bottom-0 top-0 right-0 left-0"></a>';
											}
									if ( $class !== '' ) {
											echo '</div>';
									}
							} else {
									the_post_thumbnail( $size, $attr );
									if ( $icon === 'yes' ) {
											narasix_post_format_icon();
									}
							}
					}
			}
	}
}


/**
 * Return image's width to height aspect ratio.
 */
if ( !function_exists( 'narasix_img_aspect_ratio' ) ) {
	function narasix_img_aspect_ratio( $thumb_id = NULL, $thumb_size = '' ) {
		if ( $thumb_id === NULL ) {
			$thumb_id = get_post_thumbnail_id();
		}
		$image_data = wp_get_attachment_image_src( $thumb_id , $thumb_size );
		return ( $image_data[2] !== 0 ) ? $image_data[1] / $image_data[2] : 0;
	}
}

/**
 * Display post format icon
 */
if ( !function_exists( 'narasix_post_format_icon' ) ) {
	function narasix_post_format_icon() {
		$format = get_post_format();
		switch ( $format ) {
			case 'audio':
				echo '<div class="post-format-icon post-format-icon-audio">' . narasix_svg_icon( array( 'icon' => 'microphone', 'class' => 'icons-md', 'echo' => false ) ) . '</div>';
				break;

			case 'gallery':
				echo '<div class="post-format-icon post-format-icon-gallery">' . narasix_svg_icon( array( 'icon' => 'filter', 'class' => 'icons-md', 'echo' => false ) ) . '</div>';
				break;

			case 'image':
				echo '<div class="post-format-icon post-format-icon-image">' . narasix_svg_icon( array( 'icon' => 'image', 'class' => 'icons-md', 'echo' => false ) ) . '</div>';
				break;

			case 'video':
				echo '<div class="post-format-icon post-format-icon-video">' . narasix_svg_icon( array( 'icon' => 'play', 'class' => 'icons-md', 'echo' => false ) ) . '</div>';
				break;
		}
	}
}

/**
 * Display SVG icon
 */
if ( !function_exists( 'narasix_svg_icon' ) ) {
	function narasix_svg_icon( $args ) {
		extract( $args );
		// Setting default values if variables not set.
		( isset( $icon ) ) || $icon = '';
		( isset( $id ) ) || $id = '';
		( isset( $class ) ) || $class = '';
		$output ='';
		ob_start();

		if ( $class ) { ?>
			<span class="icons <?php echo esc_attr( $class ); ?>" aria-hidden="true" > <?php
		} elseif ( $id ) { ?>
			<span id="<?php echo esc_attr( $id ); ?>" class="icons" aria-hidden="true" > <?php
		} else { ?>
			<span class="icons" aria-hidden="true"><?php
		} 
		include( get_template_directory() . '/assets/svg-icons/' . $icon . '.svg' ); ?></span><?php



		$output = ob_get_clean();
		return $output;
	}
}

/**
 * Display date time in human readable format.
 */
if ( !function_exists( 'narasix_human_datetime' ) ) {
	function narasix_human_datetime( $day_limit = 7 ) {
		$post_time = get_the_time( 'U' );
		$human_time = '';
		$time_now = date( 'U' );

		if ( $post_time > $time_now - ( 60 * 60 * 24 * $day_limit ) ) {
			$human_time = sprintf( esc_html__( '%s ago', 'narasix'), human_time_diff( $post_time, current_time( 'timestamp' ) ) );
		} else {
			$human_time = get_the_date();
		}

		return esc_html( $human_time );
	}
}

/**
 * Display updated date time in human readable format.
 */
if ( !function_exists( 'narasix_human_modified_datetime' ) ) {
	function narasix_human_modified_datetime( $day_limit = 7 ) {
		$post_time = get_the_modified_time( 'U' );
		$human_time = '';
		$time_now = date( 'U' );

		if ( $post_time > $time_now - ( 60 * 60 * 24 * $day_limit ) ) {
			$human_time = esc_html__( 'Updated', 'narasix' ) . ' ' . sprintf( esc_html__( '%s ago', 'narasix'), human_time_diff( $post_time, current_time( 'timestamp' ) ) );
		} else {
			$human_time = esc_html__( 'Updated on', 'narasix' ) . ' ' . get_the_modified_date();
		}

		return esc_html( $human_time );
	}
}

/**
 * Display post meta
 */
if ( !function_exists( 'narasix_post_meta' ) ) {
	function narasix_post_meta( $args = array() ) {
		// Default values
		$args = wp_parse_args( $args, array(
			'meta_author' => 'yes',
			'meta_categories' => 'yes',
			'meta_date' => 'yes',
		) );

		if ( $args['meta_author'] === 'yes' ) {
			echo '<span class="author flex items-center space-x-1.5 capitalize whitespace-nowrap">' . narasix_svg_icon( array( 'icon' => 'user', 'class' => 'icons-sm -mt-[2px]' ) ) . get_the_author_posts_link() . '</span>';
		}
		
		if ( $args['meta_categories'] === 'yes' ) { 
			narasix_post_categories();
		}

		if ( $args['meta_date'] === 'yes' ) {
			$post_time_attr = get_the_time( 'c' );
			$post_time = get_the_time( get_option( 'date_format' ) );
			echo '<span class="flex items-center space-x-1.5 whitespace-nowrap" >' . narasix_svg_icon( array( 'icon' => 'clock', 'class' => 'icons-sm' ) ) . ' <time class="published" datetime="' . esc_attr( $post_time_attr ) . '"  title="' . esc_attr( $post_time ) . '">' . narasix_human_datetime() . '</time></span>';
		}
	}
}


/**
 * Display post categories
 */
if ( !function_exists('narasix_post_categories') ) {
	function narasix_post_categories( $post_id = NULL ) {
		$categories = get_the_category( $post_id );

		if ( !empty($categories) ) {
      $categories = array_slice( $categories, 0, 1 );
      foreach ( $categories as $category ) {
        $color = narasix_get_meta_box('category_color', 'category_' . $category->term_id);
        $color_styles = $color ? 'style="color: ' . $color . '"' : '';
        ?>
				<span class="font-meta space-x-1.5 content-category whitespace-nowrap" <?php echo wp_kses($color_styles, array('style' => array())); ?>>
					<a class="post-category space-x-0.5 text-[14px]" 
						href="<?php echo esc_url( get_category_link( $category->term_id ) ); ?>" 
						title="<?php echo esc_attr( sprintf( esc_html__( 'View all posts in %s', 'narasix' ), $category->name ) ) ?>" 
						rel="tag" >
						<?php echo esc_html( $category->name ); ?>
					</a>
				</span>
        <?php
      }
    }
	}
}

/**
 * Display post categories with background
 */
if ( !function_exists('narasix_post_categories_with_background') ) {
	function narasix_post_categories_with_background( $post_id = NULL ) {
		$categories = get_the_category( $post_id );

		if ( !empty($categories) ) {
      $categories = array_slice( $categories, 0, 1 );
      foreach ( $categories as $category ) {
        $color = narasix_get_meta_box('category_color', 'category_' . $category->term_id);
        $color_styles = $color ? 'style="background: ' . $color . ';border-radius: 13px;padding: 0px 10px 1px 10px;color: #fff; "' : '';
        ?>
				<span class="post-category font-meta space-x-1.5 content-category whitespace-nowrap" <?php echo wp_kses($color_styles, array('style' => array())); ?>>
					<a class="space-x-0.5 text-[14px]" 
						href="<?php echo esc_url( get_category_link( $category->term_id ) ); ?>" 
						title="<?php echo esc_attr( sprintf( esc_html__( 'View all posts in %s', 'narasix' ), $category->name ) ) ?>" 
						rel="tag" >
						<?php echo esc_html( $category->name ); ?>
					</a>
				</span>
        <?php
      }
    }
	}
}

/**
 * Display post single categories
 */
if ( !function_exists('narasix_post_categories_single') ) {
	function narasix_post_categories_single( $post_id = NULL ) {
		$categories = get_the_category( $post_id );
		
		if ( $categories ) {
			$categories = array_slice( $categories, 0, 3 ); // Display maximum 3 categories.
			?>
			<ul class="inline-flex list-none">
			<?php foreach ( $categories as $category ) { ?>
				<li class="list-category">
					<a class="hover:underline whitespace-nowrap" href="<?php echo esc_url( get_category_link( $category->term_id ) ); ?>" title="<?php echo esc_attr( sprintf( esc_html__( 'View all posts in %s', 'narasix' ), $category->name ) ) ?>" rel="tag">
						<?php echo esc_html( $category->name ); ?>
					</a>
				</li>
			<?php } ?>
			</ul>
			<?php
		}
	}
}

/**
 * Display post categories with posts count
 */
if ( !function_exists( 'narasix_post_categories_with_count' ) ) {
	function narasix_post_categories_with_count( $post_id = NULL ) {
		$categories = get_the_category( $post_id );
		if ( $categories ) {
			$number_category = count( $categories );
			$i = 0;
			?>
			<ul class="inline-flex meta-scroll flex-nowrap overflow-x-auto space-x-4 list-none py-3">
			<?php
			foreach ( $categories as $category ) {
			?>
				<li>
					<a class="st-link post-category font-meta text-xs whitespace-nowrap" href="<?php echo esc_url( get_category_link( $category->term_id ) ); ?>" title="<?php echo esc_attr( sprintf( esc_html__( 'View all posts in %s', 'narasix' ), $category->name ) ) ?>" rel="tag"><?php echo esc_html( $category->name ); ?><?php
					if ( $category->count !== 0 ) {
						echo '<sup>' . esc_html( $category->count ) . '</sup>';
					}
					?></a>
				</li>
			<?php
			}
			?>
			</ul>
			<?php
		}
	}
}

/**
 * Display post tags
 */
if ( !function_exists( 'narasix_post_tags' ) ) {
	function narasix_post_tags( $post_id = NULL ) {
		$tags = get_the_tags( $post_id );
		if ( $tags ) {
			?>
			<ul class="inline-flex meta-scroll flex-nowrap overflow-x-auto space-x-4 list-none py-3">
			<?php
			foreach ( $tags as $tag ) {
			?>
				<li>
					<a class="font-meta inline-block text-sm py-1 px-4 border rounded-lg whitespace-nowrap" href="<?php echo esc_url( get_tag_link( $tag->term_id ) ); ?>" title="<?php echo esc_attr( sprintf( esc_html__( 'View all posts in %s', 'narasix' ), $tag->name ) ) ?>" rel="tag"><?php echo esc_html( $tag->name ); ?></a>
				</li>
			<?php
			}
			?>
			</ul>
			<?php
		}
	}
}

/**
 * Display Post Listing
 */
if ( !function_exists( 'narasix_get_post_listing_args' ) ) {
	function narasix_get_post_listing_args() {
		// Check what archive page current page is.
		if ( is_search() ) {
			$prefix = 'search_';
		} elseif ( is_category() ) {
			$prefix = 'category_';
		} elseif ( is_tag() ) {
			$prefix = 'tag_';
		} elseif ( is_author() ) {
			$prefix = 'author_';
		} else {
			$prefix = 'blog_';
		}

		// Get theme options.
		$post_listing_args = array(
			'ignore_sticky_posts' 		=> 'no',
			'post_layout' 						=> narasix_get_option( $prefix . 'layout', 'list-landscape' ),
			'post_format_icon' 				=> narasix_get_option( $prefix . 'post_format_icon_toggle', 'yes' ),
			'hero_post_first' 				=> narasix_get_option( $prefix . 'hero_post_first', 'yes' ),
			'hero_cycle' 							=> narasix_get_option( $prefix . 'hero_cycle', 10 ),
			'grid_columns' 						=> narasix_get_option( $prefix . 'grid_columns', '1' ),
			'pagination' 							=> narasix_get_option( $prefix . 'pagination', 'ajax-load-more' ),
			'excerpt_length' 					=> NULL,
		);

		if ( narasix_get_option( $prefix . 'excerpt_length_toggle' ) === 'yes' ) {
			$post_listing_args['excerpt_length'] = narasix_get_option( $prefix . 'excerpt_length', NULL );
		}

		return $post_listing_args;
	}
}

/**
 * Post Listing.
 */
if ( !function_exists( 'narasix_post_listing' ) ) {
	function narasix_post_listing( $post_listing_args = array() ) {

		// Merge with default value.
		$post_listing_args = wp_parse_args( $post_listing_args, array(
			'post_query' => NULL,
			'query' => [
				'offset' 				 => 0,
				'posts_per_page' => get_option( 'posts_per_page' ),
			],
			'ignore_sticky_posts' => 'yes',
			'post_layout' => 'list-landscape',
			'grid_columns' => '1',
			'post_format_icon' => 'yes',
			'hero_cycle' => NULL,
			'excerpt_length' => NULL,
			'pagination' => 'default',
			'view_more_url' => '',
			'view_more_url_title' => '',
		) );

		// Setting up variables
		$section_class = 'section w-full post-listing-section post-listing-section-' . $post_listing_args['post_layout'];
		$section_wrapper_class = 'post-listing-wrapper';
		$section_content_class = 'post-listing-content';
		if ( $post_listing_args['pagination'] === 'ajax-load-more' ) {
			$section_wrapper_class .= ' js-nsix-ajax-load-more';
			$section_content_class .= ' js-nsix-ajax-content';
		}
		
		$is_mixed = false;
		$template_args = array();
		$template_args_hero = array();

		$template_args['post_format_icon'] = $post_listing_args['post_format_icon'];
		$template_args['excerpt_length'] = $post_listing_args['excerpt_length'];

		switch ( $post_listing_args['post_layout'] ) {
		    case 'list-landscape':
						$section_content_class .= ' space-y-4 sm:space-y-6';
		        $post_item_wrapper_class = 'list-lands-sidebar';
		        $post_template = 'landscape';
		        break;

		    case 'list-landscape-no-sidebar':
						$section_content_class .= ' space-y-4 sm:space-y-6';
		        $post_item_wrapper_class = 'list-lands-nosidebar';
		        $post_template = 'landscape-large';
		        break;

				case 'mixed-a':
						$section_content_class .= ' space-y-4 sm:space-y-6';
						$post_item_wrapper_class = 'list-lands-sidebar';
						$post_item_hero_wrapper_class = 'grid-item col-sm-12';
						$post_template = 'landscape';
						$post_hero_template = 'landscape-auto';
						$is_mixed = true;
						break;

				case 'mixed-b':
						$section_content_class .= ' space-y-4 sm:space-y-6';
						$post_item_wrapper_class = 'list-lands-sidebar';
						$post_item_hero_wrapper_class = 'grid-item col-sm-12';
						$post_template = 'landscape';
						$post_hero_template = 'cover';
						$is_mixed = true;
						break;

				case 'grid-portrait':
		    	
						if ( $post_listing_args['grid_columns'] === '1' ) {
								
								$section_content_class .= ' grid grid-cols-1 sm:grid-cols-2 gap-4 md:gap-5';
								$post_item_wrapper_class = 'grid-port-sidebar col-m';
								$post_template = 'portrait';
						} else {
								$section_content_class .= ' grid grid-cols-2 sm:grid-cols-2 gap-4 md:gap-5';
								$post_item_wrapper_class = 'grid-port-sidebar col-span-1';
								$post_template = 'portrait';
						}
						break;

		    case 'grid-portrait-no-sidebar':
		    	
		        if ( $post_listing_args['grid_columns'] === '1' ) {
							$section_content_class .= ' grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 md:gap-5';
							$post_item_wrapper_class = 'grid-port-nosidebar col-m';
							$post_template = 'portrait';
							
		        } else {
								$section_content_class .= ' grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 md:gap-5';
		            $post_item_wrapper_class = 'grid-port-nosidebar col-span-1';
		            $post_template = 'portrait';
		        }
		        break;

		    case 'masonry-portrait':
		    		$section_content_class .= ' masonry-container';
		        $post_item_wrapper_class = 'masonry-item';
						$template_args['thumb_size'] = 'narasix_md';
		        $post_template = 'portrait-auto';
		        break;
		}

		// Setting up query.
		if ( !$post_listing_args['post_query'] ) {
			$post_query = $GLOBALS['wp_query'];

			// Get current page.
			if ( get_query_var( 'paged' ) ) {
			    $paged = get_query_var( 'paged' );
			} elseif ( get_query_var( 'page' ) ) {
			    $paged = get_query_var( 'page' );
			} else {
			    $paged = 1;
			}
		} else {
			$post_query = $post_listing_args['post_query'];

			// Get current page.
			$paged = max( 1, $post_query->query_vars['paged'] );
		}

		$max_pages = $post_query->max_num_pages;
		$query_string = http_build_query( $post_query->query ); // Create query string for AJAX load post.

		$section_wrapper_attrs = array();
		$section_wrapper_attrs['layout'] = $post_listing_args['post_layout'];
		$section_wrapper_attrs['query'] = $query_string;
		$section_wrapper_attrs['current-page'] = $paged;
		$section_wrapper_attrs['max-pages'] = $max_pages;
		$section_wrapper_attrs['posts-per-page'] = $post_listing_args['query']['posts_per_page'];
		$section_wrapper_attrs['offset'] = $post_listing_args['query']['offset'];
		$section_wrapper_attrs['ignore-sticky-posts'] = $post_listing_args['ignore_sticky_posts'];
		$section_wrapper_attrs['post-template'] = $post_template;
		$section_wrapper_attrs['post-format-icon'] = $post_listing_args['post_format_icon'];

		if ( $is_mixed ) {
			$section_wrapper_attrs['hero-post-templat'] = $post_hero_template;
			$section_wrapper_attrs['hero-cycle'] = $post_listing_args['hero_cycle'];
			$section_wrapper_attrs['hero-post-first'] = $post_listing_args['hero_post_first'];
		}
		
		if ( $post_listing_args['excerpt_length'] !== NULL ) {
			$section_wrapper_attrs['excerpt-length'] = $post_listing_args['excerpt_length'];
		}

		?>
			<div class="<?php echo esc_attr( $section_wrapper_class ); ?>"<?php
				foreach ( $section_wrapper_attrs as $data_attr => $value ) {
					echo ' data-' . esc_attr( $data_attr) . '="' . esc_attr( $value ) . '"'; } ?>>
						<div class="<?php echo esc_attr( $section_content_class ); ?>">
							<?php
								while ( $post_query->have_posts() ) {
										$post_query->the_post();

									if ( $is_mixed ) {
										if ( $post_listing_args['hero_post_first'] === 'yes' ) {
										if ( !( $post_query->current_post % $post_listing_args['hero_cycle'] ) ) {

											echo '<div class="' . esc_attr( $post_item_hero_wrapper_class ) . '">';
											if ( ( $post_hero_template === 'landscape-auto' ) && !has_post_thumbnail() ) {
												narasix_get_template_part( 'template-parts/content/content-landscape-auto', NULL, $template_args_hero );
											} else {
												narasix_get_template_part( 'template-parts/content/content-' . $post_hero_template, NULL, $template_args_hero );
											}
												echo '</div>';
										} else {
												echo '<div class="' . esc_attr( $post_item_wrapper_class ) . '">';
												narasix_get_template_part( 'template-parts/content/content-' . $post_template, NULL, $template_args );
												echo '</div>';
										}
									} 
								} else {
									echo '<div class="' . esc_attr( $post_item_wrapper_class ) . '">';
										narasix_get_template_part( 'template-parts/content/content-' . $post_template, NULL, $template_args );
									echo '</div>';
								}
             	} 
						 ?>
            </div>

            <?php
            // Reset postdata
            wp_reset_postdata();
            ?>

					<?php
					if ( $post_listing_args['pagination'] !== 'none' ) {
					?>
							<div class="post-listing-pagination mt-6 mb-2">
							<?php
							if ( $post_listing_args['pagination'] !== 'view-more-url' ) {
									narasix_pagination( array(
										'type' => $post_listing_args['pagination'],
										'max_pages' => $max_pages,
									) );
							} elseif ( $post_listing_args['view_more_url'] || $post_listing_args['view_more_url_title'] ) {
							?>
									<div class="text-center">
											<a class="py-3 px-4 bg-slate-400 rounded-lg btn-animation view-more-btn" href="<?php echo esc_url( $post_listing_args['view_more_url']['url'] ); ?>"<?php if ( $post_listing_args['view_more_url']['is_external'] ) { echo ' target="_blank"'; } ?> rel="noopener noreferrer<?php if ( $post_listing_args['view_more_url']['nofollow'] ) { echo ' nofollow'; } ?>"><span><?php
													echo esc_html( $post_listing_args['view_more_url_title'] );
													?></span><?php
													echo narasix_svg_icon( array( 'icon' => 'arrow-right', 'class' => 'icons-last' ) );
											?></a>
									</div>
							<?php
							}
							?>
							</div>
					<?php
					}
					?>
			</div>
    <?php
	}
}

/**
 * AJAX function to load posts
 */
if ( !function_exists( 'narasix_ajax_load_post' ) ){
	function narasix_ajax_load_post() {
		$query_args = isset( $_POST['query'] ) ? $_POST['query'] : ''; // Query string.
		$ignore_sticky_posts = isset( $_POST['ignoreStickyPosts'] ) ? $_POST['ignoreStickyPosts'] : 'yes';
		$posts_per_page = isset( $_POST['postsPerPage'] ) ? $_POST['postsPerPage'] : get_option( 'posts_per_page' );
		$current_page = isset( $_POST['currentPage'] ) ? $_POST['currentPage'] : 1;
		// $layout = isset( $_POST['layout'] ) ? $_POST['layout'] : 'list-portrait';
		$columns = isset( $_POST['columns'] ) ? $_POST['columns'] : '3';
		$post_template = isset( $_POST['postTemplate'] ) ? $_POST['postTemplate'] : NULL;
		$excerpt_length = isset( $_POST['excerptLength'] ) ? $_POST['excerptLength'] : NULL;
		$excerpt_length_hero = isset( $_POST['excerptLengthHero'] ) ? $_POST['excerptLengthHero'] : NULL;

		if ( $excerpt_length === '' ) {
			$excerpt_length = NULL;
		}
		if ( $excerpt_length_hero === '' ) {
			$excerpt_length_hero = NULL;
		}

		$is_mixed = false;
		$template_args = array();
		$template_args_hero = array();

		$template_args['post_format_icon'] = $post_format_icon;
		$template_args['excerpt_length'] = $excerpt_length;
		$template_args_hero['excerpt_length'] = $excerpt_length_hero;
		$template_args['lazyload'] = false;

		switch ( $layout ) {
			case 'list-landscape':
				$section_content_class .= ' space-y-4 sm:space-y-6';
				$post_item_wrapper_class = 'list-lands-sidebar';
				$post_template = 'landscape';
				break;

			case 'list-landscape-no-sidebar':
					$section_content_class .= ' space-y-4 sm:space-y-6';
					$post_item_wrapper_class = 'list-lands-nosidebar';
					$post_template = 'landscape-large';
					break;

			case 'grid-portrait':
				
					if ( $post_listing_args['grid_columns'] === '1' ) {
							
							$section_content_class .= ' grid grid-cols-1 sm:grid-cols-2 gap-4 md:gap-5';
							$post_item_wrapper_class = 'grid-port-sidebar col-m';
							$post_template = 'portrait';
					} else {
							$section_content_class .= ' grid grid-cols-2 sm:grid-cols-2 gap-4 md:gap-5';
							$post_item_wrapper_class = 'grid-port-sidebar col-span-1';
							$post_template = 'portrait';
					}
					break;

			case 'grid-portrait-no-sidebar':
					if ( $post_listing_args['grid_columns'] === '1' ) {
						$section_content_class .= ' grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 md:gap-5';
						$post_item_wrapper_class = 'grid-port-nosidebar col-m';
						$post_template = 'portrait';
						
					} else {
							$section_content_class .= ' grid grid-cols-2 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 md:gap-5';
							$post_item_wrapper_class = 'grid-port-nosidebar col-span-1';
							$post_template = 'portrait';
					}
					break;

			case 'masonry-portrait':
					$section_content_class .= ' masonry-container';
					$post_item_wrapper_class = 'masonry-item';
					$template_args['thumb_size'] = 'narasix_md';
					$post_template = 'portrait-auto';
					break;
		}

		parse_str( $query_args, $query_args ); // Convert query string into array.

		if ( empty( $query_args ) || !array_key_exists( 'paged', $query_args ) ) {
			$query_args['paged'] = $current_page;
		}

		if ( !array_key_exists( 'post_status', $query_args ) ) {
			if ( is_user_logged_in() ) {
				$query_args['post_status'] = array( 'publish', 'private' );
			} else {
				$query_args['post_status'] = 'publish';
			}
		}

		$post_query = new WP_Query( $query_args );

	    if( $post_query->have_posts() ) {
	        while ( $post_query->have_posts() ) {
				$post_query->the_post();
				if ( $ignore_sticky_posts === 'yes' ) {
					$loaded_post_count = ( $current_page - 1 ) * $posts_per_page;
				} else {
					$loaded_post_count = ( $current_page - 1 ) * $posts_per_page + count( get_option( 'sticky_posts' ) );
				}
				$overall_post_index = $post_query->current_post + $loaded_post_count;

					echo '<div class="' . esc_attr( $post_item_wrapper_class ) . '">';
					narasix_get_template_part( 'template-parts/content/content-' . $post_template, NULL, $template_args );
					echo '</div>';

	      }
	    }

	    die();
	}
	add_action( 'wp_ajax_nopriv_ajax_load_post', 'narasix_ajax_load_post' );
	add_action( 'wp_ajax_ajax_load_post', 'narasix_ajax_load_post' );
}

/**
 * Display post comments number bubble.
 */
if ( !function_exists('narasix_post_comments_bubble') ) {
	function narasix_post_comments_bubble( $post_id = NULL ) {
		$link_title = '';
		$comments_number = get_comments_number( $post_id );
		$comments_link = get_comments_link( $post_id );
		if ( $comments_number != '0' ) {
			$link_title = sprintf( _nx( '%1$s comment', '%1$s comments', $comments_number, 'comments title', 'narasix' ), number_format_i18n( $comments_number ) );
		} else {
			$link_title = esc_html__('Comment', 'narasix');
		} ?>
		<a href="<?php echo esc_url( $comments_link ); ?>" title="<?php echo esc_attr( $link_title ); ?>" class="comments-number-bubble navigation-font">
			<?php echo esc_html( $comments_number ); ?>
		</a>
		<?php
	}
}

/**
 * Theme's pagination.
 */
if ( ! function_exists( 'narasix_pagination' ) ) {
	function narasix_pagination( $args = array() ) {
		// Merge with default value.
		$args = wp_parse_args( $args, array(
			'type' => 'default',
		    'max_pages' => 1,
		) );

		switch ( $args['type'] ) {
			case 'default':
			default:
				if ( $args['max_pages'] > 1 ) {
					// Get current page.
					if ( get_query_var( 'paged' ) ) {
					    $current = get_query_var( 'paged' );
					} elseif ( get_query_var( 'page' ) ) {
					    $current = get_query_var( 'page' );
					} else {
					    $current = 1;
					}

					$big = 999999999;

					$pagination = array(
						'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
	          'format' => '?paged=%#%',
						'total' => $args['max_pages'],
						'current' => $current,
						'mid_size' 	=> 1,
						'prev_text' => '<span class="sr-only">' . esc_html__( 'Previous page', 'narasix' ) . '</span><span class="nsix-pagination-circle"><svg width="48px" height="48px" viewBox="0 0 100 100"><circle class="anicircle" cx="50" cy="50" r="48"/></svg></span>' . narasix_svg_icon( array( 'icon' => 'arrow-left', 'class' => 'icons-md', 'echo' => false ) ),
				    	'next_text' => '<span class="sr-only">' . esc_html__( 'Next page', 'narasix' ) . '</span><span class="nsix-pagination-circle"><svg width="48px" height="48px" viewBox="0 0 100 100"><circle class="anicircle" cx="50" cy="50" r="48"/></svg></span>' . narasix_svg_icon( array( 'icon' => 'arrow-right', 'class' => 'icons-md', 'echo' => false ) ),
					);

					?>
					<nav class="navigation pagination nsix-pagination nsix-pagination-default">
						<div class="nav-links flex items-center justify-center<?php if ( $current == 1 ) { echo ' is-on-first-page'; } if ( $current == $args['max_pages'] ) { echo ' is-on-last-page'; } ?>">
							<?php echo paginate_links( $pagination ); ?>
						</div>
					</nav>
					<?php
				}

				break;

			case 'next-and-previous':
				if ( $args['max_pages'] > 1 ) {
					// Get current page.
					if ( get_query_var( 'paged' ) ) {
					    $current = get_query_var( 'paged' );
					} elseif ( get_query_var( 'page' ) ) {
					    $current = get_query_var( 'page' );
					} else {
					    $current = 1;
					}
					?>
					<nav class="navigation pagination nsix-pagination nsix-pagination-next-n-prev">
						<div class="nav-links flex items-center justify-center">
							<?php
							if ( get_previous_posts_link( '' ) ) {
							?>
								<a href="<?php previous_posts(); ?>" class="pagination-prev-link mr-auto"><span class="sr-only"><?php echo esc_html__( 'Newer posts', 'narasix' ); ?></span><span class="nsix-pagination-circle"><svg width="48px" height="48px" viewBox="0 0 100 100"><circle class="anicircle" cx="50" cy="50" r="48"/></svg></span><?php echo narasix_svg_icon( array( 'icon' => 'arrow-left', 'class' => 'icons-md' ) ); ?></a>
							<?php
							} else {
							?>
								<span class="pagination-prev-link mr-auto"><span class="sr-only"><?php echo esc_html__( 'Newer posts', 'narasix' ); ?></span><span class="nsix-pagination-circle"><svg width="48px" height="48px" viewBox="0 0 100 100"><circle class="anicircle" cx="50" cy="50" r="48"/></svg></span><?php echo narasix_svg_icon( array( 'icon' => 'arrow-left', 'class' => 'icons-md' ) ); ?></span>
							<?php
							}
							?>

							<div class="pagination-info">
								<?php printf( esc_html__( 'Page %1$s of %2$s', 'narasix' ), $current, $args['max_pages'] ); ?>
							</div>

							<?php
							if ( get_next_posts_link( '', $args['max_pages'] ) ) {
							?>
								<a href="<?php next_posts(); ?>" class="pagination-next-link ml-auto"><span class="sr-only"><?php echo esc_html__( 'Older posts', 'narasix' ); ?></span><span class="nsix-pagination-circle"><svg width="48px" height="48px" viewBox="0 0 100 100"><circle class="anicircle" cx="50" cy="50" r="48"/></svg></span><?php echo narasix_svg_icon( array( 'icon' => 'arrow-right', 'class' => 'icons-md' ) ); ?></a>
							<?php
							} else {
							?>
								<span class="pagination-prev-link ml-auto"><span class="sr-only"><?php echo esc_html__( 'Older posts', 'narasix' ); ?></span><span class="nsix-pagination-circle"><svg width="48px" height="48px" viewBox="0 0 100 100"><circle class="anicircle" cx="50" cy="50" r="48"/></svg></span><?php echo narasix_svg_icon( array( 'icon' => 'arrow-right', 'class' => 'icons-md' ) ); ?></span>
							<?php
							}
							?>
						</div>
					</nav>
					<?php
				}

			break;
			case 'ajax-load-more':
				echo '<div class="text-center">';
				echo '<button class="bg-white dark:bg-charcoal-700 shadow py-1.5 px-3.5 rounded load-more-btn js-ajax-load-posts-btn is-active"><span class="load-more-btn-text">'.esc_html__( 'Load more', 'narasix' ).'</span><span class="spinner-ellipsis ml-1">.</span></button>';
				echo '</div>';

			break;
		}
	}
}

/**
 * Add an option to use both next and number for paginated post's pagination.
 */
if ( ! function_exists( 'nsix_wp_link_pages_next_and_number' ) ) {
	function nsix_wp_link_pages_next_and_number( $args ){
	    if ( $args['next_or_number'] === 'next_and_number' ) {
	        global $page, $numpages, $multipage, $more, $pagenow;
	        $args['next_or_number'] = 'number';
	        $prev = '';
	        $next = '';
	        if ( $multipage ) {
	            if ( $more ) {
	                $i = $page - 1;
	                if ( $i && $more ) {
	                	$prev .= '<span class="nsix-post-pagination-prev">';
	                    $prev .= _wp_link_page( $i );
	                    $prev .=  narasix_svg_icon( array( 'icon' => 'arrow-left', 'class' => 'icons-sm', 'echo' => false ) ) . $args['link_before'] . $args['previouspagelink'] . $args['link_after'] . '</a></span>';
	                }
	                $i = $page + 1;
	                if ( $i <= $numpages && $more ) {
	                	$next .= '<span class="nsix-post-pagination-next">';
	                    $next .= _wp_link_page( $i );
	                    $next .= $args['link_before'] . $args['nextpagelink'] . $args['link_after'] . narasix_svg_icon( array( 'icon' => 'arrow-right', 'class' => 'icons-sm', 'echo' => false ) ) . '</a></span>';
	                }
	            }
	        }
	        $args['before'] = $args['before'].$prev;
	        $args['after'] = $next.$args['after'];
	    }
	    return $args;
	}
	add_filter('wp_link_pages_args','nsix_wp_link_pages_next_and_number');
}

/**
 * Enqueue the stylesheet for Customizer.
 */
if ( ! function_exists( 'narasix_customizer_styles' ) ) {
	function narasix_customizer_styles() {
		wp_register_style( 'nsix-customizer-css', get_template_directory_uri() . '/assets/css/customizer.css', NULL, NULL, 'all' );
		wp_enqueue_style( 'nsix-customizer-css' );
	}
	add_action( 'customize_controls_print_styles', 'narasix_customizer_styles' );
}

/**
 * Get sidebar list as choices for sidebar select control.
 */
if ( ! function_exists( 'narasix_sidebar_list' ) ) {
	function narasix_sidebar_list() {
	    do_action('widgets_init');
	 	$sidebars = array();
	 	if ( isset( $GLOBALS['wp_registered_sidebars'] ) ) {
	 		$sidebars = $GLOBALS['wp_registered_sidebars'];
	 	}
	 	$sidebars_choices = array();
	 	foreach ( $sidebars as $sidebar ) {
	 		$sidebars_choices[ $sidebar['id'] ] = $sidebar['name'];
	 	}
	    return $sidebars_choices;
	}
}

/**
 * Get theme option value.
 */
if ( ! function_exists( 'narasix_get_option' ) ) {
	function narasix_get_option( $opt, $default = NULL ) {
		$prefix = 'nsix_narasix_';
		return get_theme_mod( $prefix . $opt, $default );
	}
}

/**
 * Get meta box value.
 */
if ( ! function_exists( 'narasix_get_meta_box' ) ) {
	function narasix_get_meta_box( $selector, $id = NULL, $default = NULL ) {
		if ( function_exists( 'get_field' ) ) {
			$prefix = 'field_nsix_';
			if ( $id ) {
				return get_field( $prefix . $selector, $id );
			} else {
				return get_field( $prefix . $selector );
			}
		} else {
			return $default;
		}
	}
}

/**
 * Convert background array into string.
 */
if ( ! function_exists( 'narasix_background_style_convert' ) ) {
	function narasix_background_style_convert( $array = array() ) {
		extract( $array );
		$output = '';
		$output .= ( isset( $color ) && $color ) ? 'background-color:' . $color . ';' : '';
		$output .= ( isset( $color ) && $image ) ? 'background-image:url(' . $image . ');' : '';
		$output .= ( isset( $color ) && $position ) ? 'background-position:' . $position . ';' : '';
		$output .= ( isset( $color ) && $attachment ) ? 'background-attachment:' . $attachment . ';' : '';
		$output .= ( isset( $color ) && $size ) ? 'background-size:' . $size . ';' : '';
		$output .= ( isset( $color ) && $repeat ) ? 'background-repeat:' . $repeat . ';' : '';

		return $output;
	}
}

/**
 * Backwards compability for get_template_part()
 */
if ( ! function_exists( 'narasix_get_template_part' ) ) {
	function narasix_get_template_part( $slug, $name = NULL, $args = array() ) {
		// Check if current version of WordPress is later than 5.5
		if ( get_bloginfo( 'version' ) >= '5.5' ) {
			get_template_part( $slug, $name, $args );
		} else {
			set_query_var( 'args', $args );
			get_template_part( $slug, $name, $args );
			set_query_var( 'args', false );
		}
	}
}

/**
 * Lightens/darkens a given colour (hex format), returning the altered colour in hex format.7
 * @param str $hex Colour as hexadecimal (with or without hash);
 * @percent float $percent Decimal ( 0.2 = lighten by 20%(), -0.4 = darken by 40%() )
 * @return str Lightened/Darkend colour as hexadecimal (with hash);
 */

if ( !function_exists('narasix_color_luminance') ) {
	function narasix_color_luminance( $hexcolor, $percent ) {
		if ( strlen( $hexcolor ) < 6 ) {
			$hexcolor = $hexcolor[0] . $hexcolor[0] . $hexcolor[1] . $hexcolor[1] . $hexcolor[2] . $hexcolor[2];
		}
		$hexcolor = array_map( 'hexdec', str_split( str_pad( str_replace( '#', '', $hexcolor ), 6, '0' ), 2 ) );

		foreach ( $hexcolor as $i => $color ) {
			$from = $percent < 0 ? 0 : $color;
			$to = $percent < 0 ? $color : 255;
			$pvalue = ceil( ( $to - $from ) * $percent );
			$hexcolor[ $i ] = str_pad( dechex( $color + $pvalue ), 2, '0', STR_PAD_LEFT);
		}

		return '#' . implode( $hexcolor );
	}
}

/*
 * Have WPP track only 'post' post types page views, ignore the rest
 */

if ( ! function_exists( 'narasix_trackable_post_types' ) ) {
	function narasix_trackable_post_types( $post_types ) {
		return array( 'post' );
	}
}

add_filter( 'wpp_trackable_post_types', 'narasix_trackable_post_types', 10, 1 );

/*
 * Breadcrumb.
 */

if ( ! function_exists( 'narasix_breadcrumb' ) ) {
	function narasix_breadcrumb( $style = 'default' ) {
		if ( function_exists('yoast_breadcrumb') ) {
			if ( !is_home() || !is_front_page() ) {
				if ( $style === 'default' ) {
					yoast_breadcrumb();
				} else {
					yoast_breadcrumb();
				}

			}
		}
	}
}

/**
 * Table Of Content
 */

function auto_id_headings( $content ) {
	$content = preg_replace_callback( '/(\<h[2-6](.*?))\>(.*)(<\/h[2-6]>)/i', function( $matches ) {
		if ( ! stripos( $matches[0], 'id=' ) ) :
			$matches[0] = $matches[1] . $matches[2] . ' id="' . sanitize_title( $matches[3] ) . '">' . $matches[3] . $matches[4];
		endif;
		return $matches[0];
	}, $content );
    return $content;
}
add_filter( 'the_content', 'auto_id_headings' );


/**
 * Display Cookie
 */

 function custom_consent() {
	$content_layout_width = narasix_get_option( 'content_layout_width', 'default' );
	$cookie_switch = narasix_get_option( 'cookie_switch', 'yes' );
	$cookie_text = narasix_get_option( 'cookie_text', esc_html__( 'We rely on Cookies to Provide Better User Experience', 'narasix' ) );
	$cookie_more = narasix_get_option( 'cookie_more', esc_html__( 'Learn More', 'narasix' ) );
	$cookie_page = narasix_get_option( 'cookie_page', '' );

	if ($content_layout_width === 'default' ) {
		$content_class = 'max-w-7xl';
	} else {
		$content_class = 'max-w-' . $content_layout_width;
	}

	if(!isset($_COOKIE['consent_cookie'])): ?>

		<?php if ( $cookie_switch === 'yes' ) { ?>
			<div class="cookie fixed w-full bottom-0 <?php echo esc_html( $content_class ); ?> lg:left-[50%] lg:bottom-1 z-50 lg:px-16" id="consent-container">
				<div class="flex w-full items-center justify-between space-x-5 bg-slate-300 px-4 py-4 lg:rounded-lg lg:px-6">
					<p><?php echo esc_html( $cookie_text ); ?> <a class="underline" href="<?php echo esc_url( $cookie_page ); ?>" target="_blank"><?php echo esc_html( $cookie_more ); ?></a></p>
					<a id="accept-cookie" class="inline-block rounded-lg border border-indigo-600 px-2 py-1 text-indigo-600 hover:bg-indigo-600 hover:text-white active:bg-indigo-500" href="Javascript:void(0)">Agree</a>
				</div>
			</div>
		<?php } ?>

	<?php endif; ?>

		<?php if ( $cookie_switch === 'yes' ) { ?>
			<script>
			(function($){

			$('#accept-cookie').on('click', function(){

					var date = new Date();
					var expires = "";
					// this is for 1 day, 
					date.setTime(date.getTime() + (24*60*60*1000));
					expires = "; expires=" + date.toUTCString();
					
					document.cookie = "consent_cookie=true; "+expires+"; path=/";
					$('#consent-container').remove();
			});

			})(jQuery);
			</script>
		<?php } ?>
	<?php
}
add_action('wp_footer', 'custom_consent');

/**
 * Add SVG to wp_kses_post ruleset.
 */
if ( !function_exists( 'nsix_wp_kses_post' ) ) {
	function nsix_wp_kses_post( $html ) {
	    $kses_defaults = wp_kses_allowed_html( 'post' );
	    $svg_args = array(
	        'svg'   => array(
	            'class'           => true,
	            'aria-hidden'     => true,
	            'aria-labelledby' => true,
	            'role'            => true,
	            'xmlns'           => true,
	            'width'           => true,
	            'height'          => true,
	            'viewbox'         => true,
	            'fill'			  => true,
	        ),
	        'g'     => array( 'fill' => true ),
	        'title' => array( 'title' => true ),
	        'path'  => array(
	            'd'    => true,
	            'fill' => true,
	        ),
	    );
	    $allowed_tags = array_merge( $kses_defaults, $svg_args );
	    return wp_kses( $html, $allowed_tags );
	}
}

/**
 * Determine whether a hex color is light.
 *
 * @param mixed $color Color.
 * @return bool True if a light color.
 */
if ( ! function_exists( 'nsix_hex_is_light' ) ) {
	function nsix_hex_is_light( $color ) {
		$hex = str_replace( '#', '', $color );

		$c_r = hexdec( substr( $hex, 0, 2 ) );
		$c_g = hexdec( substr( $hex, 2, 2 ) );
		$c_b = hexdec( substr( $hex, 4, 2 ) );

		$brightness = ( ( $c_r * 299 ) + ( $c_g * 587 ) + ( $c_b * 114 ) ) / 1000;

		return $brightness > 155;
	}
}

/**
 * Shim for wp_body_open, ensuring backward compatibility with versions of WordPress older than 5.2.
 */
if ( ! function_exists( 'wp_body_open' ) ) {
	function wp_body_open() {
		do_action( 'wp_body_open' );
	}
}

/**
 * Check if Block Editor is active.
 * Must only be used after plugins_loaded action is fired.
 *
 * @return bool
 */
function is_gutenberg_active() {
    // Gutenberg plugin is installed and activated.
    $gutenberg = ! ( false === has_filter( 'replace_editor', 'gutenberg_init' ) );

    // Block editor since 5.0.
    $block_editor = version_compare( $GLOBALS['wp_version'], '5.0-beta', '>' );

    if ( ! $gutenberg && ! $block_editor ) {
        return false;
    }

    if ( is_classic_editor_plugin_active() ) {
        $editor_option       = get_option( 'classic-editor-replace' );
        $block_editor_active = array( 'no-replace', 'block' );

        return in_array( $editor_option, $block_editor_active, true );
    }

    return true;
}

/**
 * Check if Classic Editor plugin is active.
 *
 * @return bool
 */
function is_classic_editor_plugin_active() {
    if ( ! function_exists( 'is_plugin_active' ) ) {
        include_once ABSPATH . 'wp-admin/includes/plugin.php';
    }

    if ( class_exists( 'Classic_Editor' ) ) {
        return true;
    }

    return false;
}

/**
 * Live Search
 */
function search_handler() {
	// Cek apakah request AJAX dan action yang diminta adalah "search"
	if (isset($_GET['action']) && $_GET['action'] == 'search') {
			// Ambil nilai dari input pencarian
			$s = $_GET['s'];

			// Buat query pencarian
			$query = new WP_Query(array(
					's' => $s,
					'post_type' => 'post', // Tampilkan hanya post, bukan page
					'posts_per_page' => -1
			));
		
			// Jika ada hasil pencarian
			if ($query->have_posts()) {
					// Tampilkan daftar hasil pencarian
					while ($query->have_posts()) {
							$query->the_post();
							?>
							<li class="dark:hover:bg-charcoal-800 text-charcoal-800 group flex items-center space-x-2 rounded-md bg-gray-100 px-2 py-2 hover:bg-sky-700 hover:text-white">
								<span class="dark:group-hover:bg-charcoal-800 dark:hover:bg-charcoal-800 rounded border border-gray-300 bg-gray-200 px-2 group-hover:bg-sky-700">#</span>
								<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
							</li>

							<?php
					}
					wp_reset_postdata();
			} else {
					// Tampilkan pesan jika tidak ada hasil pencarian
					echo '<p>No results found.</p>';
			}
			exit;
	}
}
add_action('init', 'search_handler');


/**
 * Display Ads Options
 */

if ( ! function_exists( 'narasix_ads_code' ) ) :
	function narasix_ads_code( $ads ) {
			$top_ad = narasix_get_option( 'set_top_ad' );
			$middle_ad = narasix_get_option( 'set_middle_ad' );
			$bottom_ad = narasix_get_option( 'set_bottom_ad' );

			if ( $ads == "top_ad" ) {
					if ($top_ad) {
							echo '<div class="ads container text-center py-5 top_ad fadein"> ' . $top_ad . ' </div>';
					}
			} else if ( $ads == "middle_ad" ) {
					if ($middle_ad) {
							echo '<div class="ads mt-5 pb-0 text-center middle_ad fadein"> ' . $middle_ad . ' </div>';
					}
			} else if ( $ads == "bottom_ad" ) {
					if ($bottom_ad) {
							echo '<div class="max-w-7xl mx-auto px-4 lg:px-16"> ' . $bottom_ad . ' </div>';
					}
			}
	}
endif; 

// Insert ad after paragraph
$enable_ad_single_post = narasix_get_option('enable_ad_single_post');
$set_single_post_ad = narasix_get_option('set_single_post_ad');
$set_position_single_post_ad = narasix_get_option('set_position_single_post_ad');
if($enable_ad_single_post == true){
    if($set_single_post_ad && $set_position_single_post_ad){

        add_filter( 'the_content', 'prefix_insert_ad' );
        function prefix_insert_ad( $content ) {
         $set_single_post_ad = narasix_get_option('set_single_post_ad');
         $set_position_single_post_ad = narasix_get_option('set_position_single_post_ad');

         if ( is_single() && ! is_admin() ) {
            $arr = explode(',',$set_position_single_post_ad);
            foreach ($arr as $par_id) {
                $content = prefix_insert_before_paragraph( '<div class="ads my-4 py-3 text-center fadein">' . $set_single_post_ad . '</div>', $par_id, $content );
            }
         }
        return $content;
        }

        function prefix_insert_before_paragraph( $insertion, $paragraph_id, $content ) {
         $opening_p = '</p>';
         $paragraphs = explode( $opening_p, $content );
         foreach ($paragraphs as $index => $paragraph) {
             if ( trim( $paragraph ) ) {
                $paragraphs[$index] .= $opening_p;
             }
             if ( $paragraph_id == $index + 1 ) {
                $paragraphs[$index] .= $insertion;
             }
         }
         return implode( '', $paragraphs );
        }
    }
}

/**
 * Remove Update notification and Admin menu for ACF PRO
 */

function narasix_acf_pro_remove_update_notification( $value ) {
	unset( $value->response['advanced-custom-fields-pro/acf.php'] );
	return $value;
}
add_filter( 'site_transient_update_plugins', 'narasix_acf_pro_remove_update_notification' );

function narasix_acf_pro_modify_settings() {
	if ( class_exists( 'acf_pro' ) && !class_exists( 'ACF' ) )  {
		acf_update_setting( 'show_admin', false );
    	acf_update_setting( 'show_updates', false );
	}
}
add_action( 'acf/init', 'narasix_acf_pro_modify_settings' );

// Disables the block editor from managing widgets in the Gutenberg plugin.
add_filter( 'gutenberg_use_widgets_block_editor', '__return_false', 100 );

// Disables the block editor from managing widgets. renamed from wp_use_widgets_block_editor
add_filter( 'use_widgets_block_editor', '__return_false' );