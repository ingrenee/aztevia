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


		<a href="<?php the_permalink(); ?>" class="permalink" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'wp-foundation' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark">
                
        <?php the_post_thumbnail('thumbnail'); ?>
                
        </a>

		
	  <!-- .entry-header -->

		



		<!-- .entry-meta -->
	  <div class="clear"></div>
	</article><!-- #post -->