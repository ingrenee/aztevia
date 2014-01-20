<?php
/**
 * The default template for displaying content. Used for both single and index/archive/search.
 *
 * @package WordPress
 * @subpackage WP Foundation
 * @since WP Foundation 0.7 
 */
 ?> <!--  content receta home -->
	<article id="post-<?php the_ID(); ?>" <?php post_class(' color-3 '); ?>>
<a href="<?php the_permalink(); ?>" class="post-link color-3" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'wp-foundation' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"> <span class="corner"></span>Leer el post</a>
 		<?php the_post_thumbnail('home-post-4'); ?>
		<header class="entry-header">
		<?php if ( is_single() ) : ?>
			<h1 class="entry-title"><?php the_title(); ?></h1>
		<?php else : ?>

			<h1 class="entry-title">
				<a href="<?php the_permalink(); ?>" class="color-font-1" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'wp-foundation' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_title(); ?></a>
			</h1>
		<?php endif; // is_single() ?>
		</header><!-- .entry-header -->

	


		<!-- .entry-meta -->
	</article><!-- #post -->