<?php
/**
 * Get Instagram Feed.
 *
 * @package House Company
 */

// Instagram feed.
if ( function_exists( 'dude_insta_feed' ) && get_theme_mod( 'insta_access_token' ) ) :
	echo '<div class="insta-feed-section grid-wrapper grid-wrapper-3cl">';

	$title = get_theme_mod( 'insta_title' );
	if ( $title ) :
		echo '<h2 class="insta-title">' . esc_html( $title ) . '</h2>';
	endif;

	$instagram_feed = dude_insta_feed()->get_user_images( '2303846579' );
	foreach ( $instagram_feed['data'] as $item ) : ?>
		<div class="insta-feed-wrapper">
			<div class="entry-inner entry-inner-bg" style="background-image:url('<?php echo esc_url( $item['images']['standard_resolution']['url'] ); ?>');">
				<div class="bg-wrapper">
					<?php
					// Likes.
					$count = $item['likes']['count'];
					?>
					<a href="<?php echo esc_url( $item['link'] ); ?>" target="_blank" aria-label="<?php echo absint( $count ) . esc_html( ' likes', 'house-company' ); ?>">
					</a>
				</div>
			</div>
		</div>
	<?php endforeach;
	echo '</div>';
endif;
