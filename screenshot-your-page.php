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

function enqueue_screenshot_button_scripts_and_styles(){
	wp_enqueue_style('screenshot-styles', plugins_url('assets/css/screenshot-your-page.css', __FILE__));
    wp_enqueue_script('Html2canvas', 'https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js', array(), false, false);
	wp_enqueue_script( 'Canvastoimage', 'https://superal.github.io/canvas2image/canvas2image.js', array(), false, false );
	wp_enqueue_script('screenshot-script', plugins_url( 'assets/js/screenshot-your-page.js' , __FILE__ ),false, false);
}

add_action('wp_enqueue_scripts','enqueue_screenshot_button_scripts_and_styles');

// Shortcode function for sceenshot button
function screenshot_button( $atts ) {
	ob_start();
 
    // define attributes/parameters and their defaults

    $attributes = shortcode_atts(
        array(
            'title' => 'Page Screenshot',
            'color' => '',
         ), 
        $atts
    );
    
    $postid = get_the_ID();


    ?>
        <div class="container-scrshot-your-page text-center">
            <div class="row" id="post-<?php echo $postid; ?>">
                <div class="col-sm-6 col-md-3">
                    <button id="button-<?php echo $postid; ?>" class="scrshot-btn" style="background-color: <?php echo $attributes['color'] ?>"><?php echo $attributes['title'] ?></button>
                </div>
            </div>
            <script>  
            document.querySelector('#button-<?php echo $postid; ?>').addEventListener('click', function() {
                let element = document.getElementsByTagName('body');
                    const options = {
                    letterRendering: true
                    };

                    html2canvas(element, options).then(function(canvas) {      
                    document.body.appendChild(canvas);

                    const link = document.createElement('a');
                    link.download = 'scan-and-save.png';
                    link.href = canvas.toDataURL();
                    link.click();
                });
        }); 
            </script>
    <?php
        $myvariable = ob_get_clean();
        return $myvariable;
}
add_shortcode( 'screenshot', 'screenshot_button' );