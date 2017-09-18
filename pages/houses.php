<?php
/**
 * Template Name: Houses
 *
 * This is the page template for houses.
 *
 * @package House Company
 */

get_header(); ?>

	<?php while ( have_posts() ) : the_post(); ?>

		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> <?php hybrid_attr( 'post' ); ?>>
		
			<div class="entry-inner">
		
				<header class="archive-header">
					
					<?php the_title( '<h1 class="entry-title" ' . hybrid_get_attr( 'entry-title' ) . '>', '</h1>' ); ?>
					
					<div class="archive-description" <?php hybrid_attr( 'archive-description' ); ?>>
						<?php the_content(); ?>
					</div><!-- .archive-description -->
				
				</header><!-- .entry-header-info -->
			
			</div><!-- .entry-inner -->
	
		</article><!-- #post-## -->

	<?php endwhile; // End of the loop. ?>

	<?php

	// Portfolio Posts Query. 
	$portfolio_content = new WP_Query( apply_filters( 'house_company_portfolio_arguments', array(
		'post_type'      => 'portfolio_project',
		'posts_per_page' => 50,
		'no_found_rows'  => true,
	) ) );
	
	?>
	
	<?php if ( $portfolio_content->have_posts() ) : ?>
	
		<div id="portfolio-content-area" class="portfolio-content-area front-page-area">
			<div class="portfolio-wrapper">
						
				<div class="portfolio-posts-wrapper">
					<?php while ( $portfolio_content->have_posts() ) : $portfolio_content->the_post(); ?>
						
						<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> <?php hybrid_attr( 'post' ); ?>>
							
							<?php 
							// Get portfolio link.
							$house_company_portfolio_url = get_post_meta( get_the_ID(), 'url', true );
							?>
							
							<?php if ( has_post_thumbnail() && ! empty( $house_company_portfolio_url ) ) : ?>
								
								<a class="post-thumbnail" href="<?php echo esc_url( $house_company_portfolio_url ); ?>" aria-hidden="true">
									<?php the_post_thumbnail( 'munsa-medium', array( 'alt' => the_title_attribute( 'echo=0' ) ) ); ?>
								</a>
										
							<?php endif;  ?>
								
							<header class="entry-header">
								<?php the_title( sprintf( '<h2 class="entry-title" ' . hybrid_get_attr( 'entry-title' ) . '><a href="%s" rel="bookmark">', esc_url( $house_company_portfolio_url ) ), '</a></h2>' ); ?>
								<?php get_template_part( 'entry', 'meta' ); // Loads the entry-meta.php template. ?>
							</header><!-- .entry-header -->
								
						</article><!-- #post-## -->
			
					<?php endwhile; ?>
				</div><!-- .portfolio-posts-wrapper -->

			</div><!-- .portfolio-wrapper -->
		</div><!-- .portfolio-content-area -->

	<?php
		endif; // End loop.
		wp_reset_postdata(); // Reset post data.
	?>

<?php get_footer(); ?>
