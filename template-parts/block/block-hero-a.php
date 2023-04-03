<?php
/**
 * Displays about section
 */

if ( !isset( $args ) ) return; // Exit if there's no variables passed.

$settings = $args['settings'];
$query_args = $args['query_args'];
$section_id = $args['section_id'];

// Merge with default value.
$settings = wp_parse_args( $settings, array(
	'image' => [],
) );

// Setting up variables.
$has_background = false;
$btn_extra_attr = '';

?>

<section>
	<div class="flex flex-col justify-center mx-auto md:flex-row md:justify-between">
		<div class="flex flex-col justify-center rounded-sm md:w-3/5 md:pr-12">
			<?php
				if ( $settings['heading'] ) {
					echo '<h1 class="e_heading text-5xl font-bold leading-none sm:text-6xl">';
					echo '<span class="section-heading-text">' . wp_kses_post( $settings['heading'] ) . '</span>';
					echo '</h1>';
				}

				if ( $settings['body'] ) {
					echo '<div class="e_desc my-6 text-lg opacity-70">' . wp_kses_post( $settings['body'] ) . '</div>';
				}
			?>
			<div class="flex flex-col space-y-4 sm:items-center sm:justify-center sm:flex-row sm:space-y-0 sm:space-x-4 md:justify-start">
				<?php
					if ( $settings['btn_text'] ) {
						$btn_class = 'btn-hero-primary px-8 py-3 text-lg font-semibold border max-sm:text-center rounded';

						if ( $settings['btn_url']['is_external'] ) {
							if ( $settings['btn_url']['nofollow'] ) {
								$btn_extra_attr = ' target="_blank" rel="noopener noreferrer nofollow"';
							} else {
								$btn_extra_attr = ' target="_blank" rel="noopener noreferrer"';
							}
						}

						echo '<a class="' . esc_attr( $btn_class ) . '" href="' . esc_url( $settings['btn_url']['url'] ) . '"' . $btn_extra_attr . '>' . esc_html( $settings['btn_text'] ) . '</a>';
					}
				?>
			</div>
		</div>
		<div class="flex items-center justify-center mt-8 md:mt-0 md:w-2/5">
			<?php
				if ( array_key_exists( 'url', $settings['image'] ) && $settings['image']['url'] ) {
					echo '<img class="object-contain img-hero" src="' . esc_url( $settings['image']['url'] ) . '" alt="figure">';
				}
			?>
		</div>
	</div>
</section>