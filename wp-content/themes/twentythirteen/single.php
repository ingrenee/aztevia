<?php
/**
 * The Template for displaying all single posts.
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */

get_header(); ?>

	<div  class=" row">
	<div class="large-8 columns">
<?php /* The loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'content', get_post_format() ); ?>
			<?php twentythirteen_post_nav(); ?>
			<?php comments_template(); ?>

			<?php endwhile; ?>
			</div>
			<div class="large-4 columns">
			sider bar 
			</div>
		<!-- #content -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>