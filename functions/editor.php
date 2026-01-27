<?php

function editor_setup()
{
  add_theme_support('editor-styles');
}

function enqueue_editor_style()
{
  // Check if the current post type is the desired one
  $screen = get_current_screen();
  if ($screen && ($screen->post_type === 'column' || $screen->post_type === 'proposal-list')) {
    add_editor_style('/assets/css/editor-style.css');
  }
}

function enqueue_block_editor_assets()
{
  wp_enqueue_script(
    'backlight-toc-block',
    get_template_directory_uri() . '/assets/js/blocks/table-of-contents.js',
    array('wp-blocks', 'wp-i18n', 'wp-element', 'wp-block-editor', 'wp-components')
  );

  wp_enqueue_script(
    'backlight-list-block',
    get_template_directory_uri() . '/assets/js/blocks/list.js',
    array('wp-blocks', 'wp-i18n', 'wp-element', 'wp-block-editor', 'wp-components')
  );
}

add_action('after_setup_theme', 'editor_setup');
add_action('current_screen', 'enqueue_editor_style');
add_action('enqueue_block_editor_assets', 'enqueue_block_editor_assets');

function set_default_content_for_issue_list($content, $post)
{
  // Check if the post type is 'issue-list'
  if ($post->post_type === 'issue-list' || $post->post_type === 'proposal-list') {
    // Full default content with a Group block styled as a grid
    $default_content = <<<CONTENT
<!-- wp:paragraph -->
<p>自社生産の部品をAIで管理したい理由や詳細を書く自社生産の部品をAIで管理したい理由や詳細を書く自社生産の部品をAIで管理したい理由や詳細を書く自社生産の部品をAIで管理したい理由や詳細を書く</p>
<!-- /wp:paragraph -->

<!-- wp:separator -->
<hr class="wp-block-separator"/>
<!-- /wp:separator -->

<!-- wp:columns {"align":"wide","className":"group-info is-not-stacked-on-mobile"} -->
<div class="wp-block-columns alignwide group-info is-not-stacked-on-mobile">
  <!-- wp:column {"width":"33.33%"} -->
  <div class="wp-block-column" style="flex-basis:33.33%">
      <!-- wp:image -->
      <figure class="wp-block-image"><img src="http://hiroshimax.local/wp-content/uploads/2025/01/mazda-bld-193x193.png" alt=""/></figure>
      <!-- /wp:image -->
  </div>
  <!-- /wp:column -->

  <!-- wp:column {"width":"66.66%"} -->
  <div class="wp-block-column" style="flex-basis:66.66%">
      <!-- wp:group -->
      <div class="wp-block-group">
          <!-- wp:heading {"level":2} -->
          <h2>マツダ株式会社<br>社名が2行の場合のイメージ</h2>
          <!-- /wp:heading -->
          <!-- wp:separator -->
          <hr class="wp-block-separator"/>
          <!-- /wp:separator -->
          <!-- wp:paragraph -->
          <p><a href="https://www.google.co.jp/" target="_blank" rel="noreferrer noopener">公式サイトはこちら</a></p>
          <!-- /wp:paragraph -->
      </div>
      <!-- /wp:group -->
  </div>
  <!-- /wp:column -->
</div>
<!-- /wp:columns -->

<!-- wp:paragraph -->
<p>会社説明あれば会社説明あれば会社説明あれば会社説明あれば会社説明あれば会社説明あれば会社説明あれば会社説明あれば会社説明あれば会社説明あれば会社説明あれば会社説明あれば会社説明あれば会社説明あれば会社説明あれば</p>
<!-- /wp:paragraph -->

<!-- wp:group {"layout":{"type":"grid","columnCount":2},"className":"image-column"} -->
<div class="wp-block-group image-column">
    <!-- wp:image {"sizeSlug":"full"} -->
    <figure class="wp-block-image size-full">
        <img src="http://hiroshimax.local/wp-content/uploads/2025/01/demo-mazda-img-1.png" alt="画像に alt 属性が指定されていません。ファイル名: demo-mazda-img-1.png"/>
    </figure>
    <!-- /wp:image -->

    <!-- wp:image {"sizeSlug":"full"} -->
    <figure class="wp-block-image size-full">
        <img src="http://hiroshimax.local/wp-content/uploads/2025/01/demo-mazda-img2.png" alt="画像に alt 属性が指定されていません。ファイル名: demo-mazda-img2.png"/>
    </figure>
    <!-- /wp:image -->
</div>
<!-- /wp:group -->
CONTENT;

    // Only set the default content if the editor content is empty
    if (empty($content)) {
      return $default_content;
    }
  }

  return $content;
}
add_filter('default_content', 'set_default_content_for_issue_list', 10, 2);

function add_custom_acf_column($columns)
{
  // Insert the custom column after the 'title' column
  $new_columns = [];
  foreach ($columns as $key => $value) {
    $new_columns[$key] = $value; // Keep the original column
    if ('title' === $key) {
      $new_columns['acf_list_name'] = __('名称', 'textdomain'); // Add the new column
    }
  }
  return $new_columns;
}
add_filter('manage_issue-list_posts_columns', 'add_custom_acf_column'); // For 'issue-list'
add_filter('manage_proposal-list_posts_columns', 'add_custom_acf_column'); // For 'proposal-list'

function display_custom_acf_column($column, $post_id)
{
  if ('acf_list_name' === $column) {
    // Fetch the value of the ACF field 'list-name'
    $list_name = get_field('list-name', $post_id);
    echo $list_name ? esc_html($list_name) : __('N/A', 'textdomain');
  }
}
add_action('manage_issue-list_posts_custom_column', 'display_custom_acf_column', 10, 2); // For 'issue-list'
add_action('manage_proposal-list_posts_custom_column', 'display_custom_acf_column', 10, 2); // For 'proposal-list'