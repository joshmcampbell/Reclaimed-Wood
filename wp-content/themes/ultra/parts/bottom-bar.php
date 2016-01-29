<?php
/**
 * Part Name: Top Bar
 */
?>

<div class="bottom-bar">
	<div class="container">
		<?php $copyright_text = apply_filters( 'ultra_copyright_text', siteorigin_setting( 'footer_copyright_text' ) ); ?>
		<div class="site-info">
			<?php echo wp_kses_post( $copyright_text ); ?>
			<?php
				if ( siteorigin_setting( 'footer_copyright_text' ) && siteorigin_setting( 'footer_attribution' ) ) { 
					echo ' - ';
				}
				if ( siteorigin_setting( 'footer_attribution' ) ) {
					printf( __( 'Theme by <a href="%s" title="A Free WordPress Theme by Puro">Puro</a>', 'ultra' ), 'http://purothemes.com' );
				}
			?>			 
		</div><!-- .site-info --><?php wp_nav_menu( array( 'theme_location' => 'footer', 'container_class' => 'bottom-bar-menu', 'depth' => 1, 'fallback_cb' => '' ) ); ?>
	</div><!-- .container -->

</div><!-- .bottom-bar -->