<?php
if ( isset( $args ) ) extract( $args ); // extract passed variables.

( isset( $social_list ) ) || $social_list = NULL;
( isset( $style ) ) || $style = 'inline';

// Use passed social list if available, if not use social list from theme's setting panel.
if ( $social_list ) {
	$output = '';
	$output .= '<ul class="social-media-list social-media-list-inline">';
	foreach ( $social_list as $social_item ) {
		$output .= '<li class="social-media-list-item">';
			if ( $social_item['social_url']['url'] ) {
				$output .= '<a href="'. esc_url( $social_item['social_url']['url'] ) . '"';
				if ( $social_item['social_url']['is_external'] ) {
					if ( $social_item['social_url']['nofollow'] ) {
						$output .= ' target="_blank" rel="noopener nofollow"';
					} else {
						$output .= ' target="_blank" rel="noopener"';
					}
				}
				$output .= '>';
			}
			$output .= narasix_svg_icon( array( 'icon' => strtolower( $social_item['social_name'] ) ) );
			if ( $social_item['social_url']['url'] ) {
				$output .= '</a>';
			}
		$output .= '</li>';
	}
	$output .= '</ul>';
	echo nsix_wp_kses_post( $output );
} else {
	$urls = array(
				'behance' => narasix_get_option( 'behance_url', '' ),
        'dribbble' => narasix_get_option( 'dribbble_url', '' ),
        'facebook' => narasix_get_option( 'facebook_url', '' ),
        'google' => narasix_get_option( 'google_url', '' ),
        'instagram' => narasix_get_option( 'instagram_url', '' ),
        'line' => narasix_get_option( 'line_url', '' ),
        'linkedin' => narasix_get_option( 'linkedin_url', '' ),
        'medium' => narasix_get_option( 'medium_url', '' ),
        'pinterest' => narasix_get_option( 'pinterest_url', '' ),
        'reddit' => narasix_get_option( 'reddit_url', '' ),
        'snapchat' => narasix_get_option( 'snapchat_url', '' ),
        'soundcloud' => narasix_get_option( 'soundcloud_url', '' ),
        'spotify' => narasix_get_option( 'spotify_url', '' ),
        'telegram' => narasix_get_option( 'telegram_url', '' ),
        'tiktok' => narasix_get_option( 'tiktok_url', '' ),
        'tumblr' => narasix_get_option( 'tumblr_url', '' ),
        'twitter' => narasix_get_option( 'twitter_url', '' ),
        'viber' => narasix_get_option( 'viber_url', '' ),
        'vk' => narasix_get_option( 'vk_url', '' ),
        'wechat' => narasix_get_option( 'wechat_url', '' ),
        'whatsapp' => narasix_get_option( 'whatsapp_url', '' ),
        'xing' => narasix_get_option( 'xing_url', '' ),
        'youtube' => narasix_get_option( 'youtube_url', '' ),
	);

	$default_order = array(
	    	'behance',
        'dribbble',
        'facebook',
        'google',
        'instagram',
        'line',
        'linkedin',
        'medium',
        'pinterest',
        'reddit',
        'snapchat',
        'soundcloud',
        'spotify',
        'telegram',
        'tiktok',
        'tumblr',
        'twitter',
        'viber',
        'vk',
        'wechat',
        'whatsapp',
        'xing',
        'youtube',
	);

	$social_sortable = narasix_get_option( 'social_media_sites', $default_order );
	$is_external = narasix_get_option( 'social_media_url_new_tab', false );
	$nofollow = narasix_get_option( 'social_media_url_nofollow', false );

	$output = '';
	$class = 'social-media-list social-media-list-' . $style;
	if ( $style === 'inline-large' ) {
		$class .= ' social-media-list-inline';
	}
	$output .= '<ul class="' . esc_attr( $class ) . '">';
	foreach ( $social_sortable as $social_name ) {
		if ( $urls[$social_name] ) {
			$output .= '<li class="social-media-list-item">';
				$output .= '<a href="'. esc_url( $urls[$social_name] ) . '"';
				if ( $is_external ) {
					if ( $nofollow ) {
						$output .= ' target="_blank" rel="noopener nofollow"';
					} else {
						$output .= ' target="_blank" rel="noopener"';
					}
				}
				$output .= '>';
				$output .= narasix_svg_icon( array( 'icon' => $social_name ) );
				if ( $style === 'inline-large' ) {
					$output .= '<p class="social-media-list-item-name hidden lg:block">' . $social_name . '</p>';
				}
				$output .= '</a>';
			$output .= '</li>';
		}
	}
	$output .= '</ul>';
	echo nsix_wp_kses_post( $output );
}
