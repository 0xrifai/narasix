<?php
/**
 * Standard header template
 */

$show_login = narasix_get_option( 'header_show_login', 'yes' );
$content_layout_width = narasix_get_option( 'content_layout_width', 'default' );
$social_sortable = narasix_get_option( 'social_media_sites' );
$header_class = '';

if ($content_layout_width === 'default' ) {
	$header_class = 'max-w-7xl';
} else {
	$header_class = 'max-w-' . $content_layout_width;
}

?>

	<div class="site-header-primary">
		<div class="<?php echo esc_attr( $header_class ); ?> mx-auto px-4 pt-4 pb-4 hidden lg:px-16 lg:block">
			<div class="flex items-center justify-center lg:justify-between">
				<div class="site-header-logo">
					<?php get_template_part( 'template-parts/header/component/header-branding' ); ?>
				</div>

				<?php
				if ( !empty( $social_sortable ) ) {
				?>
					<div class="site-header-social text-right">
						<?php get_template_part( 'template-parts/misc/social-inline' ); ?>
					</div>
				<?php
				}
				?>
			</div>
		</div>
	</div>

	<?php
	if ( has_nav_menu( 'site-header' ) ) {
	?>
	<div class="site-header-secondary">
		<div class="site-header-navigation <?php echo esc_attr( $header_class ); ?> mx-auto px-4 lg:px-16 hidden lg:block">
			<div class="border-t">
			<?php get_template_part( 'template-parts/header/component/navigation', 'top' ); ?>
			</div>
		</div>
	</div>
	<?php
	}
	?>


<?php get_template_part( 'template-parts/header/header-mobile' ); ?>