<?php

/**
 * Register custom blocks
 */

function backlight_register_custom_blocks()
{
  // Register Table of Contents block
  register_block_type('backlight/table-of-contents', array(
    'editor_script' => 'backlight-toc-block',
    'editor_style'  => 'backlight-editor',
    'render_callback' => 'backlight_render_table_of_contents',
    'attributes' => array(
      'title' => array(
        'type' => 'string',
        'default' => 'INDEX'
      ),
      'className' => array(
        'type' => 'string',
        'default' => ''
      ),
      'depth' => array(
        'type' => 'number',
        'default' => 2
      )
    )
  ));
}
add_action('init', 'backlight_register_custom_blocks');

/**
 * Generate unique ID for heading
 */
function backlight_generate_unique_id($text, &$used_ids)
{
  $base_id = sanitize_title($text);
  $id = $base_id;
  $counter = 2; // Start from 2 for duplicates

  while (isset($used_ids[$id])) {
    $id = $base_id . '-' . $counter;
    $counter++;
  }

  $used_ids[$id] = true;
  return $id;
}

/**
 * Add IDs to headings in the content
 */
function backlight_add_heading_ids($content)
{
  // Only process if we're in the main content area
  if (!in_the_loop() || !is_main_query()) {
    return $content;
  }

  // Get the post content
  $post = get_post();
  if (!$post) {
    return $content;
  }

  // Check if the post has our table of contents block
  if (!has_block('backlight/table-of-contents', $post)) {
    return $content;
  }

  // Find the block and get its depth setting
  $blocks = parse_blocks($post->post_content);
  $depth = 2; // Default depth

  foreach ($blocks as $block) {
    if ($block['blockName'] === 'backlight/table-of-contents' && isset($block['attrs']['depth'])) {
      $depth = intval($block['attrs']['depth']);
      break;
    }
  }

  // Store used IDs to prevent duplicates
  $used_ids = array();

  // Build the pattern for headings up to the specified depth
  $pattern = '/<h([2-' . $depth . '])([^>]*)>(.*?)<\/h[2-' . $depth . ']>/i';

  // Add IDs to headings
  $content = preg_replace_callback($pattern, function ($matches) use (&$used_ids) {
    $level = $matches[1];
    $attrs = $matches[2];
    $text = $matches[3];

    // Check if the heading already has an ID
    if (strpos($attrs, 'id=') !== false) {
      return $matches[0];
    }

    // Generate unique ID
    $id = backlight_generate_unique_id($text, $used_ids);

    // Add the ID attribute
    return sprintf(
      '<h%s%s id="%s">%s</h%s>',
      $level,
      $attrs,
      $id,
      $text,
      $level
    );
  }, $content);

  return $content;
}
add_filter('the_content', 'backlight_add_heading_ids', 20);

/**
 * Render Table of Contents block
 */
function backlight_render_table_of_contents($attributes)
{
  $title = isset($attributes['title']) ? $attributes['title'] : '目次';
  $className = isset($attributes['className']) ? $attributes['className'] : '';
  $depth = isset($attributes['depth']) ? intval($attributes['depth']) : 2;

  // Get post content
  $content = get_the_content();

  // Store used IDs to prevent duplicates
  $used_ids = array();

  // Build the regex pattern based on depth
  $pattern = '/<h[2-' . $depth . '][^>]*>(.*?)<\/h[2-' . $depth . ']>/i';

  // Extract headings
  preg_match_all($pattern, $content, $matches);

  if (empty($matches[0])) {
    return '';
  }

  $output = '<div class="wp-block-backlight-table-of-contents ' . esc_attr($className) . '">';
  $output .= '<h2 class="toc-title">' . esc_html($title) . '</h2>';
  $output .= '<ul class="toc-list">';

  foreach ($matches[0] as $index => $heading) {
    // Extract heading level and text
    preg_match('/<h([2-' . $depth . '])[^>]*>(.*?)<\/h[2-' . $depth . ']>/i', $heading, $parts);
    $level = intval($parts[1]);
    $heading_text = strip_tags($parts[2]);

    // Generate unique ID
    $anchor = backlight_generate_unique_id($heading_text, $used_ids);

    // Add appropriate class based on heading level
    $level_class = 'toc-level-' . $level;

    $output .= sprintf(
      '<li class="toc-item %s"><a href="#%s">%s</a></li>',
      esc_attr($level_class),
      esc_attr($anchor),
      esc_html($heading_text)
    );
  }

  $output .= '</ul></div>';

  return $output;
}
