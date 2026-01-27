<?php

/* 検索の全角スペース対応 */
function search_space($query)
{
  if (is_admin() || !$query->is_main_query()) {
    return;
  }
  if ($query->is_search) {
    $formtxt = $query->get('s');
    $formtxt = str_replace('　', ' ', $formtxt);
    $query->set('s', $formtxt);
  }
}
add_action('pre_get_posts', 'search_space');