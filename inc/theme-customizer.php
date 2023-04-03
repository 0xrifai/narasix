<?php
$theme_slug = 'narasix';
$option_name = 'nsix_' .$theme_slug;
$prefix = $option_name . '_';

Kirki::add_config( $option_name, array(
	'capability'    => 'edit_theme_options',
	'option_type'   => 'theme_mod',
) );

Kirki::add_panel( $prefix . 'panel', array(
    'priority'    => 10,
    'title'       => esc_html__( 'Narasix Settings', 'narasix' ),
) );

/**
 * CSS Selectors Variables.
 */

$background_header_light = '
		.site-header,
 		.header-mobile';

$background_header_dark = '
 		.dark .site-header,
 		.dark .header-mobile';

$background_sticky_header_light = '
		.site-header-fixed,
		.header-mobile-sticky.sticky-active';

$background_sticky_header_dark = '
		.dark .site-header-fixed,
		.dark .header-mobile-sticky.sticky-active';

$color_bg_light_mode_selectors = '
	.bg-charcoal-50';

$color_text_light_mode_selectors = '
	.text-charcoal-900';

$color_bg_dark_mode_selectors = '
	.dark .dark\:bg-charcoal-800';

$color_text_dark_mode_selectors = '
	.dark .dark\:text-charcoal-100';

$body_typography_selectors = '
    body,
    .font-default,
    .widget-calendar,
    .wp-block-calendar,
    .wp-block-tag-cloud a,
    .elementor-widget-text-editor';

$navigation_typography_selectors = '
    .navigation,
    .font-navigation';

$heading_typography_selectors = '
		.wysiwyg h1,
		.wysiwyg h2,
		.wysiwyg h3,
		.wysiwyg h4,
		.wysiwyg h5,
		.wysiwyg h6,
    .font-heading,
		
    .comment-author .fn,
    .widget_calendar caption,
    .wp-block-calendar table caption,
    .wp-block-latest-comments__comment-meta,
    .widget_recent_entries li a,
    .wp-block-latest-posts li a,
    .widget_pages ul,
    .widget_rss li a,
    .wp-block-rss__item-title';

$meta_heading_typography_selectors = '
		.widget.titles h2,
		.meta-heading,
		.meta-title-block';

$meta_typography_selectors = '
    label,
    button,
    input[type=submit],
    figcaption,
    .navbar-btn,
    .font-meta,
    .meta-font,
    .post-meta,
    .post-tag,
    .category-item-title,
    .post-read-more,
    .comment-reply-title,
    .comment-meta,
    .comment .reply,
    .comments-area .comment.bypostauthor .comment-author .fn:after,
    .wp-caption,
    .gallery-caption,
    .nsix-section-heading,
    .widget_archive ul,
    .widget_archive select,
    .wp-block-archives,
    .wp-block-archives-dropdown select,
    .wp-block-button__link,
    .widget_categories ul,
    .widget_categories select,
    .wp-block-categories,
    .wp-block-categories select,
    .wp-block-file__button,
    .wp-block-quote__citation,
    .wp-block-quote cite,
    .wp-block-quote footer,
    .wp-block-pullquote p,
    .wp-block-pullquote__citation,
    .wp-block-pullquote cite,
    .wp-block-pullquote footer,
    .wp-block-latest-comments__comment-date,
    .widget_meta ul,
    .widget_nav_menu ul,
    .widget_recent_entries .post-date,
    .wp-block-latest-posts__post-author,
    .wp-block-latest-posts__post-date,
    .wp-block-rss__item-author,
    .wp-block-rss__item-publish-date,
    .wp-block-search__button';

/**
 * General Section.
 */
Kirki::add_section( $prefix . 'general_section', array(
    'title'          => esc_html__( 'General', 'narasix' ),
    'panel'          => $prefix . 'panel',
) );

Kirki::add_field( $option_name, [
	'type'        => 'select',
	'settings'    => $prefix . 'content_layout_width',
	'label'       => esc_html__( 'Content Layout Width', 'narasix' ),
	'section'     => $prefix . 'general_section',
	'default'     => 'default',
	'choices'     => [
		'default' => esc_html__( 'Default', 'narasix' ),
		'full' => esc_html__( 'Full-width', 'narasix' ),
	],
] );

Kirki::add_field( $option_name, [
	'type'        => 'dimension',
	'settings'		=> $prefix . 'thumbnail_rounded',
	'label'   		=> esc_html__( 'Thumbnail Rounded', 'narasix' ),
	'description' => esc_html__( 'For all thumbnails', 'narasix' ),
	'section' 		=> $prefix . 'general_section',
	'default'     => '',
	'transport'   => 'postMessage',
	'output'      => array(
		array(
				'element'  => '.aspect-autos .wp-post-image, .aspect-squares .wp-post-image, .wp-block-image img, .ralated-content .wp-post-image, .widget-with-cover .bg-cover, .widget-slider .bg-cover, .widget-slider .rounded_b',
				'property' => 'border-radius',
		),
),
] );


Kirki::add_field( $option_name, [
	'type'        => 'background',
	'settings'    => $prefix . 'main_background',
	'label'       => esc_html__( 'Main Background', 'narasix' ),
	'section'     => $prefix . 'general_section',
	'default'     => [
		'background-color'      => 'rgba(255, 255, 255, 0)',
		'background-image' 			=> '' ,
		'background-repeat'     => 'no-repeat',
		'background-position'   => 'center top',
		'background-size'       => 'cover',
		'background-attachment' => 'fixed',
	],
	'transport'   => 'auto',
	'output'      => [
		[
			'element' => '.site-container',
		],
	],
] );

Kirki::add_field( $option_name, [
	'type'    		=> 'radio-buttonset',
	'settings'		=> $prefix . 'thumbnail_default_switch',
	'label'   		=> esc_html__( 'Thumbnail Default', 'narasix' ),
	'description' => esc_html__( 'Display default thumbnail', 'narasix' ),
	'section' 		=> $prefix . 'general_section',
	'default' 		=> 'no',
	'choices' 		=> [
		'yes'   => esc_html__( 'Yes', 'narasix' ),
		'no' 	=> esc_html__( 'No', 'narasix' ),
	],
] );

Kirki::add_field( $option_name, [
	'type'    		=> 'radio-buttonset',
	'settings'		=> $prefix . 'darkmode_mode_switch',
	'label'   		=> esc_html__( 'Dark Mode', 'narasix' ),
	'section' 		=> $prefix . 'general_section',
	'default' 		=> 'no',
	'choices' 		=> [
		'yes'   => esc_html__( 'Yes', 'narasix' ),
		'no' 	=> esc_html__( 'No', 'narasix' ),
	],
] );

Kirki::add_field( $option_name, [
	'type'        => 'color',
	'settings'    => $prefix . 'bg_light_mode',
	'label'       => esc_html__( 'Light Mode Background', 'narasix' ),
	'description' => esc_html__( 'Make sure white text is legible on elements that has this background color.', 'narasix' ),
	'section'     => $prefix . 'general_section',
    'default'     => '#fdfdfd',
    'output' => array(
        array(
            'element'  => $color_bg_light_mode_selectors,
            'property' => 'background-color',
        ),
    ),
		'active_callback' => [
			[
				'setting'    => $prefix . 'darkmode_mode_switch',
				'operator' => '==',
				'value'    => 'yes',
			]
		],
] );

Kirki::add_field( $option_name, [
	'type'        => 'color',
	'settings'    => $prefix . 'text_light_mode',
	'label'       => esc_html__( 'Light Mode Text', 'narasix' ),
	'description' => esc_html__( 'Make sure white text is legible on elements that has this background color.', 'narasix' ),
	'section'     => $prefix . 'general_section',
    'default'     => '#353744',
    'output' => array(
        array(
            'element'  => $color_text_light_mode_selectors,
            'property' => 'color',
        ),
    ),
		'active_callback' => [
			[
				'setting'    => $prefix . 'darkmode_mode_switch',
				'operator' => '==',
				'value'    => 'yes',
			]
		],
] );

Kirki::add_field( $option_name, [
	'type'        => 'color',
	'settings'    => $prefix . 'bg_dark_mode',
	'label'       => esc_html__( 'Dark Mode Background', 'narasix' ),
	'description' => esc_html__( 'Make sure white text is legible on elements that has this background color.', 'narasix' ),
	'section'     => $prefix . 'general_section',
    'default'     => '#272935',
    'output' => array(
        array(
            'element'  => $color_bg_dark_mode_selectors,
            'property' => 'background-color',
        ),
    ),
		'active_callback' => [
			[
				'setting'    => $prefix . 'darkmode_mode_switch',
				'operator' => '==',
				'value'    => 'yes',
			]
		],
] );

Kirki::add_field( $option_name, [
	'type'        => 'color',
	'settings'    => $prefix . 'text_dark_mode',
	'label'       => esc_html__( 'Dark Mode Text', 'narasix' ),
	'description' => esc_html__( 'Make sure white text is legible on elements that has this background color.', 'narasix' ),
	'section'     => $prefix . 'general_section',
    'default'     => '#f7f6f8',
    'output' => array(
        array(
            'element'  => $color_text_dark_mode_selectors,
            'property' => 'color',
        ),
    ),
		'active_callback' => [
			[
				'setting'    => $prefix . 'darkmode_mode_switch',
				'operator' => '==',
				'value'    => 'yes',
			]
		],
] );

Kirki::add_field( $option_name, [
	'type'    		=> 'radio-buttonset',
	'settings'		=> $prefix . 'sticky_sidebar',
	'label'   		=> esc_html__( 'Sticky sidebar', 'narasix' ),
	'section' 		=> $prefix . 'general_section',
	'default' 		=> 'yes',
	'choices' 		=> [
		'yes'   => esc_html__( 'Yes', 'narasix' ),
		'no' 	=> esc_html__( 'No', 'narasix' ),
	],
] );

Kirki::add_field( $option_name, [
	'type'        => 'radio-buttonset',
	'settings'    => $prefix . 'back_top_switch',
	'label'       => esc_html__( 'Display Back to top button', 'narasix' ),
	'section'     => $prefix . 'general_section',
	'default'     => 'yes',
	'choices'     => [
		'yes'   => esc_html__( 'Yes', 'narasix' ),
		'no' 	=> esc_html__( 'No', 'narasix' ),
	],
] );

Kirki::add_field( $option_name, [
	'type'        => 'color',
	'settings'    => $prefix . 'custom_bg_backtotop',
	'label'       => esc_html__( 'Custom Background', 'narasix' ),
	'section'     => $prefix . 'general_section',
    'default'     => '',
    'output' => array(
        array(
            'element'  => '.js-nsix-back-top-btn',
            'property' => 'background-color',
        ),
    ),
		'active_callback' => [
			[
				'setting'    => $prefix . 'back_top_switch',
				'operator' => '==',
				'value'    => 'yes',
			]
		],
] );

