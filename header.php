<?php
/**
 * The header for the theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 */

$header_layout 				= narasix_get_option( 'header_layout', 'a' );
$sticky_header 				= narasix_get_option( 'sticky_header', 'yes' );

$darkmode_mode_switch = narasix_get_option( 'darkmode_mode_switch', 'no' );
$darkmode_class = ( $darkmode_mode_switch === 'yes' ) ? ' dark:bg-charcoal-800 dark:text-charcoal-100 dark:fill-charcoal-200/60' : '';

$sticky_header_mobile = narasix_get_option( 'sticky_header_mobile', 'no' );
if ($sticky_header_mobile === 'yes' ) {
	$header_class = 'header-mobile-sticky';
} else {
	$header_class = '';
}


?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>

<body <?php body_class('antialiased'); ?>>
<div id="nsix-site" class="bg-charcoal-50 text-charcoal-900 fill-charcoal-900 border-charcoal-900/50<?php echo esc_attr( $darkmode_class ); ?>">
	<div class="site-container">
		<a class="skip-link sr-only" href="#content"><?php esc_html_e( 'Skip to content', 'narasix' ); ?></a>

		<header id="masthead" class="site-header <?php echo esc_attr( $header_class ); ?>">
			<?php get_template_part( 'template-parts/header/header-layout', $header_layout ); ?>
		</header>

	<?php
		if ( $sticky_header === 'yes' ) {
			get_template_part( 'template-parts/header/header-sticky' );
		}
		?>

		<div class="site-content">