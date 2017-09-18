<?php
/**
 * Child pages area in Contact Info and Child Pages Templates.
 *
 * @package Munsa
 */

?>
		
		<?php // Child pages area
			$child_pages = new WP_Query( apply_filters( 'munsa_child_pages_arguments',array(
				'post_type'      => 'page',
				'orderby'        => 'menu_order',
				'order'          => 'ASC',
				'post_parent'    => $post->ID,
				'posts_per_page' => 500,
				'no_found_rows'  => true,
			) ) );
		?>

		<?php if ( $child_pages->have_posts() ) : ?>

			<div id="child-pages-area" class="child-pages-area grid-area">			
				<div class="child-pages-wrapper grid-area-wrapper">

					<?php while ( $child_pages->have_posts() ) : $child_pages->the_post(); ?>
						
						<div class="contact-person child-page">

							<?php munsa_post_thumbnail( $post_thumbnail = 'house-company-smaller'  ); ?>

							<div class="entry-person entry-child">
		
								<header class="entry-header">
									<?php the_title( sprintf( '<h3 class="entry-title" ' . hybrid_get_attr( 'entry-title' ) . '><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' ); ?>
								</header><!-- .entry-header -->
							
								<?php if ( has_excerpt() ) : ?>
									<div class="entry-summary">
										<?php the_excerpt(); ?>
									</div><!-- .entry-summary -->
								<?php else : ?>
									<div class="entry-content">
										<?php the_content(); ?>
									</div><!-- .entry-content -->
								<?php endif; ?>
	
							</div><!-- .entry-child -->

						</div><!-- .child-page -->
				
					<?php endwhile; ?>

				</div><!-- .child-pages-wrapper -->
			</div><!-- #child-pages-area -->

		<?php
			endif; // End loop.
			wp_reset_postdata(); // Reset post data.
		?>
		
		<?php
			// Get partner page content and it's child pages.
			$house_company_partners = absint( get_theme_mod( 'partner_page' ) );
			
			if ( ! is_page( $house_company_partners ) && ( 0 != $house_company_partners || ! empty( $house_company_partners ) ) ) : // Check if page is selected. ?>
				
				<div class="partners-area">
				
					<article id="post-<?php echo $house_company_partners; ?>" <?php post_class( $class = '', $post_id = $house_company_partners ); ?> <?php hybrid_attr( 'post' ); ?>>
				
						<header class="entry-header">
							<h2 class="entry-title" <?php echo hybrid_get_attr( 'entry-title' ); ?>><?php echo get_the_title( $house_company_partners ); ?></h2>
						</header><!-- .entry-header -->
					
						<div class="entry-content">
							<?php
								echo apply_filters( 'the_content', ( get_post_field( 'post_content', $house_company_partners ) ) );
							?>
						</div><!-- .entry-content -->
					
					</article><!-- .post-## -->
					
					<?php // Child pages area
					$partner_pages = new WP_Query( apply_filters( 'house_company_partners_arguments',array(
						'post_type'      => 'page',
						'orderby'        => 'menu_order',
						'order'          => 'ASC',
						'post_parent'    => $house_company_partners,
						'posts_per_page' => 500,
						'no_found_rows'  => true,
					) ) );
					?>

					<?php if ( $partner_pages->have_posts() ) : ?>

						<div id="partners-child-pages-area" class="partners-child-pages-area child-pages-area grid-area">			
							<div class="child-pages-wrapper grid-area-wrapper">

								<?php while ( $partner_pages->have_posts() ) : $partner_pages->the_post(); ?>
						
									<div class="contact-person child-page">

										<?php munsa_post_thumbnail( $post_thumbnail = 'house-company-smaller'  ); ?>

										<div class="entry-person entry-child">
		
											<header class="entry-header">
												<?php the_title( sprintf( '<h3 class="entry-title" ' . hybrid_get_attr( 'entry-title' ) . '><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' ); ?>
											</header><!-- .entry-header -->
							
											<?php if ( has_excerpt() ) : ?>
												<div class="entry-summary">
													<?php the_excerpt(); ?>
												</div><!-- .entry-summary -->
											<?php else : ?>
												<div class="entry-content">
													<?php the_content(); ?>
												</div><!-- .entry-content -->
											<?php endif; ?>
	
										</div><!-- .entry-child -->

									</div><!-- .child-page -->
				
								<?php endwhile; ?>

							</div><!-- .child-pages-wrapper -->
						</div><!-- .child-pages-area -->

					<?php
						endif; // End loop.
						wp_reset_postdata(); // Reset post data.
					?>
					
				</div><!-- .partners-area -->
				
			<?php endif; ?>