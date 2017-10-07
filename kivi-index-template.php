<?php
/**
 * Kivi items index template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package House Company
 */

get_header(); ?>

	<header class="archive-header" <?php hybrid_attr( 'archive-header' ); ?>>
		<h1 class="archive-title" <?php hybrid_attr( 'archive-title' ); ?>><?php esc_html_e( 'Kohteet', 'housecompany' ); ?></h1>
	</header><!-- .archive-header -->

	<?php if ( have_posts() ) : ?>

		<?php /* Start the Loop */ ?>
		<?php while ( have_posts() ) : the_post(); ?>

			<?php

				/*
				 * Include the Post-Format-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
				 */
				get_template_part( 'template-parts/content', ( post_type_supports( get_post_type(), 'post-formats' ) ? get_post_format() : get_post_type() ) );
			?>

		<?php endwhile; ?>

		<?php
			the_posts_pagination( array(
				'prev_text'          => esc_html__( 'Previous page', 'munsa' ),
				'next_text'          => esc_html__( 'Next page', 'munsa' ),
				'before_page_number' => '<span class="meta-nav screen-reader-text">' . esc_html__( 'Page', 'munsa' ) . ' </span>',
			) );
		?>

	<?php else : ?>

		<?php get_template_part( 'template-parts/content', 'none' ); ?>

	<?php endif; ?>

<?php get_footer(); ?>
