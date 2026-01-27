<?php


//excerpt length
function mytheme_custom_excerpt_length($length)
{
  global $excerpt_length;
  return $excerpt_length;
}
add_filter('excerpt_length', 'mytheme_custom_excerpt_length', 999);

remove_filter('the_excerpt', 'wpautop');

/*  Excerpt ending
 /* ------------------------------------ */
function alx_excerpt_more($more)
{
  return '...';
}
add_filter('excerpt_more', 'alx_excerpt_more');