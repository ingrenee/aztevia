<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme and one of the
 * two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * For example, it puts together the home page when no home.php file exists.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */

get_header(); ?>

	<?PHP if(is_home()):?>
	<div   class="large-12 columns"  >
	
	<?php get_template_part( 'aztevia/productosaztevia', 'home' ); ?>
	
	
	<?php // get_template_part( 'aztevia/productos', 'home' ); ?>
	
	<div class="row bg-web">
	<div class="large-12 columns ">
	
	<h1 class="title testimonios">Testimonios</h1>
	
	<div class="layer white">
	
	<?php get_template_part( 'aztevia/testimonios', 'home' ); ?>
	</div></div></div>
	
    
    <div class="row bg-web">
	<div class="large-12 columns">
    <h1 class="title recetas">Recetas</h1>
    <div class="layer white">
	<?php get_template_part( 'aztevia/recetas', 'home' ); ?>
    </div>
    </div>
	</div>
    
    
    <div class="row bg-web">
	<div class="large-12 columns">
    <h1 class="title blogs">Blog</h1>
    <div class="layer white">
	<?php get_template_part( 'aztevia/blogs', 'home' ); ?>
	</div></div></div>
    
    
    
    
    <div class="row bg-web ">
	<div class="large-12 columns-aliado columns">
    <h1 class="title aliados">Aliados estrat&eacute;gicos</h1>
    <div class="layer white layer-center">
	<?php get_template_part( 'aztevia/aliados', 'home' ); ?>
    </div>
    </div>
	</div>
    
    
    
	
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
<?php get_sidebar(); ?>
<?php get_footer(); ?>