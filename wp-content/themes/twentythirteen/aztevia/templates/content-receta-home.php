<?php
/**
 * The default template for displaying content. Used for both single and index/archive/search.
 *
 * @package WordPress
 * @subpackage WP Foundation
 * @since WP Foundation 0.7 
 */
 ?> <!--  content receta home -->
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

			<?php the_post_thumbnail('home-receta-4'); ?>
            <a href="<?php the_permalink(); ?>" class="post-link color-2" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'wp-foundation' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><span class="corner"></span>Leer más</a>
            
		<header class="entry-header color-1">
		<?php if ( is_single() ) : ?>
			<h1 class="entry-title"><?php the_title(); ?></h1>
		<?php else : ?>

			<h1 class="entry-title">
				<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'wp-foundation' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_title(); ?></a>
			</h1>
            <p><?PHP echo get_post_meta($post->ID,'wpcf-texto-portada',TRUE)?></p>
		<?php endif; // is_single() ?>
		</header><!-- .entry-header -->

	


		<!-- .entry-meta -->
	</article><!-- #post -->