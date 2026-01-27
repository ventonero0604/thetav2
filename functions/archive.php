<?php

add_action('init', function () {
  // Paged version
  add_rewrite_rule(
    '^column/tag/([^/]+)/page/([0-9]+)/?$',
    'index.php?post_type=column&tag=$matches[1]&paged=$matches[2]',
    'top'
  );

  // First page
  add_rewrite_rule(
    '^column/tag/([^/]+)/?$',
    'index.php?post_type=column&tag=$matches[1]',
    'top'
  );
});

add_action('pre_get_posts', function ($query) {
  if (!is_admin() && $query->is_main_query() && get_query_var('tag') && get_query_var('post_type') === 'column') {
    $query->set('post_type', 'column');
  }
});
