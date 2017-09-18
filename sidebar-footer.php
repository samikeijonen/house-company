<?php
/**
 * Footer Sidebar.
 *
 * @package Munsa
 */
?>

<?php if ( is_active_sidebar( 'footer' ) ) : // If the sidebar has widgets. ?>

	<aside id="sidebar-footer" class="sidebar-footer sidebar" role="complementary" <?php hybrid_attr( 'sidebar', 'footer' ); ?>>
		<h2 class="screen-reader-text" id="sidebar-footer-header"><?php echo esc_html_x( 'Footer Sidebar', 'Sidebar aria label', 'housecompany' ); ?></h2>
		
		<?php get_template_part( 'menus/menu', 'social' ); // Loads the menus/menu-social.php template. ?>	
		
		<div class="wrap">
		
			<?php dynamic_sidebar( 'footer' ); ?>
	
		</div><!-- .wrap -->

	</aside><!-- #sidebar-footer .sidebar -->

<?php endif; // End sidebar check.