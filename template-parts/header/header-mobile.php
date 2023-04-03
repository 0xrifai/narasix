<?php
/**
 * Mobile header
 */

$darkmode_mode_switch = narasix_get_option( 'darkmode_mode_switch', 'no' );

?>
<header id="site-header" class="header-mobile backdrop-blur-[8px] px-4 border-b lg:hidden">
	<div class="flex justify-between items-center py-3">
		<div class="site-header-logo">
			<?php narasix_get_template_part( 'template-parts/header/component/header-branding', NULL, array( 'logo_variant' => 'small' ) ); ?>
		</div>
		<div class="flex items-center space-x-4">
			<?php
				if ( $darkmode_mode_switch === 'yes' ) { ?>
					<button onclick="NARASIX.documentOnReady.toggleDarkMode()" class="active:scale-95" aria-label="<?php echo esc_attr( 'Darkmode Toggle Button', 'narasix' ) ?>">
						<?php echo narasix_svg_icon( array( 'icon' => 'darkmode' ) ) ;?>
					</button>
				<?php }
			?>
			<button class="modal-open" type="button" data-modal="#nsix-search-modal" aria-label="<?php echo esc_attr( 'Search', 'narasix' ) ?>">
        <?php echo narasix_svg_icon( array( 'icon' => 'search' ) ) ;?>
      </button>

			<a href="#nsix-offcanvas-primary" class="menu-button py-[3px] px-[7px] bg-yellow-500 rounded-md js-nsix-offcanvas-toggle" role="button" aria-label="<?php echo esc_attr( 'Toggle navigation', 'narasix' ) ?>">
				<?php echo narasix_svg_icon( array( 'icon' => 'menu' ) ) ;?>
			</a>
		</div>
	</div>
</header>