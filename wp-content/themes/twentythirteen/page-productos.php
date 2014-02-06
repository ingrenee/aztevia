<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that other
 * 'pages' on your WordPress site will use a different template.
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */

get_header(); ?>

<?PHP
 $post_type=get_post_type( $id ) ;
?>

<div id="main" class="large-12 columns" role="main">
		<div class="row bg-web listado <?PHP echo $post_type;?>-listado">
				<div class="large-12 columns">
						<div class="layer white">
								<div class="large-3 columns alpha omega">
										<h2 class="title-archive">Selecciona tu categoria</h2>
										<div class="taxonomy-list-content">
												<?PHP aztevia_categorias(false);?>
										</div>
										<?php get_sidebar(); ?>
								</div>
								<?PHP
								query_posts( array( 'posts_per_page' => -1, 'post_status' => 'publish' ) );
								?>
								<div class="large-9 columns ">
										<?php if ( have_posts() ) : ?>
										
										<!-- .archive-header -->
										
										<?php /* The loop */ ?>
										<?php while ( have_posts() ) : the_post(); ?>
                                        
										<div class="large-4 medium-6 columns ">
										<?php get_template_part( 'list', 'productos' ); ?>
                                        </div>
										<?php endwhile; ?>
										<?PHP
										wp_reset_query();
										?>
										<?php twentythirteen_paging_nav(); ?>
										<?php else : ?>
										<?php get_template_part( 'content', 'none' ); ?>
										<?php endif; ?>
										<!-- #content --> 
										<!-- #primary --> 
										
								</div>
						</div>
				</div>
		</div>
</div>
<?php get_footer(); ?>
