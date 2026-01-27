<?php

$excerpt_length = 125;

// 分割したファイルパスを配列に追加
$function_files = [
  '/functions/init.php',
  '/functions/enqueue.php',
  '/functions/thumbnail.php',
  '/functions/pagination.php',
  // '/functions/excerpt.php',
  // '/functions/search.php',
  '/functions/post-per-page.php',
  '/functions/editor.php',
  // '/functions/rest-api.php',
  '/functions/cf7.php',
  '/functions/posts.php',
  '/functions/blocks.php',
  '/functions/archive.php',
  '/functions/ajax-handler.php',
  '/functions/custom-post-types.php',
];

foreach ($function_files as $file) {
  if ((file_exists(__DIR__ . $file))) { // ファイルが存在する場合
    // ファイルを読み込む
    locate_template($file, true, true);
  } else { // ファイルが見つからない場合
    // エラーメッセージを表示
    trigger_error("`$file`ファイルが見つかりません", E_USER_ERROR);
  }
}

function add_slug_body_class($classes)
{
  global $post;
  if (isset($post)) {
    $classes[] = $post->post_name;
  }
  return $classes;
}
add_filter('body_class', 'add_slug_body_class');

add_action('wp_head', function () {
  if (is_post_type_archive('projects')) { // ← your CPT slug
    echo "\n<!-- DEBUG: is_post_type_archive('projects') = TRUE -->\n";
  } else {
    echo "\n<!-- DEBUG: is_post_type_archive('projects') = FALSE (this is not the CPT archive) -->\n";
  }
}, 1);

add_action('wp_head', function () {
  $opt = get_option('wpseo_titles');
  $pt  = 'projects'; // your post type key
  $title_key = "title-ptarchive-$pt";
  $desc_key  = "metadesc-ptarchive-$pt";

  $title_val = $opt[$title_key] ?? '(not set)';
  $desc_val  = $opt[$desc_key]  ?? '(not set)';

  echo "\n<!-- DEBUG Yoast: $title_key = $title_val -->\n";
  echo "\n<!-- DEBUG Yoast: $desc_key  = $desc_val  -->\n";
}, 2);
