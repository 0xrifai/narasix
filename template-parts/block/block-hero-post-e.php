<?php
/**
 * Displays Hero Post Block E.
 */

if ( !isset( $args ) ) return; // Exit if there's no variables passed.

( isset( $thumb_size ) ) || $thumb_size = 'narasix_sm_4_3';
( isset( $lazyload ) ) || $lazyload = true;

$settings = $args['settings'];
$query_args = $args['query_args'];

$settings = wp_parse_args( $args['settings'], array(
  'post_meta_category' => '',
  'post_meta_author' => '',
  'post_meta_date' => '',
) );

// Setting up variables.
$section_class = 'nsix-section nsix-post-carousel-section block-carousel-e';
$carousel_class = 'relative swiper-container nsix-carousel nsix-carousel-swiper js-post-carousel-b';
$content_layout_width = narasix_get_option( 'content_layout_width', 'default' );

if ($content_layout_width === 'default' ) {
	$content_class = 'max-w-7xl';
} else {
	$content_class = 'max-w-' . $content_layout_width;
}

$post_class_section = array(
	'group',
	'relative',
);

$query_args[ 'posts_per_page' ] = 7;
$hps_query = new WP_Query( $query_args );

if ( $hps_query->have_posts() ) { ?>
	<div class="<?php echo esc_attr( $section_class ); ?>">
    <div class="relative e_text-white">
      <?php
      while ( $hps_query->have_posts() ) {
        $hps_query->the_post();
        $post_link = get_permalink();
        if ( $hps_query->current_post === 0 ) { ?>
        <div class="w-full">
          <div class="h-[26rem] overflow-hidden bg-cover !rounded-none bg-center bg-no-repeat" <?php echo narasix_css_background_img( 'narasix_lg' ); ?>>
            <div class="h-full e_bg-gradient-to-top mt-12"></div>
          </div>
          <div class="e_bg-charcoal-700 space-y-3">
            <div class="<?php echo esc_attr( $content_class ); ?> mx-auto z-10 py-1 px-4 -mb-[6px] lg:px-16">
              <div class="carousel-main my-4">
                <?php if ( $settings['post_meta_category'] ) { 
                    narasix_post_categories_with_background(); 
                } ?>
                <h2 class="font-heading line-clamp-2 mt-2">
                  <a href="<?php echo esc_url( $post_link ); ?>" rel="bookmark"><?php the_title(); ?></a>
                </h2>
                <div class="font-meta w-[12rem] flex space-x-3 opacity-70">
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
					
			<?php
			} elseif ( $hps_query->current_post < 7 ) {
				if ( $hps_query->current_post === 1 ) {
				?>

          <div class="pb-4 e_bg-charcoal-700">
            <div class="<?php echo esc_attr( $content_class ); ?> mx-auto py-1 z-10 px-4 lg:px-16">
              <div class="<?php echo esc_attr( $carousel_class ); ?>">
                <div class="swiper-wrapper">
                  <?php } 
                  ?>
                    <div class="nsix-carousel-item swiper-slide">
                      <?php 
                      narasix_get_template_part( 'template-parts/content/content-portrait', NULL, 
                      array(
                        'post_meta_author' => $settings['post_meta_author'],
                        'post_meta_category' => $settings['post_meta_category'],
                        'post_meta_date' => $settings['post_meta_date'],
                      ) );
                      ?>
                    </div>
                  <?php 
                    if ( ( $hps_query->current_post === 6 ) || ( $hps_query->current_post === ( $hps_query->post_count - 1 ) ) ) {
                  ?>
                  
                </div>
                <div class="absolute top-0 w-full">
                  <button class="button--prev float-left button relative z-10 -ml-[2px] max-xs:h-[15.45rem] xs:h-[17.45rem] w-14 items-center justify-center e_bg-gradient-to-right" disabled>
                    <?php echo narasix_svg_icon( array( 'icon' => 'nav-prev', 'class' => 'icons-md' ) ) ;?>
                  </button>
                  <button class="button--next float-right button relative z-10 -mr-[2px] max-xs:h-[15.45rem] xs:h-[17.45rem] w-14 items-center justify-center e_bg-gradient-to-left" disabled>
                    <?php echo narasix_svg_icon( array( 'icon' => 'nav-next', 'class' => 'icons-md' ) ) ;?>
                  </button>
                </div>
              </div>
            </div>
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
