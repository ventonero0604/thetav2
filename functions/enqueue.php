<?php

/**
 * CSSとJavaScriptの読み込み
 */
function add_files()
{
  define("TEMPLATE_DIRE", get_template_directory_uri());
  define("TEMPLATE_PATH", get_template_directory());

  function wp_css($css_name, $file_path, $array = [])
  {
    if (!strpos($file_path, "//")) {
      wp_enqueue_style(
        $css_name,
        TEMPLATE_DIRE . $file_path,
        $array,
        date("YmdGis", filemtime(TEMPLATE_PATH . $file_path)),
      );
    } else {
      wp_enqueue_style($css_name, $file_path, $array);
    }
  }
  function wp_script($script_name, $file_path, $array = [], $bool = true)
  {
    if (!strpos($file_path, "//")) {
      wp_enqueue_script(
        $script_name,
        TEMPLATE_DIRE . $file_path,
        $array,
        date("YmdGis", filemtime(TEMPLATE_PATH . $file_path)),
        $bool,
      );
    } else {
      wp_enqueue_script($script_name, $file_path, $array, false, $bool);
    }
  }

  wp_script("bundle-js", "/assets/js/bundle.js");
  wp_css("style-css", "/assets/css/style.css");
  wp_css("static-contents-css", "/assets/css/staticContents.css");

  // コラム詳細・一覧ページでのみ columns.css を読み込む
  $should_load_columns_css =
    is_singular("post") ||
    is_singular("column") ||
    is_post_type_archive("post") ||
    is_post_type_archive("column") ||
    is_home() ||
    get_query_var("post_type") === "column" || // ページネーション対応
    is_tax("column_tag"); // コラムタグアーカイブ対応

  // イベント詳細・一覧ページでのみ event.css を読み込む
  $should_load_event_css =
    is_singular("event") || is_post_type_archive("event") || get_query_var("post_type") === "event"; // ページネーション対応

  // ニュース詳細・一覧ページでのみ news.css を読み込むjkjk
  $should_load_news_css = is_singular("news") || is_post_type_archive("news") || get_query_var("post_type") === "news";

  if ($should_load_columns_css) {
    wp_css("columns-css", "/assets/css/columns.css");
  }

  wp_css("event-css", "/assets/css/event.css");

  wp_css("news-css", "/assets/css/news.css");

  $translation_array = [
    "templateUrl" => get_stylesheet_directory_uri(),
    "post_id" => get_the_ID(),
  ];
  //after wp_enqueue_script
  wp_localize_script("bundle-js", "tempData", $translation_array);
}
add_action("wp_enqueue_scripts", "add_files", 1);

function enqueue_block_editor_default_styles()
{
  wp_enqueue_style("wp-block-library"); // Core block library CSS
}
add_action("wp_enqueue_scripts", "enqueue_block_editor_default_styles");
