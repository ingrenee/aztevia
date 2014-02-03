
<span class="system">form-evento</span>
<br>










<form method="post" action="<?php echo get_template_directory_uri(); ?>/action-register.php">
<input type="hidden" name="evento-id"  value="<?php echo  get_the_ID(); ?> ">
<input type="hidden" name="evento-nombre"  value="<?php echo  get_the_title(); ?> ">

<?php wp_nonce_field('register-evento'); ?>
<div  class="evento-formulario">
<h1  class="title-form color-border-1"><span class="color-1">1. Ingresa  tus datos</span></h1>

<div class="formulario">
<div class="formulario-content">

<div class="corner-top"></div>

 

<div class="fila">
<label>
<span>Nombres completos</span>
<input name="nombres" type="text" id="nombres">
</label>
</div>



<div class="fila">
<label>
<span>Correo electrónico</span>
<input name="email" type="text" id="email">
</label>
</div>


<div class="fila">
<label>
<span>Celular</span>
<input name="celular" type="text" id="celular">
</label>
</div>


<div class="fila">
<label>
<span>DNI</span>
<input name="dni" type="text" id="dni">
</label>
</div>
</div>




</div>


<h1  class="title-form  color-border-1"><span class="color-1">2. Seleccion tu kit</span></h1>
<div class="formulario">
<div class="corner-top"></div>
<ul>
<?PHP

$childargs = array(
'post_type' => 'kit',
'numberposts' => -1,
'order' => 'ASC',
'meta_query' => array(array('key' => '_wpcf_belongs_evento_id', 'value' => get_the_ID()))
);
$child_posts = get_posts($childargs);



//$child_posts = types_child_posts('kit');
foreach ($child_posts as $child_post) {
  
  //setup_postdata($child_post);
  // print_r($child_post);
  //get_permalink( $id );
  ?>
 <li class="row">
<label> 
<div class="kit large-11 columns">
<div class="large-1 columns"><input type="radio" value="<?PHP echo $child_post->ID ?>-<?PHP  echo $child_post->post_title; ?>" name="kit"></div> 
<div class="image large-5 columns">
<?php echo get_the_post_thumbnail( $child_post->ID ,'custom-image-kit'); ?> 
</div>
<div  class="large-6 columns">
<h4><?PHP  echo $child_post->post_title; ?></h4>
<div class="resumen"><?PHP  echo $child_post->post_content; ?></div>
 </div>
 </div>
 </label>
 </li>
  <?PHP
}
//wp_reset_postdata();
?>

</ul>
</div>





<h1  class="title-form  color-border-1"><span class="color-1">3. Personaliza tu polo</span></h1>
<div class="formulario"><div class="formulario-content">
<div class="corner-top"></div>



<div class="fila">
<label>
<span>Escribe tu nombre</span>
<input name="frase" type="text" id="frase">
</label>
</div>


<div class="fila">
<label>
<span>Vista previa</span>

[polo]

</label>
</div>
</div>
</div>
<br><br>
<div class="large-7 large-centered columns">
<button class="boton-contacto large-12 large-centered columns" type="submit">Inscríbete</button>
</div>
</div>
</form>