/**
 * Typography Section.
 */
Kirki::add_section( $prefix . 'typography_section', array(
    'title'          => esc_html__( 'Typography', 'narasix' ),
    'description'    => esc_html__( 'It is recommended to use maximum 3 different Google font families for better page load speed.', 'narasix' ),
    'panel'          => $prefix . 'panel',
) );

Kirki::add_field( $option_name, [
	'type'        => 'typography',
	'settings'    => $prefix . 'body_typography',
	'label'       => esc_html__( 'Body', 'narasix' ),
    'section'     => $prefix . 'typography_section',
    'choices' => [
        'fonts' => [
            'standard' => [ 'serif', 'sans-serif' ],
            'google' => [],
        ],
        'variant' => [
			'300',
            '300italic',
            'regular',
            'italic',
            '700',
            '700italic',
        ],
    ],
	'default'     => [
		'font-family'    => '',
		'variant'        => '',
	],
	'transport'   => 'auto',
	'output'      => [
		[
			'element' => $body_typography_selectors,
		],
	],
] );

Kirki::add_field( $option_name, [
	'type'        => 'typography',
	'settings'    => $prefix . 'navigation_typography',
	'label'       => esc_html__( 'Navigation', 'narasix' ),
    'section'     => $prefix . 'typography_section',
    'choices' => [
        'fonts' => [
            'standard' => [ 'serif', 'sans-serif' ],
            'google' => [],
        ],
        'variant' => [
            'regular',
            '700',
        ],
    ],
	'default'     => [
		'font-family'    => '',
		'variant'        => '',
	],
	'transport'   => 'auto',
	'output'      => [
		[
			'element' => $navigation_typography_selectors,
		],
	],
] );

Kirki::add_field( $option_name, [
	'type'        => 'typography',
	'settings'    => $prefix . 'heading_typography',
	'label'       => esc_html__( 'Heading', 'narasix' ),
    'section'     => $prefix . 'typography_section',
    'choices' => [
        'fonts' => [
            'standard' => [ 'serif', 'sans-serif' ],
            'google' => [],
        ],
        'variant' => [
            'regular',
            'italic',
            '700',
            '700italic',
        ],
    ],
	'default'     => [
		'font-family'    => '',
		'variant'        => '',
	],
	'transport'   => 'auto',
	'output'      => [
		[
			'element' => $heading_typography_selectors,
		],
	],
] );

Kirki::add_field( $option_name, [
	'type'        => 'typography',
	'settings'    => $prefix . 'meta_heading_typography',
	'label'       => esc_html__( 'Meta Heading', 'narasix' ),
    'section'     => $prefix . 'typography_section',
    'choices' => [
        'fonts' => [
            'standard' => [ 'serif', 'sans-serif' ],
            'google' => [],
        ],
        'variant' => [
            'regular',
            'italic',
            '700',
            '700italic',
        ],
    ],
	'default'     => [
		'font-family'    => '',
		'variant'        => '',
	],
	'transport'   => 'auto',
	'output'      => [
		[
			'element' => $meta_heading_typography_selectors,
		],
	],
] );

Kirki::add_field( $option_name, [
	'type'        => 'typography',
	'settings'    => $prefix . 'meta_typography',
	'label'       => esc_html__( 'Meta', 'narasix' ),
    'section'     => $prefix . 'typography_section',
    'choices' => [
        'fonts' => [
            'standard' => [ 'serif', 'sans-serif' ],
            'google' => [],
        ],
        'variant' => [
            'regular',
            'italic',
            '700',
            '700italic',
        ],
    ],
	'default'     => [
		'font-family'    => '',
		'variant'        => '',
	],
	'transport'   => 'auto',
	'output'      => [
		[
			'element' => $meta_typography_selectors,
		],
	],
] );

/**
 * Header Section.
 */
Kirki::add_section( $prefix . 'header_section', array(
    'title'          => esc_html__( 'Header', 'narasix' ),
    'panel'          => $prefix . 'panel',
) );

Kirki::add_field( $option_name, [
	'type'        => 'select',
	'settings'    => $prefix . 'header_layout',
	'label'       => esc_html__( 'Header Layout', 'narasix' ),
	'section'     => $prefix . 'header_section',
	'default'     => 'a',
	'choices'     => [
		'a'   => esc_html__( 'Header 1', 'narasix' ),
		'b' => esc_html__( 'Header 2', 'narasix' ),
		'c'  	=> esc_html__( 'Header 3', 'narasix' ),
	],
] );

Kirki::add_field( $option_name, [
	'type'     => 'text',
	'settings'    => $prefix . 'header_button',
	'label'    => esc_html__( 'Header Button', 'narasix' ),
	'section'     => $prefix . 'header_section',
	'default'	=> esc_html__( 'Subscribe', 'narasix' ),
	'sanitize_callback' => 'wp_kses_post',
	'active_callback' => [
    [
			'setting'    => $prefix . 'header_layout',
			'operator' => '==',
			'value'    => 'c',
    ]
	],
] );

Kirki::add_field( $option_name, [
	'type'        => 'url',
	'settings'    => $prefix . 'url_button',
	'label'       => __( 'Url Button', 'narasix' ),
	'section'     => $prefix . 'header_section',
	'default'     => '',
	'active_callback' => [
    [
			'setting'    => $prefix . 'header_layout',
			'operator' => '==',
			'value'    => 'c',
		],
	],
] );

Kirki::add_field( $option_name, [
	'type'    		=> 'radio-buttonset',
	'settings'		=> $prefix . 'custom_bg_header',
	'label'   		=> esc_html__( 'Custom Background Colors header', 'narasix' ),
	'section' 		=> $prefix . 'header_section',
	'default' 		=> 'yes',
	'choices' 		=> [
		'yes'   => esc_html__( 'Yes', 'narasix' ),
		'no' 	=> esc_html__( 'No', 'narasix' ),
	],
] );

Kirki::add_field( $option_name, [
	'type'        => 'color',
	'settings'    => $prefix . 'menu_button_mobile',
	'label'       => esc_html__( 'Menu Button Mobile Color', 'narasix' ),
	'section'     => $prefix . 'header_section',
    'default'     => '',
    'output' => array(
        array(
            'element'  => '.menu-button',
            'property' => 'background-color',
        ),
    ),
] );

Kirki::add_field( $option_name, [
	'type'        => 'color',
	'settings'    => $prefix . 'header_colors_light',
	'label'       => esc_html__( 'Header Background Light', 'narasix' ),
	'section'     => $prefix . 'header_section',
    'default'     => '',
    'output' => array(
        array(
            'element'  => $background_header_light,
            'property' => 'background-color',
        ),
    ),
		'active_callback' => [
			[
				'setting'    => $prefix . 'custom_bg_header',
				'operator' => '==',
				'value'    => 'yes',
			]
		],
] );

Kirki::add_field( $option_name, [
	'type'        => 'color',
	'settings'    => $prefix . 'header_colors_dark',
	'label'       => esc_html__( 'Header Background Dark', 'narasix' ),
	'section'     => $prefix . 'header_section',
    'default'     => '',
    'output' => array(
        array(
            'element'  => $background_header_dark,
            'property' => 'background-color',
        ),
    ),
		'active_callback' => [
			[
				'setting'    => $prefix . 'custom_bg_header',
				'operator' => '==',
				'value'    => 'yes',
			]
		],
] );

Kirki::add_field( $option_name, [
	'type'    		=> 'radio-buttonset',
	'settings'		=> $prefix . 'sticky_header',
	'label'   		=> esc_html__( 'Sticky header desktop', 'narasix' ),
	'section' 		=> $prefix . 'header_section',
	'default' 		=> 'yes',
	'choices' 		=> [
		'yes'   => esc_html__( 'Yes', 'narasix' ),
		'no' 	=> esc_html__( 'No', 'narasix' ),
	],
] );

Kirki::add_field( $option_name, [
	'type'    		=> 'radio-buttonset',
	'settings'		=> $prefix . 'sticky_header_mobile',
	'label'   		=> esc_html__( 'Sticky header mobile', 'narasix' ),
	'section' 		=> $prefix . 'header_section',
	'default' 		=> 'yes',
	'choices' 		=> [
		'yes'   => esc_html__( 'Yes', 'narasix' ),
		'no' 	=> esc_html__( 'No', 'narasix' ),
	],
	'active_callback' => [
    [
			'setting'    => $prefix . 'header_layout',
			'operator' => 'in',
			'value'    => [ 'a', 'b' ],
		],
	],
] );

Kirki::add_field( $option_name, [
	'type'        => 'color',
	'settings'    => $prefix . 'sticky_header_colors_light',
	'label'       => esc_html__( 'Header Sticky Background Light', 'narasix' ),
	'section'     => $prefix . 'header_section',
    'default'     => '#ffffff00',
    'output' => array(
        array(
            'element'  => $background_sticky_header_light,
            'property' => 'background-color',
        ),
    ),
		'active_callback' => [
			[
				'setting'    => $prefix . 'sticky_header',
				'operator' => '==',
				'value'    => 'yes',
			]
		],
] );

Kirki::add_field( $option_name, [
	'type'        => 'color',
	'settings'    => $prefix . 'sticky_header_colors_dark',
	'label'       => esc_html__( 'Header Sticky Background Dark', 'narasix' ),
	'section'     => $prefix . 'header_section',
    'default'     => '#ffffff00',
    'output' => array(
        array(
            'element'  => $background_sticky_header_dark,
            'property' => 'background-color',
        ),
    ),
		'active_callback' => [
			[
				'setting'    => $prefix . 'sticky_header',
				'operator' => '==',
				'value'    => 'yes',
			]
		],
] );

Kirki::add_field( $option_name, [
	'type'    		=> 'radio-buttonset',
	'settings'		=> $prefix . 'header_uppercase_menu',
	'label'   		=> esc_html__( 'Uppercase menu items', 'narasix' ),
	'section' 		=> $prefix . 'header_section',
	'default' 		=> 'no',
	'choices' 		=> [
		'yes'   => esc_html__( 'Yes', 'narasix' ),
		'no' 	=> esc_html__( 'No', 'narasix' ),
	],
] );

Kirki::add_field( $option_name, [
	'type'    		=> 'radio-buttonset',
	'settings'		=> $prefix . 'header_show_login',
	'label'   		=> esc_html__( 'Show login button', 'narasix' ),
	'section' 		=> $prefix . 'header_section',
	'default' 		=> 'yes',
	'choices' 		=> [
		'yes'   => esc_html__( 'Yes', 'narasix' ),
		'no' 	=> esc_html__( 'No', 'narasix' ),
	],
] );

