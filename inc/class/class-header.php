<?php
/**
 * The Site Theme Header Class 
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package shoper
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
class shoper_Header_Layout{
	/**
	 * Function that is run after instantiation.
	 *
	 * @return void
	 */
	public function __construct() {

		add_action('shoper_header_layout_1_branding', array( $this, 'get_site_branding' ), 10 );

		add_action('shoper_header_layout_1_navigation', array( $this, 'get_site_navigation' ), 10 );



		add_action('shoper_site_header', array( $this, 'site_skip_to_content' ), 5 );

		add_action('shoper_site_header', array( $this, 'site_header_wrap_before' ), 10 );

		add_action('shoper_site_header', array( $this, 'get_site_search_form' ), 20 );

		
		add_action('shoper_site_header', array( $this, 'site_header_layout' ), 30 );

		add_action('shoper_site_header', array( $this, 'site_header_wrap_after' ), 999 );

		add_action('shoper_site_header', array( $this, 'site_hero_sections' ), 9999 );
		
	}
	/**
	* @return $html
	*/
	function site_header_wrap_before(){
		
		$html = '<header id="masthead" class="site-header">';	
		
		echo wp_kses( $html , $this->alowed_tags() );
		
	}
	/**
	* @return $html
	*/
	function site_header_wrap_after(){
		
		$html = '</header>';	
		
		echo wp_kses( $html , $this->alowed_tags() );
		
	}
	/**
	* Container before
	*
	* @return $html
	*/
	function site_skip_to_content(){
		
		echo '<a class="skip-link screen-reader-text" href="#content">'. esc_html__( 'Skip to content', 'shoper' ) .'</a>';
	}
	/**
	* Container before
	*
	* @return $html
	*/
	function site_header_layout(){
		?>
		<div class="container">
			<div class="row align-items-center">
				<div class="col-lg-3 col-md-7 col-sm-7 col-12">
					<?php do_action('shoper_header_layout_1_branding');?>
				</div>
				<div class="col-lg-9 col-md-5 col-sm-5 col-12 text-right">
					<?php 
					do_action('shoper_header_layout_1_navigation');
					echo wp_kses( $this->get_site_header_icon(), $this->alowed_tags() );
					?>
					
				</div>
				
			</div>
		</div>
		<?php		
	}
	
	
	/**
	* Get the Site logo
	*
	* @return HTML
	*/
	public function get_site_branding (){
		
		$html = '<div class="logo-wrap">';
		
		if ( function_exists( 'the_custom_logo' ) && has_custom_logo() ) {
			$html .= get_custom_logo();
			
		}
		if ( display_header_text() == true ){
			
			$html .= '<h3><a href="'.esc_url( home_url( '/' ) ).'" rel="home" class="site-title">';
			$html .= get_bloginfo( 'name' );
			$html .= '</a></h3>';
			$description = get_bloginfo( 'description', 'display' );
		
			if ( $description ) :
			    $html .=  '<div class="site-description">'.esc_html($description).'</div>';
			endif;
		}
		$html .= '<button class="shoper-rd-navbar-toggle" tabindex="0" autofocus="true"><i class="icofont-navigation-menu"></i></button>';
		
		$html .= '</div>';
		
		$html = apply_filters( 'get_site_branding_filter', $html );
		
		echo wp_kses( $html, $this->alowed_tags() );
		
	}
	
	/**
	* Get the Site Main Menu / Navigation
	*
	* @return HTML
	*/
	public function get_site_navigation (){
		
		?>
		<nav id="navbar">
		<button class="shoper-navbar-close"><i class="icofont-ui-close"></i></button>

		<?php
			wp_nav_menu( array(
				'theme_location'    => 'menu-1',
				'depth'             => 3,
				'menu_class'  		=> 'shoper-main-menu navigation-menu',
				'container'			=> 'ul',
				//'fallback_cb'       => 'shoper_navwalker::fallback',
			) );
		?>
		
		</nav>
        <?php	
		
	}
	/**
	* Get the Site Main Menu / Navigation
	*
	* @return HTML
	*/
	public function get_site_header_icon (){
	 ?>
	<ul class="header-icon">
	  <li><a href="javascript:void(0)" class="search-overlay-trigger"><i class="icofont-search-2"></i></a></li>
	  
	  <?php if ( class_exists( 'WooCommerce' ) ) :?>
	  <li><?php shoper_woocommerce_cart_link(); ?></li>
	  <li><a href="javascript:void(0)"><i class="icofont-user-alt-4"></i></a>
	  
	  	<ul>
		<?php foreach ( wc_get_account_menu_items() as $endpoint => $label ) : ?>
			<li class="<?php echo wc_get_account_menu_item_classes( $endpoint ); ?>">
				<a href="<?php echo esc_url( wc_get_account_endpoint_url( $endpoint ) ); ?>"><?php echo esc_html( $label ); ?></a>
			</li>
		<?php endforeach; ?>
		</ul>

	  </li>
	<?php endif;?>

	</ul>

	 <?php
	}
	/**
	* Get the Site search bar
	*
	* @return HTML
	*/
	public function get_site_search_form (){
	?>
	<div class="search-bar" id="search-bar">
		<div class="container-wrap">
		<div class="container">
			<div class="row align-items-center">
				<div class="col-md-8">
					<?php 
					if( class_exists('APSW_Product_Search_Finale_Class') && class_exists( 'WooCommerce' ) ){
						do_action('apsw_search_bar_preview');
					}else{
						get_search_form();
					}
					?>
				</div>
				<div class="col-md-4">
					<a href="javascript:void(0)" class="search-close-trigger"><i class="icofont-close"></i></a>
				</div>
			</div>
		</div>
		</div>
	</div>		
	<?php
	}

	public function get_site_breadcrumb (){
		if( function_exists('bcn_display') && ( !is_home() || !is_front_page())  ):?>
        	<div class="shoper-breadcrumbs-wrap"><div class="container"><div class="row"><div class="col-md-12">
            <div class="shoper-breadcrumbs" typeof="BreadcrumbList" vocab="https://schema.org/">
                <?php bcn_display_list();?>
           </div></div></div></div>
            </div>
        <?php
		endif; 
	}
	/**
	* Get the hero sections
	*
	* @return HTML
	*/
	public function site_hero_sections(){
		if ( is_front_page() && is_active_sidebar( 'slider' ) ) : 
		 dynamic_sidebar( 'slider' );
		else: 
		$header_image = get_header_image();
		?>
        	<?php if( !empty( $header_image ) ) : ?>
            <div id="static_header_banner" class="header-img" style="background-image: url(<?php echo esc_url( $header_image );?>); background-attachment: scroll;">
             <?php else: ?>
             <div id="static_header_banner">
            <?php endif;?>
            
           
			
		    	<div class="content-text">
		            <div class="container">
		               	<?php echo wp_kses( $this->hero_block_heading(), $this->alowed_tags() ); ?>
		            </div>
		        </div>
		    </div>
		<?php
		endif;
	}
	/**
	 * Add Banner Title.
	 *
	 * @since 1.0.0
	 */
	function hero_block_heading() {
		 echo '<div class="site-header-text-wrap">';
		
			if ( is_home() ) {
					echo '<h1 class="page-title-text">';
					echo bloginfo( 'name' );
					echo '</h1>';
					echo '<p class="subtitle">';
					echo esc_html(get_bloginfo( 'description', 'display' ));
					echo '</p>';
			}else if ( function_exists('is_shop') && is_shop() ){
				if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
					echo '<h1 class="page-title-text">';
					echo esc_html( woocommerce_page_title() );
					echo '</h1>';
				}
			}else if( function_exists('is_product_category') && is_product_category() ){
				echo '<h1 class="page-title-text">';
				echo esc_html( woocommerce_page_title() );
				echo '</h1>';
				echo '<p class="subtitle">';
				do_action( 'woocommerce_archive_description' );
				echo '</p>';
				
			}elseif ( is_singular() ) {
				echo '<h1 class="page-title-text">';
					echo single_post_title( '', false );
				echo '</h1>';
			} elseif ( is_archive() ) {
				
				the_archive_title( '<h1 class="page-title-text">', '</h1>' );
				the_archive_description( '<p class="archive-description subtitle">', '</p>' );
				
			} elseif ( is_search() ) {
				echo '<h1 class="title">';
					printf( /* translators:straing */ esc_html__( 'Search Results for: %s', 'shoper' ),  get_search_query() );
				echo '</h1>';
			} elseif ( is_404() ) {
				echo '<h1 class="display-1">';
					esc_html_e( 'Oops! That page can&rsquo;t be found.', 'shoper' );
				echo '</h1>';
			}
		
		echo '</div>';
	}
	private function alowed_tags(){
		
		if( function_exists('shoper_alowed_tags') ){ 
			return shoper_alowed_tags(); 
		}else{
			return array();	
		}
		
	}
}

new shoper_Header_Layout();