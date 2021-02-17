<?php

namespace Core;


class Config {

    public function execute() {
      $this->register_hooks();
      $this->clean_wp();
    }

    public function register_hooks() {
        add_action( 'wp_enqueue_scripts', array( $this, 'register_assets' ) );
    }

    public function clean_wp() {

        // Remove XML RPC
        add_filter( 'xmlrpc_enabled', '__return_false' );
    
        // Welcome panel
        remove_action( 'welcome_panel', 'wp_welcome_panel' );
    
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
    

}