Kirki::add_field( $option_name, [
    'type'          => 'link',
    'settings'      => $prefix . 'header_login_url',
    'label'         => esc_html__( "Login button's URL", 'narasix' ),
    'description'   => esc_html__( "Link to your login page. Leave empty if you want to use the default login popup", 'narasix' ),
    'section'       => $prefix . 'header_section',
    'default'       => '',
    'active_callback' => [
        [
            'setting'    => $prefix . 'header_show_login',
            'operator' => '=',
            'value'    => 'yes',
        ]
    ],
] );

Kirki::add_field( $option_name, [
	'type'        => 'image',
	'settings'    => $prefix . 'header_logo',
	'label'       => esc_html__( 'Header logo', 'narasix' ),
	'description' => esc_html__( "Logo images' dimensions should double the dimensions specified below for displaying on hi-DPI devices.", 'narasix' ),
	'section'     => $prefix . 'header_section',
	'default'     => '',
	'choices'     => [
		'save_as' => 'array',
	],
] );

Kirki::add_field( $option_name, [
	'type'        => 'image',
	'settings'    => $prefix . 'offcanvas_logo',
	'label'       => esc_html__( 'Offcanvas menu logo', 'narasix' ),
	'section'     => $prefix . 'header_section',
	'default'     => '',
	'choices'     => [
		'save_as' => 'array',
	],
] );

/**
 * Footer Section.
 */
Kirki::add_section( $prefix . 'footer_section', array(
    'title'          => esc_html__( 'Footer', 'narasix' ),
    'panel'          => $prefix . 'panel',
) );

Kirki::add_field( $option_name, [
	'type'        => 'select',
	'settings'    => $prefix . 'footer_layout',
	'label'       => esc_html__( 'Footer Layout', 'narasix' ),
	'section'     => $prefix . 'footer_section',
	'default'     => 'a',
	'choices'     => [
		'a' => esc_html__( 'Layout 1', 'narasix' ),
		'b' => esc_html__( 'Layout 2', 'narasix' ),
		'c' => esc_html__( 'Layout 3', 'narasix' ),
	],
] );

Kirki::add_field( $option_name, [
	'type'     => 'text',
	'settings'    => $prefix . 'footer_about_heading',
	'label'    => esc_html__( 'Footer about Heading', 'narasix' ),
	'section'     => $prefix . 'footer_section',
	'default'	=> esc_html__( 'Stay in the loop', 'narasix' ),
	'sanitize_callback' => 'wp_kses_post',
	'active_callback' => [
    [
			'setting'    => $prefix . 'footer_layout',
			'operator' => '==',
			'value'    => 'b',
		],
	],
] );

Kirki::add_field( $option_name, [
	'type'     => 'textarea',
	'settings'    => $prefix . 'footer_about',
	'label'    => esc_html__( 'Footer about', 'narasix' ),
	'section'     => $prefix . 'footer_section',
	'default'	=> esc_html__( 'Doloribus consectetur quasi ipsa quo neque culpa blanditiis ducimus recusandae a veritatis optio cumque, in harum ad nam!', 'narasix' ),
	'sanitize_callback' => 'wp_kses_post',
	'active_callback' => [
    [
			'setting'    => $prefix . 'footer_layout',
			'operator' => 'in',
			'value'    => [ 'a', 'b' ],
    ]
	],
] );

Kirki::add_field( $option_name, [
	'type'        => 'radio-buttonset',
	'settings'    => $prefix . 'footer_subscribe_switch',
	'label'       => esc_html__( 'Display form subscribe', 'narasix' ),
	'section'     => $prefix . 'footer_section',
	'default'     => 'no',
	'choices'     => [
		'yes'   => esc_html__( 'Yes', 'narasix' ),
		'no' 	=> esc_html__( 'No', 'narasix' ),
	],
	'active_callback' => [
    [
			'setting'    => $prefix . 'footer_layout',
			'operator' => '==',
			'value'    => 'b',
    ]
	],
] );

Kirki::add_field( $option_name, [
	'type'        => 'text',
	'settings'    => $prefix . 'shortcode_mc4wp',
	'label'       => esc_html__( 'Shortcode', 'narasix' ),
	'description' => esc_html__( 'Enter your shortcode here', 'narasix' ),
	'section'     => $prefix . 'footer_section',
	'default'     => '',
	'sanitize_callback' => 'wp_filter_nohtml_kses',
	'active_callback' => [
    [
			'setting'    => $prefix . 'footer_subscribe_switch',
			'operator' => '==',
			'value'    => 'yes',
		],
    [
			'setting'    => $prefix . 'footer_layout',
			'operator' => '==',
			'value'    => 'b',
		],
	],
] );

Kirki::add_field( $option_name, [
	'type'        => 'image',
	'settings'    => $prefix . 'footer_logo',
	'label'       => esc_html__( 'Footer logo', 'narasix' ),
	'description' => esc_html__( "Logo images' dimensions should double the dimensions specified below for displaying on hi-DPI devices.", 'narasix' ),
	'section'     => $prefix . 'footer_section',
	'default'     => '',
	'choices'     => [
		'save_as' => 'array',
	],
] );

Kirki::add_field( $option_name, [
	'type'        => 'number',
	'settings'    => $prefix . 'footer_logo_height',
	'label'       => esc_html__( 'Footer logo\'s height (in px)', 'narasix' ),
	'section'     => $prefix . 'footer_section',
	'default'     => 40,
	'choices'     => [
		'min'  => 0,
		'max'  => 680,
		'step' => 1,
	],
	'output'      => [
		[
			'element' => '.logo-footer',
			'property' => 'height',
			'units' => 'px',
		],
	],
] );

Kirki::add_field( $option_name, [
	'type'        => 'radio-buttonset',
	'settings'    => $prefix . 'footer_background_switch',
	'label'       => esc_html__( 'Footer Background', 'narasix' ),
	'section'     => $prefix . 'footer_section',
	'default'     => 'no',
	'choices'     => [
		'yes'   => esc_html__( 'Yes', 'narasix' ),
		'no' 	=> esc_html__( 'No', 'narasix' ),
	],
] );

Kirki::add_field( $option_name, [
	'type'        => 'color',
	'settings'    => $prefix . 'footer_bg_colors_light',
	'label'       => esc_html__( 'Footer Background Light', 'narasix' ),
	'section'     => $prefix . 'footer_section',
    'default'     => '#f7f7f7',
    'output' => array(
        array(
            'element'  => '.site-footer',
            'property' => 'background-color',
        ),
    ),
		'active_callback' => [
			[
				'setting'    => $prefix . 'footer_background_switch',
				'operator' => '==',
				'value'    => 'yes',
			]
		],
] );

Kirki::add_field( $option_name, [
	'type'        => 'color',
	'settings'    => $prefix . 'footer_bg_colors_dark',
	'label'       => esc_html__( 'Footer Background Dark', 'narasix' ),
	'section'     => $prefix . 'footer_section',
    'default'     => '#2b2a38',
    'output' => array(
        array(
            'element'  => '.dark .dark\:bg-charcoal-900',
            'property' => 'background-color',
        ),
    ),
		'active_callback' => [
			[
				'setting'    => $prefix . 'footer_background_switch',
				'operator' => '==',
				'value'    => 'yes',
			]
		],
] );

Kirki::add_field( $option_name, [
	'type'     => 'textarea',
	'settings'    => $prefix . 'footer_copyright',
	'label'    => esc_html__( 'Footer copyright', 'narasix' ),
	'section'     => $prefix . 'footer_section',
	'default'	=> 'Made by © <a href="#" target="_blank" rel="nofollow">Hidunks Studio</a>',
	'sanitize_callback' => 'wp_kses_post',
	'active_callback' => [
    [
			'setting'    => $prefix . 'footer_layout',
			'operator' => 'in',
			'value'    => [ 'a', 'c' ],
    ]
	],
] );

Kirki::add_field( $option_name, [
	'type'        => 'radio-buttonset',
	'settings'    => $prefix . 'footer_social_media_switch',
	'label'       => esc_html__( 'Display social media', 'narasix' ),
	'section'     => $prefix . 'footer_section',
	'default'     => 'yes',
	'choices'     => [
		'yes'   => esc_html__( 'Yes', 'narasix' ),
		'no' 	=> esc_html__( 'No', 'narasix' ),
	],
	'active_callback' => [
    [
			'setting'    => $prefix . 'footer_layout',
			'operator' => 'in',
			'value'    => [ 'a', 'c' ],
    ]
	],
] );

/**
 * Blog and Archives Section.
 */
Kirki::add_section( $prefix . 'archive_section', array(
    'title'          => esc_html__( 'Blog and Archives', 'narasix' ),
    'panel'          => $prefix . 'panel',
) );

/* Blog and Archives Section. */
Kirki::add_field( $option_name, [
	'type'        => 'generic',
	'settings'    => $prefix . 'archive_section_filler',
	'section'        => $prefix . 'archive_section',
	'default'     => '',
	'choices'     => [
		'element'  => 'input',
		'type'     => 'password',
		'style'    => 'display: none;',
	],
] );

Kirki::add_field( $option_name, [
	'type'        => 'select',
	'settings'    => $prefix . 'archive_header_style',
	'label'       => esc_html__( 'Header Blog & Archive', 'narasix' ),
	'section'     => $prefix . 'archive_section',
	'default'     => 'a',
	'choices'     => [
		'a'   => esc_html__( 'Style 1', 'narasix' ),
		'b'  	=> esc_html__( 'Style 2', 'narasix' ),
	],
] );

Kirki::add_field( $option_name, [
	'type'        	=> 'radio-buttonset',
	'settings'    	=> $prefix . 'archives_breadcrumb',
	'label'       	=> esc_html__( 'Display breadcrumb', 'narasix' ),
	'section'     	=> $prefix . 'archive_section',
	'default'     	=> 'no',
	'choices'     	=> [
		'yes'  				=> esc_html__( 'Yes', 'narasix' ),
		'no' 					=> esc_html__( 'No', 'narasix' ),
	],
] );

/**
 * Blog Section.
 */
Kirki::add_section( $prefix . 'blog_section', array(
    'title'          => esc_html__( 'Blog', 'narasix' ),
    'section'        => $prefix . 'archive_section',
) );

Kirki::add_field( $option_name, [
	'type'        => 'select',
	'settings'    => $prefix . 'blog_layout',
	'label'       => esc_html__( 'Blog layout', 'narasix' ),
	'section'     => $prefix . 'blog_section',
	'choices'     => [
		'list-landscape' => esc_html__( 'List - Landscape', 'narasix' ),
		'list-landscape-no-sidebar' => esc_html__( 'List - Landscape - No sidebar', 'narasix' ),
		'mixed-a' => esc_html__( 'Mixed 1', 'narasix' ),
		'mixed-b' => esc_html__( 'Mixed 2', 'narasix' ),
		'grid-portrait' => esc_html__( 'Grid - Portrait', 'narasix' ),
		'grid-portrait-no-sidebar' => esc_html__( 'Grid - Portrait - No sidebar', 'narasix' ),
		'masonry-portrait' => esc_html__( 'Masonry - Portrait', 'narasix' ),
	],
	'default'     => 'masonry-portrait',
] );

