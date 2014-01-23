<?php
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;
 
/**
 * Eazyest_Slides_Direction_Aware
 * Transform WordPress gallery to a gallery where thumbnails have a direction-aware hover effect to slide in an overlay from the direction we are moving with the mouse.
 * Based on a Codrops tutorial by Mary Lou (Manoela Ilic)
 * @link http://tympanus.net/codrops/2012/04/09/direction-aware-hover-effect-with-css3-and-jquery/
 * 
 * @package Eazyest Slides
 * @subpackage Frontend/Direction Aware
 * @author Macel Brinkkemper
 * @copyright 2013
 * @version 0.1.0 (r2)
 * @access public
 */
class Eazyest_Slides_Direction_Aware {
	
		/**
	 * @var array $data overloaded variables
	 * @acces private
	 * @since 0.0
	 */ 
	private $data;
	
	/**
	 * @staticvar Eazyest_Slides_Direction_Aware $instance The single Eazyest_Slides_Direction_Aware object in memory
	 * @acces private
	 * @since 0.0
	 */
	private static $instance;

	/**
	 * Eazyest_Slides_Direction_Aware::__construct()
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
	 * Eazyest_Slides_Direction_Aware::instance()
	 * Return single instance
	 * 
	 * @since 0.0
	 * @access public
	 * @static function
	 * @return Eazyest_Slides_Direction_Aware object
	 */
	public static function instance() {
		if ( ! isset( self::$instance ) ) {
			self::$instance = new Eazyest_Slides_Direction_Aware;
			self::$instance->init();
		}
		return self::$instance;
	}
	
	/**
	 * Eazyest_Slides_Direction_Aware::init()
	 * Initializes everything
	 * 
	 * @since 0.0
	 * @access private
	 * @return void
	 */
	private function init() {
		$this->actions();    
		$this->filters();
		$this->shortcode();
	}
	
	/**
	 * Eazyest_Slides_Direction_Aware::actions()
	 * Hook WordrPress actions.
	 * 
	 * @since 0.0
	 * @access private
	 * @uses add_action()
	 * @return void
	 */
	private function actions() {
		add_action( 'wp_enqueue_scripts', array( $this, 'register_scripts' ),   10 );
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts'  ),   11 );
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_styles'   )       );
		add_action( 'wp_footer',          array( $this, 'footer_script'    ), 1000 );
	}
	
	/**
	 * Eazyest_Slides_Direction_Aware::filters()
	 * Hook WordPress filters.
	 * 
	 * @since 0.0
	 * @access private
	 * @uses add_filter()
	 * @return void
	 */
	private function filters() {	
		if ( eazyest_slides()->gallery == 'direction_aware' )
			add_filter( 'post_gallery', array( $this, 'post_gallery' ), 2000, 2 );
	}
	
	/**
	 * Eazyest_Slides_Direction_Aware::register_scripts()
	 * Register javascript files.
	 * 
	 * @since 0.1.0 (r2)
	 * @access public
	 * @uses wp_script_is() to check if script is registered
	 * @uses wp_register_script()
	 * @uses wp_localize_script()
	 * @return void
	 */
	public function register_scripts() {			
		$j = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? 'js' : 'min.js';
		// this script could be registered already
		if ( ! wp_script_is( 'eazyest-modernizr', 'registered' ) )
			wp_register_script( 'eazyest-modernizr',  eazyest_slides()->plugin_url . "frontend/js/modernizr.custom.97074.js", array(), '2.5.3', true );
			
		if ( ! wp_script_is( 'jquery-hoverdir', 'registered' ) )		
			wp_register_script( 'jquery-hoverdir', eazyest_slides()->plugin_url . "frontend/js/jquery.hoverdir.$j", array( 'jquery' ), '1.1.0', true );
	}
	
	public function enqueue_styles() {
		wp_enqueue_style( 'direction-aware', eazyest_slides()->plugin_url . 'frontend/css/direction-aware.css', false, '0.1.0-r2', 'screen' );
	}
	
	/**
	 * Eazyest_Slides_Direction_Aware::enqueue_scripts()
	 * Enqueue scripts in header.
	 * 
	 * @since 0.1.0 (r2)
	 * @access public
	 * @uses wp_enqueue_script()
	 * @return void
	 */
	public function enqueue_scripts() {
		wp_enqueue_script( 'eazyest-modernizr' );
	}
	
