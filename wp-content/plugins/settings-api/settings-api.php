<?php

/**
 * Plugin Name: WordPress Settings API
 * Plugin URI: http://tareq.wedevs.com/2012/06/wordpress-settings-api-php-class/
 * Description: WordPress Settings API testing
 * Author: Tareq Hasan
 * Author URI: http://tareq.weDevs.com
 * Version: 0.1
 */
require_once dirname( __FILE__ ) . '/class.settings-api.php';

/**
 * WordPress settings API demo class
 *
 * @author Tareq Hasan
 */
class WeDevs_Settings_API_Test {

    private $settings_api;

    function __construct() {
        $this->settings_api = WeDevs_Settings_API::getInstance();

        add_action( 'admin_init', array($this, 'admin_init') );
        add_action( 'admin_menu', array($this, 'admin_menu') );
    }

    function admin_init() {

        //set the settings
        $this->settings_api->set_sections( $this->get_settings_sections() );
        $this->settings_api->set_fields( $this->get_settings_fields() );

        //initialize settings
        $this->settings_api->admin_init();
    }

    function admin_menu() {
        add_options_page( 'Settings API', 'Settings API', 'delete_posts', 'settings_api_test', array($this, 'plugin_page') );
    }

    function get_settings_sections() {
        $sections = array(
            array(
                'id' => 'wedevs_basics',
                'title' => __( 'Configuracion Basica', 'wedevs' )
            ),
            array(
                'id' => 'wedevs_advanced',
                'title' => __( 'Advanced Settings', 'wedevs' )
            ),
            array(
                'id' => 'wedevs_others',
                'title' => __( 'Other Settings', 'wpuf' )
            )
        );
        return $sections;
    }

