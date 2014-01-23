<?php
/**
 * Eazyest Slides is a plugin to beautifully transform your WordPress galleries
 * 
 * Plugin Name: Eazyest Slides
 * Plugin URI: http://brimosoft.nl/eazyest/slides/
 * Description: Eazyest Slides is a plugin to beautifully transform your WordPress galleries
 * Date: March 2013
 * Author: Brimosoft
 * Author URI: http://brimosoft.nl
 * Version: 0.1.0
 * Text Domain: eazyest-slides
 * Domain Path: /languages/
 * License: GNU General Public License, version 3
 * 
 * @version 0.1.0 (r11) 
 * @package Eazyest Slides
 * @subpackage Main
 * @link http://brimosoft.nl/eazyest/slides/
 * @author Marcel Brinkkemper <eazyest@brimosoft.nl>
 * @copyright 2008-2013 Marcel Brinkkemper
 * @license GNU General Public License, version 3
 * @license http://www.gnu.org/licenses/
 */
 
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit; 

/**
 * Eazyest_Slides
 * 
 * @package Eazyest Slides
 * @author Marcel Brinkkemper
 * @version 0.0
 * @access public
 */
class Eazyest_Slides {
	
		/**
	 * @var array $data overloaded variables
	 * @acces private
	 * @since 0.0
	 */ 
	private $data;
	
	/**
	 * @staticvar Eazyest_Slides $instance The single Eazyest_Slides object in memory
	 * @acces private
	 * @since 0.0
	 */
	private static $instance;

	/**
	 * Eazyest_Slides::__construct()
	 * Empty constructor
	 * 
	 * @return void
	 * @acces public
	 */
	public function __construct() {}	
	
	/**
	 * @since 0.0
	 */
	public function __clone() { wp_die( __( 'Cheatin&#8217; huh?', 'eazyest-slides' ) ); }

	/** 
	 * @since 0.0
	 * @acces public
	 */
	public function __wakeup() { wp_die( __( 'Cheatin&#8217; huh?', 'eazyest-slides' ) ); }

	/**
	 * Magic method for checking the existence of a certain custom field
	 *
	 * @since 0.0
	 * @access public
	 */
	public function __isset( $key ) { 
		return isset( $this->data[$key] ); 
	}

	/**
	 * Magic method for getting variables
	 *
	 * @since 0.0
	 */
	public function __get( $key ) { 
		return isset( $this->data[$key] ) ? $this->data[$key] : null; 
	}

	/**
	 * Magic method for setting variables
	 *
	 * @since 0.1.0
	 * @acces public
	 */
	public function __set( $key, $value ) { 
		$this->data[$key] = $value; 
	}
	
	/**
	 * Eazyest_Slides::instance()
	 * Return single instance
	 * 
	 * @since 0.0
	 * @access public
	 * @static function
	 * @return Eazyest_Slides object
	 */
	public static function instance() {
		if ( ! isset( self::$instance ) ) {
			self::$instance = new Eazyest_Slides;
			self::$instance->init();
		}
		return self::$instance;
	}
	
	/**
	 * Eazyest_Slides::init()
	 * Initializes everything
	 * 
	 * @since 0.0
	 * @access private
	 * @return void
	 */
	private function init() {
		$this->load_text_domain();
		$this->load_options();		
		$this->setup_variables();
		$this->includes();
		$this->actions();  
	}
	
	/**
	 * Eazyest_Slides::load_text_domain()
	 * 
	 * @since 0.0
	 * @return void
	 */
	function load_text_domain() {
		load_plugin_textdomain( 'eazyest-slides', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );		
	}
	
	/**
	 * Eazyest_Slides::load_options()
	 * Load options and set class variables.
	 * 
	 * @since 0.0	 
	 * @access private
	 * @uses get_option()
	 * @uses add_option()
	 * @return void
	 */
	private function load_options() {
		
		$options = get_option( 'eazyest-slides' );
		
		if ( false === $options ) { 
			// options not in the wpdb, probably new install
			$options = $this->defaults();
			
			//set options to default
			add_option( 'eazyest-slides', $options ); 		
		}		
		
		$this->data = $options;
	}
	
	/**
	 * Eazyest_Slides::viewers()
	 * All Galery viewers included in this plugin.
	 * 
	 * @since 0.1.0 (r2)
	 * @access public
	 * @return array
	 */
	public function viewers() {
		return array(
			'responsive_gallery' => __( 'Responsive Gallery with Thumbnail Carousel', 'eazyest-slides' ),
			'proximity_effect'   => __( 'Gallery with Thumbnail Proximity Effect',    'eazyest-slides' ),
			'fast_hover'         => __( 'Gallery with Fast Hover Slideshow',          'eazyest-slides' ),
			'direction_aware'    => __( 'Gallery with Direction Aware Hover effect',  'eazyest-slides' ),
		);
	}
	
	/**
	 * Eazyest_Slides::defaults()
	 * Return array of default options.
	 * 
	 * @since 0.0
	 * @access private
	 * @return array
	 */
	private function defaults() {
		$defaults = array(
			'gallery' 					 => 'default',
		);
		foreach( $this->viewers() as $key => $value ) {
			$defaults[$key] = false;	// all viewers are disabled by default
		}
		return $defaults;
	}
	
	/**
	 * Eazyest_Slides::setup_variables()
	 * 
	 * @since 0.0
	 * @access private
	 * @uses plugin_dir_url()
	 * @uses plugin_dir_path()
	 * @uses plugin_basename()
	 * @return void
	 */
	private function setup_variables() {		
		$this->plugin_url      = plugin_dir_url( __FILE__ );
		$this->plugin_dir      = plugin_dir_path( __FILE__ );
		$this->plugin_file     = __FILE__;
		$this->plugin_basename = plugin_basename( __FILE__ );				
	}
	
	/**
	 * Eazyest_Slides::includes()
	 * Include files.
	 * 
	 * @since 0.0
	 * @acces private
	 * @return void
	 */
	private function includes() {
		if ( ! is_admin() )
			include( $this->plugin_dir . 'frontend/class-eazyest-slides-frontend.php' );
		else
			include( $this->plugin_dir . 'admin/class-eazyest-slides-admin.php' );
	}
	
	/**
	 * Eazyest_Slides::actions()
	 * Hook WordrPress actions.
	 * 
	 * @since 0.0
	 * @access private
	 * @uses add_action()
	 * @return void
	 */
	private function actions() {
		$basename = $this->plugin_basename;	
		add_action( 'init', array( $this, 'initialized' ) );	
	}
	
	/**
	 * Eazyest_Slides::initialized()
	 * Do action on WordPress init.
	 * 
	 * @since 0.0
	 * @access public
	 * @uses do_action()
	 * @return void
	 */
	public function initialized() {
		do_action( 'eazyest_slides_initialized' );
	}
} // Eazyest_Slides


/**
 * eazyest_slides()
 * 
 * @since 0.0
 * @return Eazyest_Slides object
 */
function eazyest_slides() {
	return Eazyest_Slides::instance();
}

eazyest_slides();