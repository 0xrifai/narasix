<?php
/**
 * Displays Hero Post Block C.
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
// $post_meta_category = $settings['post_meta_category'];

// Setting up variables.
$section_class = 'hero-post-block-d';

$query_args[ 'posts_per_page' ] = 5;
$hps_query = new WP_Query( $query_args );

if ( $hps_query->have_posts() ) { ?>
	<div class="<?php echo esc_attr( $section_class ); ?>">
		<div class="flex flex-row flex-wrap max-lg:gap-2">
      <?php
      while ( $hps_query->have_posts() ) {
        $hps_query->the_post();
        if ( $hps_query->current_post === 0 ) {
        ?>
        <div class="w-full max-w-full flex-shrink pb-1 lg:w-1/2 lg:pb-0 lg:pr-3">
        <?php 
					narasix_get_template_part( 'template-parts/content/content-cover-large', NULL, 
					array(
						'post_meta_author' => $settings['post_meta_author'],
						'post_meta_category' => $settings['post_meta_category'],
						'post_meta_date' => $settings['post_meta_date'],
					) ); 
				?>
        </div>
					
			<?php
			} elseif ( $hps_query->current_post < 5 ) {
				if ( $hps_query->current_post === 1 ) {
				?>
					<div class="w-full max-w-full flex-shrink lg:w-1/2">
          <div class="grid grid-cols-2 gap-3">
						<?php } 
            ?>
           <?php narasix_get_template_part( 'template-parts/content/content-cover-medium', NULL, 
							array(
								'post_meta_author' => $settings['post_meta_author'],
								'post_meta_category' => $settings['post_meta_category'],
								'post_meta_date' => $settings['post_meta_date'],
							) ); 
						?>
						  
						<?php
						if ( ( $hps_query->current_post === 4 ) || ( $hps_query->current_post === ( $hps_query->post_count - 1 ) ) ) {
						?>
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
