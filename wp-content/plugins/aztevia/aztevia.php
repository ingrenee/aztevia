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
		
		add_image_size( 'listado-images', 313,163 , false ); //(cropped)
		add_image_size( 'custom-image', 415,366 , false ); //(cropped)	
		
			add_image_size( 'custom-image-kit', 150,150 , false ); //(cropped)	
						add_image_size( 'custom-image-search', 200,200 , false ); //(cropped)		

		
		
}


function the_content_limit($max_char, $more_link_text = '(more...)', $stripteaser = 0, $more_file = '') {
    $content = get_the_content($more_link_text, $stripteaser, $more_file);
    $content = apply_filters('the_content', $content);
    $content = str_replace(']]>', ']]&gt;', $content);
    $content = strip_tags($content);

   if (strlen($_GET['p']) > 0) {
      echo "";
      echo $content;
      echo "";
   }
   else if ((strlen($content)>$max_char) && ($espacio = strpos($content, " ", $max_char ))) {
        $content = substr($content, 0, $espacio);
        $content = $content;
        echo "";
        echo $content;
        echo "...";
        echo "";
   }
   else {
      echo "";
      echo $content;
      echo "";
   }
}


function aztevia_categorias($id)
{
	
	
	if($id):
	  $post_type=get_post_type( $id ) ;
	
	  $taxonomy= get_object_taxonomies( $post_type);
	  else:
	  $post_type="post";
	  $taxonomy[0]='category';
	  
endif;
$args = array(
	'show_option_all'    => '',
	'orderby'            => 'name',
	'order'              => 'ASC',
	'style'              => 'list',
	'show_count'         => 1,
	'hide_empty'         => 0,
	'use_desc_for_title' => 1,
	'child_of'           => 0,
	'feed'               => '',
	'feed_type'          => '',
	'feed_image'         => '',
	'exclude'            => '',
	'exclude_tree'       => '',
	'include'            => '',
	'hierarchical'       => 1,
	'title_li'           => __( '' ),
	'show_option_none'   => __('No hay categorias'),
	'number'             => 5,
	'echo'               => 1,
	'depth'              => 10,
	'current_category'   => 0,
	'pad_counts'         => 0,
	'taxonomy'           => $taxonomy[0],
	'walker'             => null
); 
   $this_category = wp_list_categories($args);
echo '<ul>'. $this_category . '</ul>';


	}
	
	/*------------------------------------------------*/
	
	
	class AzteviaConfig
{
    /**
     * Holds the values to be used in the fields callbacks
     */
    private $options;

    /**
     * Start up
     */
    public function __construct()
    {
        add_action( 'admin_menu', array( $this, 'add_plugin_page' ) );
        add_action( 'admin_init', array( $this, 'page_init' ) );
    }

    /**
     * Add options page
     */
    public function add_plugin_page()
    {
        // This page will be under "Settings"
        add_options_page(
            'Settings Aztevia', //  title
            'Configuracion aztevia',  // texto del menu
            'manage_options', 
            'my-setting-admin', 
            array( $this, 'create_admin_page' )
        );
    }

    /**
     * Options page callback
     */
    public function create_admin_page()
    {
        // Set class property
        $this->options = get_option( 'aztevia_options' );
        ?>

<div class="wrap">
		<?php screen_icon(); ?>
		<h2>Aztevia config</h2>
		<form method="post" action="options.php">
				<?php
                // This prints out all hidden setting fields
                settings_fields( 'my_option_group' );   
                do_settings_sections( 'my-setting-admin' );
                submit_button(); 
            ?>
		</form>
</div>
<?php
    }

    /**
     * Register and add settings
     */
    public function page_init()
    {        
        register_setting(
            'my_option_group', // Option group
            'aztevia_options', // Option name
            array( $this, 'sanitize' ) // Sanitize
        );

        add_settings_section(
            'setting_section_id', // ID
            'Configuracion opciones aztevia', // Title
            array( $this, 'print_section_info' ), // Callback
            'my-setting-admin' // Page
        );  

        add_settings_field(
            'id_number', // ID
            'ID Number', // Title 
            array( $this, 'id_number_callback' ), // Callback
            'my-setting-admin', // Page
            'setting_section_id' // Section           
        );   
		
		
		   add_settings_field(
            'name_radio_testimonios', // ID
            'Mostrar bloque de testimonios', // Title 
            array( $this, 'name_radio_testimonios_callback' ), // Callback
            'my-setting-admin', // Page
            'setting_section_id' // Section           
        );   
		   

        add_settings_field(
            'title', 
            'Title', 
            array( $this, 'title_callback' ), 
            'my-setting-admin', 
            'setting_section_id'
        );      
    }

    /**
     * Sanitize each setting field as needed
     *
     * @param array $input Contains all settings fields as array keys
     */
    public function sanitize( $input )
    {
        $new_input = array();
        if( isset( $input['id_number'] ) )
            $new_input['id_number'] = absint( $input['id_number'] );

        if( isset( $input['title'] ) )
            $new_input['title'] = sanitize_text_field( $input['title'] );

        return $new_input;
    }

    /** 
     * Print the Section text
     */
    public function print_section_info()
    {
        print 'Enter your settings below:';
    }

    /** 
     * Get the settings option array and print one of its values
     */
    public function id_number_callback()
    {
        printf(
            '<input type="text" id="id_number" name="aztevia_options[id_number]" value="%s" />',
            isset( $this->options['id_number'] ) ? esc_attr( $this->options['id_number']) : ''
        );
    }
	
	
	
	    public function name_radio_testimonios_callback()
    {
       /* printf(
            '<input type="text" id="id_number" name="aztevia_options[id_number]" value="%s" />',
            isset( $this->options['id_number'] ) ? esc_attr( $this->options['id_number']) : ''
        );
		*/
		
		echo ":D->".$this->options['name_radio_testimonios'];
		
		   $html = '<input type="radio" id="name_radio_testimonios_1" name="aztevia_options[name_radio_testimonios]" value="1"' . checked( 1, $this->options['name_radio_testimonios'], false ) . '/>';  
    $html .= '<label for="name_radio_testimonios_1">SI</label>';  
      
    $html .= '<input type="radio" id="name_radio_testimonios_2" name="aztevia_options[name_radio_testimonios]" value="2"' . checked( 2, $this->options['name_radio_testimonios'], false ) . '/>';  
    $html .= '<label for="name_radio_testimonios_2">NO</label>';  
      
    echo $html; 
		
    }

    /** 
     * Get the settings option array and print one of its values
     */
    public function title_callback()
    {
        printf(
            '<input type="text" id="title" name="aztevia_options[title]" value="%s" />',
            isset( $this->options['title'] ) ? esc_attr( $this->options['title']) : ''
        );
    }
}

if( is_admin() )
    $my_settings_page = new AzteviaConfig();
/*##############################################################333*/

function mytheme_dequeue_fonts() {
         wp_dequeue_style( 'twentythirteen-fonts' );
      }

add_action( 'wp_enqueue_scripts', 'mytheme_dequeue_fonts', 11 );