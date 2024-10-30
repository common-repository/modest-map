<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://www.sourcepole.com/modest-map-wp
 *
 * @package    Modest_Map
 * @subpackage Modest_Map/admin/partials
 */

$lat = 0.0;
$lng = 0.0;
$zoom = 1;
$status = "";
if (isset($_POST['submit'])
     && isset($_POST['_wpnonce'])
     && wp_verify_nonce($_POST['_wpnonce'], 'modest_map_options-options')) {
    $lat = (float) sanitize_text_field($_POST['lat']);
    $lng = (float) sanitize_text_field($_POST['lng']);
    $zoom = (int) sanitize_text_field($_POST['zoom']);

    // Download more detailed world map
    $basemap = MODEST_MAP__PLUGIN_DIR . 'public/data/basemap.pmtiles';
    $default = MODEST_MAP__PLUGIN_DIR . 'public/data/planet-z02.pmtiles';
    if (filesize($basemap) == filesize($default)) {
        $url = "https://osm.sourcepole.com/data/planet-z06.pmtiles";
        file_put_contents($basemap, file_get_contents($url));
    }
    
    // Download map extract for selected position
    $url = "https://osm.sourcepole.com/extract/?lat=$lat&lng=$lng";
    $dst = MODEST_MAP__PLUGIN_DIR . 'public/data/extract.pmtiles';
    if (file_put_contents($dst, file_get_contents($url))) {
        $status = "Map extract installed.";
    } else {
        $status = "Map extract download failed!";
    }
}
// h1 -> echo esc_html( get_admin_page_title() );
?>

<div class="wrap"
    x-data="{
        lat: <?php echo esc_js($lat) ?>,
        lng: <?php echo esc_js($lng) ?>,
        zoom: <?php echo esc_js($zoom) ?>,
        loading: false,
    }"
    x-init="window.WPModestMapPlugin.register_alpine_data($data)"
  >
  <h1>Modest Map</h1>

  <h2>Map Extract</h2>
  <div id='map' style='width: 600px; height: 300px;'></div>
  <form method="post" x-on:submit="loading = true">
    <?php
    // output security fields for the registered setting "modest_map_options"
    settings_fields( 'modest_map_options' );
    // output setting sections and their fields
    // (sections are registered for "modest_map", each field is registered to a specific section)
    do_settings_sections( 'modest_map' );
    ?>
    <input type="hidden" name="lat" x-model="lat">
    <input type="hidden" name="lng" x-model="lng">
    <input type="hidden" name="zoom" x-model="zoom">
    <?php
    submit_button( __( 'Download Map Extract', 'textdomain' ) );
    ?>
    <img src="/wp-admin/images/wpspin_light-2x.gif" x-show="loading">
    <?php echo esc_html($status); ?>
  </form>

  <h2>Shortcode helper</h2>
  <div x-data="{
        width: '600px',
        height: '400px',
        external_links: [],

        get shortcode() {
            links = this.external_links.join(',');
            return `[modest_map lat=${this.lat.toFixed(6)} lng=${this.lng.toFixed(6)} zoom=${this.zoom} width=${this.width} height=${this.height} links=${links}]`
        }
    }">
    <div>
        <label class="h3" for="map-shortcode">Map Shortcode</label>
        <input type="text" size="100" id="map-shortcode" readonly="readonly" x-model="shortcode">
    </div>

    <h2>Map Size</h2>
    <label for="map-width">Width</label>
    <input type="text" id="map-width" x-model="width">
    <br/>
    <label for="map-height">Height</label>
    <input type="text" id="map-height" x-model="height">
    <br/>

    <h2>External Link Buttons</h2>
    <label><input type="checkbox" value="google_satellite" x-model="external_links">Google Maps Satellite</label><br/>
    <label><input type="checkbox" value="google_streetview" x-model="external_links">Google Street View</label>
  </div>

  </div>
</div>
