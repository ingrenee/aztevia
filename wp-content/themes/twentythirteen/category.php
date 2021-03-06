<?php
/**
 * The template for displaying Category pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */

get_header(); ?>

	<span class="system"> category.php </span>
	
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
										<header class="archive-header" style="display:none;">
												<h1 class="archive-title">
														<?php
											if ( is_day() ) :
												printf( __( 'Daily Archives: %s', 'twentythirteen' ), get_the_date() );
											elseif ( is_month() ) :
												printf( __( 'Monthly Archives: %s', 'twentythirteen' ), get_the_date( _x( 'F Y', 'monthly archives date format', 'twentythirteen' ) ) );
											elseif ( is_year() ) :
												printf( __( 'Yearly Archives: %s', 'twentythirteen' ), get_the_date( _x( 'Y', 'yearly archives date format', 'twentythirteen' ) ) );
											else :
												_e( 'Archives', 'twentythirteen' );
											endif;
										?>
												</h1>
										</header>
										<!-- .archive-header -->
										
										<?php /* The loop */ ?>
										<?php while ( have_posts() ) : the_post(); ?>
										<?php get_template_part( 'list', get_post_type( get_the_ID() ) ); ?>
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