<?php
/**
 * Displays Post Carousel B.
 */

if ( !isset( $args ) ) return; // Exit if there's no variables passed.

$settings = $args['settings'];
$query_args = $args['query_args'];

// Merge with default value.
$settings = wp_parse_args( $settings, array(
    'heading' => '',
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

$carousel_class = 'swiper-container nsix-carousel nsix-carousel-swiper js-post-carousel-b';
$carousel_class .= ' nsix-carousel-post-' . $settings['post_style'];

switch ( $settings['post_style'] ) {
	default:
	case 'card':
		$post_template = 'card';
    $item_class = 'card';

		if ( $settings['thumb_style'] === 'default' ) {
			$post_template_args['thumb_size'] = 'narasix_sm_4_3';
		}

		break;

	case 'cover':
		$post_template = 'cover';
    $item_class = 'cover';

		if ( $settings['thumb_style'] === 'default' ) {
			$post_template_args['thumb_size'] = 'narasix_sm_4_5';
		}

		break;

	case 'portrait':
		$post_template = 'portrait';
    $item_class = 'portrait';

		if ( $settings['thumb_style'] === 'default' ) {
			$post_template_args['thumb_size'] = 'narasix_sm_4_3';
		}
		break;
}

$post_query = new WP_Query( $query_args );

if ( $post_query->have_posts() ) { ?>

	<div class="<?php echo esc_attr( $section_class ); ?>">
		<div class="relative <?php echo esc_attr( $item_class ); ?>">
      <?php
        if ( $settings['heading'] ) {
        ?>
          <div class="flex justify-between items-center mb-4 md:mb-6">
            <div class="border-l-8 pl-3">
              <h4 class="meta-title-block">
                <?php
                  echo wp_kses_post( $settings['heading'] );

                if ( $paged > 1) {
                  esc_html_e( ' - Page ', 'narasix' );
                  echo esc_html( $paged );
                }
                ?>
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
            if ( $settings['heading_url']['url'] && $settings['heading_url_text'] ) {
            ?>
            <div>
                <a class="nsix-section-heading-view-more btn-animation" href="<?php echo esc_url( $settings['heading_url']['url'] ); ?>"<?php
                    if( $settings['heading_url']['is_external'] ) {
                        if( $settings['heading_url']['nofollow'] ) {
                            echo ' target="_blank" rel="noopener noreferrer nofollow"';
                        } else {
                            echo ' target="_blank" rel="noopener noreferrer"';
                        }
                    } ?>>
                    <?php
                    echo '<span class="-mt-[2px]">';
                    echo wp_kses_post( $settings['heading_url_text'] );
                    echo '</span>';
                    echo narasix_svg_icon( array( 'icon' => 'arrow-right', 'class' => 'icons-last icons-xs' ) );
                    ?>
                </a>
              </div>
            <?php
            }
            ?>
        </div>
        <?php
        }
      ?>

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

        <div class="absolute top-0 w-full">
          <button class="button--prev float-left button relative z-10 -ml-[2px] w-14 items-center justify-center bg-gradient-to-r from-charcoal-50 dark:from-charcoal-800" disabled>
            <?php echo narasix_svg_icon( array( 'icon' => 'nav-prev', 'class' => 'icons-md' ) ) ;?>
          </button>
          <button class="button--next float-right button relative z-10 -mr-[2px] w-14 items-center justify-center bg-gradient-to-l from-charcoal-50 dark:from-charcoal-800" disabled>
            <?php echo narasix_svg_icon( array( 'icon' => 'nav-next', 'class' => 'icons-md' ) ) ;?>
          </button>
        </div>

			</div>
		</div>
	</div>
	
<?php
}