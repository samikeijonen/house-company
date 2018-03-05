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

		<?php
		munsa_post_thumbnail();

		// Gallery.
		$args = array(
			'post_parent'    => get_the_ID(),
			'post_mime_type' => 'image',
			'post_type'      => 'attachment',
			'orderby'        => 'meta_value_num',
			'meta_key'       => 'image_order',
			'order'          => 'ASC',
		);

		$attachments = get_children( $args );
		if ( $attachments ) :
			$ids = array();
			foreach ( $attachments as $attachment ) :
				$ids[]= $attachment->ID;
			endforeach;
		endif;

		// Set as comma separated list from array.
		$ids = implode( ', ', $ids );

		// Gallery shortcode attributes.
		$attr = array(
			'columns' => 8,
			'link'    => 'file',
			'ids'     => $ids,
		);
		echo gallery_shortcode( $attr );
		?>

		<header class="entry-header">
			<?php the_title( '<h1 class="entry-title" ' . hybrid_get_attr( 'entry-title' ) . '>', house_company_living_area() . house_company_item_price() . '</h1>' ); ?>
		</header><!-- .entry-header -->

		<div class="entry-content" <?php hybrid_attr( 'entry-content' ); ?>>

			<?php the_content(); ?>

			<div class="kivi-single-item-info">
				<h2 class="kivi-single-item-body-header"><?php esc_html_e( 'Yhteystiedot ja esittelyt', 'housecompany' ); ?></h2>
				<table class="kivi-item-table">
					<tbody>
						<?php view_contact_info( get_the_ID() ); ?>
					</tbody>
				</table>
			</div>

			<div class="kivi-single-item-info">
				<h2 class="kivi-single-item-body-header"><?php esc_html_e( 'Kohteen perustiedot', 'housecompany' ); ?></h2>
				<table class="kivi-item-table">
					<tbody>
						<?php view_basic_info( get_the_ID() ); ?>	
					</tbody>
				</table>
			</div>

			<div class="kivi-single-item-info">
				<h2 class="kivi-single-item-body-header"><?php esc_html_e( 'Hinta ja kustannukset', 'housecompany' ); ?></h2>
				<table class="kivi-item-table">
					<tbody>
						<?php view_cost_info( get_the_ID() ); ?>
					</tbody>
				</table>
			</div>

			<div class="kivi-single-item-info">
				<h2 class="kivi-single-item-body-header"><?php esc_html_e( 'Kohteen tiedot', 'housecompany' ); ?></h2>
				<table class="kivi-item-table">
					<tbody>
						<?php view_additional_info( get_the_ID() ); ?>
					</tbody>
				</table>
			</div>

			<div class="kivi-single-item-info">
				<h2 class="kivi-single-item-body-header screen-reader-text"><?php esc_html_e( 'Asunnon tilat ja materiaalit', 'housecompany' ); ?></h2>
				<table class="kivi-item-table">
					<tbody>
						<?php view_materials_info( get_the_ID() ); ?>
					</tbody>
				</table>
			</div>

			<div class="kivi-single-item-info">
				<h2 class="kivi-single-item-body-header screen-reader-text"><?php esc_html_e( 'Taloyhti&ouml;', 'housecompany' ); ?></h2>
				<table class="kivi-item-table">
					<tbody>
						<?php view_housing_company_info( get_the_ID() ); ?>
					</tbody>
				</table>
			</div>

		</div><!-- .entry-content -->

		<?php if ( get_kivi_option( 'kivi-gmap-id' ) ) : ?>
			<div class="kivi-single-item-map">
				<div class="wrapper">
					<div class="kivi-header-wrapper">
						<h2 class="kivi-single-item-body-header"><?php esc_html_e( 'Kartta', 'housecompany' ); ?></h2>
					</div>
					<div class="map" id="map"></div>
				</div>
				<script type="text/javascript">

					function initMap() {

						var geocoder = new google.maps.Geocoder();

						// Specify features and elements to define styles.
						var styleArray = [
							{
							featureType: "all",
							stylers: [
							{ saturation: -60 }
							]
							},{
							featureType: "road.arterial",
							elementType: "geometry",
							stylers: [
								{ hue: "#00ffee" },
								{ saturation: 20 }
							]
							},{
							featureType: "poi.business",
							elementType: "labels",
							stylers: [
								{ visibility: "off" }
							]
							}
						];


						var mapOptions = {
							zoom: 12,
							center: {lat: 60.226335, lng: 24.654287},
							scrollwheel: false,
							// Apply the map style array to the map.
							//styles: styleArray,
						}

						var map = new google.maps.Map( document.getElementById("map"), mapOptions);
						<?php echo 'var address = "' . get_post_meta( get_the_ID(), '_street', true ) . ', '. get_post_meta( get_the_ID(), '_town', true ) . '";';  ?>

						// Set the marker on the map for the first time
						setMarker(geocoder, map, address);

						// Listen for window resize and draw the marker again
						google.maps.event.addDomListener(window, 'resize', function() {
							setMarker(geocoder, map, address);
						});
						}

						function setMarker(geocoder, map, address) {
						geocoder.geocode( { 'address': address}, function(results, status) {
							if (status == google.maps.GeocoderStatus.OK) {
							map.setCenter(results[0].geometry.location);
							var marker = new google.maps.Marker({
								map: map,
								position: results[0].geometry.location
							});
							} else {
							console.log('Ceocode error: too many requests at once');
							}
						});
						}
				</script>
				<script src="https://maps.googleapis.com/maps/api/js?key=<?php echo get_kivi_option( 'kivi-gmap-id' ); ?>&callback=initMap" async defer></script>
			</div>
		<?php endif; ?>

	<?php else : ?>

		<?php if ( has_post_thumbnail() ) : ?>
			<div class="entry-thumbnail">
				<?php munsa_post_thumbnail( $post_thumbnail = 'munsa-medium' ); ?>
			</div><!-- .entry-thumbnail -->
		<?php endif; ?>

		<div class="entry-inner">

			<header class="entry-header">
				<?php the_title( sprintf( '<h2 class="entry-title" ' . hybrid_get_attr( 'entry-title' ) . '><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), house_company_living_area() . house_company_item_price() . '</a></h2>' ); ?>
				<?php get_template_part( 'entry', 'meta' ); // Loads the entry-meta.php template. ?>
			</header><!-- .entry-header-info -->

			<div class="entry-summary" <?php hybrid_attr( 'entry-summary' ); ?>>
				<?php the_excerpt(); ?>
			</div><!-- .entry-summary -->

		</div><!-- .entry-inner -->

	<?php endif; // End check single. ?>

</article><!-- #post-## -->