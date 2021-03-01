<?php

namespace Core;


class Config {

    public function execute() {
      $this->theme_setup();
      $this->register_hooks();
      $this->clean_wp();
    }

    public function register_hooks() {
        add_action( 'wp_enqueue_scripts', array( $this, 'register_assets' ) );

        add_action( 'admin_menu', array( $this, 'remove_meta_boxes' ) );
        //add_action( 'wp_enqueue_scripts', array( $this, 'dequeue_assets'), 1000 );
    }
    

    public function clean_wp() {

        // Remove XML RPC
        add_filter( 'xmlrpc_enabled', '__return_false' );
    
        // Welcome panel
        //remove_action( 'welcome_panel', 'wp_welcome_panel' );


    
        // Head useless stuff
        remove_action( 'wp_head', 'rsd_link' );
        remove_action( 'wp_head', 'wp_generator' );
        remove_action( 'wp_head', 'feed_links', 2);
        remove_action( 'wp_head', 'index_rel_link' );
        remove_action( 'wp_head', 'wlwmanifest_link' );
        remove_action( 'wp_head', 'feed_links_extra', 3);
        remove_action( 'wp_head', 'start_post_rel_link', 10, 0);
        remove_action( 'wp_head', 'parent_post_rel_link', 10, 0);
        remove_action( 'wp_head', 'adjacent_posts_rel_link', 10, 0);
    
        // Remove Emojis
        remove_action( 'admin_print_styles', 'print_emoji_styles' );
        remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
        remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
        remove_action( 'wp_print_styles', 'print_emoji_styles' );
        remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
        remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
        remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
      }

      public function register_assets() {
        wp_deregister_script( 'jquery' );
        wp_enqueue_script( 'jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js', false, '3.3.1', true);
      }

      public function theme_setup() {

        add_theme_support( 'menus' );


        // Menus
        register_nav_menus( array(
          'main' => 'Menu Principal',
          'footer' => 'Pied de page'
        ) ); 

        // Editor custom styles
        add_theme_support( 'editor-styles' );
        add_editor_style( array( 'css/editor-style.css' ) );

         // RSS
        add_theme_support( 'automatic-feed-links' );

        // Gutenberg - Wide blocks
        add_theme_support( 'align-wide' );

        // Remove admin topbar (and html margin-top 32px)
        add_theme_support( 'admin-bar', array( 'callback' => '__return_false' ) );

      }

      public function dequeue_assets() {
    
        // Remove Gutenberg frontend styles
        wp_dequeue_style( 'wp-block-library' );
        wp_dequeue_style( 'wp-block-library-theme' );
    
        // remove WooCommerce stylesheet
        wp_dequeue_style( 'wc-block-style' );
      }
    
    

      public function remove_meta_boxes() {
        remove_meta_box( 'dashboard_primary', 'dashboard', 'normal' ); // WP News
      }

    

}