<?php
/**
 * The template for displaying all single posts
 */

// Get options.
$auto_header_layout = narasix_get_option( 'single_post_auto_header_style', 'yes' );
$single_header_layout = narasix_get_option( 'single_post_header_style', 'default' );
$social_share_switch = narasix_get_option( 'single_social_share_switch', 'yes' );
$content_layout_width = narasix_get_option( 'content_layout_width', 'default' );
$page_header_style = narasix_get_option( 'page_header_style', 'a' );

// Setting up variables.
$post_url =  get_permalink();
$post_format = get_post_format();
$post_gallery = NULL;
$post_image = NULL;
$post_video = NULL;

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
			?>

			<div class="<?php echo esc_attr( $content_class ); ?> mx-auto px-4 lg:px-16">
				<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<?php
						get_template_part( 'template-parts/page/header/page-header-' . $page_header_style );
					?>

					<div class="nsix-section">
						<div class="flex flex-col items-center w-full">
							
							<div>
								<?php
								if ( wp_attachment_is_image() ) {
									echo wp_get_attachment_image( get_the_id(), 'narasix_sm', false,  array( 'class' => 'wp-post-image' ) );
								}
								else {
									echo '<a href="' . wp_get_attachment_url() . '">' . basename( get_attached_file( get_the_id() ) ) . '</a>';
								}
								?>
							</div>
							

							<?php
							if ( wp_attachment_is_image() ) {
							?>
								<div class="mt-6">
									<?php
										echo esc_html__( 'Download', 'narasix' ) . ': ';
										$images = array();
										$image_sizes = array(
											'narasix_sm',
											'narasix_md',
											'narasix_lg',
											'narasix_xl',
											'full',
										);
										foreach( $image_sizes as $image_size ) {
											$image = wp_get_attachment_image_src( get_the_ID(), $image_size );
											$image_size_name = '';
											switch ( $image_size ) {
												case 'narasix_sm':
													$image_size_name = 'small';
													break;

												case 'narasix_md':
													$image_size_name = 'medium';
													break;

												case 'narasix_lg':
													$image_size_name = 'large';
													break;

												case 'narasix_xl':
													$image_size_name = 'very large';
													break;

												default:
													$image_size_name = 'full';
													break;
											}
											$name = $image_size_name . ' (' . $image[1] . 'x' . $image[2] . ')';
											$images[] = '<a href="' . $image[0] . '">' . $name . '</a>';
										}

										echo implode( ' | ', $images );
									?>
								</div>
							<?php
							}
							?>
						</div>

						<?php
							if ( ( $social_share_switch === 'yes' ) && ( class_exists( 'Narasix_Core' ) ) ) {
							?>
									<ul class="inline-flex list-none w-full space-x-3 justify-center items-center mt-6">
										<?php
										Narasix_Core::post_social_share( [
											'url' => $post_url,
											'title' => get_the_title(),
											'image' => get_the_post_thumbnail( 'narasix_sm' ),
											'desc' => get_the_excerpt(),
										] );
										?>
									</ul>
							<?php
							}
						?>
					</div>
				</div>

				<?php
					// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) {
					?>
						<div class="nsix-section nsix-section-fullwidth post-comments-section">
							<div class="container-post-body">
								<?php comments_template(); ?>
							</div>
						</div>
					<?php
					} 
				?>
			</div>

			<?php
		}
	}; // End of the loop.
	?>
</div><!-- #primary -->

<?php get_footer();