Kirki::add_field( $option_name, [
	'type'        => 'select',
	'settings'    => $prefix . 'blog_sidebar',
	'label'       => esc_attr__( 'Sidebar', 'narasix' ),
	'section'     => $prefix . 'blog_section',
	'choices'     => narasix_sidebar_list(),
	'default'     => 'nsix-default',
	'active_callback' => [
		[
			'setting'    => $prefix . 'blog_layout',
			'operator' => 'contains',
			'value'    => [
				'list-landscape',
				'mixed-a',
				'mixed-b',
				'grid-portrait',
				'masonry-portrait',
			],
		],
	],
] );

Kirki::add_field( $option_name, [
	'type'        => 'select',
	'settings'    => $prefix . 'blog_grid_columns',
	'label'       => esc_attr__( 'Display mobile columns', 'narasix' ),
	'section'     => $prefix . 'blog_section',
	'choices'     => [
		'1' => esc_html__( '1', 'narasix' ),
		'2' => esc_html__( '2', 'narasix' ),
	],
	'default'     => '1',
	'active_callback' => [
		[
			'setting'    => $prefix . 'blog_layout',
			'operator' => 'contains',
			'value'    => [
				'grid-portrait-no-sidebar',
				'grid-portrait',
				'mixed-b',
			],
		],
	],
] );

Kirki::add_field( $option_name, [
	'type'        => 'radio-buttonset',
	'settings'    => $prefix . 'blog_post_format_icon_toggle',
	'label'       => esc_html__( 'Display post format icon', 'narasix' ),
	'section'     => $prefix . 'blog_section',
	'choices'     => [
		'yes'   => esc_html__( 'Yes', 'narasix' ),
		'no' => esc_html__( 'No', 'narasix' ),
	],
	'default'     => 'no',
] );

Kirki::add_field( $option_name, [
	'type'        => 'radio-buttonset',
	'settings'    => $prefix . 'blog_excerpt_length_toggle',
	'label'       => esc_html__( 'Custom excerpt length', 'narasix' ),
	'section'     => $prefix . 'blog_section',
	'choices'     => [
		'yes'   => esc_html__( 'Yes', 'narasix' ),
		'no' => esc_html__( 'No', 'narasix' ),
	],
	'default'     => 'no',
	'active_callback' => [
		[
			[
				'setting'    => $prefix . 'blog_layout',
				'operator' => 'in',
				'value'    =>  [
					'mixed-b',
					'mixed-a',
					'list-landscape',
					'list-landscape-no-sidebar',
				]
			],
		],
	],
] );

Kirki::add_field( $option_name, [
	'type'        => 'number',
	'settings'    => $prefix . 'blog_excerpt_length',
	'label'       => esc_attr__( 'Excerpt length (in words)', 'narasix' ),
	'section'     => $prefix . 'blog_section',
	'choices'     => [
		'min'  => 0,
		'max'  => 55,
		'step' => 1,
	],
	'default'     => 24,
	'active_callback' => [
		[
			'setting'    => $prefix . 'blog_excerpt_length_toggle',
			'operator' => '==',
			'value'    => 'yes',
		],
		[
			[
				'setting'    => $prefix . 'blog_layout',
				'operator' => 'in',
				'value'    =>  [
					'list-landscape',
					'list-landscape-no-sidebar',
					'mixed-b',
					'mixed-a',
					'grid-portrait',
					'grid-portrait-no-sidebar',
					'masonry-portrait',
				]
			],
		],
	],
] );

Kirki::add_field( $option_name, [
	'type'        => 'select',
	'settings'    => $prefix . 'blog_pagination',
	'label'       => esc_attr__( 'Pagination', 'narasix' ),
	'section'     => $prefix . 'blog_section',
	'choices'     => [
		'default' => esc_html__( 'Default', 'narasix' ),
		'next-and-previous' => esc_html__( 'Next and Previous', 'narasix' ),
		'ajax-load-more' => esc_html__( 'Load more', 'narasix' ),
	],
	'default'     => 'default',
] );

/**
 * Author Section.
 */
Kirki::add_section( $prefix . 'author_section', array(
	'title'          => esc_html__( 'Author Archive', 'narasix' ),
	'section'        => $prefix . 'archive_section',
) );

Kirki::add_field( $option_name, [
	'type'        => 'select',
	'settings'    => $prefix . 'author_layout',
	'label'       => esc_html__( 'Author layout', 'narasix' ),
	'section'     => $prefix . 'author_section',
	'choices'     => [
		'list-landscape' => esc_html__( 'List - Landscape', 'narasix' ),
		'list-landscape-no-sidebar' => esc_html__( 'List - Landscape - No sidebar', 'narasix' ),
		'mixed-a' => esc_html__( 'Mixed 1', 'narasix' ),
		'mixed-b' => esc_html__( 'Mixed 2', 'narasix' ),
		'grid-portrait' => esc_html__( 'Grid - Portrait', 'narasix' ),
		'grid-portrait-no-sidebar' => esc_html__( 'Grid - Portrait - No sidebar', 'narasix' ),
		'masonry-portrait' => esc_html__( 'Masonry - Portrait', 'narasix' ),
	],
	'default'     => 'list-landscape',
] );

Kirki::add_field( $option_name, [
	'type'        => 'radio-buttonset',
	'settings'    => $prefix . 'author_background_switch',
	'label'       => esc_html__( 'Author Background', 'narasix' ),
	'section'     => $prefix . 'author_section',
	'default'     => 'no',
	'choices'     => [
		'yes'   => esc_html__( 'Yes', 'narasix' ),
		'no' 	=> esc_html__( 'No', 'narasix' ),
	],
] );

Kirki::add_field( $option_name, [
	'type'        => 'color',
	'settings'    => $prefix . 'author_bg_colors_light',
	'label'       => esc_html__( 'Author Background Light', 'narasix' ),
	'section'     => $prefix . 'author_section',
    'output' => array(
        array(
            'element'  => '.bg-charcoal-100',
            'property' => 'background-color',
        ),
    ),
		'active_callback' => [
			[
				'setting'    => $prefix . 'author_background_switch',
				'operator' => '==',
				'value'    => 'yes',
			]
		],
] );

Kirki::add_field( $option_name, [
	'type'        => 'color',
	'settings'    => $prefix . 'author_bg_colors_dark',
	'label'       => esc_html__( 'Author Background Dark', 'narasix' ),
	'section'     => $prefix . 'author_section',
    'output' => array(
        array(
            'element'  => '.dark .dark\:bg-charcoal-700\/70',
            'property' => 'background-color',
        ),
    ),
		'active_callback' => [
			[
				'setting'    => $prefix . 'author_background_switch',
				'operator' => '==',
				'value'    => 'yes',
			]
		],
] );

Kirki::add_field( $option_name, [
	'type'        => 'select',
	'settings'    => $prefix . 'author_sidebar',
	'label'       => esc_attr__( 'Sidebar', 'narasix' ),
	'section'     => $prefix . 'author_section',
	'choices'     => narasix_sidebar_list(),
	'default'     => 'nsix-default',
	'active_callback' => [
		[
			'setting'    => $prefix . 'author_layout',
			'operator' => 'contains',
			'value'    => [
				'list-landscape',
				'mixed-a',
				'mixed-b',
				'grid-portrait',
				'masonry-portrait',
			],
		],
	],
] );

Kirki::add_field( $option_name, [
	'type'        => 'select',
	'settings'    => $prefix . 'author_grid_columns',
	'label'       => esc_attr__( 'Display mobile columns', 'narasix' ),
	'section'     => $prefix . 'author_section',
	'choices'     => [
		'1' => esc_html__( '1', 'narasix' ),
		'2' => esc_html__( '2', 'narasix' ),
	],
	'default'     => '1',
	'active_callback' => [
		[
			'setting'    => $prefix . 'author_layout',
			'operator' => 'contains',
			'value'    => [
				'mixed-b',
				'grid-portrait',
				'grid-portrait-no-sidebar',
			],
		],
	],
] );

Kirki::add_field( $option_name, [
	'type'        => 'radio-buttonset',
	'settings'    => $prefix . 'author_post_format_icon_toggle',
	'label'       => esc_html__( 'Display post format icon', 'narasix' ),
	'section'     => $prefix . 'author_section',
	'choices'     => [
		'yes'   => esc_html__( 'Yes', 'narasix' ),
		'no' => esc_html__( 'No', 'narasix' ),
	],
	'default'     => 'no',
] );

Kirki::add_field( $option_name, [
	'type'        => 'radio-buttonset',
	'settings'    => $prefix . 'author_excerpt_length_toggle',
	'label'       => esc_html__( 'Custom excerpt length', 'narasix' ),
	'section'     => $prefix . 'author_section',
	'choices'     => [
		'yes'   => esc_html__( 'Yes', 'narasix' ),
		'no' => esc_html__( 'No', 'narasix' ),
	],
	'default'     => 'no',
	'active_callback' => [
		[
			[
				'setting'    => $prefix . 'author_layout',
				'operator' => 'in',
				'value'    =>  [
					'mixed-b',
					'mixed-a',
					'list-landscape',
					'list-landscape-no-sidebar',
				]
			],
		],
	],
] );

Kirki::add_field( $option_name, [
	'type'        => 'number',
	'settings'    => $prefix . 'author_excerpt_length',
	'label'       => esc_attr__( 'Excerpt length (in words)', 'narasix' ),
	'section'     => $prefix . 'author_section',
	'choices'     => [
		'min'  => 0,
		'max'  => 55,
		'step' => 1,
	],
	'default'     => 24,
	'active_callback' => [
		[
			'setting'    => $prefix . 'author_excerpt_length_toggle',
			'operator' => '==',
			'value'    => 'yes',
		],
		[
			[
				'setting'    => $prefix . 'author_layout',
				'operator' => 'in',
				'value'    =>  [
					'list-landscape',
					'list-landscape-no-sidebar',
					'mixed-a',
					'mixed-b',
					'grid-portrait',
					'grid-portrait-no-sidebar',
					'masonry-portrait',
				]
			],
		],
	],
] );

Kirki::add_field( $option_name, [
	'type'        => 'select',
	'settings'    => $prefix . 'author_pagination',
	'label'       => esc_attr__( 'Pagination', 'narasix' ),
	'section'     => $prefix . 'author_section',
	'choices'     => [
		'default' => esc_html__( 'Default', 'narasix' ),
		'next-and-previous' => esc_html__( 'Next and Previous', 'narasix' ),
		'ajax-load-more' => esc_html__( 'Load more', 'narasix' ),
	],
	'default'     => 'default',
] );

