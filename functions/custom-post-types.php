<?php

// コラム カスタム投稿タイプ
function create_column_post_type()
{
    $labels = array(
        'name'               => 'コラム',
        'singular_name'      => 'コラム',
        'menu_name'          => 'コラム',
        'add_new'            => '新規追加',
        'add_new_item'       => '新しいコラムを追加',
        'edit_item'          => 'コラムを編集',
        'new_item'           => '新しいコラム',
        'view_item'          => 'コラムを表示',
        'view_items'         => 'コラムを表示',
        'search_items'       => 'コラムを検索',
        'not_found'          => 'コラムが見つかりません',
        'not_found_in_trash' => 'ゴミ箱にコラムが見つかりません',
        'all_items'          => 'すべてのコラム',
        'archives'           => 'コラムアーカイブ',
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'show_in_nav_menus'  => true,
        'show_in_admin_bar'  => true,
        'show_in_rest'       => true, // Gutenberg対応
        'query_var'          => true,
        'rewrite'            => array(
            'slug' => 'column',
            'with_front' => false,
            'pages' => true,
            'feeds' => true,
        ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 6,
        'menu_icon'          => 'dashicons-edit-page',
        'supports'           => array('title', 'editor', 'excerpt', 'thumbnail', 'custom-fields'),
        'taxonomies'         => array('column_category', 'column_tag'),
    );

    register_post_type('column', $args);
}
add_action('init', 'create_column_post_type');

// コラムカテゴリー タクソノミー
function create_column_taxonomy()
{
    $labels = array(
        'name'              => 'コラムカテゴリー',
        'singular_name'     => 'コラムカテゴリー',
        'search_items'      => 'カテゴリーを検索',
        'all_items'         => 'すべてのカテゴリー',
        'parent_item'       => '親カテゴリー',
        'parent_item_colon' => '親カテゴリー:',
        'edit_item'         => 'カテゴリーを編集',
        'update_item'       => 'カテゴリーを更新',
        'add_new_item'      => '新しいカテゴリーを追加',
        'new_item_name'     => '新しいカテゴリー名',
        'menu_name'         => 'カテゴリー',
    );

    $args = array(
        'labels'            => $labels,
        'hierarchical'      => true,
        'public'            => true,
        'show_ui'           => true,
        'show_admin_column' => true,
        'show_in_nav_menus' => true,
        'show_tagcloud'     => true,
        'show_in_rest'      => true, // Gutenberg対応
        'rewrite'           => array('slug' => 'column-category'),
    );

    register_taxonomy('column_category', array('column'), $args);
}
add_action('init', 'create_column_taxonomy');

// コラムタグ タクソノミー
function create_column_tag_taxonomy()
{
    $labels = array(
        'name'                       => 'コラムタグ',
        'singular_name'              => 'コラムタグ',
        'search_items'               => 'タグを検索',
        'popular_items'              => 'よく使われるタグ',
        'all_items'                  => 'すべてのタグ',
        'edit_item'                  => 'タグを編集',
        'update_item'                => 'タグを更新',
        'add_new_item'               => '新しいタグを追加',
        'new_item_name'              => '新しいタグ名',
        'separate_items_with_commas' => 'タグをカンマで区切る',
        'add_or_remove_items'        => 'タグを追加または削除',
        'choose_from_most_used'      => 'よく使われるタグから選択',
        'menu_name'                  => 'タグ',
    );

    $args = array(
        'labels'            => $labels,
        'hierarchical'      => false, // タグは階層なし
        'public'            => true,
        'show_ui'           => true,
        'show_admin_column' => true,
        'show_in_nav_menus' => true,
        'show_tagcloud'     => true,
        'show_in_rest'      => true, // Gutenberg対応
        'rewrite'           => array('slug' => 'column-tag'),
    );

    register_taxonomy('column_tag', array('column'), $args);
}
add_action('init', 'create_column_tag_taxonomy');

// イベント カスタム投稿タイプ
function create_event_post_type()
{
    $labels = array(
        'name'               => 'イベント',
        'singular_name'      => 'イベント',
        'menu_name'          => 'イベント',
        'add_new'            => '新規追加',
        'add_new_item'       => '新しいイベントを追加',
        'edit_item'          => 'イベントを編集',
        'new_item'           => '新しいイベント',
        'view_item'          => 'イベントを表示',
        'view_items'         => 'イベントを表示',
        'search_items'       => 'イベントを検索',
        'not_found'          => 'イベントが見つかりません',
        'not_found_in_trash' => 'ゴミ箱にイベントが見つかりません',
        'all_items'          => 'すべてのイベント',
        'archives'           => 'イベントアーカイブ',
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'show_in_nav_menus'  => true,
        'show_in_admin_bar'  => true,
        'show_in_rest'       => true, // Gutenberg対応
        'query_var'          => true,
        'rewrite'            => array(
            'slug' => 'event',
            'with_front' => false,
            'pages' => true,
            'feeds' => true,
        ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 7,
        'menu_icon'          => 'dashicons-calendar-alt',
        'supports'           => array('title', 'editor', 'excerpt', 'thumbnail', 'custom-fields'),
        'taxonomies'         => array('event_category', 'event_tag'),
    );

    register_post_type('event', $args);
}
add_action('init', 'create_event_post_type');

// イベントカテゴリー タクソノミー
function create_event_category_taxonomy()
{
    $labels = array(
        'name'              => 'イベントカテゴリー',
        'singular_name'     => 'イベントカテゴリー',
        'search_items'      => 'カテゴリーを検索',
        'all_items'         => 'すべてのカテゴリー',
        'parent_item'       => '親カテゴリー',
        'parent_item_colon' => '親カテゴリー:',
        'edit_item'         => 'カテゴリーを編集',
        'update_item'       => 'カテゴリーを更新',
        'add_new_item'      => '新しいカテゴリーを追加',
        'new_item_name'     => '新しいカテゴリー名',
        'menu_name'         => 'カテゴリー',
    );

    $args = array(
        'labels'            => $labels,
        'hierarchical'      => true,
        'public'            => true,
        'show_ui'           => true,
        'show_admin_column' => true,
        'show_in_nav_menus' => true,
        'show_tagcloud'     => true,
        'show_in_rest'      => true, // Gutenberg対応
        'rewrite'           => array('slug' => 'event-category'),
    );

    register_taxonomy('event_category', array('event'), $args);
}
add_action('init', 'create_event_category_taxonomy');

// イベントタグ タクソノミー
function create_event_tag_taxonomy()
{
    $labels = array(
        'name'                       => 'イベントタグ',
        'singular_name'              => 'イベントタグ',
        'search_items'               => 'タグを検索',
        'popular_items'              => 'よく使われるタグ',
        'all_items'                  => 'すべてのタグ',
        'edit_item'                  => 'タグを編集',
        'update_item'                => 'タグを更新',
        'add_new_item'               => '新しいタグを追加',
        'new_item_name'              => '新しいタグ名',
        'separate_items_with_commas' => 'タグをカンマで区切る',
        'add_or_remove_items'        => 'タグを追加または削除',
        'choose_from_most_used'      => 'よく使われるタグから選択',
        'menu_name'                  => 'タグ',
    );

    $args = array(
        'labels'            => $labels,
        'hierarchical'      => false, // タグは階層なし
        'public'            => true,
        'show_ui'           => true,
        'show_admin_column' => true,
        'show_in_nav_menus' => true,
        'show_tagcloud'     => true,
        'show_in_rest'      => true, // Gutenberg対応
        'rewrite'           => array('slug' => 'event-tag'),
    );

    register_taxonomy('event_tag', array('event'), $args);
}
add_action('init', 'create_event_tag_taxonomy');

// カスタムリライトルールの追加
function add_custom_rewrite_rules()
{
    // コラムアーカイブのページネーション
    add_rewrite_rule(
        '^column/page/?([0-9]{1,})/?$',
        'index.php?post_type=column&paged=$matches[1]',
        'top'
    );

    // コラムタグのページネーション
    add_rewrite_rule(
        '^column-tag/([^/]+)/page/?([0-9]{1,})/?$',
        'index.php?column_tag=$matches[1]&paged=$matches[2]',
        'top'
    );

    // イベントアーカイブのページネーション
    add_rewrite_rule(
        '^event/page/?([0-9]{1,})/?$',
        'index.php?post_type=event&paged=$matches[1]',
        'top'
    );
}
add_action('init', 'add_custom_rewrite_rules');

// パーマリンク構造を更新するためのフック
function flush_rewrite_rules_on_activation()
{
    create_column_post_type();
    create_column_taxonomy();
    create_column_tag_taxonomy();
    add_custom_rewrite_rules();
    flush_rewrite_rules();
}
add_action('after_switch_theme', 'flush_rewrite_rules_on_activation');
