<?PHP
define('WP_USE_THEMES', false);
global $wp, $wp_query, $wp_the_query, $wp_rewrite, $wp_did_header;
require('../../../wp-load.php');
require_once('../../../wp-includes/pluggable.php');

?>

<?PHP
if(!empty($_POST['evento-id'])):
/* s eintenta guardar un registro*/
 $nonce=$_POST['_wpnonce'];
$r=$_POST['_wp_http_referer'];
$r=explode('?',$r);
$r=$r[0];
if ( !wp_verify_nonce( $nonce, 'register-evento' ) ):
    // This nonce is not valid.
    die( 'Security check' ); 
else:














   /*
   campos:
   nombres, email,  dni, celular, frase, kit, evento-id
   */
   $fields='nombres,email,dni,celular,frase,kit,evento-id';
   $field=explode(',',$fields);
   $flag=true;
   foreach($field as $campo):
   
   //echo $campo.'-'.strlen($campo).'<br>';
   if(strlen($_POST[$campo])<=0):
   $flag=false;
   break;
   endif;
   
   endforeach;
   
   if($flag):
   /* podemos grabar */
   
   $nombres=$_POST['nombres'];
   $email=$_POST['email'];
   $dni=$_POST['dni'];
   $celular=$_POST['celular'];
   $frase=$_POST['frase'];
   $tmp=$_POST['kit'];            
   $evento_id=$_POST['evento-id'];
   $tmp=explode('-',$tmp);
   $kit_id=$tmp[0];
   $kit_nombre=$tmp[1];
       
   $evento_nombre=$_POST['evento-nombre'];               
         
		 /* verificar si existe */
		  echo $email;
$arg= array(
'post_type' => 'registro',
'numberposts' => -1,
'order' => 'ASC',
'post_status' => 'any',
'post_parent'      => $evento_id,
'meta_query' => array(array('key' => 'wpcf-registro-email', 'value' => $email))
);
$registros= get_posts($arg);
		
		$existe=count($registros);
		
		 /* fin verificar si existe */
		 
		 
		 
		 if($existe<=0):
		 
								
					 
			   $post = array(
			
			  'post_content'   => $texto,
			
			  'post_title'     => $email.'-'.$evento_nombre,
			  'post_status'    => 'pending',
			  'post_type'      => 'registro', // Default 'post'.
			  
			  
			  'post_parent'    => $evento_id // Sets the parent of the new post, if any. Default 0.
			 
			 
			);  
			   //$id=wp_insert_post( $post);
			
							if(($id)>0):
							
							
							add_post_meta( $id, 'wpcf-registro-nombre-kit', $kit_nombre );
							add_post_meta( $id, 'wpcf-registro-nombre-evento', $evento_nombre );
							add_post_meta( $id, 'wpcf-registro-email', $email );
							add_post_meta( $id, 'wpcf-registro-celular', $celular );
							add_post_meta( $id, 'wpcf-registro-dni', $dni );
							add_post_meta( $id, 'wpcf-registro-nombres', $nombres );
							add_post_meta( $id, 'wpcf-registro-frase', $frase );
							
							add_post_meta( $id, '_wpcf_belongs_evento_id', $evento_id );
							add_post_meta( $id, '_wpcf_belongs_kit_id', $kit_id );
							
							/* exito */
							/* enviar email */
							
							
							 $err='?r=complete&e=0';
				 wp_redirect($r.$err);
							
							
							else:
							// ocurrio un error
							 $err='?r=error&e=2';
							 
			  wp_redirect($r.$err);
							endif;
		 
		 
		 else:
		 /* ya existe*/
		 
		 		 $err='?r=ya-esta-registrado&e=3';
							 
			  wp_redirect($r.$err);
		 endif;
		 
   
   
   else:
   /* mostrar formulario*/
   $err='?r=complete-field&e=1';
   wp_redirect($r.$err);
   endif;
   
   
   
endif;
/* mostrar formulario*/


else:
/* estan accediendo directamente*/

//wp_redirect($r.'?r=not-direct');

die('Not access direct');
endif;