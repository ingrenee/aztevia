<?php
/**
 * The default template for displaying content. Used for both single and index/archive/search.
 *
 * @package WordPress
 * @subpackage WP Foundation
 * @since WP Foundation 0.7 
 */
 ?> <!--  productos aztevia home -->
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<?php the_post_thumbnail('home-productos-3'); ?>
		
		<header class="entry-header">
		<img src="<?PHP echo get_post_meta($post->ID,'wpcf-imagen-de-producto',TRUE)?>">
		
		
		<div class="opa1">
		</div>

			<h1 class="entry-title">
				<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'wp-foundation' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_title(); ?></a>
			</h1>
		
		</header><!-- .entry-header -->

		

		

		<footer class="entry-meta">
		
		</footer><!-- .entry-meta -->
	</article><!-- #post -->