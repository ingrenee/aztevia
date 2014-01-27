<?php
/**
 * The sidebar containing the footer widget area.
 *
 * If no active widgets in this sidebar, it will be hidden completely.
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */

if ( is_active_sidebar( 'sidebar-single1' ) ) : ?>
	<div id="secondary" class="sidebar-container" role="complementary">
		<div class="widget-area">
			<?php dynamic_sidebar( 'sidebar-single1' ); ?>
		</div><!-- .widget-area -->
	</div><!-- #secondary -->
    
    <?PHP else:?>
    
 <?php get_template_part( 'aztevia/recetas-sidebar', 'home' ); ?>
<?php endif; ?>