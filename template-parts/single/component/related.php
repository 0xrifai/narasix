<?php
/**
 * Displays related posts
 */

$heading_text = narasix_get_option( 'single_related_posts_heading', esc_html__( 'Related posts', 'narasix' ) );
$post_order = narasix_get_option( 'single_related_posts_order', 'latest' );
$post_style = narasix_get_option( 'single_related_posts_style', 'default' );
$posts_wrapper_class = 'flex overflow-x-auto space-x-4 sm:space-x-5 pb-1 no-scrollbar select-none scrolling-wrapper';
$post_item_wrapper_class = '';
$post_item_class = '';
$post_template = '';
$template_args = array();

$section_class = 'relative w-full mb-6 py-6 single-related-posts-section';

$post_id = get_the_id();
$posts_per_page = 5;

if ( current_user_can('read_private_posts') ) {
	$post_status = array(
		'publish',
		'private',
	);
} else {
	$post_status = 'publish';
}

if ( is_single() ) {
	$next_post = get_next_post();
	$next_post_ID = ( property_exists( $next_post, 'ID' ) ) ? $next_post->ID : 0;
	$prev_post = get_previous_post();
	$prev_post_ID = ( property_exists( $prev_post, 'ID' ) ) ? $prev_post->ID : 0;
} else {
	$next_post_ID = 0;
	$prev_post_ID = 0;
}

$query_args = array(
	'post_type'      		=> get_post_type( $post_id ),
	'post_status'			=> $post_status,
	'posts_per_page'      	=> $posts_per_page,
	'post__not_in'   => array( $post_id, $next_post_ID, $prev_post_ID ),
	'ignore_sticky_posts' 	=> 1,
	'orderby'   			=> $post_order,
);

$post       = get_post( $post_id );
$taxonomies = get_object_taxonomies( $post, 'names' );

foreach( $taxonomies as $taxonomy ) {
	if  (( $taxonomy === 'tag' ) || ( $taxonomy === 'category' ) ) {
		$terms = get_the_terms( $post_id, $taxonomy );
		if ( empty( $terms ) ) continue;
		$term_list = wp_list_pluck( $terms, 'slug' );
		$query_args['tax_query'][] = array(
			'taxonomy' => $taxonomy,
			'field'    => 'slug',
			'terms'    => $term_list,
		);
	}
}

if( count( $query_args['tax_query'] ) > 1 ) {
	$query_args['tax_query']['relation'] = 'OR';
}

$query = new WP_Query( $query_args );

if ( $query->have_posts() ) { ?>
	<div class="<?php echo esc_attr( $section_class ); ?>">
		
		<?php
		if ( $heading_text !== '' ) {
			?>
				<h2 class="meta-heading mb-6 border-b pb-4">
					<?php
					echo wp_kses_post( $heading_text );
					?>
				</h2>
			<?php
			}
			?>
		
			<?php
			

			switch ( $post_style ) {
				case 'default':
				default:
					$post_item_wrapper_class = 'ralated-content thumb-ralated w-[16.2em]';
					$post_template = 'portrait';
					break;

				case 'card':
					$post_item_wrapper_class = 'ralated-content w-[16rem]';
					$post_template = 'card';
					break;

				case 'cover':
					$post_item_wrapper_class = 'ralated-content w-[16rem]';
					$post_template = 'cover';
					break;
			}

			if ( $posts_wrapper_class !== '' ) {
				echo '<div class="' . esc_attr( $posts_wrapper_class ) . '">';
			}

			while ( $query->have_posts() ) {
				$query->the_post();
				if ( $post_item_wrapper_class !== '' ) {
					echo '<div class="' . esc_attr( $post_item_wrapper_class ) . '">';
				}

					narasix_get_template_part( 'template-parts/content/content-' . $post_template, NULL, $template_args );

				if ( $post_item_wrapper_class !== '' ) {
					echo '</div>';
				}
			}

			if ( $posts_wrapper_class !== '' ) {
				echo '</div>';
			}
			?>
	</div>
<?php
}

wp_reset_query();