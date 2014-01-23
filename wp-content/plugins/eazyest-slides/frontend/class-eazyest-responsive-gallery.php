<?php
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;
 
/**
 * Eazyest_Slides_Responsive_Gallery
 * Transform WordPress gallery to a responsive image gallery with a thumbnail carousel using Elastislide.
 * Based on a Codrops tutorial by Mary Lou (Manoela Ilic)
 * @link http://tympanus.net/codrops/2011/09/20/responsive-image-gallery/
 * 
 * @package Eazyest Slides
 * @subpackage Frontend/Responsive Gallery
 * @author Macel Brinkkemper
 * @copyright 2013
 * @version 0.1.0 (r11)
 * @access public
 */
class Eazyest_Slides_Responsive_Gallery {
	
		/**
	 * @var array $data overloaded variables
	 * @acces private
	 * @since 0.0
	 */ 
	private $data;
	
	/**
	 * @staticvar Eazyest_Slides_Responsive_Gallery $instance The single Eazyest_Slides_Responsive_Gallery object in memory
	 * @acces private
	 * @since 0.0
	 */
	private static $instance;

	/**
	 * Eazyest_Slides_Responsive_Gallery::__construct()
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
	 * Eazyest_Slides_Responsive_Gallery::instance()
	 * Return single instance
	 * 
	 * @since 0.0
	 * @access public
	 * @static function
	 * @return Eazyest_Slides_Responsive_Gallery object
	 */
	public static function instance() {
		if ( ! isset( self::$instance ) ) {
			self::$instance = new Eazyest_Slides_Responsive_Gallery;
			self::$instance->init();
		}
		return self::$instance;
	}
	
