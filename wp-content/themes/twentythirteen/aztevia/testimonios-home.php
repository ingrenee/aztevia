<?php if ( have_posts() ) : ?>



<?php


$args = array( 'posts_per_page' => 5, 'post_type'=>'testimonio');

$myposts = get_posts( $args );
foreach ( $myposts as $post ) : setup_postdata( $post ); ?>
	<div class="large-4 medium-6 small-12 columns testimonio"> 
		<?php get_template_part( 'aztevia/templates/content', 'testimonio-home' ); ?>
	</div>
<?php endforeach; 
wp_reset_postdata();?>


		
<?php else : ?>
		<?php get_template_part( 'content', 'none'); ?>
<?php endif; // end have_posts() check ?>