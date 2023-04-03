<?php
/**
 * Displays Hero Post Block B.
 */

if ( !isset( $args ) ) return; // Exit if there's no variables passed.

( isset( $post_class ) ) || $post_class = array();
( isset( $thumb_size ) ) || $thumb_size = 'narasix_xs_4_5';

$settings = $args['settings'];
$query_args = $args['query_args'];

// Merge with default value.
$settings = wp_parse_args( $settings, array(
	'post_meta_author' => 'yes',
	'post_meta_category' => 'yes',
	'post_meta_date' => 'yes',
) );

// Setting up variables.
$section_class = 'hero-post-block-c';

$query_args[ 'posts_per_page' ] = 5;
$hps_query = new WP_Query( $query_args );

if ( $hps_query->have_posts() ) { ?>
	<div class="<?php echo esc_attr( $section_class ); ?>">
		<div class="mx-auto grid grid-cols-12">
		<?php
		while ( $hps_query->have_posts() ) {
			$hps_query->the_post();
			if ( $hps_query->current_post === 0 ) {

				echo '<div class="relative flex flex-none grow  flex-col col-span-12 lg:col-span-8 lg:h-auto lg:mr-4 max-lg:mb-4">';
				narasix_get_template_part( 'template-parts/content/content-cover-large', NULL, 
				array(
					'post_meta_author' => $settings['post_meta_author'],
					'post_meta_category' => $settings['post_meta_category'],
					'post_meta_date' => $settings['post_meta_date'],
				) );
				echo '</div>';

			} elseif ( $hps_query->current_post < 5 ) {
				if ( $hps_query->current_post === 1 ) {

					echo '<div class="flex flex-col col-span-12 lg:col-span-4">'; }
					echo '<div class="first:pt-0 last:pb-0 py-2">';
					$post_link =  get_permalink();
					$post_class = array_merge( $post_class, array(
						'group',
						'hero-content-small',
						'flex',
						'items-center',
						'justify-between',
					) );

					?>

					<div <?php post_class( $post_class ); ?>>
						
						<div class="relative overflow-hidden">
							<?php
								narasix_featured_img( array(
									'size' => $thumb_size,
									'class' => 'thumbnail',
								) );
							?>
						</div>
						<div class="flex flex-col ml-2 w-4/5">
							
							<?php if ( $settings['post_meta_category'] ) {
									narasix_post_categories(); 
								}
							?>
							<h3 class="font-heading secondary line-clamp-2">
								<a href="<?php echo esc_url( $post_link ); ?>" rel="bookmark"><?php the_title(); ?></a>
							</h3>
							<div class="font-meta meta-scroll flex justify-between overflow-x-auto text-[14px] border-t secondary mt-1 pt-1">
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
					<?php
					echo '</div>';
					if ( ( $hps_query->current_post === 4 ) || ( $hps_query->current_post === ( $hps_query->post_count - 1 ) ) ) {
					echo '</div>';

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
