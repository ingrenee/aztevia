<?php if ( have_posts() ) : ?>

<ul>
<h1>Recetas</h1>
<?php


$args = array( 'posts_per_page' => 5, 'post_type'=>'receta');

$myposts = get_posts( $args );
foreach ( $myposts as $post ) : setup_postdata( $post ); ?>
	<li> 
		<?php get_template_part( 'aztevia/templates/content', 'receta-home' ); ?>
	</li>
<?php endforeach; 
wp_reset_postdata();?>

</ul>
		
<?php else : ?>
		<?php get_template_part( 'content', 'none'); ?>
<?php endif; // end have_posts() check ?>