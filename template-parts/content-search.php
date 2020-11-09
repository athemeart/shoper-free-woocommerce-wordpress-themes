<?php
/**
 * Template part for displaying results in search pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package shoper
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( array('shoper-single-post') ); ?>>

 	 <?php
    /**
    * Hook - shoper_posts_blog_media.
    *
    * @hooked shoper_posts_formats_thumbnail - 10
    */
    //do_action( 'shoper_posts_blog_media' );
    ?>
    <div class="post search-page">
               
		<?php
        /**
        * Hook - diet_shop_site_content_type.
        *
		* @hooked site_loop_heading - 10
        * @hooked render_meta_list	- 20
		* @hooked site_content_type - 30
        */
        do_action( 'shoper_site_content_type', array( 'date', 'category' ) );
        ?>
      
       
    </div>
    
</article><!-- #post-<?php the_ID(); ?> -->


