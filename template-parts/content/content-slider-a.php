<?php
if ( isset( $template_args ) ) {
	extract( $template_args ); // extract passed variables.
}

$content_layout_width = narasix_get_option( 'content_layout_width', 'default' );

// Setting default values.
( isset( $post_class ) ) || $post_class = array();
( isset( $thumb_size ) ) || $thumb_size = 'narasix_lg_16_9';
( isset( $excerpt_length ) ) || $excerpt_length = 40;

if ($content_layout_width === 'default' ) {
	$content_class = 'lg:px-[9.5rem]'; 
} else {
	$content_class = 'lg:px-[1.5rem]';
}

$post_class = array(
  'post-item',
	'relative',
	'w-full',
  'carousel-item',
	'mr-4'
);
$classes = array(
  'lg:h-[80vh]',
  'h-[50vh]',
	'w-full',
  'rounded-lg',
  'bg-cover',
  'bg-center',
  'bg-no-repeat',
);
$post_link =  get_permalink();

?>
<div <?php post_class( $post_class ); ?>>
	<div <?php post_class( $classes ); ?> <?php echo narasix_css_background_img( $thumb_size ); ?>>
		<div class="absolute bottom-4 w-full mx-auto px-4 <?php echo esc_attr( $content_class ); ?> sm:bottom-[1.5rem]">
			<div class="p-4 space-y-2 bg-charcoal-100/50 text-charcoal-900 dark:bg-charcoal-700/50 dark:text-charcoal-100 backdrop-blur-md sm:p-6">
				
				<?php narasix_post_categories_with_background(); ?>
				
				<h3 class="font-heading !text-2xl sm:!text-3xl line-clamp-2">
					<a href="<?php echo esc_url( $post_link ); ?>" rel="bookmark"><?php the_title(); ?></a>
				</h3>
				<?php
					if( get_the_excerpt() && ( $excerpt_length > 0 ) ) {
						?>
							<p class="text-limit opacity-50">
								<?php narasix_excerpt( $excerpt_length, true ); ?>
							</p>
						<?php
					}
				?>
				<div class="font-meta meta-scroll mt-2 flex overflow-x-auto items-center justify-between border-t pt-2 text-[14px]">
					<?php
						narasix_post_meta( array(
							'meta_categories' => 'no',
						) );
					?>
				</div>
			</div>
		</div>
	</div>
</div>

