<?php
/**
 * The template for displaying all single posts
 */

// Get options.
$sticky_sidebar = narasix_get_option( 'sticky_sidebar', 'yes' );
$sidebar = narasix_get_option( 'post_sidebar', 'nsix-single' );

$related_posts_switch = narasix_get_option( 'single_related_posts_switch', 'yes' );
$content_layout_width = narasix_get_option( 'content_layout_width', 'default' );

// $post_content_layout = narasix_get_option( 'post_layout', 'default' );

$post_content_layout = narasix_get_meta_box( 'single_post_layout_width' );
if ( !$post_content_layout || ( $post_content_layout === 'global') ) {
	$post_content_layout = narasix_get_option( 'post_layout', 'a' );
}

$single_header_style = narasix_get_meta_box( 'single_post_header_style' );
if ( !$single_header_style || ( $single_header_style === 'global') ) {
	$single_header_style = narasix_get_option( 'single_post_header_style', 'thumbnail-top' );
}

// Setting up variables.
$post_format = get_post_format();
$post_image = NULL;

if ($content_layout_width === 'default' ) {
	$content_class = 'max-w-7xl';
} else {
	$content_class = 'max-w-' . $content_layout_width;
}

if ( ( $single_header_style === 'overlay' ) && ( $post_format !== 'standard' ) ) {
	switch ( $post_format ) {
		case 'audio':
			$post_audio = narasix_get_meta_box( 'post_format_audio_url' );
			// $clasess = 'max-w-screen-lg mx-auto';

			if ( !$post_audio ) {
				$post_audio = narasix_get_meta_box( 'post_format_audio_file' );
			}

			if ( $post_audio ) {
				$single_header_style = 'thumbnail-top';
			}
			break;

		case 'gallery':
			$post_gallery = narasix_get_meta_box( 'post_format_gallery_files' );

			if ( $post_gallery ) {
				$single_header_style = 'thumbnail-top';
			}
			break;

		case 'image':
			$post_image = narasix_get_meta_box( 'post_format_image_file' );
			// $clasess = 'max-w-screen-lg mx-auto';
			if ( $post_image ) {
				if ( ( narasix_img_orientation_check( $post_image['ID'] ) ) ) {
					$single_header_style = 'split';
				} else {
					$single_header_style = 'thumbnail-top';
				}
			}
			break;

		case 'video':
			$post_video = narasix_get_meta_box( 'post_format_video_url' );
			// $clasess = 'max-w-screen-lg mx-auto';
			if ( $post_video ) {
				$single_header_style = 'thumbnail-top';
			}
			break;
	}
}

get_header();
?>
<div id="primary" class="content-single">
	<?php
	/* Start the Loop */
	if ( have_posts() ) {
		while ( have_posts() ) {
			the_post();

				if ($post_content_layout === 'a' ) {
					?>
						<div class="<?php echo esc_attr( $content_class ); ?> single-no-sidebar mx-auto lg:px-16 lg:mt-6">
							<?php
								narasix_get_template_part( 'template-parts/single/header/single-header-' . $single_header_style, NULL );
							?>
							<div class="px-4 mt-6">
								<?php narasix_get_template_part( 'template-parts/single/content'); ?>
							</div>
						</div>
						<?php
							if ( $related_posts_switch === 'yes' ) {
								?>
								<div class="<?php echo esc_attr( $content_class ); ?> mx-auto px-4 lg:px-16">
									<?php narasix_get_template_part( 'template-parts/single/component/related' ); ?>
								</div>
								<?php
								}
							?>

							<?php
							// If comments are open or we have at least one comment, load up the comment template.
							if ( comments_open() || get_comments_number() ) {
							?>
								<div class="<?php echo esc_attr( $content_class ); ?> mx-auto px-4 lg:px-16">
									<?php comments_template(); ?>
								</div>
							<?php
							}
						?>
					<?php
				} elseif ($post_content_layout === 'b') {
					?>
						<div class="<?php echo esc_attr( $content_class ); ?> mx-auto lg:px-16 lg:mt-6">
							<div class="relative grid grid-cols-12 gap-6 mx-auto pb-6">
								<div class="single-with-sidebar flex flex-col col-span-12 lg:col-span-8 lg:h-auto lg:pr-2">
									<?php
										narasix_get_template_part( 'template-parts/single/header/single-header-' . $single_header_style, NULL );
									?>
									<div class="px-4 mt-6">
										<?php narasix_get_template_part( 'template-parts/single/content'); ?>
									</div>
									<div class="max-lg:px-4">
										<?php
											if ( $related_posts_switch === 'yes' ) {
													narasix_get_template_part( 'template-parts/single/component/related' );
												}
											?>

											<?php
											// If comments are open or we have at least one comment, load up the comment template.
											if ( comments_open() || get_comments_number() ) {
											?>
												<div class="<?php echo esc_attr( $content_class ); ?> mx-auto">
													<?php comments_template(); ?>
												</div>
											<?php
											}
										?>
									</div>
								</div>
								<aside class="col-span-12 mt-6 lg:mt-0 max-lg:px-4 flex flex-col lg:col-span-4 sidebar<?php if ( $sticky_sidebar === 'yes' ) { echo ' js-nsix-sticky-sidebar'; } ?>">

									<?php
										if ( is_active_sidebar( $sidebar ) ) {
												dynamic_sidebar( $sidebar );
										}
									?>
								</aside>
							</div>
						</div>
					<?php
				} elseif ($post_content_layout === 'c') { ?>
						<div class="<?php echo esc_attr( $content_class ); ?> single-no-sidebar mx-auto lg:px-16 lg:mt-6">
							<?php
								narasix_get_template_part( 'template-parts/single/header/single-header-' . $single_header_style, NULL );
							?>
							<div class="relative grid grid-cols-12 gap-6 mx-auto pb-6 px-4 mt-6">
								<div class="flex flex-col col-span-12 lg:col-span-8 lg:h-auto">
									<?php get_template_part( 'template-parts/single/content'); ?>
								</div>
								<aside class="col-span-12 mt-6 lg:mt-0 flex flex-col lg:col-span-4 sidebar<?php if ( $sticky_sidebar === 'yes' ) { echo ' js-nsix-sticky-sidebar'; } ?>">
								
									<?php
										if ( is_active_sidebar( $sidebar ) ) {
												dynamic_sidebar( $sidebar );
										}
									?>

								</aside>
							</div>

						</div>

							<?php
							if ( $related_posts_switch === 'yes' ) {
									?>
									<div class="<?php echo esc_attr( $content_class ); ?> mx-auto px-4 lg:px-16">
										<?php get_template_part( 'template-parts/single/component/related' ); ?>
									</div>
									<?php
								}
							?>

							<?php
							// If comments are open or we have at least one comment, load up the comment template.
							if ( comments_open() || get_comments_number() ) {
							?>
								<div class="<?php echo esc_attr( $content_class ); ?> mx-auto px-4 lg:px-16">
									<?php comments_template(); ?>
								</div>
							<?php
							}
						?>
					<?php
				}
				?>
				<?php
    }
	}; // End of the loop.
	?>
</div><!-- #primary -->

<?php get_footer();

