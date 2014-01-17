<?php if ( have_posts() ) : ?>
<?PHP
$conf[0]=3;
$conf[1]=2;
$conf[2]=0;



?>

<div class="row producto-home-aztevia">

<?php


$args = array( 'posts_per_page' => 6, 'post_type'=>'post');

$myposts = get_posts( 'category_name=productos-aztevia&numberposts=20' );
$i=0;
$k=0;

foreach ( $myposts as $post ) : setup_postdata( $post ); ?>

<?PHP
$tam=10/$conf[$k];
	
if($i==0):
?>

<?PHP
$flag=false;
	endif;
	?><div class="bloque-home large-custom-<?PHP echo round($tam)?> pos-<?PHP echo $i;?> columns">
	<div class="opa2">
	</div>
		<?php get_template_part( 'aztevia/templates/content', 'productosaztevia-home' ); ?>
	</div>
	<?PHP $i++;?>
	<?PHP if($i>=$conf[$k]): $i=0; $k++; ?>

	<?PHP  $flag=true; endif;?>
<?php endforeach; 
wp_reset_postdata();?></div>
<?PHP if(!$flag):?>

<?PHP endif;?>

		

<?php else : ?>
		<?php get_template_part( 'content', 'none'); ?>
<?php endif; // end have_posts() check ?>