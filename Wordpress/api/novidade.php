<?php

function api_get_novidade($request) {
  $slug = sanitize_text_field($request->get_param('slug'));
  $page_object = get_page_by_path($slug, OBJECT, 'novidades');

  $id = $page_object->ID;
  $titulo = $page_object->post_title;
  $acf = get_fields($id);

  $novidade = array(
    'slug' => $slug,
    'id' => $id,
    'titulo' => $titulo,
    'acf' => $acf
  );

  return rest_ensure_response( $novidade );
}

function api_register_novidade_routes() {
  register_rest_route('bahls/v1', '/novidade/(?P<slug>[-\w]+)', array(
    'methods' => 'GET',
    'callback' => 'api_get_novidade',
  ));
}

add_action('rest_api_init', 'api_register_novidade_routes');

?>