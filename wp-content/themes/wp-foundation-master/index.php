<?php
/**
 * The main template file.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage WP Foundation
 * @since WP Foundation 0.7
 */
get_header(); ?>
	
	<?PHP if(is_home()):?>
	<div id="main" class="large-12 columns" role="main">
	
	<?php get_template_part( 'aztevia/productos', 'home' ); ?>
	
	<?php get_template_part( 'aztevia/testimonios', 'home' ); ?>
	
	<?php get_template_part( 'aztevia/recetas', 'home' ); ?>
	
	<?php get_template_part( 'aztevia/blogs', 'home' ); ?>
	
	
	</div>	
	
	<?PHP else:?>


	<div id="main" class="large-8 columns" role="main">
	<?php if ( have_posts() ) : ?>

		<?php while ( have_posts() ) : the_post(); ?>
			<?php get_template_part( 'content', get_post_format() ); ?>
		<?php endwhile; ?>
		
	<?php else : ?>
		<?php get_template_part( 'content', 'none'); ?>
	<?php endif; // end have_posts() check ?>
	</div><!-- .large-8 .columns -->
	
	<div id="sidebar" class="large-4 columns">
		<?php get_sidebar(); ?>
	</div><!-- .large-4 .columns -->


	<?PHP endif;?>	
<?php 
get_footer();