/**
 * Category Section.
 */
Kirki::add_section( $prefix . 'category_section', array(
    'title'          => esc_html__( 'Category Archive', 'narasix' ),
    'section'        => $prefix . 'archive_section',
) );

Kirki::add_field( $option_name, [
	'type'        => 'select',
	'settings'    => $prefix . 'category_layout',
	'label'       => esc_html__( 'Category layout', 'narasix' ),
	'section'     => $prefix . 'category_section',
	'choices'     => [
		'list-landscape' => esc_html__( 'List - Landscape', 'narasix' ),
		'list-landscape-no-sidebar' => esc_html__( 'List - Landscape - No sidebar', 'narasix' ),
		'mixed-a' => esc_html__( 'Mixed 1', 'narasix' ),
		'mixed-b' => esc_html__( 'Mixed 2', 'narasix' ),
		'grid-portrait' => esc_html__( 'Grid - Portrait', 'narasix' ),
		'grid-portrait-no-sidebar' => esc_html__( 'Grid - Portrait - No sidebar', 'narasix' ),
		'masonry-portrait' => esc_html__( 'Masonry - Portrait', 'narasix' ),
	],
	'default'     => 'list-landscape',
] );

Kirki::add_field( $option_name, [
	'type'        => 'select',
	'settings'    => $prefix . 'category_sidebar',
	'label'       => esc_attr__( 'Sidebar', 'narasix' ),
	'section'     => $prefix . 'category_section',
	'choices'     => narasix_sidebar_list(),
	'default'     => 'nsix-default',
	'active_callback' => [
		[
			'setting'    => $prefix . 'category_layout',
			'operator' => 'contains',
			'value'    => [
				'list-landscape',
				'mixed-a',
				'mixed-b',
				'grid-portrait',
				'masonry-portrait',
			],
		],
	],
] );

Kirki::add_field( $option_name, [
	'type'        => 'select',
	'settings'    => $prefix . 'category_grid_columns',
	'label'       => esc_attr__( 'Display mobile columns', 'narasix' ),
	'section'     => $prefix . 'category_section',
	'choices'     => [
		'1' => esc_html__( '1', 'narasix' ),
		'2' => esc_html__( '2', 'narasix' ),
	],
	'default'     => '1',
	'active_callback' => [
		[
			'setting'    => $prefix . 'category_layout',
			'operator' => 'contains',
			'value'    => [
				'mixed-b',
				'grid-portrait',
				'grid-portrait-no-sidebar',
			],
		],
	],
] );

Kirki::add_field( $option_name, [
	'type'        => 'radio-buttonset',
	'settings'    => $prefix . 'category_post_format_icon_toggle',
	'label'       => esc_html__( 'Display post format icon', 'narasix' ),
	'section'     => $prefix . 'category_section',
	'choices'     => [
		'yes'   => esc_html__( 'Yes', 'narasix' ),
		'no' => esc_html__( 'No', 'narasix' ),
	],
	'default'     => 'no',
] );

Kirki::add_field( $option_name, [
	'type'        => 'radio-buttonset',
	'settings'    => $prefix . 'category_excerpt_length_toggle',
	'label'       => esc_html__( 'Custom excerpt length', 'narasix' ),
	'section'     => $prefix . 'category_section',
	'choices'     => [
		'yes'   => esc_html__( 'Yes', 'narasix' ),
		'no' => esc_html__( 'No', 'narasix' ),
	],
	'default'     => 'no',
	'active_callback' => [
		[
			[
				'setting'    => $prefix . 'category_layout',
				'operator' => 'in',
				'value'    =>  [
					'mixed-b',
					'mixed-a',
					'list-landscape',
					'list-landscape-no-sidebar',
				]
			],
		],
	],
] );

Kirki::add_field( $option_name, [
	'type'        => 'number',
	'settings'    => $prefix . 'category_excerpt_length',
	'label'       => esc_attr__( 'Excerpt length (in words)', 'narasix' ),
	'section'     => $prefix . 'category_section',
	'choices'     => [
		'min'  => 0,
		'max'  => 55,
		'step' => 1,
	],
	'default'     => 24,
	'active_callback' => [
		[
			'setting'    => $prefix . 'category_excerpt_length_toggle',
			'operator' => '==',
			'value'    => 'yes',
		],
		[
			[
				'setting'    => $prefix . 'category_layout',
				'operator' => 'in',
				'value'    =>  [
					'list-landscape',
					'list-landscape-no-sidebar',
					'mixed-a',
					'mixed-b',
					'grid-portrait',
					'grid-portrait-no-sidebar',
					'masonry-portrait',
				]
			],
		],
	],
] );

Kirki::add_field( $option_name, [
	'type'        => 'select',
	'settings'    => $prefix . 'category_pagination',
	'label'       => esc_attr__( 'Pagination', 'narasix' ),
	'section'     => $prefix . 'category_section',
	'choices'     => [
		'default' => esc_html__( 'Default', 'narasix' ),
		'next-and-previous' => esc_html__( 'Next and Previous', 'narasix' ),
		'ajax-load-more' => esc_html__( 'Load more', 'narasix' ),
	],
	'default'     => 'default',
] );

/**
 * Search Section.
 */
Kirki::add_section( $prefix . 'search_section', array(
    'title'          => esc_html__( 'Search Archive', 'narasix' ),
    'section'        => $prefix . 'archive_section',
) );

Kirki::add_field( $option_name, [
	'type'        => 'select',
	'settings'    => $prefix . 'search_layout',
	'label'       => esc_html__( 'Search layout', 'narasix' ),
	'section'     => $prefix . 'search_section',
	'choices'     => [
		'list-landscape' => esc_html__( 'List - Landscape', 'narasix' ),
		'list-landscape-no-sidebar' => esc_html__( 'List - Landscape - No sidebar', 'narasix' ),
		'mixed-a' => esc_html__( 'Mixed 1', 'narasix' ),
		'mixed-b' => esc_html__( 'Mixed 2', 'narasix' ),
		'grid-portrait' => esc_html__( 'Grid - Portrait', 'narasix' ),
		'grid-portrait-no-sidebar' => esc_html__( 'Grid - Portrait - No sidebar', 'narasix' ),
		'masonry-portrait' => esc_html__( 'Masonry - Portrait', 'narasix' ),
	],
	'default'     => 'list-landscape',
] );

Kirki::add_field( $option_name, [
	'type'        => 'select',
	'settings'    => $prefix . 'search_sidebar',
	'label'       => esc_attr__( 'Sidebar', 'narasix' ),
	'section'     => $prefix . 'search_section',
	'choices'     => narasix_sidebar_list(),
	'default'     => 'nsix-default',
	'active_callback' => [
		[
			'setting'    => $prefix . 'search_layout',
			'operator' => 'contains',
			'value'    => [
				'list-landscape',
				'mixed-a',
				'mixed-b',
				'grid-portrait',
				'masonry-portrait',
			],
		],
	],
] );

Kirki::add_field( $option_name, [
	'type'        => 'select',
	'settings'    => $prefix . 'search_grid_columns',
	'label'       => esc_attr__( 'Display mobile columns', 'narasix' ),
	'section'     => $prefix . 'search_section',
	'choices'     => [
		'1' => esc_html__( '1', 'narasix' ),
		'2' => esc_html__( '2', 'narasix' ),
	],
	'default'     => '1',
	'active_callback' => [
		[
			'setting'    => $prefix . 'search_layout',
			'operator' => 'contains',
			'value'    => [
				'mixed-b',
				'grid-portrait',
				'grid-portrait-no-sidebar',
			],
		],
	],
] );

Kirki::add_field( $option_name, [
	'type'        => 'radio-buttonset',
	'settings'    => $prefix . 'search_post_format_icon_toggle',
	'label'       => esc_html__( 'Display post format icon', 'narasix' ),
	'section'     => $prefix . 'search_section',
	'choices'     => [
		'yes'   => esc_html__( 'Yes', 'narasix' ),
		'no' => esc_html__( 'No', 'narasix' ),
	],
	'default'     => 'no',
] );

Kirki::add_field( $option_name, [
	'type'        => 'radio-buttonset',
	'settings'    => $prefix . 'search_excerpt_length_toggle',
	'label'       => esc_html__( 'Custom excerpt length', 'narasix' ),
	'section'     => $prefix . 'search_section',
	'choices'     => [
		'yes'   => esc_html__( 'Yes', 'narasix' ),
		'no' => esc_html__( 'No', 'narasix' ),
	],
	'default'     => 'no',
	'active_callback' => [
		[
			[
				'setting'    => $prefix . 'search_layout',
				'operator' => 'in',
				'value'    =>  [
					'mixed-b',
					'mixed-a',
					'list-landscape',
					'list-landscape-no-sidebar',
				]
			],
		],
	],
] );

Kirki::add_field( $option_name, [
	'type'        => 'number',
	'settings'    => $prefix . 'search_excerpt_length',
	'label'       => esc_attr__( 'Excerpt length (in words)', 'narasix' ),
	'section'     => $prefix . 'search_section',
	'choices'     => [
		'min'  => 0,
		'max'  => 55,
		'step' => 1,
	],
	'default'     => 24,
	'active_callback' => [
		[
			'setting'    => $prefix . 'search_excerpt_length_toggle',
			'operator' => '==',
			'value'    => 'yes',
		],
		[
			[
				'setting'    => $prefix . 'search_layout',
				'operator' => 'in',
				'value'    =>  [
					'list-landscape',
					'list-landscape-no-sidebar',
					'mixed-a',
					'mixed-b',
					'grid-portrait',
					'grid-portrait-no-sidebar',
					'masonry-portrait',
				]
			],
		],
	],
] );

Kirki::add_field( $option_name, [
	'type'        => 'select',
	'settings'    => $prefix . 'search_pagination',
	'label'       => esc_attr__( 'Pagination', 'narasix' ),
	'section'     => $prefix . 'search_section',
	'choices'     => [
		'default' => esc_html__( 'Default', 'narasix' ),
		'next-and-previous' => esc_html__( 'Next and Previous', 'narasix' ),
		'ajax-load-more' => esc_html__( 'Load more', 'narasix' ),
	],
	'default'     => 'default',
] );

/**
 * Tag Section.
 */
Kirki::add_section( $prefix . 'tag_section', array(
    'title'          => esc_html__( 'Tag Archive', 'narasix' ),
    'section'        => $prefix . 'archive_section',
) );

