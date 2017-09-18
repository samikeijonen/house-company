<?php
/**
 * Template Name: Front Page
 *
 * This is the page template for Front Page.
 *
 * @package HouseCompany
 */

get_header(); ?>

	<?php while ( have_posts() ) : the_post(); ?>

		<div class="entry-outer">

			<?php
				if ( ! get_theme_mod( 'hide_sm_from_front_page' ) ) :
					get_template_part( 'menus/menu', 'social' ); // Loads the menus/menu-social.php template.
				endif;
			?>

			<a id="scroll-to-content" class="scroll-to-content" data-scroll href="#featured-area">
				<span class="screen-reader-text"><?php esc_html_e( 'Scroll to Content', 'housecompany' ); ?></span>
			</a>

		</div><!-- .entry-outer -->

	</div><!-- .featured-content -->

	<?php endwhile; // End of the loop. ?>

<?php get_footer(); ?>
