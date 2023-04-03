<?php
/**
 * Displays Hero Post Block A.
 */

if ( !isset( $args ) ) return; // Exit if there's no variables passed.

( isset( $thumb_size ) ) || $thumb_size = 'narasix_sm_4_3';
( isset( $post_format_icon ) ) || $post_format_icon = 'no';
( isset( $post_meta_author ) ) || $post_meta_author = narasix_get_option( 'meta_author_toggle', 'yes' );
( isset( $post_meta_categories ) ) || $post_meta_categories = narasix_get_option( 'meta_categories_toggle', 'yes' );
( isset( $post_meta_date ) ) || $post_meta_date = narasix_get_option( 'meta_date_toggle', 'yes' );
( isset( $excerpt_length ) ) || $excerpt_length = 30;
( isset( $excerpt_length_secondary ) ) || $excerpt_length_secondary = 30;
( isset( $lazyload ) ) || $lazyload = true;

// Setting up variables.
$section_class = 'hero-post-blog';

$sticky_posts = get_option( 'sticky_posts' );
$feat_query = new WP_Query(
	array(
			'post_type'      => 'post',
			'post__in'       => $sticky_posts,
			'posts_per_page' => 3,
			'ignore_sticky_posts' => true
	)
);

$post_link = get_permalink();
$post_time_attr = get_the_time( 'c' );
$post_time = get_the_time( get_option( 'date_format' ) );

if ( $feat_query->have_posts() ) { ?>
	<div class="<?php echo esc_attr( $section_class ); ?>">
		<div class="grid grid-cols-12 mx-auto items-center">
		<?php
		while ( $feat_query->have_posts() ) {
			$feat_query->the_post();
			if ( $feat_query->current_post === 0 ) {
			?>
					<?php
					$post_class = array(
						'hero-post-a',
						'flex',
						'flex-col',
						'col-span-12',
						'lg:col-span-8',
						'lg:h-auto',
						'lg:mr-6',
					);
					?>
					<div <?php post_class( $post_class ); ?>>
						<div class="group relative overflow-hidden rounded-lg">
							<div class="pt-30 absolute inset-x-0 -bottom-2 z-10 flex items-end rounded-lg bg-gradient-to-t from-black/80 to-transparent text-charcoal-100 opacity-0 transition duration-300 ease-in-out group-hover:opacity-100">
								<div class="translate-y-4 transform space-y-1 lg:space-y-3 p-4 pb-10 featured-title-hover text-xl transition duration-[800ms] ease-in-out group-hover:translate-y-0">
									<div class="font-meta inline-flex items-center py-2 space-x-1">
										<?php narasix_post_categories_with_background(); ?>
										<?php 
											echo '<span class="bg-charcoal-700/60 px-2 rounded-[13px] text-[14px]">';
											echo '<time class="published" datetime="' . esc_attr( $post_time_attr ) . '"  title="' . esc_attr( $post_time ) . '">' . narasix_human_datetime() . '</time>';
											echo '</span>';
										?>
										
									</div>
									<!-- Featured Title -->
									<h3 class="font-heading lg:!text-3xl xl:!text-4xl lg:my-4">
										<a href="<?php echo esc_url( $post_link ); ?>" rel="bookmark"><?php the_title(); ?></a>
									</h3>
									<!-- Featured Desciption -->
									<?php
									if( get_the_excerpt() && ( $excerpt_length > 0 ) ) {
									?>
										<p class="!text-[15px] sm:!text-lg opacity-50 line-clamp-2">
                      <?php narasix_excerpt( $excerpt_length, true ); ?>
										</p>
									<?php
									}
									?>
									<!-- Read more -->
									<a href="<?php echo esc_url( $post_link ); ?>" class="btn-animation text-sm inline-flex items-center lg:py-2">
										<span><?php esc_html_e( 'Read more', 'narasix' ); ?></span>
										<?php echo narasix_svg_icon( array( 'icon' => 'arrow-right', 'class' => 'icons-last icons-xs' ) ) ;?>
									</a>
								</div>
							</div>
							<!-- Featured image -->
							<?php
							narasix_featured_img( array(
								'size' => 'narasix_sm_4_3',
								'class' => 'relative aspect-squares h-full post-hero-a',
							) );
							?>
						</div>
					</div>
			<?php
			} elseif ( $feat_query->current_post < 3 ) {
				if ( $feat_query->current_post === 1 ) {
				?>
					<div class="flex flex-col col-span-12 divide-y m-auto lg:col-span-4 dark:divide-charcoal-700">
						<?php
						}
						?>
						<div class="py-2 space-y-2">
							<div class="font-meta inline-flex items-center py-2 space-x-1 text-charcoal-100">
								
								<?php narasix_post_categories_with_background(); ?>

								<?php 
									echo '<span class="bg-charcoal-700/60 px-2 py-[1px] rounded-[13px] text-[14px]">';
									echo '<time class="published" datetime="' . esc_attr( $post_time_attr ) . '"  title="' . esc_attr( $post_time ) . '">' . narasix_human_datetime() . '</time>';
									echo '</span>';
								?>
								
							</div>
							<h3 class="font-heading lg:!text-xl line-clamp-2">
								<a href="<?php echo esc_url( $post_link ); ?>" rel="bookmark"><?php the_title(); ?></a>
							</h3>
							<?php
								if( get_the_excerpt() && ( $excerpt_length_secondary > 0 ) ) {
								?>
									<p class="!text-[15px] sm:!text-lg opacity-50 line-clamp-2">
                  <?php narasix_excerpt( $excerpt_length_secondary, true ); ?>
									</p>
								<?php
								}
							?>
							<a href="<?php echo esc_url( $post_link ); ?>" class="btn-animation text-sm inline-flex items-center lg:py-2">
								<span><?php esc_html_e( 'Read more', 'narasix' ); ?></span>
								<?php echo narasix_svg_icon( array( 'icon' => 'arrow-right', 'class' => 'icons-last icons-xs' ) ) ;?>
							</a>
						</div>
						<?php
						if ( ( $feat_query->current_post === 3 ) || ( $feat_query->current_post === ( $feat_query->post_count - 1 ) ) ) {
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
