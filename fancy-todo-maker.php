<?php

/**
 * @package FancyTodoMaker
 */
/**
 * Plugin Name: Fancy Todo Maker
 * Plugin URI: https://github.com/hrdelwar/hrdelwar/fancy-todo-maker
 * Description: This is fancy todo maker toole
 * Version: 0.1.0
 * Author: HrDelwar
 * Author URI: https://github.com/hrdelwar
 * Text Domain: fancy-todo-maker
 */

defined('ABSPATH') or die('not access'); // Exit if accessed directly

// check class is exist or not
if (!class_exists('FancyTodoMaker')) {
    class FancyTodoMaker
    {
        public $plugin;

        // //construct
        function __construct()
        {
            $this->plugin = plugin_basename(__FILE__);
        }

        //register
        function register()
        {
//            add_action('init', array($this, 'custom_post_type'));
            add_action('admin_enqueue_scripts', array($this, 'enqueue'));
            add_action('admin_menu', array($this, 'add_admin_pages'));
            add_filter("plugin_action_links_$this->plugin", array($this, 'settings_link'));
        }

        //
        public function settings_link($links)
        {
            // add custom settings link
            $setting_link = '<a href="admin.php?page=fancy_todo_maker">Settings</a>';
            array_push($links, $setting_link);
            return $links;
        }

        //add admin pages
        public function add_admin_pages()
        {
            add_menu_page('Fancy Todo Maker', 'Make Todos', 'manage_options', 'fancy_todo_maker', array($this, 'admin_index'), 'dashicons-store', 110);
        }

        // page template
        public function admin_index()
        {
            // require template
            require_once plugin_dir_path(__FILE__) . 'templates/admin.php';
        }

        // activate method
        function activate()
        {
            $this->custom_post_type();
            require_once plugin_dir_path(__FILE__) . 'includes/activation.php';
            FancyTodoMakerActivate::activate();
        }

        // deactivate method
        function deactivate()
        {
            // flush rewrite rules
            require_once plugin_dir_path(__FILE__) . 'includes/deactivation.php';
            FancyTodoMakerDeactivation::deactivate();
        }

        function custom_post_type()
        {
            register_post_type('book', ['public' => true, 'label' => 'Books']);
        }

        function enqueue()
        {
            // enqueue all our scripts
            wp_enqueue_style('mypluginstyles', plugins_url('/assets/mystyle.css', __FILE__));
            wp_enqueue_script('mypluginscript', plugins_url('/assets/myscript.js', __FILE__));
        }
    }


    $FancyTodoMaker = new FancyTodoMaker();
    $FancyTodoMaker->register();


// activation
    register_activation_hook(__FILE__, array($FancyTodoMaker, 'activate'));

// deactivatio
    register_deactivation_hook(__FILE__, array($FancyTodoMaker, 'deactivate'));
}