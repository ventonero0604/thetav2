<?php


// Add custom image sizes
function my_custom_image_sizes()
{
  add_image_size('slider', 615, 923, true);
}
add_action('after_setup_theme', 'my_custom_image_sizes');

// Make custom image sizes selectable in the editor
// function my_custom_sizes_dropdown($sizes)
// {
//   return array_merge($sizes, array(
//     'company' => __('外観'),
//     'eyecatch' => __('キービジュアル'),
//     'sample-image' => __('参考画像'),
//   ));
// }
// add_filter('image_size_names_choose', 'my_custom_sizes_dropdown');
