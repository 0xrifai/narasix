<?php
/**
 * Register ACF fields.
 */
if ( ! function_exists( 'nsix_register_acf_fields' ) ) {
	function nsix_register_acf_fields() {

		// Post format
		acf_add_local_field_group( array(
			'key' => 'group_nsix_post_format_audio',
			'title' => esc_html__( 'Post format: Audio', 'narasix' ),
			'fields' => array(
				array(
					'key' => 'field_nsix_post_format_audio_url',
					'label' => esc_html__( 'Audio URL to embed. You can find all the supported sites here:', 'narasix' ) . ' <a href="https://wordpress.org/support/div/embeds/">https://wordpress.org/support/div/embeds/</a>',
					'name' => 'audio_url',
					'type' => 'oembed',
					'width' => '1920',
					'height' => '1080',
				),
				array(
					'key' => 'field_nsix_post_format_audio_file',
					'label' => esc_html__( 'Or you can upload your own audio file:', 'narasix' ),
					'name' => 'audio_file',
					'type' => 'file',
					'return_format' => 'array',
					'library' => 'all',
					'max_size' => 64,
					'mime_types' => 'aac, mid, midi, mp3, oga, opus, wav, weba',
				)
			),
			'location' => array(
				array(
					array(
						'param' => 'post_format',
						'operator' => '==',
						'value' => 'audio',
					),
				),
			),
		) );

		acf_add_local_field_group( array(
			'key' => 'group_nsix_post_format_video',
			'title' => esc_html__( 'Post format: Video', 'narasix' ),
			'fields' => array(
				array(
					'key' => 'field_nsix_post_format_video_url',
					'label' => esc_html__( 'Video URL', 'narasix' ),
					'name' => 'video_url',
					'type' => 'oembed',
					'width' => '1920',
					'height' => '1080',
				)
			),
			'location' => array(
				array(
					array(
						'param' => 'post_format',
						'operator' => '==',
						'value' => 'video',
					),
				),
			),
		) );

		acf_add_local_field_group( array(
			'key' => 'group_nsix_post_format_gallery',
			'title' => esc_html__( 'Post format: Gallery', 'narasix' ),
			'fields' => array(
				array(
					'key' => 'field_nsix_post_format_gallery_files',
					'label' => esc_html__( 'Gallery', 'narasix' ),
					'name' => 'gallery_files',
					'type' => 'gallery',
				)
			),
			'location' => array(
				array(
					array(
						'param' => 'post_format',
						'operator' => '==',
						'value' => 'gallery',
					),
				),
			),
		) );

		acf_add_local_field_group( array(
			'key' => 'group_nsix_post_format_image',
			'title' => esc_html__( 'Post format: Image', 'narasix' ),
			'fields' => array(
				array(
					'key' => 'field_nsix_post_format_image_file',
					'label' => esc_html__( 'Image', 'narasix' ),
					'name' => 'image_file',
					'type' => 'image',
				)
			),
			'location' => array(
				array(
					array(
						'param' => 'post_format',
						'operator' => '==',
						'value' => 'image',
					),
				),
			),
		) );

		// Post options
		acf_add_local_field_group( array(
			'key' => 'group_nsix_post_options',
			'title' => esc_html__( 'Narasix\'s settings', 'narasix' ),
			'fields' => array(
				array(
					'key' => 'field_nsix_single_post_layout_width',
					'label' => esc_html__( 'Post layout\'s width', 'narasix' ),
					'name' => 'single_post_layout_width',
					'type' => 'select',
					'choices' => array(
						'global'   => esc_html__( 'Global setting', 'narasix' ),
						'a'   => esc_html__( 'Layout no Sidebar', 'narasix' ),
						'b' => esc_html__( 'Layout With Sidebar 1', 'narasix' ),
						'c' => esc_html__( 'Layout With Sidebar 2', 'narasix' ),
					),
					'default_value' => 'global',
				),
				array(
					'key' => 'field_nsix_single_post_header_style',
					'label' => esc_html__( 'Post header layout', 'narasix' ),
					'name' => 'single_post_header_style',
					'type' => 'select',
					'choices' => array(
						'global'   => esc_html__( 'Global setting', 'narasix' ),
						'thumbnail-top'   => esc_html__( 'Thumbnail Top', 'narasix' ),
						'title-top' => esc_html__( 'Title top', 'narasix' ),
						'overlay'  => esc_html__( 'Overlay', 'narasix' ),
						'split'  => esc_html__( 'Split', 'narasix' ),
						'thumbnail-no'  => esc_html__( 'No featured image', 'narasix' ),
					),
					'default_value' => 'global',
				),

				array(
					'key' => 'field_nsix_post_header_center',
					'label' => esc_html__( 'Center header', 'narasix' ),
					'name' => 'post_header_center',
					'type' => 'select',
					'choices' => array(
						'global'   => esc_html__( 'Global setting', 'narasix' ),
						'yes'   => esc_html__( 'Yes', 'narasix' ),
						'no'   => esc_html__( 'No', 'narasix' ),
					),
					'default_value' => 'global',
					'conditional_logic' => array(
						array(
							array(
								'field' => 'field_nsix_post_header_layout',
								'operator' => '!=',
								'value' => 'overlay',
							),
							array(
								'field' => 'field_nsix_post_header_layout',
								'operator' => '!=',
								'value' => 'split',
							),
							array(
								'field' => 'field_nsix_post_header_layout',
								'operator' => '!=',
								'value' => 'no-featured-image',
							),
						),
					),
				),
				
				array(
					'key' => 'field_nsix_post_header_excerpt_as_lead',
					'label' => esc_html__( "Display excerpt", 'narasix' ),
					'name' => 'post_header_excerpt_as_lead',
					'type' => 'select',
					'choices' => array(
						'global'   => esc_html__( 'Global setting', 'narasix' ),
						'yes'   => esc_html__( 'Yes', 'narasix' ),
						'no'   => esc_html__( 'No', 'narasix' ),
					),
					'default_value' => 'global',
				),

				array(
					'key' => 'field_nsix_post_table_of_content',
					'label' => esc_html__( "Display Table of Content", 'narasix' ),
					'name' => 'post_table_of_content',
					'type' => 'select',
					'choices' => array(
						'global'   => esc_html__( 'Global setting', 'narasix' ),
						'yes'   => esc_html__( 'Yes', 'narasix' ),
						'no'   => esc_html__( 'No', 'narasix' ),
					),
					'default_value' => 'global',
				),

			),

			'location' => array(
				array(
					array(
						'param' => 'post_type',
						'operator' => '==',
						'value' => 'post',
					),
				),
			),
			'position' => 'side',
		) );

		// Page options
		acf_add_local_field_group( array(
			'key' => 'group_nsix_page_options',
			'title' => esc_html__( 'Narasix\'s settings', 'narasix' ),
			'fields' => array(	
				array(
					'key' => 'field_nsix_page_header_hide',
					'label' => esc_html__( 'Hide page header', 'narasix' ),
					'name' => 'page_header_hide',
					'type' => 'button_group',
					'choices' => array(
						'yes'   => esc_html__( 'Yes', 'narasix' ),
						'no'   => esc_html__( 'No', 'narasix' ),
					),
					'default_value' => 'no',
				),
			),
			'location' => array(
				array(
					array(
						'param' => 'post_type',
						'operator' => '==',
						'value' => 'page',
					),
				),
			),
			'position' => 'side',
		) );

		// Category Colors
		acf_add_local_field_group( array(
			'key' => 'group_nsix_category',
			'title' => esc_html__( 'Narasix\'s setting', 'narasix' ),
			'fields' => array(
				array(
					'key' => 'field_nsix_category_color',
					'label' => 'Category Color',
					'name' => 'category_color',
					'type' => 'color_picker',
				)
				),
				

			'location' => array(
				array(
					array(
						'param' => 'taxonomy',
						'operator' => '==',
						'value' => 'category',
					),
				),
			),
		) );

		// User Profile Options
		acf_add_local_field_group(array(
			'key' => 'group_profile_social_media',
			'title' => 'Social Media',
			'fields' => array(
				array(
					'key' => 'field_profile_facebook',
					'label' => 'Facebook',
					'name' => 'facebook',
					'type' => 'text',
				),
				array(
					'key' => 'field_profile_twitter',
					'label' => 'Twitter',
					'name' => 'twitter',
					'type' => 'text',
				),
				array(
					'key' => 'field_profile_instagram',
					'label' => 'Instagram',
					'name' => 'instagram',
					'type' => 'text',
				),
				array(
					'key' => 'field_profile_github',
					'label' => 'Github',
					'name' => 'github',
					'type' => 'text',
				),
				array(
					'key' => 'field_profile_linkedin',
					'label' => 'Linkedin',
					'name' => 'linkedin',
					'type' => 'text',
				),
			),
			'location' => array(
				array(
					array(
						'param' => 'user_role',
						'operator' => '==',
						'value' => 'all',
					),
				),
			),
		));

	}
	add_action('acf/init', 'nsix_register_acf_fields');
}