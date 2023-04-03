<?php
/**
 * Display single post header: A.
 */

// Get options.
$archives_breadcrumb = narasix_get_option( 'archives_breadcrumb', 'no' );
$page_breadcrumb = narasix_get_option( 'page_breadcrumb', 'no' );
$section_heading = narasix_get_option('latest_posts_heading', esc_html__( 'Latest Posts', 'narasix' ));

$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

$page_title = '';
$page_subtitle = '';

if ( is_search() ) {
	global $wp_query;

	$page_title = sprintf(
		'%1$s %2$s',
		'<span>' . esc_html__( 'Search:', 'narasix' ) . '</span>',
		'&ldquo;' . get_search_query() . '&rdquo;'
	);

	if ( $wp_query->found_posts ) {
		$page_subtitle = sprintf(
			/* translators: %s: Number of search results. */
			_n(
				esc_html__( 'We found %s result for your search.', 'narasix' ),
				esc_html__( 'We found %s results for your search.', 'narasix' ),
				$wp_query->found_posts,
				'narasix'
			),
			number_format_i18n( $wp_query->found_posts )
		);
	} else {
		$page_subtitle = esc_html__( 'We could not find any results for your search.', 'narasix' );
	}
} elseif ( is_archive() && !have_posts() ) {
	$page_title = esc_html__( 'Nothing Found', 'narasix' );
} elseif ( !is_home() ) {
	$page_title    = get_the_archive_title();
	$page_subtitle = get_the_archive_description();
}

// Setting up variables.
$header_class = 'section w-full my-6';

?>
<header class="<?php echo esc_attr( $header_class ); ?>">
	<?php
		if ( is_home() && ( $section_heading !== '' ) ) { 
			echo '<h2 class="font-semibold uppercase border-l-8 pl-3 border-charcoal-700/5 dark:border-charcoal-200/5 text-charcoal-700 dark:text-charcoal-200">';
			echo wp_kses_post( $section_heading );
			if ( $paged > 1) {
				esc_html_e(' - Page ', 'narasix');
				echo esc_html($paged);
			}
			echo '</h2>';
		} else {
			
		if ( is_archive() ) {
			if ( is_category() ) {
				$category = get_queried_object();
				$category_name = get_category_by_slug($category->slug);
				echo '<div class="px-4 border-l-8 pl-3 category border-charcoal-700/5 dark:border-charcoal-200/5 text-charcoal-700 dark:text-charcoal-200">';
				echo '<h2 class="text-base font-medium">' . esc_html( 'Category: ', 'narasix' ) . ' <span class="text-xl font-semibold uppercase">' . esc_html( $category_name->name, 'narasix' ) . '</span></h2>';
				if ( $archives_breadcrumb === 'yes' ) { 
						narasix_breadcrumb();
					}
			}
			if ( is_tag() ) {
				$tag = get_queried_object();
				echo '<div class="px-4 border-l-8 pl-3 tags border-charcoal-700/5 dark:border-charcoal-200/5 text-charcoal-700 dark:text-charcoal-200">';
				echo '<h2 class="text-base font-medium">' . esc_html( 'Tags: ', 'narasix' ) . ' <span class="text-xl font-semibold uppercase">' . esc_html( $tag->name, 'narasix' ) . '</span></h2>';
				if ( $archives_breadcrumb === 'yes' ) { 
					narasix_breadcrumb();
				}
				echo '</div>';
			}
		}

		if ( is_page() ) {
			echo '<div class="px-4 border-l-8 pl-3 pages border-charcoal-700/5 dark:border-charcoal-200/5 text-charcoal-700 dark:text-charcoal-200">';
			the_title( '<h2 class="font-semibold uppercase">', '</h2>' );
			if ( $page_breadcrumb === 'yes' ) { 
				narasix_breadcrumb();
			}
			echo '</div>';
		}

		if ( is_search() ) {
				$search_query = get_search_query();
				echo '<div class="px-4 border-l-8 pl-3 search border-charcoal-700/5 dark:border-charcoal-200/5 text-charcoal-700 dark:text-charcoal-200">';
				echo '<h2 class="text-base font-medium">' . esc_html( 'Search: ', 'narasix' ) . ' <span class="text-xl font-semibold uppercase">' . esc_html( $search_query, 'narasix' ) . '</span></h2>';
				if ( $page_subtitle ) { 
					echo '<div>' . wp_kses_post( wpautop( $page_subtitle ) ) . '</div>';
				}
				echo '</div>';
			}
		}
	?>
</header>