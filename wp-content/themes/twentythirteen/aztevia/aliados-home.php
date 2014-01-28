<?php if ( have_posts() ) : ?>



<?php


$args = array( 'posts_per_page' => 5, 'post_type'=>'aliados-estrategicos');

$myposts = get_posts( $args );
foreach ( $myposts as $post ) : setup_postdata( $post ); ?>
	<div class="large-2 medium-4 small-2 columns testimonio"> 
		<?php get_template_part( 'aztevia/templates/content', 'aliados-home' ); ?>
	</div>
<?php endforeach; 
wp_reset_postdata();?>


		
<?php else : ?>
		<?php get_template_part( 'content', 'none'); ?>
<?php endif; // end have_posts() check ?>