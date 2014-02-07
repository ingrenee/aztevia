<?php
/**
 * The template for displaying posts in the Aside post format.
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */
?>
<span class="system"> list-productoss.php</span>
<!--  list-receta -->
<article id="post-<?php the_ID(); ?>" <?php post_class('producto-item'); ?>>
  <div class="precios">
  <div class="precios-content">
  <span class="descuento">Dscto. 80%</span>
  <span class="precio">S/. 800.00</span>
  </div>
  </div>
  
  <div class="producto-item-image">
  <?php the_post_thumbnail('listado-images'); ?>
  </div>
  
  <h1 class="">
      <a href="<?php echo esc_url( twentythirteen_get_link_url() ); ?>" class="color-font-1"><?php the_title(); ?></a>
      </h1>
  <div class="producto-item-content">
    
    
    <div class="texto">
      <?php // the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'twentythirteen' ) ); 
		
		the_content_limit(200, "more")
		?>
    </div>
    
    <div class="">
      <a href="<?php echo esc_url( twentythirteen_get_link_url() ); ?>" class="mas-informacion    color-font-1">M&aacute;s informaci&oacute;n ...</a>
      </div>
    
    <div class="">
    <a href="#" class="agregar-carrito"><span>Agregar al carrito</span></a>
    </div>
    
  </div><!-- .entry-content -->
  
  <!-- .entry-meta -->
  <div class="clear">
  </div>
</article><!-- #post -->

