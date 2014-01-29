<?php
/**
 * The template for displaying posts in the Aside post format.
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */
?>
<!--  list-receta -->
<div class="list-item">
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

<div class="large-4 columns alpha">
<?php the_post_thumbnail(array(313,163) ); ?>
</div>

	
<div class="large-8  columns">

		<h1 class="">
			<a href="<?php echo esc_url( twentythirteen_get_link_url() ); ?>" class="color-font-1"><?php the_title(); ?></a>
		</h1>
		<div class="texto">
		<?php // the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'twentythirteen' ) ); 
		
		the_content_limit(200, "more")
		?>
		</div>
	
		<div class="panel-leer-mas clearfix">
		<a href="<?php echo esc_url( twentythirteen_get_link_url() ); ?>" class="leer-mas font-12  right color-2"><span class="corner-vertical"></span>Leer m&aacute;s</a>
		</div>
	
	</div><!-- .entry-content -->

	<!-- .entry-meta -->
</article><!-- #post -->

</div>