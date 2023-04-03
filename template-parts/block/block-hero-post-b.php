<?php
/**
 * Displays Hero Post Block B.
 */

if ( !isset( $args ) ) return; // Exit if there's no variables passed.

$settings = $args['settings'];
$query_args = $args['query_args'];

// Merge with default value.
$settings = wp_parse_args( $settings, array(
	'post_meta_author' => 'yes',
	'post_meta_category' => 'yes',
	'post_meta_date' => 'yes',
) );

// Setting up variables.
$section_class = 'hero-post-block';

$query_args[ 'posts_per_page' ] = 5;
$hps_query = new WP_Query( $query_args );

if ( $hps_query->have_posts() ) { ?>
	<div class="<?php echo esc_attr( $section_class ); ?>">
		<div class="mx-auto grid grid-cols-12">
		<?php
		while ( $hps_query->have_posts() ) {
			$hps_query->the_post();
			if ( $hps_query->current_post === 0 ) {
					
						$post_link = get_permalink();
						$post_time_attr = get_the_time( 'c' );
						$post_time = get_the_time( get_option( 'date_format' ) );

						$post_class = array(
							'hero-post-b',
							'flex',
							'flex-col',
							'col-span-12',
							'lg:col-span-8',
							'lg:h-auto',
							'lg:mr-6',
						);
					?>
					<div <?php post_class( $post_class ); ?>>
						<?php narasix_get_template_part( 'template-parts/content/content-cover-large', NULL, 
								array(
									'post_meta_author' => $settings['post_meta_author'],
									'post_meta_category' => $settings['post_meta_category'],
									'post_meta_date' => $settings['post_meta_date'],
								)
						); ?>
					</div>
			<?php
			} elseif ( $hps_query->current_post < 5 ) {
				if ( $hps_query->current_post === 1 ) {
				?>
					<div class="flex flex-col col-span-12 divide-y max-lg:mt-4 lg:col-span-4">
						<?php }
							$post_link = get_permalink();
							$post_time_attr = get_the_time( 'c' );
							$post_time = get_the_time( get_option( 'date_format' ) );
						?>
						<div class="first:pt-0 last:pb-0 py-3">
							<div class="font-meta secondary flex items-center justify-between">
								<?php if ( $settings['post_meta_category'] ) {
											narasix_post_categories();
										}
									?>
									<?php if ( $settings['post_meta_date'] ) { 
										echo '<time class="published" datetime="' . esc_attr( $post_time_attr ) . '"  title="' . esc_attr( $post_time ) . '">' . narasix_human_datetime() . '</time>';
									}
								?>
							</div>
							<h3 class="font-heading secondary lg:!text-xl line-clamp-2">
								<a href="<?php echo esc_url( $post_link ); ?>" rel="bookmark"><?php the_title(); ?></a>
							</h3>
						</div>
						<?php
						if ( ( $hps_query->current_post === 4 ) || ( $hps_query->current_post === ( $hps_query->post_count - 1 ) ) ) {
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
