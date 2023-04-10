<?php

/**
 * @package GaniusPlugin
 */

/*
  Plugin Name: Tuto Plugin
  Plugin URI:www.google.com
  Description: J'apprends la creaction de plugin en partlan de zero
  Author: Mohamet Diatta
  Version: 1.0
 */


class TutoPlugin
{

   function __construct()
   {
      add_action("init", array($this, "costum_post_type"));
   }
   function register()
   {
      add_action("admin_enqueue_script", array($this, "enqueue"));
      add_action("admin_menu", array($this, "add_admin_menu"));
   }

   function add_admin_menu()
   {
      add_menu_page("Ganius Plugin", "Ganius-Plugin", "manage_options", "ganius_plugin", array($this, "add_template"), "dashicons-store", 110);
   }


   function add_template()
   {
      require_once plugin_dir_path(__FILE__) . "templates/admin.php";
   }
   function activate()
   {
      $this->costum_post_type();
      flush_rewrite_rules();
   }

   function deactivate()
   {
      echo "Plugin deactivate";
   }


   public function costum_post_type()
   {
      register_post_type("livres", ["public" => true, "label" => "Livres"]);
   }

   function enqueue()
   {
      wp_enqueue_style("tutoPluginStyle", plugins_url("/asssets/styles.css", __FILE__));
      wp_enqueue_script("tutoPluginScript", plugins_url("/asssets/scripts.js", __FILE__));
   }
}


if (class_exists("TutoPlugin")) {

   $myplugin = new TutoPlugin();
   $myplugin->register();
}


// pugin lifecycle
// activation
register_activation_hook(__FILE__, array($myplugin, "activate"));

// desactivation

register_deactivation_hook(__FILE__, array($myplugin, "deactivate"));