Kirki::add_field( $option_name, [
	'type'        => 'select',
	'settings'    => $prefix . 'tag_layout',
	'label'       => esc_html__( 'Tag layout', 'narasix' ),
	'section'     => $prefix . 'tag_section',
	'choices'     => [
		'list-landscape' => esc_html__( 'List - Landscape', 'narasix' ),
		'list-landscape-no-sidebar' => esc_html__( 'List - Landscape - No sidebar', 'narasix' ),
		'mixed-a' => esc_html__( 'Mixed 1', 'narasix' ),
		'mixed-b' => esc_html__( 'Mixed 2', 'narasix' ),
		'grid-portrait' => esc_html__( 'Grid - Portrait', 'narasix' ),
		'grid-portrait-no-sidebar' => esc_html__( 'Grid - Portrait - No sidebar', 'narasix' ),
		'masonry-portrait' => esc_html__( 'Masonry - Portrait', 'narasix' ),
	],
	'default'     => 'list-landscape',
] );

Kirki::add_field( $option_name, [
	'type'        => 'select',
	'settings'    => $prefix . 'tag_sidebar',
	'label'       => esc_attr__( 'Sidebar', 'narasix' ),
	'section'     => $prefix . 'tag_section',
	'choices'     => narasix_sidebar_list(),
	'default'     => 'nsix-default',
	'active_callback' => [
		[
			'setting'    => $prefix . 'tag_layout',
			'operator' => 'contains',
			'value'    => [
				'list-landscape',
				'mixed-a',
				'mixed-b',
				'grid-portrait',
				'masonry-portrait',
			],
		],
	],
] );

Kirki::add_field( $option_name, [
	'type'        => 'select',
	'settings'    => $prefix . 'tag_grid_columns',
	'label'       => esc_attr__( 'Display mobile columns', 'narasix' ),
	'section'     => $prefix . 'tag_section',
	'choices'     => [
		'1' => esc_html__( '1', 'narasix' ),
		'2' => esc_html__( '2', 'narasix' ),
	],
	'default'     => '1',
	'active_callback' => [
		[
			'setting'    => $prefix . 'tag_layout',
			'operator' => 'contains',
			'value'    => [
				'mixed-b',
				'grid-portrait',
				'grid-portrait-no-sidebar',
			],
		],
	],
] );

Kirki::add_field( $option_name, [
	'type'        => 'radio-buttonset',
	'settings'    => $prefix . 'tag_post_format_icon_toggle',
	'label'       => esc_html__( 'Display post format icon', 'narasix' ),
	'section'     => $prefix . 'tag_section',
	'choices'     => [
		'yes'   => esc_html__( 'Yes', 'narasix' ),
		'no' => esc_html__( 'No', 'narasix' ),
	],
	'default'     => 'no',
] );

Kirki::add_field( $option_name, [
	'type'        => 'radio-buttonset',
	'settings'    => $prefix . 'tag_excerpt_length_toggle',
	'label'       => esc_html__( 'Custom excerpt length', 'narasix' ),
	'section'     => $prefix . 'tag_section',
	'choices'     => [
		'yes'   => esc_html__( 'Yes', 'narasix' ),
		'no' => esc_html__( 'No', 'narasix' ),
	],
	'default'     => 'no',
	'active_callback' => [
		[
			[
				'setting'    => $prefix . 'tag_layout',
				'operator' => 'in',
				'value'    =>  [
					'mixed-b',
					'mixed-a',
					'list-landscape',
					'list-landscape-no-sidebar',
				]
			],
		],
	],
] );

Kirki::add_field( $option_name, [
	'type'        => 'number',
	'settings'    => $prefix . 'tag_excerpt_length',
	'label'       => esc_attr__( 'Excerpt length (in words)', 'narasix' ),
	'section'     => $prefix . 'tag_section',
	'choices'     => [
		'min'  => 0,
		'max'  => 55,
		'step' => 1,
	],
	'default'     => 24,
	'active_callback' => [
		[
			'setting'    => $prefix . 'tag_excerpt_length_toggle',
			'operator' => '==',
			'value'    => 'yes',
		],
		[
			[
				'setting'    => $prefix . 'tag_layout',
				'operator' => 'in',
				'value'    =>  [
					'list-landscape',
					'list-landscape-no-sidebar',
					'mixed-a',
					'mixed-b',
					'grid-portrait',
					'grid-portrait-no-sidebar',
					'masonry-portrait',
				]
			],
		],
	],
] );

Kirki::add_field( $option_name, [
	'type'        => 'select',
	'settings'    => $prefix . 'tag_pagination',
	'label'       => esc_attr__( 'Pagination', 'narasix' ),
	'section'     => $prefix . 'tag_section',
	'choices'     => [
		'default' => esc_html__( 'Default', 'narasix' ),
		'next-and-previous' => esc_html__( 'Next and Previous', 'narasix' ),
		'ajax-load-more' => esc_html__( 'Load more', 'narasix' ),
	],
	'default'     => 'default',
] );

/**
 * Single Posts and Pages Section.
 */
Kirki::add_section( $prefix . 'single_section', array(
    'title'          => esc_html__( 'Single Posts and Pages', 'narasix' ),
    'panel'          => $prefix . 'panel',
) );

/* Filler for Single Posts and Pages Section. */
Kirki::add_field( $option_name, [
	'type'        => 'generic',
	'settings'    => $prefix . 'single_section_filler',
	'section'        => $prefix . 'single_section',
	'default'     => '',
	'choices'     => [
		'element'  => 'input',
		'type'     => 'password',
		'style'    => 'display: none;',
	],
] );

/* Single Post Header Section. */
Kirki::add_section( $prefix . 'single_post_section', array(
    'title'          => esc_html__( 'Single Post', 'narasix' ),
    'section'          => $prefix . 'single_section',
) );

Kirki::add_field( $option_name, [
	'type'        => 'select',
	'settings'    => $prefix . 'post_layout',
	'label'       => esc_html__( 'Post layout', 'narasix' ),
	'section'     => $prefix . 'single_post_section',
	'default'     => 'a',
	'choices'     => [
		'a' => esc_html__( 'Layout no Sidebar', 'narasix' ),
		'b' => esc_html__( 'Layout With Sidebar 1', 'narasix' ),
		'c' => esc_html__( 'Layout With Sidebar 2', 'narasix' ),
	],
] );

Kirki::add_field( $option_name, [
	'type'        => 'select',
	'settings'    => $prefix . 'post_sidebar',
	'label'       => esc_attr__( 'Sidebar', 'narasix' ),
	'section'     => $prefix . 'single_post_section',
	'choices'     => narasix_sidebar_list(),
	'default'     => 'nsix-default',
	'active_callback' => [
		[
			'setting'    => $prefix . 'post_layout',
			'operator' => 'contains',
			'value'    => [
				'b',
				'c',
			],
		],
	],
] );

Kirki::add_field( $option_name, [
	'type'        => 'select',
	'settings'    => $prefix . 'single_post_header_style',
	'label'       => esc_html__( 'Single post header layout', 'narasix' ),
	'section'     => $prefix . 'single_post_section',
	'default'     => 'thumbnail-top',
	'choices'     => [
		'thumbnail-top'   => esc_html__( 'Thumbnail top', 'narasix' ),
		'title-top' => esc_html__( 'Title top', 'narasix' ),
		'overlay'  	=> esc_html__( 'Overlay', 'narasix' ),
		'split'  		=> esc_html__( 'Split', 'narasix' ),
		'thumbnail-no' => esc_html__( 'No featured image', 'narasix' ),
	],
] );
Kirki::add_field( $option_name, [
	'type'        => 'dimension',
	'settings'		=> $prefix . 'thumbnail_rounded_single_thumb',
	'label'   		=> esc_html__( 'Thumbnail Rounded', 'narasix' ),
	'section' 		=> $prefix . 'single_post_section',
	'default'     => '',
	'transport'   => 'postMessage',
	'output'      => array(
		array(
				'element'  => '.single-header .wp-post-image, .single-header .js-nsix-lightbox-gallery img, .nsix-gallery-carousel .swiper-slide img',
				'property' => 'border-radius',
				'media_query' => '@media (min-width: 1024px)',
		),
),
] );
Kirki::add_field( $option_name, [
	'type'        	=> 'radio-buttonset',
	'settings'    	=> $prefix . 'single_post_breadcrumb',
	'label'       	=> esc_html__( 'Display breadcrumb', 'narasix' ),
	'section'     	=> $prefix . 'single_post_section',
	'default'     	=> 'no',
	'choices'     	=> [
		'yes'  				=> esc_html__( 'Yes', 'narasix' ),
		'no' 					=> esc_html__( 'No', 'narasix' ),
	],
] );
Kirki::add_field( $option_name, [
	'type'        	=> 'radio-buttonset',
	'settings'    	=> $prefix . 'single_post_header_center',
	'label'       	=> esc_html__( 'Center header', 'narasix' ),
	'section'     	=> $prefix . 'single_post_section',
	'default'     	=> 'no',
	'choices'     	=> [
		'yes'   			=> esc_html__( 'Yes', 'narasix' ),
		'no' 					=> esc_html__( 'No', 'narasix' ),
	],
] );

Kirki::add_field( $option_name, [
	'type'        	=> 'radio-buttonset',
	'settings'    	=> $prefix . 'single_post_excerpt_as_lead',
	'label'       	=> esc_html__( "Display excerpt as div's lead", 'narasix' ),
	'section'     	=> $prefix . 'single_post_section',
	'default'     	=> 'yes',
	'choices'     	=> [
		'yes'   			=> esc_html__( 'Yes', 'narasix' ),
		'no' 					=> esc_html__( 'No', 'narasix' ),
	],
] );

Kirki::add_field( $option_name, [
	'type'        	=> 'radio-buttonset',
	'settings'    	=> $prefix . 'single_post_modified_date_toggle',
	'label'       	=> esc_html__( 'Display updated date', 'narasix' ),
	'section'     	=> $prefix . 'single_post_section',
	'default'     	=> 'no',
	'choices'     	=> [
		'yes'  				=> esc_html__( 'Yes', 'narasix' ),
		'no' 					=> esc_html__( 'No', 'narasix' ),
	],
] );

Kirki::add_field( $option_name, [
	'type'        	=> 'radio-buttonset',
	'settings'    	=> $prefix . 'single_author_box_switch',
	'label'       	=> esc_html__( 'Display author box', 'narasix' ),
	'section'     	=> $prefix . 'single_post_section',
	'default'     	=> 'yes',
	'choices'     	=> [
		'yes'   => esc_html__( 'Yes', 'narasix' ),
		'no' 	=> esc_html__( 'No', 'narasix' ),
	],
] );

Kirki::add_field( $option_name, [
	'type'        	=> 'radio-buttonset',
	'settings'    	=> $prefix . 'single_author_box_info',
	'label'       	=> esc_html__( 'Display author\'s info', 'narasix' ),
	'section'     	=> $prefix . 'single_post_section',
	'default'     	=> 'yes',
	'choices'     	=> [
		'yes'   => esc_html__( 'Yes', 'narasix' ),
		'no' 	=> esc_html__( 'No', 'narasix' ),
	],
] );

