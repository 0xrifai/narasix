<?php
/**
 * Displays Full Width Slider G
 */

if ( !isset( $args ) ) return; // Exit if there's no variables passed.

$settings = $args['settings'];
$query_args = $args['query_args'];

// Merge with default value.
$settings = wp_parse_args( $settings, array(
	'excerpt_length' => 30,
	'post_meta_author' => 'yes',
	'post_meta_category' => 'yes',
	'post_meta_date' => 'yes',
) );

$content_layout_width = narasix_get_option( 'content_layout_width', 'default' );
if ($content_layout_width === 'default' ) {
	$content_class = 'max-w-7xl mx-auto px-4 lg:px-16'; 
} else {
	$content_class = 'max-w-full mx-auto px-4 lg:px-16';
}

$classes = array(
	'post-item',
	'slider-item',
	'relative',
);

$slider_class = 'relative w-full';

if ( $settings['autoplay'] === 'yes' ) {
	$settings['autoplay'] = true;
} else {
	$settings['autoplay'] = false;
}

$hps_query = new WP_Query( $query_args );

if ( $hps_query->have_posts() ) { ?>
	<div class="<?php echo esc_attr( $slider_class ); ?>">

		<div class="slider-inner js-hero-post-slider-g" data-autoplay="<?php echo esc_attr( var_export( $settings['autoplay'], true ) ); ?>" data-speed="<?php echo esc_attr( $settings['autoplay_speed'] ); ?>">
			<?php
			while ( $hps_query->have_posts() ) {
				$hps_query->the_post();
				$post_link = get_permalink();
				$post_time_attr = get_the_time( 'c' );
				$post_time = get_the_time( get_option( 'date_format' ) );
				if ( $settings['kenburns'] === 'yes' ) {
					// set kenburns direction based on curent_post.
					if ( $hps_query->current_post % 2) {
						$kenburns_class = ' kenburns-reverse';
					} else {
						$kenburns_class = ' kenburns';
					}
				} else {
					$kenburns_class = '';
				}

				?>
					<div <?php post_class( $classes ); ?>>
						<div class="absolute bg-charcoal-700/50 w-full h-full z-[1]"></div>
							<div class="background-object background-object-cover<?php echo esc_attr( $kenburns_class ); ?>"<?php echo narasix_css_background_img( 'narasix_lg' ); ?>>
								<div class="background-overlay"></div>
							</div>
							<div class="slider-item-inner text-charcoal-100 flex items-end bottom-[6rem] sm:bottom-[10rem] z-10">
								<div class="w-full px-4 space-y-3 <?php echo esc_attr( $content_class ); ?>">
										<div class="inline-flex items-center text-sm">
											<span class="font-meta inline-flex items-center space-x-2">
												<?php
													narasix_post_meta( array(
														'meta_categories' => $settings['post_meta_category'],
														'meta_author' => $settings['post_meta_author'],
														'meta_date' => $settings['post_meta_date'],
													) );
												?>
											</span>
										</div>
									<h3 class="font-heading !text-2xl sm:!text-3xl">
										<a href="<?php echo esc_url( $post_link ); ?>"><?php the_title(); ?></a>
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
								</div>
							</div>
						</div>
				<?php
			}

			// Reset postdata
			wp_reset_postdata();
			?>
		</div>

		<?php
		if ( $hps_query->post_count > 1 ) { ?>
		<div class="slider-navigation absolute bottom-0 left-0 right-0 backdrop-blur js-hero-post-slider-nav">
			<div class="<?php echo esc_attr( $content_class ); ?>">
				<div class="flex">

					<?php
					while ( $hps_query->have_posts() ) {
						$hps_query->the_post(); ?>

						<div class="slider-navigation-item<?php if ( $hps_query->current_post === 0 ) echo ' is-active'; ?>">
							<div class="numb text-charcoal-100">
								<div class="text-center sm:text-left"><?php echo sprintf( '%02d.', $hps_query->current_post + 1 ); ?></div>
								<h5 class="hidden lg:block"><?php the_title(); ?></h5>
							</div>
						</div>

					<?php
					}

					// Reset postdata
					wp_reset_postdata();
					?>
				</div>
			</div>
		</div>

		<?php
		} ?>

	</div>
<?php
}