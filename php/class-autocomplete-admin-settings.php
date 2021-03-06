<?php
if(!class_exists('Autocomplete_Admin_Settings')){
  class Autocomplete_Admin_Settings{

    function __construct(){
      if(is_admin()){
        add_action('admin_menu', array($this, 'add_autocomplete_settings_page'));
        add_action('admin_init', array($this, 'init_autocomplete_settings'));
      }
    }

    function add_autocomplete_settings_page(){
      add_plugins_page(
        'Autocomplete Settings',
        'Autocomplete Settings',
        'manage_options',
        'jquery_ui_autocomplete_settings_page',
        array($this, 'autocomplete_settings_page_view')
      );
    }

    function autocomplete_settings_page_view(){
      ?>
      <div class="wrap">
        <?php screen_icon(); ?>
        <h2>Autocomplete Settings</h2>
        <form method="post" action="options.php">
        <?php
          settings_fields('autocomplete_settings_group');
          do_settings_sections('jquery_ui_autocomplete_settings_page');
        ?>
        <?php submit_button(); ?>
        </form>
      </div>
      <?php
    }

    function init_autocomplete_settings(){
      // jquery ui theme setting
      register_setting(
        'autocomplete_settings_group',
        '_jquery_ui_theme_name'
      );

      add_settings_section(
        'jquery_ui_settings_section',
        'UI Theme',
        array($this, 'jquery_ui_settings_section_info'),
        'jquery_ui_autocomplete_settings_page'
      );

      add_settings_field(
        'theme_name',
        'jQuery UI Theme Name',
        array($this, 'jquery_ui_theme_name_field_view'),
        'jquery_ui_autocomplete_settings_page',
        'jquery_ui_settings_section'
      );

      // search style setting
      register_setting(
        'autocomplete_settings_group',
        '_autocomplete_search_style'
      );

      add_settings_section(
        'search_style_settings_section',
        'Search Style',
        array($this, 'search_style_settings_section_info'),
        'jquery_ui_autocomplete_settings_page'
      );

      add_settings_field(
        'search_style',
        'Search Style',
        array($this, 'search_style_field_view'),
        'jquery_ui_autocomplete_settings_page',
        'search_style_settings_section'
      );

      // dataset settings
      register_setting(
        'autocomplete_settings_group',
        '_autocomplete_datasets'
      );

      add_settings_section(
        'dataset_settings_section',
        'Datasets',
        array($this, 'dataset_settings_section_info'),
        'jquery_ui_autocomplete_settings_page'
      );

      add_settings_field(
        'datasets',
        'Datasets',
        array($this, 'datasets_field_view'),
        'jquery_ui_autocomplete_settings_page',
        'dataset_settings_section',
        array(
          'Tags' => 'tags',
          'Categories' => 'categories',
          'Post Titles' => 'post_titles',
          'Page Titles' => 'page_titles',
          'Authors' => 'authors',
          'Contributors' => 'contributors',
          'Editors' => 'editors'
        )
      );
    }

    // section info
    function jquery_ui_settings_section_info(){
      echo 'Choose the UI theme for your autocomplete field. Choose "Custom" if you plan to enqueue a non-standard theme elsewhere.';
    }

    function search_style_settings_section_info(){
      echo 'Choose "search" for autocomplete to suggest any occurance of your query. Select "Lookup" for autocomplete to suggest items that start with your query.';
    }

    function dataset_settings_section_info(){
      echo 'Choose the datasets to be included in the autocomplete search.';
    }

    // fields
    function jquery_ui_theme_name_field_view(){
    ?>
      <select name="_jquery_ui_theme_name">
        <option value="base"<?php echo get_option('_jquery_ui_theme_name') === 'base' ? ' selected' : ''; ?>>Base</option>
        <option value="black-tie"<?php echo get_option('_jquery_ui_theme_name') === 'black-tie' ? ' selected' : ''; ?>>Black Tie</option>
        <option value="blitzer"<?php echo get_option('_jquery_ui_theme_name') === 'blitzer' ? ' selected' : ''; ?>>Blitzer</option>
        <option value="cupertino"<?php echo get_option('_jquery_ui_theme_name') === 'cupertino' ? ' selected' : ''; ?>>Cupertino</option>
        <option value="dark-hive"<?php echo get_option('_jquery_ui_theme_name') === 'dark-hive' ? ' selected' : ''; ?>>Dark Hive</option>
        <option value="dot-luv"<?php echo get_option('_jquery_ui_theme_name') === 'dot-luv' ? ' selected' : ''; ?>>Dot Luv</option>
        <option value="eggplant"<?php echo get_option('_jquery_ui_theme_name') === 'eggplant' ? ' selected' : ''; ?>>Eggplant</option>
        <option value="excite-bike"<?php echo get_option('_jquery_ui_theme_name') === 'excite-bike' ? ' selected' : ''; ?>>Excite Bike</option>
        <option value="flick"<?php echo get_option('_jquery_ui_theme_name') === 'flick' ? ' selected' : ''; ?>>Flick</option>
        <option value="hot-sneaks"<?php echo get_option('_jquery_ui_theme_name') === 'hot-sneaks' ? ' selected' : ''; ?>>Hot Sneaks</option>
        <option value="humanity"<?php echo get_option('_jquery_ui_theme_name') === 'humanity' ? ' selected' : ''; ?>>Humanity</option>
        <option value="le-frog"<?php echo get_option('_jquery_ui_theme_name') === 'le-frog' ? ' selected' : ''; ?>>Le Frog</option>
        <option value="mint-choc"<?php echo get_option('_jquery_ui_theme_name') === 'mint-choc' ? ' selected' : ''; ?>>Mint Choc</option>
        <option value="overcast"<?php echo get_option('_jquery_ui_theme_name') === 'overcast' ? ' selected' : ''; ?>>Overcast</option>
        <option value="pepper-grinder"<?php echo get_option('_jquery_ui_theme_name') === 'pepper-grinder' ? ' selected' : ''; ?>>Pepper Grinder</option>
        <option value="redmond"<?php echo get_option('_jquery_ui_theme_name') === 'redmond' ? ' selected' : ''; ?>>Redmond</option>
        <option value="smoothness"<?php echo get_option('_jquery_ui_theme_name') === 'smoothness' ? ' selected' : ''; ?>>Smoothness</option>
        <option value="south-street"<?php echo get_option('_jquery_ui_theme_name') === 'south-street' ? ' selected' : ''; ?>>South Street</option>
        <option value="start"<?php echo get_option('_jquery_ui_theme_name') === 'start' ? ' selected' : ''; ?>>Start</option>
        <option value="sunny"<?php echo get_option('_jquery_ui_theme_name') === 'sunny' ? ' selected' : ''; ?>>Sunny</option>
        <option value="swanky-purse"<?php echo get_option('_jquery_ui_theme_name') === 'swanky-purse' ? ' selected' : ''; ?>>Swanky Purse</option>
        <option value="trontastic"<?php echo get_option('_jquery_ui_theme_name') === 'trontastic' ? ' selected' : ''; ?>>Trontastic</option>
        <option value="ui-darkness"<?php echo get_option('_jquery_ui_theme_name') === 'ui-darkness' ? ' selected' : ''; ?>>UI Darkness</option>
        <option value="ui-lightness"<?php echo get_option('_jquery_ui_theme_name') === 'ui-lightness' ? ' selected' : ''; ?>>UI Lightness</option>
        <option value="vader"<?php echo get_option('_jquery_ui_theme_name') === 'vader' ? ' selected' : ''; ?>>Vader</option>
        <option value="custom"<?php echo get_option('_jquery_ui_theme_name') === 'custom' ? ' selected' : ''; ?>>Custom</option>
      </select>
    <?php
    }

    function search_style_field_view(){
    ?>
      <select name="_autocomplete_search_style">
        <option value="lookup"<?php echo get_option('_autocomplete_search_style') === 'lookup' ? ' selected' : ''; ?>>Lookup</option>
        <option value="search"<?php echo get_option('_autocomplete_search_style') === 'search' ? ' selected' : ''; ?>>Search</option>
      </select>
    <?php
    }

    function datasets_field_view($datasets){
      $settings = (array) get_option('_autocomplete_datasets');
      foreach($datasets as $datasetName => $dataset){
        $selected = isset($settings[$dataset]) && $settings[$dataset] == 1 ? true : false;
        ?>
          <input type="checkbox" name="_autocomplete_datasets[<?php echo $dataset; ?>]" id="checkbox_<?php echo $dataset; ?>" value="1"<?php echo $selected ? ' checked' : ''; ?> /> <label for="checkbox_<?php echo $dataset; ?>"><?php echo $datasetName; ?></label><br />
        <?php
      }
    }
  }
}
