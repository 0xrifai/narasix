<?php
/**
 * Displays Hero Post Block F.
 */

if ( !isset( $args ) ) return; // Exit if there's no variables passed.

// Setting default values.
( isset( $post_class ) ) || $post_class = array();
( isset( $thumb_size ) ) || $thumb_size = 'narasix_lg_16_9';

$settings = $args['settings'];
$query_args = $args['query_args'];

// Merge with default value.
$settings = wp_parse_args( $settings, array(
	'excerpt_length' => 30,
	'post_meta_author' => 'yes',
	'post_meta_date' => 'yes',
) );

$section_class = 'js-hero-post-slider-f mx-auto relative z-[1] hero-post-f';

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
  'bg-cover',
  'bg-center',
  'bg-no-repeat',
);

$hps_query = new WP_Query( $query_args );

if ( $hps_query->have_posts() ) { ?>
	<div class="<?php echo esc_attr( $section_class ); ?>">
		<div class="swiper-wrapper">
			<?php
			while ( $hps_query->have_posts() ) {
					$hps_query->the_post();
					$post_link = get_permalink();
					$post_time_attr = get_the_time( 'c' );
					$post_time = get_the_time( get_option( 'date_format' ) );
				?>
				<div class="swiper-slide nsix-hero-post-item">
					<div <?php post_class( $post_class ); ?>>
						<div <?php post_class( $classes ); ?> <?php echo narasix_css_background_img( $thumb_size ); ?>>
							<div class="absolute bottom-4 w-full mx-auto px-4 sm:bottom-[1.5rem]">
								<div class="p-4 rounded_box space-y-2 bg-charcoal-100/50 text-charcoal-900 dark:bg-charcoal-700/50 dark:text-charcoal-100 backdrop-blur-md sm:p-6">

									<?php if ( $settings['post_meta_category'] ) {	
										 narasix_post_categories_with_background(); 
									} ?>
									<h3 class="font-heading !text-2xl sm:!text-3xl line-clamp-2">
										<a href="<?php echo esc_url( $post_link ); ?>" rel="bookmark"><?php the_title(); ?></a>
									</h3>
									<?php
										if( get_the_excerpt() && ( $settings['excerpt_length'] > 0 ) ) {
										?>
											<p class="desciption text-limit opacity-50">
												<?php narasix_excerpt( $settings['excerpt_length'], true ); ?>
											</p>
										<?php
										}
									?>
									<div class="font-meta meta-scroll mt-2 flex overflow-x-auto items-center justify-between border-t pt-2 text-[14px]">
										<?php
											narasix_post_meta( array(
												'meta_categories' => 'no',
												'meta_author' => $settings['post_meta_author'],
												'meta_date' => $settings['post_meta_date'],
											) );
										?>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<?php
			}
			// Reset postdata
			wp_reset_postdata();
			?>
		</div>
	</div>
	
<?php
}