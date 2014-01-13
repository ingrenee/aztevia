

<ul>
<h1>Blogs</h1>
<?php


$args = array( 'posts_per_page' => 5, 'post_type'=>'blog');

$myposts = get_posts( $args );
foreach ( $myposts as $post ) : setup_postdata( $post ); ?>
	<li> 
		<?php get_template_part( 'aztevia/templates/content', 'blog-home' ); ?>
	</li>
<?php endforeach; 
wp_reset_postdata();?>

</ul>
		
