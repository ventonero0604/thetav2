<?php

/**
 * CSSとJavaScriptの読み込み
 */
function add_files()
{
  define("TEMPLATE_DIRE", get_template_directory_uri());
  define("TEMPLATE_PATH", get_template_directory());


  function wp_css($css_name, $file_path, $array = array())
  {
    if (!strpos($file_path, '//')) {
      wp_enqueue_style($css_name, TEMPLATE_DIRE . $file_path, $array, date('YmdGis', filemtime(TEMPLATE_PATH . $file_path)));
    } else {
      wp_enqueue_style($css_name, $file_path, $array);
    }
  }
  function wp_script($script_name, $file_path, $array = array(), $bool = true)
  {
    if (!strpos($file_path, '//')) {
      wp_enqueue_script($script_name, TEMPLATE_DIRE . $file_path, $array, date('YmdGis', filemtime(TEMPLATE_PATH . $file_path)), $bool);
    } else {
      wp_enqueue_script($script_name, $file_path, $array, false, $bool);
    }
  }

  wp_script('bundle-js', '/assets/js/bundle.js');
  wp_css('style-css', '/assets/css/style.css');
  wp_css('static-contents-css', '/assets/css/staticContents.css');

  // コラム詳細・一覧ページでのみ columns.css を読み込む
  $should_load_columns_css = (
    is_singular('post') ||
    is_singular('column') ||
    is_post_type_archive('post') ||
    is_post_type_archive('column') ||
    is_home() ||
    get_query_var('post_type') === 'column' || // ページネーション対応
    is_tax('column_tag') // コラムタグアーカイブ対応
  );

  // イベント詳細・一覧ページでのみ event.css を読み込む
  $should_load_event_css = (
    is_singular('event') ||
    is_post_type_archive('event') ||
    get_query_var('post_type') === 'event' // ページネーション対応
  );

  // デバッグ情報（一時的）
  if (current_user_can('administrator')) {
    echo '<!-- DEBUG CSS: Should load columns.css: ' . ($should_load_columns_css ? 'YES' : 'NO') . ' -->';
    echo '<!-- DEBUG CSS: is_post_type_archive(column): ' . (is_post_type_archive('column') ? 'YES' : 'NO') . ' -->';
    echo '<!-- DEBUG CSS: get_query_var(post_type): ' . get_query_var('post_type') . ' -->';
    echo '<!-- DEBUG CSS: is_tax(column_tag): ' . (is_tax('column_tag') ? 'YES' : 'NO') . ' -->';
    echo '<!-- DEBUG CSS: Should load event.css: ' . ($should_load_event_css ? 'YES' : 'NO') . ' -->';
    echo '<!-- DEBUG CSS: is_singular(event): ' . (is_singular('event') ? 'YES' : 'NO') . ' -->';
    echo '<!-- DEBUG CSS: is_post_type_archive(event): ' . (is_post_type_archive('event') ? 'YES' : 'NO') . ' -->';
  }

  if ($should_load_columns_css) {
    wp_css('columns-css', '/assets/css/columns.css');
  }

  if ($should_load_event_css) {
    wp_css('event-css', '/assets/css/event.css');
  }


  $translation_array = array(
    'templateUrl' => get_stylesheet_directory_uri(),
    'post_id' => get_the_ID()
  );
  //after wp_enqueue_script
  wp_localize_script('bundle-js', 'tempData', $translation_array);
}
add_action('wp_enqueue_scripts', 'add_files', 1);

function enqueue_block_editor_default_styles()
{
  wp_enqueue_style('wp-block-library'); // Core block library CSS
}
add_action('wp_enqueue_scripts', 'enqueue_block_editor_default_styles');
