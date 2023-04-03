<?php
if ( isset( $args ) ) extract( $args ); // extract passed variables.

$settings = $args['settings'];
$query_args = $args['query_args'];

$settings = wp_parse_args( $settings, array(
  'heading' => '',
  'post_meta_author' => 'yes',
  'post_meta_category' => 'yes',
  'post_meta_date' => 'yes',
  'excerpt_length' => 30,
) );

$query_args['posts_per_page'] = 4;
$post_query = new WP_Query( $query_args );
if ( $post_query->have_posts() ) {
  ?>

  <section class="w-full h-auto">
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
    <div class="swiper-containers">
      <div class="swiper-block_post_d w-full h-auto ml-auto mr-auto relative overflow-hidden z-[1]">
        <div class="swiper-wrapper">
          <?php
            while ( $post_query->have_posts() ) {
              $post_query->the_post();
              if ( $post_query->current_post ) { ?>
              <div class="swiper-slide text-center text-lg w-full flex flex-shrink-0 h-full relative">
                <div class="swiper-slide__block w-full h-full text-left">
                  <div class="lg:max-w-[735px] w-full lg:w-[65%] lg:max-h-[476px] lg:h-[476px] rounded_box overflow-hidden relative" data-swiper-parallax-y="90%">
                    <?php
                      narasix_featured_img( array(
                        'size' => 'narasix_sm',
                      ) );
                    ?>
                  </div>
                  <div class="swiper-slide__block__text w-full p-4 sm:p-6 md:p-8 lg:w-2/5 h-full lg:max-w-[400px] lg:max-h-[476px] relative lg:absolute bg-transparent top-0 right-0 lg:mt-0 lg:pr-6 lg:p-0">
                    <h2 class="font-heading relative z-10 text-xl font-semibold uppercase lg:text-2xl lg:mt-[100px]">
                        <a href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark"><?php the_title(); ?></a>
                    </h2>
                    <?php if ( $settings['post_meta_category'] ) {
                        narasix_post_categories(); 
                      } 
                    ?>
                    <?php
                      if( get_the_excerpt() && ( $settings['excerpt_length'] > 0 ) ) {
                      ?>
                        <p class="descripiton my-5 text-base opacity-60 md:text-lg">
                          <?php narasix_excerpt( $settings['excerpt_length'], true ); ?>
                        </p>
                      <?php
                      }
                    ?>
                    <span class="font-meta relative flex justify-between items-center text-[14px] z-10 border-t pt-2">
                      <?php
                        narasix_post_meta( array(
                          'meta_categories' => 'no',
                          'meta_author' => $settings['post_meta_author'],
                          'meta_date' => $settings['post_meta_date'],
                        ) );
                      ?>
                    </span>
                  </div>
                </div>
              </div>
              <?php
              }
            }
          ?>
        </div>
        <div class="button-next w-12 h-12 bg-charcoal-200/60 lg:bg-charcoal-700/20 lg:dark:bg-charcoal-100/20 cursor-pointer absolute z-[2] top-0 right-0 mt-0 flex justify-center lg:right-[300px]">
          <?php echo narasix_svg_icon( array( 'icon' => 'nav-next', 'class' => 'icons-md' ) ) ;?>
        </div>
        <div class="button-prev w-12 h-12 bg-charcoal-200/60 lg:bg-charcoal-700/20 lg:dark:bg-charcoal-100/20 cursor-pointer absolute z-[2] top-0 left-0 mt-0 flex justify-center">
          <?php echo narasix_svg_icon( array( 'icon' => 'nav-prev', 'class' => 'icons-md' ) ) ;?>
        </div>
      </div>
    </div>
  </section>
    
  <?php
}
?>