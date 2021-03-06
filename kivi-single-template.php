<?php
/**
 * The template for displaying Kivi items.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package House Company
 */

get_header(); ?>

	<?php while ( have_posts() ) : the_post(); ?>

		<?php get_template_part( 'template-parts/content', ( post_type_supports( get_post_type(), 'post-formats' ) ? get_post_format() : get_post_type() ) ); ?>

		<?php
			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;
		?>

		<?php
			// Previous/next post navigation.
			the_post_navigation( array(
				'next_text' => '<span class="meta-nav" aria-hidden="true">' . esc_html__( 'Next', 'munsa' ) . '</span> ' .
					'<span class="screen-reader-text">' . esc_html__( 'Next post:', 'munsa' ) . '</span> ' .
					'<span class="post-title">%title</span>',
				'prev_text' => '<span class="meta-nav" aria-hidden="true">' . esc_html__( 'Previous', 'munsa' ) . '</span> ' .
					'<span class="screen-reader-text">' . esc_html__( 'Previous post:', 'munsa' ) . '</span> ' .
					'<span class="post-title">%title</span>',
			) );
		?>

	<?php endwhile; // End of the loop. ?>

<?php get_footer(); ?>
