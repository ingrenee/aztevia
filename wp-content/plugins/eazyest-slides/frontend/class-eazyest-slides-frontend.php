<?php
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;
 
/**
 * Eazyest_Slides_Frontend
 * 
 * @package Eazyest Slides/Frontend
 * @author Marcel brinkkemper
 * @copyright 2013 Brimosoft
 * @version 0.1.0 (r2)
 * @access public
 */
class Eazyest_Slides_Frontend {
	
		/**
	 * @var array $data overloaded variables
	 * @acces private
	 * @since 0.0
	 */ 
	private $data;
	
	/**
	 * @staticvar Eazyest_Slides_Frontend $instance The single Eazyest_Slides_Frontend object in memory
	 * @acces private
	 * @since 0.0
	 */
	private static $instance;

	/**
	 * Eazyest_Slides_Frontend::__construct()
	 * Empty constructor
	 * 
	 * @return void
	 * @acces public
	 */
	public function __construct() {}	
	
	/**
	 * @since 0.0
	 */
	public function __clone() { wp_die( __( 'Cheatin&#8217; huh?', 'eazyest-plugin' ) ); }

	/** 
	 * @since 0.0
	 * @acces public
	 */
	public function __wakeup() { wp_die( __( 'Cheatin&#8217; huh?', 'eazyest-plugin' ) ); }

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
	 * Eazyest_Slides_Frontend::instance()
	 * Return single instance
	 * 
	 * @since 0.0
	 * @access public
	 * @static function
	 * @return Eazyest_Slides_Frontend object
	 */
	public static function instance() {
		if ( ! isset( self::$instance ) ) {
			self::$instance = new Eazyest_Slides_Frontend;
			self::$instance->init();
		}
		return self::$instance;
	}
	
	/**
	 * Eazyest_Slides_Frontend::init()
	 * Initializes everything
	 * 
	 * @since 0.0
	 * @access private
	 * @return void
	 */
	private function init() {
		$this->includes();
	}
	
	/**
	 * Eazyest_Slides_Frontend::includes()
	 * Include files.
	 * 
	 * @since 0.0
	 * @acces private
	 * @return void
	 */
	private function includes() {
		foreach( eazyest_slides()->viewers() as $slide => $value ) {
			if ( eazyest_slides()->$slide ) {
				$file = str_replace( '_', '-', $slide );
				include( eazyest_slides()->plugin_dir . "frontend/class-eazyest-$file.php" );
			}						
		}
	}
	
} // Eazyest_Slides_Frontend

function eazyest_slides_frontend() {
	return Eazyest_Slides_Frontend::instance();
}

eazyest_slides_frontend();