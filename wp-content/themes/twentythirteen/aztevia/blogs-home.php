
<?php


$args = array( 'posts_per_page' => 5, 'post_type'=>'blog');

$myposts = get_posts( $args );
foreach ( $myposts as $post ) : setup_postdata( $post ); ?>
<div class="large-4 medium-6 small-12 columns blog-aztevia "> 
		<?php get_template_part( 'aztevia/templates/content', 'blog-home' ); ?>
</div>
<?php endforeach; 
wp_reset_postdata();?>


