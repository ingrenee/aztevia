<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */

get_header(); ?>

<div  class="row bg-web search-template">
		<div class="large-12 columns ">
				<div class=" layer white">
						<?php if ( have_posts() ) : ?>
						<header class="page-header">
								<h1 class="page-title"><?php printf( __( 'Resultados de b&uacute;squeda para: %s', 'twentythirteen' ), get_search_query() ); ?></h1>
						</header>
						<?php /* The loop */ ?>
						<?php while ( have_posts() ) : the_post(); ?>
						<?php get_template_part( 'content', get_post_format() ); ?>
						<?php endwhile; ?>
						<?php twentythirteen_paging_nav(); ?>
						<?php else : ?>
						<?php get_template_part( 'content', 'none' ); ?>
						<?php endif; ?>
				</div>
				<!-- #content --> 
		</div>
		<!-- #primary --> 
</div>
<!-- #content --> 
<!-- #primary -->

<?php get_footer(); ?>
