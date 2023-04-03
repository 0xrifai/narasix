<?php
/**
 * Displays Post Carousel A.
 */

if ( !isset( $args ) ) return; // Exit if there's no variables passed.

$settings = $args['settings'];
$query_args = $args['query_args'];

// Merge with default value.
$settings = wp_parse_args( $settings, array(
    'items_per_view' => '4',
    'thumb_style' => 'default',
    'post_meta_category' => '',
    'post_meta_author' => '',
    'post_meta_date' => '',
) );

$post_template_args = array(
	'post_meta_category' => $settings['post_meta_category'],
	'post_meta_author' => $settings['post_meta_author'],
	'post_meta_date' => $settings['post_meta_date'],
);

// Setting up variables.
$section_class = 'nsix-section nsix-post-carousel-section post-carousel-a';
$section_class .= ' nsix-post-carousel-post-' . $settings['post_style'];

if ( $settings['overflow'] === 'yes' ) {
	$section_class .= ' nsix-post-carousel-overflow';
}

$carousel_class = 'swiper-container nsix-carousel nsix-carousel-swiper js-post-carousel-a';
$carousel_class .= ' nsix-carousel-post-' . $settings['post_style'];

switch ( $settings['post_style'] ) {
	default:
	case 'card':
		$post_template = 'card';

		if ( $settings['thumb_style'] === 'default' ) {
			$post_template_args['thumb_size'] = 'narasix_sm_4_3';
		}

		break;

	case 'cover':
		$post_template = 'cover';

		if ( $settings['thumb_style'] === 'default' ) {
			$post_template_args['thumb_size'] = 'narasix_sm_4_5';
		}

		break;

	case 'portrait':
		$post_template = 'portrait';

		if ( $settings['thumb_style'] === 'default' ) {
			$post_template_args['thumb_size'] = 'narasix_sm_4_3';
		}

		break;
}

$post_query = new WP_Query( $query_args );

if ( $post_query->have_posts() ) { ?>

	<div class="<?php echo esc_attr( $section_class ); ?>">
		<div class="relative">
			<div class="i_nav flex justify-between items-center mb-4 md:mb-6">
				<?php
					if ( $settings['heading'] ) {
				?>
				<div class="border-l-8 pl-3">
					<h4 class="meta-title-block">
						<?php echo wp_kses_post( $settings['heading'] ); ?>
					</h4>

					<?php
						if ( $settings['subheading'] ) {
							echo '<span class="text-base opacity-60">';
							echo wp_kses_post( $settings['subheading'] );
							echo '</span>';
						}
					?>
				</div>
				<?php
				}
				?>

        <div class="inline-flex items-center">
          <div class="nsix-carousel-prev-btn cursor-pointer"><?php echo narasix_svg_icon( array( 'icon' => 'arrow-left', 'class' => 'icons-md' ) ) ;?></div>
          <div class="nsix-carousel-next-btn cursor-pointer"><?php echo narasix_svg_icon( array( 'icon' => 'arrow-right', 'class' => 'icons-md' ) ) ;?></div>
        </div>
			</div>

			<div class="<?php echo esc_attr( $carousel_class ); ?>">
				<div class="swiper-wrapper">
					<?php
					while ( $post_query->have_posts() ) {
					$post_query->the_post();
					echo '<div class="nsix-carousel-item swiper-slide">';
					narasix_get_template_part( 'template-parts/content/content-' . $post_template, NULL, $post_template_args );
					echo '</div>';
					}
					// Reset postdata
					wp_reset_postdata();
					?>
				</div>

				<div class="nsix-carousel-hidden-pagination"></div>
			</div>
		</div>
	</div>
	
<?php
}