<?PHP
$options = get_option( 'wedevs_basics' );
?>

<?php if ( have_posts() ) : ?>
<?PHP
$conf[0]=($options['productos_aztevia_fila_1'])?$options['productos_aztevia_fila_1']:3;
$conf[1]=($options['productos_aztevia_fila_2'])?$options['productos_aztevia_fila_2']:3;
$conf[2]=($options['productos_aztevia_fila_3'])?$options['productos_aztevia_fila_3']:3;
$conf[3]=($options['productos_aztevia_fila_4'])?$options['productos_aztevia_fila_4']:3;



?>

<div class="row producto-home-aztevia">

<?php


//$args = array( 'posts_per_page' => 1, 'post_type'=>'post');

$myposts = get_posts( 'category_name=productos-aztevia&numberposts='.$options['productos_aztevia_num'] );
$i=0;
$k=0;

foreach ( $myposts as $post ) : setup_postdata( $post ); ?>

<?PHP
$tam=12/$conf[$k];
	
if($i==0):
?>

<?PHP
$flag=false;
	endif;
	?><div class="bloque-home  small-10   medium-6  small-centered large-uncentered  medium-uncentered  large-<?PHP echo (round($tam));?>  t-<?PHP echo $tam;?> pos-<?PHP echo $i;?> columns">
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