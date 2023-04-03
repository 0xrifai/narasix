<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 */

// Get theme options.
$post_listing_args = narasix_get_post_listing_args();
$sidebar = narasix_get_option( 'blog_sidebar', 'nsix-default' );
$sticky_sidebar = narasix_get_option( 'sticky_sidebar', 'yes' );
$content_layout_width = narasix_get_option( 'content_layout_width', 'default' );
$header_style = narasix_get_option( 'archive_header_style', 'a' );

// Setting up variables
$section_class = 'section w-full post-listing-section-' . $post_listing_args['post_layout'];

if ($content_layout_width === 'default' ) {
	$content_class = 'max-w-7xl';
} else {
	$content_class = 'max-w-' . $content_layout_width;
}

get_header();

?>

<div id="primary" class="content-area">

<?php	
	if ( have_posts() ) {
	    if ( in_array( $post_listing_args['post_layout'], array( 'list-landscape', 'mixed-a', 'mixed-b', 'grid-portrait', 'masonry-portrait' ) ) ) {
		?>

			<div class="<?php echo esc_attr( $content_class ); ?> mx-auto px-4 lg:px-16">
				<?php 
					if ( is_home() ) {
						get_template_part( 'template-parts/page/header/page-header-a' );
					} else {
						get_template_part( 'template-parts/page/header/page-header-' . $header_style );
					}
				?>
				<div class="relative grid grid-cols-12 gap-6 mx-auto">
					<main class="flex flex-col col-span-12 lg:col-span-8 lg:h-auto">
						<section class="<?php echo esc_attr( $section_class ); ?>">
							<?php
								narasix_post_listing( $post_listing_args );
							?>
						</section>
					</main><!-- #main -->

					<aside class="col-span-12 mt-6 lg:mt-0 flex flex-col lg:col-span-4 sidebar<?php if ( $sticky_sidebar === 'yes' ) { echo ' js-nsix-sticky-sidebar'; } ?>">
							<?php
							if ( $sticky_sidebar === 'yes' ) {
								echo '<div class="theiaStickySidebar">';
							}

							if ( is_active_sidebar( $sidebar ) ) {
									dynamic_sidebar( $sidebar );
							} elseif ( current_user_can( 'administrator' ) ) {
								global $wp_registered_sidebars;
								$sidebar_name = $wp_registered_sidebars[$sidebar]['name'];
								echo '<p style="padding: 32px;background-color:#f5f5f5;">';
								printf(
									/* translators: 1: sidebar's name */
								esc_html__( 'Place widgets in %1$s widget area to make them appear here', 'narasix' ), $sidebar_name
								);
								echo '</p>';
							}

							if ( $sticky_sidebar === 'yes' ) {
								echo '</div>';
							}
							?>
					</aside>
				</div>
			</div>
    <?php
	} else { ?>
	
		<div class="<?php echo esc_attr( $section_class ); ?>">
			<div class="<?php echo esc_attr( $content_class ); ?> mx-auto px-4 lg:px-16">
				<?php get_template_part( 'template-parts/page/header/page-header-' . $header_style ); ?>

				<main>
					<?php narasix_post_listing( $post_listing_args ); ?>
				</main>

			</div>
		</div>
    <?php
		}
	}
	?>

</div><!-- #primary -->

<?php
get_footer();