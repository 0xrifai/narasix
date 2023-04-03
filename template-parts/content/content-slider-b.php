<?php
if ( isset( $args ) ) extract( $args ); // extract passed variables.

// Setting default values if variables not set.
( isset( $kenburns_class ) ) || $kenburns_class = 'kenburns';
( isset( $thumb_size ) ) || $thumb_size = 'narasix_lg';
( isset( $excerpt_length ) ) || $excerpt_length = 20;

$content_layout_width = narasix_get_option( 'content_layout_width', 'default' );
$post_time_attr = get_the_time( 'c' );
$post_time = get_the_time( get_option( 'date_format' ) );
$post_format = get_post_format();

$classes = array(
	'post-item',
	'slider-item',
	'relative',
);

if ($content_layout_width === 'default' ) {
	$content_class = 'lg:px-[12rem]'; 
} else {
	$content_class = 'lg:px-[4rem]';
}

$post_link =  get_permalink();

?>
<div <?php post_class( $classes ); ?>>
<div class="absolute bg-charcoal-700/50 w-full h-full z-[1]"></div>
	<div class="background-object background-object-cover<?php echo esc_attr( $kenburns_class ); ?>"<?php echo narasix_css_background_img( $thumb_size ); ?>>
		<div class="background-overlay"></div>
	</div>
	<div class="slider-item-inner text-charcoal-100 flex items-end bottom-[5rem] sm:bottom-[7rem] z-10">
		<div class="w-full px-4 space-y-3 <?php echo esc_attr( $content_class ); ?>">
			
			<div class="inline-flex items-center text-sm">
				<span class="font-meta inline-flex items-center space-x-2">
					<span class="author-avatar">
						<?php echo get_avatar( get_the_author_meta( 'ID' ), '32', '', esc_html__( 'avatar', 'narasix' ) ); ?>
					</span>
					<?php the_author_posts_link(); ?>
				</span>
				<span class="py-[1.1px] px-[1px] mx-[9px] rounded-full bg-charcoal-100"></span>

					<?php 
						$post_meta_category = get_option( 'post_meta_category' );
						if( $post_meta_category == 'yes' ) {
								narasix_post_categories();
						}
					?>


			</div> <!-- meta -->

			<h3 class="font-heading !text-2xl sm:!text-3xl">
				<a href="<?php echo esc_url( $post_link ); ?>"><?php the_title(); ?></a>
			</h3>
			<?php
				if( get_the_excerpt() && ( $excerpt_length > 0 ) ) {
				?>
					<p class="line-clamp-2 opacity-50">
						<?php narasix_excerpt( $excerpt_length, true ); ?>
					</p>
				<?php
				}
			?>
		</div>
	</div>
</div>