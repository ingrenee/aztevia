<?php
/**
 * Plugin Name: Social Header Meta
 * Plugin URI: http://www.landykos.com
 * Description: Setup meta tags in the header for Facebook and Twitter. 
 * Version: 4.0
 * Author: Landy Kosmitis
 * Author URI: http://www.landykos.com
 * License: GPL2
 */

// Dump facebook share tags on Single pages only. Will be adding Settings asap!
function setup_share_tags() {
	global $post;
	$output = '';
	// Let's check if we have a post Thumbnail
	if (has_post_thumbnail( $post->ID ) ):
		// Get image source. 
	    $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' );
		// Put content into $output var. 
	    $output = '
	    <meta property="og:title" content="' . $post->post_title . '"/>
	    <meta property="og:type" content="image"/>
	    <meta property="og:url" content="' . get_permalink( $post->ID ) . '"/>
	    <meta property="og:image" content="'. $image[0] . '"/>
	    <meta property="og:site_name" content="' . get_bloginfo('name') . '"/>
	    <meta property="fb:admins" content="USER_ID"/>
	    <meta property="og:description" content="' . $post->post_title . '"/>';
	    
	    // Twitter Card Tags - Photo Only right now. 
	   	// Account Info is set on Settings Page
	   	$plugin_settings = get_option('social_header_meta');
	   	if($plugin_settings['status'] == 1) {
		    $output .= '
		    <meta name="twitter:card" content="photo">
			<meta name="twitter:site" content="@'.$plugin_settings['username'].'">
			<meta name="twitter:creator" content="@'.$plugin_settings['username'].'">
			<meta name="twitter:title" content="' . $post->post_title . '">
			<meta name="twitter:image" content="'. $image[0] . '">
			<meta name="twitter:image:width" content="'. $image[1] . '">
			<meta name="twitter:image:height" content="'. $image[2] . '">
			<meta name="twitter:domain" content="'. get_bloginfo('url'). '">
		    ';
		}
	endif;
	// Return gets echoed in header file.
	echo $output;
}

// Add action to wp_head and call Social Setup function. 
add_action('wp_head', 'setup_share_tags');

// Setup Settings Page Class
class SocialHeaderMetaPage
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
            'Settings Admin', 
            'Social Header Meta', 
            'manage_options', 
            'social-header-meta-admin', 
            array( $this, 'create_admin_page' )
        );
    }

    /**
     * Options page callback
     */
    public function create_admin_page()
    {
        // Set class property
        $this->options = get_option( 'social_header_meta' );
        ?>
        <div class="wrap">
            <?php screen_icon(); ?>
            <h2>Social Header Meta Settings</h2>           
            <form method="post" action="options.php">
            <?php
                // This prints out all hidden setting fields
                settings_fields( 'social_header_meta_group' );   
                do_settings_sections( 'social-header-meta-admin' );
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
            'social_header_meta_group', // Option group
            'social_header_meta', // Option name
            array( $this, 'sanitize' ) // Sanitize
        );

        add_settings_section(
            'twitter_section_id', // ID
            'Twitter Settings', // Title
            array( $this, 'print_section_info' ), // Callback
            'social-header-meta-admin' // Page
        );  

        add_settings_field(
            'status', // ID
            'Status', // Title 
            array( $this, 'status_callback' ), // Callback
            'social-header-meta-admin', // Page
            'twitter_section_id' // Section           
        );      

        add_settings_field(
            'username', 
            'Twitter Handle', 
            array( $this, 'username_callback' ), 
            'social-header-meta-admin', 
            'twitter_section_id'
        );      
    }

    /**
     * Sanitize each setting field as needed
     *
     * @param array $input Contains all settings fields as array keys
     */
    public function sanitize( $input )
    {
    	//print_r($input);
    	//die();
        if( !is_numeric( $input['status'] ) )
            $input['status'] = '';  

        if( !empty( $input['username'] ) )
            $input['username'] = sanitize_text_field( $input['username'] );

        return $input;
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
    public function status_callback()
    {
    	$status =  $this->options['status']; 
    	?>
		<input name="social_header_meta[status]" type="checkbox" value="1" <?php checked( 1, $status, true ) ?> /> Enable Twitter
		<?php
        // printf(
        //     '<input type="checkbox" id="status" name="social_header_meta[status]" value="%s" />',
        //     esc_attr( $this->options['status'])
        // );
    }

    //public function checked( 1 == 1, true );

    /** 
     * Get the settings option array and print one of its values
     */
    public function username_callback()
    {
        printf(
            '<input type="text" id="username" name="social_header_meta[username]" value="%s" />',
            esc_attr( $this->options['username'])
        );
    }
}

if( is_admin() ) {
    $my_settings_page = new SocialHeaderMetaPage();
}

?>