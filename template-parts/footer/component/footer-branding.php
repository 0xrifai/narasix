<?php
/**
 * Display footer branding
 */
$logo = narasix_get_option( 'footer_logo', array() );

if ( !empty( $logo ) ) {
	$logo_url = ( array_key_exists( 'url', $logo ) ) ? $logo[ 'url' ] : '';
} else {
	$logo_url = '';
}

if ( $logo_url ) {
	if ( is_front_page() ) {
	?>
		<h1 class="site-branding site-branding-image">
	<?php
	} else {
	?>
		<h2 class="site-branding site-branding-image">
	<?php
	}
	?>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
				<img src="<?php echo esc_url( $logo_url ); ?>" class="logo-footer" rel="logo" alt="<?php bloginfo( 'name' ); ?>">
			</a>
	<?php
	if ( is_front_page() ) {
	?>
		</h1>
	<?php
	} else {
	?>
		</h2>
	<?php
	}
} else {
	if ( is_front_page() ) { ?>
		<h1 class="font-bold text-xl"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
	<?php
	} else { ?>
		<h2 class="font-bold text-xl"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h2>
	<?php
	}
}