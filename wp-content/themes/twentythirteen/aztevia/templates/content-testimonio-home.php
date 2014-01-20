<?php
/**
 * The default template for displaying content. Used for both single and index/archive/search.
 *
 * @package WordPress
 * @subpackage WP Foundation
 * @since WP Foundation 0.7 
 */
 ?> <!--  content receta home -->
	<article id="post-<?php the_ID(); ?>" <?php post_class(' color-a '); ?>>

		
		<header class="entry-header">
		<?php if ( is_single() ) : ?>
			<h1 class="entry-title"><?php the_title(); ?></h1>
		<?php else : ?>

			<h1 class="entry-title">
				<a href="<?php the_permalink(); ?>" class="permalink" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'wp-foundation' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_title(); ?></a>
			</h1>
		<?php endif; // is_single() ?>
		
		<p>
		<?PHP echo get_post_meta($post->ID,'wpcf-testimonio',TRUE)?>
		</p>
		
		</header><!-- .entry-header -->

		



		<div class="entry-meta">
		<div class="imagen">
		<?php the_post_thumbnail('thumbnail'); ?>
		<a href="<?php the_permalink(); ?>" class="permalink" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'wp-foundation' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark">Ver la entrevista <span class="corner"></span></a>
		</div>
				
		
		</div><!-- .entry-meta -->
		<div class="clear"></div>
	</article><!-- #post -->