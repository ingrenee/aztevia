<?php
/**
 * The default template for displaying content. Used for both single and index/archive/search.
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */
?>
<!-- content default  -->

<span class="system"> content.php </span>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	
	<div class="row">
	

	<div class="large-12 columns">

	  <!-- .entry-meta -->
	<!-- .entry-header -->

	<?php if ( is_search() ) : // Only display Excerpts for Search ?>
	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div><!-- .entry-summary -->
	<?php else : ?>
	<div class="entry-content">
    
    
    
    <?php if ( has_post_thumbnail() && ! post_password_required() ) : ?>
		
		
		
		
	  <div class="custom-image-content">
			
		
		  <div class="custom-image">			<?php the_post_thumbnail('custom-image'); ?>
		</div>
        
        <div class="social-bar">
		  <?php postbar(); ?>
</div>
        
	  </div>
<?PHP endif;?>
	

	  <?php if ( is_single() ) : ?>
	  <h1 class="entry-title color-font-1"><?php the_title(); ?></h1>
	  <?php else : ?>
	  <h1 class="entry-title">
		  <a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
	  </h1>
	  <?php endif; // is_single() ?>

	  <div class="">
		  <?PHP // echo do_shortcode('[rate]');?>
	  </div>

 <?php if ( !(has_post_thumbnail() && ! post_password_required() )) : ?>
       <div class="social-bar">
		  <?php postbar(); ?>
</div>
 <?PHP endif;?>    
    
    
    
    
    
    <div class="contenido">
		<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'twentythirteen' ) ); ?>
		<?php wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'twentythirteen' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>
        
        </div>
        
	</div><!-- .entry-content -->
	<?php endif; ?>
	 
	
	</div>
	</div>



<?PHP
 $post_type=get_post_type( ) ;
?>

<?PHP if($post_type=='evento'):?>

<?php get_template_part( 'form', 'evento' ); ?>

<?PHP endif;?>




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
