<?php
/**
 * Social Author
 */

$author_id = get_the_author_meta( 'ID' );

$author_website = get_the_author_meta( 'url', $author_id );
$facebook_field = narasix_get_meta_box( 'field_profile_facebook', 'user_'. $author_id );
$twitter_field = narasix_get_meta_box( 'field_profile_twitter', 'user_'. $author_id );
$instagram_field = narasix_get_meta_box( 'field_profile_instagram', 'user_'. $author_id );
$github_field = narasix_get_meta_box( 'field_profile_github', 'user_'. $author_id );
$linkedin_field = narasix_get_meta_box( 'field_profile_linkedin', 'user_'. $author_id );


if ( $author_website ) {
?>
<li>
  <a href="<?php echo esc_url( $author_website ); ?>">
    <?php echo narasix_svg_icon( array( 'icon' => 'website', 'class' => 'text-[1.5em]' ) ) ;?>
  </a>
</li>
<?php
}

if ( $facebook_field ) {
?>
<li>
  <a href="<?php echo esc_url( $facebook_field ); ?>">
    <?php echo narasix_svg_icon( array( 'icon' => 'facebook', 'class' => 'text-[1.5em]' ) ) ;?>
  </a>
</li>
<?php
}

if ( $twitter_field ) {
?>
<li>
  <a href="<?php echo esc_url( $twitter_field ); ?>">
    <?php echo narasix_svg_icon( array( 'icon' => 'twitter', 'class' => 'text-[1.5em]' ) ) ;?>
  </a>
</li>
<?php
}

if ( $instagram_field ) {
?>
<li>
  <a href="<?php echo esc_url( $instagram_field ); ?>">
    <?php echo narasix_svg_icon( array( 'icon' => 'instagram', 'class' => 'text-[1.5em]' ) ) ;?>
  </a>
</li>
<?php
}

if ( $github_field ) {
?>
<li>
  <a href="<?php echo esc_url( $github_field ); ?>">
    <?php echo narasix_svg_icon( array( 'icon' => 'github', 'class' => 'text-[1.5em]' ) ) ;?>
  </a>
</li>
<?php
}

if ( $linkedin_field ) {
?>
<li>
  <a href="<?php echo esc_url( $linkedin_field ); ?>">
    <?php echo narasix_svg_icon( array( 'icon' => 'linkedin', 'class' => 'text-[1.5em]' ) ) ;?>
  </a>
</li>
<?php
}
