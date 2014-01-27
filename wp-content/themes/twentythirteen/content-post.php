<?php
/**
 * The default template for displaying content. Used for both single and index/archive/search.
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */
?>
<!-- content -->


<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	
	<div class="row">
	

	<div class="large-12 columns">
	
	<header class="entry-header">
	<?php if ( has_post_thumbnail() && ! post_password_required() ) : ?>
		
		<?PHP  $galeria=get_post_meta($post->ID,'wpcf-galeria-de-imagenes',TRUE);?>
		<?PHP $css_galeria='sin-galeria';?>		
		<?PHP if(!empty($galeria)):?>
		<div class="galeria-single entry-thumbnail">
			
			<?PHP echo do_shortcode($galeria);?>
			
			
			<div class="social-bar">
			<?php postbar(); ?>
			</div>
		</div>
		<?PHP $css_galeria='con-galeria';?>
		<?PHP endif;?>
		<?php endif; ?>
	

		<?php if ( is_single() ) : ?>
		<h1 class="entry-title color-font-1"><?php the_title(); ?></h1>
		<?php else : ?>
		<h1 class="entry-title">
			<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
		</h1>
		<?php endif; // is_single() ?>
<div class="franja-gris <?PHP echo $css_galeria;?>"><div class="precio color-1">
		
		<div class="fila"> Precio:</div>
		
		<div class="fila precio-valor"><span>S/.</span><?PHP
		echo get_post_meta($post->ID,'wpcf-precio',TRUE);
		?>
		</div>
		</div>
		<div class="entry-meta">
			<?php twentythirteen_entry_meta(); ?>
			<?php // edit_post_link( __( 'Edit', 'twentythirteen' ), '<span class="edit-link">', '</span>' ); ?>
		</div>
		
		
		
		
		</div>
		<div class="">
			<?PHP // echo do_shortcode('[rate]');?>
		</div>
		<!-- .entry-meta -->
	</header><!-- .entry-header -->

	<?php if ( is_search() ) : // Only display Excerpts for Search ?>
	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div><!-- .entry-summary -->
	<?php else : ?>
	<div class="entry-content">
		<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'twentythirteen' ) ); ?>
		<?php wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'twentythirteen' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>
	</div><!-- .entry-content -->
	<?php endif; ?>
	
	
	</div>
	</div>

	<footer class="entry-meta">
		<?php if ( comments_open() && ! is_single() ) : ?>
			<div class="comments-link">
				<?php comments_popup_link( '<span class="leave-reply">' . __( 'Leave a comment', 'twentythirteen' ) . '</span>', __( 'One comment so far', 'twentythirteen' ), __( 'View all % comments', 'twentythirteen' ) ); ?>
			</div><!-- .comments-link -->
		<?php endif; // comments_open() ?>

		<?php if ( is_single() && get_the_author_meta( 'description' ) && is_multi_author() ) : ?>
			<?php get_template_part( 'author-bio' ); ?>
		<?php endif; ?>
	</footer><!-- .entry-meta -->
</article><!-- #post -->
