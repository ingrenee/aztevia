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

<div  class=" row bg-web">
	<div class="large-12 columns aztevia-page  "><?PHP breadcrumb_trail();?>
<div class="layer white">
			<?php /* The loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>

				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<header  style="display:none;">
						<?php if ( has_post_thumbnail() && ! post_password_required() ) : ?>
						<div class="entry-thumbnail">
							<?php the_post_thumbnail(); ?>
						</div>
						<?php endif; ?>

						<h1 class="entry-title"><?php the_title(); ?></h1>
					</header><!-- .entry-header -->

					<div >
						<?php the_content(); ?>
						<?php wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'twentythirteen' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>
					</div><!-- .entry-content -->

		
				</article><!-- #post -->

				<?php comments_template(); ?>
			<?php endwhile; ?>
</div>
		</div><!-- #content -->
		
		
		
		
		<!-- 
		
		<div class="large-4 columns">
			<div class="row">
            <?php // get_sidebar( 'single1' ); ?>
            </div>
			</div>-->
	</div> 


<?php get_footer(); ?>