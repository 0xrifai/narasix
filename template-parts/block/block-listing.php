<?php
/**
 * Displays Post Listing section.
 */

if ( !isset( $args ) ) return; // Exit if there's no variables passed.

$settings = $args['settings'];
$query_args = $args['query_args'];
$sticky_sidebar = narasix_get_option( 'sticky_sidebar', 'yes' );

// Merge with default value.
$settings = wp_parse_args( $settings, array(
	'post_layout' => 'list-landscape',
  'grid_columns' => 4,
  'grid_columns_mobile' => 1,
  'post_format_icon' => 'no',
	'pagination' => 'default',
	'view_more_url' => '',
	'view-more-url-title' => '',
) );

// Setting up variables.
$post_listing_args = array(
    'ignore_sticky_posts' => 'yes',
    'post_layout' => $settings['post_layout'],
    'grid_columns' => $settings['grid_columns'],
    'grid_columns_mobile' => $settings['grid_columns_mobile'],
    'post_format_icon' => $settings['post_format_icon'],
    'pagination' => $settings['pagination'],
);

if ( $settings['excerpt_length_toggle'] === 'yes' ) {
    $post_listing_args['excerpt_length'] = $settings['excerpt_length'];
}

if ( $settings['pagination'] === 'view-more-url' ) {
    $post_listing_args['view_more_url'] = $settings['view_more_url'];
    $post_listing_args['view_more_url_title'] = $settings['view_more_url_title'];
}

// Get current page.
if ( get_query_var( 'paged' ) ) {
    $paged = get_query_var( 'paged' );
} elseif ( get_query_var( 'page' ) ) {
    $paged = get_query_var( 'page' );
} else {
    $paged = 1;
}

// Calculate offset if not the first page.
if ( $paged > 1 ) {
    $query_args['offset'] += ( $paged - 1 ) * $query_args[ 'posts_per_page' ];
}

$post_listing_args['query'] = $query_args;

$query_string = build_query( $query_args ); // Build query string for AJAX load posts.

$post_query = new \WP_Query( $query_args );

$post_listing_args['post_query'] = $post_query;

$section_class = 'block-listing-section-' . $settings['post_layout'];
$section_content_class = 'post-listing-content';

if ( $post_query->have_posts() ) {
    if ( in_array( $post_listing_args['post_layout'], array( 'list-landscape', 'grid-portrait', 'masonry-portrait' ) ) ) {
    ?>
    <div class="relative grid grid-cols-12 gap-6 mx-auto">
      <main class="flex flex-col col-span-12 lg:col-span-8 lg:h-auto">
        <div class="<?php echo esc_attr( $section_class ); ?>">
          <div class="content">
            <?php
              if ( $settings['heading'] ) {
            ?>
            <div class="border-l-8 pl-3 my-4 md:mb-6 md:my-0">
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
              }
            ?>
          </div>
          <?php
            narasix_post_listing( $post_listing_args );
          ?>
        </div>
      </main>

      <aside class="col-span-12 mt-6 lg:mt-0 flex flex-col lg:col-span-4 sidebar <?php if ( $sticky_sidebar === 'yes' ) { echo ' js-nsix-sticky-sidebar'; } ?>">
        <?php
          if ( $sticky_sidebar === 'yes' ) {
            echo '<div class="theiaStickySidebar">';
          }

          if ( is_active_sidebar( $settings['sidebar'] ) ) {
            dynamic_sidebar( $settings['sidebar'] );
          }

          if ( $sticky_sidebar === 'yes' ) {
            echo '</div>';
          }
        ?>
      </aside>
    </div>
    <?php
    } else { ?>
      <div class="<?php echo esc_attr( $section_class ); ?>">
        <div class="nsix-section-inner">
            <?php
              if ( $settings['heading'] ) {
              ?>
                <div class="border-l-8 pl-3 my-4 md:mb-6 md:my-0">
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
              }
            ?>

            <?php
            narasix_post_listing( $post_listing_args );
            ?>
        </div>
      </div>
    <?php
    }
}