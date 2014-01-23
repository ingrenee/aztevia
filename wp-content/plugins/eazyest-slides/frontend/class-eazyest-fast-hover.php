<?php
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;
 
/**
 * Eazyest_Slides_Fast_Hover
 * Transform WordPress gallery to a gallery where thumbnails scale when hovering over them and also scale their neighbouring thumbnails proportionally to their distance.
 * Based on a Codrops tutorial by Mary Lou (Manoela Ilic)
 * @link http://tympanus.net/codrops/2012/05/09/how-to-create-a-fast-hover-slideshow-with-css3/
 * 
 * @package Eazyest Slides
 * @subpackage Frontend/Fast Hover
 * @author Macel Brinkkemper
 * @copyright 2013
 * @version 0.1.0 (r2)
 * @access public
 */
class Eazyest_Slides_Fast_Hover {
	
		/**
	 * @var array $data overloaded variables
	 * @acces private
	 * @since 0.0
	 */ 
	private $data;
	
	/**
	 * @staticvar Eazyest_Slides_Fast_Hover $instance The single Eazyest_Slides_Fast_Hover object in memory
	 * @acces private
	 * @since 0.0
	 */
	private static $instance;

	/**
	 * Eazyest_Slides_Fast_Hover::__construct()
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
	 * Eazyest_Slides_Fast_Hover::instance()
	 * Return single instance
	 * 
	 * @since 0.0
	 * @access public
	 * @static function
	 * @return Eazyest_Slides_Fast_Hover object
	 */
	public static function instance() {
		if ( ! isset( self::$instance ) ) {
			self::$instance = new Eazyest_Slides_Fast_Hover;
			self::$instance->init();
		}
		return self::$instance;
	}
	
	/**
	 * Eazyest_Slides_Fast_Hover::init()
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
	 * Eazyest_Slides_Fast_Hover::actions()
	 * Hook WordrPress actions.
	 * 
	 * @since 0.0
	 * @access private
	 * @uses add_action()
	 * @return void
	 */
	private function actions() {
		add_action( 'wp_enqueue_scripts', array( $this, 'register_scripts' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts'  ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_styles'   ) );
	}
	
	/**
	 * Eazyest_Slides_Fast_Hover::filters()
	 * Hook WordPress filters.
	 * 
	 * @since 0.0
	 * @access private
	 * @uses add_filter()
	 * @return void
	 */
	private function filters() {		
		if ( eazyest_slides()->gallery == 'fast_hover' )
			add_filter( 'post_gallery', array( $this, 'post_gallery' ), 2000, 2 );
	}
	
	/**
	 * Eazyest_Slides_Fast_Hover::register_scripts()
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
		if ( ! wp_script_is( 'eazyest-modernizr', 'registered' ) )
			wp_register_script( 'eazyest-modernizr',  eazyest_slides()->plugin_url . "frontend/js/modernizr.custom.97074.js", array(), '2.5.3', false );
			
		wp_register_script( 'eazyest-fast-hover', eazyest_slides()->plugin_url . "frontend/js/eazyest-fast-hover.$j", array( 'jquery' ), '0.1.0-r2', true );
	}
	
	/**
	 * Eazyest_Slides_Fast_Hover::enqueue_scripts()
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
	
	/**
	 * Eazyest_Slides_Fast_Hover::enqueue_styles()
	 * Enqueue stylesheets used by this plugin.
	 * 
	 * @since 0.1.0 (r2)
	 * @access public
	 * @uses wp_enqueue_style()
	 * @return void
	 */
	public function enqueue_styles() {
		wp_enqueue_style( 'fast-hover', eazyest_slides()->plugin_url . 'frontend/css/fast-hover.css', false, '2012.09.20', 'all' );
	}
	
	/**
	 * Eazyest_Slides_Fast_Hover::shortcode()
	 * Add shortcode to embed the responsive gallery in posts and pages
	 * 
	 * @since 0.1.0 (r2)
	 * @access protected
	 * @uses add_shortcode()
	 * @return void
	 */
	protected function shortcode() {
		add_shortcode( 'eazyest_fast_hover', array( $this, 'eazyest_fast_hover' ) );
	}
	
	/**
	 * Eazyest_Slides_Fast_Hover::eazyest_fast_hover()
	 * Call Eazyest_Slides_Fast_Hover::post_gallery() to output shortcode
	 * 
	 * @since 0.1.0 (r2)
	 * @access public
	 * @param array $attr
	 * @return string Gallery markup
	 */
	public function eazyest_fast_hover( $attr ) {
		return $this->post_gallery( '', $attr );
	}
	
	/**
	 * Eazyest_Slides_Fast_Hover::post_gallery()
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
		
		$count = count( $attachments ) + 1;
		$output = "
			<style type='text/css' media='screen'>
				.hs-wrapper img:nth-child(1),
				.hs-titles span:nth-child(1){
					z-index: $count;
				}";	
				
		$child = 1;		
		while( $child < count( $attachments ) ) {
			$nth = $child + 1;			
			$z_index = 10 + $count - $child;
			$delay = ( $child ) / 10;
			$output .= "
				.hs-wrapper img:nth-child($nth),
				.hs-titles span:nth-child($nth){
	    		-webkit-animation-delay: {$delay}s;
					-moz-animation-delay: {$delay}s;
					-o-animation-delay: {$delay};
					-ms-animation-delay: {$delay}s;
					animation-delay: {$delay}s;
					z-index: $z_index;
				}";
			$child++;	
		}				
		$output .= "
			</style>
			<section class='hs-section'>
				<div class='hs-wrapper'>";
		foreach ( $attachments as $att_id => $attachment ) {
			$src_full = wp_get_attachment_image_src( $att_id, 'full' );
			$title    = wptexturize( $attachment->post_title );
			$output .= "
					<img class='animate' src='{$src_full[0]}' alt='$title' />";
		}
		$post_title = $id ? wptexturize( get_post( $id )->post_title ) : false;
		if ( $post_title ) {
		$output .= "
					<div class='hs-overlay animate'>
						<span>$post_title</span>
					</div>
					<div class='hs-titles'>";
		}		
		foreach ( $attachments as $att_id => $attachment ) {
			$description = wptexturize( $attachment->post_excerpt );
			$url         = get_attachment_link( $att_id );
			if ( empty( $description) )
				$description =  wptexturize( $attachment->post_title );
			$output .= "
						<span class='animate'><a href='$url'>$description</a></span>";
		}
		$output .= "
					</div>
				</div>
			</section>";
		wp_enqueue_script( 'eazyest-modernizr'  );
		wp_enqueue_script( 'eazyest-fast-hover' );		
		return $output;		
	}
	
} // Eazyest_Slides_Fast_Hover

/**
 * eazyest_slides_fast_hover()
 * 
 * @return Eazyest_Slides_Fast_Hover object
 */
function eazyest_slides_fast_hover() {
	return Eazyest_Slides_Fast_Hover::instance(); 
}
// autostart 
eazyest_slides_fast_hover();