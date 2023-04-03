<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 */

// Get options.
$hide_header = narasix_get_meta_box( 'page_header_hide', NULL, 'no' );
if ( $hide_header !== 'yes' ) {
	$page_header_style = narasix_get_option( 'page_header_style', 'a' );
}
$sticky_sidebar = narasix_get_option( 'sticky_sidebar', 'yes' );
$sidebar = narasix_get_option( 'page_sidebar', 'nsix-page' );
$page_content_layout = narasix_get_option( 'page_layout', 'no-sidebar' );
$content_layout_width = narasix_get_option( 'content_layout_width', 'default' );

if ($content_layout_width === 'default' ) {
	$content_class = 'max-w-7xl';
} else {
	$content_class = 'max-w-' . $content_layout_width;
}

get_header();
?>
<div id="primary" class="content-area">
	<?php
	/* Start the Loop */
	if ( have_posts() ) {
		while ( have_posts() ) {
			the_post();

			if ($page_content_layout === 'no-sidebar' ) {
				?>
				<main class="<?php echo esc_attr( $content_class ); ?> mx-auto px-4 lg:px-16">
					<?php
					if ( $hide_header !== 'yes' ) {
						get_template_part( 'template-parts/page/header/page-header-' . $page_header_style );
					}
					?>
					<?php get_template_part( 'template-parts/page/content'); ?>
				</main>
				<?php
			} else {
				?>
				<div class="<?php echo esc_attr( $content_class ); ?> mx-auto px-4 lg:px-16">
					<?php
						if ( $hide_header !== 'yes' ) {
							get_template_part( 'template-parts/page/header/page-header-' . $page_header_style );
						}
					?>
					<div class="relative grid grid-cols-12 gap-6 mx-auto">
						<main class="flex flex-col col-span-12 lg:col-span-8 lg:h-auto">
							<?php get_template_part( 'template-parts/page/content'); ?>
						</main>
						<aside class="col-span-12 mt-6 lg:mt-0 flex flex-col lg:col-span-4 sidebar<?php if ( $sticky_sidebar === 'yes' ) { echo ' js-nsix-sticky-sidebar'; } ?>">
							<?php narasix_ads_code( 'sidebar_ad' ); ?>
							<?php
								if ( is_active_sidebar( $sidebar ) ) {
										dynamic_sidebar( $sidebar );
								}
							?>
						</aside>
					</div>
				</div>
				<?php
			}

		}
	}; // End of the loop.
	?>
</div><!-- #primary -->

<?php get_footer();