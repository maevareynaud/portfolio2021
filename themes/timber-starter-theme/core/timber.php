<?php

namespace Core;

class TimberConfig extends \TimberSite {

  public function execute() {
    $this->register_hooks();

    // Define Twig directories
    \Timber::$dirname = array( 'templates', 'views' );
  }

  private function register_hooks() {
    add_filter('timber/context', array($this, 'add_to_context'));
    add_filter('timber/twig', array($this, 'add_to_twig'));
  }

  // Global context, available to all templates
  function add_to_context($context) {

    // WP Templates
    $context['wp']['template'] = array(
      'front_page' => is_front_page(),
      'blog' => is_home(),
    );

    // Menus
    $context['wp']['menus'] = array(
      "main" => new \Timber\Menu(),
    );

    if(is_user_logged_in()){
      $context['signin'] = true;
    }


    return $context;
  }

  // Improve Twig
  public function add_to_twig($twig) {
    $twig->addFilter(new \Twig_SimpleFilter('output_svg', array($this, 'output_svg')));

    return $twig;
  }

  // SVG embedder Twig filter
  public function output_svg($svg_url) {
    return file_get_contents($svg_url);
  }

  public function autoescape () {
    \Timber::$autoescape = false;
  }

}
