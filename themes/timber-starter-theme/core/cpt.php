<?php 

namespace Core;

class CPT {

    public function execute() {
        $this->register_hooks();
    }

    protected function register_hooks() {
     add_action('init', array($this, 'create_post_types'));
    }

    public function create_post_types() {

        // Post Type
        $labels = array(
            'name' => 'Projets',
            'all_items' => 'Tous les Projets',
            'singular_name' => 'Projet',
            'add_new_item' => 'Ajouter un Projet',
            'edit_item' => 'Modifier le Projet',
            'menu_name' => 'Projets'
        );

        $args = array(
            'labels' => $labels,
            'public' => true,
            'has_archive' => true,
            'supports' => array('title', 'editor','thumbnail'),
            'menu_position' => 5,
            'rewrite' => array('slug' => 'Projets', 'with_front' => false),
            'menu_icon' => 'dashicons-portfolio', // https://developer.wordpress.org/resource/dashicons/
        );

        register_post_type('projets',$args);

        // Taxonomy
    
    } 
}  


