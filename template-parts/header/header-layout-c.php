<?php
/**
 * Standard header template
 */

$show_login = narasix_get_option( 'header_show_login', 'yes' );
$darkmode_mode_switch = narasix_get_option( 'darkmode_mode_switch', 'no' );
$uppercase_menu = narasix_get_option( 'header_uppercase_menu', 'no' );
$content_layout_width = narasix_get_option( 'content_layout_width', 'default' );
$social_sortable = narasix_get_option( 'social_media_sites' );
$header_button = narasix_get_option( 'header_button', esc_html__( 'Subscribe', 'narasix' ) );
$url_button = narasix_get_option( 'url_button', '' );

$menu_class = 'navigation inline-flex space-x-4 overflow-x-auto py-3 whitespace-nowrap select-none no-scrollbar scrolling-wrapper';
if ( $uppercase_menu === 'yes' ) {
	$menu_class .= ' uppercase';
}

$header_class = '';
if ($content_layout_width === 'default' ) {
	$header_class = 'max-w-7xl';
} else {
	$header_class = 'max-w-' . $content_layout_width;
}

?>


  <div class=" <?php echo esc_attr( $header_class ); ?> mx-auto px-4 lg:px-16">
    <div class="flex content-between items-center border-b py-3">
      <a href="<?php echo esc_url( $url_button ); ?>" class="text-grey-darker font-sans no-underline hover:underline"> <?php echo wp_kses_post( $header_button ); ?> </a>
      <div class="ml-auto">
      <?php get_template_part( 'template-parts/header/component/header-branding' ); ?>
      </div>
      <div class="ml-auto flex items-center space-x-4">
        <?php
          if ( $darkmode_mode_switch === 'yes' ) { ?>
            <button onclick="NARASIX.documentOnReady.toggleDarkMode()" class="active:scale-95 mt-[3px]" aria-label="<?php echo esc_attr( 'Darkmode Toggle Button', 'narasix' ) ?>">
              <?php echo narasix_svg_icon( array( 'icon' => 'darkmode' ) ) ;?>
            </button>
          <?php }
        ?>
        <button class="modal-open" type="button" data-modal="#nsix-search-modal" aria-label="<?php echo esc_attr( 'Search', 'narasix' ) ?>">
          <?php echo narasix_svg_icon( array( 'icon' => 'search' ) ) ;?>
        </button>

        <?php
        if ( ( $show_login === 'yes' ) && !is_user_logged_in() ) {
          $header_login_url = narasix_get_option( 'header_login_url', '' );
          if ( $header_login_url !== '' ) {
        ?>
          <a href="<?php echo esc_url( $header_login_url ); ?>" class="hidden lg:inline-block"><?php echo narasix_svg_icon( array( 'icon' => 'user' ) ) ;?></a>
        <?php
          } else {
        ?>
          <button class="navbar-login-toggler hidden lg:inline-block modal-open" type="button" data-modal="#nsix-login-modal" aria-label="<?php echo esc_attr( 'Login', 'narasix' ) ?>">
            <?php echo narasix_svg_icon( array( 'icon' => 'user' ) ) ;?>
          </button>
        <?php
          }
        }
        ?>
      </div>
    </div>
    <div class="relative flex justify-between items-center">
      <?php wp_nav_menu( array(
        'theme_location' => 'site-header',
        'menu_id'        => 'top-menu',
        'menu_class'	   => $menu_class,
        'container'      => false,
      ) ); ?>
      <div class="hdl"></div>
      <a href="#nsix-offcanvas-primary" class="js-nsix-offcanvas-toggle" role="button" aria-label="Toggle navigation">
        <?php echo narasix_svg_icon( array( 'icon' => 'menu', 'class' => '' ) ) ;?>
      </a>
    </div>
  </div>

