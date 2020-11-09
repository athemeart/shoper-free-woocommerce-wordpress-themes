<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package shoper
 */

get_header();

$layout = shoper_get_option('single_post_layout');

/**
* Hook - container_wrap_start 		- 5
*
* @hooked shoper_container_wrap_start
*/
 do_action( 'shoper_container_wrap_start', esc_attr( $layout ));
?>
	

		<?php
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content', get_post_type() );

			/**
			* Hook - shoper_site_footer
			*
			* @hooked shoper_container_wrap_start
			*/
			do_action( 'shoper_single_post_navigation');
			

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>

<?php
/**
* Hook - container_wrap_end 		- 999
*
* @hooked shoper_container_wrap_end
*/
do_action( 'shoper_container_wrap_end', esc_attr( $layout ));
get_footer();