	/**
	 * Eazyest_Slides_Responsive_Gallery::init()
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
	 * Eazyest_Slides_Responsive_Gallery::actions()
	 * Hook WordrPress actions.
	 * 
	 * @since 0.0
	 * @access private
	 * @uses add_action()
	 * @return void
	 */
	private function actions() {
		add_action( 'wp_head',            array( $this, 'template'         ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'register_scripts' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_styles'   ) );
	}
	
	/**
	 * Eazyest_Slides_Responsive_Gallery::filters()
	 * Hook WordPress filters.
	 * 
	 * @since 0.0
	 * @access private
	 * @uses add_filter()
	 * @return void
	 */
	private function filters() {	
		if ( eazyest_slides()->gallery == 'responsive_gallery' )
			add_filter( 'post_gallery', array( $this, 'post_gallery' ), 2000, 2 );
	}
	
	/**
	 * Eazyest_Slides_Responsive_Gallery::register_scripts()
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
		$gallery_array =  array( 'jquery', 'jquery-tmpl', 'jquery-easing', 'jquery-elastislide' );
		// this script could be registered already
		if ( ! wp_script_is( 'jquery-easing', 'registered' ) )		
			wp_register_script( 'jquery-easing', eazyest_slides()->plugin_url . "frontend/js/jquery.easing.1.3.$j", array( 'jquery' ), '1.3', true );
		// this script could be registered already	
		if ( ! wp_script_is( 'jquery-elastislide', 'registered' ) )		
			wp_register_script( 'jquery-elastislide', eazyest_slides()->plugin_url . "frontend/js/jquery.elastislide.$j", array( 'jquery', 'jquery-easing' ), '2011.09.20', true );
		// this script could be registered already
		if ( ! wp_script_is( 'jquery-tmpl', 'registered' ) )
		wp_register_script( 'jquery-tmpl', eazyest_slides()->plugin_url . "frontend/js/jquery.tmpl.$j", array( 'jquery' ), '1.0.0pre', true );	
			
		wp_register_script( 'eazyest-responsive-gallery', eazyest_slides()->plugin_url . "frontend/js/responsive-gallery.$j", $gallery_array, '0.1.0-r2', true );
		wp_localize_script( 'eazyest-responsive-gallery', 'eazyestResponsiveGallery', $this->localize_script() );
		wp_enqueue_script( 'eazyest-responsive-gallery' );	
	}
	
	/**
	 * Eazyest_Slides_Responsive_Gallery::localize_script()
	 * Setup values for gallery script.
	 * @return
	 */
	protected function localize_script() {
		return array(
			'ajaxLoader' => eazyest_slides()->plugin_url . 'frontend/images/ajax-loader.gif',
			'black'      => eazyest_slides()->plugin_url . 'frontend/images/black.png',
		);
	}
	
	public function enqueue_styles() {
		if ( ! wp_style_is( 'elastislide', 'registered' ) )
			wp_register_style( 'elastislide', eazyest_slides()->plugin_url . 'frontend/css/elastislide.css', false, '2011.09.20', 'screen' );
			
		wp_enqueue_style( 'elastislide' );	
		wp_enqueue_style( 'responsive-gallery', eazyest_slides()->plugin_url . 'frontend/css/responsive-gallery.css', false, '2011.09.20', 'screen' );
	}
	
	/**
	 * Eazyest_Slides_Responsive_Gallery::template()
	 * Add a jquery template to the head element.
	 * 
	 * @since 0.1.0 (r2)
	 * @return void
	 */
	public function template() {
		?>
		<noscript>
			<style>
				.es-carousel ul{ display:block;	}
			</style>
		</noscript>
		<script id="img-wrapper-tmpl" type="text/x-jquery-tmpl">	
			<div class="rg-image-wrapper">
				{{if itemsCount > 1}}
					<div class="rg-image-nav">
						<a href="#" class="rg-image-nav-prev">Previous Image</a>
						<a href="#" class="rg-image-nav-next">Next Image</a>
					</div>
				{{/if}}
				<div class="rg-image"></div>
				<div class="rg-loading"></div>
				<div class="rg-caption-wrapper">
					<div class="rg-caption" style="display:none;">
						<p></p>
					</div>
				</div>
			</div>
		</script>
		<?php
	}
	
	/**
	 * Eazyest_Slides_Responsive_Gallery::shortcode()
	 * Add shortcode to embed the responsive gallery in posts and pages
	 * 
	 * @since 0.1.0 (r2)
	 * @access protected
	 * @uses add_shortcode()
	 * @return void
	 */
	protected function shortcode() {
		add_shortcode( 'eazyest_responsive_gallery', array( $this, 'eazyest_responsive_gallery' ) );
	}
	
	/**
	 * Eazyest_Slides_Responsive_Gallery::eazyest_responsive_gallery()
	 * Call Eazyest_Slides_Responsive_Gallery::post_gallery() to output shortcode
	 * 
	 * @since 0.1.0 (r2)
	 * @access public
	 * @param array $attr
	 * @return string Gallery markup
	 */
	public function eazyest_responsive_gallery( $attr ) {
		return $this->post_gallery( '', $attr );
	}
	
	/**
	 * Eazyest_Slides_Responsive_Gallery::post_gallery()
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
			<div id='rg-gallery-{$instance}' class='rg-gallery'>
				<div class='rg-thumbs'>
					<!-- Elastislide Carousel Thumbnail Viewer -->
						<div class='es-carousel-wrapper'>
							<div class='es-nav'>
								<span class='es-nav-prev'>Previous</span>
								<span class='es-nav-next'>Next</span>
							</div>
							<div class='es-carousel'>
								<ul>";
		foreach ( $attachments as $id => $attachment ) {
			$src_thumbnail = wp_get_attachment_image_src( $id, 'thumbnail' );
			$src_full      = wp_get_attachment_image_src( $id, 'full'      );
			$description   = wptexturize( $attachment->post_excerpt );
			$output .= "
									<li><a href=\"#\"><img src=\"{$src_thumbnail[0]}\" data-large=\"{$src_full[0]}\" data-description=\"$description\" /></a></li>";
		}
		$output .= "
								</ul>
							</div>
						</div>
						<!-- End Elastislide Carousel Thumbnail Viewer -->
					</div><!-- rg-thumbs -->
				</div><!-- rg-gallery -->";
		wp_enqueue_script( 'eazyest-responsive-gallery' );		
		return $output;		
	}
	
} // Eazyest_Slides_Responsive_Gallery

/**
 * eazyest_slides_responsive_gallery()
 * 
 * @return Eazyest_Slides_Responsive_Gallery object
 */
function eazyest_slides_responsive_gallery() {
	return Eazyest_Slides_Responsive_Gallery::instance(); 
}
// autostart 
eazyest_slides_responsive_gallery();