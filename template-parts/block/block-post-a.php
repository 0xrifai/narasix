<?php
/**
 * Displays Post Block D.
 */

 
if ( !isset( $args ) ) return; // Exit if there's no variables passed.

$settings = $args['settings'];
$query_args = $args['query_args'];

// Merge with default value.
$settings = wp_parse_args( $settings, array(
    'heading' => '',
    'post_meta_author' => 'yes',
    'post_meta_category' => 'yes',
    'post_meta_date' => 'yes',
) );

// Setting up variables.
$section_class = 'section w-full';

$query_args['posts_per_page'] = 8;
$post_query = new WP_Query( $query_args );

if ( $post_query->have_posts() ) {
?>
    <div class="<?php echo esc_attr( $section_class ); ?>">
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

        <div>
            <?php

            while ( $post_query->have_posts() ) {
                $post_query->the_post();

                if ( $post_query->current_post === 0 ) {
                    narasix_get_template_part( 'template-parts/content/content-landscape-extra-large', NULL, 
                      array(
                        'excerpt_length' => $settings['excerpt_length'],
                        'post_meta_author' => $settings['post_meta_author'],
                        'post_meta_date' => $settings['post_meta_date'],
                      )
                    );
                } elseif ( ( $post_query->current_post >= 1 ) && ( $post_query->current_post < 8 ) ) {
                  if ( $post_query->current_post === 1 ) {
                    ?>
                      <div class="mt-6">
                        <div class="swiper-container nsix-carousel nsix-carousel-swiper js-post-carousel-b">
                          <div class="swiper-wrapper">
                            <?php } 
                            ?>
                              <div class="nsix-carousel-item swiper-slide">
                                <?php narasix_get_template_part( 'template-parts/content/content-portrait', NULL, 
                                  array(
                                    'post_meta_author' => $settings['post_meta_author'],
                                    'post_meta_category' => $settings['post_meta_category'],
                                    'post_meta_date' => $settings['post_meta_date'],
                                  )
                              ); ?>
                              </div>
                            <?php 
                                if ( ( $post_query->current_post === ( $post_query->found_posts - 1 ) ) || ( $post_query->current_post === 7 ) ) {
                            ?>
                            
                          </div>
                          <div class="absolute top-0 w-full">
                            <button class="button--prev float-left button relative z-10 -ml-[2px] max-xs:h-[15.45rem] xs:h-[17.45rem] w-14 items-center justify-center bg-gradient-to-r from-charcoal-50 dark:from-charcoal-800" disabled>
                              <?php echo narasix_svg_icon( array( 'icon' => 'nav-prev', 'class' => 'icons-md' ) ) ;?>
                            </button>
                            <button class="button--next float-right button relative z-10 -mr-[2px] max-xs:h-[15.45rem] xs:h-[17.45rem] w-14 items-center justify-center bg-gradient-to-l from-charcoal-50 dark:from-charcoal-800" disabled>
                              <?php echo narasix_svg_icon( array( 'icon' => 'nav-next', 'class' => 'icons-md' ) ) ;?>
                            </button>
                          </div>
                        </div>
                      </div>
                    <?php
                    }
                }
            }
            ?>
        </div>
    </div>
<?php
}

?>