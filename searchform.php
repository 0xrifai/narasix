<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
    <span class="screen-reader-text"><?php echo esc_html_x( 'Search for:', 'label', 'narasix' ) ?></span>
    <input type="search" class="search-field"
        placeholder="<?php echo esc_attr_x( 'Search …', 'placeholder', 'narasix' ) ?>"
        value="<?php echo get_search_query() ?>" name="s"
        title="<?php echo esc_attr_x( 'Search for:', 'label', 'narasix' ) ?>"/><!--
    --><button type="submit" class="search-submit">
        <?php echo '<span class="search-submit-text">' . esc_html__( 'Search', 'narasix' ) . '</span>' . narasix_svg_icon( array( 'icon' => 'search', 'class' => 'icons-last' ) ); ?>
    </button>
</form>