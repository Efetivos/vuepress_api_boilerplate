<?php

require_once TEMPLATEPATH . '/api/novidade.php';
require_once TEMPLATEPATH . '/api/novidades.php';

function create_novidades_post() {
  register_post_type( 'novidades',
    array(
      'labels' => array(
        'name' => 'Novidades',
        'singular_name' => 'novidade'
      ),
      'public' => true,
      'has_archive' => true,
    ));
}

add_action('init', 'create_novidades_post');

add_theme_support( 'post-thumbnails' ); 

?>