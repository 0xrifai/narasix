<?php
/**
 * Displays Hero Post Block A.
 */

if ( !isset( $args ) ) return; // Exit if there's no variables passed.

$settings = $args['settings'];
$query_args = $args['query_args'];

// Merge with default value.
$settings = wp_parse_args( $settings, array(
	'post_meta_category' => 'yes',
	'post_meta_date' => 'yes',
	'excerpt_length' => 30,
	'excerpt_length_secondary' => 30,
) );

// Setting up variables.
$section_class = 'hero-post-block';

$query_args[ 'posts_per_page' ] = 3;
$hps_query = new WP_Query( $query_args );

if ( $hps_query->have_posts() ) { ?>
	<div class="<?php echo esc_attr( $section_class ); ?>">
		<div class="grid grid-cols-12 mx-auto items-center">
		<?php
		while ( $hps_query->have_posts() ) {
			$hps_query->the_post();
			if ( $hps_query->current_post === 0 ) {
			?>
				<?php
					$post_link = get_permalink();
					$post_time_attr = get_the_time( 'c' );
					$post_time = get_the_time( get_option( 'date_format' ) );

					$post_class = array(
						'hero-post-a',
						'flex',
						'flex-col',
						'col-span-12',
						'lg:col-span-8',
						'lg:h-auto',
						'lg:mr-6',
					);
					?>
					<div <?php post_class( $post_class ); ?>>
						<div class="group relative max-lg:h-80 overflow-hidden">
							<div class="absolute rounded_b inset-x-0 bottom-0 z-10 flex items-end bg-gradient-to-t from-black/80 to-transparent text-charcoal-100 opacity-0 transition duration-300 ease-in-out group-hover:opacity-100">
								<div class="translate-y-4 transform space-y-1 lg:space-y-3 p-4 pb-10 featured-title-hover text-xl transition duration-[800ms] ease-in-out group-hover:translate-y-0">
									<div class="font-meta inline-flex items-center py-2 space-x-1">
										<?php if ( $settings['post_meta_category'] ) {
												narasix_post_categories_with_background(); 
											}
										?>
										<?php if ( $settings['post_meta_date'] ) { 
											echo '<span class="bg-charcoal-700/60 px-2 rounded-[13px] pb-[3px] text-white text-[14px]">';
											echo '<time class="published" datetime="' . esc_attr( $post_time_attr ) . '"  title="' . esc_attr( $post_time ) . '">' . narasix_human_datetime() . '</time>';
											echo '</span>';
										}
										?>
									</div>
									<!-- Featured Title -->
									<h3 class="font-heading lg:!text-3xl xl:!text-4xl lg:my-4">
										<a href="<?php echo esc_url( $post_link ); ?>" rel="bookmark"><?php the_title(); ?></a>
									</h3>
									<!-- Featured Desciption -->
									<?php
										if( get_the_excerpt() && ( $settings['excerpt_length'] > 0 ) ) {
										?>
											<p class="desciption text-[15px] sm:text-lg opacity-50 line-clamp-2">
												<?php narasix_excerpt( $settings['excerpt_length'], true ); ?>
											</p>
										<?php
										}
									?>
									<?php if ( $settings['readmore_toggle'] ) { 
										?>
											<a href="<?php echo esc_url( $post_link ); ?>" class="btn-animation text-sm inline-flex items-center lg:py-2">
												<span><?php echo wp_kses_post( $settings['read_more_url'] ) ?></span>
												<?php echo narasix_svg_icon( array( 'icon' => 'arrow-right', 'class' => 'icons-last icons-xs' ) ) ;?>
											</a>
										<?php
									}
									?>
								</div>
							</div>
							<!-- Featured image -->
							<?php
							narasix_featured_img( array(
								'size' => 'narasix_sm_4_3',
								'class' => 'relative aspect-squares h-full post-hero-a',
							) );
							?>
						</div>
					</div>
			<?php
			} elseif ( $hps_query->current_post < 3 ) {
				if ( $hps_query->current_post === 1 ) {
				?>
					<div class="flex flex-col col-span-12 divide-y m-auto lg:col-span-4 dark:divide-charcoal-700">
						<?php }
							$post_link = get_permalink();
							$post_time_attr = get_the_time( 'c' );
							$post_time = get_the_time( get_option( 'date_format' ) );
						?>
						<div class="py-2 space-y-2">
							<div class="font-meta inline-flex items-center py-2 space-x-1">
								<?php if ( $settings['post_meta_category'] ) {
										narasix_post_categories_with_background(); 
									}
								?>
								<?php if ( $settings['post_meta_date'] ) { 
			
										echo '<span class="bg-charcoal-700/60 px-2 rounded-[13px] pb-[3px] text-white text-[14px]">';
										echo '<time class="published" datetime="' . esc_attr( $post_time_attr ) . '"  title="' . esc_attr( $post_time ) . '">' . narasix_human_datetime() . '</time>';
										echo '</span>';
								}
								?>
							</div>
							<h3 class="font-heading secondary lg:!text-xl line-clamp-2">
								<a href="<?php echo esc_url( $post_link ); ?>" rel="bookmark"><?php the_title(); ?></a>
							</h3>
							<?php
								if( get_the_excerpt() && ( $settings['excerpt_length_secondary'] > 0 ) ) {
								?>
									<p class="desciption secondary text-[15px] sm:text-lg opacity-50 line-clamp-2">
										<?php narasix_excerpt( $settings['excerpt_length_secondary'], true ); ?>
									</p>
								<?php
								}
							?>
							<?php if ( $settings['readmore_toggle'] ) { 
								?>
									<a href="<?php echo esc_url( $post_link ); ?>" class="btn-animation secondary text-sm inline-flex items-center lg:py-2">
										<span><?php echo wp_kses_post( $settings['read_more_url'] ) ?></span>
										<?php echo narasix_svg_icon( array( 'icon' => 'arrow-right', 'class' => 'icons-last icons-xs' ) ) ;?>
									</a>
								<?php
							}
							?>
						</div>
						<?php
						if ( ( $hps_query->current_post === 3 ) || ( $hps_query->current_post === ( $hps_query->post_count - 1 ) ) ) {
						?>
					</div>
					
				<?php
				}
			} else {
				break;
			}
		}

		// Reset postdata
		wp_reset_postdata();
		?>
		</div>
	</div>
<?php
}
