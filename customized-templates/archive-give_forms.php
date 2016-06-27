<?php
/**
 *  Used to display an archive page of Give Donation forms.
 *
 *  This file is designed for use with the "default" twenty sixteen theme, and distributed as a sample
 *  Always test archive templates before using on production sites.
 *  
 *  For more info, visit https://givewp.com
 *
 *  @link https://givewp.com/
 *  @author ben.meredith@gmail.com
 */

get_header();
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main give-archive" role="main">
			<?php
			/**
			 *  Display only Give donation forms
			 */
			$args = array(
				'post_type'      => 'give_forms',
				'posts_per_page' => 10
			);

			$wp_query = new WP_Query( $args );

			if ( $wp_query->have_posts() ) : ?>

				<h1 class="my-give-archive-title">All The Ways You Can Support Us</h1>
				<hr/>

				<?php
				do_action('my-give-before-archive-loop');

				while ( $wp_query->have_posts() ) : $wp_query->the_post();?>
					<div class="my-give-archive-form">

						<?php
						do_action('my-give-before-archive-form');

						//Output the title ?>
						<h2 class="my-give-archive-form-title give-form-title"><a href="<?php echo get_the_permalink(); ?>"><?php echo get_the_title(); ?></a></h2>
						<?php

						$id = get_the_ID();

						//Output the featured image
						give_get_template_part( 'single-give-form/featured-image');

						//Output the content
						$content_option = get_post_meta( $id, '_give_content_option', true);
						if ( $content_option != 'none' ) {
							$content = get_post_meta( $id, '_give_form_content', true );
							echo '<div class="my-give-archive-content">' . $content . '</div>';
						}

						//Output the goal
						$goal_option = get_post_meta( $id, '_give_goal_option', true );
						if ( $goal_option == 'yes' ) {
							$shortcode = '[give_goal id="' . $id . '"]';
							echo do_shortcode( $shortcode );
						} 


						//Output a link to take users to the form
						?>
						<h3 class="my-give-archive-donate-now-link"><a href="<?php echo get_the_permalink(); ?>">Donate Now</a></h3>

					</div>
					<?php do_action('my-give-after-archive-form');
				endwhile;

			else :
				//If you don't have donation forms that fit this query
				?>

				<h2>Sorry, no donation forms found.</h2>

			<?php endif;
			wp_reset_query();
			do_action('my-give-after-archive-loop');
			?>

		</main>

	</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>