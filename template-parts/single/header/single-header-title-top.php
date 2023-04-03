<?php
/**
 * Display single post header: Title Top.
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
$post_format = get_post_format();
$post_audio = NULL;
$post_gallery = NULL;
$post_image = NULL;
$post_video = NULL;


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

switch ( $post_format ) {
	case 'audio':
		$post_audio = narasix_get_meta_box( 'post_format_audio_url' );
		if ( $post_audio ) {
			$post_audio_is_embed = true;
		} else {
			$post_audio_is_embed = false;
			$post_audio = narasix_get_meta_box( 'post_format_audio_file' );
		}
		break;

	case 'gallery':
		$post_gallery = narasix_get_meta_box( 'post_format_gallery_files' );
		break;

	case 'image':
		$post_image = narasix_get_meta_box( 'post_format_image_file' );
		break;

	case 'video':
		$post_video = narasix_get_meta_box( 'post_format_video_url' );
		break;
}
?>
<header class="single-header">
	<div class="post-meta relative space-y-3 <?php echo esc_attr( $header_class ); ?> mx-auto mt-4 max-lg:px-4">
		<?php
		if ( $single_post_breadcrumb === 'yes' ) { 
				narasix_breadcrumb(); ?>
			<?php }
		?>

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
			<div class="flex flex-wrap items-center justify-between border-t mt-4 py-4">
				<div class="inline-flex w-[70%] items-center">
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

	<?php
	if ( $post_audio ) {
		?>
			<div class="relative">
				<?php
					if ( $post_audio_is_embed ) {
						echo '<div class="aspect-media w-full">' . $post_audio . '</div>';
					} else {
						$post_audio_url = '';
						$post_audio_title = '';
						if ( array_key_exists( 'url', $post_audio ) ) {
							$post_audio_url = $post_audio['url'];
						}
						if ( array_key_exists( 'title', $post_audio ) ) {
							$post_audio_title = $post_audio['title'];
						}
				?>
				<?php
					narasix_featured_img( array(
						'size' => $thumb_size,
						'link'=> false,
					) );
				?>

					<div class="single-post-media-audio-button">
						<audio controls>
							<source src="<?php echo esc_url( $post_audio_url ); ?>">
						</audio>
					</div>
				<?php
				}
				?>
			</div>
		<?php
	} elseif ( $post_gallery ) {
		?>
			<div class="overflow-x-hidden">
					<div class="single-format-gallery nsix-gallery-carousel js-nsix-gallery-carousel swiper-container">
						<div class="swiper-wrapper js-nsix-lightbox-gallery" itemscope itemtype="http://schema.org/ImageGallery">
								<?php
								foreach( $post_gallery as $image ) {
									echo '<figure class="swiper-slide" itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject">';
										echo '<a href="' . esc_url( $image['url'] ) . '" itemprop="contentUrl" data-size="' . esc_attr( $image['width'] ) . 'x' . esc_attr( $image['height'] ) . '">';
												echo wp_get_attachment_image(  $image['ID'], 'narasix_lg', false, array( 'itemprop' => 'thumbnail') );
								echo '</a>';

								if ( $image[ 'caption' ] !== '' ) {
									echo '<figcaption itemprop="caption description" class="absolute bottom-0 ml-4 mb-4 px-3 py-2 backdrop-blur text-white text-sm text-left font-serif">' . $image[ 'caption' ] . '</figcaption>';
								}
							echo '</figure>';
							}
							?>
						</div>
						<div class="swiper-scrollbar"></div>
					</div>
			</div>
		<?php
	} elseif ( $post_image ) {
		?>
			<div class="relative js-nsix-lightbox-gallery" itemscope itemtype="http://schema.org/ImageGallery">
						<?php
						echo '<figure itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject">';
						echo '<a href="' . esc_url( $post_image['url'] ) . '" itemprop="contentUrl" data-size="' . esc_attr( $post_image['width'] ) . 'x' . esc_attr( $post_image['height'] ) . '">';
						echo wp_get_attachment_image(  $post_image['ID'], 'narasix_md_4_3', false, array( 'itemprop' => 'thumbnail') );
						echo '</a>';

					if ( $post_image[ 'caption' ] !== '' ) {
						echo '<figcaption itemprop="caption description" class="absolute bottom-0 ml-4 mb-4 px-3 py-2 backdrop-blur text-white text-sm text-left font-serif">' . $post_image[ 'caption' ] . '</figcaption>';
					}
						echo '</figure>';
					?>
			</div>
		<?php
	} elseif ( $post_video ) {
		?>
			<?php echo '<div class="aspect-media w-full">' . $post_video . '</div>'; ?>
		<?php
	} elseif ( has_post_thumbnail() ) {
		?>
			<?php
				echo '<div class="aspect-w-s aspect-w-16 max-lg:aspect-h-9">';
					narasix_featured_img( array(
						'size' => $thumb_size,
						'link'=> false,
					) );
				echo '</div>';
			?>
		<?php
	}
	?>
</header>