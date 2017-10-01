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
						<header class="entry-header">
							<svg class="icon icon-heart" aria-hidden="true" focusable="false" xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 28 28">
								<path d="M14 26c-.25 0-.5-.094-.688-.28l-9.75-9.407c-.125-.11-3.563-3.25-3.563-7C0 4.735 2.795 2 7.467 2c2.734 0 5.297 2.156 6.53 3.375C15.234 4.155 17.797 2 20.53 2 25.202 2 28 4.734 28 9.313c0 3.75-3.438 6.89-3.58 7.03l-9.733 9.376c-.187.186-.438.28-.688.28z"/>
							</svg>
							<?php
							echo '<span class="like-count">' . absint( $count ) . '</span>';
							?>
						</header>
					</a>
				</div>
			</div>
		</div>
	<?php endforeach;
	echo '</div>';
endif;
