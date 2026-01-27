<?php
add_action('pre_get_posts', 'my_custom_query_vars');
function my_custom_query_vars($query)
{
  /* @var $query WP_Query */
  if (!is_admin() && $query->is_main_query()) {
    if (is_post_type_archive('column') && !is_paged() && !is_tag()) {
      // Get the current posts_per_page setting
      $posts_per_page = get_option('posts_per_page');
      // Add one more post for the first page
      $query->set('posts_per_page', $posts_per_page + 1);
      // Store the original posts per page for pagination calculation
      $query->set('original_posts_per_page', $posts_per_page);
    }
    // if (is_post_type_archive('lecturer')) {
    //   $query->set('posts_per_page', 16); //表示したい数
    // }
    // if (is_post_type_archive('column')) {
    //   $query->set('posts_per_page', -1); //表示したい数
    // }
  }
  return $query;
}
