<?php
/**
* Register demo contents to be imported.
*/
function narasix_ocdi_import_files() {
    return [
        [
            'import_file_name'             => 'Narasix Demo',
            'local_import_file'            => trailingslashit( get_template_directory() ) . 'inc/sample-content/demo-content.xml',
            'local_import_widget_file'     => trailingslashit( get_template_directory() ) . 'inc/sample-content/widgets.wie',
            'local_import_customizer_file' => trailingslashit( get_template_directory() ) . 'inc/sample-content/customizer.dat',
      
            'import_preview_image_url'     => '',
            'preview_url'                  => '',
        ],
    ];
}
add_filter( 'ocdi/import_files', 'narasix_ocdi_import_files' );

/**
* Change intro text.
*/
function narasix_ocdi_intro_text( $default_text ) {
    $default_text = '<div class="ocdi__intro-text"><p>' . esc_html__( 'This process will import all demo content (posts, pages, categories, tags, authors, .etc) into your site. If you only want to use the demo homepage layouts with your existing content, please consider importing Elementor Templates following the theme\'s documentation.', 'narasix' ) . '</p><p><strong>' . esc_html__( 'Please make sure you\'ve installed all the required plugins before importing demo content.', 'narasix' ) . '</strong></p></div>';

    return $default_text;
}
add_filter( 'ocdi/plugin_intro_text', 'narasix_ocdi_intro_text' );

/**
* Register required and recommended plugins (we use it for notice for now)
*/
function narasix_ocdi_register_plugins( $plugins ) {
    $theme_plugins = [
        [
            'name'        => 'Self Hosted Plugin',
            'description' => '<div class="ocdi-content-notice ocdi-content-notice--warning"><p style="font-size: 16px; line-height: 22px; color: #444444;">' . esc_html__( 'This process will import all demo content (posts, pages, categories, tags, authors, .etc) into your site. If you only want to use the demo homepage layouts with your existing content, please consider importing Elementor Templates following the theme\'s documentation.', 'narasix' ) . '</p><p style="font-size: 16px; line-height: 22px; color: #444444;"><strong>' . esc_html__( 'Please make sure you\'ve installed all the required plugins before importing demo content.', 'narasix' ) . '<strong></p></div>',
            'slug'        => 'self-hosted-plugin',  // The slug has to match the extracted folder from the zip.
            'source'      => '',
        ],
        [ // A WordPress.org plugin repository example.
            'name'     => 'MC4WP: Mailchimp for WordPress', // Name of the plugin.
            'slug'     => 'mailchimp-for-wp', // Plugin slug - the same as on WordPress.org plugin repository.
            'required' => false,                     // If the plugin is required or not.
        ],
    ];

    return array_merge( $plugins, $theme_plugins );
}
add_filter( 'ocdi/register_plugins', 'narasix_ocdi_register_plugins' );

/**
* Set front page after importing sample content.
*/
function narasix_ocdi_after_import_setup() {
    // Assign menus to their locations.
    $header_menu = get_term_by( 'name', 'Header', 'nav_menu' );
    $footer_menu = get_term_by( 'name', 'Footer', 'nav_menu' );

    set_theme_mod( 'nav_menu_locations', [
            'site-header' => $header_menu->term_id,
            'footer' => $footer_menu->term_id,
        ]
    );

    // Assign front page and posts page (blog page).
    $front_page_id = get_page_by_title( 'Homepage 1' );
    $blog_page_id  = get_page_by_title( 'Archives' );

    update_option( 'show_on_front', 'page' );
    update_option( 'page_on_front', $front_page_id->ID );
    update_option( 'page_for_posts', $blog_page_id->ID );

    // Set a flag if the demo has been imported
    add_option( 'narasix_demo_imported' , true, '', false );

}
add_action( 'ocdi/after_import', 'narasix_ocdi_after_import_setup' );