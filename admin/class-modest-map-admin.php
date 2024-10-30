<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://www.sourcepole.com/modest-map-wp
 *
 * @package    Modest_Map
 * @subpackage Modest_Map/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Modest_Map
 * @subpackage Modest_Map/admin
 * @author     <modest-map-wp@sourcepole.com>
 */
class Modest_Map_Admin {

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
	 * @param      string    $modest_map       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $modest_map, $version ) {

		$this->modest_map = $modest_map . '-admin';
		$this->version = $version;
		add_action('admin_menu', array($this, 'admin_menu'));

	}

    public function admin_menu()
    {
	    add_menu_page( // add_options_page
	        'modest-map',
	        'Modest Map',
	        'manage_options',
	        'modest_map_settings',
	        array($this, "settings_page"),
	        '', //plugin_dir_url(__FILE__) . 'images/icon_modest_map.png',
	        null
	    );
    }

    public function settings_page()
    {
        include 'partials/modest-map-admin-display.php';
    }

	/**
	 * Register the stylesheets for the admin area.
	 *
	 */
	public function enqueue_styles() {

		/**
		 * An instance of this class should be passed to the run() function
		 * defined in Modest_Map_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Modest_Map_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->modest_map, plugin_dir_url( __FILE__ ) . 'css/modest-map-admin.css', array(), $this->version, 'all' );
		wp_enqueue_style ('leaflet', plugin_dir_url( __FILE__ ) . 'css/leaflet.css');

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 */
	public function enqueue_scripts() {

		/**
		 * An instance of this class should be passed to the run() function
		 * defined in Modest_Map_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Modest_Map_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->modest_map, plugin_dir_url( __FILE__ ) . 'js/modest-map-admin.js', array(), $this->version, false );
		wp_enqueue_script ('leaflet', plugin_dir_url( __FILE__ ) . 'js/leaflet.js');
		wp_enqueue_script ('alpinejs', plugin_dir_url( __FILE__ ) . 'js/alpinejs.min.js');
	}

}
