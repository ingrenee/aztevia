<?php
/**
 * The Template for displaying all single posts.
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */

get_header(); ?>

<?PHP
 $post_type=get_post_type( ) ;
?>

<?PHP if($post_type=='post'):?>
<div class="large-12  columns">
	<div  class="row bg-web">
	<div class="large-12 columns ">
	<div class=" layer white">
	<div class="large-8 columns aztevia-single">
<?php /* The loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>
<?PHP
//echo get_post_type( get_the_ID() );
?>
			<?php get_template_part( 'content', get_post_type( get_the_ID() ) ); ?>
			<?php twentythirteen_post_nav(); ?>
			<?php comments_template(); ?>

			<?php endwhile; ?>
			</div>
			<div class="large-4 columns">
			<div class="row">
            <?php get_sidebar( 'single1' ); ?>
            </div>
			</div>
		<!-- #content -->
	</div><!-- #primary -->
</div>
</div>
</div>
<?PHP else:?>

<div class="large-12  columns">
	<div  class="row bg-web">
	<div class="large-12 columns ">
	<div class=" layer white">
	
	
		<div class="large-3 columns alpha omega">
				
			<h2 class="title-archive">Selecciona tu categoria</h2>
			
			<div class="taxonomy-list-content">
			<?PHP aztevia_categorias(get_the_ID());?>	
			</div>	
		</div>
	
	
	
	<div class="large-9 columns aztevia-single">
<?php /* The loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>
<?PHP
//echo get_post_type( get_the_ID() );
?>
			<?php get_template_part( 'content', get_post_type( get_the_ID() ) ); ?>
			<?php twentythirteen_post_nav(); ?>
			<?php comments_template(); ?>

			<?php endwhile; ?>
			</div>
			
		<!-- #content -->
	</div><!-- #primary -->
</div>
</div>
</div>



<?PHP endif;?>
<?php //get_sidebar(); ?>
<?php get_footer(); ?>