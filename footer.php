<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 */

$footer_layout = narasix_get_option( 'footer_layout', 'a' );
$back_top_switch = narasix_get_option( 'back_top_switch', 'yes' );
$search_modal = narasix_get_option( 'search_stlye', 'a' );
$content_layout_width = narasix_get_option( 'content_layout_width', 'default' );
$footer_class = '';

if ($content_layout_width === 'default' ) {
	$footer_class = 'max-w-7xl';
} else {
	$footer_class = 'max-w-' . $content_layout_width;
}

?>
	</div>
		<?php narasix_ads_code( 'bottom_ad' ); ?>
		<div class="site-footer py-2 mt-8 bg-charcoal-200 dark:bg-charcoal-900">
			<footer class="<?php echo esc_attr( $footer_class ); ?> mx-auto px-4 lg:px-16">
				<?php get_template_part( 'template-parts/footer/footer-layout', $footer_layout ); ?>
			</footer>
		</div>
	</div><!-- .site-container -->
<!-- canvas modal -->
	<?php get_template_part( 'template-parts/header/component/navigation-canvas' ); ?>
<!-- Login form modal -->
	<?php get_template_part( 'template-parts/header/component/header-login' ); ?>
<!-- Social modal -->
	<?php if ( is_single() ) {
		get_template_part( 'template-parts/single/component/social-share' );
	} ?>
<!-- Search modal -->
	<?php  get_template_part( 'template-parts/header/component/header-search' ); ?>
	
	<?php
	if ( $back_top_switch === 'yes' ) {
	?>
		<!-- Back to top button -->
		<button class="js-nsix-back-top-btn hidden lg:block bg-charcoal-100 dark:bg-charcoal-700 shadow-lg nsix-back-to-top"><span class="sr-only"><?php echo esc_html__( 'Back to top', 'narasix' ); ?></span><?php echo narasix_svg_icon( array( 'icon' => 'arrow-up' ) ); ?></button>
	<?php
	}
	?>
</div><!-- .site -->

<div class="overlay modal-close"></div>

<?php wp_footer(); ?>

</body>
</html>