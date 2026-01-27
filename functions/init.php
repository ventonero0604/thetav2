<?php


/**
 * WordPress標準機能
 */

function my_setup()
{
  add_theme_support('post-thumbnails'); /* アイキャッチ */
  add_theme_support('title-tag'); /* タイトルタグ自動生成 */
  add_theme_support('html5', array( /* HTML5のタグで出力 */
    'search-form',
    'comment-form',
    'comment-list',
    'gallery',
    'caption',
  ));
}
add_action('after_setup_theme', 'my_setup');

add_filter('wpseo_primary_term_taxonomies', '__return_empty_array');




/**
 * wpバージョンの非表示
 */
remove_action('wp_head', 'wp_generator');


/**
 * デフォルトの投稿タイプの削除
 */
add_action('admin_menu', 'remove_default_post_type');

function remove_default_post_type()
{
  remove_menu_page('edit.php');
}