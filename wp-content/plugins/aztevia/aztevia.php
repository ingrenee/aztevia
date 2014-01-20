<?PHP
/**
 * Plugin Name: Aztevia funciones
 * Plugin URI: none
 * Description: adjuta funciones de  personalizacion para aztevia.com
 * Version: 1.0
 * Author: Renee Morales Calhua
 * Author URI: Renee Morales
 * License: Renee
 */


function change_post_menu_label() {
global $menu;
global $submenu;
$menu[5][0] = 'Producto';
$submenu['edit.php'][5][0] = 'Producto';
$submenu['edit.php'][10][0] = 'Nuevo Productos';
$submenu['edit.php'][16][0] = 'Productos Tags';
echo '';
}
function change_post_object_label() {
global $wp_post_types;
$name='Producto';
$labels = &$wp_post_types['post']->labels;
$labels->name = $name;
$labels->singular_name =$name;
$labels->add_new ='Nuevo '.$name;
$labels->add_new_item ='Nuevo '.$name;
$labels->edit_item = 'Editar '.$name;
$labels->new_item =  'Nuevo '.$name;
$labels->view_item =  'Ver '.$name;
$labels->search_items =  'Buscar '.$name;
$labels->not_found = 'No se encuentra';
$labels->not_found_in_trash = 'No se encuentra en la papelera';
 }
add_action( 'init', 'change_post_object_label' );
add_action( 'admin_menu', 'change_post_menu_label' );


/*
add_action( 'pre_get_posts', 'add_my_post_types_to_query' );

function add_my_post_types_to_query( $query ) {
	if ( is_home() && $query->is_main_query() )
		$query->set( 'post_type', array( 'post', 'recetas' ) );
	return $query;
}
*/


if ( function_exists( 'add_image_size' ) ) { 
	add_image_size( 'home-productos-3', 500, 370,true ); //300 pixels wide (and unlimited height)
	add_image_size( 'home-productos-5', 515, 370, true ); //(cropped)
	add_image_size( 'home-testimonio-4', 190, 190, true ); //(cropped)
		add_image_size( 'home-receta-4', 320, 213, true ); //(cropped)
		add_image_size( 'home-post-4', 120,180 , true ); //(cropped)
}