<?php if ( have_posts() ) : ?>

<ul>
<h1>Testimonios</h1>
<?php


$args = array( 'posts_per_page' => 5, 'post_type'=>'testimonio');

$myposts = get_posts( $args );
foreach ( $myposts as $post ) : setup_postdata( $post ); ?>
	<li> 
		<?php get_template_part( 'aztevia/templates/content', 'testimonio-home' ); ?>
	</li>
<?php endforeach; 
wp_reset_postdata();?>

</ul>
		
<?php else : ?>
		<?php get_template_part( 'content', 'none'); ?>
<?php endif; // end have_posts() check ?>