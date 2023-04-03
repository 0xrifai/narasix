<?php
/**
 * The template for displaying author pages
 */

// Get theme options.
$post_listing_args = narasix_get_post_listing_args();
$sidebar = narasix_get_option( 'author_sidebar', 'nsix-default' );
$sticky_sidebar = narasix_get_option( 'sticky_sidebar', 'yes' );
$content_layout_width = narasix_get_option( 'content_layout_width', 'default' );

// Display user profile box.
$author_bio = get_the_author_meta( 'description' );
if ( ( $author_bio === '' ) && is_single() ) {
	return; // do not display author box on single page if there's no bio set.
}
$author_id = get_the_author_meta( 'ID' );
$author_name = get_the_author_meta( 'display_name', $author_id );
$author_post_counts = count_user_posts( $author_id );

// Setting up variables
$section_class = 'section w-full post-listing-section-' . $post_listing_args['post_layout'];

if ($content_layout_width === 'default' ) {
	$content_class = 'max-w-7xl lg:px-16';
} else {
	$content_class = 'max-w-' . $content_layout_width;
}

get_header();
?>

<div id="primary" class="content-area">
	<header class="bg-charcoal-100 dark:bg-charcoal-700/70 mb-6">
		<div class="<?php echo esc_attr( $content_class ); ?> mx-auto px-4 lg:px-16 py-4">
			<div class="flex flex-col flex-wrap py-8 sm:flex-row">
				<div class="m-auto flex-shrink-0 overflow-hidden">
					<?php echo get_avatar( $author_id, 100, '', esc_html__( 'avatar', 'narasix' ) ); ?>
				</div>
				<div class="flex-1 sm:pl-6">
					<div class="sm:flex-no-wrap mb-3 flex flex-wrap justify-center sm:flex-row sm:justify-between">
						<div class="mb-4 flex w-full text-center sm:text-left flex-wrap md:mb-0 md:w-auto">
							<h2 class="mt-4 w-full text-2xl sm:mt-0 font-semibold">
								<?php echo esc_html( $author_name ); ?>
							</h2>
							<?php
								if ( $author_post_counts > 0 ) {
								?>
									<span class="w-full">
										<?php echo esc_html__( 'Posts created: ', 'narasix' ) ?><?php echo esc_html( $author_post_counts ); ?>
									</span>
								<?php
								}
							?>
						</div>
						<ul class="flex space-x-5 list-none">
							<?php get_template_part( 'template-parts/misc/author-social' ) ?>
						</ul>
					</div>
					<p class="px-4 leading-normal sm:px-0">
						<?php echo esc_html( $author_bio ); ?>
					</p>
				</div>
			</div>
		</div>
	</header>
	<?php
    if ( in_array( $post_listing_args['post_layout'], array( 'list-landscape', 'mixed-a', 'mixed-b', 'grid-portrait', 'masonry-portrait' ) ) ) {
		?>
			<div class="<?php echo esc_attr( $content_class ); ?> mx-auto px-4 lg:px-16">
				<div class="relative grid grid-cols-12 gap-6 mx-auto">
					<main class="flex flex-col col-span-12 lg:col-span-8 lg:h-auto">
						<section class="<?php echo esc_attr( $section_class ); ?>">
						<?php
							if ( have_posts() ) {
								narasix_post_listing( $post_listing_args );
							} else {
								echo esc_html__( 'Nothing Found', 'narasix' );
							}
						?>
						</section>
					</main>

					<aside class="col-span-12 mt-6 lg:mt-0 flex flex-col lg:col-span-4 sidebar<?php if ( $sticky_sidebar === 'yes' ) { echo ' js-nsix-sticky-sidebar'; } ?>">
						<?php
							if ( is_active_sidebar( $sidebar ) ) {
									dynamic_sidebar( $sidebar );
							}
						?>
					</aside>
				</div>
			</div>
    <?php
	} else {
		?>
			<main class="<?php echo esc_attr( $content_class ); ?> mx-auto px-4 lg:px-16">
				<?php
					if ( have_posts() ) {
						narasix_post_listing( $post_listing_args );
					} else {
						echo esc_html__( 'Nothing Found', 'narasix' );
					}
				?>
			</main>
    <?php
	}
	?>

</div><!-- #primary -->

<?php
get_footer();