    /**
     * Returns all the settings fields
     *
     * @return array settings fields
     */
    function get_settings_fields() {
        $settings_fields = array(
            'wedevs_basics' => array(
			
			 array(
                    'name' => 'radio_testimonios',
                    'label' => __( 'Mostrar bloque testimonios', 'wedevs' ),
                    'desc' => __( 'Muestr u oculta el bloque de testimonios', 'wedevs' ),
                    'type' => 'radio',
                    'options' => array(
                        'yes' => 'SI',
                        'no' => 'NO'
                    )
                ),
				
				 array(
                    'name' => 'radio_recetas',
                    'label' => __( 'Mostrar bloque recetas', 'wedevs' ),
                    'desc' => __( 'Muestr u oculta el bloque de recetas', 'wedevs' ),
                    'type' => 'radio',
                    'options' => array(
                        'yes' => 'SI',
                        'no' => 'NO'
                    )
                ),
				
					 array(
                    'name' => 'radio_blog',
                    'label' => __( 'Mostrar bloque Blog', 'wedevs' ),
                    'desc' => __( 'Muestr u oculta el bloque de blog', 'wedevs' ),
                    'type' => 'radio',
                    'options' => array(
                        'yes' => 'SI',
                        'no' => 'NO'
                    )
                ),
				
				
						 array(
                    'name' => 'radio_aliados',
                    'label' => __( 'Mostrar bloque aliados', 'wedevs' ),
                    'desc' => __( 'Muestr u oculta el bloque de aliados', 'wedevs' ),
                    'type' => 'radio',
                    'options' => array(
                        'yes' => 'SI',
                        'no' => 'NO'
                    )
                ),
				
				 array(
                    'name' => 'productos_aztevia_num',
                    'label' => __( 'Numero de productos aztevia', 'wedevs' ),
                    'desc' => __( ' ', 'wedevs' ),
                    'type' => 'select',
                    'default' => '3',
                    'options' => array(
                        '3' => '3',
						'4' => '4',
						'5' => '5',
						'6' => '6',
						'7' => '7',
						'8' => '8',
						'9' => '9',
						'10' => '10',
						'11' => '11',
						'12' => '12',
						
                        '13' => '13'
                    )
                ),
				
				 array(
                    'name' => 'productos_aztevia_fila_1',
                    'label' => __( '# Productos en primera fila', 'wedevs' ),
                    'desc' => __( ' ', 'wedevs' ),
                    'type' => 'select',
                    'default' => '3',
                    'options' => array(
                        '0' => '0',
						'1' => '1',
						'2' => '2',
						'3' => '3'
                    )
                ),
				
					 array(
                    'name' => 'productos_aztevia_fila_2',
                    'label' => __( '# Productos en segunda fila ', 'wedevs' ),
                    'desc' => __( ' ', 'wedevs' ),
                    'type' => 'select',
                    'default' => '3',
                    'options' => array(
                        '0' => '0',
						'1' => '1',
						'2' => '2',
						'3' => '3'
                    )
                ),
				
				 array(
                    'name' => 'productos_aztevia_fila_3',
                    'label' => __( '# Productos en tercera fila', 'wedevs' ),
                    'desc' => __( ' ', 'wedevs' ),
                    'type' => 'select',
                    'default' => '3',
                    'options' => array(
                        '0' => '0',
						'1' => '1',
						'2' => '2',
						'3' => '3'
                    )
                ),
				
				 array(
                    'name' => 'productos_aztevia_fila_4',
                    'label' => __( '# Productos en cuarta fila', 'wedevs' ),
                    'desc' => __( ' ', 'wedevs' ),
                    'type' => 'select',
                    'default' => '3',
                    'options' => array(
                        '0' => '0',
						'1' => '1',
						'2' => '2',
						'3' => '3'
                    )
                ),
				
				
				
			
                array(
                    'name' => 'text',
                    'label' => __( 'Text Input', 'wedevs' ),
                    'desc' => __( 'Text input description', 'wedevs' ),
                    'type' => 'text',
                    'default' => 'Title'
                ),
                array(
                    'name' => 'textarea',
                    'label' => __( 'Textarea Input', 'wedevs' ),
                    'desc' => __( 'Textarea description', 'wedevs' ),
                    'type' => 'textarea'
                ),
                array(
                    'name' => 'checkbox',
                    'label' => __( 'Checkbox', 'wedevs' ),
                    'desc' => __( 'Checkbox Label', 'wedevs' ),
                    'type' => 'checkbox'
                ),
                array(
                    'name' => 'radio',
                    'label' => __( 'Radio Button', 'wedevs' ),
                    'desc' => __( 'A radio button', 'wedevs' ),
                    'type' => 'radio',
                    'options' => array(
                        'yes' => 'Yes',
                        'no' => 'No'
                    )
                ),
                array(
                    'name' => 'multicheck',
                    'label' => __( 'Multile checkbox', 'wedevs' ),
                    'desc' => __( 'Multi checkbox description', 'wedevs' ),
                    'type' => 'multicheck',
                    'options' => array(
                        'one' => 'One',
                        'two' => 'Two',
                        'three' => 'Three',
                        'four' => 'Four'
                    )
                ),
                array(
                    'name' => 'selectbox',
                    'label' => __( 'A Dropdown', 'wedevs' ),
                    'desc' => __( 'Dropdown description', 'wedevs' ),
                    'type' => 'select',
                    'default' => 'no',
                    'options' => array(
                        'yes' => 'Yes',
                        'no' => 'No'
                    )
                )
            ),
            'wedevs_advanced' => array(
                array(
                    'name' => 'text',
                    'label' => __( 'Text Input', 'wedevs' ),
                    'desc' => __( 'Text input description', 'wedevs' ),
                    'type' => 'text',
                    'default' => 'Title'
                ),
                array(
                    'name' => 'textarea',
                    'label' => __( 'Textarea Input', 'wedevs' ),
                    'desc' => __( 'Textarea description', 'wedevs' ),
                    'type' => 'textarea'
                ),
                array(
                    'name' => 'checkbox',
                    'label' => __( 'Checkbox', 'wedevs' ),
                    'desc' => __( 'Checkbox Label', 'wedevs' ),
                    'type' => 'checkbox'
                ),
                array(
                    'name' => 'radio',
                    'label' => __( 'Radio Button', 'wedevs' ),
                    'desc' => __( 'A radio button', 'wedevs' ),
                    'type' => 'radio',
                    'default' => 'no',
                    'options' => array(
                        'yes' => 'Yes',
                        'no' => 'No'
                    )
                ),
                array(
                    'name' => 'multicheck',
                    'label' => __( 'Multile checkbox', 'wedevs' ),
                    'desc' => __( 'Multi checkbox description', 'wedevs' ),
                    'type' => 'multicheck',
                    'default' => array('one' => 'one', 'four' => 'four'),
                    'options' => array(
                        'one' => 'One',
                        'two' => 'Two',
                        'three' => 'Three',
                        'four' => 'Four'
                    )
                ),
                array(
                    'name' => 'selectbox',
                    'label' => __( 'A Dropdown', 'wedevs' ),
                    'desc' => __( 'Dropdown description', 'wedevs' ),
                    'type' => 'select',
                    'options' => array(
                        'yes' => 'Yes',
                        'no' => 'No'
                    )
                )
            ),
            'wedevs_others' => array(
                array(
                    'name' => 'text',
                    'label' => __( 'Text Input', 'wedevs' ),
                    'desc' => __( 'Text input description', 'wedevs' ),
                    'type' => 'text',
                    'default' => 'Title'
                ),
                array(
                    'name' => 'textarea',
                    'label' => __( 'Textarea Input', 'wedevs' ),
                    'desc' => __( 'Textarea description', 'wedevs' ),
                    'type' => 'textarea'
                ),
                array(
                    'name' => 'checkbox',
                    'label' => __( 'Checkbox', 'wedevs' ),
                    'desc' => __( 'Checkbox Label', 'wedevs' ),
                    'type' => 'checkbox'
                ),
                array(
                    'name' => 'radio',
                    'label' => __( 'Radio Button', 'wedevs' ),
                    'desc' => __( 'A radio button', 'wedevs' ),
                    'type' => 'radio',
                    'options' => array(
                        'yes' => 'Yes',
                        'no' => 'No'
                    )
                ),
                array(
                    'name' => 'multicheck',
                    'label' => __( 'Multile checkbox', 'wedevs' ),
                    'desc' => __( 'Multi checkbox description', 'wedevs' ),
                    'type' => 'multicheck',
                    'options' => array(
                        'one' => 'One',
                        'two' => 'Two',
                        'three' => 'Three',
                        'four' => 'Four'
                    )
                ),
                array(
                    'name' => 'selectbox',
                    'label' => __( 'A Dropdown', 'wedevs' ),
                    'desc' => __( 'Dropdown description', 'wedevs' ),
                    'type' => 'select',
                    'options' => array(
                        'yes' => 'Yes',
                        'no' => 'No'
                    )
                )
            )
        );

        return $settings_fields;
    }

    function plugin_page() {
        echo '<div class="wrap">';
        settings_errors();

        $this->settings_api->show_navigation();
        $this->settings_api->show_forms();

        echo '</div>';
    }

    /**
     * Get all the pages
     *
     * @return array page names with key value pairs
     */
    function get_pages() {
        $pages = get_pages();
        $pages_options = array();
        if ( $pages ) {
            foreach ($pages as $page) {
                $pages_options[$page->ID] = $page->post_title;
            }
        }

        return $pages_options;
    }

}

$settings = new WeDevs_Settings_API_Test();