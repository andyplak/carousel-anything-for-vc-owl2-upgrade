<?php
/**
  * Plugin Name: Carousel Anything for VC (Owl 2 add on)
  * Description: Upgrades Carousel Anything to make use of the v2 of the Owl Carousel which includes infinate loop
  * Author: Andy Place
  * Version: 0.1
  * Author URI: http://www.andyplace.co.uk
  * Plugin URI: http://www.andyplace.co.uk
  *
  */


/**
 * Remove original 1.3 owl carousel assets and add in v2 assets in their place
 * Hook into gambit_xx_output filter as wp_enqueue_scripts and plugins_loaded happen too early
 */
function cavc_upgrade_assets($ret) {

  // Remove Carousel Anything assets
  wp_dequeue_style('gcp-owl-carousel-css');
  wp_dequeue_style('carousel-anything-owl');
  wp_dequeue_style('carousel-anything-single-post');
  wp_dequeue_script('carousel-anything-owl');
  wp_dequeue_script('carousel-anything');

  // Add Owl 2 equivelents
  wp_enqueue_style( 'owl-carousel2-css', plugins_url( 'css/owl.carousel.min.css', __FILE__ ), array(), '2.1.0' );
  wp_enqueue_style( 'owl-carousel2-theme-css', plugins_url( 'css/owl.theme.default.css', __FILE__ ), array(), '2.1.0' );
  wp_enqueue_script( 'carousel-anything-owl2', plugins_url( 'js/owl.carousel2-min.js', __FILE__ ), array( 'jquery' ), '2.1.0', true );
  wp_enqueue_script( 'carousel-anything-init', plugins_url( 'js/carousel-init.js', __FILE__ ), array( 'jquery', 'carousel-anything-owl2' ), VERSION_GAMBIT_CAROUSEL_ANYTHING, true );

  return $ret;
}
add_filter( 'gambit_cp_output', 'cavc_upgrade_assets', 10, 1 );
add_filter( 'gambit_ca_output', 'cavc_upgrade_assets', 10, 1 );