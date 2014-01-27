<?php
/**
 * The template for displaying the footer.
 *
 * Contains footer content and the closing of the
 * #main and #page div elements.
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */
?>

		</div><!-- #main -->
	
	</div><!-- #page -->
	<div class="clear">
	</div>
	<div class=" color-5">
	<footer  class=" row color-5" >
			<div class="large-12 columns">
			
			<div class="large-3 foot-col columns color-6">
			<?php get_sidebar( 'footer1' ); ?>
			</div>
			
			<div class="large-3 columns foot-col color-5">
			<?php get_sidebar( 'footer2' ); ?>
			</div>
			
			
			<div class="large-3 columns foot-col color-6">
			<?php get_sidebar( 'footer3' ); ?>
			</div>
			
			
			<div class="large-3 columns foot-col color-5">
			<?php get_sidebar( 'footer4' ); ?>
			</div>
			
			
			
			<!-- .site-info -->
			</div>
		</footer><!-- #colophon -->
		
		<div class="bottom-bar">
		<div class="row">
		
		<div class="large-5 columns"><p>Todos los derechos reservados de AZTEVIA © 2013</p></div>
		<div class="large-4 columns">
		<div class="logo-footer"></div>
		
		 </div>
		
		</div>
		</div>
		
		</div>
<script src="<?php echo get_template_directory_uri(); ?>/foundation/js/jquery.js"></script>
    <script src="<?php echo get_template_directory_uri(); ?>/foundation/js/foundation.min.js"></script>
    <script>
      $(document).foundation();
    </script>

	<?php wp_footer(); ?>
</body>
</html>