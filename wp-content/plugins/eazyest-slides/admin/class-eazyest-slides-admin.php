<?php
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;
 
/**
 * Eazyest_Slides_Admin
 * 
 * @package Eazyest Slides/Admin
 * @author Marcel brinkkemper
 * @copyright 2013 Brimosoft
 * @version 0.1.0 (r6)
 * @access public
 */
class Eazyest_Slides_Admin {
	
		/**
	 * @var array $data overloaded variables
	 * @acces private
	 * @since 0.0
	 */ 
	private $data;
	
	/**
	 * @staticvar Eazyest_Slides_Admin $instance The single Eazyest_Slides_Admin object in memory
	 * @acces private
	 * @since 0.0
	 */
	private static $instance;

	/**
	 * Eazyest_Slides_Admin::__construct()
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
	 * Eazyest_Slides_Admin::instance()
	 * Return single instance
	 * 
	 * @since 0.0
	 * @access public
	 * @static function
	 * @return Eazyest_Slides_Admin object
	 */
	public static function instance() {
		if ( ! isset( self::$instance ) ) {
			self::$instance = new Eazyest_Slides_Admin;
			self::$instance->init();
		}
		return self::$instance;
	}
	
	/**
	 * Eazyest_Slides_Admin::init()
	 * Initializes everything
	 * 
	 * @since 0.0
	 * @access private
	 * @return void
	 */
	private function init() {
		$this->actions();  
	}
	
	/**
	 * Eazyest_Slides_Admin::actions()
	 * Hook WordrPress actions.
	 * 
	 * @since 0.0
	 * @access private
	 * @uses add_action()
	 * @return void
	 */
	private function actions() {
  	add_action( 'admin_init', array( $this, 'register_setting' ) );	
  	add_action( 'admin_init', array( $this, 'admin_menu'       ) );
	}
	
	/**
	 * Eazyest_Slides_Admin::register_setting()
	 * 
	 * @since 0.1.0 (r6)
	 * @access public
	 * @uses register_setting()
	 * @return void
	 */
	public function register_setting() {			
  	register_setting( 'eazyest-slides', 'eazyest-slides', array( $this, 'sanitize_settings' ) );
	}
	
	/**
	 * Eazyest_Slides_Admin::sanitize_settings()
	 * 
	 * @since 0.1.0 (r6)
	 * @access public
	 * @param array $options
	 * @return array sanitized options
	 */
	public function sanitize_settings( $options ) {		
		foreach( eazyest_slides()->viewers() as $key => $value ) {
			$options[$key] = isset( $options[$key] ) ? 1 : 0;
		}			
		return $options;
	}
	
	/**
	 * Eazyest_Slides_Admin::admin_menu()
	 * Add Eazyest Slides options to Settings - Media
	 * 
	 * @since 0.1.0 (r6)
	 * @access public
	 * @uses add_settings_section()
	 * @return void
	 */
	public function admin_menu() {
		add_settings_section( 'eazyest-slides', __( 'Eazyest Slides', 'eazyest-slides' ), array( $this, 'settings'), 'media' );
	}
	
	/**
	 * Eazyest_Slides_Admin::settings()
	 * Output settings section.
	 * 
	 * @since 0.1.0 (r6)
	 * @access public
	 * @uses settings_fields()
	 * @uses esc_html()
	 * @uses esc_html_e()
	 * @checked()
	 * @return void
	 */
	public function settings() {
		$settings = get_option( 'eazyest-slides' );
		?>
		<?php settings_fields( 'eazyest-slides' ) ?>
		<table class="form-table">
			<tbody>
				<tr>
					<th scope="row">
						<?php _e( 'Enable Eazyest Slides', 'eazyest-slides' ); ?>
					</th>
					<td>
						<?php foreach( eazyest_slides()->viewers() as $option => $text ) : ?>
							<p>
								<input type="checkbox" id="<?php echo $option; ?>" name="eazyest-slides[<?php echo $option; ?>]" <?php checked( $settings[$option] ) ?> />
								<label for="<?php echo $option; ?>"><?php echo esc_html( $text ); ?></label>
							</p>
						<?php endforeach; ?>
					</td>
				</tr>
				<tr>
					<th scope="row">
						<?php _e( 'Transform all Galleries', 'eazyest-slides' ); ?>
					</th>
					<td>
						<p>
						<input type="radio" id="eazyest-slides-default" name="eazyest-slides[gallery]" value="default" <?php checked( $settings['gallery'] == 'default' ) ?> />
						<label for="eazyest-slides-default"><?php  esc_html_e( 'Default Gallery', 'eazyest-gallery' ); ?></label>
						</p>
						<?php foreach( eazyest_slides()->viewers() as $option => $text ) : ?>
							<?php if ( $settings[$option] ) : ?>
								<p>
								<input type="radio" id="eazyest-slides-<?php echo $option; ?>" name="eazyest-slides[gallery]" value="<?php echo $option; ?>" <?php checked( $settings['gallery'] == $option ) ?> />
								<label for="eazyest-slides-<?php echo $option; ?>"><?php  echo esc_html( $text ); ?></label>
								</p>
							<?php endif; ?>
						<?php endforeach; ?>
					</td>
				</tr>
			</tbody>
		</table>		
		<?php
  }
	
} // Eazyest_Slides_Admin

/**
 * eazyest_slides_admin()
 * 
 * @return Eazyest_Slides_Admin object 
 */
function eazyest_slides_admin() {
	return Eazyest_Slides_Admin::instance();
}

eazyest_slides_admin();