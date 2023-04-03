<?php
/**
 * Display header branding
 */

if ( isset( $args ) ) extract( $args ); // extract passed variables.

( isset( $class ) ) || $class = '';
( isset( $logo_variant ) ) || $logo_variant = 'default';

$logo = array();

switch ( $logo_variant ) {

	case 'offcanvas':
		$logo = narasix_get_option( 'offcanvas_logo', array() );
		break;
		
	case 'default':
	default:
		$logo = narasix_get_option( 'header_logo', array() );
		break;
}

if ( !empty( $logo ) ) {
	$logo_url = ( array_key_exists( 'url', $logo ) ) ? $logo[ 'url' ] : '';
} else {
	$logo_url = '';
}

if ( $logo_url ) {
	if ( is_front_page() ) {
		?>
			<h1 class="site-branding site-branding-image<?php if ( $class !== '' ) { echo ' ' . esc_attr( $class ); } ?>">
		<?php
	} else {
		?>
			<h1 class="site-branding site-branding-image<?php if ( $class !== '' ) { echo ' ' . esc_attr( $class ); } ?>">
		<?php
	}
		?>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
				<img src="<?php echo esc_url( $logo_url ); ?>" rel="logo" alt="<?php bloginfo( 'name' ); ?>">
			</a>
		<?php
	if ( is_front_page() ) {
		?>
			</h1>
		<?php
	} else {
		?>
			</h1>
		<?php
	}
} else {
	if ( is_front_page() ) { ?>
		<h1 class="site-branding site-branding-text<?php if ( $class !== '' ) { echo ' ' . esc_attr( $class ); } ?>"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
	<?php
	} else { ?>
		<h1 class="site-branding site-branding-text<?php if ( $class !== '' ) { echo ' ' . esc_attr( $class ); } ?>"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
	<?php
	}
}