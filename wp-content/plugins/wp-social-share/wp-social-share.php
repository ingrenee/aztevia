<?php
/*
Plugin Name: WP Social Share
Version: 1.1
Description: Add Social Networks Share Button at Home, Category and Single Posts.
Author: Anas Mir
Author URI: http://sharp-coders.com/author/anasmir
Plugin URI: http://sharp-coders.com/plugins/wp-plugins/wp-social-share
*/

/*Check Version*/
global $wp_version;
$exit_msg="WP Requires Latest version, Your version is old";
if(version_compare($wp_version, "3.0", "<"))
{
	exit($exit_msg);
}

if(!class_exists(WPSocialShare)):
	class WPSocialShare{
		function WPSocialShareThisCatsPosts($content)
		{
			$options = $this->get_wp_social_share_options();
			if(is_single()){
				if($options['post_enable'] == "yes" || $options['post_enable'] != "no"){
					return $content.$this->wp_social_share_single_post();
				}else{
					return $content;
				}
			}else if(is_home() || is_category() || is_page()){
				if($options['cat_enable'] == "yes" || $options['cat_enable'] != "no"){
					return $this->wp_social_share_cat_post().$content;
				}else{
					return $content;
				}
			}else{
				return $content;
			}
		}

		function handle_wp_social_share_options()
		{
			$settings = $this->get_wp_social_share_options();
			if (isset($_POST['submitted']))
			{
				//check security
				check_admin_referer('wp-social-share-by-sharp-coders');
				
				$settings['cat_enable'] = isset($_POST['cat_enable'])? "yes" : "no" ;
				$settings['cat_twitter'] = isset($_POST['cat_twitter'])? "yes" : "no" ;
				$settings['cat_gplus'] = isset($_POST['cat_gplus'])? "yes" : "no" ;
				$settings['cat_facebook'] = isset($_POST['cat_facebook'])? "yes" : "no" ;
				$settings['cat_facebook_share'] = isset($_POST['cat_facebook_share'])? "yes" : "no" ;
				$settings['cat_linkedin'] = isset($_POST['cat_linkedin'])? "yes" : "no" ;
				$settings['cat_stumbleupon'] = isset($_POST['cat_stumbleupon'])? "yes" : "no" ;
				$settings['cat_diggthis'] = isset($_POST['cat_diggthis'])? "yes" : "no" ;
				$settings['cat_reddit'] = isset($_POST['cat_reddit'])? "yes" : "no" ;
				$settings['cat_evernote'] = isset($_POST['cat_evernote'])? "yes" : "no" ;
				$settings['post_enable'] = isset($_POST['post_enable'])? "yes" : "no" ;
				$settings['post_twitter'] = isset($_POST['post_twitter'])? "yes" : "no" ;
				$settings['post_gplus'] = isset($_POST['post_gplus'])? "yes" : "no" ;
				$settings['post_facebook'] = isset($_POST['post_facebook'])? "yes" : "no" ;
				$settings['post_facebook_share'] = isset($_POST['post_facebook_share'])? "yes" : "no" ;
				$settings['post_linkedin'] = isset($_POST['post_linkedin'])? "yes" : "no" ;
				$settings['post_stumbleupon'] = isset($_POST['post_stumbleupon'])? "yes" : "no" ;
				$settings['post_diggthis'] = isset($_POST['post_diggthis'])? "yes" : "no" ;
				$settings['post_reddit'] = isset($_POST['post_reddit'])? "yes" : "no" ;
				$settings['post_evernote'] = isset($_POST['post_evernote'])? "yes" : "no" ;
				update_option("wp_social_share_options", serialize($settings));
				echo '<div class="updated fade"><p>Setting Updated!</p></div>';
			}
			$action_url = $_SERVER['REQUEST_URI'];
			include 'wp-social-share-admin-options.php';
		}
		//WP Social Share for Category or Home Post
		function wp_social_share_cat_post() {
		global $post;
		$options = $this->get_wp_social_share_options();
		$permalinked = urlencode(get_permalink($post->ID));
		$spermalink = get_permalink($post->ID);
		$title = urlencode($post->post_title);
		$stitle = $post->post_title;
		$data = '<div class="wp_social_share_cat_wrapper">';
				 if ($options["cat_twitter"] == "yes") 
				 { 
						   $data .='<div class="wp_social_share_twitter wpsh_cat_item" >
						<a href="https://twitter.com/share" class="twitter-share-button" data-url="'.$spermalink.'" data-text="'.$stitle.'" data-count="vertical">Tweet</a><script type="text/javascript" src="//platform.twitter.com/widgets.js"></script>
					</div> <!--Twitter Button-->';
				 }

			if ($options["cat_gplus"] == "yes") { 
					$data .= '<div class="wp_social_share_gplus wpsh_cat_item">
				<!-- Place this tag where you want the +1 button to render -->
				<div class="g-plusone" data-size="tall" data-href="'. $permalinked .'"></div>

				<!-- Place this render call where appropriate -->
				<script type="text/javascript">
				  (function() {
					var po = document.createElement("script"); po.type = "text/javascript"; po.async = true;
					po.src = "https://apis.google.com/js/plusone.js";
					var s = document.getElementsByTagName("script")[0]; s.parentNode.insertBefore(po, s);
				  })();
				</script>
					</div> <!--google plus Button-->';
				  } 

			 if ($options['cat_facebook'] == "yes") { 
						$data .= '<div class="wp_social_share_facebook wpsh_cat_item">
							<iframe src="http://www.facebook.com/plugins/like.php?href='. $permalinked .'&amp;send=false&amp;layout=box_count&amp;width=44&amp;show_faces=false&amp;action=like&amp;colorscheme=light&amp;font&amp;height=62" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:44px; height:62px;" allowTransparency="true"></iframe>
						</div> <!--facebook Button-->';
			 } 
			 
			 if ($options['cat_facebook_share'] == "yes") { 
						$data .= '<div class="wp_social_share_facebook_share wpsh_cat_item">
							<a expr:share_url="'. $permalinked .'" href="http://www.facebook.com/sharer.php" name="fb_share" type="box_count">Share</a><script src="http://static.ak.fbcdn.net/connect.php/js/FB.Share" type="text/javascript"></script>
						</div> <!--facebook Button-->';
			 } 

			 if ($options['cat_linkedin'] == "yes") { 
						$data .= '<div class="wp_social_share_linkedin wpsh_cat_item">
						<script src="http://platform.linkedin.com/in.js" type="text/javascript"></script>
						<script type="IN/Share" data-url="'. $permalinked .'" data-counter="top"></script>
						</div> <!--linkedin Button-->';
			 }  

			 if ($options['cat_diggthis'] == "yes") { 
						$data .= '<div class="wp_social_share_digg wpsh_cat_item">
					<script type="text/javascript">
					(function() {
					var s = document.createElement("SCRIPT"), s1 = document.getElementsByTagName("SCRIPT")[0];
					s.type = "text/javascript";
					s.async = true;
					s.src = "http://widgets.digg.com/buttons.js";
					s1.parentNode.insertBefore(s, s1);
					})();
					</script>
					<!-- Medium Button -->
					<a class="DiggThisButton DiggMedium"
					href="http://digg.com/submit?url='. $permalinked .'&amp;title='. $title .'"></a>
					</div> <!--Digg Button-->';
			 } 

			 if ($options['cat_evernote'] == "yes") { 
						$data .= '<div class="wp_social_share_evernote wpsh_cat_item">
						<script type="text/javascript" src="http://static.evernote.com/noteit.js"></script>
						<a href="#" onclick="Evernote.doClip({contentId:"article_content",providerName:"'. $permalinked .'",suggestNotebook:"'. $title .'"}); return false;"><img src="http://static.evernote.com/article-clipper-vert.png" alt="Clip to Evernote" /></a>
						</div> <!--evernote Button-->';
			 } 

			 if ($options['cat_reddit'] == "yes") { 
						$data .='<div class="wp_social_share_reddit wpsh_cat_item">
							<script type="text/javascript">
							  reddit_url = "'. $permalinked .'";
							  reddit_title = "'. $title .'";
							</script>
							<script type="text/javascript" src="http://www.reddit.com/static/button/button3.js"></script>
						</div> <!--reddit Button-->';
			 } 
			$data .= '</div>';
			echo $data;
		 }


		//WP Social Share for Single Post
		function wp_social_share_single_post() {
		global $post;
		$options = $this->get_wp_social_share_options();
		$permalinked = urlencode(get_permalink($post->ID));
		$spermalink = get_permalink($post->ID);
		$title = urlencode($post->post_title);
		$stitle = $post->post_title;
		$data = '<div class="wp_social_single_share_wrapper">';
				 if ($options["post_twitter"] == "yes") 
				 { 
						   $data .='<div class="wp_social_share_twitter wpsh_item" >
						<a href="https://twitter.com/share" class="twitter-share-button" data-url="'. $spermalink .'" data-text="'.$stitle.'" data-count="vertical">Tweet</a><script type="text/javascript" src="//platform.twitter.com/widgets.js"></script>
					</div> <!--Twitter Button-->';
				 }

			if ($options["post_gplus"] == "yes") { 
					$data .= '<div class="wp_social_share_gplus wpsh_item">
				<!-- Place this tag where you want the +1 button to render -->
				<div class="g-plusone" data-size="tall" data-href="'. $permalinked .'"></div>

				<!-- Place this render call where appropriate -->
				<script type="text/javascript">
				  (function() {
					var po = document.createElement("script"); po.type = "text/javascript"; po.async = true;
					po.src = "https://apis.google.com/js/plusone.js";
					var s = document.getElementsByTagName("script")[0]; s.parentNode.insertBefore(po, s);
				  })();
				</script>
					</div> <!--google plus Button-->';
				  } 

			 if ($options['post_facebook'] == "yes") { 
						$data .= '<div class="wp_social_share_facebook wpsh_item">
							<iframe src="http://www.facebook.com/plugins/like.php?href='. $permalinked .'&amp;send=false&amp;layout=box_count&amp;width=70&amp;show_faces=false&amp;action=like&amp;colorscheme=light&amp;font&amp;height=62" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:76px; height:62px;" allowTransparency="true"></iframe>
						</div> <!--facebook Button-->';
			 }

			if ($options['post_facebook_share'] == "yes") { 
						$data .= '<div class="wp_social_share_facebook_share wpsh_item">
							<a expr:share_url="'. $permalinked .'" href="http://www.facebook.com/sharer.php" name="fb_share" type="box_count">Share</a><script src="http://static.ak.fbcdn.net/connect.php/js/FB.Share" type="text/javascript"></script>
						</div> <!--facebook Button-->';
			 }			 

			 if ($options['post_linkedin'] == "yes") { 
						$data .= '<div class="wp_social_share_linkedin wpsh_item">
						<script src="http://platform.linkedin.com/in.js" type="text/javascript"></script>
						<script type="IN/Share" data-url="'. $permalinked .'" data-counter="top"></script>
						</div> <!--linkedin Button-->';
			 } 

			 if ($options['post_diggthis'] == "yes") { 
						$data .= '<div class="wp_social_share_digg wpsh_item">
					<script type="text/javascript">
					(function() {
					var s = document.createElement("SCRIPT"), s1 = document.getElementsByTagName("SCRIPT")[0];
					s.type = "text/javascript";
					s.async = true;
					s.src = "http://widgets.digg.com/buttons.js";
					s1.parentNode.insertBefore(s, s1);
					})();
					</script>
					<!-- Medium Button -->
					<a class="DiggThisButton DiggMedium"
					href="http://digg.com/submit?url='. $permalinked .'&amp;title='. $title .'"></a>
					</div> <!--Digg Button-->';
			 } 

			 if ($options['post_evernote'] == "yes") { 
						$data .= '<div class="wp_social_share_evernote wpsh_item">
						<script type="text/javascript" src="http://static.evernote.com/noteit.js"></script>
						<a href="#" onclick="Evernote.doClip({contentId:"article_content",providerName:"'. $permalinked .'",suggestNotebook:"'. $title .'"}); return false;"><img src="http://static.evernote.com/article-clipper-vert.png" alt="Clip to Evernote" /></a>
						</div> <!--evernote Button-->';
			 } 

			 if ($options['post_reddit'] == "yes") { 
						$data .='<div class="wp_social_share_reddit wpsh_item">
							<script type="text/javascript">
							  reddit_url = "'. $permalinked .'";
							  reddit_title = "'. $title .'";
							</script>
							<script type="text/javascript" src="http://www.reddit.com/static/button/button3.js"></script>
						</div> <!--reddit Button-->';
			 } 
			$data .= '</div>';
			return $data;
		 }

		function wp_social_share_HeadAction()
		{
			echo '<style type="text/css">
					.wp_social_single_share_wrapper {
						background: #F4F4F4;border: 1px solid #EBEBEB;margin-bottom: 6px;margin-top: 6px;overflow: hidden;height: 62px;padding: 10px;
					}
					.wpsh_item {
						float: left;margin-right: 10px;
					}
					.wp_social_share_cat_wrapper {
						width: 55px;float: right;background: #F4F4F4;text-align: center;padding: 5px 3px;border: 1px solid #EBEBEB;margin-top: 0;
					}
					.wpsh_cat_item {
						margin: auto;margin-bottom: 8px;
					}
				 </style>';
		}
		function get_wp_social_share_options()
		{
			$options = unserialize(get_option("wp_social_share_options"));
			return $options;
		}
		function WP_Social_Share_install()
		{
			$options = array(
				'cat_enable' => 'yes',
				'cat_twitter' => 'yes',
				'cat_gplus' => 'yes',
				'cat_facebook' => 'yes',
				'cat_facebook_share' => 'no',
				'cat_linkedin' => 'no',
				'cat_stumbleupon' => 'no',
				'cat_diggthis' => 'no',
				'cat_reddit' => 'no',
				'cat_evernote' => 'no',
				'post_enable' => 'yes',
				'post_twitter' => 'yes',
				'post_gplus' => 'yes',
				'post_facebook' => 'yes',
				'post_facebook_share' => 'yes',
				'post_linkedin' => 'yes',
				'post_stumbleupon' => 'yes',
				'post_diggthis' => 'yes',
				'post_reddit' => 'yes',
				'post_evernote' => 'yes'
			);
			add_option("wp_social_share_options", serialize($options));
		}
		function wp_social_share_admin_menu()
		{
			add_options_page('WP Social Share', 'WP Social Share', 8, basename(__FILE__), array(&$this, 'handle_wp_social_share_options'));
		}
	}
else:
	exit('WPSocialShare Already Exists');
endif;

$WPSocialShare = new WPSocialShare();
if(isset($WPSocialShare)){
	register_activation_hook(__FILE__, array(&$WPSocialShare, 'WP_Social_Share_install'));
	add_filter('wp_head', array(&$WPSocialShare, 'wp_social_share_HeadAction'));
	//add_filter('the_content', array(&$WPSocialShare, 'WPSocialShareThisCatsPosts'));
	add_action('admin_menu', array(&$WPSocialShare, 'wp_social_share_admin_menu'));
}

function  postbar()
{$WPSocialShare = new WPSocialShare();
	echo $WPSocialShare->WPSocialShareThisCatsPosts('');
	}

?>