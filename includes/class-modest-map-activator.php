<?php

/**
 * Fired during plugin activation
 *
 * @link       https://www.sourcepole.com/modest-map-wp
 *
 * @package    Modest_Map
 * @subpackage Modest_Map/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @package    Modest_Map
 * @subpackage Modest_Map/includes
 * @author     <modest-map-wp@sourcepole.com>
 */
class Modest_Map_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 */
	public static function activate() {
        $basemap = MODEST_MAP__PLUGIN_DIR . 'public/data/basemap.pmtiles';
        if (!file_exists($basemap)) {
            $src = MODEST_MAP__PLUGIN_DIR . 'public/data/planet-z02.pmtiles';
            copy($src, $basemap);
        }
        $extract = MODEST_MAP__PLUGIN_DIR . 'public/data/extract.pmtiles';
        if (!file_exists($extract)) {
            $src = MODEST_MAP__PLUGIN_DIR . 'public/data/empty.pmtiles';
            copy($src, $extract);
        }

	}

}
