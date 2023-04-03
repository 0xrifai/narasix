<?php
/**
 * 
 */
$footer_subscribe_switch = narasix_get_option( 'footer_subscribe_switch', 'yes' );
$footer_about_heading = narasix_get_option( 'footer_about_heading', esc_html__( 'Stay in the loop', 'narasix' ) );
$footer_copyright = narasix_get_option( 'footer_copyright', 'Made by © <a href="#" target="_blank" rel="nofollow">Hidunks Studio</a>' );
$footer_about = narasix_get_option( 'footer_about', esc_html__( 'Doloribus consectetur quasi ipsa quo neque culpa blanditiis ducimus recusandae a veritatis optio cumque, in harum ad nam!', 'narasix' ) );
$shortcode_mc4wp = narasix_get_option( 'shortcode_mc4wp' );

$menu_class = 'flex flex-wrap space-x-6';
?>

<div class="flex flex-col justify-center py-6 space-y-8 lg:flex-row lg:justify-between lg:space-y-0 lg:space-x-12">
  <div class="flex flex-col space-y-4 text-center lg:text-left">
    
    <?php if ( $footer_about_heading !== '' ) {
      ?>
        <h1 class="font-bold leading-none"><?php echo wp_kses_post( $footer_about_heading ); ?></h1>
      <?php
    } ?>
    <?php if ( $footer_about !== '' ) {
      ?>
        <p class="text-lg"><?php echo wp_kses_post( $footer_about ); ?></p>
      <?php
    } ?>
  </div>
  <div class="flex flex-shrink-0 flex-row items-center justify-center self-center lg:justify-end shadow-lg">
    <?php 
        if ( $footer_subscribe_switch === 'yes' ) {
          if ( $shortcode_mc4wp ) {
            echo do_shortcode( $shortcode_mc4wp );
          } else {
            echo '<div class="sr-only"></div>';
          }
        }
    ?>
  </div>
</div>

<div class="mt-6 flex flex-col border-t py-5 items-center justify-between md:flex-row">
  
  <?php get_template_part( 'template-parts/footer/component/footer-branding' ); ?>

  <nav class="max-xs:mt-4" aria-label="<?php esc_attr_e( 'Footer Menu', 'narasix' ); ?>">
    <?php
    wp_nav_menu( array(
    'theme_location' => 'footer',
    'menu_class'     => $menu_class,
    'container' 	 => false,
    ) );
    ?>
  </nav>
</div>