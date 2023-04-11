<?php 

/**
 * GiveWP Single Template Wrapper Start -- KadenceWP theme
 */
function givewp_kadence_theme_start_wrapper() {
	/**
	* Hook for Hero Section
	*/
	do_action( 'kadence_hero_header' );
	?>
	<div id="primary" class="content-area">
		<div class="content-container site-container">
			<main id="main" class="site-main" role="main">
				<?php
				/**
				 * Hook for anything before main content
				 */
				do_action( 'kadence_before_main_content' );
				?>
				<div class="content-wrap">
				<?php 
}

add_filter( 'give_default_wrapper_start', 'givewp_kadence_theme_start_wrapper' );

/**
 * Custom Give Single Template Wrapper End -- KadenceWP Theme
 */
function givewp_kadence_theme_end_wrapper() { ?>
			</div>
			<?php			
			/**
			 * Hook for anything after main content
			 */
			do_action( 'kadence_after_main_content' );
			?>
		</main><!-- #main -->
		<?php
		get_sidebar();
		?>
	</div>
</div><!-- #primary -->
<?php 
}

add_filter( 'give_default_wrapper_end', 'givewp_kadence_theme_end_wrapper' );
