<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://www.sourcepole.com/modest-map-wp
 *
 * @package    Modest_Map
 * @subpackage Modest_Map/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Modest_Map
 * @subpackage Modest_Map/public
 * @author     <modest-map-wp@sourcepole.com>
 */
class Modest_Map_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @access   private
	 * @var      string    $modest_map    The ID of this plugin.
	 */
	private $modest_map;

	/**
	 * The version of this plugin.
	 *
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @param      string    $modest_map       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $modest_map, $version ) {

		$this->modest_map = $modest_map;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Modest_Map_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Modest_Map_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_register_style( $this->modest_map, plugin_dir_url( __FILE__ ) . 'css/modest-map-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Modest_Map_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Modest_Map_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_register_script( $this->modest_map, plugin_dir_url( __FILE__ ) . 'js/modest-map-public.js', array(), $this->version, true );
	}

}
