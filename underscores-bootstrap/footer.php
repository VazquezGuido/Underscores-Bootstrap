<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Underscores_Bootstrap
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer">
		<div class="site-info">
			&copy; <?php echo date("Y"); ?> <?php bloginfo( 'name' ); ?>. All rights reserved.
			<span class="sep"> | </span>
			<a href="<?php echo home_url();?>/privacy">Privacy policy</a>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- .container -->
</div><!-- #page -->

<?php wp_footer(); ?>

<script type="text/javascript">
jQuery(function() {
	jQuery('#site-navigation').mmenu({}, {clone: true});
});
</script>

</body>
</html>
