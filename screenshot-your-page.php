<?php
/**
 * Plugin Name: Screenshot your page
 * Plugin URI: https://www.anastasys.gr
 * Description: Plugin to take a screenshot of your current page and download it to your device
 * Version: 0.1
 * Text Domain: anastasys.gr
 * Authors: Anastasios Tsourounis, Dimitris Margelos, Andreas Andrikopoulos
 * Author URI: https://www.anastasys.gr
 */

function enqueue_related_pages_scripts_and_styles(){
	wp_enqueue_style('screenshot-styles', plugins_url('assets/css/screenshot-your-page.css', __FILE__));
	wp_enqueue_script('screenshot-script', plugins_url( 'assets/js/screenshot-your-page.js' , __FILE__ ),false,1.0,true);
    wp_enqueue_script('Html2canvas', 'https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js', array(), false, false);
	wp_enqueue_script( 'Canvastoimage', 'https://superal.github.io/canvas2image/canvas2image.js', array(), false, false );
}

add_action('wp_enqueue_scripts','enqueue_related_pages_scripts_and_styles');

// WP Query Shortcode For products section in home page
function screenshot_button( $atts ) {
	ob_start();
 
    // define attributes/parameters and their defaults
    extract( shortcode_atts( array (
        'title' => 'Page Screenshot',
        'colour' => '#007BFF',
    ), $atts ) );
 
    // define query arguments based on parameters
    /*$args = array(
        'post_type' => $post_type,
        'order' => $order,
        'orderby' => $orderby,
        'posts_per_page' => $posts,
        'offset' => $offset,
        'category_name' => $category,
        'category__not_in' => $exclude_category,
    );*/

    // run the loop based on the query arguments
    ?>
        <div class="container-scrshot-your-page text-center">
            <div class="row" id="post-<?php the_ID(); ?>">
            <?php while ( $query->have_posts() ) : $query->the_post(); ?>
            <div class="col-sm-6 col-md-3">
				<div class="hover-blur">
					<a href="<?php echo get_the_permalink(); ?>" title="<?php echo get_the_title(); ?>">
						<?php echo the_post_thumbnail( 'medium' ); ?>
						<div class="overlay">
							<h3 class="product-text">ΑΓΟΡΑ</h3>
						</div>
					</a>
				</div>
                <p class="mt-3 mb-0"><?php echo get_the_title(); ?></p>
                <?php $product = wc_get_product( get_the_ID() ); /* get the WC_Product Object */ ?>
                <p><?php echo $product->get_price().'€'; ?></p>
            </div>
            <?php endwhile; wp_reset_postdata(); ?>
            </div>
    <?php
        $myvariable = ob_get_clean();
        return $myvariable;
}
add_shortcode( 'screnshot', 'screenshot_button' );