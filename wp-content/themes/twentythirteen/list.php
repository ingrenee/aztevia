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
<div class="row">
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

<div class="large-4 columns">
<?php the_post_thumbnail(array(313,163) ); ?>
</div>

	
<div class="large-8  columns">

		<h1 class="entry-title">
			<a href="<?php echo esc_url( twentythirteen_get_link_url() ); ?>"><?php the_title(); ?></a>
		</h1>
		<?php // the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'twentythirteen' ) ); 
		
		the_content_limit(300, "more")
		?>
	
	</div><!-- .entry-content -->

	<!-- .entry-meta -->
</article><!-- #post -->

</div>