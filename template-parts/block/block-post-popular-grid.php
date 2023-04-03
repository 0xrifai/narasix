<?php
/**
 * Displays Post Popular.
 */

if ( !isset( $args ) ) return; // Exit if there's no variables passed.

$settings = $args['settings'];
$query_args = $args['query_args'];

// Merge with default value.
$settings = wp_parse_args( $args['settings'], array(
  'post_style' => 'default',
  'thumb_style' => 'default',
  'post_meta_author' => 'yes',
	'post_meta_category' => 'yes',
	'post_meta_date' => 'yes',
  'posts_per_page' => 5,
) );


// Setting up variables.
$section_class = 'section post-popular';
$section_class .= ' post-block-post-style-' . $settings['post_style'];

$section_content_class = 'grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 md:gap-5';

switch ( $settings['post_style'] ) {
	case 'portrait':
	default:
        $grid_item_class = 'col-span-1';
        $post_template = 'portrait';
        $template_args['thumb_size'] = 'narasix_sm_4_3';
		break;

	case 'card':
        $grid_item_class = 'col-span-1';
        $post_template = 'card';
		    $template_args['thumb_size'] = 'narasix_sm_4_3';
		break;

	case 'cover':
        $grid_item_class = 'col-span-1';
        $post_template = 'cover';
		    $template_args['thumb_size'] = 'narasix_sm_4_3';
		break;
}

if ( $settings['orderby'] === 'wpp' ) {
    if ( $settings['freshness'] === 'yes' ) {
        $settings['freshness'] = 1;
    } else {
        $settings['freshness'] = 0;
    }

    $wpp_query_args = [
        'range' => $settings['range'],
        'order_by' => $settings['order_by'],
        'post_type' => $settings['post_type'],
        'freshness' => $settings['freshness'],
    ];

    if ( !empty( $settings['authors'] ) ) {
        $wpp_query_args['author'] = implode( ',', $settings['authors'] );
    }

    if ( !empty( $settings['cat'] ) ) {
        $wpp_query_args['cat'] = implode( ',', $settings['category_ids'] );
    }

    if ( !empty( $settings['cat'] ) ) {
        $wpp_query_args['taxonomy'] = 'post_tag';
        $wpp_query_args['term_id'] = implode( ',', $settings['post_tag_ids'] );
    }

    if ( !empty( $settings['pid'] ) ) {
        $wpp_query_args['pid'] = implode( ',', $settings['post__not_in'] );
    }

    if ( ( $settings['range'] === 'custom' ) && ( $settings['time_quantity'] ) && ( $settings['time_unit'] ) ) {
        $wpp_query_args['time_quantity'] = (int)$settings['time_quantity'];
        $wpp_query_args['time_unit'] = $settings['time_unit'];
    }

    // Get WPP's popular post ID list from its Query class.
    if ( class_exists( 'WordPressPopularPosts' ) ) {
        $popular_posts_query = new \WordPressPopularPosts\Query( $wpp_query_args );
        $popular_posts_property = new \ReflectionProperty(\WordPressPopularPosts\Query::class, 'posts');
        $popular_posts_property->setAccessible(true);
        $popular_posts = $popular_posts_property->getValue($popular_posts_query);
        foreach ( $popular_posts as $post_item ) {
            $query_args['post__in'][] = $post_item->id;
        }
    } else {
        $query_args['post__in'] = '';
    }

    $query_args['offset'] = 0;
    $query_args['orderby'] = 'post__in';
    $query_args['order'] = 'asc';

}

$post_query = new WP_Query( $query_args );

if ( $post_query->have_posts() ) {
?>
  <div class="<?php echo esc_attr( $section_class ); ?>">
    <div class="section-wrapper">
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

      <div class="<?php echo esc_attr( $section_content_class ); ?>">
        <?php
          $post_index = 0;
          $post_template_args = array(
              'post_index' => $post_index,
              'post_meta_category' => $settings['post_meta_category'],
              'post_meta_author' => $settings['post_meta_author'],
              'post_meta_date' => $settings['post_meta_date'],
              'post_format_icon' => 'no',
              'excerpt_length' => 0,
              'post_meta_secondary' => false,
          );

        while ( $post_query->have_posts() ) {
            $post_query->the_post();
              $post_index++;
              $post_template_args['post_index'] = $post_index;

            echo '<div class="' . esc_attr( $grid_item_class ) . '">';
            narasix_get_template_part( 'template-parts/content/content-' . $post_template, NULL, $post_template_args );
            echo '</div>';
        }
          // Reset postdata
          wp_reset_postdata();
        ?>
      </div>
    </div>
  </div>
<?php
}