/* Single Social Share Section. */
if ( class_exists( 'Narasix_Core' ) ) {
    Kirki::add_section( $prefix . 'single_social_share_section', array(
        'title'         => esc_html__( 'Social share', 'narasix' ),
        'section'       => $prefix . 'single_post_section',
    ) );

    Kirki::add_field( $option_name, [
    	'type'        	=> 'radio-buttonset',
    	'settings'    	=> $prefix . 'single_social_share_switch',
    	'label'       	=> esc_html__( 'Display social share', 'narasix' ),
    	'section'     	=> $prefix . 'single_social_share_section',
    	'default'     	=> 'yes',
    	'choices'     	=> [
    		'yes'   => esc_html__( 'Yes', 'narasix' ),
    		'no' 	=> esc_html__( 'No', 'narasix' ),
    	],
    ] );

    Kirki::add_field( $option_name, [
    	'type'        => 'sortable',
    	'settings'    => $prefix . 'single_social_share_selection',
    	'label'       => esc_html__( 'Enable/disable your social share buttons and arrange their orders:', 'narasix' ),
    	'section'     => $prefix . 'single_social_share_section',
    	'default'     => [
            'facebook',
            'twitter',
            'pinterest',
            'email',
    	],
    	'choices'     => [
    		'whatsapp' 			=> 'whatsapp',
    		'blogger' 			=> 'Blogger',
				'digg' 				=> 'Digg',
				'email' 			=> esc_html__( 'Email', 'narasix' ),
				'evernote' 			=> 'Evernote',
				'getpocket' 		=> 'Pocket',
				'facebook' 			=> 'Facebook',
				'flipboard' 		=> 'Flipboard',
				'gmail' 			=> 'Gmail',
				'instapaper' 		=> 'Instapaper',
				'line.me' 			=> 'LINE',
				'linkedin' 			=> 'LinkedIn',
				'pinterest' 		=> 'Pinterest',
				'reddit' 			=> 'Reddit',
				'skype' 			=> 'Skype',
				'telegram.me' 		=> 'Telegram',
				'tumblr' 			=> 'Tumblr',
				'twitter' 			=> 'Twitter',
				'vk' 				=> 'VK',
				'weibo' 			=> 'Weibo',
				'xing' 				=> 'XING',
				'yahoo' 			=> 'Yahoo',
    	],
    ] );
}

/* Single Related Posts Section. */
Kirki::add_section( $prefix . 'single_related_posts_section', array(
    'title'         => esc_html__( 'Related posts', 'narasix' ),
    'section'       => $prefix . 'single_post_section',
) );

Kirki::add_field( $option_name, [
	'type'        	=> 'radio-buttonset',
	'settings'    	=> $prefix . 'single_related_posts_switch',
	'label'       	=> esc_html__( 'Display related posts', 'narasix' ),
	'section'     	=> $prefix . 'single_related_posts_section',
	'default'     	=> 'yes',
	'choices'     	=> [
		'yes'   => esc_html__( 'Yes', 'narasix' ),
		'no' 	=> esc_html__( 'No', 'narasix' ),
	],
] );

Kirki::add_field( $option_name, [
	'type'     		=> 'text',
	'settings'    	=> $prefix . 'single_related_posts_heading',
	'label'    		=> esc_html__( 'Related posts section\'s heading', 'narasix' ),
	'section'     	=> $prefix . 'single_related_posts_section',
	'default'		=> esc_html__( 'Related posts', 'narasix' ),
] );

Kirki::add_field( $option_name, [
	'type'        	=> 'select',
	'settings'    	=> $prefix . 'single_related_posts_style',
	'label'       	=> esc_attr__( 'Related posts style', 'narasix' ),
	'section'     	=> $prefix . 'single_related_posts_section',
	'default'     	=> 'default',
	'choices'     	=> [
		'default' 					=> esc_html__( 'Default', 'narasix' ),
		'card' 						=> esc_html__( 'Card', 'narasix' ),
		'cover' 				=> esc_html__( 'Cover', 'narasix' ),
	],
] );

Kirki::add_field( $option_name, [
	'type'        	=> 'select',
	'settings'    	=> $prefix . 'single_related_posts_order',
	'label'       	=> esc_attr__( 'Post order', 'narasix' ),
	'section'     	=> $prefix . 'single_related_posts_section',
	'default'     	=> 'date',
	'choices'     	=> [
		'date' 			=> esc_html__( 'Latest', 'narasix' ),
		'rand' 		=> esc_html__( 'Random', 'narasix' ),
	],
] );

/* Single Table of Content Posts Section. */
Kirki::add_section( $prefix . 'single_toc_posts_section', array(
	'title'         => esc_html__( 'Table of Content posts', 'narasix' ),
	'section'       => $prefix . 'single_post_section',
) );

Kirki::add_field( $option_name, [
	'type'        	=> 'radio-buttonset',
	'settings'    	=> $prefix . 'single_toc_posts_switch',
	'label'       	=> esc_html__( 'Display table of content posts', 'narasix' ),
	'section'     	=> $prefix . 'single_toc_posts_section',
	'default'     	=> 'yes',
	'choices'     	=> [
		'yes'   => esc_html__( 'Yes', 'narasix' ),
		'no' 	=> esc_html__( 'No', 'narasix' ),
	],
] );

Kirki::add_field( $option_name, [
	'type'     			=> 'text',
	'settings' 			=> $prefix . 'heading_toc',
	'label'    			=> esc_html__( 'Headline', 'narasix' ),
	'section'  			=> $prefix . 'single_toc_posts_section',
	'default'  			=> esc_html__( 'Table of Content', 'narasix' )
] );

/* Page Section. */
Kirki::add_section( $prefix . 'page_section', array(
	'title'          => esc_html__( 'Page', 'narasix' ),
	'section'          => $prefix . 'single_section',
) );

Kirki::add_field( $option_name, [
'type'        => 'select',
'settings'    => $prefix . 'page_layout',
'label'       => esc_html__( 'Page layout', 'narasix' ),
'section'     => $prefix . 'page_section',
'default'     => 'no-sidebar',
'choices'     => [
	'no-sidebar' => esc_html__( 'Layout no Sidebar', 'narasix' ),
	'with-sidebar' => esc_html__( 'Layout With Sidebar', 'narasix' ),
],
] );

Kirki::add_field( $option_name, [
'type'        => 'select',
'settings'    => $prefix . 'page_sidebar',
'label'       => esc_attr__( 'Sidebar', 'narasix' ),
'section'     => $prefix . 'page_section',
'choices'     => narasix_sidebar_list(),
'default'     => 'nsix-page',
'active_callback' => [
	[
		'setting'    => $prefix . 'page_layout',
		'operator' => 'contains',
		'value'    => [
			'with-sidebar',
		],
	],
],
] );

Kirki::add_field( $option_name, [
'type'        => 'select',
'settings'    => $prefix . 'page_header_style',
'label'       => esc_html__( 'Page header layout', 'narasix' ),
'section'     => $prefix . 'page_section',
'default'     => 'a',
'choices'     => [
	'a'   => esc_html__( 'Style 1', 'narasix' ),
	'b'  	=> esc_html__( 'Style 2', 'narasix' ),
],
] );
Kirki::add_field( $option_name, [
'type'        	=> 'radio-buttonset',
'settings'    	=> $prefix . 'page_breadcrumb',
'label'       	=> esc_html__( 'Display breadcrumb', 'narasix' ),
'section'     	=> $prefix . 'page_section',
'default'     	=> 'no',
'choices'     	=> [
	'yes'  				=> esc_html__( 'Yes', 'narasix' ),
	'no' 					=> esc_html__( 'No', 'narasix' ),
],
] );


/**
 * Social Media Section.
 */
Kirki::add_section( $prefix . 'social_media_sites_section', array(
    'title'          => esc_html__( 'Social Media', 'narasix' ),
    'description'    => esc_html__( 'Enter full URLs of your social media sites below.', 'narasix' ),
    'panel'          => $prefix . 'panel',
) );

Kirki::add_field( $option_name, [
	'type'     => 'link',
	'settings'    => $prefix . 'behance_url',
	'label'    => 'Behance',
	'section'     => $prefix . 'social_media_sites_section',
	'default'  => '',
] );

Kirki::add_field( $option_name, [
	'type'     => 'link',
	'settings'    => $prefix . 'dribbble_url',
	'label'    => 'Dribbble',
	'section'     => $prefix . 'social_media_sites_section',
	'default'  => '',
] );

Kirki::add_field( $option_name, [
	'type'     => 'link',
	'settings'    => $prefix . 'facebook_url',
	'label'    => 'Facebook',
	'section'     => $prefix . 'social_media_sites_section',
	'default'  => '',
] );

Kirki::add_field( $option_name, [
	'type'     => 'link',
	'settings'    => $prefix . 'google_url',
	'label'    => 'Google',
	'section'     => $prefix . 'social_media_sites_section',
	'default'  => '',
] );

Kirki::add_field( $option_name, [
	'type'     => 'link',
	'settings'    => $prefix . 'instagram_url',
	'label'    => 'Instagram',
	'section'     => $prefix . 'social_media_sites_section',
	'default'  => '',
] );

Kirki::add_field( $option_name, [
    'type'     => 'link',
    'settings'    => $prefix . 'line_url',
    'label'    => 'LINE',
    'section'     => $prefix . 'social_media_sites_section',
    'default'  => '',
] );

Kirki::add_field( $option_name, [
	'type'     => 'link',
	'settings'    => $prefix . 'linkedin_url',
	'label'    => 'LinkedIn',
	'section'     => $prefix . 'social_media_sites_section',
	'default'  => '',
] );

Kirki::add_field( $option_name, [
    'type'     => 'link',
    'settings'    => $prefix . 'medium_url',
    'label'    => 'Medium',
    'section'     => $prefix . 'social_media_sites_section',
    'default'  => '',
] );

Kirki::add_field( $option_name, [
	'type'     => 'link',
	'settings'    => $prefix . 'pinterest_url',
	'label'    => 'Pinterest',
	'section'     => $prefix . 'social_media_sites_section',
	'default'  => '',
] );

Kirki::add_field( $option_name, [
    'type'     => 'link',
    'settings'    => $prefix . 'reddit_url',
    'label'    => 'Reddit',
    'section'     => $prefix . 'social_media_sites_section',
    'default'  => '',
] );

Kirki::add_field( $option_name, [
	'type'     => 'link',
	'settings'    => $prefix . 'snapchat_url',
	'label'    => 'Snapchat',
	'section'     => $prefix . 'social_media_sites_section',
	'default'  => '',
] );

Kirki::add_field( $option_name, [
	'type'     => 'link',
	'settings'    => $prefix . 'soundcloud_url',
	'label'    => 'Soundcloud',
	'section'     => $prefix . 'social_media_sites_section',
	'default'  => '',
] );

