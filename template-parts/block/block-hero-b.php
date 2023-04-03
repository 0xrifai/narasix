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
	'image_secondary' => [],
) );

// Setting up variables.
$btn_extra_attr = '';

?>
<section>
	<div class="grid grid-cols-1 gap-4 md:grid-cols-2">
		<div class="bg-blue-600 p-8 md:p-12 lg:px-16 lg:py-44">
			<div class="mx-auto max-w-xl text-center">
				<?php
					if ( $settings['heading'] ) {
						echo '<h1 class="text-2xl font-bold text-white md:text-3xl">';
						echo '<span class="e_heading section-heading-text">' . wp_kses_post( $settings['heading'] ) . '</span>';
						echo '</h1>';
					}

					if ( $settings['body'] ) {
						echo '<div class="e_desc hidden text-white/90 sm:mt-4 sm:block opacity-70">' . wp_kses_post( $settings['body'] ) . '</div>';
					}
				?>
				<div class="mt-4 md:mt-8">
					<?php
					if ( $settings['btn_text'] ) {
						$btn_class = 'btn-hero-primary inline-block rounded border border-white bg-white px-12 py-3 text-sm font-medium text-blue-500 transition hover:bg-transparent hover:text-white';

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
		</div>
		<div class="grid grid-cols-2 gap-4 md:grid-cols-1 lg:grid-cols-2">
			<?php
				if ( array_key_exists( 'id', $settings['image'] ) && $settings['image']['id'] ) {
					echo '
				<div class="section-image-primary">';
						echo '
					<img class="img-hero h-40 w-full object-cover sm:h-56 md:h-full" src="' . esc_url( $settings['image']['url'] ) . '" alt="figure">';
					echo '
					</div>';
				}
			?> 
			<?php
				if ( array_key_exists( 'id', $settings['image'] ) && $settings['image_secondary']['id'] ) {
					echo '
					<div class="section-image-secondary flex items-end">';
						echo '
						<img class="img-hero h-40 w-full object-cover sm:h-56 md:h-full" src="' . esc_url( $settings['image_secondary']['url'] ) . '" alt="figure">';
					echo '
						</div>';
				}
			?>   
		</div>
	</div>
</section>