	public function footer_script() {
		?>		
		<script type="text/javascript">
			(function($) {	
				$(window).load( function(){
					// make all gallery items same height for responsive gallery
					if ( $('#da-thumbs').length ) {				
						var maxHeight = 0;
						$(' #da-thumbs > li ').each( function(){
							if ( $(this).outerHeight(false) > maxHeight )
								maxHeight = $(this).outerHeight(false); 
						});							
						$(' #da-thumbs > li ').each( function(){
							$(this).css('height',maxHeight-10);
						});
					}	
					$(' #da-thumbs > li ').each( function() { $(this).hoverdir(); } );				
				}); // window.load
			}(jQuery));
		</script>
		<?php
	}
	
	/**
	 * Eazyest_Slides_Direction_Aware::shortcode()
	 * Add shortcode to embed the responsive gallery in posts and pages
	 * 
	 * @since 0.1.0 (r2)
	 * @access protected
	 * @uses add_shortcode()
	 * @return void
	 */
	protected function shortcode() {
		add_shortcode( 'eazyest_direction_aware', array( $this, 'eazyest_direction_aware' ) );
	}
	
	/**
	 * Eazyest_Slides_Direction_Aware::eazyest_direction_aware()
	 * Call Eazyest_Slides_Direction_Aware::post_gallery() to output shortcode
	 * 
	 * @since 0.1.0 (r2)
	 * @access public
	 * @param array $attr
	 * @return string Gallery markup
	 */
	public function eazyest_direction_aware( $attr ) {
		return $this->post_gallery( '', $attr );
	}
	
	/**
	 * Eazyest_Slides_Direction_Aware::post_gallery()
	 * Output a responsive gallery with thumbnails slide.
	 * 
	 * @since 0.1.0 (r2)
	 * @access public
	 * @uses get_post() to get current post
	 * @uses get_posts() to get attachments
	 * @uses get_children() to get attachments
	 * @uses wp_get_attachment_image_src() to get src attribute for img element 
	 * @uses shortcode_atts()
	 * @param string $gallery
	 * @param array $attr Shortcode attributes
	 * @return string Gallery markup
	 */
	public function post_gallery( $gallery = '', $attr ) {
		$post = get_post();
	
		static $instance = 0;
		$instance++;
		if ( $instance > 1 )
			return ''; // sorry we do only one responsive image gallery per page
	
		if ( ! empty( $attr['ids'] ) ) {
			// 'ids' is explicitly ordered, unless you specify otherwise.
			if ( empty( $attr['orderby'] ) )
				$attr['orderby'] = 'post__in';
			$attr['include'] = $attr['ids'];
		}
		
		extract(shortcode_atts(array(
			'order'      => 'ASC',
			'orderby'    => 'menu_order ID',
			'id'         => $post->ID,
			'include'    => '',
			'exclude'    => ''
		), $attr));
	
		$id = intval($id);
		if ( 'RAND' == $order )
			$orderby = 'none';
	
		if ( !empty($include) ) {
			$_attachments = get_posts( array('include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
	
			$attachments = array();
			foreach ( $_attachments as $key => $val ) {
				$attachments[$val->ID] = $_attachments[$key];
			}
		} elseif ( !empty($exclude) ) {
			$attachments = get_children( array('post_parent' => $id, 'exclude' => $exclude, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
		} else {
			$attachments = get_children( array('post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
		}
	
		if ( empty($attachments) )
			return '';
			
		$output = "
			<section class='da-section'>
				<ul id='da-thumbs' class='da-thumbs'>";
		foreach ( $attachments as $id => $attachment ) {
			$src_thumbnail = wp_get_attachment_image_src( $id, 'thumbnail' );
			$url           = get_attachment_link( $id );
			$description   = wptexturize( $attachment->post_excerpt );
			if ( empty( $description ) )
				$description   = wptexturize( $attachment->post_title );
			
			$output .= "
									<li><a href='$url'><img src='{$src_thumbnail[0]}' /><div><span>$description</span></div></a></li>";
		}
		$output .= "
				</ul>
			</section>";
		wp_enqueue_script( 'jquery-hoverdir' );		
		return $output;		
	}
	
} // Eazyest_Slides_Direction_Aware

/**
 * eazyest_slides_direction_aware()
 * 
 * @return Eazyest_Slides_Direction_Aware object
 */
function eazyest_slides_direction_aware() {
	return Eazyest_Slides_Direction_Aware::instance(); 
}
// autostart 
eazyest_slides_direction_aware();