Kirki::add_field( $option_name, [
	'type'     => 'link',
	'settings'    => $prefix . 'spotify_url',
	'label'    => 'Spotify',
	'section'     => $prefix . 'social_media_sites_section',
	'default'  => '',
] );

Kirki::add_field( $option_name, [
	'type'     => 'link',
	'settings'    => $prefix . 'telegram_url',
	'label'    => 'Telegram',
	'section'     => $prefix . 'social_media_sites_section',
	'default'  => '',
] );

Kirki::add_field( $option_name, [
    'type'     => 'link',
    'settings'    => $prefix . 'tiktok_url',
    'label'    => 'TikTok',
    'section'     => $prefix . 'social_media_sites_section',
    'default'  => '',
] );

Kirki::add_field( $option_name, [
	'type'     => 'link',
	'settings'    => $prefix . 'tumblr_url',
	'label'    => 'Tumblr',
	'section'     => $prefix . 'social_media_sites_section',
	'default'  => '',
] );

Kirki::add_field( $option_name, [
	'type'     => 'link',
	'settings'    => $prefix . 'twitter_url',
	'label'    => 'Twitter',
	'section'     => $prefix . 'social_media_sites_section',
	'default'  => '',
] );

Kirki::add_field( $option_name, [
    'type'     => 'link',
    'settings'    => $prefix . 'viber_url',
    'label'    => 'Viber',
    'section'     => $prefix . 'social_media_sites_section',
    'default'  => '',
] );

Kirki::add_field( $option_name, [
	'type'     => 'link',
	'settings'    => $prefix . 'vk_url',
	'label'    => 'VK',
	'section'     => $prefix . 'social_media_sites_section',
	'default'  => '',
] );

Kirki::add_field( $option_name, [
    'type'     => 'link',
    'settings'    => $prefix . 'wechat_url',
    'label'    => 'WeChat',
    'section'     => $prefix . 'social_media_sites_section',
    'default'  => '',
] );

Kirki::add_field( $option_name, [
    'type'     => 'link',
    'settings'    => $prefix . 'whatsapp_url',
    'label'    => 'WhatsApp',
    'section'     => $prefix . 'social_media_sites_section',
    'default'  => '',
] );

Kirki::add_field( $option_name, [
    'type'     => 'link',
    'settings'    => $prefix . 'xing_url',
    'label'    => 'XING',
    'section'     => $prefix . 'social_media_sites_section',
    'default'  => '',
] );

Kirki::add_field( $option_name, [
	'type'     => 'link',
	'settings'    => $prefix . 'youtube_url',
	'label'    => 'Youtube',
	'section'     => $prefix . 'social_media_sites_section',
	'default'  => '',
] );

Kirki::add_field( $option_name, [
	'type'        => 'sortable',
	'settings'    => $prefix . 'social_media_sites',
	'label'       => esc_html__( 'Enable/disable your social media sites and their orders:', 'narasix' ),
	'section'     => $prefix . 'social_media_sites_section',
	'default'     => [
        'facebook',
        'instagram',
        'twitter',
        'youtube',
	],
	'choices'     => [
		'behance' 		=> 'Behance',
		'dribbble' 		=> 'Dribbble',
		'facebook' 		=> 'Facebook',
		'google' 		=> 'Google+',
		'instagram' 	=> 'Instagram',
		'line'          => 'LINE',
		'linkedin' 		=> 'LinkedIn',
		'medium'        => 'Medium',
		'pinterest' 	=> 'Pinterest',
		'reddit'        => 'Reddit',
		'snapchat' 		=> 'Snapchat',
		'soundcloud' 	=> 'Soundcloud',
		'spotify' 		=> 'Spotify',
		'telegram' 		=> 'Telegram',
		'tiktok'        => 'TikTok',
		'tumblr' 		=> 'Tumblr',
		'twitter' 		=> 'Twitter',
		'viber'         => 'Viber',
		'vk' 			=> 'VK',
		'wechat'        => 'WeChat',
		'whatsapp'      => 'WhatsApp',
		'xing' 		    => 'XING',
		'youtube'       => 'Youtube',
	],
] );

Kirki::add_field( $option_name, [
	'type'        => 'switch',
	'settings'    => $prefix . 'social_media_url_new_tab',
	'label'       => esc_html__( 'Open URLs in a new tab', 'narasix' ),
	'section'     => $prefix . 'social_media_sites_section',
	'default'     => true,
	'choices'     => [
		'on'  => esc_html__( 'On', 'narasix' ),
		'off' => esc_html__( 'Off', 'narasix' ),
	],
] );

Kirki::add_field( $option_name, [
	'type'        => 'switch',
	'settings'    => $prefix . 'social_media_url_nofollow',
	'label'       => esc_html__( 'Add nofollow attribute to URLs', 'narasix' ),
	'section'     => $prefix . 'social_media_sites_section',
	'default'     => true,
	'choices'     => [
		'on'  => esc_html__( 'On', 'narasix' ),
		'off' => esc_html__( 'Off', 'narasix' ),
	],
	'active_callback' => [
		[
			'setting'    => $prefix . 'social_media_url_new_tab',
			'operator' => '==',
			'value'    => true,
		]
	],
] );

/**
 * 404 Page Section.
 */
Kirki::add_section( $prefix . 'page_404_section', array(
    'title'          => esc_html__( '404 Page', 'narasix' ),
    'panel'          => $prefix . 'panel',
) );

Kirki::add_field( $option_name, [
	'type'     => 'text',
	'settings'    => $prefix . 'page_404_title',
	'label'    => esc_html__( 'Title', 'narasix' ),
	'section'     => $prefix . 'page_404_section',
	'default'	=> esc_html__( '404 - Page not found', 'narasix' ),
	'sanitize_callback' => 'wp_kses_post',
] );

Kirki::add_field( $option_name, [
	'type'     => 'textarea',
	'settings'    => $prefix . 'page_404_body_text',
	'label'    => esc_html__( 'Body text', 'narasix' ),
	'section'     => $prefix . 'page_404_section',
	'default'	=> 'The page you were looking for could not be found.<br/> It might have been removed, renamed, or did not exist in the first place.',
	'sanitize_callback' => 'wp_kses_post',
] );

/**
 * Cookie Section.
 */
Kirki::add_section( $prefix . 'cookie_section', array(
	'title'          => esc_html__( 'Cookie', 'narasix' ),
	'panel'          => $prefix . 'panel',
) );

Kirki::add_field( $option_name, [
	'type'        => 'radio-buttonset',
	'settings'    => $prefix . 'cookie_switch',
	'label'       => esc_html__( 'Display Cookie', 'narasix' ),
	'section'     => $prefix . 'cookie_section',
	'default'     => 'yes',
	'choices'     => [
		'yes'   => esc_html__( 'Yes', 'narasix' ),
		'no' 	=> esc_html__( 'No', 'narasix' ),
	],
] );

Kirki::add_field( $option_name, [
	'type'     => 'textarea',
	'settings'    => $prefix . 'cookie_text',
	'label'    => esc_html__( 'Body text', 'narasix' ),
	'section'     => $prefix . 'cookie_section',
	'default'	=> esc_html__( 'We rely on Cookies to Provide Better User Experience', 'narasix' ),
	'sanitize_callback' => 'wp_kses_post',
] );

Kirki::add_field( $option_name, [
	'type'     => 'text',
	'settings'    => $prefix . 'cookie_more',
	'label'    => esc_html__( 'Learn More', 'narasix' ),
	'section'     => $prefix . 'cookie_section',
	'default'	=> esc_html__( 'Learn More', 'narasix' ),
	'sanitize_callback' => 'wp_kses_post',
] );

Kirki::add_field( $option_name, [
	'type'        => 'url',
	'settings'    => $prefix . 'cookie_page',
	'label'       => __( 'Url Page Cookie', 'narasix' ),
	'section'     => $prefix . 'cookie_section',
	'default'     => '',
] );


/**
 * End Panel Setting
 */

/**
 * Ad Setting.
 */

Kirki::add_section( $prefix . 'ad_settings_section', array(
	'title'          => esc_html__( 'Ad Settings', 'narasix' ),
	'panel'          => $prefix . 'panel',
) );

Kirki::add_field( $option_name, [
	'type'     => 'textarea',
	'settings'    => $prefix . 'set_top_ad',
	'label'    => esc_html__( 'Top', 'narasix' ),
	'description' => esc_html__( 'Insert Ad Code', 'narasix' ),
	'section'     => $prefix . 'ad_settings_section',
	'sanitize_callback' => 'wp_kses_post',
] );

Kirki::add_field( $option_name, [
	'type'     => 'textarea',
	'settings'    => $prefix . 'set_bottom_ad',
	'label'    => esc_html__( 'Bottom', 'narasix' ),
	'description' => esc_html__( 'Insert Ad Code', 'narasix' ),
	'section'     => $prefix . 'ad_settings_section',
	'sanitize_callback' => 'wp_kses_post',
] );

Kirki::add_section( $prefix . 'ad_single_settings_section', array(
	'title'          => esc_html__( 'Sinlge Post', 'narasix' ),
	'section'          => $prefix . 'ad_settings_section',
) );

Kirki::add_field( $option_name, [
	'type'        	=> 'radio-buttonset',
	'settings'    	=> $prefix . 'enable_ad_single_post',
	'label'       	=> esc_html__( 'Enable Ads', 'narasix' ),
	'section'     	=> $prefix . 'ad_single_settings_section',
	'default'     	=> 'no',
	'choices'     	=> [
		'yes'   => esc_html__( 'Yes', 'narasix' ),
		'no' 	=> esc_html__( 'No', 'narasix' ),
	],
] );

Kirki::add_field( $option_name, [
	'type'     => 'textarea',
	'settings'    => $prefix . 'set_single_post_ad',
	'label'    => esc_html__( 'Ad Code', 'narasix' ),
	'section'     => $prefix . 'ad_single_settings_section',
	'sanitize_callback' => 'wp_kses_post',
	'active_callback' => [
		[
			'setting'    => $prefix . 'enable_ad_single_post',
			'operator' => '==',
			'value'    => 'yes',
		]
	],
] );

Kirki::add_field( $option_name, [
	'type'     					=> 'text',
	'settings'   				=> $prefix . 'set_position_single_post_ad',
	'label'    					=> esc_html__( 'Insert ad after paragraph', 'narasix' ),
	'section'     			=> $prefix . 'ad_single_settings_section',
	'input_attrs' 			=> array(
		'placeholder' 		=> '1,2,3,4,5,6',
	),
	'active_callback' => [
		[
			'setting'    => $prefix . 'enable_ad_single_post',
			'operator' => '==',
			'value'    => 'yes',
		]
	],
] );