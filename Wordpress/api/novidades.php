<?php

function api_get_novidades() {

  $posts = array();
  $args = array('post_type' => 'novidades', 'post_per_page' => -1);
  $loop = new WP_Query($args);
  while ($loop->have_posts()) : $loop->the_post();
    $id = get_the_ID();
    $slug = get_post_field('post_name', $id);
    $titulo = get_the_title();
    $conteudo = get_field('conteudo', $id);

    $post = array(
      'id' => $id,
      'slug' => $slug,
      'titulo' => $titulo,
      'conteudo' => $conteudo,
      'cover' => $cover,
    );

    $posts[$slug] = $post;
  endwhile;

  return rest_ensure_response( $posts );
}

function api_register_novidades_routes() {
  register_rest_route('bahls/v1', '/novidades', array(
    'methods' => 'GET',
    'callback' => 'api_get_novidades',
  ));
}

add_action('rest_api_init', 'api_register_novidades_routes');

?>