<?php
/**
 * Display single post header no thumbnail.
 */

if ( isset( $args ) ) extract( $args ); // extract passed variables.

// Get options.
$single_header_center = narasix_get_meta_box( 'post_header_center' );
if ( !$single_header_center || ( $single_header_center === 'global') ) {
	$single_header_center = narasix_get_option( 'single_post_header_center', 'no' );
}

$excerpt_as_lead = narasix_get_meta_box( 'post_header_excerpt_as_lead' );
if ( !$excerpt_as_lead || ( $excerpt_as_lead === 'global') ) {
	$excerpt_as_lead = narasix_get_option( 'single_post_excerpt_as_lead', 'yes' );
}

$single_post_breadcrumb = narasix_get_option( 'single_post_breadcrumb', 'no' );
$content_layout_width = narasix_get_option( 'content_layout_width', 'default' );

// Setting up variables.
$header_class = 'single-post-header';
$thumb_size = 'narasix_md_4_3';
$post_time_attr = get_the_time( 'c' );
$post_time = get_the_time( get_option( 'date_format' ) );

if ( $single_header_center === 'yes' ) {
	$header_class .= ' sm:text-center';
}

if ( has_post_thumbnail() ) {
	$header_class .= '';
}

if ($content_layout_width === 'default' ) {
	$header_class = 'max-w-7xl';
} else {
	$header_class = 'max-w-' . $content_layout_width;
}

?>
<header class="single-header">
	<div class="post-meta relative space-y-3 <?php echo esc_attr( $header_class ); ?> mx-auto mt-4 px-4">
		<?php
		if ( $single_post_breadcrumb === 'yes' ) { 
				narasix_breadcrumb(); ?>
			<?php }
		?>

		<div class="font-meta text-sm opacity-50 w-full overflow-x-auto">
			<?php narasix_post_categories_single(); ?>
		</div>

		<?php
		the_title( '<h1 class="font-heading sm:text-2xl md:text-3xl lg:text-4xl">', '</h1>' );
		?>

		<?php
		if ( has_excerpt() && ( $excerpt_as_lead === 'yes' ) ) {
		?>
			<div class="text-limit opacity-50 text-base font-serif tracking-wide">
				<?php the_excerpt(); ?>
			</div>
		<?php
		}
		?>

		<?php
		if ( !is_page() ) {
		?>
			<div class="flex flex-wrap items-center justify-between border-y mt-4 py-4">
				<div class="font-meta inline-flex w-[70%] items-center">
					<span class="inline-flex items-center space-x-3 whitespace-nowrap dots">
						<span class="author-avatar">
							<?php echo get_avatar( get_the_author_meta( 'ID' ), '32', '', esc_html__( 'avatar', 'narasix' ) ); ?>
						</span>
						<?php the_author_posts_link(); ?>
					</span>
					<div class="inline-flex items-center flex-nowrap overflow-x-auto meta-scroll md:w-full">
						<?php 
								echo '<span class="whitespace-nowrap dots">';
                echo '<time class="published" datetime="' . esc_attr( $post_time_attr ) . '"  title="' . esc_attr( $post_time ) . '">' . narasix_human_datetime() . '</time>';
                echo '</span>';
							?>
						<?php
						$display_modified_date = narasix_get_option( 'single_post_modified_date_toggle', 'no' );
						if ( $display_modified_date === 'yes' ) {
							$post_modified_date_format = get_the_modified_date( get_option( 'date_format' ) );
							$post_modified_time = get_the_modified_time( 'U' );
							$post_modified_time_attr = get_the_modified_time( 'c' );
							$post_published_time = get_the_time( 'U' );
							// Display modified time if enabled
							if ( ( $post_modified_time !== $post_published_time ) && ( $post_modified_time > $post_published_time - ( 60 * 60 * 24 ) ) ) { ?>
							<time class="updated whitespace-nowrap" datetime="<?php echo esc_attr( $post_modified_time_attr ); ?>" title="<?php echo esc_attr( $post_modified_date_format ); ?>">
								<?php echo narasix_human_modified_datetime(); ?>
							</time>
							<?php }
						}
						?>
					</div>
				</div>

				<div class="inline-flex items-center">
					<div class="inline-flex items-center">
						<?php 
						if ( function_exists('wpp_get_views') ) {
							$post_views = wpp_get_views( get_the_ID() );
							if ( $post_views > 0 ) { ?>
								<div class="inline-flex items-center space-x-1 cursor-none select-none lines">
									<span><?php echo esc_html( $post_views ); ?></span>
									<?php echo narasix_svg_icon( [ 'icon' => 'eye', 'class' => 'icons-md' ] ); ?>
								</div>
							<?php
							}
						}
						?>
						<button class="modal-open" data-modal="#sharemodal">
						<?php echo narasix_svg_icon( [ 'icon' => 'share', 'class' => 'icons-md' ] ); ?>
						</button>
					</div>
				</div>
			</div>
		<?php
		}
		?>
	</div>
</header>