<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package House Company
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> <?php hybrid_attr( 'post' ); ?>>

	<?php if ( is_singular() ) : // If single. ?>
	
		<?php munsa_post_thumbnail(); ?>
	
		<header class="entry-header">
			<?php the_title( '<h1 class="entry-title" ' . hybrid_get_attr( 'entry-title' ) . '>', '</h1>' ); ?>
			<?php get_template_part( 'entry', 'meta' ); // Loads the entry-meta.php template. ?>
		</header><!-- .entry-header -->
		
		<div class="entry-content" <?php hybrid_attr( 'entry-content' ); ?>>
			
			<?php the_content(); ?>
			
			<?php echo house_company_portfolio_item_link(); ?>
			
		</div><!-- .entry-content -->
		
		<?php
			
			$xml_url = 'http://foxnet.fi/downloads/kivi_esim.xml';
			
			if ( @$data = simplexml_load_file( esc_url_raw( $xml_url ) ) ) :
					
					$role = $data->item[0]->property->attributes();
					
					echo '<pre>';
					echo $role . ': ' . $data->item[0]->property[6]->value;
					//print_r( $data->item[0] );
					echo '</pre>';
	
				// Get data from xml file.
				//print_r( $data );
				foreach( $data->children()->children() as $child ) {
					
					$role = $child->attributes();
					
					//echo $child->getName() . ": " . $child . "<br>";
					foreach( $child->children() as $items ) {
						
						if ( 'rc_buildyear' == $role ) :
							echo esc_html( 'Build year', 'house-company' ) . ": " . $items . "<br>";
						endif;
						
						if ( 'image_url' == $role ) :
							echo '<img src="' . esc_url( $items ) . '"><br>';
						endif;
						
					}
				}
	
			else :
				
				// There was some kind of error.
				esc_html_e( 'We apologize but we could not get the houses. Try again in a minute.', 'house-company' );
	
			endif;
			
			/*foreach ( $houses as $value=>$key ) {
				//echo var_dump( $key ) . 'dadaa<br>';
				
				foreach ( $key as $new=>$newkey ) {
					//echo var_dump( $newkey ) . '<br>';
					echo var_dump( $newkey );
				}
				
			}*/
			
			//var_dump( $houses->item );
			
			//print_r( $houses );

			
		?>
		
	<?php else : ?>
	
		<?php if ( has_post_thumbnail() ) : ?>
			<div class="entry-thumbnail">
				<?php munsa_post_thumbnail(); ?>
			</div><!-- .entry-thumbnail -->
		<?php endif; ?>
		
		<div class="entry-inner">
		
			<header class="entry-header">
				<?php the_title( sprintf( '<h2 class="entry-title" ' . hybrid_get_attr( 'entry-title' ) . '><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
				<?php get_template_part( 'entry', 'meta' ); // Loads the entry-meta.php template. ?>
			</header><!-- .entry-header-info -->
		
			<div class="entry-summary" <?php hybrid_attr( 'entry-summary' ); ?>>
				<?php the_excerpt(); ?>
			</div><!-- .entry-summary -->
			
		</div><!-- .entry-inner -->

	<?php endif; // End check single. ?>
	
</article><!-- #post-## -->