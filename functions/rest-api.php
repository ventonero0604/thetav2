<?php

add_action('rest_api_init', 'customize_api_response');
function customize_api_response()
{
  // アイキャッチ画像のレスポンスを追加する投稿タイプ
  $post_types = ['issue-list', 'proposal-list'];

  foreach ($post_types as $post_type) {
    register_rest_field(
      $post_type,
      'thumbnail',
      array(
        'get_callback'  => function ($post) {
          $thumbnail_id = get_post_thumbnail_id($post['id']);

          if ($thumbnail_id) {
            // アイキャッチが設定されていたらurl・width・heightを配列で返す
            $img = wp_get_attachment_image_src($thumbnail_id, 'thumb');

            return [
              'url' => $img[0],
              'width' => $img[1],
              'height' => $img[2]
            ];
          } else {
            // アイキャッチが設定されていなかったら空の配列を返す
            return [];
          }
        },
        'update_callback' => null,
        'schema'          => null,
      )
    );
  }
}

add_action('rest_api_init', 'add_taxonomy_name_to_api_response');
function add_taxonomy_name_to_api_response()
{
  $post_types = ['issue-list', 'proposal-list'];

  foreach ($post_types as $post_type) {
    register_rest_field(
      $post_type,
      'list_cat_names',
      array(
        'get_callback'  => function ($post) {
          $terms = wp_get_post_terms($post['id'], 'list-cat');
          if (!empty($terms) && !is_wp_error($terms)) {
            return array_map(function ($term) {
              return $term->name;
            }, $terms);
          } else {
            return [];
          }
        },
        'update_callback' => null,
        'schema'          => null,
      )
    );
    register_rest_field(
      $post_type,
      'list_tag_names',
      array(
        'get_callback'  => function ($post) {
          $terms = wp_get_post_terms($post['id'], 'list-tag');
          if (!empty($terms) && !is_wp_error($terms)) {
            return array_map(function ($term) {
              return $term->name;
            }, $terms);
          } else {
            return [];
          }
        },
        'update_callback' => null,
        'schema'          => null,
      )
    );
    register_rest_field(
      $post_type,
      'ip_matching_names',
      array(
        'get_callback'  => function ($post) {
          $terms = wp_get_post_terms($post['id'], 'ip-matching');
          if (!empty($terms) && !is_wp_error($terms)) {
            return array_map(function ($term) {
              return $term->name;
            }, $terms);
          } else {
            return [];
          }
        },
        'update_callback' => null,
        'schema'          => null,
      )
    );
  }
}
