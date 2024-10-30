<?php

/**
 * @link       https://www.sourcepole.com/modest-map-wp
 *
 * @package    Modest_Map
 * @subpackage Modest_Map/includes
 */

/**
 * @package    Modest_Map
 * @subpackage Modest_Map/includes
 * @author     <modest-map-wp@sourcepole.com>
 */
class Modest_Map_Shortcodes {

	public static function add() {
        add_shortcode( 'modest_map', 'modest_map_shortcode' );
	}

}

/**
 * The [modest-map] shortcode.
 *
 * @param array  $atts    Shortcode attributes. Default empty.
 * @return string Shortcode output.
 */
function modest_map_shortcode( $atts = [] ) {
    // normalize attribute keys, lowercase
    $atts = array_change_key_case( (array) $atts, CASE_LOWER );

    // override default attributes with user attributes
    $map_atts = shortcode_atts(
        array(
            'lat' => '0.0',
            'lng' => '0.0',
            'zoom' => '12',
            'width' => '600px',
            'height' => '400px',
            'links' => '',
        ), $atts, 'modest-map'
    );

    $o = '<div id="modest-map" ' .
      'style="width: ' . $map_atts['width'] . '; height: ' . $map_atts['height'] . ';"' .
      'data-lat="' . $map_atts['lat'] . '" ' .
      'data-lng="' . $map_atts['lng'] . '" ' .
      'data-zoom="' . $map_atts['zoom'] . '" ' .
      'data-links="' . $map_atts['links'] . '" ' .
      ' />';

    wp_enqueue_style( 'modest-map' );
    wp_enqueue_script( 'modest-map' );

    return $o;
}
