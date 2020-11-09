<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package shoper
 */

?>

	</div><!-- #content -->

	<?php
	/**
	* Hook - shoper_site_footer
	*
	* @hooked shoper_container_wrap_start
	*/
	do_action( 'shoper_site_footer');
	?>
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
