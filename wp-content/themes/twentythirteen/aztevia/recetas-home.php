<?php if ( have_posts() ) : ?>


<?php


$args = array( 'posts_per_page' => 3, 'post_type'=>'receta');

$myposts = get_posts( $args );
foreach ( $myposts as $post ) : setup_postdata( $post ); ?>
<div class="large-4 medium-6 small-12 columns receta"> 
		<?php get_template_part( 'aztevia/templates/content', 'receta-home' ); ?>
</div>
<?php endforeach; 
wp_reset_postdata();?>


		
<?php else : ?>
		<?php get_template_part( 'content', 'none'); ?>
<?php endif; // end have_posts() check ?>