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
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<header class="entry-header">

<?php the_post_thumbnail(array(120,120) ); ?>
		<h1 class="entry-title">
			<a href="<?php echo esc_url( twentythirteen_get_link_url() ); ?>"><?php the_title(); ?></a>
		</h1>

		<div class="entry-meta">
			<?php twentythirteen_entry_date(); ?>
			<?php // edit_post_link( __( 'Edit', 'twentythirteen' ), '<span class="edit-link">', '</span>' ); ?>
		</div><!-- .entry-meta -->
	</header>
	
	<div class="entry-content">
		<?php // the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'twentythirteen' ) ); 
		
		the_content_limit(300, "more")
		?>
	
	</div><!-- .entry-content -->

	<!-- .entry-meta -->
</article><!-- #post -->
