<?php
/*
Plugin Name: jQuery UI Autocomplete
Plugin URI: http://github.com/kylereicks/wp-jquery-ui-auto-complete
Description: A wordpress plugin to add jQuery UI autocomplete to the wordpress search form.
Author: Kyle Reicks
Version: 0.1
Author URI: http://github.com/kylereicks
*/

include('php/class-autocomplete-admin-settings.php');

if(!class_exists('WP_JQuery_UI_Autocomplete')){
  class WP_JQuery_UI_Autocomplete{

    function __construct(){
      $autocomplete_admin_settings = new Autocomplete_Admin_Settings();
      add_action('wp_enqueue_scripts', array($this, 'jquery_ui_autocomplete_activation_script'), 99);
    }

    function jquery_ui_autocomplete_activation_script(){

      // register scripts
      wp_register_script('autocomplete_activation', plugins_url('js/autocomplete-activation.js', __FILE__), array('jquery-ui-autocomplete'), 0.1, true);

      // register styles
      wp_register_style('jquery_ui_theme', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/themes/' . get_option('ui_theme_name') . '/jquery-ui.css', false, 0.1, false);

      // enqueue scripts
      wp_enqueue_script('autocomplete_activation');

      // enqueue styles
      wp_enqueue_style('jquery_ui_theme');

      // localize variables
      $data = array('dataUrl' => plugins_url('data/json.php?data=tags&style=' . get_option('autocomplete_search_style'), __FILE__), 'datasets' => array('tags', 'categories', 'post_titles', 'authors', 'contributors', 'editors'));
      wp_localize_script('autocomplete_activation', 'autocompletePlugin', $data);

    }

  }
  $wp_jquery_ui_autocomplete = new WP_JQuery_UI_Autocomplete();
}